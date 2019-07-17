<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:81:"/home/wwwroot/default/SIFIC/public/../application/admin/view/meet/edit_honor.html";i:1538025445;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1548327812;}*/ ?>
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
  <form class="layui-form" action="<?php echo (isset($update) && ($update !== '')?$update:'/'); ?>"  method="post" enctype="multipart/form-data">
    
  <div class="layui-form-item">
      <label for="history_type" class="layui-form-label">分类</label>
      <div class="layui-input-block">
        <select name="history_type" id="history_type" lay-filter="history_type" lay-search="">
        <option value="">--选择或者搜索--</option>
          <?php if(is_array($history_type) || $history_type instanceof \think\Collection || $history_type instanceof \think\Paginator): $ko = 0; $__LIST__ = $history_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($ko % 2 );++$ko;?>
          <option value="<?php echo $ko; ?>" <?php if(isset($list['history_type']) and $ko == $list['history_type']): ?> selected="selected" <?php endif; ?> ><?php echo $vo; ?></option>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
      </div>
    </div>

    
    <div class="layui-form-item">
      <label for="title" class="layui-form-label">标题</label>
      <div class="layui-input-block">
        <input type="text" id="title" name="title"  autocomplete="off"  value="<?php echo (isset($list['title']) && ($list['title'] !== '')?$list['title']:''); ?>" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item">
      <label for="convention_name" class="layui-form-label">会议名称</label>
      <div class="layui-input-block">
        <input class="layui-input" disabled='disabled'  name="convention_name" value="<?php echo (isset($honor['convention_name']) && ($honor['convention_name'] !== '')?$honor['convention_name']:''); ?>">
      </div>
    </div>

    <div class="layui-form-item">
      <label for="description" class="layui-form-label">时间-地址</label>
      <div class="layui-input-block">
        <textarea placeholder="请输入内容" class="layui-textarea" type="text" disabled='disabled' id="description" name="description"><?php echo (isset($honor['description']) && ($honor['description'] !== '')?$honor['description']:$list['description']); ?></textarea>
      </div>
    </div>
    <div class="layui-form-item">
    <label class="layui-form-label">图片上传</label>
    <div class="layui-upload">
      <button type="button" class="layui-btn layui-btn-normal" id="testList">选择多文件</button>
      <button type="button" class="layui-btn" style="margin-left:150px;" id="testListAction">开始上传</button>
      <div class="layui-upload-list">
        <table class="layui-table">
          <thead>
            <tr>
              <th>文件名</th>
              <th>预览</th>
              <th>大小</th>
              <th>状态</th>
              <th>操作</th>
          </tr>
        </thead>
        <tbody id="demoList">
          <?php if(isset($list['image_ids']) and $arr_image): if(is_array($arr_image) || $arr_image instanceof \think\Collection || $arr_image instanceof \think\Paginator): $i = 0; $__LIST__ = $arr_image;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                  <tr>
                      <td><?php echo (isset($v['file_name']) && ($v['file_name'] !== '')?$v['file_name']:$v['file_path']); ?></td>
                      <td><img src='<?php echo (isset($v['file_path']) && ($v['file_path'] !== '')?$v['file_path']:""); ?>'></td>
                      <td><?php echo (isset($v['file_size']) && ($v['file_size'] !== '')?$v['file_size']:0); ?>kb</td>
                      <td><span style="color: #5FB878;">上传成功</span></td>
                      <td>
                        <a class="layui-btn layui-btn-xs layui-btn-danger demo-delete" onclick="image_del('<?php echo $v['fid']; ?>','/sys/source/delete','<?php echo (isset($edit) && ($edit !== '')?$edit:'/'); ?>','<?php echo (isset($list['convention_id']) && ($list['convention_id'] !== '')?$list['convention_id']:$convention_id); ?>')">删除</a>
                      </td>
                  </tr>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </tbody>
        </table>
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
    <input type="hidden" name="fid" value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:''); ?>">
    <input type="hidden" name="convention_id" value="<?php echo (isset($list['convention_id']) && ($list['convention_id'] !== '')?$list['convention_id']:$convention_id); ?>">
    <input type="hidden" name="image_ids"  id="image_ids" value="<?php echo (isset($list['image_ids']) && ($list['image_ids'] !== '')?$list['image_ids']:''); ?>">
    <span id='msj'></span>

    <div class="layui-form-item">
      <label class="layui-form-label"></label>
      <button class="layui-btn" lay-filter="save" lay-submit="" type="submit">保存</button>
    </div>
  </form>
</div>

<script>
  layui.use('upload',function(){
     var $ = layui.jquery
    ,upload = layui.upload;  
    //多文件列表示例
  var demoListView = $('#demoList')
  ,uploadListIns = upload.render({
    elem: '#testList'
    ,url: '/upload'
    ,accept: 'file'
    ,multiple: true
    ,data: {web_image_id:0}
    ,exts: 'jpg|png|gif|jpeg'
    ,size: 1024
    ,acceptMime: 'image/*'
    ,auto: false
    ,bindAction: '#testListAction'
    ,choose: function(obj){   
      var files = this.files = obj.pushFile(); //将每次选择的文件追加到文件队列
      //读取本地文件
      obj.preview(function(index, file, result){
        var tr = $(['<tr id="upload-'+ index +'">'
          ,'<td>'+ file.name +'</td>'
          ,'<td><img src='+ result +'></td>'
          ,'<td>'+ (file.size/1014).toFixed(1) +'kb</td>'
          ,'<td>等待上传</td>'
          ,'<td>'
            ,'<button class="layui-btn layui-btn-xs demo-reload layui-hide">重传</button>'
            ,'<button class="layui-btn layui-btn-xs layui-btn-danger demo-delete">删除</button>'
          ,'</td>'
        ,'</tr>'].join(''));
        
        //单个重传
        tr.find('.demo-reload').on('click', function(){
          obj.upload(index, file);
        });
        
        //删除
        tr.find('.demo-delete').on('click', function(){
          delete files[index]; //删除对应的文件
          tr.remove();
          uploadListIns.config.elem.next()[0].value = ''; //清空 input file 值，以免删除后出现同名文件不可选
        });
        
        demoListView.append(tr);
      });
    }
    ,done: function(res, index, upload){
      if(res.code == 200){ //上传成功
        var image_ids=$("#image_ids").val();
        if(image_ids){
            var html=','+res.data;
        }else{
            var html=res.data;
        }
        $("#image_ids").val(image_ids +html);
        var tr = demoListView.find('tr#upload-'+ index)
        ,tds = tr.children();
        tds.eq(3).html('<span style="color: #5FB878;">上传成功</span>');
        tds.eq(4).html('<button class="layui-btn layui-btn-xs layui-btn-danger demo-delete">删除</button>'); //清空操作
        return delete this.files[index]; //删除文件队列已经上传成功的文件
      }
      this.error(index, upload);
    }
    ,error: function(index, upload){
      var tr = demoListView.find('tr#upload-'+ index)
      ,tds = tr.children();
      tds.eq(3).html('<span style="color: #FF5722;">上传失败</span>');
      tds.eq(4).find('.demo-reload').removeClass('layui-hide'); //显示重传
    }
  });
});
</script>

<script>
    //发异步删除数据
    function image_del(fid,url,urls,pid){
    var id='<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:""); ?>';
    $.ajax({
      type: "post",
      url: url,
      data: {fid:fid,type:-1,image_ids:id},
      dataType: "json",
      success: function (data) {
        if (data.code == 1) {
          layer.msg(data.msg, {icon: 1, time: 500});
        } else {
          layer.msg(data.msg, {icon: 1, time: 500});
        }
        setTimeout(function () {
           window.location.href = urls + "?fid="+id+"&convention_id="+pid;
        }, 500);
      }
    });
  }
</script>

</body>
</html>