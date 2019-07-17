<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:79:"/home/wwwroot/default/SIFIC/public/../application/admin/view/log/log_login.html";i:1537437006;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1548327812;}*/ ?>
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
              <a><cite>系统管理</cite></a>
              <a><cite>运行日志</cite></a>
              <a><cite><?php echo $title; ?></cite></a>
            </span>
  <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
     href="javascript:location.replace(location.href);" title="刷新">
    <i class="layui-icon" style="line-height:30px">ဂ</i>
  </a>
</div>
<div class="x-body">
  <form class="layui-form x-center" action="/sys/log_login" method="get">
    <div class="layui-form-pane" style="text-align: center;">
      <div class="layui-form-item" style="display: inline-block;">
        <div class="layui-input-inline">
          <select name="status" lay-search="" >
            <option value="">是否锁定</option>
            <?php if(is_array($is_no) || $is_no instanceof \think\Collection || $is_no instanceof \think\Paginator): $ko = 0; $__LIST__ = $is_no;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($ko % 2 );++$ko;?>
            <option value="<?php echo $ko; ?>"  <?php if($ko == $status): ?> selected="selected" <?php endif; ?> ><?php echo $vo; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </div>
        <div class="layui-input-inline">
          <input type="text" name="string" value="<?php echo $string; ?>" placeholder="用户姓名/登录地址/终端IMEI" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-input-inline" style="width:80px">
          <button class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </div>
      </div>
    </div>
  </form>
  
  <?php if(fid == 5): ?>
  <xblock>
    <button class="layui-btn" onclick="member_edit('添加','/sys/log_login/edit','/sys/log_login','')"><i class="layui-icon">&#xe608;</i>添加</button>
    <button class="layui-btn layui-btn-danger" onclick="member_del(-1,'/sys/log_login/delete','/sys/log_login')"><i class="layui-icon">&#xe640;</i>批量删除</button>
  </xblock>
  <?php endif; ?>  
    <span class="x-right" style="line-height:40px">共有数据：<?php echo $cnt; ?> 条</span>

  <table class="layui-table">
    <thead>
    <tr>
<!--       <th style="width:20px;">
        <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
      </th> -->
      <th style="width:40px;">ID</th>
      <th>用户名</th>
      <th>终端IMEI</th>
      <th>登录地址</th>
      <th>登录结果</th>
      <th>错误次数</th>
      <th>次数上限</th>
      <th>登录时间</th>
      <th>状态</th>
      <th style="width:120px;">操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <tr>
<!--       <td>
        <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo $vo['fid']; ?>'><i class="layui-icon">&#xe605;</i></div>
      </td> -->
      <td><?php echo $vo['fid']; ?></td>
      <td><?php echo $vo['user_name']; ?></td>
      <td><?php echo $vo['imei']; ?></td>
      <td><?php echo $vo['region_name']; ?></td>
      <td><?php echo $vo['login_result']; ?></td>
      <td><?php echo $vo['error_num']; ?></td>
      <td><?php echo $vo['error_limit']; ?></td>
      <td><?php echo $vo['create_time']; ?></td>
      <td><?php echo $vo['record_status']; ?></td>
      <td class="td-manage">
        <?php if($vo['status'] == 2 and $vo['error_num'] == 5): ?>
          <a title="禁用" href="javascript:;" span style="color:red" onclick="member_del('<?php echo $vo['fid']; ?>','/sys/log_login/delete','/sys/log_login','<?php echo $vo['user_name']; ?>','<?php echo $vo['status']; ?>')"
            style="text-decoration:none">启用</a>
        <?php else: ?><span style="color:#5FB863">正常</span><?php endif; ?>
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
  function member_del(id, url, urls,user_name,status) {
    if (id == -1) {
      var ids = tableCheck.getData();
    } else {
      var ids = id;
    }
    if (ids == '' || ids == null || ids < 0) {
      layer.msg('请选择要删除的数据！', {icon: 2, time:2000});
    } else {
      //询问框
      layer.confirm('确认要对该用户 【'+ user_name+'】状态操作？', {
        btn: ['是','否']
      }, function(){
        is_del(ids,url,urls,status);
      }, function(){
        window.location.href = urls;
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
          layer.msg("操作成功", {icon: 1, time: 1000});
        } else {
          layer.msg("操作失败", {icon: 1, time: 1000});
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