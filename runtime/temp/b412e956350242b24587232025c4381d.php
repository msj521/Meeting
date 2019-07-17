<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"/home/wwwroot/default/SIFIC/public/../application/admin/view/exam/edit.html";i:1547782683;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1542434096;}*/ ?>
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
        <!-- 右侧主体结束 -->
    <div class="x-body layui-anim layui-anim-up">
        <!-- 右侧内容框架，更改从这里开始 -->
        <form class="layui-form" action='<?php echo (isset($update) && ($update !== '')?$update:"/"); ?>' method="post" enctype="multipart/form-data">

            <div class="layui-form-item">
              <label class="layui-form-label">考试名称<?php html_sign();?></label>
              <div class="layui-input-block">
                <input type="text"  name="exam_name" lay-verify="required" autocomplete="off" placeholder="请输入" class="layui-input" value="<?php echo (isset($list['exam_name']) && ($list['exam_name'] !== '')?$list['exam_name']:''); ?>">
              </div>
            </div>
            
            <div class="layui-form-item">
              <label class="layui-form-label">考试时长<?php html_sign();?></label>
              <div class="layui-input-block">
                <input type="text" name="duration" lay-verify="required" placeholder="请输入" class="layui-input" value="<?php echo (isset($list['duration']) && ($list['duration'] !== '')?$list['duration']:0); ?>">
              </div>
            </div>
            
            <div class="layui-form-item">
              <label class="layui-form-label">考试总分<?php html_sign();?></label>
              <div class="layui-input-block">
                <input type="text" name="score_total" lay-verify="required" placeholder="请输入" class="layui-input" value="<?php echo (isset($list['score_total']) && ($list['score_total'] !== '')?$list['score_total']:0); ?>">
              </div>
            </div>
            
            <div class="layui-form-item">
              <label class="layui-form-label">及格分数<?php html_sign();?></label>
              <div class="layui-input-block">
                <input type="text" name="score_pass" lay-verify="required" placeholder="请输入" class="layui-input" value="<?php echo (isset($list['score_pass']) && ($list['score_pass'] !== '')?$list['score_pass']:0); ?>">
              </div>
            </div>
            
            <div class="layui-form-item">
              <label class="layui-form-label xbs768">答案解析</label>
              <div class="layui-input-block">
                <input type="radio" name="show_analysis" value="1" title="是" checked>
                <input type="radio" name="show_analysis" value="0" title="否" <?php if(isset($list['show_analysis']) and $list['show_analysis'] == 0): ?> checked <?php endif; ?>>
              </div>
            </div>
            

            <div class="layui-form-item">
                <label for="description" class="layui-form-label">简介</label>
                <div class="layui-input-block" >
                    <textarea placeholder="请输入简介" required id="description" name="description" autocomplete="off"
                    class="layui-textarea" style="height: 80px;"><?php echo (isset($list['description']) && ($list['description'] !== '')?$list['description']:''); ?></textarea>
                </div>
            </div>

          <input type="hidden" name="fid" value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:''); ?>">

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