<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"/home/wwwroot/default/SIFIC/public/../application/web/view/public/ip_czs.html";i:1544778279;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>参展商详情</title>
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
		var org_id = getQueryString("org_id")
	</script>
</head>
<style>
.headlist{width:100%; display: inline-block; background:#fff; margin-bottom: 5px; padding: 3%;}
.headlist_lf{width: 30%; float:left;}
.headlist_rg{width: 70%; float: right; font-size: 0.3rem; height: 1rem; line-height: 1rem; color: #111;	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;}
.headlist_lf img{
	width: 100%;
	height: 1rem;
	border-radius: 5px;
}
.ctlist{width:100%; display: inline-block; background:#fff; padding: 3%;}
.ctilist_cld{width:100%; display: inline-block; border-bottom: 1px solid #F7F6F6; padding: 10px 0 10px 0; font-size: 0.28rem; padding-left: 10%; color: #333; height: 0.75rem;}
.icon01{background: url(/static/web/images/app/icon_address.png) no-repeat; background-position: 2% 50%;}
.icon02{background: url(/static/web/images/app/icon_contant.png) no-repeat; background-position: 2% 50%;}
.icon03{background: url(/static/web/images/app/icon_landline.png) no-repeat; background-position: 2% 50%;}
.icon04{background: url(/static/web/images/app/icon_url.png) no-repeat; background-position: 2% 50%;}
.icon05{background: url(/static/web/images/app/icon_booth.png) no-repeat; background-position: 2% 50%;}
.introduce{padding: 3%;width:100%; display: inline-block; background:#fff;}
.introduce p{font-size: 0.3rem; color: #333;}
#introduce{color: #555;}
</style>
<body>
<section class="g-flexview">
    <section class="g-scrollview">
		<div class="headlist">
			<div class="headlist_lf">
				<img src="" id="image_url"/>
			</div>
			<div class="headlist_rg" id="org_name"></div>
		</div>
		<div class="ctlist">
			<div class="ctilist_cld icon01" id="address"></div>
			<div class="ctilist_cld icon02" id="tel"></div>
			<div class="ctilist_cld icon03" id="fax"></div>
			<div class="ctilist_cld icon04" id="web_url"></div>
			<div class="ctilist_cld icon05" id="booth"></div>
		</div>
		<div class="introduce">
			<p>参展商介绍</p>
			<div id="introduce">
				
			</div>
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
    	var ipmeturl = 'api/convention/exhibitor_list';
    	function ipmet(data){
    		
    		var datas = data.data.org_detail;
			var introduce = htmls(datas.description);
			var image_url = datas.image_url;
			var org_name = datas.org_name;
			var address = datas.address;
			var tel = datas.tel;
			var fax = datas.fax;
			var web_url = datas.web_url;
			var booth = datas.booth;
			$("#image_url").attr("src",image_url);
			$("#org_name").text(org_name);
			$("#address").text(address);
			$("#tel").text(tel);
			$("#fax").text(fax);
			$("#web_url").text(web_url);
			$("#booth").text(booth);
    		if(introduce!=undefined || introduce!=""){
    			$("#introduce").html(introduce);
				
			}else{
				$("#introduce").html('<div style="font-size: 14px; line-height: 50px; text-align: center;">暂无数据</div>');
			}
    	}
    	var data = {"convention_id":convention_id,"org_id":org_id};
	   	ajax_app_Filed("true", "true", "GET", ipmeturl, "json", data, ipmet);//调用函数
	   	

    }(jQuery);
</script>