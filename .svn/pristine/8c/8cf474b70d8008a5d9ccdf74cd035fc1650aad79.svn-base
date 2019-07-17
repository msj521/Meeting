<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"/home/wwwroot/default/SIFIC/public/../application/web/view/public/ip_pady.html";i:1544403592;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>付款</title>
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta content="telephone=no" name="format-detection"/>
    <link rel="stylesheet" href="/static/web/css/ydui.css?rev=@@hash"/>
    <link rel="stylesheet" href="/static/web/css/demo.css"/>
    <script src="/static/web/js/ydui.flexible.js"></script>
	<script type="text/javascript">
		function getQueryString(name) {
			var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
			var r = window.location.search.substr(1).match(reg);
			if(r != null) return decodeURI(r[2]);
			return null;
		}
		var convention_id = getQueryString("convention_id");
		var uid =getQueryString("uid");
	</script>
</head>
<style>
	.paybtn{border: 0px; width: 120px; height: 35px; background: #000; color: #fff; line-height: 35px; text-align: center;}
	.paybtn2{border: 0px; width: 120px; height: 35px; background: #666; color: #333; line-height: 35px; text-align: center;}
</style>
<body>
<section class="g-flexview">
	<header class="m-navbar">
    <a href="JavaScript:history.go(-1)" class="navbar-item">
        <i class="back-ico"></i>
    </a>
    <div class="navbar-center">
        <span class="navbar-title">付款</span>
    </div>
</header>
    <section class="g-scrollview">
		 <div id="public_account" style="float: left; width: 100%;"></div>
		<p id="username" style="padding-left: 30px; font-size: 14px; color: red;"></p>
		<p id="order_number" style="padding-left: 30px; font-size: 14px; color: red;"></p>
		<p  style="padding-left: 30px; font-size: 14px; color: red;">备注：对公转账时必须填写姓名和注册编号
</p>
		<div style="float: left; width: 100%; text-align: center; margin-top: 20px;" id="btnzhuan">
			<input type="button" name="" id="paybtn" value="转账" class="paybtn" />&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="button" name="" id="paybtn2" value="现场支付" class="paybtn"/>
		</div>
    </section>
</section>
<script type="text/javascript" src="/static/web/libs/jquery/jquery.js" ></script>
<script src="/static/web/js/ydui.js"></script>
<script src="/static/web/js/ajax.js"></script>
<script src="/static/web/js/md5.js"></script>
</body>
</html>
<script>
    /**
     * Javascript API调用Tab
     */

    !function ($) {
    	 function htmls(a) {
			a = "" + a;
			return a.replace(/&lt;/g, "<").replace(/&gt;/g, ">").replace(/&amp;/g, "&").replace(/&quot;/g, '"').replace(/&apos;/g, "'");
		}
    	var convention_base = "api/convention/convention_base";
		var pay_typeurl="api/convention/pay_type";
		
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
		var data = {"convention_id":convention_id,"uid":uid};
   		ajax_all_Filed("true", "true", "GET", convention_base, "json", data, payment);//调用函数	
   		
   		$("#paybtn").click(function(){
			function paybtnclick(data){
				if(data.code==200){
					$("#paybtn").addClass("paybtn2")
					alert(data.msg);return;
				}if(data.code==413){
					$("#paybtn").removeClass("paybtn2").addClass("paybtn")
					alert(data.msg);return;
				}
			}
   			var data = {"convention_id":convention_id,"uid":uid,"pay_type":1};
   			ajax_all_Filed("true", "true", "GET", pay_typeurl, "json", data, paybtnclick);//调用函数	
   		})
   		$("#paybtn2").click(function(){
   			function paybtnclick(data){
				if(data.code==200){
					$("#paybtn2").addClass("paybtn2")
					alert(data.msg);return;
					
				}if(data.code==413){
					$("#paybtn2").removeClass("paybtn2").addClass("paybtn")
					alert(data.msg);return;
				}
			}
   			var data = {"convention_id":convention_id,"uid":uid,"pay_type":2};
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

    }(jQuery);
</script>