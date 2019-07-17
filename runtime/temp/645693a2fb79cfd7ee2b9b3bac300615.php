<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:77:"/home/wwwroot/default/SIFIC/public/../application/admin/view/log/log_api.html";i:1537437006;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1548327812;}*/ ?>
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
  <form class="layui-form x-center" action="/sys/log_api" method="get">
    <div class="layui-form-pane" style="text-align: center;">
      <div class="layui-form-item" style="display: inline-block;">
        <div class="layui-input-inline">
          <select name="app_type_id" lay-search="" >
            <option value="">应用端类型</option>
            <?php if(is_array($app_type) || $app_type instanceof \think\Collection || $app_type instanceof \think\Paginator): $ko = 0; $__LIST__ = $app_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($ko % 2 );++$ko;?>
            <option value="<?php echo $ko; ?>"  <?php if($ko == $app_type_id): ?> selected="selected" <?php endif; ?> ><?php echo $vo; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </div>      
        <div class="layui-input-inline">
          <input type="text" name="string" value="<?php echo $string; ?>" placeholder="用户姓名/IP地址/终端IMEI" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-input-inline" style="width:80px">
          <button class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </div>
      </div>
    </div>
  </form>
    <span class="x-right" style="line-height:40px">共有数据：<?php echo $cnt; ?> 条</span>

  <table class="layui-table">
    <thead>
    <tr>
      <th style="width:40px;">ID</th>
      <th>用户名</th>
      <th>终端类型</th>
      <th>终端IMEI</th>
      <th>版本号</th>
      <th>IP地址</th>
      <th>浏览器类型</th>
      <th>接口名称</th>
      <th>URL</th>
      <th>调用结果</th>
      <th>返回内容</th>
      <th>耗时</th>
      <th>创建时间</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <tr>
      <td><?php echo $vo['fid']; ?></td>
      <td><?php echo $vo['user_name']; ?></td>
      <td><?php echo app_type($vo['app_type']); ?></td>
      <td><?php echo $vo['imei']; ?></td>
      <td><?php echo $vo['version_no']; ?></td>
      <td><?php echo $vo['ip']; ?></td>
      <td><?php echo $vo['http_agent']; ?></td>
      <td><?php echo $vo['method']; ?></td>
      <td><?php echo $vo['url']; ?></td>
      <td><?php echo $vo['result']; ?></td>
      <td><?php echo $vo['returnstr']; ?></td>
      <td><?php echo $vo['elapse']; ?></td>
      <td><?php echo $vo['create_time']; ?></td>
    </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
  </table>
  <div class="page">
    <?php echo $list->render(); ?>
  </div>
</div>
<script>
</script>
</body>
</html>