<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:91:"D:\phpStudy\PHPTutorial\WWW\sific_year\public/../application/web\view\meeting\schedule.html";i:1558332598;s:78:"D:\phpStudy\PHPTutorial\WWW\sific_year\application\web\view\public\header.html";i:1556526972;s:83:"D:\phpStudy\PHPTutorial\WWW\sific_year\application\web\view\public\meeting_nav.html";i:1553481696;s:77:"D:\phpStudy\PHPTutorial\WWW\sific_year\application\web\view\public\mbxue.html";i:1558692744;s:79:"D:\phpStudy\PHPTutorial\WWW\sific_year\application\web\view\public\footer2.html";i:1552891185;}*/ ?>
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
</script>
<style>
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
</script>
<div class="lookdate">
	<div class="conter960">
		<div class="data_day" style="display:none">
			<a href="/agenda?convention_id=47" target="_blank">查看日程</a>
		</div>
	
		<div style="width: 210px;margin: 0px auto;">
			<p style="font-weight: bold;font-family: 微软雅黑;text-align: center;font-size:18px">微信扫码查看日程</p>
			<img src="/uploads/20190520/fd2efdc14da6e6103d6abf15b99dcc59.png" style="width: 210px;">
		</div>‘
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
<script type="text/javascript" src="/static/web/js/module/schedule.js"></script>

<div class="daytiem_div" style="display: none;">
	<div class="daytiem_div_ct">
		<div class="daytiem_close"></div>
		<div class="tc_title">
			<h1 id="schedule_name"></h1>
			<div class="schedule_ex ellipsis">

			</div>

		</div>
		<div class="tc_ct">
			<div class="tc_ctlf">
				<h1>基本信息</h1>
				<div class="tc_ctlf_txt">
					<div class="tc_img"><img src="/static/web/images/icon_time.png"></div>
					<div class="tc_txt">
						<p id="mtdate1"></p>
						<p id="mtdate2"></p>
					</div>
				</div>
				<div class="tc_ctlf_txt">
					<div class="tc_img"><img src="/static/web/images/icon_adress.png"></div>
					<div class="tc_txt" id="addr"></div>
				</div>
			</div>
			<div class="tc_ctrg">
				<h1>发言详情</h1>
				<div class="tclist">


				</div>

			</div>
		</div>
	</div>
</div>