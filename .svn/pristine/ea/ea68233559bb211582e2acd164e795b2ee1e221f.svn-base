<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"/home/wwwroot/default/SIFIC/public/../application/admin/view/meet/signup_detail.html";i:1537437007;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1548327812;}*/ ?>
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
  <table class="layui-hide" id="table" lay-filter="tableTool"></table>
</div>
<script>
  var dataList = <?php echo json_encode($list);?>;
  //console.log(dataList);
  for (var i = 0; i < dataList.length; i++) {
    if(dataList[i].field_type==1){
        dataList[i].field_type='填空';
    }else if(dataList[i].field_type==2){
        dataList[i].field_type='单选题';
    }else if(dataList[i].field_type==3){
        dataList[i].field_type='多选题';
    }else if(dataList[i].field_type==4){
        dataList[i].field_type='下拉选择';
    }
  }

  layui.use(['table','layer'],function(){
    var layer = layui.layer;
    var table = layui.table;
    table.render({
      elem: '#table'
      ,data: dataList
      ,cols: [[
        {field:'fid', width:80, title: 'ID'}
        ,{field:'field_name',title: '字段名'}
        ,{field:'field_type',title: '题目类型'}
        ,{field:'value',title: '内容'}
      ]]
    });
  })  
</script>
</body>
</html>