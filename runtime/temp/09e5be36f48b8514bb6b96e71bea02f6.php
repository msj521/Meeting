<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"/home/wwwroot/default/SIFIC/public/../application/admin/view/empower/acl_edit.html";i:1547782805;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1542434096;}*/ ?>
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
<div class="x-body layui-anim layui-anim-up">
  <form class="layui-form" action="/sys/acl/update" method="post" enctype="multipart/form-data">

    <div class="layui-form-item">
      <label class="layui-form-label xbs768">应用名称<?php html_sign();?></label>
      <div class="layui-input-block">
          <select name="app_id" lay-search="" lay-verify="required">
            <option value="">--选择或者搜索--</option>
            <?php if(is_array($app_info) || $app_info instanceof \think\Collection || $app_info instanceof \think\Paginator): $i = 0; $__LIST__ = $app_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo $vo['fid']; ?>"  <?php if(isset($list['app_id']) && $vo['fid'] == $list['app_id']): ?> selected="selected" <?php endif; ?> ><?php echo $vo['app_name']; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
      </div>
    </div>

    <div class="layui-form-item">
      <label for="version_id" class="layui-form-label">应用版本号<?php html_sign();?></label>
      <div class="layui-input-block">
          <select name="version_id" lay-search="" lay-verify="required">
            <option value="">--选择或者搜索--</option>
            <?php if(is_array($version_info) || $version_info instanceof \think\Collection || $version_info instanceof \think\Paginator): $i = 0; $__LIST__ = $version_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo $vo['fid']; ?>"  <?php if(isset($list['version_id']) && $vo['fid'] == $list['version_id']): ?> selected="selected" <?php endif; ?> ><?php echo $vo['version_no']; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
      </div>
    </div>

    <div class="layui-form-item">
      <label for="function" class="layui-form-label">接口名称<?php html_sign();?></label>
      <div class="layui-input-block">
        <input class="layui-input" placeholder="%表示全部接口" lay-verify="required"  id="function" name="function" value="<?php echo (isset($list['function']) && ($list['function'] !== '')?$list['function']:''); ?>">
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label xbs768">分配时间<?php html_sign();?></label>
      <div class="layui-input-block xbs768">
        <input class="layui-input" id="LAY_demorange_s" lay-verify="required" name="issue_time" value="<?php echo (isset($list['issue_time']) && ($list['issue_time'] !== '')?$list['issue_time']:''); ?>">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label xbs768">过期时间<?php html_sign();?></label>
      <div class="layui-input-block xbs768">
        <input class="layui-input" id="LAY_demorange_e" lay-verify="required" name="expire_time" value="<?php echo (isset($list['expire_time']) && ($list['expire_time'] !== '')?$list['expire_time']:''); ?>">
      </div>
    </div>

    <input type="hidden" name="fid" value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:''); ?>">

    <div class="layui-form-item">
      <label class="layui-form-label xbs768">状态</label>
      <div class="layui-input-block">
        <input type="radio" name="record_status" value="1" title="启用"checked>

        <input type="radio" name="record_status" value="2" title="禁用" <?php if(isset($list['record_status']) && $list['record_status'] == 2): ?> checked <?php endif; ?>>
        <input type="radio" name="record_status" value="2" title="标记删除" <?php if(isset($list['record_status']) &&  $list['record_status'] == -1): ?> checked <?php endif; ?>>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label"></label>
      <button class="layui-btn" lay-filter="save" lay-submit="" type="submit">保存</button>
    </div>
  </form>
</div>
<script>
  layui.use('laydate', function () {
    var laydate = layui.laydate;

    //执行一个laydate实例
    laydate.render({
      elem: '#LAY_demorange_s'
      ,type: 'datetime'
    });
    //执行一个laydate实例
    laydate.render({
      elem: '#LAY_demorange_e'
      ,type: 'datetime'
    });

  });
</script>
</body>
</html>