<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"/home/wwwroot/default/SIFICYear/public/../application/admin/view/meet/edit_news.html";i:1547779847;s:73:"/home/wwwroot/default/SIFICYear/application/admin/view/public/header.html";i:1548327812;}*/ ?>
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
      <label for="title" class="layui-form-label">标题<?php html_sign();?></label>
      <div class="layui-input-block">
        <input class="layui-input" id="title" name="title" required lay-verify="title"  value="<?php echo (isset($list['title']) && ($list['title'] !== '')?$list['title']:''); ?>">
      </div>
    </div>
    
    <div class="layui-form-item">
      <label  class="layui-form-label">内容<?php html_sign();?></label>
      <div class="layui-input-block">
        <script id="editor" type="text/plain" name="content" required></script>
      </div>
    </div>

    <div class="layui-form-item">
      <label for="sort" class="layui-form-label">排序</label>
      <div class="layui-input-block">
        <input class="layui-input" id="sort" name="sort" required lay-verify="sort"  value="<?php echo (isset($list['sort']) && ($list['sort'] !== '')?$list['sort']:0); ?>">
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
<script>
  var list = <?php echo (isset($list) ? json_encode($list) :json_encode([]));?>;
    // console.log(FContent);
  var ue = UE.getEditor('editor');
  ue.addListener("ready", function () {
    // editor准备好之后才可以使用
    if (list != "") {
      ue.setContent(HTMLDecode(list.content));
    }
  });
</script>