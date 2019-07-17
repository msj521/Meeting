<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:77:"/home/wwwroot/default/SIFIC/public/../application/web/view/meeting/hotel.html";i:1548213198;s:67:"/home/wwwroot/default/SIFIC/application/web/view/public/header.html";i:1548638819;s:66:"/home/wwwroot/default/SIFIC/application/web/view/public/mbxue.html";i:1545116695;s:72:"/home/wwwroot/default/SIFIC/application/web/view/public/meeting_nav.html";i:1542354791;s:67:"/home/wwwroot/default/SIFIC/application/web/view/public/footer.html";i:1540200495;}*/ ?>
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
			<div class="mbxue ellipsis" style="width: 100%;">
	位置&nbsp;>&nbsp;会议&nbsp;>&nbsp;<span id="class_name"></span>&nbsp;>&nbsp;<span id="title"></span>
</div>
<div class="mt_img_module">
	<div class="met_banner">
		<img src="" id="meeting_img" />
	</div>
</div>

<script>
	$(function(){
		if(localStorage_info!=null && localStorage_info!=""&&localStorage_info.fid==convention_id){
			var localStorage_info = JSON.parse(localStorage.getItem("convention_info"))
			$("#class_name").text(localStorage_info.class_name);
			$("#title").text(localStorage_info.convention_name)
			$("#meeting_img").attr({ src:localStorage_info.top_image_url , alt: ""})
		}else{
			var mbxurl = "api/convention/convention_base";
			var data = {"convention_id":convention_id};
		   	ajax_all_Filed("true", "true", "GET", mbxurl, "json", data, mbx);//调用	
		}
		
		function mbx(data){
			var convention_info = data.data.convention_info;
			if(convention_info!=null){
				storage.setItem('convention_info',JSON.stringify(data.data.convention_info));
				$("#class_name").text(convention_info.class_name);
				$("#title").text(convention_info.convention_name)
				$("#meeting_img").attr({ src:convention_info.top_image_url , alt: ""})
			}
		}
	})
	
</script>
			<div class="mt_nav_module">
	<div class="meeting_nav">
		<ul class="meeting_nav_ul">
		</ul>
	</div>
</div>
	
<script>
	var navLlist = Array;
 
  navLlist = [<?php echo $html ?>];
	//  navLlist=[
  //       {
  //         name: "会议中心",
  //         url:"/convention",
  //         id:1,
  //         subMenu: [
            
  //         ]
  //       },
  //       {
  //         name: "会议介绍",
  //         id:2,
  //         url:"/introduce",
  //         subMenu: [
  //           { name: "大会征文通知", suid: 21, url: "/zhwen" },
  //           { name: "会议通知", suid: 22, url: "/introduce" },
  //         ]
  //       },
  //       {
  //         name: "会议日程",
  //         url:"/schedule",
  //         id:3,
  //         subMenu: [
            
  //         ]
  //       },
  //       {
  //         name: "演讲嘉宾",
  //         url:"/expertlist",
  //         id:4,
  //         subMenu: [
  //           { name: "演讲嘉宾", suid: 41, url: "/expertlist"},
  //           { name: "会议课件", suid: 42, url: "/courseware" },
  //           { name: "资料汇编", suid: 43, url: "/assembly" },
  //           { name: "论文集", suid: 44, url: "/paperji" }
  //         ]
  //       },
  //       {
  //         name: "会场食宿",
  //         url: "/city",
  //         id:5,
  //         subMenu: [
  //           { name: "关于城市", suid: 51, url: "/city" },
  //           { name: "会议酒店", suid: 52, url: "/hotel" },
  //           { name: "会场介绍", suid: 53, url: "/huichang" },
  //           { name: "会场周边餐饮", suid: 54, url: "/diet" }
  //         ]
  //       },
  //       {
  //         name: "企业交流",
  //         url: "/manual",
  //         id:6,
  //         subMenu: [
  //           { name: "企业交流手册", suid:61, url: "/manual" },
  //           { name: "展区布局图", suid: 62, url: "/map" },
  //           { name: "支持单位", suid: 63, url: "/support" }
  //         ]
  //       },
  //       {
  //         name: "历届与荣誉",
  //         url:"/lijiejj",
  //         id:7,
  //         subMenu: [
  //           { name: "历届简介", suid: 71, url: "/lijiejj" },
  //           { name: "历届会议剪影", suid: 72, url: "/silhouette" },
  //           { name: "荣誉", suid: 73, url: "/honor" }
  //         ]
  //       },
  //       {
  //         name: "直播",
  //         url:"/metlive",
  //         id:8,
  //         subMenu: [
            
  //         ]
  //       },
  //       {
  //         name: "秘书处",
  //         id:9,
  //         url:"/mishuchu",
  //         subMenu: [
            
  //         ]
  //       }
  //     ];

	 $(function(){
	 	str=""
	 	for (i=0; i<navLlist.length;i++) {
	 		str+='<li class="navs">';
	 		
			if(navLlist[i].subMenu==''){
				 	str+='<a href="'+navLlist[i].url+'?convention_id='+convention_id+'&'+'nav_id='+navLlist[i].id+'" class="';
				 	if(navLlist[i].id==nav_id){
				 		str+='navs_a active';
				 	}else{
				 		str+='navs_a';
				 	}
				 	str+='">';
			 		str+=navLlist[i].name;
			 		str+='</a>';	
			}else{
				str+='<a href="'+navLlist[i].url+'?convention_id='+convention_id+'&nav_id='+navLlist[i].id+'" class="';
				if(navLlist[i].id==nav_id){
				 		str+='navs_a active';
				 	}else{
				 		str+='navs_a';
				 	}
				 	str+='">';
		 		str+=navLlist[i].name;
		 		str+='</a>';	
		 		str+='<div class="mt_navcts">';
		 		str+='<div class="mt_sanj">';
		 		str+='</div>';
		 		str+='<ul>';
		 			for(var j=0; j<navLlist[i].subMenu.length;j++){
		 				str+='<li>';
		 				str+='<a href="'+navLlist[i].subMenu[j].url+'?convention_id='+convention_id+'&nav_id='+navLlist[i].id+'&suid='+navLlist[i].subMenu[j].suid+'"';
		 				if (navLlist[i].subMenu[j].suid==suid) {
		 					str+='style="color:#000"';
		 				}else{
		 					str+='';
		 				}
		 				str+='>';
		 				str+=navLlist[i].subMenu[j].name;
		 				str+='</a>';
		 				str+='</li>';
		 			}
		 			
		 		str+='</ul>';
		 		str+='</div>';
			}
		
	 		str+='</li>';
	 	}
	 	$(".meeting_nav_ul").append(str);
	 })
</script>


	
	
		
		
			
        
	

			<div class="guest_txt" id="content">
				
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
		var download = "api/convention/article";
		var module = '<?php echo $module; ?>';
		console.log(module);
		function mtdownload(data){
			if(data.data.length){
				var content = htmls(data.data[0].content);
				$("#content").html(content)
			}
		}
		var data = {"convention_id":convention_id,"module":module};
   		ajax_all_Filed("true", "true", "POST", download, "json", data, mtdownload);//调用函数
</script>
