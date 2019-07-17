$(function() {
    if (window.innerWidth < 800) {
        $('.liveinfo_ct').on('click', '.liveinfo_tab', function() {
            $(this).addClass('liveinfo_tab_active').siblings().removeClass('liveinfo_tab_active');
            if ($(this).find('.title_txt2').text() == '互动聊天') {
                $('.dm-y-list').css({ display: 'block' });
                // $('.dm-list-cont')[0].scrollIntoView();
                // $(".dm-list-cont").scrollTop($(".dm-list-cont")[0].scrollHeight);
                ($('.dm-list-cont').children("div:last-child")[0]).scrollIntoView();
            } else {
                $('.dm-y-list').css({ display: 'none' });
            }
        })
    }




    var liveinfourl = "/api/live/live_detail";
    var live_chaturl = "/api/live/live_chat";
    var play_url_server = "";

    function liveinfo(data) {
        $("#titles").text(data.data.live_info.title);
        $("#top_title").text(data.data.live_info.title);
        $("#class_name").text(data.data.live_info.class_name);
        $("#sort").text(data.data.live_info.play_count);
        $("#description").text(data.data.live_info.description);
        $("#end_date").text(data.data.live_info.end_date);
        $("#start_date").text(data.data.live_info.start_date);

        if (data.data.live_url.code == 200) {
            if (data.data.live_url.data.play_url != undefined || data.data.live_url.data.play_url != null) {
                var liveurl = data.data.live_url.data.play_url
            }
            if (liveurl.live_status == 'active') {
                var hls_url = liveurl.hls_url;
                var flash_url = liveurl.flash_url;
                $('<div id="id_test_video"  height:auto;"></div>').appendTo("#live_list");
				var height=window.innerWidth < 800?410:200;
				var player = new TcPlayer('id_test_video', {
					"flv": Base64.decode(flash_url), //增加了一个flv的播放地址，用于PC平台的播放 请替换成实际可用的播放地址
					"m3u8": Base64.decode(flash_url),
					//				"m3u8_hd"   : Base64.decode(flash_url),
					//				"m3u8_sd"   : Base64.decode(flash_url),
					"autoplay": true, //iOS下safari浏览器，以及大部分移动端浏览器是不开放视频自动播放这个能力的
					"coverpic": data.data.live_info.web_image_url,
					"width": '710', //视频的显示宽度，请尽量使用视频分辨率宽度
					"height": height, //视频的显示高度，请尽量使用视频分辨率高度
					"wording": {
						1002: "直播还没开始！请耐心等候.....",
						2048: "请求失败，可能是网络错误！",
						13: "直播已结束，请稍后再来"
					}
				});
            } else if (liveurl.live_status == 'inactive' || liveurl.live_status == 'forbid') {
                $("#live_list").text("直播还没开始");
            }

        } else if (data.data.live_url.code == 410) {
            showPrompt(data.data.live_url.msg);
        }

        for (var i = 0; i < data.data.expert_list.length; i++) {
            $('<li>' + '<a>' +
                '<img src="' + data.data.expert_list[i].web_image_url + '" />' +
                '<p>' + data.data.expert_list[i].expert_name + '</p>' +
                '</a>' +
                '<div class="daos_ms">' +
                '<div class="daos_top">' +
                '</div>' +
                '<div class="daos_txt">' + data.data.expert_list[i].introduction + '</div>' +
                '</div>' +
                '</li>').appendTo(".guestlive_ul");
        }

    }
    var data = {
        "live_id": live_id,
        "uid": cook_uid
    };
    ajax_all_Filed("true", "true", "GET", liveinfourl, "json", data, liveinfo); //调用函数
    $('.guestlive_ul').on('mouseenter', 'li', function() { //绑定鼠标进入事件
        $(this).find('.daos_ms').show();
    });
    $('.guestlive_ul').on('mouseleave', 'li', function() { //绑定鼠标划出事件
        $(this).find('.daos_ms').hide();
    });

    var offsetTop = 0;

    function live_chat(data) {

        if (data.code == "410") {
            showLaert(data.msg);
            return false;
        }

        $(".dm-list-cont div").remove()
        for (var i = data.data.chat_list.length - 1; i >= 0; i--) {
            $('<div class="dm-font-y"><span style="color:#1FA5EE">' + data.data.chat_list[i].nick_name + '</span>：' + data.data.chat_list[i].message + '</div>').appendTo(".dm-list-cont");
        }
        $('.dm-list-cont').scroll(function(event) {
            offsetTop = $(".dm-list-cont div").offset().top;
            //console.log($(".dm-list-cont div").length);
            //			console.log(offsetTop);
            //			console.log($('.dm-list-cont')[0].scrollHeight);
            //			console.log(offsetTop + $('.dm-list-cont')[0].scrollHeight)
            //top-111   bottom-1880
        });
        var element = $('.dm-list-cont')[0];
        //console.log(element.scrollHeight - element.scrollTop === element.clientHeight);

        if (element.scrollHeight - element.scrollTop > element.clientHeight + 50) {
            $('.dm-list-cont').scrollTop(-offsetTop + 152);
        } else {
            $('.dm-list-cont').scrollTop($('.dm-list-cont')[0].scrollHeight);
        }
        timerCount(data.data.time_space)

        if (offsetTop == 0) { //初始化 给底部位置
            $('.dm-list-cont').scrollTop($('.dm-list-cont')[0].scrollHeight);
        }
    }
    var live_chatdata = {
        "live_id": live_id,
        "uid": cook_uid,
        "content": ""
    };
    ajax_all_Filed("true", "true", "GET", live_chaturl, "json", live_chatdata, live_chat); //调用函数
    function timerCount(time) {
        t = setTimeout(function() {
            ajax_all_Filed("true", "true", "GET", live_chaturl, "json", live_chatdata, live_chat); //调用函数
        }, time);
    }
    //监听是否登录
    $('#send-dm').keyup(function(event) {
        if (event.keyCode == 13) {
            sendMsg();

        }
    });
    //提交留言
    $('.sendBtn').on('click', sendMsg)

    function sendMsg() {
        if (cook_uid == "" || cook_uid == null) {
            showLaert('您还没有登录<a href="' + pu_url + '">前往登录</a>');
            $("#alert_btn").click(function() {
                window.location.href = pu_url;
            })
            $(".daytiem_close").click(function() {
                window.location.href = pu_url;
            })
        } else {
            var dmtxt = $('#send_input').val();
            if (dmtxt != '') {
                var live_chatdata = {
                    "live_id": live_id,
                    "uid": cook_uid,
                    "content": dmtxt
                };
                ajax_all_Filed("true", "true", "GET", live_chaturl, "json", live_chatdata, live_chat); //调用函数
                $('#send_input').val("");
            } else {
                showLaert('请输入信息');
            }
        }
    }

})