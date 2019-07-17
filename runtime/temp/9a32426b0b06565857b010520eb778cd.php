<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"/home/wwwroot/default/SIFIC/public/../application/admin/view/menu/edit.html";i:1547781814;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1548327812;}*/ ?>
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
  <form class="" action="/menu/update" method="post" enctype="multipart/form-data" >

    <div class="layui-form-item" <?php if(isset($list['pid']) && $list['pid'] == 0): ?> style="display:none" <?php endif; ?>>
      <label  for="pid" class="layui-form-label">父级菜单<?php html_sign();?></label>
      <div class="layui-input-inline">
        <select name="pid" id="pid"  lay-search="">
          <option value="">请选择</option>
          <?php if(is_array($parent) || $parent instanceof \think\Collection || $parent instanceof \think\Paginator): $i = 0; $__LIST__ = $parent;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <option value="<?php echo $vo['fid']; ?>"
                  <?php if(isset($list['pid']) && $vo['fid'] == $list['pid']): ?> selected="selected" <?php endif; ?>><?php echo $vo['menu_name']; ?>
          </option>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">菜单名称<?php html_sign();?></label>
      <div class="layui-input-inline">
        <input  type="text" id="menu_name" name="menu_name" required layui_search=""  autocomplete="off" value="<?php echo (isset($list['menu_name']) && ($list['menu_name'] !== '')?$list['menu_name']:''); ?>" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item" <?php if((isset($list['fid']) && $list['pid'] == 0)): ?> style="display: none" <?php endif; ?>>
      <label for="route" class="layui-form-label">路由地址<?php html_sign();?></label>
      <div class="layui-input-inline">
        <input  type="text" id="route" name="route"  
        <?php if(isset($list['fid'])): ?> disabled="disabled" <?php else: ?> required   <?php endif; ?>
         autocomplete="off" value="<?php echo (isset($list['route']) && ($list['route'] !== '')?$list['route']:''); ?>" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item">
      <label  for="app_type" class="layui-form-label">菜单类型<?php html_sign();?></label>
      <div class="layui-input-inline">
        <select name="app_type" id="app_type" required lay-search="">
          <option value="">请选择</option>
          <?php if(is_array($class) || $class instanceof \think\Collection || $class instanceof \think\Paginator): $ko = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($ko % 2 );++$ko;?>
          <option value="<?php echo $ko; ?>"
                  <?php if(isset($list['app_type']) && $ko == $list['app_type']): ?> selected="selected" <?php endif; ?>><?php echo $vo; ?>
          </option>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">是否启用</label>
      <div class="layui-input-inline">
        <select name="record_status" id="record_status">
          <?php if(is_array($is_no) || $is_no instanceof \think\Collection || $is_no instanceof \think\Paginator): $k = 0; $__LIST__ = $is_no;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
          <option value="<?php echo $k; ?>"
                  <?php if(isset($list['record_status']) && $list['record_status'] == $k): ?> selected="selected" <?php endif; ?>><?php echo $v; ?></option>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
      </div>
    </div>
    <input type="hidden" name="fid" value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:''); ?>">
    <div class="layui-form-item">
      <label class="layui-form-label"></label>
      <button class="layui-btn" layui_filter="save" layui_submit="" type="submit">保存</button>
    </div>
  </form>
</div>
</body>
</html>