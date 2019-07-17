<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:98:"/home/wwwroot/default/SIFICYear/public/../application/web/view/meeting/annual_meeting_payment.html";i:1551074010;s:71:"/home/wwwroot/default/SIFICYear/application/web/view/public/header.html";i:1550653045;s:71:"/home/wwwroot/default/SIFICYear/application/web/view/public/mbxue2.html";i:1545116695;s:71:"/home/wwwroot/default/SIFICYear/application/web/view/public/footer.html";i:1540200495;}*/ ?>
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
					<li class="noenli"><a href="/" class="active">会议</a></li>
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
			<div class="abstract_list" >
				<div class="content02">
				<div class="title_abs_list" style="margin-bottom: 30px;">
					<div class="title_abs">在线支付&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #598DC4; font-size: 12px;">在线支付只接收人民币支付</span></div>
				</div>
					<div class="abs_txtlist">
						<div class="abs_input">
							<div id="" style="margin:0px auto; width: 80%;">
								<div class="abs_inputlist">
									<div class="abs_input_lf">
										总注册费
									</div>
									<div class="abs_input_rg">
										<div class="pay_info" id="price"></div>
									</div>
								</div>
								<div class="abs_inputlist">
									<div class="abs_input_lf">
										注册编号
									</div>
									<div class="abs_input_rg">
										<div class="pay_info" id="order_number"></div>
									</div>
								</div>
								<div class="abs_inputlist">
									<div class="abs_input_lf">
										注册类别
									</div>
									<div class="abs_input_rg">
										<div class="pay_info ellipsis" style="color: #239397;" id="ticket_name"></div>
									</div>
								</div>
								<div class="abs_inputlist">
									<div class="abs_input_lf">
										总价
									</div>
									<div class="abs_input_rg">
										<div class="pay_info" id="all_price"></div>
									</div>
								</div>
								<!--<div class="abs_inputlist">
									<div class="abs_input_lf">
										付费状态
									</div>
									<div class="abs_input_rg">
										<div class="pay_info">未支付</div>
									</div>
								</div>-->
								<p style=" color:#D03F3F; margin-bottom: 0;">注意：</p>
								<p style=" color:#D03F3F; text-indent:35px">注册过程中所产生的所有银行手续费将由参会者自行承担，注册服务处只接受支付了全额会议费的参会者，敬请谅解。 请在您的付款单上表明参会者的注册编号及姓名，请确保信息的准确性和完整性，以便于尽快确认您的付款信息，谢谢！</p>
								<div style="float: left; display: inline-block; width: 80%;">
									<div class="abs_btn02" style="margin-top: 40px;">
										<input type="button" name="" id="s_step" value="上一步"  style="background: #979797;"/>&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="button" name="" id="btt" value="立即支付" />
									</div>
								</div>
							</div>
						</div>
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
		var order_url = 'api/convention/order' //订单接口
		var data = {
			"convention_id": convention_id,
			"uid": cook_uid,
		};
		ajax_all_Filed("true", "true", "POST", order_url, "json", data, order); //调用函数
		
		$("#s_step").click(function(){
			window.location.href='/annual_meeting?convention_id='+convention_id
		})		
		
		$("#btt").click(function(){
			window.location.href='/api/convention/return_url?test=123&convention_id='+convention_id+'&uid='+cook_uid
		})
	})
	
	function order(data){
		var orderinfo = data.orderinfo;
		$("#price").text('¥'+orderinfo.price);
		$("#order_number").text(orderinfo.order_number);
		$("#ticket_name").text(orderinfo.ticket_name);
		$("#all_price").text('¥'+orderinfo.price)
		
	}
</script>