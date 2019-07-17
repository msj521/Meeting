<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"/home/wwwroot/default/SIFICYear/public/../application/admin/view/index/logins.html";i:1537437005;s:73:"/home/wwwroot/default/SIFICYear/application/admin/view/public/header.html";i:1548327812;}*/ ?>
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
<body class="login-bg">
    
    <div class="login layui-anim layui-anim-up">
        <div class="message">SIFIC管理登录</div>
        <div id="darkbannerwrap"></div>
        
        <form method="post" class="layui-form">
            <input name="tel" placeholder="手机号"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>

<script>
 layui.use('form', function(){
  var form = layui.form
  ,jq = layui.jquery;
    form.on('submit(login)', function (data) {
    $.ajax({
        type: 'POST',
        url: "/logins",
        dataType: 'json',
        data: data.field,//往后台发送的是data.field，即一个{name：value}的数据结构
        async: true,
        success: function (result) {
            if (result.code ==1) {
                layer.msg(result.msg, {icon: 1, time: 1000});
                setTimeout(function () {
                    self.location ='/admin';
                }, 800);
            } else {
                layer.msg(result.msg, {icon: 2, time: 1000});
                setTimeout(function () {
                    self.location ='/admin'; 
                }, 800);
            }
        } 
    });
      return false;
    });
  })       
</script>
</body>
</html>