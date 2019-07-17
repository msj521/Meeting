<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:75:"/home/wwwroot/default/SIFIC/public/../application/web/view/index/index.html";i:1539231000;s:67:"/home/wwwroot/default/SIFIC/application/web/view/public/header.html";i:1548638819;s:68:"/home/wwwroot/default/SIFIC/application/web/view/public/partner.html";i:1538019540;s:67:"/home/wwwroot/default/SIFIC/application/web/view/public/footer.html";i:1540200495;}*/ ?>
<!DOCTYPE html>
<html >
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telephone=no">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<title>
			<?php 
				if(count(path())==0){ 
					echo "SIFIC会议系统-首页";
				}else if(isset(path()['convention_id'])){
					echo "SIFIC会议系统-会议";
				}else if(isset(path()['live_id'])){
					echo "SIFIC会议系统-直播";
				}else if(isset(path()['training_id'])){
					echo "SIFIC会议系统-培训";
				}else{
					echo "SIFIC会议系统";
				}
			?>
		</title>
		<link rel="stylesheet" href="/static/web/css/bootstrap.css" />
		<link rel="stylesheet" href="/static/web/css/pulic.css" />
		<link rel="stylesheet" type="text/css" href="/static/web/css/banner.css"/>
		<link rel="stylesheet" type="text/css" href="/static/web/css/liveinfo.css"/>
		<link rel="stylesheet" type="text/css" href="/static/web/css/pagination.css"/>
		<script type="text/javascript" src="/static/web/libs/jquery/jquery.js" ></script>
		<script type="text/javascript" src="/static/web/js/jquery.cookie.js" ></script>
		<script type="text/javascript" src="/static/web/js/md5.js" ></script>
		<script type="text/javascript" src="/static/web/js/ajax.js" ></script>
		<script type="text/javascript" src="/static/web/js/jquery.pagination.js" ></script>
		<script type="text/javascript" src="/static/web/js/getQueryString.js" ></script>
		<script type="text/javascript" src="/static/web/js/pdfobject.js" ></script>
	</head>
	<body>
	<div class="navbarfixed-top">
	<!--导航栏-->
	<div class="navct">
		<div class="logo"><a href="/"><img src="/static/web/images/logo.png"></a></div>
		<div class="navlist">
			<div id="navigation">
				<ul>
					<!-- <li class="noenli"><a href="/convention" class="active">会议</a></li> -->
					<li class="noenli"><a href="/" <?php if(count(path())==0){  ?> class="active" <?php } ?> class="" ">首页</a></li>
					<li class="noenli"><a href="/meeting?convention_id" <?php if(isset(path()['convention_id'])){  ?> class="active" <?php } ?> class="" ">会议</a></li>
					<li class="noenli"><a href="/lives?live_id" <?php if(isset(path()['live_id'])){  ?> class="active" <?php } ?> class="">直播</a></li>
					<li class="noenli"><a href="/video?training_id" <?php if(isset(path()['training_id'])  ){  ?> class="active" <?php } ?> class="">培训</a></li>
				</ul>
			</div>
		</div>
		<!--搜索、登录框-->
		<div class="navright">
			<div class="search">
				<input type="text" id="search">
				<div class="search_btn">
					<a href=""><span class="glyphicon glyphicon-search"></span></a>
				</div>
			</div>
			 <div class="nologin ellipsis"></div>
		</div>
	</div>
</div>
<script>
	$(function(){
		$(".nologin").text("");
		
		if(cook_tel==null||cook_tel==""){
			$('<img src="/static/web/images/pic_head.png">'+'</img>'+'<a href="'+pu_url+'">'+'登录'+'</a>'+'&nbsp;'+'|'+'&nbsp;'+'<a href="/register">'+'创建账号'+'</a>').appendTo(".nologin");
			return false;
		}else{
			var userinfo = JSON.parse(localStorage.getItem("user_info"))
			if(userinfo==null||userinfo==""){
				return false;
			}
			$('<img src="'+userinfo.web_image_url+'">'+'</img>'+'<a href="/userinfo" style="font-size: 16px;">'+userinfo.user_name+'</a>').appendTo(".nologin");
			$("#userimg").attr("src",userinfo.web_image_url);
		}
	})
</script>


    	
<div class="flexslider">
	<ul class="slides">
		
		<!--<li style="background:url(/static/web/images/2.png) 50% 0 no-repeat;"></li>
		<li style="background:url(/static/web/images/3.png) 50% 0 no-repeat;"></li>
		<li style="background:url(/static/web/images/4.png) 50% 0 no-repeat;"></li>-->
	</ul>
</div>

		<div class="conter960">
			
			<div class="h_module">
				<div class="h_modulelist">
					<div class="title">
					<div class="title_txt">直播</div>
					<div class="movers">
						<a href="/lives?live_id">更多</a>
					</div>
					</div>
					<div class="live_list" id="aa">
						<ul class="live_ul" id="home_live_ul"></ul>
					</div>
				</div>
			</div>
			<div class="h_module">
				<div class="h_modulelist">
					<div class="title">
						<div class="title_txt">会议</div>
						<div class="movers">
							<a href="/meeting?convention_id">更多</a>
						</div>
					</div>
					<div class="live_list">
						<div class="meeting_list">
							<ul class="meeting_ul">
								
								
							</ul>
						</div>
						<div class="meeting_news">
							<div class="hot_title">
								近期热门会议
							</div>
							<div class="hot_list">
								<ul class="hot_news">
									
								</ul>
							</div>
							
						</div>
					</div>
				</div>
			</div>
			<div class="h_module">
				<div class="h_modulelist">
					<div class="title">
					<div class="title_txt">培训</div>
					<div class="movers">
						<a href="/video?training_id">更多</a>
					</div>
					</div>
					<div class="live_list">
						<div class="train_list">
							<ul class="train_ul">
								
							</ul>
						</div>
						
					</div>
				</div>
			</div>
			<div class="logoslist">
				<div class="logos" id="logos1"></div>
				<div class="logos2" id="logos2"></div>
			</div>
			
			
						<div class="title">
				<div class="title_txt" style="border-left: 0px;">合作伙伴</div>
			</div>
			<div class="partner">
				<ul class="partner_list">
				
				</ul>
			</div>
		</div>
	<div class="footers">
			<div class="conter960">
				<div class="footer_txt">
					<div class="fter_01">
						<a href="/about?sr=关于我们">关于我们</a>&nbsp;|&nbsp;
						<a href="/copyright?sr=版权声明">版权声明</a>&nbsp;|&nbsp;
						<a href="/disclaimer?sr=免责声明">免责声明</a>&nbsp;|&nbsp;
						<a href="/report?sr=举报投诉">举报投诉</a>&nbsp;|&nbsp;
						<a href="/contact?sr=联系我们">联系我们</a>
					</div>
					<div class="fter_01" style="font-size: 14px; color: #555;">
						<p> Copyright©2018-2028 深圳斯菲克科技有限公司 版权所有<br /><a href="http://sific.vip/certificate.jpg" target="_blank" style="font-size: 14px; color: #555;">网络文化经营许可证</a> <br /> <a href="http://www.miitbeian.gov.cn" target="_blank" style="font-size: 14px; color: #555;">粤ICP备18060349号-1</a>
							<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1275090355'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s13.cnzz.com/z_stat.php%3Fid%3D1275090355%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>
						</p>
						


					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<script type="text/javascript" src="/static/web/js/pulic.js" ></script>

<script type="text/javascript" src="/static/web/js/module/index.js" ></script>
<script type="text/javascript" src="/static/web/js/jquery.flexslider-min.js" ></script>
