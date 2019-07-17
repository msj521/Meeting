<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:77:"/home/wwwroot/default/SIFIC/public/../application/admin/view/index/index.html";i:1537437005;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1548327812;s:66:"/home/wwwroot/default/SIFIC/application/admin/view/public/top.html";i:1548387351;}*/ ?>
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
 <!-- 顶部开始 -->
    <div class="container">
        <div class="logo"><a href="/admin">SIFIC</a></div>
        <div class="left_open">
            <i title="展开左侧栏" class="iconfont">&#xe699;</i>
        </div>
        <ul class="sub-menu layui-nav left fast-add">
          <!--头部父级菜单-->
          <?php if(is_array($parent) || $parent instanceof \think\Collection || $parent instanceof \think\Paginator): $ko = 0; $__LIST__ = $parent;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($ko % 2 );++$ko;?>
            <li class="layui-nav-item">
              <a href="javascript:;" onclick="menu('<?php echo $vo['fid']; ?>')"  ><?php echo $vo['menu_name']; ?></a>
            </li>
          <?php endforeach; endif; else: echo "" ;endif; ?>
		
        </ul>
        <ul class="layui-nav right" lay-filter="">
          <li class="layui-nav-item">
            <a href="javascript:;"><?php echo user_name; ?></a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
              <!-- <dd><a onclick="x_admin_show('个人信息','http://www.baidu.com')">个人信息</a></dd> -->
              <dd><a href="/louts">退出</a></dd>
            </dl>
          </li>
          <li class="layui-nav-item to-index"><a target="_blank" href="/">前台首页</a></li>
        </ul>
        
    </div>   
    <!-- 顶部结束 -->
 <script>
   function menu(o){
     location.href="/module?fid="+o;
   }
 </script>
    <!-- 中部开始 -->
<?php if(isset($menu)): ?>
  <?php echo $menu; endif; ?>
    <!-- 右侧主体开始 -->
    <div class="page-content">
        <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
          <ul class="layui-tab-title">
            <li class="home"><i class="layui-icon">&#xe68e;</i>我的桌面</li>
          </ul>
          <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe <?php if(isset($menu_index['route'])): ?> src='<?php echo $menu_index["route"]; ?>' <?php else: ?> src='/welcome'<?php endif; ?> frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
          </div>
        </div>
    </div>
    <div class="page-content-bg"></div>
    <!-- 右侧主体结束 -->
</body>
</html>