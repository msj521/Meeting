<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:89:"/home/wwwroot/default/SIFIC/public/../application/admin/view/version/version_up_edit.html";i:1547782055;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1542434096;}*/ ?>
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
  <form class="layui-form" action="/sys/version_up/update" method="post" enctype="multipart/form-data">

    <div class="layui-form-item">
      <label class="layui-form-label xbs768">用户姓名<?php html_sign();?></label>
      <div class="layui-input-block">
          <select name="user_id" lay-search="" >
            <option value="">--选择或者搜索用户姓名--</option>
            <?php if(is_array($user_info) || $user_info instanceof \think\Collection || $user_info instanceof \think\Paginator): $i = 0; $__LIST__ = $user_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo $vo['fid']; ?>"  <?php if(isset($list['user_id']) && $vo['fid'] == $list['user_id']): ?> selected="selected" <?php endif; ?> ><?php echo $vo['user_name']; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label xbs768">指定单位id</label>
      <div class="layui-input-block">
        <input type="number" name="org_id" autocomplete="off" placeholder="请输入指定单位id" class="layui-input" value="<?php echo (isset($list['org_id']) && ($list['org_id'] !== '')?$list['org_id']:0); ?>">
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">升级密码<?php html_sign();?></label>
      <div class="layui-input-block">
        <input type="password" required name="dl_pass" lay-verify="required" autocomplete="off" placeholder="请输入密码" class="layui-input" value="<?php echo (isset($list['dl_pass']) && ($list['dl_pass'] !== '')?$list['dl_pass']:''); ?>">
      </div>
    </div>

    <div class="layui-form-item">
      <label for="version_id" class="layui-form-label">应用版本号<?php html_sign();?></label>
      <div class="layui-input-block">
          <select name="version_id" lay-search="" >
            <option value="">--选择或者搜索版本号--</option>
            <?php if(is_array($version_info) || $version_info instanceof \think\Collection || $version_info instanceof \think\Paginator): $i = 0; $__LIST__ = $version_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo $vo['fid']; ?>"  <?php if(isset($list['version_id']) && $vo['fid'] == $list['version_id']): ?> selected="selected" <?php endif; ?> ><?php if($vo['app_postfix']==1): ?>android<?php elseif($vo['app_postfix']==2): ?>ios<?php elseif($vo['app_postfix']==3): ?>web<?php endif; ?>V<?php echo $vo['version_no']; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
      </div>
    </div>

    <div class="layui-form-item">
      <label for="force_type" class="layui-form-label">升级控制</label>
      <div class="layui-input-block">
          <select name="force_type" lay-search="" >
            <option value="">--请选择--</option>
            <?php if(is_array($version_up_type) || $version_up_type instanceof \think\Collection || $version_up_type instanceof \think\Paginator): $ko = 0; $__LIST__ = $version_up_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($ko % 2 );++$ko;?>
            <option value="<?php echo $ko; ?>"  <?php if(isset($list['force_type']) && $ko == $list['force_type']): ?> selected="selected" <?php endif; ?> ><?php echo $vo; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
      </div>
    </div>
<!-- 
    <div class="layui-form-item">
      <label for="force_type" class="layui-form-label">条件判定</label>
      <div class="layui-input-block">
          <select name="force_type" lay-search="" >
            <option value="">--请选择--</option>
            <?php if(is_array($version_up_type) || $version_up_type instanceof \think\Collection || $version_up_type instanceof \think\Paginator): $ko = 0; $__LIST__ = $version_up_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($ko % 2 );++$ko;?>
            <option value="<?php echo $ko; ?>"  <?php if(isset($list['force_type']) && $ko == $list['force_type']): ?> selected="selected" <?php endif; ?> ><?php echo $vo; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
      </div>
    </div> -->

    <div class="layui-form-item">
      <label class="layui-form-label xbs768">开始时间<?php html_sign();?></label>
      <div class="layui-input-block xbs768">
        <input class="layui-input" id="LAY_demorange_s" name="start_time" value="<?php echo (isset($list['start_time']) && ($list['start_time'] !== '')?$list['start_time']:''); ?>">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label xbs768">结束时间<?php html_sign();?></label>
      <div class="layui-input-block xbs768">
        <input class="layui-input" id="LAY_demorange_e" name="end_time" value="<?php echo (isset($list['end_time']) && ($list['end_time'] !== '')?$list['end_time']:''); ?>">
      </div>
    </div>

    <div class="layui-form-item">
      <label for="memo" class="layui-form-label">升级说明<?php html_sign();?></label>
      <div class="layui-input-block">
        <textarea placeholder="请输入内容" class="layui-textarea" type="text" id="memo" name="memo"><?php echo (isset($list['memo']) && ($list['memo'] !== '')?$list['memo']:''); ?></textarea>
      </div>
    </div>
    <input type="hidden" name="fid" value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:''); ?>">

    <div class="layui-form-item">
      <label class="layui-form-label xbs768">状态</label>
      <div class="layui-input-block">
        <input type="radio" name="record_status" value="1" title="启用" checked>

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