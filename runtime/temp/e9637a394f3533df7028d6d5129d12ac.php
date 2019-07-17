<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"/home/wwwroot/default/SIFIC/public/../application/web/view/public/ip_baomin.html";i:1545041250;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>会议报名</title>
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
		var cook_uid = getQueryString("cook_uid");
        var cook_token = getQueryString("cook_token");
//		var convention_id = 43;
//		var cook_uid = 6;
//		var cook_token='ec1d65127d3d7db5890c429e85237a4f2029eb2e'
	</script>
	<style type="text/css">
.invoice{width: 40%; height: 30px; border-radius: 4px; border: #979797 solid 1px; text-align: center; font-size: 0.28rem;color: #111111; float: left; margin-right:10px ; line-height: 30px; cursor: pointer;}
.invoice_action{border: #232323 solid 1px; background: url(/static/web/images/icon_invoice.png) no-repeat;background-position:right bottom;}

.opt{padding: 0.25rem; width: 100%; display: inline-block;}
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
.sigin_xx{width: 100%; display: inline-block;}
.sigin_xx .opt{float: left; width: auto; height: auto;}
.piaowulist{width: 100%; display: inline-block; border-bottom: #D9D9D9 1px solid;}
.piaowulist .opttxt{ float: left; text-align: right; width: 90%;  font-size: 0.25rem;}
.piaowulist .opt{ float: right; width: 10%; height: auto;}
.opttxt_lf{font-size: 0.25rem; line-height: 43px; color: #333; float: left; padding-left: 0.25rem;}
.opttxt_rg{color:#F45C0C;font-size: 0.25rem; line-height: 43px; float:right ;}
.m-cellx{display: inline-block; width: 100%; background: #fff;}
	</style>
</head>
<body style="">
<section class="g-flexview">
    <section class="g-scrollview">
		<div class="m-cell">

		     <div class="cell-item">
		        <div class="cell-left">参会人：</div>
		        <div class="cell-right" id="user_name"></div>
		    </div>
		    <div class="cell-item">
		        <div class="cell-left">联系方式：</div>
		        <div class="cell-right" id="tel"></div>
		    </div>
		    <div class="cell-item">
		        <div class="cell-left">单位：</div>
		        <div class="cell-right"  id="org_name"></div>
		    </div>
		    <div class="cell-item">
		        <div class="cell-left">职称：</div>
		        <div class="cell-right" id="job_name"></div>
		    </div>
		   
		</div>
		<div class="m-cell" id="canh_pr"></div>
		
		<div class="m-cellx" id="bm_leix" style="border-bottom: 0px;"></div>
		<div class="m-cell" id="xuefen">
			<p style="font-size: 0.3rem; padding: 0.2rem;">此次培训是否要学分？</p>
		    <div class="opt">
					<input class="magic-radio" type="radio" name="2" id="r1" value="2">
					<label for="r1">是</label>
				</div>
		    <div style="display: none;" id="turediv">
		    	<div class="cell-item">
			        <div class="cell-left">出生年月：</div>
			        <div class="cell-right"><input class="cell-input" name="credit_time" type="text" value="" placeholder="选择出生年月" id="credit_time" readonly="readonly">
			        </div>
			    </div>
			    <div class="cell-item">
			        <div class="cell-left">职称：</div>
			        <div class="cell-right"><input type="text" class="cell-input" placeholder="填写职称" autocomplete="off" id="credit_title"/></div>
			    </div>
			    <div class="cell-item">
				        <div class="cell-left">性别：</div>
				        <label class="cell-right cell-arrow">
				            <select class="cell-select" id="credit_type">
				                <option value="1">初级</option>
								<option value="2">中级</option>
								<option value="3">副高级以上</option>
				            </select>
				        </label>
				    </div>
		    </div>
		    <div class="opt">
				<input class="magic-radio" type="radio" name="2" id="r2" value="1">
				<label for="r2">否</label>
			</div>
		</div>
		<div class="m-cell">
		    <div class="cell-item">
		        <div class="cell-left">发票类型：</div>
		        <div class="cell-right" id="canh_prlist_rg">
		        	<div class="invoice" id="f1">普通发票</div>
					<div class="invoice" id="f2">增值税专用发票</div>
						<input type="text" name="bill_type"  id="bill_type" value="普通发票" style="display: none;" />
		        </div>
		    </div>
		    <div class="cell-item">
		        <div class="cell-left"><span style="color: red;">*</span>发票抬头：</div>
		        <div class="cell-right"><input type="text" class="cell-input" placeholder="请填写发票抬头" autocomplete="off" id="bill_title" /></div>
		    </div>
		    <div class="cell-item">
		        <div class="cell-left"><span style="color: red;">*</span>税号：</div>
		        <div class="cell-right"><input type="text" class="cell-input" placeholder="填写纳税识别号" autocomplete="off" id="tax_num" /></div>
		    </div>
		    <div class="cell-item" id="khuh" style="display: none;">
		        <div class="cell-left"><span style="color: red;">*</span>开户行：</div>
		        <div class="cell-right"><input type="text" class="cell-input" placeholder="请填写开户行" autocomplete="off" id="account_bank" /></div>
		    </div>
		    <div class="cell-item">
		        <div class="cell-left">地址：</div>
		        <div class="cell-right"><input type="text" class="cell-input" placeholder="请填写公司地址" autocomplete="off" id="sign_addr"/></div>
		    </div>
		    <div class="cell-item">
		        <div class="cell-left">电话：</div>
		        <div class="cell-right"><input type="text" class="cell-input" placeholder="请填写电话" autocomplete="off" id="sign_tel" /></div>
		    </div>
		    <div class="cell-item">
		        <div class="cell-left">银行账号：</div>
		        <div class="cell-right"><input type="text" class="cell-input" placeholder="请填写银行账号" autocomplete="off" id="account" /></div>
		    </div>
		    <div class="cell-item">
		        <div class="cell-left">邮寄地址：</div>
		        <div class="cell-right"><input type="text" class="cell-input" placeholder="请填写邮寄地址" autocomplete="off" id="address" /></div>
		    </div>
		</div>
		<div class="m-button">
		    <button type="button" id="tj_dingdan" class="btn-block btn-primary">提交报名</button>
		</div>
    </section>

</section>
<link rel="stylesheet" type="text/css" href="/static/web/css/LCalendar.min.css"/>
<script type="text/javascript" src="/static/web/libs/jquery/jquery.js" ></script>
<script type="text/javascript" src="/static/web/js/LCalendar.js" ></script>
<script src="/static/web/js/ajax.js"></script>
<script src="/static/web/js/md5.js"></script>
<script type="text/javascript" src="/static/web/js/app/siginfo.js" ></script>
</body>
</html>
<script type="text/javascript">
		var calendar = new LCalendar();
		calendar.init({
			'trigger': '#credit_time', //标签id
			'type': 'date', //date 调出日期选择 datetime 调出日期时间选择 time 调出时间选择 ym 调出年月选择,
		});
		

	</script>