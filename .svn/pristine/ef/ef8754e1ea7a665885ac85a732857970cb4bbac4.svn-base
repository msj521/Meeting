<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"/home/wwwroot/default/SIFICYear/public/../application/admin/view/menu/meet_menu.html";i:1542443722;s:73:"/home/wwwroot/default/SIFICYear/application/admin/view/public/header.html";i:1548327812;}*/ ?>
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
    会议名称：<?php echo $convention_name; ?>
  <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
     href="javascript:location.replace(location.href);" title="刷新">
    <i class="layui-icon" style="line-height:30px">ဂ</i>
  </a>
</div>
<div class="x-body">
  <form class="layui-form x-center" action="/menu/meet" method="get">
    <div class="layui-form-pane" style="text-align: center;">
      <div class="layui-form-item" style="display: inline-block;">


        <div class="layui-input-inline">
          <input type="text" name="string" value="<?php echo $string; ?>"  autocomplete="off" class="layui-input">
          <input type="hidden" name="fid" value="<?php echo $convention_id; ?>">
        </div>
        <div class="layui-input-inline" style="width:80px">
          <button class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </div>
      </div>
    </div>
  </form>
  <xblock>
    <span class="layui-btn" style="line-height:40px">共有数据：<?php echo $cnt; ?> 条</span>
  </xblock>

  <table class="layui-table">
    <thead>
    <tr>
        <th style="width:20px;">
          <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
        </th>
        <th style="width:40px;">ID</th>
        <th>菜单名称</th>
        <th>菜单路由</th>
        <th>当前状态</th>
        <th style="width:120px;">操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <tr>
    <tr>
      <td>
        <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo $vo['fid']; ?>'><i class="layui-icon">&#xe605;</i></div>
      </td>
      <td><?php echo $vo['fid']; ?></td>
      <td title="<?php echo $vo['menu_name']; ?>"><?php echo $vo['menu_name']; ?></td>
      <td title="<?php echo $vo['route']; ?>"><?php echo (isset($vo['route']) && ($vo['route'] !== '')?$vo['route']:'父级菜单'); ?></td>
      <td>
        <?php if(in_array($convention_id,explode(',',$vo['convention_ids']))): ?>
            禁用
        <?php else: ?>
            启用
        <?php endif; ?>
      </td>
      <td class="td-manage">
          <?php if(in_array($convention_id,explode(',',$vo['convention_ids']))): ?>
              <a href="javascript:;" class="layui-btn layui-btn-primary" onclick="member_check(<?php echo $vo['fid']; ?>,<?php echo $convention_id; ?>,'/menu/meetdel','/menu/meet?fid=<?php echo $convention_id; ?>',1)"
                style="text-decoration:none">
                <span style="color: #4ae18e;">启用</span>
              </a>
          <?php else: ?>
                  <a href="javascript:;" class="layui-btn layui-btn-primary" onclick="member_check(<?php echo $vo['fid']; ?>,<?php echo $convention_id; ?>,'/menu/meetdel','/menu/meet?fid=<?php echo $convention_id; ?>',2)"
                    style="text-decoration:none">
                    <span style="color: #e1504a;">禁用</span>
                  </a>
          <?php endif; ?>
      </td>      
    </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
  </table>
  <div class="page">
    <?php echo $list->render(); ?>
  </div>
</div>
<!-- 审核操作 -->
<script>
  function member_check(id, convention_id, url, urls,type) {
    var html=type==1?"启用":"禁用";
    if (id == '' || id== null || id < 0) {
      layer.msg('请选择要操作的选项！', { icon: 2, time: 2000 });
    } else {
      layer.confirm("确认要"+html+'?', {
        btn: ['是', '否']
      }, function () {
        //发异步审核数据
        $.ajax({
          type: "post",
          url: url,
          data: { fid: id, convention_id: convention_id,type:type },
          dataType: "json",
          success: function (data) {
            if (data > 0) {
              layer.msg(html+"成功", { icon: 1, time: 1000 });
            } else {
              layer.msg(html +"失败", { icon: 1, time: 1000 });
            }
            setTimeout(function () {
              window.location.href = urls;
            }, 1000);
          }
        });
      }, function () {
         window.location.href = urls;
      });
    }
  }
</script>
</body>
</html>