$(function() {
    var trainingurl = "/api/product/video_detail";
    var pinglunurl = "/api/product/training_comment";
    var examurl = "/api/product/training_exam";
    var pariseurl = "/api/product/training_comment_parise";
    var exam_id = 0;

    function training(data) {
        if (data.code == 422) {
            showLaert(data.msg + '<a href="' + pu_url + '">前往登录</a>');
            $("#alert_btn").click(function() {
                window.location.href = pu_url;
            })
            $(".daytiem_close").click(function() {
                window.location.href = pu_url;
            })
            return false;
        } else if (data.code == 414) {
            return false;
        }

        var expert_list = data.data.expert_list;
        var video_list = data.data.video_list;
        var video_info = data.data.video_info;
        var comment_list = data.data.comment_list;
        var play_url = data.data.play_url;
        var try_see = data.data.try_see;

        var playback_position = data.data.play_info ? data.data.play_info.playback_position : 0;
        var postData = {
            'video_id': video_id,
            'playback_position': playback_position,
            'training_id': training_id,
            'duration': 0,
            'uid': cook_uid,
        };
        var t;
        var video_location = "api/product/video_location";

        function getParams(name) {
            var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)', 'i');
            var r = window.location.search.substr(1).match(reg);
            if (r != null) {
                return decodeURIComponent(r[2]);
            }
            return null;
        }

        var rtmp = getParams('rtmp'),
            flv = getParams('flv'),
            m3u8 = getParams('m3u8'),
            mp4 = getParams('mp4'),
            live = (getParams('live') == 'true' ? true : false),
            coverpic = getParams('coverpic'),
            width = getParams('width'),
            height = getParams('height'),
            volume = getParams('volume'),
            flash = (getParams('flash') == 'true' ? true : false),
            h5_flv = (getParams('h5_flv') == 'true' ? true : false),
            autoplay = (getParams('autoplay') == 'true' ? true : false),
            log = getParams('log');
        //console.log(Base64.decode(play_url.data[0]))
        var options = {
            //mp4: mp4 || Base64.decode(play_url.data[0]),
            mp4: Base64.decode(play_url.data[0]),
            //			mp4_hd: Base64.decode(play_url.data[1]),
            //			mp4_sd: Base64.decode(play_url.data[2]),
            //          mp4 :'//1256993030.vod2.myqcloud.com/d520582dvodtransgzp1256993030/7732bd367447398157015849771/v.f40.mp4',
            //          mp4_hd :'//1256993030.vod2.myqcloud.com/d520582dvodtransgzp1256993030/7732bd367447398157015849771/v.f30.mp4',
            //          mp4_sd : '//1256993030.vod2.myqcloud.com/d520582dvodtransgzp1256993030/7732bd367447398157015849771/v.f20.mp4',
            clarity: 'od',
            clarityLabel: {
                od: '原画',
                hd: '高清',
                sd: '标清'
            },
            coverpic: coverpic || {
                style: 'cover',
                src: video_info.web_image_url
            },
            autoplay: autoplay ? true : false,
            live: live,
            width: width || '710',
            height: height || '440',
            listener: function(msg) {
                if (play_url.code == 410) {
                    var timeDisplay;
                    //用秒数来显示当前播放进度
                    timeDisplay = Math.floor(player.currentTime());
                    if (timeDisplay >= try_see) {
                        showLaert("试看结束")
                        $("body").on('click', '#alert_btn', function() {
                            player.stop()
                        })
                    }
                } else if (play_url.code == 200) {
                    var currentTime = player.currentTime() * 1000
                    postData.playback_position = currentTime;
                    postData.duration = postData.duration + currentTime;
                }

                if (msg.type == "load") {

                } else if (msg.type == "play") {

                } else if (msg.type == "playing") {

                } else if (msg.type == "timeupdate") {

                } else if (msg.type == "progress") {

                } else if (msg.type == "pause") {
                    stopCount()
                } else if (msg.type == "ended") {
                    stopCount()
                }
            }
        };

        var player = new TcPlayer('video-container', options);
        player.currentTime(playback_position / 1000);

        window.player = player;

        //		function timerCount() {
        //			t = setTimeout(function() {
        //				uploadAction();
        //				timerCount();
        //			}, 5000);
        //		}
        //		 停止
        function stopCount() {
            clearTimeout(t);
        }

        function uploadtime(data) {
            if (data.code != 200) { //超时提醒
                //				showLaert(data.msg)
                //				$("body").on('click', '#alert_btn', function() {
                //					player.stop()
                //				})
            }
        } 
        function uploadAction() {
            var currentTime = player.currentTime() * 1000
            postData.playback_position = currentTime;
            postData.duration = postData.duration + currentTime;
            ajax_all_Filed("true", "true", "POST", video_location, "json", postData, uploadtime); //调用函数
            postData.duration = 0;
        }

        $("#class_name").text(video_info.class_name);
        $("#title").text(video_info.title);
        $("#title2").text(video_info.title);
        $("#description").text(video_info.description);

        for (var i = 0; i < expert_list.length; i++) {
            $('<li>' + '<a href="#">' +
                '<img src="' + expert_list[i].web_image_url + '" />' +
                '</a>' +
                '<div class="daos_ms">' +
                '<div class="daos_top">' +
                '</div>' +
                '<div class="daos_txt">' + expert_list[i].introduction + '</div>' +
                '</div>' +
                '</li>').appendTo(".guestlive_ul");
        }
        $('.guestlive_ul').on('mouseenter', 'li', function() { //绑定鼠标进入事件
            $(this).find('.daos_ms').show();
        });
        $('.guestlive_ul').on('mouseleave', 'li', function() { //绑定鼠标划出事件
            $(this).find('.daos_ms').hide();
        });

        //课程遍历
        var str = "";
        for (var i = 0; i < video_list.length; i++) {
            str += '<li class="mulu_li">';
            str += video_list[i].section_name;
            str += '<ul>';
            for (var j = 0; j < video_list[i].children.length; j++) {
                if (video_list[i].children[j].main_type == 2) {
                    str += '<li><a href="/recordinfo?training_id=' + training_id + '&video_id=' + data.data.video_list[i].children[j].main_id + '" ';
                    if (video_list[i].children[j].play_finish === 1) {
                        str += 'style="background: url(/static/web/images/icon_nostar.png) no-repeat; color: #232323;"';
                    } else if (video_list[i].children[j].play_finish === 0) {
                        str += 'style="background: url(/static/web/images/icon_progress.png) no-repeat; color: #232323;"';
                    }
                    if (data.data.video_list[i].children[j].main_id == video_id) {
                        str += 'style="background: url(/static/web/images/icon_progress.png) no-repeat; color: #232323;"';
                    }
                    str += '>' + video_list[i].children[j].name + '</a></li>';

                } else {
                    str += '<li class="kaoshi" title="' + data.data.video_list[i].children[j].main_id + '"><a href="javascript:void(0)"';
                    if (video_list[i].children[j].pass === 1) {
                        str += 'style="background: url(/static/web/images/icon_textedsmall.png) no-repeat; color: #232323;"';
                    } else if (video_list[i].children[j].pass === 0) {
                        str += 'style="background: url(/static/web/images/icon_textsmall.png) no-repeat; color: #232323;"';
                    } else {
                        str += 'style="background: url(/static/web/images/icon_textsmall.png) no-repeat;"';
                    }
                    str += '>' + video_list[i].children[j].name + '</a></li>';
                }

            }
            str += '</ul>';
            str += '</li>';

        }
        $(".peix_video_ul").append(str);

        $(".xuexi_btn").click(function() {
            $(this).attr("href", "/recordinfo?record_id=" + video_list[i].children[j].main_id);
        })

        //评论遍历
        for (var i = 0; i < comment_list.length; i++) {
            var zan = comment_list[i].is_praise == 0 ? 'zan1' : 'zan2';
            $('<div class="review_ct">' +
                '<div class="review_ct_img">' + '<img src="' + comment_list[i].web_image_url + '" />' + '</div>' +
                '<div class="review_ct_text">' +
                '<div class="review_ct_user">' + '<span class="review_ct_name">' + comment_list[i].nick_name + '</span>' + '<span class="review_ct_time">' + comment_list[i].create_time + '</span>' + '</div>' +
                '<div class="review_content">' + comment_list[i].content + '</div>' +
                '<div class="' + zan + ' zanlist" id="' + comment_list[i].fid + '">' + comment_list[i].praise_num + '</div>' +
                '</div>' +
                '</div>').appendTo(".review_list");
        }
    }
    var data = {
        'training_id': training_id,
        'video_id': video_id,
        'uid': cook_uid
    };

    ajax_all_Filed("true", "true", "POST", trainingurl, "json", data, training);


    //发起评论
    $(".fab_btn").click(function() {
        var content = $("#content").val()
        var uid = cook_uid;
        if (content == "") {
            showLaert("请填写内容！")
        }
		
        function publish(data) {
			 showLaert(data.msg);
            if(data.code == 200){
				//评论追加
				$('<div class="review_ct">' +
					'<div class="review_ct_img">' + '<img src="' + data.data.web_image_url + '" />' + '</div>' +
					'<div class="review_ct_text">' +
					'<div class="review_ct_user">' + '<span class="review_ct_name">' + data.data.nick_name + '</span>' + '<span class="review_ct_time">' + data.data.create_time + '</span>' + '</div>' +
					'<div class="review_content">' + data.data.content + '</div>' +
					'<div class="zan1 zanlist" id="' + data.data.fid + '">' + data.data.praise_num + '</div>' +
					'</div>' +
					'</div>').prependTo(".review_list");
					$("#content").val("");
            }
        }
        var data = {
            'training_id': training_id,
            'video_id': video_id,
            'uid': uid,
            'content': content
        };
        ajax_all_Filed("true", "true", "GET", pinglunurl, "json", data, publish); //调用函数
    })

    //点赞
    $(".review_list").on('click', '.zanlist', function() {
        var comment_id = $(this).prop("id");
		var is=$(this);
        function parise(data) {
			showLaert(data.msg);			
            if (data.code == 200) {	
				is.removeClass("zan1").addClass("zan2");
				is.html(data.cnt);
            }
        }
        var data = {
            'training_id': training_id,
            'uid': cook_uid,
            'video_id': video_id,
            'comment_id': comment_id
        };
        ajax_all_Filed("true", "true", "GET", pariseurl, "json", data, parise); //调用函数
    })


    $('.peix_video_ul').on('click', '.kaoshi', function() {
        $("#recrd").show();
        if ($(".test_subject").text().length > 0) {
            $(".test_subject").text("");
        }

        exam_id = $(this).attr("title");

        function exam(data) {
            var exam_info = data.data.exam_info;
            var exam_infolist = data.data.exam_info.subject_list;
            $("#exam_name").text(exam_info.exam_name);
            str = "";
            for (var i = 0; i < exam_infolist.length; i++) {
                str += '<div class="subject">';
                str += '<h2>';
                str += exam_infolist[i].subject_name;
                str += '(' + exam_infolist[i].score + '分)';
                str += '</h2>';
                for (var j = 0; j < exam_infolist[i].option_list.length; j++) {
                    if (exam_infolist[i].subject_type == 1) {
                        str += '<div class="subject_ct">';
                        str += '<label>';
                        str += '<input type="radio" name="' + exam_infolist[i].fid + '" value="' + exam_infolist[i].option_list[j].fid + '"> ';
                        str += exam_infolist[i].option_list[j].option_name;
                        str += '</label>';
                        str += '</div>';
                    } else if (exam_infolist[i].subject_type == 2) {
                        str += '<div class="subject_ct">';
                        str += '<label>';
                        str += '<input type="checkbox" name="' + exam_infolist[i].fid + '" value="' + exam_infolist[i].option_list[j].fid + '"> ';
                        str += exam_infolist[i].option_list[j].option_name;
                        str += '</label>';
                        str += '</div>';
                    } else {
                        str += '<div class="subject_ct">';
                        str += '<label>';
                        str += '<input type="radio" name="' + exam_infolist[i].fid + '" value="' + exam_infolist[i].option_list[j].fid + '"> ';
                        str += exam_infolist[i].option_list[j].option_name;
                        str += '</label>';
                        str += '</div>';
                    }

                }

                str += '</div>';
                str += '</div>';
            }
            $(".test_subject").append(str);
        }
        var data = {
            'training_id': training_id,
            'exam_id': exam_id
        };
        ajax_all_Filed("true", "true", "GET", examurl, "json", data, exam); //调用函数	
    });

    $(".daytiem_close").click(function() {
        $("#recrd").hide();
    })
    $(".daytiem_close").click(function() {
        $("#score_tis").hide();
    })

    //考试提交
    var training_uploadurl = "/api/product/training_upload";

    $("#training_upload").click(function() {
        var data = $("#recor_form").serializeArray();

        var subjectList = Array();
        if (data.length > 0) {
            for (var i = 0; i < data.length; i++) {
                var child = data[i];
                var flag = false;
                var k = 0;
                for (var j = 0; j < subjectList.length; j++) {
                    if (subjectList[j].subject_id == child.name) {
                        flag = true;
                        k = j;
                    }
                }
                if (flag) {
                    subjectList[k].option_ids += ',' + child.value;
                } else {
                    var subject = {
                        'subject_id': child.name,
                        'option_ids': child.value
                    }
                    subjectList.push(subject);
                }
            }
        }

        function training_upload(data) {
            var right_num = data.data.right_num;
            var wrong_num = data.data.wrong_num;
            var score_user = data.data.score_user;
            if (data.code == 200) {
                //showLaert(data.msg)
                $("#recrd").hide();
                if (data.data.pass == 0) {
                    $("#subject_title").text("很遗憾，您未通过此次考试！");
                    $("#subject_txt").text("本次考试，您答对了" + right_num + "道题，答错了" + wrong_num + "道题，得分：" + score_user + "分，未达到达标要求。 请继续答题");
                } else {
                    $("#subject_title").text("恭喜你，您已通过此次考试！");
                    $("#subject_txt").text("本次考试，您答对了" + right_num + "道题，答错了" + wrong_num + "道题，得分：" + score_user + "分，已达到达标要求。 请继续观看下面视频");
                }
                $("#score_tis").show();
            }
        }

        var data = {
            'uid': cook_uid,
            'exam_id': exam_id,
            exam_data: JSON.stringify(subjectList)
        };
        ajax_all_Filed("true", "true", "POST", training_uploadurl, "json", data, training_upload); //调用函数	

        $("#score_btn").click(function() {
            $("#score_tis").hide();
        })

    })

})
