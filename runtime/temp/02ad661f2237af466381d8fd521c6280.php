<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:80:"/home/wwwroot/default/SIFICYear/public/../application/admin/view/meet/filed.html";i:1546072989;s:73:"/home/wwwroot/default/SIFICYear/application/admin/view/public/header.html";i:1548327812;s:73:"/home/wwwroot/default/SIFICYear/application/admin/view/public/top_js.html";i:1548124979;}*/ ?>
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
<div class="x-nav">
  <span class="layui-breadcrumb">
    <a><cite>大会管理</cite></a>
    <a><cite>资料上传</cite></a>
  </span>
  <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
     href="javascript:location.replace(location.href);" title="刷新">
    <i class="layui-icon" style="line-height:30px">ဂ</i>
  </a>
</div>
<div class="x-body">
  <form class="layui-form x-center" action="<?php echo (isset($index) && ($index !== '')?$index:'/'); ?>" method="get">
    <div class="layui-form-pane" style="text-align: center;">
        <div class="layui-input-inline">
          <input type="text" name="string" value="<?php echo $string; ?>" placeholder="请输入查询内容" autocomplete="off" class="layui-input">
        </div>

        <div class="layui-input-inline" style="width:80px">
          <button class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </div>
      </div>
    </div>
  </form>
  <xblock>
    <span class="x-left" style="line-height:40px">共有数据：<?php echo $cnt; ?> 条</span>
  </xblock>
 <table class="layui-hide" id="table" lay-filter="tableTool"></table>
  <div class="page">
    <?php echo $list->render(); ?>
  </div>
</div>
<script>
  layui.use('laydate', function () {
    var laydate = layui.laydate;

    //执行一个laydate实例
    laydate.render({
      elem: '#LAY_demorange_s' //指定元素
      , type: 'datetime'
    });
    //执行一个laydate实例
    laydate.render({
      elem: '#LAY_demorange_e' //指定元素
      , type: 'datetime'
    });

  });

  //编辑
  function member_edit (title,url,urls,id,w,h) {
    x_admin_consult(title,url,urls,id,w,h);
  }

  /*通用跳转编辑页面*/
  function x_admin_consult(title,url,urls,id,w,h){
    if (title == null || title == '') {
      title=false;
    };
    if (url == null || url == '') {
      url="404.html";
    };
    if (w == null || w == '') {
      w=($(window).width()*0.9);
    };
    if (h == null || h == '') {
      h=($(window).height() - 50);
    };

    layer.open({
      type: 2,
      area: [w+'px', h +'px'],
      fix: false, //不固定
      maxmin: true,
      shadeClose: false,
      shade:0.4,
      title: title,
      content: url+"?fid="+id,
      cancel: function(){
        setTimeout(function () {
          window.location.href = urls;
        }, 1);
      }
    });
  }


  /*通用删除处理*/
  function member_del(id, url, urls) {

    if (id == -1) {
      var ids = tableCheck.getData();
    } else {
      var ids = id;
    }
    if (ids == '' || ids == null || ids < 0) {
      layer.msg('请选择要删除的数据！', {icon: 2, time:2000});
    } else {
      //询问框
      layer.confirm('确认要删除吗？ '+ ids, {
        btn: ['标记','彻底']
      }, function(){
        is_del(ids,url,urls,-1);
      }, function(){
        is_del(ids,url,urls,-2);
      });
    }
  }

  function is_del(ids,url,urls,type){
    //发异步删除数据
    $.ajax({
      type: "post",
      url: url,
      data: {fid:ids,urls:urls,type:type},
      dataType: "json",
      success: function (data) {
        if (data.code == 1) {
          layer.msg(data.msg, {icon: 1, time: 500});
        } else {
          layer.msg(data.msg, {icon: 1, time: 500});
        }
        setTimeout(function () {
          window.location.href = urls;
        }, 1);
      }
    });
  }
</script>





<script>
  // 会议-编辑
  function member_edits(title, url, urls,id, pid,room_id, w, h) {
    x_admin_consults(title, url,urls, id, pid,room_id, w, h);
  }

  function x_admin_consults(title, url,urls,id,pid,room_id, w, h) {
    if (title == null || title == '') {
      title = false;
    };
    if (url == null || url == '') {
      url = "404.html";
    };
    if (w == null || w == '') {
      w = ($(window).width() * 0.9);
    };
    if (h == null || h == '') {
      h = ($(window).height() - 50);
    };

    if (pid == '' || pid == null || pid < 0) {
      layer.msg('参数丢失~~', {icon: 2, time: 3000});
    } else {
      layer.open({
        type: 2,
        area: [w + 'px', h + 'px'],
        fix: false, //不固定
        maxmin: true,
        shadeClose: false,
        shade: 0.4,
        title: title,
        content: url + "?fid=" + id +"&convention_id=" + pid +"&room_id="+room_id,
        cancel: function () {
          //do something
          window.location.href = urls + "?fid=" + pid +"&B"+room_id
        }
      });
    }
  }

   /*通用删除处理*/
  function member_dels(id, url, urls,pid) {

    if (id == -1) {
      var ids = tableCheck.getData();
    } else {
      var ids = id;
    }
    if (ids == '' || ids == null || ids < 0) {
      layer.msg('请选择要删除的数据！', {icon: 2, time:2000});
    } else {
      //询问框
      layer.confirm('确认要删除吗？ '+ ids, {
        btn: ['标记','彻底']
      }, function(){
        is_dels(ids,url,urls,-1,pid);
      }, function(){
        is_dels(ids,url,urls,-2,pid);
      });
    }
  }

  function is_dels(ids,url,urls,type,pid){
    //发异步删除数据
    $.ajax({
      type: "post",
      url: url,
      data: {fid:ids,urls:urls,type:type},
      dataType: "json",
      success: function (data) {
        if (data.code == 1) {
          layer.msg(data.msg, {icon: 1, time: 500});
        } else {
          layer.msg(data.msg, {icon: 1, time: 500});
        }
        setTimeout(function () {
           window.location.href = urls + "?fid="+pid;
        }, 500);
      }
    });
  }
</script>

<!-- 审核操作 -->
<script>
  function member_check(id, url, urls){
    if (id == -1) {
      var ids = tableCheck.getData();
    } else {
      var ids = id;
    }
    if (ids == '' || ids == null || ids < 0) {
      layer.msg('请选择要审核的数据！', {icon: 2, time:2000});
    }else {
      layer.confirm('是否通过', {
        btn: ['是','否']
      }, function(){
        iss_check(ids,url,urls,2);
      }, function(){
        iss_check(ids,url,urls,3);
      });
    }
  }

  function iss_check(ids,url,urls,check){
    //发异步审核数据
    $.ajax({
      type: "post",
      url: url,
      data: {fid:ids,urls:urls,check:check,type:5},
      dataType: "json",
      success: function (data) {
        if (data>0) {
          layer.msg("审核成功", {icon: 1, time: 1000});
        } else {
          layer.msg("审核失败", {icon: 1, time: 1000});
        }
        setTimeout(function () {
          window.location.href = urls;
        }, 1000);
      }
    });
  }
</script>

<script type="text/html" id="b1">
  <a  href="javascript:;"  lay-event="B1"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe6bc;</i></a>
</script>

<script type="text/html" id="b2">
  <a  href="javascript:;"  lay-event="B2"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe6b3;</i></a>
</script>

<script type="text/html" id="b3">
  <a  href="javascript:;"  lay-event="B3"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe724;</i></a>
</script>

<script type="text/html" id="b4">
  <a  href="javascript:;"  lay-event="B4"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe705;</i></a>
</script>

<script type="text/html" id="b5">
  <a  href="javascript:;"  lay-event="B5"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe6c7;</i></a>
</script>

<script type="text/html" id="b6">
  <a  href="javascript:;"  lay-event="B6"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe6a8;</i></a>
</script>

<script type="text/html" id="b7">
  <a  href="javascript:;"  lay-event="B7"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe6fd;</i></a>
</script>

<script>
  var dataList = <?php echo json_encode($list);?>;
  // console.log(dataList);
  for (var i = 0; i < dataList.data.length; i++) {
 
    if(dataList.data[i].record_status==1){
        dataList.data[i].record_status='启用';
    }else if(dataList.data[i].record_status==2){
        dataList.data[i].record_status='禁用';
    }else if(dataList.data[i].record_status==-1){
        dataList.data[i].record_status='标记删除';
    }else if(dataList.data[i].record_status==-2){
        dataList.data[i].record_status='彻底删除';
    }
    
  }

  // console.log(dataList);
  layui.use(['table','layer'],function(){
    var layer = layui.layer;
    var table = layui.table;
    table.render({
      elem: '#table'
      ,data: dataList.data
      ,cols: [[
        {field:'fid',width:80,title: 'ID',sort:true}
        ,{field:'convention_name',  width:400, title: '名称'}
        ,{field:'class_name', width: 150,  title: '类型'}
        ,{title: '会议通知', width: 100,  toolbar: '#b1'}
        ,{title: '会议课件', width: 100, toolbar: '#b2'}
        ,{title: '论文集', width: 100,toolbar: '#b3'}
        ,{ title: '资料汇编', width: 100, toolbar: '#b4'}
        ,{ title: '企业交流手册',width:115, toolbar: '#b5'}
        ,{title: '展区布置图', width: 110, toolbar: '#b6'}
        ,{title: '证书模板', width: 100,  toolbar: '#b7'}
        ,{field:'start_time', width:160, title: '开始时间'}
        ,{field:'end_time',width:160,  title: '结束时间'}        
        ,{field:'record_status',width:80, title: '状态'}
      ]]
      ,page: false
      ,limit: dataList.data.length
    });

    //监听工具条
    table.on('tool(tableTool)', function(obj){
      var data = obj.data;
      if(obj.event === 'B1'){
        member_edit('会议通知','/meet/uploads','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&B1',0,0)
      } else if(obj.event === 'B2'){
        member_edit('会议课件','/meet/uploads','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&B2',0,0)
      } else if(obj.event === 'B3'){
        member_edit('论文集','/meet/uploads','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&B3',0,0)
      } else if(obj.event === 'B4'){
        member_edit('资料汇编','/meet/uploads','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&B4',0,0)
      } else if(obj.event === 'B5'){
        member_edit('企业交流手册','/meet/uploads','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&B5',0,0)
      } else if(obj.event === 'B6'){
        member_edit('展区布置图','/meet/uploads','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&B6',0,0)
      } else if(obj.event === 'B7'){
        member_edit('证书模板','/meet/uploads','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&B7',0,0)
      }
    });

  })

</script>
</body>
</html>