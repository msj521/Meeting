<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:87:"/home/wwwroot/default/SIFICYear/public/../application/admin/view/meet/edit_uploads.html";i:1548293706;s:73:"/home/wwwroot/default/SIFICYear/application/admin/view/public/header.html";i:1548327812;}*/ ?>
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
  <form class="layui-form" action="<?php echo (isset($update) && ($update !== '')?$update:'/'); ?>" method="post" enctype="multipart/form-data">

    <div class="layui-form-item">
      <label for="download_title" class="layui-form-label">标题<?php html_sign();?></label>
      <div class="layui-input-block">
        <input class="layui-input" id="download_title" name="download_title"  lay-verify="required" value="<?php echo (isset($list['download_title']) && ($list['download_title'] !== '')?$list['download_title']:''); ?>">
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">资源上传<?php html_sign();?></label>
      <div class="layui-upload">
          <button type="button" class="layui-btn" id="img">
              <?php if(isset($list['file_path']) and $list['fid']): ?> 重新上传<?php else: ?>点击上传 <?php endif; ?>
          </button>
          <span class="layui-upload-list">
            <table class="layui-table">
              <thead>
                <tr>
                  <th>文件名</th>
                  <th>大小</th>
                </tr>
              </thead>
              <tbody id="demoList">
                <tr>
                    <td><?php echo (isset($list['file_name']) && ($list['file_name'] !== '')?$list['file_name']:''); ?></td>
                    <td><?php echo (isset($list['file_size']) && ($list['file_size'] !== '')?$list['file_size']:0); ?>kb</td>
                </tr>
              </tbody>
            </table>
          </span>
      </div>
    </div>
    
    <input type="hidden" name="fid" value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:''); ?>">
    <input type="hidden" name="convention_id" value="<?php echo (isset($list['convention_id']) && ($list['convention_id'] !== '')?$list['convention_id']:$convention_id); ?>">
    <input type="hidden" name="download_type" value="<?php echo (isset($list['room_id']) && ($list['room_id'] !== '')?$list['room_id']:$room_id); ?>">
    <input type="hidden" id="file_ids" name="file_ids" value="<?php echo (isset($list['file_ids']) && ($list['file_ids'] !== '')?$list['file_ids']:0); ?>">
    
    <div class="layui-form-item">
      <label class="layui-form-label xbs768">状态</label>
      <div class="layui-input-block">
        <input type="radio" name="record_status" value="1" title="启用" checked>
        <input type="radio" name="record_status" value="2" title="禁用" <?php if(isset($list['record_status']) and $list['record_status'] == 2): ?> checked <?php endif; ?>>
        <input type="radio" name="record_status" value="-1" title="标记删除" <?php if(isset($list['record_status']) and  $list['record_status'] == -1): ?> checked <?php endif; ?>>
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
    var fid='<?php echo (isset($list['file_ids']) && ($list['file_ids'] !== '')?$list['file_ids']:0); ?>';
    //上传
    var uploadInst = upload.render({
      elem: '#img'
      ,url: '/upload'
      ,data: {fid:fid,source_type:4,download_type:3}
      ,accept: 'file'
      ,multiple: true
      ,before: function(obj){
      var files = this.files = obj.pushFile(); //将每次选择的文件追加到文件队列
      //读取本地文件
      obj.preview(function(index, file, result){
          var tr = $(['<tr id="upload-'+ index +'">'
            ,'<td>'+ file.name +'</td>'
            ,'<td>'+ (file.size/1014).toFixed(1) +'kb</td>'
          ,'</tr>'].join(''));
          $("#demoList").html(tr);
        });
      }
      ,done: function(res){
        //如果上传失败
        if(res.code==200){
          $('#file_ids').attr('value', res.data);
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