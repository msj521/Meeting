<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"/home/wwwroot/default/SIFIC/public/../application/admin/view/meet/edit.html";i:1547783022;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1548327812;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/upload.html";i:1547778295;}*/ ?>
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
  <form class="layui-form" action='<?php echo (isset($update) && ($update !== '')?$update:"/"); ?>' method="post" enctype="multipart/form-data">


    <div class="layui-form-item">
      <label for="FClassName" class="layui-form-label">会议类型<?php html_sign();?></label>
      <div class="layui-input-block">
        <select name="class_id" lay-verify="required" lay-search="">
          <option value="">--选择或者搜索--</option>
          <?php if(is_array($meet) || $meet instanceof \think\Collection || $meet instanceof \think\Paginator): $i = 0; $__LIST__ = $meet;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <option value="<?php echo $vo['fid']; ?>" <?php if(isset($list['class_id']) and $vo['fid'] == $list['class_id']): ?> selected="selected" <?php endif; ?> ><?php echo $vo['class_name_zh']; ?></option>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
      </div>
    </div>

    <div class="layui-form-item">
      <label for="convention_name" class="layui-form-label">会议名称<?php html_sign();?></label>
      <div class="layui-input-block">
        <input class="layui-input" id="convention_name" name="convention_name" lay-verify="required" value="<?php echo (isset($list['convention_name']) && ($list['convention_name'] !== '')?$list['convention_name']:''); ?>">
      </div>
    </div>


    <div class="layui-form-item">
      <label for="address" class="layui-form-label">会议地址<?php html_sign();?></label>
      <div class="layui-input-block">
        <input type="text" id="address" name="address" lay-verify="required"  autocomplete="off"
               value="<?php echo (isset($list['address']) && ($list['address'] !== '')?$list['address']:''); ?>" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item">
      <label for="organizer" class="layui-form-label">举办方</label>
      <div class="layui-input-block">
        <input type="text" id="organizer" name="organizer"  autocomplete="off"
               value="<?php echo (isset($list['organizer']) && ($list['organizer'] !== '')?$list['organizer']:''); ?>" class="layui-input">
      </div>
    </div>
    <div class="layui-form-item">
      <label for="sign_fee" class="layui-form-label">注册费用</label>
      <div class="layui-input-block">
        <input type="text" id="sign_fee" name="sign_fee"  autocomplete="off"
               value="<?php echo (isset($list['sign_fee']) && ($list['sign_fee'] !== '')?$list['sign_fee']:''); ?>" class="layui-input">
      </div>
    </div>
    <div class="layui-form-item">
      <label for="sign_url" class="layui-form-label">注册地址</label>
      <div class="layui-input-block">
        <input type="text" id="sign_url" name="sign_url"  autocomplete="off"
               value="<?php echo (isset($list['sign_url']) && ($list['sign_url'] !== '')?$list['sign_url']:''); ?>" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item">
      <label for="invoice_collection" class="layui-form-label">发票领取</label>
      <div class="layui-input-block">
        <input type="text" id="invoice_collection" name="invoice_collection"  autocomplete="off"
               value="<?php echo (isset($list['invoice_collection']) && ($list['invoice_collection'] !== '')?$list['invoice_collection']:''); ?>" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item">
      <label for="credit_certificate" class="layui-form-label">学分证</label>
      <div class="layui-input-block">
        <input type="text" id="credit_certificate" name="credit_certificate"  autocomplete="off"
               value="<?php echo (isset($list['credit_certificate']) && ($list['credit_certificate'] !== '')?$list['credit_certificate']:''); ?>" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item">
      <label for="dot_card" class="layui-form-label">积点卡</label>
      <div class="layui-input-block">
        <input type="text" id="dot_card" name="dot_card"  autocomplete="off"
               value="<?php echo (isset($list['dot_card']) && ($list['dot_card'] !== '')?$list['dot_card']:''); ?>" class="layui-input">
      </div>
    </div>


    <div class="layui-form-item">
      <label class="layui-form-label xbs768">开始时间<?php html_sign();?></label>
      <div class="layui-input-block">
        <input class="layui-input" id="LAY_demorange_s"  lay-verify="required" name="start_time" value="<?php echo (isset($list['start_time']) && ($list['start_time'] !== '')?$list['start_time']:''); ?>">
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label xbs768">结束时间<?php html_sign();?></label>
      <div class="layui-input-block">
        <input class="layui-input" id="LAY_demorange_e" lay-verify="required" name="end_time" value="<?php echo (isset($list['end_time']) && ($list['end_time'] !== '')?$list['end_time']:''); ?>">
      </div>
    </div> 

    <div class="layui-form-item layui-form-text">
      <label for="digest" class="layui-form-label">会议简介</label>
      <div class="layui-input-block">
        <textarea placeholder="请输入简介" required id="digest" name="digest" autocomplete="off" class="layui-textarea"
          style="height: 80px;"><?php echo (isset($list['digest']) && ($list['digest'] !== '')?$list['digest']:''); ?></textarea>
      </div>
    </div>


    <div class="layui-form-item">
      <label class="layui-form-label xbs768">置顶</label>
        <div class="layui-input-block">
          <select name="sort" lay-verify="" >
            <option value="0">普通</option>
            <option value="1" <?php if(isset($list['sort']) and $list['sort'] == 1): ?> selected="selected" <?php endif; ?> >一级置顶</option>
            <option value="2" <?php if(isset($list['sort']) and $list['sort'] == 2): ?> selected="selected" <?php endif; ?> >二级置顶</option>
            <option value="3" <?php if(isset($list['sort']) and $list['sort'] == 3): ?> selected="selected" <?php endif; ?> >三级置顶</option>
          </select>     
        </div>
    </div>

    <input type="hidden" name="fid" value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:''); ?>">
        <div class="layui-form-item">
      <label class="layui-form-label">图片上传<?php html_sign();?></label>
        <div class="layui-upload">
          <div style="float: left; width: 150px; text-align: center;">
             <button type="button" class="layui-btn" id="img">web图片</button>
            <div class="layui-upload-list">
              <img class="layui-upload-img" id="img1" width="150" src="<?php echo (isset($list['image_url']) && ($list['image_url'] !== '')?$list['image_url']:$list['web_image_url']); ?>">
            </div>
          </div>
          
           <div style="float: left;width: 150px; text-align: center; margin-left:20px ">
              <button type="button" class="layui-btn" id="imgs">App图片</button>
            <div class="layui-upload-list">
              <img class="layui-upload-img" id="img2" width="150" src="<?php echo (isset($list['image_urls']) && ($list['image_urls'] !== '')?$list['image_urls']:$list['app_image_url']); ?>">
            </div>
           </div>
           <?php if(isset($edit) and $edit == '/meet/edit'): ?>
           <div style="float: left;width: 150px; text-align: center; margin-left:20px ">
              <button type="button" class="layui-btn" id="top_imgs">会议头部图片</button>
            <div class="layui-upload-list">
              <img class="layui-upload-img" id="img3" width="150" src="<?php echo (isset($list['top_image_url']) && ($list['top_image_url'] !== '')?$list['top_image_url']:$list['top_image_url']); ?>">
            </div>
           </div>
          <input type="hidden" name="top_image_id" id="top_FImageUrls" value="<?php echo (isset($list['top_image_id']) && ($list['top_image_id'] !== '')?$list['top_image_id']:1); ?>">
          <?php endif; ?>
        </div>
    </div>
    <input type="hidden"  name="web_image_id"  id="FImageUrl" value="<?php echo (isset($list['web_image_id']) && ($list['web_image_id'] !== '')?$list['web_image_id']:$list['web_id']); ?>">
    <input type="hidden" name="app_image_id"  id="FImageUrls" value="<?php echo (isset($list['app_image_id']) && ($list['app_image_id'] !== '')?$list['app_image_id']:$list['app_id']); ?>">
    
    <script>
      layui.use('upload',function(){
          var $ = layui.jquery
          ,upload = layui.upload;
          var web_image_id='<?php echo (isset($list['web_image_id']) && ($list['web_image_id'] !== '')?$list['web_image_id']:$list['web_id']); ?>';
          var app_image_id='<?php echo (isset($list['app_image_id']) && ($list['app_image_id'] !== '')?$list['app_image_id']:$list['app_id']); ?>';
          var top_image_id='<?php echo (isset($list['top_image_id']) && ($list['top_image_id'] !== '')?$list['top_image_id']:0); ?>';
          var source_id='<?php echo (isset($list['source_id']) && ($list['source_id'] !== '')?$list['source_id']:""); ?>';
            //WEB图片上传
          var uploadInst = upload.render({
            elem: '#img'
            ,url: '/upload'
            ,data: {web_image_id:web_image_id,source_type:1}
            ,acceptMime: 'image/*'
            ,exts: 'jpg|jpeg|gif|bmp|png'
            ,before: function(obj){
              obj.preview(function(index, file, result){
                $('#img1').attr('src', result);
              });
            }
            ,done: function(res){
              //如果上传失败
              if(res.code == 200){
                $('#FImageUrl').attr('value', res.data);
                return layer.msg('上传成功');
              }else{
                return layer.msg('上传失败');
              }
            }
          });

          //APP图片上传
          var uploadInst2 = upload.render({
            elem: '#imgs'
            ,url: '/upload'
            ,data: {app_image_id:app_image_id,source_type:1}
            ,acceptMime: 'image/*'
            ,before: function(obj){
              obj.preview(function(index, file, result){
                $('#img2').attr('src', result);
              });
            }
            ,done: function(res){
              if(res.code == 200){
                $('#FImageUrls').attr('value', res.data);
                return layer.msg('上传成功');
              }else{
                return layer.msg('上传失败');
              }
            }
          });

          //会议头部图片
          var uploadInst4 = upload.render({
            elem: '#top_imgs'
            ,url: '/upload'
            ,data: { top_image_id: top_image_id,source_type:1}
            ,acceptMime: 'image/*'
            ,before: function(obj){
              obj.preview(function(index, file, result){
                $('#img3').attr('src', result);
              });
            }
            ,done: function(res){
              if(res.code == 200){
                $('#top_FImageUrls').attr('value', res.data);
                return layer.msg('上传成功');
              }else{
                return layer.msg('上传失败');
              }
            }
          });

        //视屏文件上传
        var uploadInst3 = upload.render({
          elem: '#video'
          ,url: '/upload'
          ,data: {source_id:source_id,source_type:2}
          ,exts: 'mp4'
          ,acceptMime: '*'
          ,before: function(obj){
            obj.preview(function(index, file, result){
              $('#videos').attr('src', result);
            });
          }
          ,done: function(res){
            if(res.code == 200){
              $('#source_id').attr('value', res.data);
              return layer.msg('上传成功');
            }else{
              return layer.msg('上传失败');
            }
          }
        });
    });    
    </script>

    <div class="layui-form-item">
      <label class="layui-form-label xbs768">状态</label>
      <div class="layui-input-block">
        <input type="radio" name="record_status" value="1" title="启用" checked>
        <input type="radio" name="record_status" value="2" title="禁用" <?php if(isset($list['record_status']) and $list['record_status'] == 2): ?> checked <?php endif; ?>>
        <input type="radio" name="record_status" value="-1" title="标记删除" <?php if(isset($list['record_status']) and  $list['record_status'] == -1): ?> checked <?php endif; ?>>
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label xbs768">下载证书</label>
      <div class="layui-input-block">
        <input type="radio" name="certificate" value="0" title="否" checked >
        <input type="radio" name="certificate" value="1" title="是" <?php if(isset($list['certificate']) and  $list['certificate'] == 1): ?> checked <?php endif; ?>>
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label"></label>
      <button class="layui-btn" lay-filter="save" lay-submit="" type="submit">保存</button>
    </div>
  </form>
</div>
<script>
  var list = <?php echo !empty($list)?json_encode($list):1; ?>;
    // console.log(FContent);
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
  // var ue = UE.getEditor('editor');
  // ue.addListener("ready", function () {
  //   // editor准备好之后才可以使用
  //   if (list != 1) {
  //     ue.setContent(HTMLDecode(list.digest));
  //   }
  // });
</script>
</body>
</html>