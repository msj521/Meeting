<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:95:"D:\phpStudy\PHPTutorial\WWW\sific_year\public/../application/web\view\meeting\meeting_info.html";i:1560221370;s:78:"D:\phpStudy\PHPTutorial\WWW\sific_year\application\web\view\public\header.html";i:1556526972;s:83:"D:\phpStudy\PHPTutorial\WWW\sific_year\application\web\view\public\meeting_nav.html";i:1553481696;s:77:"D:\phpStudy\PHPTutorial\WWW\sific_year\application\web\view\public\mbxue.html";i:1558692744;s:83:"D:\phpStudy\PHPTutorial\WWW\sific_year\application\web\view\public\meet_center.html";i:1558690289;s:79:"D:\phpStudy\PHPTutorial\WWW\sific_year\application\web\view\public\footer2.html";i:1552891185;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=.4,minimum-scale=0.3, maximum-scale=2.0, user-scalable=yes">
    <meta name="description" content="第15届上海国际医院感染控制论坛（SIFIC）定于2019年5月30日-6月2日在上海跨国采购会展中心召开，同期还将召开第3届东方耐药与感染大会（OCAMRI）">
    <meta name="Keywords" content="SIFIC,SIFIC 2019,SIFIC 2019年会报名,第15届上海国际医院感染控制论坛">
    <title>SIFIC 2019会议</title>
    <link rel="stylesheet" href="/static/web/css/bootstrap.css" />
    <link rel="stylesheet" href="/static/web/css/pulic.css" />
    <link rel="stylesheet" type="text/css" href="/static/web/css/banner.css" />
    <link rel="stylesheet" type="text/css" href="/static/web/css/liveinfo.css" />
    <link rel="stylesheet" type="text/css" href="/static/web/css/pagination.css" />
    <link rel="stylesheet" href="/static/web/css/idangerous.swiper.css">
    <script type="text/javascript" src="/static/web/libs/jquery/jquery.js"></script>
    <script type="text/javascript" src="/static/web/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="/static/web/js/md5.js"></script>
    <script type="text/javascript" src="/static/web/js/ajax.js"></script>
    <script type="text/javascript" src="/static/web/js/jquery.pagination.js"></script>
    <script type="text/javascript" src="/static/web/js/getQueryString.js"></script>
    <script type="text/javascript" src="/static/web/js/pdfobject.js"></script>
</head>

<body>
<style type="text/css">
    .str4 a {
        margin-right: 10px;
    }
    
    .str4 a img {
        width: auto;
        height: auto;
        max-width: 100%;
        max-height: 100%;
    }
    
    .meet_main {
        width: 100%;
        background: rgba(245, 255, 252, 1);
    }
    
    .center1000 {
        width: 1000px;
        margin: 0 auto;
        padding: 60px 0;
    }
    
    .meet_main_ul {
        height: 500px;
    }
    
    .meet_main_li {
        float: left;
        width: 480px;
        height: 500px;
        background: rgba(255, 255, 255, 1);
        box-shadow: 0px 0px 30px 0px rgba(0, 92, 244, 0.2);
        border-radius: 10px;
    }
    
    .meet_news {
        margin-left: 40px;
    }
    
    .meet_main_title {
        height: 87px;
        box-sizing: border-box;
        padding: 0 28px 0 30px;
        background: #0C7753;
        border-radius: 10px 10px 0 0;
    }
    
    .meet_main_title span {
        color: rgba(255, 255, 255, 1);
        line-height: 40px;
        font: 500 28px/87px 'PingFangSC-Medium';
        float: left;
    }
    
    .meet_main_title a {
        text-decoration-line: none;
        color: rgba(255, 255, 255, 1);
        line-height: 28px;
        font: 500 20px/87px 'PingFangSC-Medium';
        float: right;
    }
    
    .meet_main_content {
        box-sizing: border-box;
        width: 100%;
        height: 413px;
        padding: 16px 30px 0;
    }
    
    .meet_news_list {
        height: 22px;
        margin-top: 16px;
        font-size: 16px;
        font-family: PingFangSC-Medium;
        font-weight: 500;
        color: rgba(98, 106, 128, 1);
        line-height: 22px;
    }
    
    .meet_new_container {
        float: left;
    }
    
    .meet_new_container::before {
        content: "";
        float: left;
        width: 6px;
        height: 6px;
        background: rgba(170, 170, 170, 1);
        border-radius: 50%;
        margin: 8px 8px 0 0;
    }
    
    .meet_new_container a {
        float: left;
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-size: 16px;
        font-family: PingFangSC-Medium;
        font-weight: 500;
        color: rgba(98, 106, 128, 1);
        line-height: 22px;
    }
    
    .meet_new_container i {
        float: left;
        width: 40px;
        height: 20px;
        margin-left: 6px;
    }
    
    .meet_main_content p {
        margin-top: 16px;
    }
    
    .meet_main_content p::before {
        content: "";
        display: inline-block;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: rgba(170, 170, 170, 1);
    }
    
    .meet_main_content p span {
        font-size: 16px !important;
        font-family: PingFangSC-Medium !important;
        font-weight: 500 !important;
        color: rgba(98, 106, 128, 1) !important;
        line-height: 22px !important;
    }
    
    .meet_main_content li.new i {
        background: url('/static/web/images/new.png') no-repeat center;
    }
    
    .meet_main_date {
        float: right;
    }
    
    .qr_code_box {
        position: fixed;
        right: 0;
        bottom: 0;
        width: 80px;
        height: 212px;
        z-index: 5;
        box-shadow: 0px 0px 30px 0px rgba(12, 119, 83, 0.1);
        border-radius: 8px 0px 0px 8px;
    }
    
    .qr_code_box .qr_code_box_li {
        background: #fff;
        cursor: pointer;
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        height: 70px;
        z-index: 10;
        transition: .3s;
    }
    
    .qr_code_box .qr_code_box_li_chet {
        background: #fff url(static/web/images/Wechat_uncheck.png) center no-repeat;
        border-bottom: 1px solid #ECECEC;
    }
    
    .qr_code_box .qr_code_box_li_chet:hover {
        background: #fff url(static/web/images/Wechat_check.png) center no-repeat;
    }
    
    .qr_code_box .qr_code_box_li_android {
        background: #fff url(static/web/images/Android_uncheck.png) center no-repeat;
        border-bottom: 1px solid #ECECEC;
    }
    
    .qr_code_box .qr_code_box_li_android:hover {
        background: #fff url(static/web/images/Android_check.png) center no-repeat;
        border-bottom: 1px solid #ECECEC;
    }
    
    .qr_code_box .qr_code_box_li_iphone {
        background: #fff url(static/web/images/Apple_uncheck.png) center no-repeat;
    }
    
    .qr_code_box .qr_code_box_li_iphone:hover {
        background: #fff url(static/web/images/Apple_check.png) center no-repeat;
    }
    
    .qr_code_box .qr_code_img {
        position: absolute;
        left: 0;
        top: 0;
        z-index: 9;
        width: 160px;
        height: 190px;
        background: rgba(255, 255, 255, 1);
        box-shadow: 0px 0px 30px 0px rgba(12, 119, 83, 0.1);
        border-radius: 4px;
        padding: 10px 20px;
        font-size: 14px;
        font-family: PingFangSC-Medium;
        font-weight: 500;
        color: rgba(72, 78, 94, 1);
        line-height: 20px;
        text-align: center;
    }
    
    .qr_code_img_chet p {
        background: #fff url(static/web/images/qr_code_chet.png) center;
        background-size: 120px 120px;
    }
    
    .qr_code_img_android p {
        background: #fff url(static/web/images/qr_code_android.png) center;
        background-size: 120px 120px;
    }
    
    .qr_code_img_iphone p {
        background: #fff url(static/web/images/qr_code_iphone.png) center;
        background-size: 120px 120px;
    }
</style>
<style type="text/css">
    dl,
    dd,
    dt {
        margin: 0;
        padding: 0;
    }
    
    .conter980 {
        width: 1000px !important;
        margin: 0 auto;
    }
    
    .conter960 {
        margin: 0 auto;
    }
    
    .str4 a {
        margin-right: 10px;
    }
    
    .str4 a img {
        width: auto;
        height: auto;
        max-width: 100%;
        max-height: 100%;
    }
    
    .meet-navbarfixed-top {
        width: 100%;
        height: 60px;
        position: fixed;
        top: 0;
        background: #0C7753;
        z-index: 10;
    }
    
    .meet-margin {
        width: 1000px;
        margin: 0 auto;
    }
    
    .meet-nav-container li {
        float: left;
        width: 125px;
        text-align: center;
        height: 100%;
        cursor: pointer;
    }
    
    .meet-nav-container li.active {
        background: rgba(35, 35, 35, 0.2);
    }
    
    .meet-nav-container li:hover {
        background: rgba(35, 35, 35, 0.2);
    }
    
    .meet-nav-container li:hover dd {
        display: block;
    }
    
    .meet-nav-container li dd {
        display: none;
        transition: all .3s ease;
    }
    
    .meet-nav-container li dl dt {
        height: 60px;
        box-sizing: border-box;
    }
    
    .meet-nav-container li dl dt span {
        display: block;
        width: 100%;
        line-height: 56px;
    }
    
    .meet-nav-container li dl dt span a {
        display: block;
        width: 100%;
        height: 100%;
    }
    
    .meet-nav-container li dl dt a {
        color: #fff;
    }
    
    .meet-nav-container li dl dt .meet_nav_b {
        width: 60px;
        height: 4px;
        margin: 0 auto;
        background: rgba(255, 255, 255, 1);
        display: none;
        border-radius: 2px;
    }
    
    .meet-nav-container li span {
        font: 500 18px/52px '微软雅黑';
        color: rgba(255, 255, 255, 1);
    }
    
    .meet_second_nav {
        background: #0C7753;
        padding-top: 10px;
    }
    
    .meet_second_nav p {
        margin: 0;
        padding: 10px 0;
        height: 20px;
        box-sizing: content-box;
    }
    
    .meet_second_nav p a {
        font: 500 14px/20px '微软雅黑';
        color: rgba(255, 255, 255, 1);
        cursor: pointer;
    }
    
    .meet_nav_fill {
        height: 60px;
    }
</style>

<div class="meet-navbarfixed-top">
    <div class="meet-margin meet-margin-nav">
        <ul class="meet-nav-container">

        </ul>
    </div>
</div>
<div class="meet_nav_fill"></div>

<script>
    var navLlist = Array;
    navLlist = [<?php echo $html ?>]; //后端返回的导航数据
    $(function() {
        str = "";
        var navlength = 'width:' + (navLlist.length * 125) + 'px';
        //根据导航栏的数目设置导航栏的宽度
        $('.meet-margin').attr({
            style: navlength
        });
        //对数据进行处理拼接渲染
        var navUrlStr = document.location.search; //获取浏览器地址栏的参数
        var firstNavId = getQueryString('nav_id'); //获取地址栏一级菜单的字段值
        var secondNavId = getQueryString('suid'); //获取地址栏二级菜单的字段值

        for (var i = 0; i < navLlist.length; i++) {
            if (navLlist[i].subMenu == '') {
                str += "<li><dl><dt><span><a href='" + navLlist[i].url + "?convention_id=" + convention_id + "&nav_id=" + navLlist[i].id + "'>" + navLlist[i].name + "</a></span><div class='meet_nav_b'></div></dt></dl></li>"
            } else {
                str += "<li><dl><dt><span><a>" + navLlist[i].name + "</a></span><div class='meet_nav_b'></div></dt><dd><div class='meet_second_nav'>"
                for (var j = 0; j < navLlist[i].subMenu.length; j++) {

                    if (i + 1 == firstNavId && j + 1 == secondNavId) {

                        str += "<p style='background:rgba(51,51,51,0.4);'><a href='" + navLlist[i].subMenu[j].url + "?convention_id=" + convention_id + "&nav_id=" + navLlist[i].id + "&suid=" + navLlist[i].subMenu[j].suid + "'>" + navLlist[i].subMenu[j].name + "</a></p>";
                    } else {

                        str += "<p><a href='" + navLlist[i].subMenu[j].url + "?convention_id=" + convention_id + "&nav_id=" + navLlist[i].id + "&suid=" + navLlist[i].subMenu[j].suid + "'>" + navLlist[i].subMenu[j].name + "</a></p>";
                    }
                }
                str += "</div></dd></dl></li>"
            }

        }
        $('.meet-nav-container').html(str);

        //根据路由判断导航激活状态
        var meetUrl = document.location.search; //获取路由的携带参数
        //为空的时候，会议首页中心处于激活状态
        if (!meetUrl) {
            $('.meet_nav_b').hide().end().eq(0).show();
        } else {
            //携带参数没有nav_id时，让导航栏第一个处于激活状态
            if (meetUrl.split('nav_id=').length < 2) {
                $('.meet_nav_b').hide().end().eq(0).show();
            } else {
                var meetNavId = meetUrl.split('nav_id=')[1][0] - 1; //判断携带参数对应的nav_id的值来渲染对应导航栏的激活状态
                $('.meet_nav_b').hide().eq(meetNavId).show()
            }
        }

        //判断设备屏幕宽度
        if (window.innerWidth < 800) {
            $('.meet-navbarfixed-top').on('click', 'li', function() {
                $(this).find('dd').show();
            })
        } else {

        }

    })
</script> <style>
    .meet_banner {
        width: 100%;
    }
    
    .meet_banner .swiper-slide {
        width: 100%;
        height: 100%;
    }
    
    .meet_banner .swiper-slide a {
        display: block;
        width: 100%;
        height: 100%;
    }
    
    .meet_banner .swiper-slide img {
        display: block;
        height: 100%;
        width: 100%;
    }
    
    .meet_banner .swiper-pagination span {
        width: 30px;
        border-radius: 0;
    }
</style>
<!-- 轮播图 -->
<div class="swiper-container meet_banner">
    <div class="swiper-wrapper" style="height:100%;">

    </div>
</div>
<div style="width: 1000px;margin:0 auto;height: 60px;overflow: hidden;font: 400 20px/60px '微软雅黑';display:none;" class="clear newsestBox">
    <p style="float:left;">最新新闻：</p>
    <div class="newsest" style="float:left;margin-left: 10px;">
        <ul class="news-wrapper">

        </ul>
    </div>
</div>

<script src="/static/web/js/idangerous.swiper.min.js"></script>
<script>
    $(function() {
        //根据设备计算轮播图的高度
        if (navigator.userAgent.indexOf('iPhone') > 0 || navigator.userAgent.indexOf('Android') > 0) {
            $('.meet_banner').css({
                height: window.innerHeight * .3 + 'px'
            });
        } else {
            $('.meet_banner').css({
                height: window.innerHeight * .55 + 'px'
            });
        }


        function homelist(data) {
            if (data.code == 414) {
                return false;
            }
            var banner = data.data.banner_list;
            var banner_str = '';
            for (var i = 0; i < banner.length; i++) {
                banner_str += "<div class='swiper-slide' style='width:100%;height:100%;'><a href='" + banner[i].location_url + "'><img src='" + banner[i].web_image_url + "' title='" + banner[i].title + "' style='display:block;width:100%;height:100%;'></a></div>"
            }

            $('.swiper-wrapper').html(banner_str); //轮播图字符串渲染
            //配置轮播图
            var mySwiper = new Swiper('.swiper-container', {
                // loop: true,
                grabCursor: true,
                autoplay: 3000
            })
        }
        var bannerurl = "/api/index/first_page"; //轮播图数据所在接口
        var home_data = {};

        ajax_all_Filed("true", "true", "POST", bannerurl, "json", home_data, homelist); //封装ajax得到数据执行homelist方法	
    })

    $(function() {
		if ( window.location.href.split('?')[0] == "http://2019.sific.com.cn/convention" || window.location.href == 'http://2019.sific.com.cn/' ) {
			$('.newsestBox').show();
		}
        var convention_news;
        if (localStorage_info != null && localStorage_info != "" && localStorage_info.fid == convention_id) {
            var localStorage_info = JSON.parse(localStorage.getItem("convention_info"))
            $("#class_name").text(localStorage_info.class_name);
            $("#title").text(localStorage_info.convention_name)
            $("#meeting_img").attr({
                src: localStorage_info.top_image_url,
                alt: ""
            })
        } else {
            var mbxurl = "api/convention/convention_base";
            var data = {
                "convention_id": convention_id
            };
            ajax_all_Filed("true", "true", "GET", mbxurl, "json", data, mbx); //调用	
        }

        function mbx(data) {
            var convention_info = data.data.convention_info;
            convention_news = data.data.convention_news; //最新新闻

            if (convention_info != null) {
                storage.setItem('convention_info', JSON.stringify(data.data.convention_info));
                $("#class_name").text(convention_info.class_name);
                $("#title").text(convention_info.convention_name)
                $("#meeting_img").attr({
                    src: convention_info.top_image_url,
                    alt: ""
                })
            }

            

			var str = '';
			for (var i = 0; i < convention_news.length; i++) {
				str += '<li><a href="/newsinfo?convention_id=47&news_id=' + convention_news[i].fid + '">' + convention_news[i].title + '</a></li>'
			}
			$('.news-wrapper').html(str);

			setInterval(() => {
				scroll()
			}, 2500);


        }

        function scroll() {
            $(".newsest ul")
                .stop()
                .animate({
                    "margin-top": "-60px"
                }, function() {
                    $(".newsest ul li:eq(0)").appendTo($(".newsest ul"));
                    $(".newsest ul").css({
                        "margin-top": 0
                    });
                });
        }
    })
</script> <style type="text/css">
    .conter1000 {
        width: 1000px;
        margin: 0 auto;
        padding: 60px 0;
        background: #fff;
    }
    
    .conter1000::after {
        content: "";
        display: block;
        clear: both;
    }
    
    .meet-center {
        width: 100%;
        background: rgba(255, 255, 255, 1)
    }
    
    .meet-center-ul {
        width: 100%;
    }
    
    .meet-center-ul li:hover {
        box-shadow: 0px 0px 30px 0px rgba(6, 114, 227, 0.3);
    }
    
    .meet-center-ul li:hover .meet_login {
        background-image: url(static/web/images/file_copy.png)
    }
    
    .meet-center-ul li:hover .meet_paper {
        background-image: url(static/web/images/newspaper_copy.png)
    }
    
    .meet-center-ul li:hover .meet_user {
        background-image: url(static/web/images/id-card_copy.png)
    }
    
    .meet-center-ul li:hover .meet_select {
        background-image: url(static/web/images/browser_active.png)
    }
    
    .meet-center-ul li:hover p {
        color: #0C7753;
    }
    
    .meet-center-li {
        width: 220px;
        height: 200px;
        box-shadow: 0px 0px 30px 0px rgba(0, 92, 244, 0.1);
        border-radius: 10px;
        float: left;
        margin-right: 40px;
    }
    
    .meet-center-ul li:last-child {
        margin-right: 0;
    }
    
    .meet-center-li a {
        display: block;
        width: 100%;
        height: 100%;
    }
    
    .meet_login {
        background: #fff url(static/web/images/file.png) 80px 40px no-repeat;
    }
    
    .meet_paper {
        background: #fff url(static/web/images/newspaper.png) 80px 40px no-repeat;
    }
    
    .meet_user {
        background: #fff url(static/web/images/id-card.png) 80px 40px no-repeat;
    }
    
    .meet_select {
        background: #fff url(static/web/images/browser.png) 80px 40px no-repeat;
    }
    /* .meet-center-li img {
		display: block;
		margin: 40px auto;
	} */
    
    .meet-center-li p {
        text-align: center;
        height: 33px;
        font-size: 24px;
        font-family: PingFangSC-Medium;
        font-weight: 500;
        color: rgba(72, 78, 94, 1);
        line-height: 33px;
        padding-top: 127px;
    }
    
    .guest_banner {
        position: relative;
    }
    
    .swiper-container-guest {
        width: 920px;
        height: 120px;
        margin: 0 auto;
        overflow: hidden;
        position: relative;
    }
    
    .swiper-container-guest img {
        width: 80px;
        height: 80px;
        display: block;
        margin: 20px auto;
        border-radius: 50%;
        box-shadow: 0px 0px 14px 0px rgba(12, 119, 83, 0.3);
        transition: .3s;
    }
    
    .swiper-container-guest .swiper-slide-active img {
        width: 100px;
        height: 100px;
        margin: 10px auto;
    }
    
    .guest_btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        position: absolute;
        transition: .3s;
        cursor: pointer;
        box-sizing: border-box;
        border: 0;
    }
    
    .guest_btn_left {
        left: 0;
        top: 30%;
        background: #fff url(static/web/images/left_uncheck.png) center no-repeat;
    }
    
    .guest_btn_left:hover {
        background: #fff url(static/web/images/left_check.png) center no-repeat;
    }
    
    .guest_btn_right {
        right: 0;
        top: 30%;
        background: #fff url(static/web/images/right_unckeck.png) center no-repeat;
    }
    
    .guest_btn_right:hover {
        background: #fff url(static/web/images/right_check.png) center no-repeat;
    }
    
    .swiper-wrapper-guest {
        width: 100%;
        height: 100%;
    }
    
    .swiper-wrapper-guest .swiper-slide {
        width: 184px !important;
        height: 100%;
    }
</style>
<!-- 会议报名 -->
<div class="meet-center">
    <div class="conter1000" style="padding-top:0px;">
        <ul class="meet-center-ul" style="height:200px;">
            <li class="meet-center-li meet_login_li">
                <!-- <a class="meet_login">
                        <p>会议报名</p>
                    </a> -->
            </li>
            <li class="meet-center-li meet_paper_li">
                <!-- <a class="meet_paper">
                        <p>论文发表</p>
                    </a> -->
            </li>
            <li class="meet-center-li meet_user_li">
                <!-- <a class="meet_user">
                        <p>个人中心</p>
                    </a> -->
            </li>
            <li class="meet-center-li meet_select_li">
                <!-- <a class="meet_select">
                    <p>评优报名</p>
                </a> -->
            </li>
        </ul>
        <h3 style="text-align:center;font-size:30px;font-family:MicrosoftYaHei-Bold;font-weight:bold;color:rgba(72,78,94,1);line-height:40px;margin:40px 0;">演讲嘉宾</h3>
        <div class="guest_banner">
            <div class="swiper-container-guest">
                <div class="swiper-wrapper-guest">

                </div>
            </div>
            <button class="guest_btn_left guest_btn"></button>
            <button class="guest_btn_right guest_btn"></button>
        </div>
        <div class="guest_msg" style="text-align:center;font-size:24px;font-family:MicrosoftYaHei-Bold;font-weight:bold;color:rgba(72,78,94,1);line-height:31px;margin:30px 0 30px;height: 31px;"></div>
        <a href="/expertlist?convention_id=47&nav_id=4&suid=1" class="guest_to_more">更多嘉宾</a>
    </div>
</div>
<script>
    $(function() {
        var guest_msg_url = 'api/convention/expert_list'; //演讲嘉宾数据接口
        var interval_time = null;
        var guest_data = {
            convention_id: convention_id
        }
        ajax_all_Filed("true", "true", "GET", guest_msg_url, "json", guest_data, guest_banner_func);

        function guest_banner_func(data) {
            // var num = data.data.expert_list.length;
            var num = 15;
            var expert_list = data.data.expert_list.slice(0, 15);
            var str = '';
            for (var i = 0; i < num; i++) {
                str += '<div class="swiper-slide"><img src="' + data.data.expert_list[i].web_image_url + '" alt=""></div>'
            }
            $('.swiper-wrapper-guest').html(str);
            var mySwiper = new Swiper('.swiper-container-guest', {
                    wrapperClass: 'swiper-wrapper-guest',
                    loop: true, //可选选项，开启循环
                    simulateTouch: true,
                    slidesPerView: 5,
                    centeredSlides: true,
                    onSlideClick: function(swiper) {
                        if (swiper.activeLoopIndex === swiper.clickedSlideLoopIndex) {
                            window.open('/expertinfo?convention_id=' + convention_id + '&expert_id=' + expert_list[computeIndex(swiper.clickedSlideLoopIndex, num)].fid)
                            return;
                        }
                        if (swiper.clickedSlideLoopIndex > num - 2) {
                            mySwiper.swipeTo(swiper.clickedSlideLoopIndex - num, 300, true);
                        } else if (swiper.clickedSlideLoopIndex < -3) {
                            mySwiper.swipeTo(num + swiper.clickedSlideLoopIndex, 300, true);
                        } else {
                            mySwiper.swipeTo(swiper.clickedSlideLoopIndex, 300, true);
                        }
                    },
                    onSlideChangeEnd: function(swiper) {
                        $('.guest_msg').html('<a href="/expertinfo?convention_id=' + convention_id + '&expert_id=' + expert_list[computeIndex(swiper.activeLoopIndex, num)].fid + '">' + expert_list[computeIndex(swiper.activeLoopIndex, num)].expert_name + '</a>');
                        clearInterval(interval_time);
                        auto_play();
                    }
                })
                //默认居中的active
            mySwiper.swipeTo(Math.floor(num / 2), 0, false);
            $('.guest_msg').html('<a href="/expertinfo?convention_id=' + convention_id + '&expert_id=' + expert_list[Math.floor(num / 2)].fid + '">' + expert_list[Math.floor(num / 2)].expert_name + '</a>');


            $('.guest_btn_left').click(function() {
                if (mySwiper.activeLoopIndex - 5 < 0) {
                    mySwiper.swipeTo(mySwiper.activeLoopIndex - 5 + num, 300, false);
                } else {
                    mySwiper.swipeTo(mySwiper.activeLoopIndex - 5, 300, false);
                }
                $('.guest_msg').html('<a href="/expertinfo?convention_id=' + convention_id + '&expert_id=' + expert_list[computeIndex(mySwiper.activeLoopIndex, num)].fid + '">' + expert_list[computeIndex(mySwiper.activeLoopIndex, num)].expert_name + '</a>');

                clearInterval(interval_time);
                auto_play();
            })
            $('.guest_btn_right').click(function() {
                move_banner();
                clearInterval(interval_time);
                auto_play();
            })

            auto_play();

            function auto_play() {
                interval_time = setInterval(function() {
                    move_banner()
                }, 6000);
            }

            function move_banner() {
                if (mySwiper.activeLoopIndex + 5 > num - 2 && mySwiper.activeLoopIndex + 5 < num + 2) {
                    mySwiper.swipeTo(num - 2 - (mySwiper.activeLoopIndex + 5), 300, false);
                } else {
                    mySwiper.swipeTo(computeIndex(mySwiper.activeLoopIndex + 5, num), 300, false);
                }
                $('.guest_msg').html('<a href="/expertinfo?convention_id=' + convention_id + '&expert_id=' + expert_list[computeIndex(mySwiper.activeLoopIndex, num)].fid + '">' + expert_list[computeIndex(mySwiper.activeLoopIndex, num)].expert_name + '</a>');
            }
        }

        function computeIndex(index, num) {
            if (index < 0) {
                return num + index;
            }
            if (index > num) {
                return index - num;
            } else {
                return index;
            }
        }


    })
</script>

<div class="meet_main">
    <div class="center1000">
        <ul class="meet_main_ul">
            <li class="meet_main_li meet_date">
                <div class="meet_main_title">
                    <span>重要日期</span>
                </div>
                <ul class="meet_main_content meet_main_date_ul">

                </ul>
            </li>
            <li class="meet_main_li meet_news">
                <div class="meet_main_title">
                    <span>新闻动态</span>
                </div>
                <ul class="meet_main_content meet_main_news_ul">

                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- 首页历史剪影轮播 -->
<div class="history_photo_list" style="overflow: hidden;">
	<h3 style="text-align:center;font-size:30px;font-family:MicrosoftYaHei-Bold;font-weight:bold;color:rgba(72,78,94,1);line-height:40px;margin:20px 0;">时光剪影</h3>
    <ul class="clear"></ul>
</div>
<!-- 首页支持单位 -->
<div class="paomad">
    <div class="conter1000">
        <div class="sponsor_list">
            <h2 class="sponsor_h2t support_box_t">特别支持</h2>
            <ul class="sponsor_list_ct" id="sponsor_list_t">
            </ul>
        </div>
        <div class="sponsor_list support_box_b">
            <h2 class="sponsor_h2A">A级支持</h2>
            <ul class="sponsor_list_ct" id="sponsor_list_A">
            </ul>
        </div>
        <div class="sponsor_list support_box_b">
            <h2 class="sponsor_h2B">B级支持</h2>
            <ul class="sponsor_list_ct" id="sponsor_list_B">
            </ul>
        </div>
        <div class="sponsor_list support_box_c">
            <h2 class="sponsor_h2C">C级支持</h2>
            <ul class="sponsor_list_ct" id="sponsor_list_C">
            </ul>
        </div>
    </div>
</div>
<!-- 二维码 -->
<div class="qr_code_box">
    <div class="qr_code_box_li qr_code_box_li_chet">
    </div>
    <div class="qr_code_img qr_code_img_chet">
        <p style="width:120px;height:120px;"></p>
        <span>关注微信公众号</span><br>了解更多咨询
    </div>
    <div class="qr_code_box_li qr_code_box_li_android" style="top:70px;">
    </div>
    <div class="qr_code_img qr_code_img_android" style="top:10px;">
        <p style="width:120px;height:120px;"></p>
        <span>SIFIC 2019 App</span> Android系统下载
    </div>
    <div class="qr_code_box_li qr_code_box_li_iphone" style="top:140px;">
    </div>
    <div class="qr_code_img qr_code_img_iphone" style="top:20px;">
        <p style="width:120px;height:120px;"></p>
        <span>SIFIC 2019 App</span> IOS系统下载
    </div>
</div>
<div class="footers">
	<div class="conter960">
		<div class="footer_txt">
			<div class="fter_01">
				<a href="/">首页</a>&nbsp;|&nbsp;
				<a href="/about?sr=关于我们">关于我们</a>&nbsp;|&nbsp;
				<a href="/copyright?sr=版权声明">版权声明</a>&nbsp;|&nbsp;
				<a href="/disclaimer?sr=免责声明">免责声明</a>&nbsp;|&nbsp;
				<a href="/report?sr=举报投诉">举报投诉</a>&nbsp;|&nbsp;
				<a href="/contact?sr=联系我们">联系我们</a>
			</div>
			<div class="fter_01" style="font-size: 14px; color: #555;">
				<p> 版权所有：上海斯菲克微生物应用技术研究中心 All Rights Reserved.
					<br /> <a href="http://www.miitbeian.gov.cn" target="_blank" style="font-size: 14px; color: #555;">沪ICP备16047626号-1</a>
					<script type="text/javascript">
						var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
						document.write(unescape("%3Cspan id='cnzz_stat_icon_1275090355'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol +
							"s13.cnzz.com/z_stat.php%3Fid%3D1275090355%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));
					</script>
				</p>



			</div>
		</div>
	</div>
</div>

</body>

</html>
<script type="text/javascript" src="/static/web/js/pulic.js"></script>
<script type="text/javascript" src="/static/web/js/scroll.js"></script>
<script type="text/javascript" src="/static/web/js/module/meetinginfo.js"></script>
<script>
    $(function() {
        $("#sponsor_list_t a").eq(0).css('margin-left', '0px')
        $("#sponsor_list_A a").eq(0).css('margin-left', '0px')
        $("#sponsor_list_B a").eq(0).css('margin-left', '0px')
        $("#sponsor_list_C a").eq(0).css('margin-left', '0px')
    })
</script>
<script>
    $(function() {

        $('.qr_code_box').on('mouseover', '.qr_code_box_li', function() {
            $(this).next().stop().animate({
                left: -180
            }, 500);
        })
        $('.qr_code_box').on('mouseout', '.qr_code_box_li', function() {
            $(this).next().stop().animate({
                left: 0
            }, 500);
        })





        var convention_base = "api/convention/convention_base"; //新闻和重要日期数据所在接口
        var data = {
            "convention_id": convention_id,
            "uid": cook_uid
        };
        ajax_all_Filed("true", "true", "GET", convention_base, "json", data, convention);

        function convention(data) {
            if (data.code == 414) {
                return false;
            }
            //important date    重要日期模块渲染
            var convention_info = data.data.convention_info;
            var date_str = htmls(convention_info.important_date)
            $('.meet_main_date_ul').html(date_str);
            //news		新闻模块渲染
            var newsList = data.data.convention_news;
            var news_str = '';
            for (var i = 0; i < newsList.length; i++) {
                news_str += "<li class='meet_news_list'><div class='meet_new_container'><a href='/newsinfo?convention_id=" + convention_id + "&news_id=" + newsList[i].fid + "'>" + newsList[i].title + "</a><i></i></div><div class='meet_main_date'>" + timeStamp2String(newsList[i].create_time) + "</div></li>"
            }
            $('.meet_main_news_ul').html(news_str);

            //paper

            var convention_order = data.data.convention_order;
            //cookie拿用户的状态，用户没有登录时，a标签的路由状态跳转到登录
            if (cook_uid == null || cook_uid == "") {
                $('.meet_login_li').html("<a class='meet_login' href='" + pu_url + "'><p>会议报名</p></a>")
                $('.meet_paper_li').html("<a class='meet_paper' href='" + pu_url + "'><p>论文发表</p></a>")
                $('.meet_user_li').html("<a class='meet_user' href='" + pu_url + "'><p>个人中心</p></a>")
                $('.meet_select_li').html("<a class='meet_select' href='" + pu_url + "'><p>追梦之星</p></a>")
            } else {
                //用户登录的时候，个人中心路由跳转到userinfo
                $('.meet_user_li').html("<a class='meet_user' href='/userinfo'><p>个人中心</p></a>")
                    //登录了评优报名路由跳转到programme

                if (getNowTime() > setFutureTime(2019, 3, 20, 17, 0, 0)) {
                    $('.meet_select_li').html("<a class='meet_select' style='cursor:pointer'><p>追梦之星</p></a>")
                    $('.meet_select_li').click(function() {
                        showLaert('时间已截止！')
                    })
                } else {
                    $('.meet_select_li').html("<a class='meet_select' href='/excellent_person'><p>追梦之星</p></a>")
                }
                //会议报名
                if (getNowTime() > setFutureTime(2019, 4, 27, 17, 0, 0)) {
                    if (convention_order != null && convention_order.pay_status == 2) {
                        $('.meet_login_li').html("<a class='meet_login' href='/annual_meeting'><p>会议报名</p></a>")
                    } else {
                        $('.meet_login_li').html("<a class='meet_login' href='/newsinfo?convention_id=47&news_id=36'><p>会议报名</p></a>");
                    }
                } else {
                    $('.meet_login_li').html("<a class='meet_login' href='/annual_meeting'><p>会议报名</p></a>")
                }
                //论文发表
                if (convention_order != null) {
                    //判断用户的报名状态，已经报名可以进行论文发表的跳转
                    $('.meet_paper_li').html("<a class='meet_paper' href='/abstract_list'><p>论文发表</p></a>")
                } else {
                    //判断用户的报名状态，没有报名，弹出提示信息，不可以进行论文发表
                    $('.meet_paper_li').html("<a class='meet_login'><p>论文发表</p></a>")
                    $(".meet_paper_li").click(function() {
                        showLaert("您还未注册会议，请您先点击“会议报名”按钮注册会议后，提交您的论文！");
                    })

                }


            }

        }
    })
</script>