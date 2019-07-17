<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"/home/wwwroot/default/SIFIC/public/../application/web/view/public/ip_fapiao.html";i:1548229971;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>申请发票</title>
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
//		var convention_id = getQueryString("convention_id");
//		var cook_uid = getQueryString("cook_uid");
//      var cook_token = getQueryString("cook_token");
		var convention_id = 45;
		var cook_uid = 2648;
		var cook_token='ec1d65127d3d7db5890c429e85237a4f2029eb2e'
	</script>
	<style type="text/css">

.opt{width: 100%; display: inline-block;}
.opt label{font-size: 0.25rem;}

@keyframes hover-color {
	from {
		border-color: #c0c0c0;
	}
 
	to {
		border-color: #3e97eb;
	}
}
.magic-radio,
.magic-checkbox {
	position: absolute;
	display: none;
}
 
.magic-radio[disabled],
.magic-checkbox[disabled] {
	cursor: not-allowed;
}
 
.magic-radio + label,
.magic-checkbox + label {
	position: relative;
	display: block;
	padding-left: 20px;
	cursor: pointer;
	vertical-align: middle;
		
}
 
.magic-radio + label:hover:before,
.magic-checkbox + label:hover:before {
	animation-duration: 0.4s;
	animation-fill-mode: both;
	animation-name: hover-color;
}
 
.magic-radio + label:before,
.magic-checkbox + label:before {
	position: absolute;
	top: 0;
	left: 0;
	display: inline-block;
	width: 15px;
	height: 15px;
	content: '';
	border: 1px solid #000;
}
.magic-radio + label:after,
  .magic-checkbox + label:after {
	position: absolute;
	display: none;
	content: '';
}
.magic-radio[disabled] + label,
.magic-checkbox[disabled] + label {
	cursor: not-allowed;
	color: #fff;
}
.magic-radio[disabled] + label:hover, 
.magic-radio[disabled] + label:before, 
.magic-radio[disabled] + label:after,
.magic-checkbox[disabled] + label:hover,
.magic-checkbox[disabled] + label:before,
.magic-checkbox[disabled] + label:after {
	cursor: not-allowed;
}
.magic-radio[disabled] + label:hover:before,
.magic-checkbox[disabled] + label:hover:before {
	border: 1px solid #000;
	animation-name: none;
}
 
.magic-radio[disabled] + label:before,
.magic-checkbox[disabled] + label:before {
	border-color: #000;
}
 
.magic-radio:checked + label:before,
.magic-checkbox:checked + label:before {
	animation-name: none;
}
 
.magic-radio:checked + label:after,
.magic-checkbox:checked + label:after {
	display: block;
}
.magic-radio + label:before {
	border-radius: 50%;
}
.magic-radio + label:after {
	top: 4px;
	left: 4px;
	width: 7px;
	height: 7px;
	border-radius: 50%;
	background: #000;
}
.magic-radio:checked + label:before {
	border: 1px solid #000;
}
.magic-radio:checked[disabled] + label:before {
	border: 1px solid #000;
}
.magic-radio:checked[disabled] + label:after {
	background: #fff;
}
.magic-checkbox + label:before {
	border-radius: 3px;
}
.magic-checkbox + label:after {
	top: 0px;
	left: 5px;
	box-sizing: border-box;
	width: 6px;
	height: 12px;
	transform: rotate(45deg);
	border-width: 2px;
	border-style: solid;
	border-color: #fff;
	border-top: 0;
	border-left: 0;
}
.magic-checkbox:checked + label:before {
    border: #000;
    background: #000;
}
.magic-checkbox:checked[disabled] + label:before {
	border: #000;
	background: #000;
}
	</style>
</head>
<body style="background: #fff;">
<section class="g-flexview">
    <section class="g-scrollview">
    	<div class="ip_annual_ct">
			<p style="color: #598DC4; margin-bottom: 0.3rem;" >注意：大会只提供电子发票，请各位老师仔细核对发票抬头和税号，发票开出后 <span style="color: #AB3B3B;">不得退换</span>！谢谢！</p>
			<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					发票抬头<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<input type="text" name="" id="bill_title" value="" class="txtinput" />
				</div>
			</div>	
			<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					纳税人识别号<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<input type="text" name="" id="tax_num" value="" class="txtinput" />
				</div>
			</div>	
		</div>
		<div class="fp_btn">
			<input type="button" name="" id="invoice_btn" value="提交" />
		</div>
    </section>
</section>
<script type="text/javascript" src="/static/web/libs/jquery/jquery.js" ></script>
<script src="/static/web/js/ajax.js"></script>
<script src="/static/web/js/md5.js"></script>
<script type="text/javascript" src="/static/web/js/app/siginfo.js" ></script>
</body>
</html>
<script type="text/javascript">
$(function(){
		var invoiceurl = "/api/convention/pay"//下拉接口
		
		$("#invoice_btn").click(function(){
			var bill_title = $("#bill_title").val()
			var tax_num = $("#tax_num").val()
			
			if(bill_title == ""){
				alert("发票抬头不能为空！");
			}
			if(tax_num == ""){
				alert("纳税人识别号不能为空！");
			}
			function invoicefo(data) {
				if(data.code==200){
					alert("提交成功！")
					//alert("发票抬头："+bill_title+"；纳税人识别号："+tax_num);
//						window.location.href = "/convention?convention_id=" + convention_id + "&nav_id=1";
//						
				}
			}
				var invoiceata = {
					"convention_id": convention_id,
					"uid": cook_uid,
					"bill_title":bill_title,
					" tax_num": tax_num,
					"type":2,
					"invoice_status":1
				};
				ajax_all_Filed("true", "true", "GET", invoiceurl, "json", invoiceata, invoicefo); //调用函数
			
		})
	})
	</script>