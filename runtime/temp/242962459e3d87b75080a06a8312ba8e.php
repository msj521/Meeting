<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:80:"/home/wwwroot/default/SIFIC/public/../application/admin/view/meet/edit_room.html";i:1547780372;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1548327812;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/upload.html";i:1547778295;}*/ ?>
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
  <form class="layui-form" action="<?php echo (isset($update) && ($update !== '')?$update:'/'); ?>"  method="post" enctype="multipart/form-data">
    <div class="layui-form-item">
      <label for="room_name" class="layui-form-label">会议室<?php html_sign();?></label>
      <div class="layui-input-block">
        <input class="layui-input" id="room_name" name="room_name" required lay-verify="room_name"  value="<?php echo (isset($list['room_name']) && ($list['room_name'] !== '')?$list['room_name']:''); ?>">
      </div>
    </div>
    
    <div class="layui-form-item">
      <label for="locationx" class="layui-form-label">定位坐标X<?php html_sign();?></label>
      <div class="layui-input-block">
        <input class="layui-input" id="locationx" name="locationx" required lay-verify="locationx"  value="<?php echo (isset($list['locationx']) && ($list['locationx'] !== '')?$list['locationx']:''); ?>">
      </div>
    </div>

    <div class="layui-form-item">
      <label for="locationy" class="layui-form-label">定位坐标y<?php html_sign();?></label>
      <div class="layui-input-block">
        <input class="layui-input" id="locationy" name="locationy" required lay-verify="locationy"  value="<?php echo (isset($list['locationy']) && ($list['locationy'] !== '')?$list['locationy']:''); ?>">
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label xbs768">状态</label>
      <div class="layui-input-block">
        <input type="radio" name="record_status" value="1" title="启用" checked>
        <input type="radio" name="record_status" value="2" title="禁用" <?php if(isset($list['record_status']) and $list['record_status'] == 2): ?> checked <?php endif; ?>>
        <input type="radio" name="record_status" value="-1" title="标记删除" <?php if(isset($list['record_status']) and  $list['record_status'] == -1): ?> checked <?php endif; ?>>
      </div>
    </div>
        <div class="layui-form-item">
      <label class="layui-form-label">图片上传<?php html_sign();?></label>
        <div class="layui-upload">
          <div style="float: left; width: 150px; text-align: center;">
             <button type="button" class="layui-btn" id="img">web图片</button>
            <div class="layui-upload-list">
              <img class="layui-upload-img" id="img1" width="150" src="<?php echo (isset($list['image_url']) && ($list['image_url'] !== '')?$list['image_url']:$list['web_image_url']); ?>">
            </div>
          </div>
          
           <div style="float: left;width: 150px; text-align: center; margin-left:20px ">
              <button type="button" class="layui-btn" id="imgs">App图片</button>
            <div class="layui-upload-list">
              <img class="layui-upload-img" id="img2" width="150" src="<?php echo (isset($list['image_urls']) && ($list['image_urls'] !== '')?$list['image_urls']:$list['app_image_url']); ?>">
            </div>
           </div>
           <?php if(isset($edit) and $edit == '/meet/edit'): ?>
           <div style="float: left;width: 150px; text-align: center; margin-left:20px ">
              <button type="button" class="layui-btn" id="top_imgs">会议头部图片</button>
            <div class="layui-upload-list">
              <img class="layui-upload-img" id="img3" width="150" src="<?php echo (isset($list['top_image_url']) && ($list['top_image_url'] !== '')?$list['top_image_url']:$list['top_image_url']); ?>">
            </div>
           </div>
          <input type="hidden" name="top_image_id" id="top_FImageUrls" value="<?php echo (isset($list['top_image_id']) && ($list['top_image_id'] !== '')?$list['top_image_id']:1); ?>">
          <?php endif; ?>
        </div>
    </div>
    <input type="hidden"  name="web_image_id"  id="FImageUrl" value="<?php echo (isset($list['web_image_id']) && ($list['web_image_id'] !== '')?$list['web_image_id']:$list['web_id']); ?>">
    <input type="hidden" name="app_image_id"  id="FImageUrls" value="<?php echo (isset($list['app_image_id']) && ($list['app_image_id'] !== '')?$list['app_image_id']:$list['app_id']); ?>">
    
    <script>
      layui.use('upload',function(){
          var $ = layui.jquery
          ,upload = layui.upload;
          var web_image_id='<?php echo (isset($list['web_image_id']) && ($list['web_image_id'] !== '')?$list['web_image_id']:$list['web_id']); ?>';
          var app_image_id='<?php echo (isset($list['app_image_id']) && ($list['app_image_id'] !== '')?$list['app_image_id']:$list['app_id']); ?>';
          var top_image_id='<?php echo (isset($list['top_image_id']) && ($list['top_image_id'] !== '')?$list['top_image_id']:0); ?>';
          var source_id='<?php echo (isset($list['source_id']) && ($list['source_id'] !== '')?$list['source_id']:""); ?>';
            //WEB图片上传
          var uploadInst = upload.render({
            elem: '#img'
            ,url: '/upload'
            ,data: {web_image_id:web_image_id,source_type:1}
            ,acceptMime: 'image/*'
            ,exts: 'jpg|jpeg|gif|bmp|png'
            ,before: function(obj){
              obj.preview(function(index, file, result){
                $('#img1').attr('src', result);
              });
            }
            ,done: function(res){
              //如果上传失败
              if(res.code == 200){
                $('#FImageUrl').attr('value', res.data);
                return layer.msg('上传成功');
              }else{
                return layer.msg('上传失败');
              }
            }
          });

          //APP图片上传
          var uploadInst2 = upload.render({
            elem: '#imgs'
            ,url: '/upload'
            ,data: {app_image_id:app_image_id,source_type:1}
            ,acceptMime: 'image/*'
            ,before: function(obj){
              obj.preview(function(index, file, result){
                $('#img2').attr('src', result);
              });
            }
            ,done: function(res){
              if(res.code == 200){
                $('#FImageUrls').attr('value', res.data);
                return layer.msg('上传成功');
              }else{
                return layer.msg('上传失败');
              }
            }
          });

          //会议头部图片
          var uploadInst4 = upload.render({
            elem: '#top_imgs'
            ,url: '/upload'
            ,data: { top_image_id: top_image_id,source_type:1}
            ,acceptMime: 'image/*'
            ,before: function(obj){
              obj.preview(function(index, file, result){
                $('#img3').attr('src', result);
              });
            }
            ,done: function(res){
              if(res.code == 200){
                $('#top_FImageUrls').attr('value', res.data);
                return layer.msg('上传成功');
              }else{
                return layer.msg('上传失败');
              }
            }
          });

        //视屏文件上传
        var uploadInst3 = upload.render({
          elem: '#video'
          ,url: '/upload'
          ,data: {source_id:source_id,source_type:2}
          ,exts: 'mp4'
          ,acceptMime: '*'
          ,before: function(obj){
            obj.preview(function(index, file, result){
              $('#videos').attr('src', result);
            });
          }
          ,done: function(res){
            if(res.code == 200){
              $('#source_id').attr('value', res.data);
              return layer.msg('上传成功');
            }else{
              return layer.msg('上传失败');
            }
          }
        });
    });    
    </script>

    <input type="hidden" name="fid" value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:''); ?>">
    <input type="hidden" name="convention_id" value="<?php echo (isset($list['convention_id']) && ($list['convention_id'] !== '')?$list['convention_id']:$convention_id); ?>">

    <div class="layui-form-item">
      <label class="layui-form-label"></label>
      <button class="layui-btn" lay-filter="save" lay-submit="" type="submit">保存</button>
    </div>
  </form>
</div>
</body>
</html>