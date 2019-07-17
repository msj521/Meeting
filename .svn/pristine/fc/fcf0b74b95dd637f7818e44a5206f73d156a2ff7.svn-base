<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:89:"/home/wwwroot/default/SIFICYear/public/../application/web/view/meeting/abstract_list.html";i:1548296774;s:71:"/home/wwwroot/default/SIFICYear/application/web/view/public/header.html";i:1550653045;s:71:"/home/wwwroot/default/SIFICYear/application/web/view/public/mbxue2.html";i:1545116695;s:71:"/home/wwwroot/default/SIFICYear/application/web/view/public/footer.html";i:1540200495;}*/ ?>
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
				<div class="abstract_list_ct">
					<div class="abstract_list_title"><img src="/static/web/images/icon_list.png" />摘要列表</div>
					<table class="abs_table table table-bordered" id="table01">
						<thead>
							<th>摘要编号</th>
							<th>摘要标题</th>
							<th>所属专题</th>
							<th>呈现方式</th>
							<th>审核状态</th>
						</thead>
						
						<tbody>
							
						</tbody>
					</table>
					
					<div class="abs_btnlist">
						<input type="button" class="text_btn" value="提交摘要" />
					</div>
				</div>
				<div class="abstract_list_ct">
					<div class="abstract_list_title"><img src="/static/web/images/icon_list.png" />全文列表</div>
					<table class="abs_table table table-bordered" id="table02" style="margin-bottom: 10px;">
						<thead>
							<th>全文编号</th>
							<th>全文标题</th>
							<th>所属专题</th>
							<th>审核状态</th>
						</thead>
						
						<tbody>
							
						</tbody>
					</table>
					<p style="font-size: 14px; color: #598DC4;">注意：《中华医院感染杂志》全文提交截至日期为5月23日，请您在此截至日期前提交您的全文。</p>
					<div class="abs_btnlist">
						<input type="button" class="text_btn" value="提交全文" />
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
		var authorurl = "api/convention/paper";
		$(function(){
			function authorlist(data){
				var tablist = data.data;
				var str="";
				var str2="";
				if(data.code==200 && tablist){
					for (var i=0;i<tablist.length;i++) {
						str=str12(str,tablist[i],1);
						str2=str12(str2,tablist[i],2);
					}
					
					$("#table01 tbody").append(str);
					$("#table02 tbody").append(str2);
				}
				
			}
			var data = {"convention_id":convention_id,"uid":cook_uid};
	   		ajax_all_Filed("true", "true", "POST", authorurl, "json", data, authorlist);//调用函数
	   		
	   	$(".text_btn").click(function(){
				window.location.href='/add_abstract?convention_id='+convention_id+'';
			})
		})
		
		function str12(str,tablist,TYPE){

			if(TYPE==1){
				str+='<tr>';
				str+='<td>A0'+tablist.fid+'</td>';
				str+='<td style="width:300px;"><div class="ellipsis" style="width:300px;">';
				str+=tablist.title;
				str+='</div></td>';
				str+='<td style="width:250px;"><div class="ellipsis" style="width:250px;">';
				str+=tablist.class_name_zh;
				str+='</div></td>';
				str+='<td>';
				if(tablist.shape==1){
					str+='口头和壁报';
				}else{
					str+='壁报';
				}
				
				str+='</td>';
				str+='<td>';
				if(tablist.abstract_status==1){
					str+='待审核';
				}else if(tablist.abstract_status==2){
					str+='审核成功';
				}else{
					str+='审核失败';
				}
				str+='</td>';
				str+='</tr>';
			}
			if(TYPE==2 && tablist.yes_no==2){
				str+='<tr>';
				str+='<td>F0'+tablist.fid+'</td>';
				str+='<td style="width:300px;"><div class="ellipsis" style="width:300px;">';
				str+=tablist.title;
				str+='</div></td>';
				str+='<td style="width:250px;"><div class="ellipsis" style="width:250px;">';
				str+=tablist.class_name_zh;
				str+='</div></td>';
				str+='<td>';
				if(tablist.abstract_status==1){
					str+='待审核';
				}else if(tablist.abstract_status==2){
					str+='审核成功';
				}else{
					str+='审核失败';
				}
				str+='</td>';
				str+='</tr>';
			}
			return str;
		}
</script>
