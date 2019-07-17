<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:79:"/home/wwwroot/default/SIFIC/public/../application/web/view/meeting/payment.html";i:1545116694;s:67:"/home/wwwroot/default/SIFIC/application/web/view/public/header.html";i:1546847820;s:67:"/home/wwwroot/default/SIFIC/application/web/view/public/mbxue2.html";i:1545116695;s:67:"/home/wwwroot/default/SIFIC/application/web/view/public/footer.html";i:1540200495;}*/ ?>
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
					<li class="noenli"><a href="/convention" class="active">会议</a></li>
					<!--<li class="noenli"><a href="/" <?php if(count(path())==0){  ?> class="active" <?php } ?> class="" ">首页</a></li>-->
					<!--<li class="noenli"><a href="/meeting?convention_id" <?php if(isset(path()['convention_id'])){  ?> class="active" <?php } ?> class="" ">会议</a></li>-->
					<!--<li class="noenli"><a href="/lives?live_id" <?php if(isset(path()['live_id'])){  ?> class="active" <?php } ?> class="">直播</a></li>
					<li class="noenli"><a href="/video?training_id" <?php if(isset(path()['training_id'])  ){  ?> class="active" <?php } ?> class="">培训</a></li>-->
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


    	
<style>
	.paybtn{border: 0px; width: 120px; height: 35px; background: #000; color: #fff; line-height: 35px; text-align: center;}
	.paybtn2{border: 0px; width: 120px; height: 35px; background: #666; color: #333; line-height: 35px; text-align: center;}
</style>
		<div class="conter960">
			<div class="mbxue ellipsis">
	位置&nbsp;>&nbsp;会议&nbsp;>&nbsp;<span id="class_name"></span>&nbsp;>&nbsp;<span id="title"></span>
</div>
<script>
	$(function(){
		var mbxurl = "api/convention/convention_base";
		function mbx(data){
			var convention_info = data.data.convention_info;
			if(convention_info!=null){
				$("#class_name").text(convention_info.class_name);
				$("#title").text(convention_info.convention_name)
				$("#meeting_img").attr({ src:convention_info.web_image_url , alt: ""})
			}
		}
		var data = {"convention_id":convention_id};
	   	ajax_all_Filed("true", "true", "GET", mbxurl, "json", data, mbx);//调用函数	
	})
	
</script>
			<div class="payment">
				<div class="payment_nav">
					<div class="action">对公转账</div>
					<!--<div>支付宝支付</div>
					<div>微信支付</div>-->
				</div>
				<div class="payment_ct">
					<div>
						<div id="public_account" style="float: left; width: 100%;"></div>
						<p id="username" style="padding-left: 30px; font-size: 14px; color: red;"></p>
						<p id="order_number" style="padding-left: 30px; font-size: 14px; color: red;"></p>
						<p style="padding-left: 30px; font-size: 14px; color: red;">备注：<strong>请至会议现场支付，现场只接受现金。</strong> 
</p>
<p style="padding-left: 30px; font-size: 14px; color: red;">缴费开放时间：</p>
<p style="padding-left: 30px; font-size: 14px; color: red;">2018年12月2日  13:00-18：00</p>
<p style="padding-left: 30px; font-size: 14px; color: red;">2018年12月3日  07:30-12：00</p>
<p style="padding-left: 30px; font-size: 14px; color: red;">报到地址：上海徐汇瑞峰酒店(上海市徐汇区肇嘉浜路7号)</p>
						<div style="float: left; width: 100%; text-align: center;" id="btnzhuan">
							<input type="button" name="" id="paybtn" value="转账" class="paybtn" />&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="button" name="" id="paybtn2" value="线上支付”" class="paybtn"/>
						</div>
					</div>
					<div style="display: none;" id="alipay">
						
					</div>
					<div style="display: none;" id="wechat">
						
					</div>
				</div>
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

<script>
	$(function(){
		var convention_base = "api/convention/convention_base";
		var pay_typeurl="api/convention/pay_type";
		var userinfo = JSON.parse(localStorage.getItem("user_info"))
		
		function payment(data){
			var convention_info = data.data.convention_info;
			var order =data.data.convention_order

			if(convention_info.public_account==""||convention_info.public_account==undefined){
				$("#public_account").html('<p style="text-align: center;">暂无数据</p>')
			}else{
				$("#public_account").html(htmls(convention_info.public_account))
			}
			if(convention_info.alipay==""||convention_info.alipay==undefined){
				$("#alipay").html('<p style="text-align: center;">暂无数据</p>')
			}else{
				$("#alipay").html(htmls(convention_info.alipay))
			}
			if(convention_info.wechat==""||convention_info.wechat==undefined){
				$("#wechat").html('<p style="text-align: center;">暂无数据</p>')
			}else{
				$("#wechat").html(htmls(convention_info.wechat))
			}
			$("#username").text("姓名："+order.user_name);
   			$("#order_number").text("注册编号："+order.order_number);
   			
		}
		var data = {"convention_id":convention_id,"uid":userinfo.fid};
   		ajax_all_Filed("true", "true", "GET", convention_base, "json", data, payment);//调用函数	
   		
   		$("#paybtn").click(function(){
			function paybtnclick(data){
				if(data.code==200){
					$("#paybtn").addClass("paybtn2")
					showLaert(data.msg);return;
				}if(data.code==413){
					$("#paybtn").removeClass("paybtn2").addClass("paybtn")
					showLaert(data.msg);return;
				}
			}
   			var data = {"convention_id":convention_id,"uid":userinfo.fid,"pay_type":1};
   			ajax_all_Filed("true", "true", "GET", pay_typeurl, "json", data, paybtnclick);//调用函数	
   		})
   		$("#paybtn2").click(function(){
   			function paybtnclick(data){
				if(data.code==200){
					$("#paybtn2").addClass("paybtn2")
					showLaert(data.msg);return;
					
				}if(data.code==413){
					$("#paybtn2").removeClass("paybtn2").addClass("paybtn")
					showLaert(data.msg);return;
				}
			}
   			var data = {"convention_id":convention_id,"uid":userinfo.fid,"pay_type":2};
   			ajax_all_Filed("true", "true", "GET", pay_typeurl, "json", data, paybtnclick);//调用函数	
   		})
		var $div_li =$(".payment_nav div");
		    $div_li.click(function(){
				$(this).addClass("action")           
					   .siblings().removeClass("action");  
	            var index =  $div_li.index(this);  
				$(".payment_ct > div")   	
						.eq(index).show()  
						.siblings().hide(); 
			})
		    $("#btnzhuan input[type=button]").click(function(){
				$(this).addClass("paybtn")           
					   .siblings().removeClass("paybtn2");  
	           
			})
		   
	})
</script>