<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:86:"/home/wwwroot/default/SIFIC/public/../application/admin/view/product/section_edit.html";i:1547782146;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1548327812;}*/ ?>
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
        <!-- 右侧主体结束 -->
    <div class="x-body layui-anim layui-anim-up">
        <!-- 右侧内容框架，更改从这里开始 -->
        <form class="layui-form" action='<?php echo (isset($update) && ($update !== '')?$update:"/"); ?>' method="post" enctype="multipart/form-data">

            <div class="layui-form-item">
              <label for="class_id" class="layui-form-label">产品包类型<?php html_sign();?></label>
              <div class="layui-input-block">
                  <input type="text" disabled="disabled" autocomplete="off" class="layui-input" value="录播">
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">产品名称<?php html_sign();?></label>
              <div class="layui-input-block">
                <input type="text" disabled="disabled" autocomplete="off" class="layui-input" value="<?php echo (isset($list['product_name']) && ($list['product_name'] !== '')?$list['product_name']:''); ?>">
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">章节标题<?php html_sign();?></label>
              <div class="layui-input-block">
                <input type="text" autocomplete="off" lay-verify="required" name="section_name" placeholder="请输入章节标题" 
                class="layui-input" value="<?php echo (isset($list['title']) && ($list['title'] !== '')?$list['title']:''); ?>">
              </div>
            </div>
            
            <div class="layui-form-item">
                <label for="sort" class="layui-form-label">排序</label>
                <div class="layui-input-block" >
                    <input type="number" name="sort" lay-verify="required" class="layui-input" value="<?php echo (isset($list['sort']) && ($list['sort'] !== '')?$list['sort']:''); ?>">
                </div>
            </div>

          <input type="hidden" name="product_type" value="2">
          <input type="hidden" name="product_id" value="<?php echo (isset($product_id) && ($product_id !== '')?$product_id:''); ?>">
          <input type="hidden" name="fid" value="<?php echo (isset($fid) && ($fid !== '')?$fid:''); ?>">

          <div class="layui-form-item">
            <label class="layui-form-label xbs768">状态</label>
            <div class="layui-input-block">
              <input type="radio" name="record_status" value="1" title="启用"checked>
              <input type="radio" name="record_status" value="2" title="禁用" <?php if(isset($list['record_status']) and $list['record_status'] == 2): ?> checked <?php endif; ?>>
              <input type="radio" name="record_status" value="-1" title="标记删除" <?php if(isset($list['record_status']) and  $list['record_status'] == -1): ?> checked <?php endif; ?>>
            </div>
          </div>

            <div class="layui-form-item">
                <label for="L_sign" class="layui-form-label">
                </label>
                <button class="layui-btn" lay-filter="add" lay-submit="">
                    保存
                </button>
            </div>
        </form>
        <!-- 右侧内容框架，更改从这里结束 -->
    </div>
</body>
</html>