<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"/home/wwwroot/default/SIFIC/public/../application/web/view/public/ip_contact.html";i:1548312837;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>联系我们</title>
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta content="telephone=no" name="format-detection"/>
    <link rel="stylesheet" href="/static/web/css/ydui.css?rev=@@hash"/>
    <link rel="stylesheet" href="/static/web/css/demo.css"/>
    <script src="/static/web/js/ydui.flexible.js"></script>

</head>
<style>

</style>
<body style="background: #fff;">
<section class="g-flexview">
    <section class="g-scrollview">
		<div class="guest_txt" id="ablist_ct" style="padding:5%;">
				
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
    	 
    	var sysurl="api/sys/explain"
		function sys(data){
			if(data!=""||data!=null){
				var explaindata = data.data.explain_list
				$("#ablist_ct").html(htmls(explaindata.contact_us));
			}else{
				$("#ablist_ct").html('<p style="text-align: center;">暂无数据</p>')
			}
		}
		var data = {"type":"sific"};
   	 	ajax_all_Filed("true", "true", "GET", sysurl, "json", data, sys);//调用函数
    }(jQuery);
</script>