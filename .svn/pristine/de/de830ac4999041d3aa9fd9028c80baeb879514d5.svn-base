<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"/home/wwwroot/default/SIFIC/public/../application/admin/view/meet/edit_author.html";i:1547783081;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1548316198;}*/ ?>
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

<style type="text/css">
  /*隐藏全选checkbox*/
  .layui-table th .layui-unselect{
      display: none;
  }
</style>
<body>
        <!-- 右侧主体结束 -->
    <div class="x-body layui-anim layui-anim-up">
        <!-- 右侧内容框架，更改从这里开始 -->
        <form class="layui-form"  action="<?php echo $update; ?>" method="post" enctype="multipart/form-data">

            <div class="layui-form-item">
              <label class="layui-form-label">姓名<?php html_sign();?></label>
              <div class="layui-input-block">
                <input type="text"  name="author_name" lay-verify="required" autocomplete="off" placeholder="请输入姓名" class="layui-input" value="<?php echo (isset($list['author_name']) && ($list['author_name'] !== '')?$list['author_name']:''); ?>">
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">手机<?php html_sign();?></label>
              <div class="layui-input-block">
                <input type="text"  name="tel" lay-verify="required" autocomplete="off" placeholder="请输入手机" class="layui-input" value="<?php echo (isset($list['tel']) && ($list['tel'] !== '')?$list['tel']:''); ?>">
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">邮箱<?php html_sign();?></label>
              <div class="layui-input-block">
                <input type="text" name="email" lay-verify="email" autocomplete="off" placeholder="请输入邮箱" class="layui-input" value="<?php echo (isset($list['email']) && ($list['email'] !== '')?$list['email']:''); ?>">
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">地址</label>
              <div class="layui-input-block">
                <input type="text" name="address" lay-verify="address" autocomplete="off" placeholder="请输入地址" class="layui-input" value="<?php echo (isset($list['address']) && ($list['address'] !== '')?$list['address']:''); ?>">
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">单位</label>
              <div class="layui-input-block">
                <input type="text" name="company" lay-verify="company" autocomplete="off" placeholder="请输入单位" class="layui-input" value="<?php echo (isset($list['company']) && ($list['company'] !== '')?$list['company']:''); ?>">
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label xbs768">作者类别</label>
              <div class="layui-input-block">
                <input type="radio" name="author_type" value="1" title="文章作者" checked>
                <input type="radio" name="author_type" value="2" title="通讯作者" <?php if(isset($list['type']) && $list['type'] == 2): ?> checked <?php endif; ?>>
                <input type="radio" name="author_type" value="3" title="其他作者" <?php if(isset($list['type']) &&  $list['type'] == 3): ?> checked <?php endif; ?>>
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
			<input type="hidden" name="fid" value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:'0'); ?>">
			<input type="hidden" name="paper_id" value="<?php echo (isset($paper_id) && ($paper_id !== '')?$paper_id:'0'); ?>">
            <div class="layui-form-item">
              <label  class="layui-form-label"></label>
              <button class="layui-btn" lay-filter="add" lay-submit="">保存</button>
            </div>
        </form>
        <!-- 右侧内容框架，更改从这里结束 -->
    </div>
    <!-- 中部束 -->
</body>
</html>