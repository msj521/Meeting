$(function() {
    var liveinfourl = "/api/live/live_detail";
    var live_chaturl = "/api/live/live_chat";
	//swoole 与服务器建立连接
	var websocket=new WebSocket("ws://127.0.0.1:9501");
	websocket.onopen = function (evt) {
		console.log("建立连接");
	};

	//onmessage 监听服务器数据的推送
	websocket.onmessage = function (evt) {
		var data =JSON.parse(evt.data);
		var live_chatdata = {
			"live_id": live_id,
			"uid": cook_uid
		};
		$("#sort").text(data.online);
		ajax_all_Filed("true", "true", "POST", live_chaturl, "json", live_chatdata, live_chat); //调用函数
		console.log('从服务器获取到的数据: ' + evt.data);
	}
	
	websocket.onclose = function (evt) {
		console.log("服务断开");
	};
	
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
	
	//直播详情信息
    function liveinfo(data) {
	var start=data.data.live_info.start_date;
	var end=data.data.live_info.end_date;
	var current_time=new Date().Format("yyyy-MM-dd HH:mm:ss");
        $("#titles").text(data.data.live_info.title);
        $("#top_title").text(data.data.live_info.title);
        $("#class_name").text(data.data.live_info.class_name);
        $("#description").text(data.data.live_info.description);
        $("#end_date").text(start);
        $("#start_date").text(end);
        if (data.data.live_url.code == 200) {
            if (data.data.live_url.data.play_url != undefined || data.data.live_url.data.play_url != null) {
                var liveurl = data.data.live_url.data.play_url
            }
			
	//判断直播状态
	var live_starts='';
	if (current_time>end) {
		live_starts="直播已结束";
	}else if (current_time<start) {
		live_starts="直播还未开始";
	}else if (liveurl.live_status == 'active') {
		var hls_url = liveurl.hls_url;
		var flash_url = liveurl.flash_url;
		$('<div id="id_test_video"  height:auto;"></div>').appendTo("#live_list");
		if (window.innerWidth < 800) {
		    var player = new TcPlayer('id_test_video', {
			"flv": Base64.decode(flash_url), //增加了一个flv的播放地址，用于PC平台的播放 请替换成实际可用的播放地址
			"m3u8": Base64.decode(flash_url),
			//				"m3u8_hd"   : Base64.decode(flash_url),
			//				"m3u8_sd"   : Base64.decode(flash_url),
			"autoplay": true, //iOS下safari浏览器，以及大部分移动端浏览器是不开放视频自动播放这个能力的
			"coverpic": data.data.live_info.web_image_url,
			"width": '710', //视频的显示宽度，请尽量使用视频分辨率宽度
			"height": '200', //视频的显示高度，请尽量使用视频分辨率高度
			"wording": {
			    1002: "直播还没开始！请耐心等候.....",
			    2048: "请求失败，可能是网络错误！",
			    13: "直播已结束，请稍后再来"
			}
		    });
                } else {
                    var player = new TcPlayer('id_test_video', {
                        "flv": Base64.decode(flash_url), //增加了一个flv的播放地址，用于PC平台的播放 请替换成实际可用的播放地址
                        "m3u8": Base64.decode(flash_url),
                        //				"m3u8_hd"   : Base64.decode(flash_url),
                        //				"m3u8_sd"   : Base64.decode(flash_url),
                        "autoplay": true, //iOS下safari浏览器，以及大部分移动端浏览器是不开放视频自动播放这个能力的
                        "coverpic": data.data.live_info.web_image_url,
                        "width": '710', //视频的显示宽度，请尽量使用视频分辨率宽度
                        "height": '410', //视频的显示高度，请尽量使用视频分辨率高度
                        "wording": {
                            1002: "直播还没开始！请耐心等候.....",
                            2048: "请求失败，可能是网络错误！",
                            13: "直播已结束，请稍后再来"
                        }
                    });
                }	
			}else{
				live_starts="直播断开";
			}
			$("#live_list").text(live_starts);

        } else if (data.data.live_url.code == 410) {
            showPrompt(data.data.live_url.msg);
        }
    }

    var data = {
        "live_id": live_id,
        "uid": cook_uid
    };
	
    ajax_all_Filed("true", "true", "POST", liveinfourl, "json", data, liveinfo);
	//绑定鼠标进入事件
    $('.guestlive_ul').on('mouseenter', 'li', function() { 
        $(this).find('.daos_ms').show();
    });
	//绑定鼠标划出事件
    $('.guestlive_ul').on('mouseleave', 'li', function() {
        $(this).find('.daos_ms').hide();
    });

	//聊天记录
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
        });
        var element = $('.dm-list-cont')[0];
        if (element.scrollHeight - element.scrollTop > element.clientHeight + 50) {
            $('.dm-list-cont').scrollTop(-offsetTop + 152);
        } else {
            $('.dm-list-cont').scrollTop($('.dm-list-cont')[0].scrollHeight);
        }
       //初始化 给底部位置
        if (offsetTop == 0) { 
            $('.dm-list-cont').scrollTop($('.dm-list-cont')[0].scrollHeight);
        }
    }
	
    //提交留言
    $('.sendBtn').on('click', sendMsg);
	
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
				websocket.send(JSON.stringify(live_chatdata));
                $('#send_input').val("");
            } else {
                showLaert('请输入信息');
            }
        }
    }
})
