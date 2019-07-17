<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"/home/wwwroot/default/SIFIC/public/../application/admin/view/item/edit.html";i:1547782594;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1548327812;}*/ ?>
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
<div class="x-body layui-anim layui-anim-up">
  <form class="layui-form" action="/sys/item/update" method="post" enctype="multipart/form-data">

    <div class="layui-form-item">
      <label for="class_name_zh" class="layui-form-label">名称<?php html_sign();?></label>
      <div class="layui-input-block">
        <input type="text" id="class_name_zh" name="class_name_zh" lay-verify="required" autocomplete="off"
               value="<?php echo (isset($list['class_name_zh']) && ($list['class_name_zh'] !== '')?$list['class_name_zh']:''); ?>" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label xbs768">基础分类<?php html_sign();?></label>
        <div class="layui-input-block">
          <?php if(isset($list['fid'])): ?> 
            <input type="text" lay-verify="title"  disabled="disabled" class="layui-input"  value="<?php echo get_class_type($list['class_type']); ?>" >
            <input type="hidden" name="class_type" value="<?php echo $list['class_type']; ?>">
          <?php else: ?>
          <select name="class_type" lay-verify="required" lay-search="" >
            <option value="">直接选择或搜索选择</option>
              <?php if(is_array($class_type) || $class_type instanceof \think\Collection || $class_type instanceof \think\Paginator): $ko = 0; $__LIST__ = $class_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($ko % 2 );++$ko;?>
              <option value="<?php echo $ko; ?>"><?php echo $vo; ?></option>
              <?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
          <?php endif; ?>
        </div>
    </div>
    <input type="hidden" name="fid" value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:''); ?>">
	
    <div class="layui-form-item">
      <label for="sort" class="layui-form-label">排序</label>
      <div class="layui-input-block">
         <input type="text" class="layui-input" name="sort" value="<?php echo (isset($list['sort']) && ($list['sort'] !== '')?$list['sort']:''); ?>">
      </div>
    </div>

    <div class="layui-form-item">
      <label for="remark" class="layui-form-label">备注</label>
      <div class="layui-input-block">
        <textarea placeholder="请输入内容" class="layui-textarea" type="text" id="remark" name="remark"><?php echo (isset($list['remark']) && ($list['remark'] !== '')?$list['remark']:''); ?></textarea>
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label xbs768">状态</label>
      <div class="layui-input-block">
        <input type="radio" name="record_status" value="1" title="启用" checked>
        <input type="radio" name="record_status" value="2" title="禁用" <?php if(isset($list['record_status']) && $list['record_status'] == 2): ?> checked <?php endif; ?>>
        <input type="radio" name="record_status" value="-1" title="标记删除" <?php if(isset($list['record_status']) &&  $list['record_status'] == -1): ?> checked <?php endif; ?>>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label"></label>
      <button class="layui-btn" lay-filter="save" lay-submit="" type="submit">保存</button>
    </div>
  </form>
</div>
<script>
</script>
</body>
</html>