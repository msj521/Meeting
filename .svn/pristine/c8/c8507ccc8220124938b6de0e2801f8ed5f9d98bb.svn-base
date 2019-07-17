<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:90:"/home/wwwroot/default/SIFICYear/public/../application/web/view/meeting/annual_meeting.html";i:1548310090;s:71:"/home/wwwroot/default/SIFICYear/application/web/view/public/header.html";i:1550653045;s:71:"/home/wwwroot/default/SIFICYear/application/web/view/public/mbxue2.html";i:1545116695;s:71:"/home/wwwroot/default/SIFICYear/application/web/view/public/footer.html";i:1540200495;}*/ ?>
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


    	
<link rel="stylesheet" type="text/css" href="/static/web/css/bootstrap-select.css"> 
<script type="text/javascript" src="/static/web/libs/bootstrap/bootstrap_select.js"></script> 
 <script type="text/javascript" src="/static/web/libs/bootstrap/bootstrap.min.js"></script>
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
				<div class="content01">
				<div class="title_abs_list" style="margin-bottom: 30px;">
					<div class="title_abs" >个人信息   <div id="title_abs" style="position: absolute; z-index:1; margin-left: 100px; margin-top: -25px;"></div></div>
				</div>
					<div class="abs_txtlist">
						<div class="abs_input">
							<div id="" style="margin:0px auto; width: 80%;">
								<div class="abs_inputlist">
									<div class="abs_input_lf">
										邮箱<span>*</span>
									</div>
									<div class="abs_input_rg">
										<input type="text" name="" id="email" value=""  />
										<div class="annual_tips_ys"></div>
									</div>
								</div>
								<div class="abs_inputlist">
									<div class="abs_input_lf">
										名字<span>*</span>
									</div>
									<div class="abs_input_rg">
										<div class="getinfo">
											<input type="button" id="getinfo_btn" value="获取个人信息" />
										</div>
										<input type="text" name="" id="user_name" value=""  />
										<div class="annual_tips_ys" style="margin-left: 530px;"></div>
										<p style="color: #598DC4;">（如果您去年注册过，请填写去年注册所用的邮箱及姓名，点击获取个人信息，即可显示您的信息，请仔细核对您的信息，如果没有，请直接填写。）</p>
										
									</div>
								</div>
								<div class="abs_inputlist">
									<div class="abs_input_lf">
										是否需要学分<span>*</span>
									</div>
									<div class="abs_input_rg">
										 <select class="form-control pulic_select"  data-live-search="true" id="credit_status">
									        <option value="0">请选择</option>
									        <option value="1">是</option>
									        <option value="2">否</option>
									 	 </select>
									 	 <div class="annual_tips_ys"></div>
									</div>
								</div>
								
								<div class="abs_inputlist hideinput">
									<div class="abs_input_lf">
										出生年月<span>*</span>
									</div>
									<div class="abs_input_rg">
										<input type="text" class="Myclass_timeselect clssdatetime" name="" id="credit_time" value=""  />
										<div class="annual_tips_ys"></div>
									</div>
								</div>
								
								<div class="abs_inputlist hideinput">
									<div class="abs_input_lf">
										称谓<span>*</span>
									</div>
									<div class="abs_input_rg">
										 <select class="form-control pulic_select"  data-live-search="true" id="gender">
									        <option value="0">请选择</option>
									        <option value="1">先生</option>
									        <option value="2">女士</option>
									 	 </select>
									 	 <div class="annual_tips_ys"></div>
									</div>
								</div>
								<div class="abs_inputlist hideinput">
									<div class="abs_input_lf">
										职位<span>*</span>
									</div>
									<div class="abs_input_rg">
										<input type="text" name="" id="job_id" value=""  />
									 	 <div class="annual_tips_ys"></div>
									</div>
								</div>
								<div class="abs_inputlist hideinput">
									<div class="abs_input_lf">
										部门/科室<span>*</span>
									</div>
									<div class="abs_input_rg">
										 <select id="deparitment" class="form-control pulic_select"  data-live-search="true">
									        <option value="0">请选择</option>
									 	 </select>
									 	 <div class="annual_tips_ys"></div>
									</div>
								</div>
								<div class="abs_inputlist hideinput">
									<div class="abs_input_lf">
										职称级别<span>*</span>
									</div>
									<div class="abs_input_rg">
										 <select id="credit_type" class="form-control pulic_select"  data-live-search="true">
									        
									 	 </select>
									 	 <div class="annual_tips_ys"></div>
									</div>
								</div>
								<div class="abs_inputlist hideinput">
									<div class="abs_input_lf">
										职称<span>*</span>
									</div>
									<div class="abs_input_rg">
										 <select id="credit_title" class="form-control pulic_select"  data-live-search="true">
									        <option value="0">请选择</option>
									 	 </select>
									 	 <div class="annual_tips_ys"></div>
									</div>
								</div>
								<div class="abs_inputlist hideinput">
									<div class="abs_input_lf">
										是否来自基层<span>*</span>
									</div>
									<div class="abs_input_rg">
										 <select id="basic_level" class="form-control pulic_select"  data-live-search="true">
									        <option value="">请选择</option>
									        <option value="1">是</option>
									        <option value="0">否</option>
									 	 </select>
									 	 <div class="annual_tips_ys"></div>
									</div>
								</div>
								<div class="abs_inputlist hideinput">
									<div class="abs_input_lf">
										毕业时间<span>*</span>
									</div>
									<div class="abs_input_rg">
										<input type="text" class="Myclass_timeselect clssdatetime" name="" id="graduation_time" value=""  />
										<div class="annual_tips_ys"></div>
									</div>
								</div>
								<div class="abs_inputlist hideinput">
									<div class="abs_input_lf">
										最高学历<span>*</span>
									</div>
									<div class="abs_input_rg">
										 <select id="education_id" class="form-control pulic_select"  data-live-search="true">
									        <option value="0">请选择</option>
									 	 </select>
									 	 <div class="annual_tips_ys"></div>
									</div>
								</div>
								<div class="abs_inputlist hideinput">
									<div class="abs_input_lf">
										学位<span>*</span>
									</div>
									<div class="abs_input_rg">
										 <select id="degree_id" class="form-control pulic_select"  data-live-search="true">
									        <option value="0">请选择</option>
									 	 </select>
									 	 <div class="annual_tips_ys"></div>
									</div>
								</div>
								<!--<div class="abs_inputlist hideinput">
									<div class="abs_input_lf">
										国家<span>*</span>
									</div>
									<div class="abs_input_rg">
										 <select id="" class="form-control selectpicker "  data-live-search="true">
									        <option value="">请选择</option>
									        <option value="">是</option>
									        <option value="">否</option>
									 	 </select>
									</div>
								</div>-->
								<div class="abs_inputlist hideinput">
									<div class="abs_input_lf">
										省份/城市<span>*</span>
									</div>
									<div class="abs_input_rg">
										 <select id="province_id" class="form-control"  data-live-search="true" style="width: 47%; float: left;">
									        <option value="0">请选择</option>
									 	 </select>
									 	 <select id="city_id" class="form-control"  data-live-search="true" style="width: 47%; float: left; margin-left: 6%;">
									        <option value="0">请选择</option>
									 	 </select>
									 	 <div class="annual_tips_ys" id="ss_tilps" style="margin-top: 10px;"></div>
									</div>
								</div>
								<div class="abs_inputlist hideinput">
									<div class="abs_input_lf">
										单位/企业<span>*</span>
									</div>
									<div class="abs_input_rg">
										 <select id="org_id" class="form-control selectpicker"  data-live-search="true">
									    
									 	 </select>
									 	 <div class="annual_tips_ys"></div>
									 	 <p style="color: #598DC4;">如果您未在以上列表中查找到您的单位信息，请选择其他， 并请填写备注单位</p>
									</div>
								</div>
								<div class="abs_inputlist" id="diy_orglist" style="display: none;">
									<div class="abs_input_lf">
										备注单位<span>*</span>
									</div>
									<div class="abs_input_rg">
										<input type="text" name="" id="diy_org" value="" />
										 <div class="annual_tips_ys"></div>
									</div>
								</div>
								<div class="abs_inputlist">
									<div class="abs_input_lf">
										单位地址<span>*</span>
									</div>
									<div class="abs_input_rg">
										<input type="text" name="" id="unit_address" value="" />
										 <div class="annual_tips_ys"></div>
									</div>
								</div>
								<div class="abs_inputlist">
									<div class="abs_input_lf">
										身份证<span>*</span>
									</div>
									<div class="abs_input_rg">
										<input type="text" name="" id="card" value="" />
										 <div class="annual_tips_ys"></div>
									</div>
								</div>
								<div class="abs_inputlist">
									<div class="abs_input_lf">
										单位电话<span>*</span>
									</div>
									<div class="abs_input_rg">
										<div style="float: left;">
											<input type="text" name="" id="unit_tel_guo" value="" style="width: 60px;" />
										</div>
										<div style="float: left; margin-left: 10px;">
											<input type="text" name="" id="unit_tel_qu" value="" style="width: 60px;" />
										</div>
										<div style="float: right;">
											<input type="text" name="" id="unit_tel" value="" style="width: 260px;" />
										</div>
										 <div class="annual_tips_ys" id="unit_tel_tips" style="margin-top: 10px;"></div>
										<p style="color: #598DC4; ">（国家代码+区号，例如：86-21-12345678）</p>
									</div>
								</div>
								<div class="abs_inputlist">
									<div class="abs_input_lf">
										单位传真<span>*</span>
									</div>
									<div class="abs_input_rg">
										<div style="float: left;">
											<input type="text" name="" id="unit_fax_guo" value="" style="width: 60px;" />
										</div>
										<div style="float: left; margin-left: 10px;">
											<input type="text" name="" id="unit_fax_qu" value="" style="width: 60px;" />
										</div>
										<div style="float:right;">
											<input type="text" name="" id="unit_fax" value="" style="width: 260px;" />
										</div>
										 <div class="annual_tips_ys" id="unit_fax_tips" style="margin-top:10px;"></div>
										<p style="color: #598DC4; ">（国家代码+区号，例如：86-21-12345678）</p>
									</div>
								</div>
								<div class="abs_inputlist">
									<div class="abs_input_lf">
										手机号<span>*</span>
									</div>
									<div class="abs_input_rg">
										<div style="float: left;">
											<input type="text" name="" id="tel_qu" value="" style="width: 60px;" />
										</div>
										<div style="float: right;">
											<input type="text" name="" id="tel" value="" style="width: 330px;" />
										</div>
										<div class="annual_tips_ys" style="margin-top: 10px;" id="tel_tips"></div>
										<p style="color: #598DC4;">（例如：86-137***10）</p>
									</div>
								</div>
								
								<div style="float: left; display: inline-block; width: 100%;">
									<div class="abs_btn02" style="margin-bottom: 40px;">
										<input type="button" onclick="btns()"  value="上一步"  style="background: #979797;"/>&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="button" name="" id="upper_info2" value="下一步" />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="content02" style="display: none;">
					<div class="title_abs_list">
						<div class="title_abs">注册类别 <div id="title_abs2" style="position: absolute; z-index:1; margin-left: 100px; margin-top: -25px;"></div></div>
					</div>
					<table class="table table-bordered annual_table">
					  <tbody>
					   
					    
					  </tbody>
					</table>
					<div id="title_abs3"></div>
					
					<div style="display: inline-block; width: 100%; margin-top: 10px;">
						<div class="abs_inputlist">
							<div class="abs_input_lf" style="width: 150px;">
							预计到会日期<span>*</span>：
							</div>
							<div class="abs_input_rg">
								<select id="start_time" class="form-control"  data-live-search="true">
									<option value="0">请选择时间</option>
								</select>
								<div class="annual_tips_ys"></div>
							</div>
						</div>
						<div class="abs_inputlist">
							<div class="abs_input_lf" style="width: 150px;">
							预计离开日期<span>*</span>：
							</div>
							<div class="abs_input_rg">
								<select id="end_time" class="form-control"  data-live-search="true">
									<option value="0">请选择时间</option>
								</select>
								<div class="annual_tips_ys"></div>
							</div>
						</div>
						<div class="abs_inputlist">
							<div class="abs_input_lf" style="width: 150px;">
							是否需要发票<span>*</span>：
							</div>
							<div class="abs_input_rg">
								<div class="radio_list">
									<div class="opt" style="margin-top: 10px;">
										<input class="magic-radio" type="radio" name="fp" id="fp1" value="1" checked>
										<label for="fp1">是</label>
									</div>
								</div>
								<div class="radio_list" style="margin-left: 10px;">
									<div class="opt" style="margin-top: 10px;">
										<input class="magic-radio" type="radio" name="fp" id="fp2" value="0">
										<label for="fp2">否</label>
									</div>
								</div>
								
							</div>
						</div>
						<div id="title_abs4" style="padding-left: 33px;"></div>
					</div>
					<div class="title_abs_list">
						<div class="title_abs">选择支付方式</div>
					</div>
					<div class="paymentlist">
						<!--<div href="jacascript::void(0)" id="xianx"><img src="/static/web/images/icon_underlinenormal.png" />线下支付</div>-->
						<!--<div href="jacascript::void(0)" id="xians"><img src="/static/web/images/icon_onlinenormal.png" />在线支付</div>-->
						<div href="jacascript::void(0)" id="xians" class="active"><img src="/static/web/images/icon_onlineselected.png" />在线支付</div>
					</div>
					<div style="float: left; display: inline-block; width: 100%; margin-top: 50px;">
						<div class="abs_btn02" style="margin-bottom: 40px;">
							<input type="button" name="" id="upper_info" value="上一步"  style="background: #979797;"/>&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="button" name="" id="annual_btn" value="提交" />
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
<script type="text/javascript" src="/static/web/js/module/annual_siginfo.js" ></script>
<script type="text/javascript" src="/static/web/js/annual_form.js" ></script>
<script>
$(function(){
 var $div_li =$(".paymentlist div");
		 var xianxia = "线下支付";
		 var xians ="在线支付"
		    $div_li.click(function(){
				$(this).addClass("active")            //当前<li>元素高亮
					   .siblings().removeClass("active");  //去掉其他同辈<li>元素的高亮
			if($(this).text()==xianxia){
				$(this).children('img').attr('src','/static/web/images/icon_underlineselected.png')
				$(this).siblings().children('img').attr('src','/static/web/images/icon_onlinenormal.png')
			}else{
				$(this).children('img').attr('src','/static/web/images/icon_underlinenormal.png')
				$(this).siblings().children('img').attr('src','/static/web/images/icon_onlineselected.png')
			}
			if($(this).text()==xians){
				$(this).children('img').attr('src','/static/web/images/icon_onlineselected.png')
				$(this).siblings().children('img').attr('src','/static/web/images/icon_underlinenormal.png')
			}else{
				$(this).children('img').attr('src','/static/web/images/icon_underlineselected.png')
				$(this).siblings().children('img').attr('src','/static/web/images/icon_onlinenormal.png')
			}
	})
		    

	// 遍历时间空间
	$('.Myclass_timeselect').each(function(){
		var id = '#'+$(this).attr("id");
			layui.use('laydate', function(){
				var laydate = layui.laydate;
				laydate.render({
					elem:id,
					done: function(value, date){
				     pcredit_time(id)
				    }
				});
			})
	})
})
function btns(){
	window.location.href='/convention?convention_id='+convention_id+'&nav_id=1'
}
 $(window).on('load', function () {
    $('.selectpicker').selectpicker({
        'selectedText': 'cat'
    });
            // $('.selectpicker').selectpicker('hide');
});
</script>
