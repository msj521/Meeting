<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"/home/wwwroot/default/SIFIC/public/../application/web/view/public/ip_zhwen.html";i:1544672274;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>大会征文通知</title>
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
		
	</script>
</head>
<style>
#content img{width: 100%;}
</style>
<body style="background: #fff;">
<section class="g-flexview">
    <section class="g-scrollview">
		<div class="guest_txt" id="content" style="padding:5%;">
				
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
    	var download = "api/convention/article";
    	 function htmls(a) {
			a = "" + a;
			return a.replace(/&lt;/g, "<").replace(/&gt;/g, ">").replace(/&amp;/g, "&").replace(/&quot;/g, '"').replace(/&apos;/g, "'");
		}
		function mtdownload(data){
			console.log(data.data[0].content)
			if(data!=null||data!=undefined){
				var datas = htmls(data.data[0].content);
	    		$("#content").html(datas);
			}
			
    		if(content=="null" || content==undefined){
				$("#content").html('<div style="font-size: 14px; line-height: 50px; text-align: center;">暂无数据</div>');
			}else{
				$("#content").html(datas);
			}
		}
		var data = {"convention_id":convention_id,"module":"A2"};
   		ajax_all_Filed("true", "true", "POST", download, "json", data, mtdownload);//调用函数
    }(jQuery);
</script>