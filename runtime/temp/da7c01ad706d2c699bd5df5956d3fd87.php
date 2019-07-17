<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:79:"/home/wwwroot/default/SIFIC/public/../application/admin/view/meet/edit_exh.html";i:1547779792;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1542434096;}*/ ?>
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
<div class="x-body">
  <form class="layui-form" action="/meet/update_exh" method="post">
    <div class="layui-form-item">
      <label for="booth" class="layui-form-label">展位<?php html_sign();?></label>
      <div class="layui-input-block">
        <input type="text" id="booth" name="booth" value="" required lay-verify="booth" autocomplete="off" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item">
      <label  class="layui-form-label">排序<?php html_sign();?></label>
      <div class="layui-input-block">
        <input type="text" id="sort" name="sort" value="" required lay-verify="sort" autocomplete="off"  class="layui-input">
      </div>
    </div>

    <input type="hidden"  name="convention_id"  value="<?php echo $convention_id; ?>">
    <input type="hidden"  name="org_id"  value="<?php echo $fid; ?>">
    <input type="hidden"  name="fid"  value="0">

    <div class="layui-form-item">
      <label for="exhibitor_type" class="layui-form-label">分类<?php html_sign();?></label>
      <div class="layui-input-block">
        <select name="exhibitor_type" id="exhibitor_type" lay-verify="required" lay-search="">
          <?php if(is_array($exhibitor_type) || $exhibitor_type instanceof \think\Collection || $exhibitor_type instanceof \think\Paginator): $ko = 0; $__LIST__ = $exhibitor_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($ko % 2 );++$ko;?>
          <option value="<?php echo $ko; ?>"><?php echo $vo; ?></option>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
      </div>
    </div>

    <div class="layui-form-item">
      <label  class="layui-form-label"></label>
      <button class="layui-btn" lay-filter="save" lay-submit="" type="submit" >保存</button>
    </div>
  </form>
</div>
<script>
</script>
</body>
</html>