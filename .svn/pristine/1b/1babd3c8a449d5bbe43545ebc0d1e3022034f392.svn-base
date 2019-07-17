<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"/home/wwwroot/default/SIFIC/public/../application/admin/view/user/edit.html";i:1547782481;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1548327812;}*/ ?>
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
              <label class="layui-form-label">昵称</label>
              <div class="layui-input-block">
                <input type="text" required name="nick_name" lay-verify="title" autocomplete="off" placeholder="请输入昵称" class="layui-input" value="<?php echo (isset($data['user_info']['nick_name']) && ($data['user_info']['nick_name'] !== '')?$data['user_info']['nick_name']:''); ?>">
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">姓名<?php html_sign();?></label>
              <div class="layui-input-block">
                <input type="text"  name="user_name" lay-verify="required" autocomplete="off" placeholder="请输入姓名" class="layui-input" value="<?php echo (isset($data['user_info']['user_name']) && ($data['user_info']['user_name'] !== '')?$data['user_info']['user_name']:''); ?>">
              </div>
            </div>

          <div class="layui-form-item">
            <label class="layui-form-label">头像上传<?php html_sign();?></label>
            <div class="layui-upload">
              <div style="float: left; width: 150px; text-align: center;">
                <button type="button" class="layui-btn" id="img">头像图片</button>
                <div class="layui-upload-list">
                  <img class="layui-upload-img" id="img1" width="150" src="<?php echo (isset($data['user_info']['image_url']) && ($data['user_info']['image_url'] !== '')?$data['user_info']['image_url']:''); ?>">
                </div>
              </div>
            </div>
          </div>

            <input type="hidden" name="fid" value="<?php echo (isset($data['user_info']['fid']) && ($data['user_info']['fid'] !== '')?$data['user_info']['fid']:'0'); ?>">
            <input type="hidden" name="web_image_id" id="FImageUrl" value="<?php echo (isset($data['user_info']['web_image_id']) && ($data['user_info']['web_image_id'] !== '')?$data['user_info']['web_image_id']:''); ?>">
            <input type="hidden" name="app_image_id" id="FImageUrls" value="<?php echo (isset($data['user_info']['app_image_id']) && ($data['user_info']['app_image_id'] !== '')?$data['user_info']['app_image_id']:''); ?>">
            <div class="layui-form-item">
              <label class="layui-form-label">电话<?php html_sign();?></label>
              <div class="layui-input-block">
                <input type="text"  name="tel" lay-verify="required" autocomplete="off" placeholder="请输入电话" class="layui-input" value="<?php echo (isset($data['user_info']['tel']) && ($data['user_info']['tel'] !== '')?$data['user_info']['tel']:''); ?>">
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">密码<?php html_sign();?></label>
              <div class="layui-input-block">
                <input type="password" required name="password" lay-verify="required" autocomplete="off" placeholder="请输入密码" class="layui-input" value="<?php echo (isset($data['user_info']['password']) && ($data['user_info']['password'] !== '')?$data['user_info']['password']:''); ?>">
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">邮箱<?php html_sign();?></label>
              <div class="layui-input-block">
                <input type="text" name="email"  required lay-verify="required" autocomplete="off" placeholder="请输入邮箱" class="layui-input" value="<?php echo (isset($data['user_info']['email']) && ($data['user_info']['email'] !== '')?$data['user_info']['email']:''); ?>">
              </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label for="description" class="layui-form-label">简介</label>
                <div class="layui-input-block" >
                    <textarea placeholder="请输入简介" id="description" name="description" autocomplete="off"
                    class="layui-textarea" style="height: 80px;"><?php echo (isset($data['user_info']['description']) && ($data['user_info']['description'] !== '')?$data['user_info']['description']:''); ?></textarea>
                </div>
            </div>


            <div class="layui-form-item">
                <label class="layui-form-label xbs768">职称</label>
                <div class="layui-input-inline">
                  <select name="job_id" lay-verify="" lay-search="" >
                    <option value="">直接选择或搜索选择</option>
                    <?php if(is_array($job) || $job instanceof \think\Collection || $job instanceof \think\Paginator): $k = 0; $__LIST__ = $job;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
                    <option value="<?php echo $v['fid']; ?>"
                            <?php if(isset($data['user_info']['job_id']) && $data['user_info']['job_id'] == $v['fid']): ?> selected="selected" <?php endif; ?>><?php echo $v['class_name_zh']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label xbs768">学历</label>
                <div class="layui-input-inline">
                  <select name="education_id" lay-verify="" lay-search="" >
                    <option value="">直接选择或搜索选择</option>
                    <?php if(is_array($edu) || $edu instanceof \think\Collection || $edu instanceof \think\Paginator): $k = 0; $__LIST__ = $edu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
                    <option value="<?php echo $v['fid']; ?>"
                            <?php if(isset($data['user_info']['education_id']) && $data['user_info']['education_id'] == $v['fid']): ?> selected="selected" <?php endif; ?>><?php echo $v['class_name_zh']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label xbs768">机构/单位</label>
                <div class="layui-input-block">
                  <select name="org_id" lay-verify="" lay-search="" >
                    <option value="">直接选择或搜索选择</option>
                    <?php if(is_array($org) || $org instanceof \think\Collection || $org instanceof \think\Paginator): $k = 0; $__LIST__ = $org;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
                    <option value="<?php echo $v['fid']; ?>"
                            <?php if(isset($data['user_info']['org_id']) && $data['user_info']['org_id'] == $v['fid']): ?> selected="selected" <?php endif; ?>><?php echo $v['org_name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">自定义机构</label>
              <div class="layui-input-block">
                <input type="text" name="diy_org" lay-verify="title" autocomplete="off" placeholder="请输入自定义机构或单位" class="layui-input" value="<?php echo (isset($data['user_info']['diy_org']) && ($data['user_info']['diy_org'] !== '')?$data['user_info']['diy_org']:''); ?>">
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">部门</label>
              <div class="layui-input-block">
                <input type="text" name="department" lay-verify="title" autocomplete="off" placeholder="请输入部门" class="layui-input" value="<?php echo (isset($data['user_info']['department']) && ($data['user_info']['department'] !== '')?$data['user_info']['department']:''); ?>">
              </div>
            </div>

            <table class="layui-hide" id="role" lay-data="{id:'myTable'}" lay-filter="myTable"></table>
            <input type="hidden" name="role">

            <div class="layui-form-item">
              <label class="layui-form-label xbs768">状态</label>
              <div class="layui-input-block">
                <input type="radio" name="record_status" value="1" title="启用" checked>
                <input type="radio" name="record_status" value="2" title="禁用" <?php if(isset($data['user_info']['record_status']) && $data['user_info']['record_status'] == 2): ?> checked <?php endif; ?>>
                <input type="radio" name="record_status" value="-1" title="标记删除" <?php if(isset($data['user_info']['record_status']) &&  $data['user_info']['record_status'] == -1): ?> checked <?php endif; ?>>
              </div>
            </div>

            <div class="layui-form-item">
              <label  class="layui-form-label"></label>
              <button class="layui-btn" lay-filter="add" lay-submit="">保存</button>
            </div>
        </form>
        <!-- 右侧内容框架，更改从这里结束 -->
    </div>
    <!-- 中部结束 -->

</body>

<script>
  layui.use('upload',function(){
    var upload = layui.upload;
    var web_image_id='<?php echo (isset($data['user_info']['web_image_id']) && ($data['user_info']['web_image_id'] !== '')?$data['user_info']['web_image_id']:0); ?>';
    var app_image_id='<?php echo (isset($data['user_info']['app_image_id']) && ($data['user_info']['app_image_id'] !== '')?$data['user_info']['app_image_id']:0); ?>';
    //普通图片上传
    upload.render({
      elem: '#img'
      ,url: '/upload'
      ,data: {web_image_id:web_image_id,app_image_id:app_image_id}
      ,acceptMime: 'image/*'
      ,before: function(obj){
        obj.preview(function(index, file, result){
          $('#img1').attr('src', result);
        });
      }
      ,done: function(res){
        //如果上传失败
        console.log(res);
        if(res.code==200){
          $('#FImageUrl,#FImageUrls').attr('value', res.data);
          return layer.msg('上传成功');
        }else{
          return layer.msg('上传失败');
        }
      }
    });

  });

  layui.use(['jquery','form','layer', 'table'], function(){
    var form = layui.form;
    var table = layui.table;

    var fid ='<?php echo (isset($data["user_info"]["fid"]) && ($data["user_info"]["fid"] !== '')?$data["user_info"]["fid"]:0); ?>';

    /*//加载权限表
    $.ajax({
        url: '/role/list?fid='+fid,
        dataType: 'json',
        method: 'GET',
        success: function(data) {
           table.render({
              elem: '#role'
              ,cols: [[
                {type:'checkbox'}
                ,{field:'FRoleName', title: '权限组名称'}
              ]],
              data:data
            });

           //保存原始权限数据
           for (var i = 0; i < data.length; i++) {
            if (data[i]['LAY_CHECKED']==1) {
               selectRole.push(data[i]['fid']);
            }
           }
           $("input[name='role']").val(JSON.stringify(selectRole));
        },
        error: function(xhr) {
           // 导致出错的原因较多，以后再研究
           //alert('error:' + JSON.stringify(xhr));
        }
     });*/

    //选中权限的监听事件
    var selectRole = [];
     table.on('checkbox(myTable)',function(obj){
        var check = obj.checked;
        // var type = obj.type;
        var data = obj.data;

        var index = selectRole.indexOf(data.fid);
        if (index > -1) {
            selectRole.splice(index, 1);
        }
        if (check) {
          selectRole.push(data.fid);
        } 
         $("input[name='role']").val(JSON.stringify(selectRole));
    })
    
  });
</script>
</html>