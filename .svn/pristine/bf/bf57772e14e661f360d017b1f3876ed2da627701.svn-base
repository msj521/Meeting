<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:81:"/home/wwwroot/default/SIFIC/public/../application/web/view/video/record_info.html";i:1539339306;s:67:"/home/wwwroot/default/SIFIC/application/web/view/public/header.html";i:1548638819;s:67:"/home/wwwroot/default/SIFIC/application/web/view/public/footer.html";i:1540200495;}*/ ?>
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


    	
<script src="//imgcache.qq.com/open/qcloud/video/vcplayer/TcPlayer-2.2.2.js"></script>
		<div class="conter960">
			<div class="mbxue">
				位置&nbsp;>&nbsp;培训&nbsp;>&nbsp;<span id="class_name"></span>&nbsp;>&nbsp;<span id="title2"></span>
			</div>
			
			<div class="liveinfo">
				<div class="peix_video">
					<div class="peix_videolf" style="position: absolute;">
						<div id="video-container" style="margin: 0px auto;"></div>
					      <div id="shadow"></div>
					</div>
					<div class="peix_video_nav">
						<ul class="peix_video_ul">
							
						</ul>
					</div>
				</div>
				<div class="liveinfo_title">
					<div class="liveinfo_titlelf ellipsis" id="title"></div>
				</div>
				<div class="liveinfo_ct">
					<div class="title">
						<div class="title_txt2">简介</div>
					</div>
					<p style="font-size: 16px; color: #555;" id="description"></p>
					<div class="title">
						<div class="title_txt2">讲师</div>
					</div>
					<ul class="guestlive_ul">
						
					</ul>
					<div class="title">
						<div class="title_txt2">评论</div>
					</div>
					<div class="review">
						<div class="review_input">
							<div class="review_input_lf">
								<img src="" id="userimg" />
							</div>
							<div class="review_input_rg">
								<textarea class="form-control" id="content" style="resize:none; height: 100px;" placeholder="我说两句..." ></textarea>
								<button class="fab_btn">发表</button>
							</div>
						</div>
						
						<div class="review_list">
							
						</div>
					</div>
				</div>
			</div>
			
			<!--<div class="logos">
				<img src="../images/pic_advertising.png" />
			</div>-->
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


<script type="text/javascript" src="/static/web/js/module/recordinfo.js" ></script>
<div class="pulic_t_div" id="recrd" style="display: none;">
	<div class="pulic_recor">
		<div class="pulic_t_txt">
			<div class="daytiem_close"></div>
			<h1 class="test_h1" id="exam_name"></h1>
			<div class="pulic_recor_txt">
				<form id="recor_form">
				<div class="test_subject">
				
				</div>
				</form>
			</div>
			<div style="width: 100%; float: left; text-align: center;" id="training_upload"><button class="subject_t_btn">确定</button></div>
		</div>
	</div>
</div>

<div class="pulic_t_div" id="score_tis" style="display: none;">
	<div class="pulic_t_divct">
		<div class="pulic_t_txt">
			<div class="daytiem_close"></div>
			<div class="subject_title" id="subject_title"></div>
			<div class="subject_txt" id="subject_txt"></div>
			<div style="width: 100%; float: left; text-align: center;"><button class="subject_t_btn" id="score_btn">确定</button></div>
		</div>
	</div>
</div>

