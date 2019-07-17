<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:81:"/home/wwwroot/default/SIFICYear/public/../application/admin/view/meet/author.html";i:1548050123;s:73:"/home/wwwroot/default/SIFICYear/application/admin/view/public/header.html";i:1548327812;s:73:"/home/wwwroot/default/SIFICYear/application/admin/view/public/top_js.html";i:1548124979;}*/ ?>
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
              <a><cite>会议管理</cite></a>
              <a><cite>摘要作者</cite></a>
            </span>
  <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>


<div class="x-body">
  <!-- 右侧内容框架，更改从这里开始 -->
  <form class="layui-form xbs" action="<?php echo $index; ?>" method="get">
    <div class="layui-form-pane" style="text-align: center;">
      <div class="layui-form-item" style="display: inline-block;">
	    <input type="hidden" name="fid" value="<?php echo (isset($convention_id) && ($convention_id !== '')?$convention_id:0); ?>">
        <div class="layui-input-inline">
          <input type="text" name="string" value="<?php echo $string; ?>" placeholder="手机号,姓名,邮箱" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-input-inline" style="width:80px">
          <button class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </div>
      </div>
    </div>
  </form>
  <xblock>
	<button class="layui-btn layui-btn-danger" onclick="member_del(-1,'<?php echo $del; ?>','<?php echo $index; ?>')"><i class="layui-icon">&#xe640;</i>批量删除</button>
    <span class="x-right" style="line-height:40px">共有数据：<?php echo $cnt; ?> 条</span></xblock>
  <table class="layui-table">
    <thead>
    <tr>
      <th style="width:20px;">
        <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
      </th>
      <th style="width:80px;">摘要编号</th>
	<!-- 	文章作者	通讯作者 -->
      <th style="width:80px;">姓名</th>
      <th >手机</th>
	  <th >邮箱</th>
      <th >地址</th>
      <th >单位</th>
      <th >作者</th>
      <th style="width:80px;">状态</th>
      <th style="width:120px;">操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <tr>
      <td>
        <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo $vo['fid']; ?>'>
          <i class="layui-icon">&#xe605;</i>
        </div>
      </td>
      <td >A0<?php echo $vo['abstract_id']; ?></td>
      <td ><?php echo $vo['author_name']; ?></td>
      <td ><?php echo $vo['tel']; ?></td>
      <td title="<?php echo $vo['email']; ?>"><?php echo $vo['email']; ?></td>
      <td title="<?php echo $vo['address']; ?>"><?php echo $vo['address']; ?></td>
      <td title="<?php echo $vo['company']; ?>"><?php echo $vo['company']; ?></td>
      <td title="<?php echo $vo['author_type']; ?>"><?php echo $vo['author_type']; ?></td>
      <td ><?php echo is_status($vo['record_status']); ?></td>
      <td class="td-manage">
          <a title="编辑" href="javascript:;" onclick="member_edit('编辑','<?php echo (isset($edit) && ($edit !== '')?$edit:"/"); ?>&paper_id=<?php echo (isset($fid) && ($fid !== '')?$fid:0); ?>','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>?fid='+ <?php echo (isset($fid) && ($fid !== '')?$fid:0); ?>,'<?php echo $vo['fid']; ?>','','')"
             class="ml-5" style="text-decoration:none"><i class="layui-icon" >&#xe642;</i>
          </a>
          <a title="删除" href="javascript:;" onclick="member_del('<?php echo $vo['fid']; ?>','<?php echo $del; ?>','<?php echo $index; ?>?fid='+ <?php echo (isset($fid) && ($fid !== '')?$fid:0); ?>)"
             style="text-decoration:none"><i class="layui-icon">&#xe640;</i>
          </a>
      </td>
    </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
  </table>

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
<script>
  layui.use(['element','laypage','layer'], function(){
    $ = layui.jquery;//jquery
    laypage = layui.laypage;//分页
    layer = layui.layer;//弹出层

  });

  // 用户-编辑
  function member_add(title,url,urls,w,h){
    x_admin_show(title,url,urls);
  }

    //发异步修改推流状态
  function prohibit_status(fid,status) {
    var urls="/user/index";
      $.ajax({
      type: "post",
      url: '/user/update',
      data: {fid: fid,prohibit_status:status},
      dataType: "json",
      success: function (data) {
        if (data > 0) {
          layer.msg("操作成功", { icon: 1, time: 1000 });
        } else {
          layer.msg("操作失败" + data, { icon: 1, time: 1000 });
        }
        setTimeout(function () {
          window.location.href = urls;
        }, 1000);
      }
  });
}
</script>
</body>
</html>