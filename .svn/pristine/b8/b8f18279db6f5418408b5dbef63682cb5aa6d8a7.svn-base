<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:79:"/home/wwwroot/default/SIFIC/public/../application/admin/view/hospital/edit.html";i:1547781724;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1542434096;}*/ ?>
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
        <form class="layui-form"  action="/sys/hospital/update" method="post" enctype="multipart/form-data">
            <div class="layui-form-item">
              <label for="org_name" class="layui-form-label">名称<?php html_sign();?></label>
              <div class="layui-input-block">
                <input type="text" id="org_name" name="org_name" lay-verify="required" autocomplete="off"
                      value="<?php echo (isset($list['org_name']) && ($list['org_name'] !== '')?$list['org_name']:''); ?>" class="layui-input">
              </div>
            </div>
            <input type="hidden" name="type" value="1">
            <div class="layui-form-item">
              <label for="address" class="layui-form-label">地址</label>
              <div class="layui-input-block">
                <input type="text" id="address" name="address"  autocomplete="off"
                      value="<?php echo (isset($list['address']) && ($list['address'] !== '')?$list['address']:''); ?>" class="layui-input">
              </div>
            </div>

            <div class="layui-form-item">
              <label for="tel" class="layui-form-label">电话</label>
              <div class="layui-input-block">
                <input type="text" id="tel" name="tel"  autocomplete="off"
                      value="<?php echo (isset($list['tel']) && ($list['tel'] !== '')?$list['tel']:''); ?>" class="layui-input">
              </div>
            </div>

            <div class="layui-form-item">
              <label for="fax" class="layui-form-label">传真</label>
              <div class="layui-input-block">
                <input type="text" id="fax" name="fax"  autocomplete="off"
                      value="<?php echo (isset($list['fax']) && ($list['fax'] !== '')?$list['fax']:''); ?>" class="layui-input">
              </div>
            </div>


            <div class="layui-form-item">
              <label for="web_url" class="layui-form-label">官网<?php html_sign();?></label>
              <div class="layui-input-block">
                <input type="text" id="web_url" name="web_url" lay-verify="required" autocomplete="off"
                      value="<?php echo (isset($list['web_url']) && ($list['web_url'] !== '')?$list['web_url']:''); ?>" class="layui-input">
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">省份</label>
              <div class="layui-input-block">
                <select name="province_id" lay-verify="" lay-search="" lay-filter="province">
                  <option value="">直接选择或搜索选择</option>
                    <?php if(is_array($province_list) || $province_list instanceof \think\Collection || $province_list instanceof \think\Paginator): $i = 0; $__LIST__ = $province_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vo['fid']; ?>" <?php if(isset($vo['fid']) and $vo['fid'] == $list['province_id']): ?>selected="selected"<?php endif; ?>><?php echo $vo['region_name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>
          </div>

          <div class="layui-form-item">
              <label class="layui-form-label">城市</label>
              <div class="layui-input-block">
                <select name="city_id" lay-verify="" lay-search="" id="city" lay-filter="city">
                  <option value="">直接选择或搜索选择</option>
                    <?php if(is_array($city_list) || $city_list instanceof \think\Collection || $city_list instanceof \think\Paginator): $i = 0; $__LIST__ = $city_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vo['fid']; ?>" <?php if(isset($vo['fid']) and $vo['fid'] == $list['city_id']): ?>selected="selected"<?php endif; ?>><?php echo $vo['region_name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>
          </div>

          <div class="layui-form-item">
              <label class="layui-form-label">区/县</label>
              <div class="layui-input-block">
                <select name="country_id" lay-verify="" lay-search="" id="country">
                  <option value="">直接选择或搜索选择</option>
                    <?php if(is_array($country_list) || $country_list instanceof \think\Collection || $country_list instanceof \think\Paginator): $i = 0; $__LIST__ = $country_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vo['fid']; ?>" <?php if(isset($vo['fid']) and $vo['fid'] == $list['country_id']): ?>selected="selected"<?php endif; ?>><?php echo $vo['region_name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>
          </div>


            <div class="layui-form-item">
              <label class="layui-form-label">公司图片</label>
              <div class="layui-upload">
                <div style="float: left; width: 150px; text-align: center;">
                  <button type="button" class="layui-btn" id="img">上传图片</button>
                  <div class="layui-upload-list">
                    <img class="layui-upload-img" id="img1" width="150" src="<?php echo (isset($list['image_url']) && ($list['image_url'] !== '')?$list['image_url']:''); ?>">
                  </div>
                </div>
            </div>

              <label class="layui-form-label">营业执照</label>
              <div class="layui-upload">
                <div style="float: left; width: 150px; text-align: center;">
                  <button type="button" class="layui-btn" id="imgs">上传图片</button>
                  <div class="layui-upload-list">
                    <img class="layui-upload-img" id="img2" width="150" src="<?php echo (isset($list['image_urls']) && ($list['image_urls'] !== '')?$list['image_urls']:''); ?>">
                  </div>
                </div>
            </div>

            <input type="hidden" name="web_image_id" id="FImageUrl" value="<?php echo (isset($list['web_image_id']) && ($list['web_image_id'] !== '')?$list['web_image_id']:''); ?>">
            <input type="hidden" name="licence_id" id="FImageUrls" value="<?php echo (isset($list['licence_id']) && ($list['licence_id'] !== '')?$list['licence_id']:''); ?>">
            <input type="hidden" name="fid" value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:''); ?>">
            <div class="layui-form-item">
              <label for="description" class="layui-form-label">简介</label>
              <div class="layui-input-block">
                <textarea placeholder="请输入内容" class="layui-textarea" type="text" id="description" name="description"><?php echo (isset($list['description']) && ($list['description'] !== '')?$list['description']:''); ?></textarea>
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
              <label  class="layui-form-label"></label>
              <button class="layui-btn" lay-filter="add" lay-submit="">保存</button>
            </div>
        </form>
        <!-- 右侧内容框架，更改从这里结束 -->
    </div>
    <!-- 中部结束 -->

</body>

<script>
  layui.use(['upload','form'],function(){
    var upload = layui.upload;
    var web_image_id='<?php echo (isset($list['web_image_id']) && ($list['web_image_id'] !== '')?$list['web_image_id']:0); ?>';
    var licence_id='<?php echo (isset($list['licence_id']) && ($list['licence_id'] !== '')?$list['licence_id']:0); ?>';
    //普通图片上传
    upload.render({
      elem: '#img'
      ,url: '/upload'
      ,data: {web_image_id:web_image_id}
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
          $('#FImageUrl').attr('value', res.data);
          return layer.msg('上传成功');
        }else{
          return layer.msg('上传失败');
        }
      }
    });

    upload.render({
      elem: '#imgs'
      ,url: '/upload'
      ,data: {licence_id:licence_id}
      ,acceptMime: 'image/*'
      ,before: function(obj){
        obj.preview(function(index, file, result){
          $('#img2').attr('src', result);
        });
      }
      ,done: function(res){
        //如果上传失败
        console.log(res);
        if(res.code==200){
          $('#FImageUrls').attr('value', res.data);
          return layer.msg('上传成功');
        }else{
          return layer.msg('上传失败');
        }
      }
    });

    var form = layui.form;
    form.on('select(province)', function(data){
      $.getJSON("/sys/region?pid="+data.value, function(data){
          var optionstring = "";
          $.each(data.region, function(i,item){
              optionstring += "<option value=\"" + item.fid + "\" >" + item.region_name + "</option>";
          });
          $("#city").html('<option value=""></option>' + optionstring);
          $("#country").html('<option value=""></option>');
          form.render('select'); //这个很重要
      });
    });

    form.on('select(city)', function(data){
      $.getJSON("/sys/region?pid="+data.value, function(data){
          var optionstring = "";
          $.each(data.region, function(i,item){
              optionstring += "<option value=\"" + item.fid + "\" >" + item.region_name + "</option>";
          });
          $("#country").html('<option value=""></option>' + optionstring);
          form.render('select'); //这个很重要
      });
    });


  });
</script>
</html>