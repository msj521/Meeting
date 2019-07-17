<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:84:"/home/wwwroot/default/SIFIC/public/../application/web/view/meeting/add_abstract.html";i:1548137783;s:67:"/home/wwwroot/default/SIFIC/application/web/view/public/header.html";i:1548638819;s:67:"/home/wwwroot/default/SIFIC/application/web/view/public/mbxue2.html";i:1545116695;s:67:"/home/wwwroot/default/SIFIC/application/web/view/public/footer.html";i:1540200495;}*/ ?>
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
			<div class="abstract_list" >
				<div class="title_abs_list">
					<div class="title_abs">添加作者</div>
					<div class="title_abs_rg">
						<div class="opt">
							<input class="magic-checkbox" type="checkbox" name="myinfo" id="red" value="2">
							<label for="red" style="color: #598DC4;">使用我的注册信息</label>
						</div>
					</div>
				</div>
				<table class="abs_table table table-bordered" style="margin-bottom: 10px;">
						<thead>
							<th>姓名</th>
							<th>单位</th>
							<th>地址</th>
							<th>手机</th>
							<th>邮箱</th>
							<th>文章作者</th>
							<th>通讯作者</th>
							<th>管理</th>
						</thead>
						
						<tbody>
							
						</tbody>
					</table>
					<p style="text-align: center; color: #232323; font-size: 16px; margin-bottom: 15px;">每篇摘要必须包含以下文章作者、通讯作者，请选择作者身份，并在填写信息后点击添加作者，以完成保存。</p>
					<div class="abs_txtlist">
						<div class="radio_div">
							<div id="" style="margin:0px auto; width: 80%;">
								<div class="radio_list" style="margin-left: 40px;">
									<div class="opt">
										<input class="magic-radio" type="radio" name="zhuz" id="zhuz" value="1" checked>
										<label for="zhuz">文章作者</label>
									</div>
								</div>
								<div class="radio_list" style="margin-left: 100px;">
									<div class="opt">
										<input class="magic-radio" type="radio" name="zhuz" id="zhuz1" value="2">
										<label for="zhuz1">通讯作者</label>
									</div>
								</div>
								<div class="radio_list" style="margin-left: 100px;">
									<div class="opt">
										<input class="magic-radio" type="radio" name="zhuz" id="zhuz2" value="3">
										<label for="zhuz2">其他作者</label>
									</div>
								</div>
							</div>
						</div>
						<div class="abs_input">
							<div id="" style="margin:0px auto; width: 80%;">
								<div class="abs_inputlist">
									<div class="abs_input_lf">
										姓名<span>*</span>
									</div>
									<div class="abs_input_rg">
										<input type="text" name="" id="name" value="" class="pusinput" />
									</div>
								</div>
								<div class="abs_inputlist">
									<div class="abs_input_lf">
										单位<span>*</span>
									</div>
									<div class="abs_input_rg">
										<input type="text" name="" id="job_jib" value=""  class="pusinput"/>
									</div>
								</div>
								<div class="abs_inputlist hideinput">
									<div class="abs_input_lf">
										地址<span>*</span>
									</div>
									<div class="abs_input_rg">
										<input type="text" name="" id="address" value=""  class="pusinput"/>
									</div>
								</div>
								<div class="abs_inputlist">
									<div class="abs_input_lf">
										手机号<span id="phone">*</span>
									</div>
									<div class="abs_input_rg">
										<div style="float: left;">
											<input type="text" name="" id="quhao" value="" style="width: 99px;" class="pusinput"/>
										</div>
										<div style="float: left; line-height: 40px;">-</div>
										<div style="float: left;">
											<input type="text" name="" id="tel" value="" style="width: 295px;" class="pusinput"/>
										</div>
										<p style="color: #CF0909; font-size: 12px;">（例如：86-137****10）</p>
									</div>
								</div>
								<div class="abs_inputlist hideinput">
									<div class="abs_input_lf">
										邮箱<span>*</span>
									</div>
									<div class="abs_input_rg">
										<input type="text" name="" id="email" value=""  class="pusinput"/>
									</div>
								</div>
								<div class="abs_btn01">
									<input type="button" name="" id="add_worker" value="添加作者" />
								</div>
							</div>
						</div>
					</div>
				<div class="title_abs_list">
					<div class="title_abs">基本信息</div>
				</div>
				<div class="abs_txtlist">
					<div id="" style="margin:0px auto; width: 80%;">
						<div class="abs_inputlist">
							<div class="abs_input_lf">
								标题<span>*</span>
							</div>
							<div class="abs_input_rg">
								<input type="text" name="" id="titles" value=""  />
							</div>
						</div>
						<div class="abs_inputlist">
							<div class="abs_input_lf">
								关键字<span>*</span>
							</div>
							<div class="abs_input_rg">
								<input type="text" name="" id="keyword" value=""  />
								<div class="annual_tips_no2">
									*请用逗号划分每个关键词
								</div>
							</div>
						</div>
						<div class="abs_inputlist">
							<div class="abs_input_lf">
								所属专题<span>*</span>
							</div>
							<div class="abs_input_rg">
								 <select id="special" class="form-control "  data-live-search="true">
							       <option value="0" >请选择</option>
							 	 </select>
							</div>
						</div>
						<div class="abs_inputlist">
							<div style="float: left; font-size: 16px;">请选择您摘要希望发表的形式<span style="color: red;">*</span></div>
							<div style="width: 150px; float: left;">
								<div class="radio_list" style="margin-left: 20px;">
									<div class="opt">
										<input class="magic-radio" type="radio" name="xw" id="xw" value="1">
										<label for="xw">口头和壁报</label>
									</div>
								</div>
							</div>
							<div style="width: 150px; float: left;">
								<div class="radio_list" style="margin-left: 20px;">
									<div class="opt">
										<input class="magic-radio" type="radio" name="xw" id="xw1" value="2">
										<label for="xw1">壁报</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="title_abs_list">
					<div class="title_abs">摘要信息</div>
				</div>
				<div class="abs_txtlist">
					<div class="abs_inputlist">
						<div class="abs_input_lf">
							目的<span>*</span>
						</div>
						<div class="abs_input_rg" style="width: 500px;">
							<textarea class="abs_textarea" id="objective"></textarea>
							<div class="str_number">
								(最多<span id="text-count">200</span>字符)
							</div>
						</div>
					</div>
					<div class="abs_inputlist">
						<div class="abs_input_lf">
							方法<span>*</span>
						</div>
						<div class="abs_input_rg">
							<textarea class="abs_textarea" id="method"></textarea>
							<div class="str_number">
								(最多<span id="text-count2">600</span>字符)
							</div>
						</div>
					</div>
					<div class="abs_inputlist">
						<div class="abs_input_lf">
							结果<span>*</span>
						</div>
						<div class="abs_input_rg" style="width: 500px;">
							 <textarea class="abs_textarea" id="result"></textarea>
							 <div class="str_number">
								(最多<span id="text-count3">600</span>字符)
							</div>
						</div>
					</div>
					<div class="abs_inputlist">
						<div class="abs_input_lf">
							结论<span>*</span>
						</div>
						<div class="abs_input_rg" style="width: 500px;">
							 <textarea class="abs_textarea" id="conclusion"></textarea>
							 <div class="str_number">
								(最多<span id="text-count4">200</span>字符)
							</div>
						</div>
					</div>
					<div class="abs_btn02" style="margin-bottom: 40px;">
						<input type="button" name="" id="add_abslist" value="保存" />
					</div>
					<div class="abs_inputlist" style="margin-bottom: 0px;">
						<div class="abs_input_lf">
							&nbsp;
						</div>
						<div class="abs_input_rg" style="width: 500px;">
							<p style="color: #232323; font-size: 16px;">您是否希望提交的摘要参加《中华医院感染杂志》的评选？</p>
						</div>
					</div>
					<div class="abs_inputlist" style="margin-bottom: 0;">
						<div class="abs_input_lf">
							&nbsp;
						</div>
						<div class="abs_input_rg" style="width: 500px;" id="pingxuanlist">
							<div class="radio_list" style="margin-left: 100px;" >
								<div class="opt">
										<input class="magic-radio" type="radio" name="pingxuan" id="pingxuan" value="2"  disabled="disabled">
										<label for="pingxuan" style="color: #232323;">是</label>
								</div>
								</div>
								<div class="radio_list" style="margin-left: 100px;">
									<div class="opt">
										<input class="magic-radio" type="radio" name="pingxuan" id="pingxuan2" value="1"  disabled="disabled">
										<label for="pingxuan2" style="color: #232323;">否</label>
									</div>
								</div>
						</div>
					</div>
					<div class="abs_upload">
						<div class="abs_inputlist" >
							<div class="abs_input_lf">
								&nbsp;
							</div>
							<div class="abs_input_rg" style="width: 500px;">
								<div class="abs_file" id="" style="display: none;">
									<form class="layui-form"  method="post" enctype="multipart/form-data">
										<button type="button" class="layui-btn" id="test3" style="width: 100%; background: #232323;"><i class="layui-icon"></i>点击选择您要上传的全文</button>
									</form>
									
								</div>
							</div>
							<div class="tipls_div" style="display: none;">
								<p style="font-size: 14px; color: #555555;">上传条款：</p>
								<p style="font-size: 12px; color: #555555; padding-left: 15px; margin-bottom: 0;">1.&nbsp;全文题目需同摘要题目一致；</p>
								<p style="font-size: 12px; color: #555555; padding-left: 15px; margin-bottom: 0;">2.&nbsp;只有MS-WORD和PDF文件可以上传；</p>
								<p style="font-size: 12px; color: #555555; padding-left: 15px; margin-bottom: 0;">3.&nbsp;上传文件大小不能超过 5 MB;</p>
								<p style="font-size: 12px; color: #555555; padding-left: 15px; margin-bottom: 0;">4.&nbsp;文件名不能包含中文字符。</p>
							</div>
						</div>
					</div>
					<div class="abs_inputlist" >
						<div class="abs_input_lf">
							&nbsp;
						</div>
						<div class="careful">
							<h3>注意：</h3>
							<p>1.&nbsp;若您希望您的全文在《中华医院感染杂志》上刊出,还请您在<span>2019年5月20日</span>前在线提交摘要及全文。录用结果将由杂志社直接通知您。</p>
							<p>2.&nbsp;若您只希望参加优秀论文，优秀壁报的评选，请在<span>2018年1月1日</span>前在线提交摘要。</p>
						</div>
					</div>
					<div class="abs_inputlist" >
						<div class="abs_input_lf">
							&nbsp;
						</div>
						<div style="float: left; display: inline-block; width: 100%;">
							<div class="abs_btn02" style="margin-bottom: 40px;">
								<input type="button" name="" id="upper_level_btn" value="后退"  style="background: #979797;"/>&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="button" name="" id="add_quanwlist" value="保存" disabled />
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

<link rel="stylesheet" type="text/css" href="/static/admin/lib/layui/css/layui.css"/>
<script type="text/javascript" src="/static/admin/lib/layui/layui.js" ></script>
<script type="text/javascript" src="/static/web/js/module/add_abstract.js" ></script>
<script>



</script>