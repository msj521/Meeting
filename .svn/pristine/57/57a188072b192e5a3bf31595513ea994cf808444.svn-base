<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"/home/wwwroot/default/SIFIC/public/../application/admin/view/product/order_edit.html";i:1547782233;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1548327812;}*/ ?>
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
              <label for="product_id" class="layui-form-label">产品名称<?php html_sign();?></label>
              <div class="layui-input-block">
                <select name="product_id" lay-verify="required"  lay-search="">
                  <option value="">--选择或者搜索--</option>
                  <?php if(is_array($product_list) || $product_list instanceof \think\Collection || $product_list instanceof \think\Paginator): $i = 0; $__LIST__ = $product_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                  <option value="<?php echo $vo['fid']; ?>" <?php if(isset($list['product_id']) and $vo['fid'] == $list['product_id']): ?> selected="selected" <?php endif; ?> ><?php echo $vo['product_name']; ?></option>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>
            </div>

            <div class="layui-form-item">
                <label for="class_id" class="layui-form-label">产品类型<?php html_sign();?></label>
                <div class="layui-input-block">
                  <select name="product_type" lay-verify="required"  lay-search="" >
                    <option value="">--选择或者搜索--</option>
                    <?php if(is_array($product_type) || $product_type instanceof \think\Collection || $product_type instanceof \think\Paginator): $ko = 0; $__LIST__ = $product_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($ko % 2 );++$ko;?>
                    <option value="<?php echo $ko; ?>" <?php if(isset($list['product_type']) and $ko == $list['product_type']): ?> selected="selected" <?php endif; ?> ><?php echo $vo; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>
            </div>

            <div class="layui-form-item"  >
              <label for="user_id" class="layui-form-label">客户<?php html_sign();?></label>
              <div class="layui-input-block">
                <select  name="user_id" lay-verify="required"  lay-search="">
                    <option value="">--选择或者搜索--</option>
                    <?php if(is_array($user_list) || $user_list instanceof \think\Collection || $user_list instanceof \think\Paginator): $i = 0; $__LIST__ = $user_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                      <option value="<?php echo $vo['fid']; ?>" <?php if(isset($list['user_id']) and $vo['fid'] == $list['user_id']): ?> selected="selected" <?php endif; ?> ><?php echo $vo['user_name']; ?>--<?php echo $vo['tel']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>
          </div>
              
            <div class="layui-form-item">
              <label class="layui-form-label">产品原价<?php html_sign();?></label>
              <div class="layui-input-block">
                <input type="text" name="price_origin" lay-verify="required" placeholder="请输入" class="layui-input" value="<?php echo (isset($list['price_origin']) && ($list['price_origin'] !== '')?$list['price_origin']:0); ?>">
              </div>
            </div>
              
            <div class="layui-form-item">
              <label class="layui-form-label">实际支付<?php html_sign();?></label>
              <div class="layui-input-block">
                <input type="text" name="price_purchase" lay-verify="required" placeholder="请输入" class="layui-input" value="<?php echo (isset($list['price_purchase']) && ($list['price_purchase'] !== '')?$list['price_purchase']:0); ?>">
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label xbs768">购买时间<?php html_sign();?></label>
              <div class="layui-input-block">
                <input class="layui-input" id="LAY_demorange_s" lay-verify="required" name="create_time" value="<?php echo (isset($list['create_time']) && ($list['create_time'] !== '')?$list['create_time']:''); ?>">
              </div>
            </div>
        
            <div class="layui-form-item">
              <label class="layui-form-label xbs768">过期时间<?php html_sign();?></label>
              <div class="layui-input-block">
                <input class="layui-input" id="LAY_demorange_e" lay-verify="required" name="expire_time" value="<?php echo (isset($list['expire_time']) && ($list['expire_time'] !== '')?$list['expire_time']:''); ?>">
              </div>
            </div>
<!-- 
            <div class="layui-form-item layui-form-text">
                <label for="description" class="layui-form-label">备注</label>
                <div class="layui-input-block" >
                    <textarea placeholder="请输入直播简介"  id="description" name="description" autocomplete="off"
                    class="layui-textarea" style="height: 80px;"><?php echo (isset($list['description']) && ($list['description'] !== '')?$list['description']:''); ?></textarea>
                </div>
            </div> -->

          <input type="hidden" name="fid" value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:''); ?>">

          <div class="layui-form-item">
            <label class="layui-form-label xbs768">购买状态</label>
            <div class="layui-input-block">
              <input type="radio" name="order_status" value="1" title="待审核" checked>
              <input type="radio" name="order_status" value="2" title="成功" <?php if(isset($list['order_status']) and $list['order_status'] == 2): ?> checked <?php endif; ?>>
              <input type="radio" name="order_status" value="3" title="失败" <?php if(isset($list['order_status']) and  $list['order_status'] == -1): ?> checked <?php endif; ?>>
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
<script>
  layui.use('laydate', function () {
  var laydate = layui.laydate;
  //执行一个laydate实例
  laydate.render({
    elem: '#LAY_demorange_s' //指定元素
    , type: 'datetime'
  });
  //执行一个laydate实例
  laydate.render({
    elem: '#LAY_demorange_e' //指定元素
    , type: 'datetime'
  });
});  
</script>        
</body>
</html>