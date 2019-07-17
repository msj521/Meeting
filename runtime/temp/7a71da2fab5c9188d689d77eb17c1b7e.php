<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"/home/wwwroot/default/SIFIC/public/../application/admin/view/meet/edit_live.html";i:1547779629;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1542434096;}*/ ?>
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
  <form class="layui-form" action="<?php echo (isset($update) && ($update !== '')?$update:'/'); ?>"  method="post" enctype="multipart/form-data">

    <div class="layui-form-item" <?php if(!isset($list['fid'])): ?> style="display:none" <?php endif; ?> >
      <label for="title" class="layui-form-label">标题</label>
      <div class="layui-input-block"><?php echo (isset($list['title']) && ($list['title'] !== '')?$list['title']:''); ?></div>
    </div>

    <div class="layui-form-item">
      <label for="live_id" class="layui-form-label">会议直播<?php html_sign();?></label>
      <div class="layui-input-block">
        <select name="live_id" id="live_id" lay-filter="live_id"   lay-verify="required" lay-search="">
        <option value="">--选择或者搜索--</option>
          <?php if(is_array($live) || $live instanceof \think\Collection || $live instanceof \think\Paginator): $i = 0; $__LIST__ = $live;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <option value="<?php echo $vo['fid']; ?>" <?php if(isset($list['live_id']) and $vo['fid'] == $list['live_id']): ?> selected="selected" <?php endif; ?> ><?php echo $vo['title']; ?></option>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
      </div>
    </div>
    <div class="layui-form-item">
      <label for="sort" class="layui-form-label">排序</label>
      <div class="layui-input-block">
        <input class="layui-input" id="sort" name="sort" required lay-verify="sort"  value="<?php echo (isset($list['sort']) && ($list['sort'] !== '')?$list['sort']:0); ?>">
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label xbs768">状态</label>
      <div class="layui-input-block">
        <input type="radio" name="record_status" value="1" title="启用" checked>
        <input type="radio" name="record_status" value="2" title="禁用" <?php if(isset($list['record_status']) and $list['record_status'] == 2): ?> checked <?php endif; ?>>
        <input type="radio" name="record_status" value="-1" title="标记删除" <?php if(isset($list['record_status']) and  $list['record_status'] == -1): ?> checked <?php endif; ?>>
      </div>
    </div>
    <input type="hidden" name="fid" value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:''); ?>">
    <input type="hidden" name="convention_id" value="<?php echo (isset($list['convention_id']) && ($list['convention_id'] !== '')?$list['convention_id']:$convention_id); ?>">
    <div class="layui-form-item">
      <label class="layui-form-label"></label>
      <button class="layui-btn" lay-filter="save" lay-submit="" type="submit">保存</button>
    </div>
  </form>
</div>
</body>
</html>