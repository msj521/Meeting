<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"/home/wwwroot/default/SIFIC/public/../application/web/view/public/ip_annual_meeting02.html";i:1548229970;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>参会选票</title>
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
<body style="background: #F1F4F6;">
<section class="g-flexview">
    <section class="g-scrollview">
    	<div id="title_abs2" style="padding: 0.2rem;  display: inline-block; width: 100%;"></div>
    	<div class="xuanpiaolist">
    		<ul class="xuanpiao_ul">
				
			</ul>
    	</div>
		
		
		<div id="title_abs3" style="padding: 0.2rem;  display: inline-block; width: 100%;"></div>
		
    	
    	<div class="bottomlist">
    		<div class="zonge">
    			<span class="heji">合计：</span><span class="numbers"></span>
    		</div>
    		<input type="button" name="" id="next_btn2" value="下一步" class="next_btn"/>
    	</div>
    </section>
</section>
<link rel="stylesheet" type="text/css" href="/static/web/css/LCalendar.min.css"/>
<script type="text/javascript" src="/static/web/libs/jquery/jquery.js" ></script>
<script type="text/javascript" src="/static/web/js/LCalendar.js" ></script>
<script src="/static/web/js/ajax.js"></script>
<script src="/static/web/js/md5.js"></script>

</body>
</html>
<script type="text/javascript">
	$(function(){
		var siginfourl = "/api/convention/sign";
		var userurl = "/api/convention/personal";
		var ticket_id ="";
		
		function userinfo(data) {
			var take_care = data.data.take_care;
			if(take_care){
				$(take_care[2]).appendTo("#title_abs2");
				$(take_care[3]).appendTo("#title_abs3");
			}
			if(data.data!=undefined && data.data.pay_state == "报名成功"){
				ticket_id = data.data.ticket_id;
				$(".numbers").text(data.data.price);
			}
			
		}
		  
		var userdata = {
			"convention_id": convention_id,
			"uid": cook_uid
		};
		ajax_all_Filed("true", "true", "GET", userurl, "json", userdata, userinfo); //调用函数
		//票务加载
		function siginfo(data) {
			
			if(data==""||data==null||data==undefined) {
				return false;
			}
			var ticket_list = data.data.ticket_list;
			sign_list = data.data.sign_list;
			
			var str = "";
			for(var i = 0; i < ticket_list.length; i++) {
				valueid = ticket_list[i].user_value;
				str +='<li ';
						if(ticket_id==ticket_list[i].fid){
							str += 'class="action"';
						}
				str +='>';
					str +='<div class="mstxt_div">';
						str +='<h2>'+ticket_list[i].ticket_name;+'</h2>';
						str +='<p style="padding-top: 0.2rem;padding-bottom: 0.2rem;">时间：'+ticket_list[i].end_time.slice(0,10)+'前付款</p>';
						str +='<p style="padding-bottom: 0.2rem;" class="ellipsis">备注：' + ticket_list[i].description + '</p>';
						str +='<div class="prece">¥ '+ticket_list[i].price+'</div>';
					str +='</div>';
					str +='<div class="radio_div">';
						str +='<div class="opt">';
							str +='<input class="magic-radio" type="radio" name="2" id="'+ticket_list[i].fid + '" value="'+ticket_list[i].fid + '"';
								if(ticket_id==ticket_list[i].fid){
									str += 'checked';
								}
							str+='>';
							str +='<label for="'+ticket_list[i].fid + '"></label>';
						str +='</div>';
					str +='</div>';
				str +='</li>';
			}
			$(".xuanpiao_ul").append(str);
			if(ticket_id == "" || ticket_id == null) {
				$('.xuanpiao_ul input:radio').eq(0).attr('checked', 'true');
				$('.xuanpiao_ul li').eq(0).addClass("action");
				var prec0 = $('.xuanpiao_ul li').eq(0).children(".mstxt_div").children().children(".prece").text();
				$(".numbers").text(prec0);
			}
			
				//绑定单选checked
				$(".xuanpiao_ul li").click(function() {
					var checked = $(this).children(".opt").children(".magic-radio").is(':checked')
					if(checked == false) {
						$(this).children(".radio_div").children(".opt").children(".magic-radio").prop('checked', 'true');
					} else {
						$(this).children(".radio_div").children(".opt").children(".magic-radio").prop('checked', '');
					}
					$(this).addClass("action")            
					   .siblings().removeClass("action"); 
					var prec = $(this).children(".mstxt_div").children().children(".prece").text();
					$(".numbers").text(prec);
				})
		}
		var data = {
			"convention_id": convention_id,
			"uid": cook_uid
		};
		ajax_all_Filed("true", "true", "POST", siginfourl, "json", data, siginfo); //调用函数
		})
	
	$("#next_btn2").click(function(){
		var storage = window.localStorage;
		var ticket_list_fid = $(".xuanpiao_ul li input[type=radio]:checked").val();
		var rmbs = $(".numbers").text();
		var jsonStr  =  JSON.parse(storage.getItem("baseArr"));
			jsonStr.ticket_id =ticket_list_fid;
			jsonStr.rmbs = rmbs;
		storage.setItem("baseArr",JSON.stringify(jsonStr));
		window.location.href="/ip_annual_meeting03"
	})
	
</script>