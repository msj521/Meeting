<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:79:"/home/wwwroot/default/SIFIC/public/../application/web/view/user/mydownload.html";i:1548296841;s:67:"/home/wwwroot/default/SIFIC/application/web/view/public/header.html";i:1548638819;s:67:"/home/wwwroot/default/SIFIC/application/web/view/public/footer.html";i:1540200495;}*/ ?>
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
			<div class="userlist">
				<div class="userlf">
					<div class="userimg">
						<img src="" class="userimgs"/>
						<p><span id="nick_name"></span>&nbsp;&nbsp;<a href="javascript:void(0)"></a></p>
					</div>
					<div class="up_pwd">
						<a href="/modify">修改资料</a>&nbsp;|&nbsp;<a href="javascript:void(0)" id="update_pwd">修改密码</a>
					</div>
					<div class="user_nav">
						<a href="/userinfo" class="user_data">个人资料</a>
						<a href="/mytrain" class="user_train">我的培训</a>
						<a href="/mydownload" class="user_up user_up2">投稿中心</a>
						<a href="/shoplist" class="user_shop">购买记录</a>
						<a href="/meetingname" class="user_sign">会议报名</a>
					</div>
					<a href="javascript:void(0);" class="out">退出登录</a>
				</div>
				<div class="userrg">
					<div class="null_div" style="display: none;"></div>
					<div id="firstpane2" class="menu_list2" style="display: none; padding: 0; ">
						
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
<script type="text/javascript" src="/static/web/js/module/user.js" ></script>
<script type="text/javascript" src="/static/web/js/module/user_download.js" ></script>
<div class="pulic_t_div" style="display: none;" id="pu_pawd">
	<div class="pulic_t_divct">
		<div class="pulic_t_txt">
			<div class="daytiem_close"></div>
			<div class="pulic_t_title">修改密码</div>
			<div class="inputlist">
				<div class="inputlist_txt">
					<div class="form-group">
					    <label for="name">旧密码</label>
					    <input type="password" class="form-control" id="old_pwd" maxlength="16">
					  </div>
					  <div class="form-group">
					    <label for="name">新密码</label>
					    <input type="password" class="form-control" id="new_pwd" maxlength="16">
					  </div>
					  <div class="form-group">
					    <label for="name">重复新密码</label>
					    <input type="password" class="form-control" id="new_pwd2" maxlength="16">
					  </div>
					  <p class="tis_txt"></p>
					  <div class="pulic_btn">
					  	<button class="pulic_bt" id="pu_pawd_btn">保存</button>
					  </div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="pulic_t_div" id="class_name" style="display: none;">
	<div class="pulic_t_divct">
		<div class="pulic_t_txt">
			<div class="daytiem_close"></div>
			<div class="pulic_t_title">修改资料</div>
			<div class="inputlist">
				<div class="inputlist_txt">
					<div class="form-group">
					    <label for="name">昵称</label>
					    <input type="text" class="form-control" id="update_class_names">
					  </div>
					  <p class="tis_txt"></p>
					  <div class="pulic_btn">
					  	<button class="pulic_bt" id="update_class_name_btn">保存</button>
					  </div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="pulic_t_div" id="update_img" style="display: none;">
	<div class="pulic_t_divct">
		<div class="pulic_t_txt">
			<div class="daytiem_close"></div>
			<div class="pulic_t_title">修改头像</div>
			<div class="inputlist">
				<div class="layui-upload" style="text-align: center;">
				  <div class="layui-upload-list">
				    <img class="layui-upload-img" id="demo1" width="72" height="72">
				    <p id="demoText"></p>
				  </div>
				   <button type="button" class="layui-btn" id="test1">请选择新图片</button>
				</div>   
			</div>
		</div>
	</div>
</div>

<div class="pulic_t_div" id="abs_name" style="display: none;">
	<div class="zhaiyaolist">
		<div class="daytiem_close"></div>
		<div class="abs_div_title">
			SIFIC2019年度大会论文上传摘要信息
		</div>
		<div class="abs_div_ct">
			<table class="abs_table">
				<tr>
					<td style="width: 90px; text-align: right;">摘要编号：</td>
					<td style="text-align: left;" id="fid"></td>
				</tr>
				<tr>
					<td style="width: 90px; text-align: right;">摘要标题：</td>
					<td style="text-align: left;" id="zyaotitle"></td>
				</tr>
				<tr>
					<td style="width: 90px; text-align: right;">所属专题：</td>
					<td style="text-align: left;" id="special"></td>
				</tr>
				<tr>
					<td style="width: 90px; text-align: right;">展现形式：</td>
					<td style="text-align: left;" id="shape"></td>
				</tr>
				<tr>
					<td valign="top" style="width: 90px; text-align: right;">目的：</td>
					<td style="text-align: left;" id="objective"></td>
				</tr>
				<tr>
					<td valign="top" style="width: 90px; text-align: right;">方法：</td>
					<td style="text-align: left;" id="method"></td>
				</tr>
				<tr>
					<td valign="top" style="width: 90px; text-align: right;">结果：</td>
					<td style="text-align: left;" id="result"></td>
				</tr>
				<tr>
					<td valign="top" style="width: 90px; text-align: right;">结论：</td>
					<td style="text-align: left;" id="conclusion"></td>
				</tr>
			</table>
		</div>
		<div class="abs_btnlist">
			<input type="button" name="abs_btn" id="abs_btn" value="确定" />
		</div>
	</div>
</div>

<script>
var uploadurl = "api/user/update_user_img";
layui.use('upload', function(){
  var $ = layui.jquery
  ,upload = layui.upload;
  
  //普通图片上传
  var uploadInst = upload.render({
    elem: '#test1'
    ,url: '/upload'
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
      obj.preview(function(index, file, result){
        $('#demo1').attr('src', result); //图片链接（base64）
      });
    }
    ,done: function(res){
    	console.log(res)
      //如果上传失败
      if(res.code >200){
        return layer.msg('上传失败');
      }
      //上传成功
        function uploadinfo(data){
        	if(data.code==200){
        		showLaert(data.msg)
   	 			$("#alert_btn").on('click',function(){
					window.location.reload()
				})
        	}
        }
        var uploaddata = {"wab_image_id":res.data,"creator_id":cook_uid};
   		ajax_all_Filed("true", "true", "POST", uploadurl, "json", uploaddata, uploadinfo);//调用函数	
    }
    ,error: function(){
      //演示失败状态，并实现重传
      var demoText = $('#demoText');
      demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
      demoText.find('.demo-reload').on('click', function(){
        uploadInst.upload();
      });
    }
  });

});
$(function(){
	$("#abs_btn").click(function(){
		$(".pulic_t_div").hide()
	})
})
</script>