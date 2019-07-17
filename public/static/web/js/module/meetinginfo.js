$(function() {

    var convention_base = "api/convention/convention_base";
    var history_list_url = 'api/convention/history';

    function convention(data) {
        var convention_info = data.data.convention_info;
        var convention_news = data.data.convention_news;
        var convention_exhibitors = data.data.convention_exhibitors;
        var convention_order = data.data.convention_order;
        storage.setItem('convention_info', JSON.stringify(convention_info));

        //会议  新闻动态  重要日期
        var html = '<div style="font-size: 14px; line-break: 50px; text-align: center;">暂无数据</div>';
        var important_date = htmls(convention_info.important_date);
        if (convention_info) {
            //重要日期
            if (convention_info.important_date) {
                $("#timeday").html(important_date);
            }
            //新闻动态
            if (convention_info.digest) {
                $("#introduce_txt").html(convention_info.digest);
            }
        } else {
            $("#timeday,#introduce_txt").html(html);
        }

        //		if(!convention_info || htmls(convention_info.important_date)== "null") {
        //			$("#timeday").html('<div style="font-size: 14px; line-break: 50px; text-align: center;">暂无数据</div>');
        //		} else {
        //			$("#timeday").html(important_time);
        //		}
        //		if(digest == "null") {
        //			$("#introduce_txt").html('<div style="font-size: 14px; line-break: 50px; text-align: center;">暂无数据</div>');
        //		} else {
        //			$("#introduce_txt").html(digest)
        //		}

        if (cook_uid == null || cook_uid == "") {
            $('<a href="' + pu_url + '">' + '</a>' + '<p>' + '论文发表' + '</p>').appendTo(".mt_nav_rg");
            $('<a href="' + pu_url + '">' + '</a>' + '<p>' + '会议报名' + '</p>').appendTo(".mt_nav_lf");
        } else {
            if (convention_info.class_name == "SIFIC专栏") {
                $('<a href="/annual_meeting">' + '</a>' + '<p>' + '会议报名' + '</p>').appendTo(".mt_nav_lf")
                if (convention_order != null) {
                    $('<a href="/abstract_list?convention_id=' + convention_id + '">' + '</a>' + '<p>' + '论文发表' + '</p>').appendTo(".mt_nav_rg");
                } else {
                    $('<a href="javascript:void(0)" id="fblunwen">' + '</a>' + '<p>' + '论文发表' + '</p>').appendTo(".mt_nav_rg");
                }

            } else {
                $('<a href="/paper?convention_id=' + convention_id + '">' + '</a>' + '<p>' + '论文发表' + '</p>').appendTo(".mt_nav_rg");
                $('<a href="/siginfo?convention_id=' + convention_id + '">' + '</a>' + '<p>' + '会议报名' + '</p>').appendTo(".mt_nav_lf");
            }

        }
        $("#fblunwen").click(function() {
                showLaert("您还未注册会议，请您先点击“会议报名”按钮注册会议后，提交您的论文！");
            })
            //动态新闻
        for (var i = 0; i < convention_news.length; i++) {
            $('<li>' + '<a href="/newsinfo?convention_id=' + convention_id + '&news_id=' + convention_news[i].fid + '">' +
                '<div class="newstext ellipsis">' + convention_news[i].title + '</div>' +
                '<div class="newstime">' + timeStamp2String(convention_news[i].create_time) + '</div>' +
                '</a>' + '</li>').appendTo(".news_ul");
        }

        //机构列表
        for (var i = 0; i < convention_exhibitors.length; i++) {
            var idStr = "";
            if (convention_exhibitors[i].exhibitor_type == 1) {
                idStr = '#sponsor_list_t'
            } else if (convention_exhibitors[i].exhibitor_type == 2) {
                idStr = "#sponsor_list_A";
            } else if (convention_exhibitors[i].exhibitor_type == 3) {
                idStr = "#sponsor_list_B";
            } else if (convention_exhibitors[i].exhibitor_type == 4) {
                idStr = "#sponsor_list_C";
            }
            $('<li style="float:left;"><a href="' + convention_exhibitors[i].web_url +
                '" target="_blank" style="display: block; width: 135px; height: 55px;"><img src="' +
                convention_exhibitors[i].image_url + '"></a></li>').appendTo(idStr);
        }
        $(".str_wrap").height(55 + 'px');
        //支持单位无数据 则隐藏
        for (var i = 0; i < $('.sponsor_list').length; i++) {
            if ($('.sponsor_list').eq(i).find('a').length == 0) {
                $('.sponsor_list').eq(i).hide();
            }
        }

        $('.sponsor_list').each(function() {
            $(this).find('ul').width($(this).find('li').eq(0).width() * $(this).find('li').length)
            $(this).myScroll({
                speed: 20,
                rowWidth: $(this).find('li').eq(0).width()
            })
        })

    }

    var data = {
        "convention_id": convention_id,
        "uid": cook_uid
    };
    ajax_all_Filed("true", "true", "GET", convention_base, "json", data, convention);


    //  历史剪影
    var history_data = {
        "convention_id": convention_id,
        "history_type": 1
    };
    ajax_all_Filed("true", "true", "POST", history_list_url, "json", history_data, historyListFunc); //调用函数

    function historyListFunc(data) {
        var imgList = data.data[0].image_list;
        var str = 0;
        for (var i = 0; i < imgList.length; i++) {
            str += '<li style="width: 240px;height:156px;float:left;"><img style="display:block;width:100%;height:100%;" src="' + imgList[i].file_path + '"></li>'
        }
        $('.history_photo_list ul').html(str);

        $('.history_photo_list').find('ul').width($('.history_photo_list').find('li').eq(0).width() * $('.history_photo_list').find('li').length);
        if ($('.history_photo_list').myScroll) {
            $('.history_photo_list').myScroll({
                speed: 20,
                rowWidth: $('.history_photo_list').find('li').eq(0).width()
            })
        }
    }



})