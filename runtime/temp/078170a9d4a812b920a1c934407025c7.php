<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:79:"/home/wwwroot/default/SIFIC/public/../application/admin/view/meet/sign_cnf.html";i:1548149780;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1548327812;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/top_js.html";i:1548124979;}*/ ?>
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
    <a><cite><?php echo $title; ?></cite></a>
  </span>
  <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
     href="javascript:location.replace(location.href);" title="刷新">
    <i class="layui-icon" style="line-height:30px">ဂ</i>
  </a>
</div>
<div class="x-body">
  <form class="layui-form x-center" action="<?php echo (isset($index) && ($index !== '')?$index:'/'); ?>" method="get">
    <div class="layui-form-pane" style="text-align: center;">

      <div class="layui-form-item" style="display: inline-block;">
        <label class="layui-form-label">起始时间</label>
        <div class="layui-input-inline">
          <input class="layui-input" placeholder="开始时间" id="LAY_demorange_s" name="start_time" value="<?php echo $start; ?>">
        </div>
        <div class="layui-input-inline">
          <input class="layui-input" placeholder="结束时间" id="LAY_demorange_e" name="end_time" value="<?php echo $end; ?>">
        </div>

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
    <span class="layui-btn" style="line-height:40px">共有数据：<?php echo $cnt; ?> 条</span>
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

<script type="text/html" id="zs">
  <a  href="javascript:;"  lay-event="ZS"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe6af;</i></a>
</script>

<script type="text/html" id="zj">
  <a  href="javascript:;"  lay-event="ZJ"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe699;</i></a>
</script>

<script type="text/html" id="zk">
  <a  href="javascript:;"  lay-event="ZK"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe758;</i></a>
</script>

<script type="text/html" id="pc">
  <a  href="javascript:;"  lay-event="PC"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe70b;</i></a>
</script>

<script type="text/html" id="py">
  <a  href="javascript:;"  lay-event="PY"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe6ec;</i></a>
</script>

<script type="text/html" id="wt">
  <a  href="javascript:;"  lay-event="WT"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe6ec;</i></a>
</script>

<script type="text/html" id="bt">
  <a  href="javascript:;"  lay-event="BT"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe69a;</i></a>
</script>

<script type="text/html" id="pr">
  <a  href="javascript:;"  lay-event="PR"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe724;</i></a>
</script>

<script type="text/html" id="za">
  <a  href="javascript:;"  lay-event="ZA"
              class="ml-5" style="text-decoration:none" ><i class="iconfont">&#xe6a4;</i></a>
</script>


<script>
  var dataList = <?php echo json_encode($list);?>;
  //console.log(dataList);
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

  layui.use(['table','layer'],function(){
    var layer = layui.layer;
    var table = layui.table;
    table.render({
      elem: '#table'
      ,data: dataList.data
      ,cols: [[
        {field:'fid',width:80,title: 'ID',sort:true}
        ,{field:'convention_name',  width:160, title: '名称'}
        ,{  width:100,title: '会议菜单栏', toolbar: '#bt'}
		,{ width:100, title: '摘要及全文', toolbar: '#pr'}
        ,{ width:100,title: '自定义报名', toolbar: '#zs'}
        ,{width:100, title: '报名记录', toolbar: '#zj'}
        ,{width:100,title: '参会类型', toolbar: '#zk'}
        ,{width:100,title: '注意配置', toolbar: '#za'}
        ,{ width:100, title: '对公账户', toolbar: '#pc'}
        ,{ width:100, title: '支付宝支付', toolbar: '#py'}
        ,{width:100, title: '微信支付', toolbar: '#wt'}
        ,{field:'start_time', width:160,  title: '开始时间'}
        ,{field:'end_time',  width:160, title: '结束时间'}        
        ,{field:'record_status', width:100, title: '状态'}
      ]]
      ,page: false
      ,limit: dataList.data.length
    });
 
    //监听工具条
    table.on('tool(tableTool)', function(obj){
      var data = obj.data;
      if(obj.event === 'ZS'){
        member_edit('自定义报名','/meet/sign','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&ZS=0',0,0)
      } else if(obj.event === 'ZJ'){
        member_edit('报名记录','/meet/signup','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&ZJ=0',0,0)
      } else if(obj.event === 'ZK'){
        member_edit('参会类型','/meet/ticket','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&ZK=0',0,0)
      } else if(obj.event === 'PC'){
        member_edit('对公账户','/meet/switch','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&PC',0,0)
      } else if(obj.event === 'PY'){
        member_edit('支付宝支付','/meet/switch','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&PY',0,0)
      } else if(obj.event === 'WT'){
        member_edit('微信支付','/meet/switch','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&WT',0,0)
      } else if(obj.event === 'BT'){
        member_edit('会议菜单栏','/menu/meet','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&BT='+data.convention_name,0,0)
	  } else if(obj.event === 'PR'){
        member_edit('摘要及全文','/meet/paper','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&PR',0,0)
      } else if(obj.event === 'ZA'){
		member_edit('注意配置','/meet/switch','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>',data.fid+'&ZA',0,0)
      }
    });

  })

</script>
</body>
</html>