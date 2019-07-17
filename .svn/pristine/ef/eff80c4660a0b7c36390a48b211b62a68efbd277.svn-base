<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:78:"/home/wwwroot/default/SIFIC/public/../application/admin/view/version/edit.html";i:1547781990;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1548327812;}*/ ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo (isset($title) && ($title !== '')?$title:'SIFIC后台管理'); ?></title>
  <meta name="renderer" content="webkit|ie-comp|ie-stand">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>

  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
  <link rel="stylesheet" href="/static/admin/css/font.css">
  <link rel="stylesheet" href="/static/admin/css/xadmin.css">
  <link rel="stylesheet" href="/static/admin/lib/layui/css/layui.css">
  <script type="text/javascript" src="/static/admin/js/jquery.min.js"></script>
  <script src="/static/admin/lib/layui/layui.js" charset="utf-8"></script>
  <script type="text/javascript" src="/static/admin/js/xadmin.js"></script>
  <style type="text/css">
    table {
      table-layout: fixed;
    }
    td {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
  </style>

    <script type="text/javascript" charset="utf-8" src="/static/admin/lib/UEditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/admin/lib/UEditor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/static/admin/lib/UEditor/lang/zh-cn/zh-cn.js"></script>

<!-- 分类下拉框被编辑器遮挡问题修正 -->
    <style type="text/css">
      .layui-anim{z-index: 1000 !important;}
    </style>
<script>
  function HTMLDecode(text) { 
    var temp = document.createElement("div"); 
    temp.innerHTML = text; 
    var output = temp.innerText || temp.textContent; 
    temp = null; 
    return output; 
  }
</script>    
</head>
<body>
<div class="x-body layui-anim layui-anim-up">
  <form class="layui-form" action="/sys/version/update" method="post" enctype="multipart/form-data">

    <div class="layui-form-item">
        <label class="layui-form-label xbs768">应用端类型<?php html_sign();?></label>
        <div class="layui-input-block">
          <select name="app_type" lay-verify="required" lay-search="" >
            <option value="">直接选择或搜索选择</option>
            <?php if(is_array($app_type) || $app_type instanceof \think\Collection || $app_type instanceof \think\Paginator): $ko = 0; $__LIST__ = $app_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($ko % 2 );++$ko;?>
            <option value="<?php echo $ko; ?>"  <?php if($ko == $list['app_type']): ?> selected="selected" <?php endif; ?> ><?php echo $vo; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label xbs768">系统类型<?php html_sign();?></label>
        <div class="layui-input-block">
          <select name="app_postfix" lay-verify="required" lay-search="" >
            <option value="">直接选择或搜索选择</option>
            <?php if(is_array($sys_type) || $sys_type instanceof \think\Collection || $sys_type instanceof \think\Paginator): $ko = 0; $__LIST__ = $sys_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($ko % 2 );++$ko;?>
            <option value="<?php echo $ko; ?>"  <?php if($ko == $list['app_postfix']): ?> selected="selected" <?php endif; ?> ><?php echo $vo; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </div>
    </div>

    <div class="layui-form-item">
      <label for="version_no" class="layui-form-label">应用版本号<?php html_sign();?></label>
      <div class="layui-input-block">
        <input type="text" id="version_no" name="version_no"  lay-verify="required" autocomplete="off"
               value="<?php echo (isset($list['version_no']) && ($list['version_no'] !== '')?$list['version_no']:''); ?>" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item">
      <label for="memo" class="layui-form-label">版本说明<?php html_sign();?></label>
      <div class="layui-input-block">
        <textarea placeholder="请输入内容" class="layui-textarea" type="text" id="memo" name="memo"><?php echo (isset($list['memo']) && ($list['memo'] !== '')?$list['memo']:''); ?></textarea>
      </div>
    </div>

    <input type="hidden" name="fid" value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:''); ?>">
    <input type="hidden" name="file_id" id="file_id" value="<?php echo (isset($list['file_id']) && ($list['file_id'] !== '')?$list['file_id']:''); ?>">
	<div class="layui-form-item">
		<label class="layui-form-label">软件包上传<?php html_sign();?></label>
		<div class="layui-upload">
			<div style="float: left; text-align: center;margin-right:50px;">
				<button type="button" class="layui-btn" id="version">上传</button>
			</div>
			<div class="layui-upload-list" <?php if(empty($list['file_path'])): ?> style="display:none;" <?php endif; ?>>
				点击下载：<a  href="http://sific.vip<?php echo (isset($list['file_path']) && ($list['file_path'] !== '')?$list['file_path']:''); ?>" >http://sific.vip<?php echo (isset($list['file_path']) && ($list['file_path'] !== '')?$list['file_path']:''); ?></a>
			</div>
		</div>
	</div>
	
    <div class="layui-form-item">
      <label class="layui-form-label xbs768">状态</label>
      <div class="layui-input-block">
        <input type="radio" name="record_status" value="1" title="启用"checked>

        <input type="radio" name="record_status" value="2" title="禁用" <?php if(isset($list['record_status']) && $list['record_status'] == 2): ?> checked <?php endif; ?>>
        <input type="radio" name="record_status" value="2" title="标记删除" <?php if(isset($list['record_status']) &&  $list['record_status'] == -1): ?> checked <?php endif; ?>>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label"></label>
      <button class="layui-btn" lay-filter="save" lay-submit="" type="submit">保存</button>
    </div>
  </form>
</div>
<script>
  layui.use('upload',function(){
	  var $ = layui.jquery
	  ,upload = layui.upload;
	  
	var file_id='<?php echo (isset($list['file_id']) && ($list['file_id'] !== '')?$list['file_id']:""); ?>';
	//版本压缩包文件上传
	var uploadInst3 = upload.render({
	  elem: '#version'
	  ,url: '/upload'
	  ,data: {file_id:file_id,source_type:4}
	  ,acceptMime: '*'
	  ,before: function(obj){
		obj.preview(function(index, file, result){
		});
	  }
	  ,done: function(res){
		if(res.code == 200){
		  $('#file_id').attr('value', res.data);
		  return layer.msg('上传成功');
		}else{
		  return layer.msg('上传失败');
		}
	  }
	});
});    
</script>
</body>
</html>