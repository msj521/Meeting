<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:86:"/home/wwwroot/default/SIFICYear/public/../application/admin/view/meet/edit_signup.html";i:1547780119;s:73:"/home/wwwroot/default/SIFICYear/application/admin/view/public/header.html";i:1548327812;}*/ ?>
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
<div class="x-body">
  <form class="layui-form" action='<?php echo (isset($update) && ($update !== '')?$update:"/"); ?>' method="post">

    <div class="layui-form-item">
      <label for="actual_pay" class="layui-form-label">实际支付<?php html_sign();?></label>
      <div class="layui-input-block">
        <input type="text" id="actual_pay" name="actual_pay" value="<?php echo (isset($list['actual_pay']) && ($list['actual_pay'] !== '')?$list['actual_pay']:0); ?>" required lay-verify="actual_pay" autocomplete="off" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label xbs768">支付状态</label>
        <div class="layui-input-block">
          <input type="radio" name="pay_status" value="1" title="待审核" checked>
          <input type="radio" name="pay_status" value="2" title="成功" <?php if(isset($list['pay_status']) and $list['pay_status'] == 2): ?> checked <?php endif; ?>>
          <input type="radio" name="pay_status" value="3" title="失败" <?php if(isset($list['pay_status']) and  $list['pay_status'] == 3): ?> checked <?php endif; ?>>
        </div>
    </div>

    <input type="hidden"  name="convention_id"  value="<?php echo (isset($list['convention_id']) && ($list['convention_id'] !== '')?$list['convention_id']:0); ?>">
    <input type="hidden"  name="fid"  value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:$fid); ?>">

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