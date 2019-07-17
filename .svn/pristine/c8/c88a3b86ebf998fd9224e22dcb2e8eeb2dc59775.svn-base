<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"/home/wwwroot/default/SIFICYear/public/../application/web/view/register/register.html";i:1547456414;s:71:"/home/wwwroot/default/SIFICYear/application/web/view/public/header.html";i:1550653045;s:71:"/home/wwwroot/default/SIFICYear/application/web/view/public/footer.html";i:1540200495;}*/ ?>
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
			<div class="retrieve_list" style="height: 1200px; margin-bottom: 20px;">
				<div class="retrieve_title">
					<h1>创建账号</h1>
				</div>
					<div class="retrieve_txt">
					<div class="retrieve_tb">
						<div class="rt_lf">手机号</div>
						<div class="rt_rg"><input type="text" id="tel" value="" class="jianting ret_input" placeholder="请输入手机号" />
							<div></div>
						</div>
					</div>
					
					<div class="retrieve_tb">
						<div class="rt_lf">验证码</div>
						<div class="rt_rg">
							<input type="text" id="message" value="" class="jianting ret_input" placeholder="请输入验证码" style="width: 180px; float: left;"/>
						<input type="button" class="yzm_btn" id="yzm_btn" value="免费获取验证码" style="float: right; width: 110px;"  onclick="settime(this);"/>
							<div style="margin-top: 12px;"></div>
						</div>
					</div>
					
					<div class="retrieve_tb">
						<div class="rt_lf">密码</div>
						<div class="rt_rg"><input type="password"  id="password" value="" class="jianting ret_input" placeholder="请输入至少六位数新密码" maxlength="16"/><div></div></div>
					</div>
					<div class="retrieve_tb">
						<div class="rt_lf">重复密码</div>
						<div class="rt_rg"><input type="password"  id="password2" value="" class="jianting ret_input" placeholder="请重复新密码" maxlength="16"/><div></div></div>
					</div>
					<div class="retrieve_tb">
						<div class="rt_lf">姓名</div>
						<div class="rt_rg"><input type="text" id="user_name" value="" class="jianting ret_input" placeholder="请输入真实姓名" /><div></div></div>
					</div>
					<div class="retrieve_tb">
						<div class="rt_lf">邮箱</div>
						<div class="rt_rg"><input type="text" id="email" value="" class="jianting ret_input" placeholder="请输入邮箱" />
							<div></div>
						</div>
					</div>
					<div class="retrieve_tb">
						<div class="rt_lf">省</div>
						<div class="rt_rg">
						<select class="form-control" id="region_s" style="float: left; width:100%; height: 40px;">
					      <option value="0">请选择省</option>
					  </select>
						</div>
					</div>
					<div class="retrieve_tb">
						<div class="rt_lf">市</div>
						<div class="rt_rg">
						<select class="form-control" id="region_ss" style="float: left; width:100%; height: 40px;">
					      
					  </select>
						</div>
					</div>
					<div class="retrieve_tb">
						<div class="rt_lf">区</div>
						<div class="rt_rg">
						<select class="form-control" id="region_sss" style="float: left; width:100%; height: 40px;">
					      
					  </select>
						</div>
					</div>
					<div class="retrieve_tb">
						<form class="layui-form" action="">
						<div class="rt_lf">所属单位</div>
						<div class="rt_rg">
							 <select id="org_id" class="form-control selectpicker "  data-live-search="true">
							        <option value="0">请选择单位</option>
							  </select>
						</div>

						</form>
						  
					</div>
					<div class="retrieve_tb" id="beyong" style="display: none;">
						<div class="rt_lf">备注单位</div>
						<div class="rt_rg">
							<input type="text" name="" id="diy_org" value="" class="ret_input" placeholder="找不到合适单位请填写"/>
						</div>
					</div>
					<div class="retrieve_tb">
						<div class="rt_lf">部门/科室</div>
						<div class="rt_rg">
							 <select id="deparitment" class="form-control pulic_select"  data-live-search="true">
						        <option value="0">请选择部门/科室</option>
						 	</select>
						</div>
					</div>
					<div class="retrieve_tb">
						<div class="rt_lf">职位</div>
						<div class="rt_rg">
							<input type="text" name="" id="job_id" value="" class="ret_input" placeholder="请填写职位"/>
						</div>
					</div>
					<div class="retrieve_tb">
						<div class="rt_lf">职称级别</div>
						<div class="rt_rg">
							<select class="form-control" id="credit_type" style="float: left; width:100%; height: 40px;">
						      <option value="0">请选职称级别</option>
						  </select>
						</div>
					</div>
					<div class="retrieve_tb">
						<div class="rt_lf">职称</div>
						<div class="rt_rg">
							<select class="form-control" id="credit_title" style="float: left; width:100%; height: 40px;">
						      <option value="0">请选择职称</option>

						  </select>
						</div>
					</div>
					<div class="retrieve_tb">
						<div class="rt_lf">学历</div>
						<div class="rt_rg">
							<select class="form-control" id="education_id" style="float: left; width:100%; height: 40px;">
						      <option value="0">请选学历</option>
						     
						  </select>
						</div>
					</div>
					<div style="margin-left: 90px;">
						<label><input type="checkbox" name="" id="rg_checkbox" value="" />已阅读并同意</label><a href="/xieyi" target="_blank">《公司协议》</a>
					</div>
					<div class="retrieve_tb">
						<div class="rt_lf">&nbsp;</div>
						<div class="rt_rg"><button class="retrieve_btn" id="retrieve_btn">立即创建</button></div>
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

<script type="text/javascript" src="/static/web/js/module/register.js" ></script>

  

 <script type="text/javascript">
        $(window).on('load', function () {
 
            $('.selectpicker').selectpicker({
                'selectedText': 'cat'
            });
 
            // $('.selectpicker').selectpicker('hide');
        });
    </script>
