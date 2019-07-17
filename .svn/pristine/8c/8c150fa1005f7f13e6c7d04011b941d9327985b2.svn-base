<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:78:"/home/wwwroot/default/SIFIC/public/../application/admin/view/explain/edit.html";i:1539573525;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1548327812;}*/ ?>
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
    <form class="layui-form" action="/sys/explain/update" method="post" enctype="multipart/form-data">
      <div class="layui-form-item">
        <div class="layui-input-block">
          <script id="editor" type="text/plain" name="<?php echo (isset($field) && ($field !== '')?$field:''); ?>" required></script>
        </div>
      </div>
      <input type="hidden" name="fid" value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:0); ?>">
      <div class="layui-form-item">
        <label class="layui-form-label"></label>
        <button class="layui-btn" lay-filter="save" lay-submit="" type="submit">保存</button>
      </div>
    </form>
  </div>
  <script>
    var ue = UE.getEditor('editor');
    var field = '<?php echo (isset($result) && ($result !== '')?$result:""); ?>';
    console.log(field)
    ue.addListener("ready", function () {
      // editor准备好之后才可以使用
      if (field != "") {
        ue.setContent(HTMLDecode(field));
      }
    });
  </script>
</body>

</html>