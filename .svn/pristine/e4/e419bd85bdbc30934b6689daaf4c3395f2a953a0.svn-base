<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:79:"/home/wwwroot/default/SIFIC/public/../application/web/view/meeting/siginfo.html";i:1546078105;s:67:"/home/wwwroot/default/SIFIC/application/web/view/public/header.html";i:1548638819;s:67:"/home/wwwroot/default/SIFIC/application/web/view/public/mbxue2.html";i:1545116695;s:67:"/home/wwwroot/default/SIFIC/application/web/view/public/footer.html";i:1540200495;}*/ ?>
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
			<div class="mt_sigin_module">
				<div style="width: 940px; margin: auto;">
				<div class="title">
					<div class="title_txt2">参会类别</div>
				</div>
				<table class="table">
				  <thead>
				    <tr>
				      <th>参会类型</th>
				      <th>截止时间</th>
				      <th>备注</th>
				      <th>单价/元</th>
				      <th></th>
				    </tr>
				  </thead>
				  <tbody>
				   
				  </tbody>
				</table>
				<div class="title">
					<div class="title_txt2">参会人信息</div>
				</div>
				<div class="canh_pr">
				<div class="canh_prlist">
					<div class="canh_prlist_lf">
						参会人*
					</div>
					<div class="canh_prlist_rg">
						<input type="text" class="form-control" id="user_name" disabled>
					</div>
				</div>
				<div class="canh_prlist">
						<div class="canh_prlist_lf">
							联系方式*
						</div>
						<div class="canh_prlist_rg">
							<input type="text" class="form-control" id="tel" disabled>
						</div>
					</div>
					<div class="canh_prlist">
						<div class="canh_prlist_lf">
							单位*
						</div>
						<div class="canh_prlist_rg">
							<input type="text" class="form-control" id="org_name" disabled>
						</div>
					</div>
					<div class="canh_prlist">
						<div class="canh_prlist_lf" >
							职称*
						</div>
						<div class="canh_prlist_rg">
							<input type="text" class="form-control" id="job_name" disabled>
						</div>
					</div>
				</div>
				<div class="canh_pr" id="canh_pr">
					
				</div>
				<div class="title">
					<div class="title_txt2">学分信息填写</div>
				</div>
				<div class="canh_pr">
					<div class="canh_prlist">
						<div style="font-size: 15px; width: 100%; float: left;">此次培训是否要学分？</div>
						<div style="margin-top: 10px;  width: 100%; float: left;" id="xuefen">
							<div class="opt">
								<input class="magic-radio" type="radio" name="1" id="r2" value="2">
								<label for="r2">是</label>
							</div>
							<div class="opt">
								<input class="magic-radio" type="radio" name="1" id="r3" value="1">
								<label for="r3">否</label>
							</div>
							<!--<label><input type="radio" name="2" value="2" />是</label>&nbsp;&nbsp;&nbsp;&nbsp;
							<label><input type="radio" name="2" value="1" />否</label>-->
						</div>
						<div style="margin-top: 10px;  width: 100%; float: left; display: none;" id="turediv">
							<div class="canh_prlist">
								<div class="canh_prlist_lf">
									出生年月
								</div>
								<div class="canh_prlist_rg">
									<input type="text" name="bill_title" value="" lay-verify="date" class="form-control" id="credit_time" placeholder="选择出生年月" autocomplete="off">
								</div>
							</div>
							<div class="canh_prlist">
								<div class="canh_prlist_lf">
									职称
								</div>
								<div class="canh_prlist_rg">
									<input type="text" name="bill_title" value="" class="form-control" id="credit_title" placeholder="填写职称">
								</div>
							</div>
							<div class="canh_prlist">
								<div class="canh_prlist_lf">
									职称级别
								</div>
								<div class="canh_prlist_rg">
									<select class="form-control" id="credit_type" style="width:350px;">
										<option value="1">初级</option>
										<option value="2">中级</option>
										<option value="3">副高级以上</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="title">
					<div class="title_txt2">发票</div>
				</div>
				<div class="canh_pr">
				<div class="canh_prlist">
					<div class="canh_prlist_lf">
						发票类型*
					</div>
					<div class="canh_prlist_rg">
						<div class="invoice" id="f1">普通发票</div>
						<div class="invoice" id="f2">增值税专用发票</div>
						<input type="text" name="bill_type"  id="bill_type" value="普通发票" style="display: none;" />
					</div>
				</div>
				<div class="canh_prlist">
					<div class="canh_prlist_lf">
						发票抬头<span style="color: red;">*</span>
					</div>
					<div class="canh_prlist_rg">
						<input type="text" name="bill_title" value="" class="form-control" id="bill_title" placeholder="填写公司名称">
					</div>
				</div>
				<div class="canh_prlist">
					<div class="canh_prlist_lf">
						税号<span style="color: red;">*</span>
					</div>
					<div class="canh_prlist_rg">
						<input type="text" name="tax_num" value="" class="form-control" id="tax_num" placeholder="填写纳税人识别号"> 
					</div>
				</div>
				<div class="canh_prlist" id="khuh" style="display: none;">
					<div class="canh_prlist_lf">
						开户行<span style="color: red;">*</span>
					</div>
					<div class="canh_prlist_rg">
						<input type="text" name="account_bank" value="" class="form-control" id="account_bank" placeholder="请填写">
					</div>
				</div>
				<div class="canh_prlist">
					<div class="canh_prlist_lf">
						地址
					</div>
					<div class="canh_prlist_rg">
						<input type="text" name="sign_addr" class="form-control" id="sign_addr" placeholder="填写公司地址">
					</div>
				</div>
				<div class="canh_prlist">
					<div class="canh_prlist_lf">
						电话
					</div>
					<div class="canh_prlist_rg">
						<input type="text" name="sign_tel" value="" class="form-control" id="sign_tel" placeholder="填写公司电话">
					</div>
				</div>
				
				<div class="canh_prlist">
					<div class="canh_prlist_lf">
						账号
					</div>
					<div class="canh_prlist_rg">
						<input type="text" name="" value="" class="form-control" id="account" placeholder="填写开户行账号">
					</div>
				</div>
				<div class="canh_prlist">
					<div class="canh_prlist_lf">
						邮寄地址<span style="color: red;">*</span>
					</div>
					<div class="canh_prlist_rg">
						<input type="text" name="address" value="" class="form-control" id="address" placeholder="公司或住址以便您的签收">
					</div>
				</div>
				<div class="canh_prlist" style="text-align: center; margin-top: 20px;">
					<button class="tijiao_btn" id="tj_dingdan">提交订单</button>
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

<link rel="stylesheet" type="text/css" href="/static/admin/lib/layui/css/layui.css"/>
<script type="text/javascript" src="/static/admin/lib/layui/layui.js" ></script>
<script type="text/javascript" src="/static/web/js/module/meeting_siginfo.js" ></script>
<script>
$(function(){
		layui.use('laydate', function () {
		   var laydate = layui.laydate;
		   laydate.render({
			   elem: '#credit_time'
		   });
	   });

})

</script>
