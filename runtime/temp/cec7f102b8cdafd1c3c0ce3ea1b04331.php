<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:78:"/home/wwwroot/default/SIFIC/public/../application/admin/view/meet/article.html";i:1537860817;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1548327812;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/top_js.html";i:1548124979;}*/ ?>
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
    <a><cite>会议食宿</cite></a>
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
          <select name="class_id" lay-search="">
            <option value="">会议分类</option>
            <?php if(is_array($meet) || $meet instanceof \think\Collection || $meet instanceof \think\Paginator): $i = 0; $__LIST__ = $meet;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo $vo['fid']; ?>"  <?php if($vo['fid'] == $class_id): ?> selected="selected" <?php endif; ?> ><?php echo $vo['class_name_zh']; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </div>
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

<script type="text/html" id="z">
  <a  href="javascript:;"  lay-event="Z"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe6f6;</i></a>
</script>

<script type="text/html" id="x">
  <a  href="javascript:;"  lay-event="X"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe6ee;</i></a>
</script>

<script type="text/html" id="v">
  <a  href="javascript:;"  lay-event="V"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe6f5;</i></a>
</script>

<script type="text/html" id="n">
  <a  href="javascript:;"  lay-event="N"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe6f4;</i></a>
</script>

<script type="text/html" id="a1">
  <a  href="javascript:;"  lay-event="A1"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe6bf;</i></a>
</script>

<script type="text/html" id="a2">
  <a  href="javascript:;"  lay-event="A2"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe6a2;</i></a>
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
        ,{field:'convention_name',  width:450, title: '名称'}
        ,{field:'class_name',  title: '类型'}
        ,{  title: '关于城市', toolbar: '#z'}
        ,{title: '会场介绍', toolbar: '#x'}
        ,{title: '会议酒店', toolbar: '#v'}
        ,{ title: '周边餐饮', toolbar: '#n'}
        ,{ title: '历届简介', toolbar: '#a1'}
        ,{ title: '大会征文通知',width:115,  toolbar: '#a2'}
        ,{field:'start_time', width:160, title: '开始时间'}
        ,{field:'end_time',width:160,  title: '结束时间'}        
        ,{field:'record_status',width:80,   title: '状态'}
      ]]
      ,page: false
      ,limit: dataList.data.length
    });

    //监听工具条
    table.on('tool(tableTool)', function(obj){
      var data = obj.data;
      if(obj.event === 'Z'){
        member_edit('关于城市','/meet/switch','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&Z',0,0)
      } else if(obj.event === 'X'){
        member_edit('会场介绍','/meet/switch','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&X',0,0)
      } else if(obj.event === 'V'){
        member_edit('会议酒店','/meet/switch','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&V',0,0)
      } else if(obj.event === 'N'){
        member_edit('周边餐饮','/meet/switch','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&N',0,0)
      } else if(obj.event === 'A1'){
        member_edit('历届简介','/meet/switch','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&A1',0,0)
      } else if(obj.event === 'A2'){
        member_edit('大会征文通知','/meet/switch','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&A2',0,0)
      }
    });

  })

</script>
</body>
</html>