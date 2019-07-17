<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:81:"/home/wwwroot/default/SIFIC/public/../application/admin/view/meet/edit_paper.html";i:1548061993;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1548327812;}*/ ?>
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
  <form class="layui-form" action="<?php echo (isset($update) && ($update !== '')?$update:'/'); ?>" method="post" enctype="multipart/form-data">

    <div class="layui-form-item">
      <label for="title" class="layui-form-label">标题<?php html_sign();?></label>
      <div class="layui-input-block">
        <input class="layui-input" id="title" name="title"  lay-verify="required" value="<?php echo (isset($list['title']) && ($list['title'] !== '')?$list['title']:''); ?>">
      </div>
    </div>
	
    <div class="layui-form-item">
      <label for="keyword" class="layui-form-label">关键字<?php html_sign();?></label>
      <div class="layui-input-block">
        <input class="layui-input" id="keyword" name="keyword"  lay-verify="required" value="<?php echo (isset($list['keyword']) && ($list['keyword'] !== '')?$list['keyword']:''); ?>">
      </div>
    </div>
	
	<div class="layui-form-item layui-form-text">
      <label for="objective" class="layui-form-label">目的<?php html_sign();?></label>
      <div class="layui-input-block">
        <textarea placeholder="请输入目的" required id="objective" name="objective" autocomplete="off" class="layui-textarea"
          style="height: 80px;"><?php echo (isset($list['objective']) && ($list['objective'] !== '')?$list['objective']:''); ?></textarea>
      </div>
    </div>
	
	<div class="layui-form-item layui-form-text">
      <label for="method" class="layui-form-label">方法<?php html_sign();?></label>
      <div class="layui-input-block">
        <textarea placeholder="请输入方法" required id="method" name="method" autocomplete="off" class="layui-textarea"
          style="height: 80px;"><?php echo (isset($list['method']) && ($list['method'] !== '')?$list['method']:''); ?></textarea>
      </div>
    </div>
	
	<div class="layui-form-item layui-form-text">
      <label for="result" class="layui-form-label">结果<?php html_sign();?></label>
      <div class="layui-input-block">
        <textarea placeholder="请输入结果" required id="result" name="result" autocomplete="off" class="layui-textarea"
          style="height: 80px;"><?php echo (isset($list['result']) && ($list['result'] !== '')?$list['result']:''); ?></textarea>
      </div>
    </div>
	
	<div class="layui-form-item layui-form-text">
      <label for="conclusion" class="layui-form-label">结论<?php html_sign();?></label>
      <div class="layui-input-block">
        <textarea placeholder="请输入结论" required id="conclusion" name="conclusion" autocomplete="off" class="layui-textarea"
          style="height:50px;"><?php echo (isset($list['conclusion']) && ($list['conclusion'] !== '')?$list['conclusion']:''); ?></textarea>
      </div>
    </div>

    <div class="layui-form-item">
      <label for="special" class="layui-form-label">所属专题<?php html_sign();?></label>
      <div class="layui-input-block">
        <select name="special" lay-verify="required" lay-search="">
          <option value="">所属专题</option>
          <?php if(is_array($special) || $special instanceof \think\Collection || $special instanceof \think\Paginator): $i = 0; $__LIST__ = $special;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <option value="<?php echo $vo['fid']; ?>" <?php if(isset($list['special']) and $vo['fid'] == $list['special']): ?> selected="selected" <?php endif; ?> ><?php echo $vo['class_name_zh']; ?></option>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
      </div>
    </div>
	
    <div class="layui-form-item">
      <label class="layui-form-label xbs768">发表形式<?php html_sign();?></label>
      <div class="layui-input-block">
        <input type="radio" name="shape" value="1" title="口头和壁报" checked>
        <input type="radio" name="shape" value="2" title="壁报" <?php if(isset($list['shape']) and $list['shape'] == 2): ?> checked <?php endif; ?>>
      </div>
    </div>  
		
    <div class="layui-form-item">
      <label class="layui-form-label xbs768">参加评选</label>
      <div class="layui-input-block" id="IsPurchased">
        <input type="radio"  lay-filter="publics" name="yes_no" value="1" title="否"  checked>
        <input type="radio"  lay-filter="publics"  name="yes_no" value="2" title="是" <?php if(isset($list['yes_no']) and $list['yes_no'] == 2): ?> checked <?php endif; ?>>
      </div>
    </div>  
	
	<div class="layui-form-item">
      <label class="layui-form-label xbs768">摘要审核</label>
      <div class="layui-input-block" id="checked">
        <input type="radio" name="abstract_status" value="1" title="待审核" checked>
        <input type="radio" name="abstract_status" value="2" title="接受" <?php if(isset($list['abstract_status']) and $list['abstract_status'] == 2): ?> checked <?php endif; ?>>
        <input type="radio" name="abstract_status" value="3" title="拒绝" <?php if(isset($list['abstract_status']) and  $list['abstract_status'] == 3): ?> checked <?php endif; ?>>
      </div>
    </div>
	
	<div class="layui-form-item">
      <label class="layui-form-label xbs768" style="width:120px;">发送摘要录用通知:</label>
      <div class="layui-input-block">
		<a class="layui-btn" href="javascript:;" onclick="send(<?php echo $list['fid']; ?>,<?php echo $list['creator_id']; ?>,<?php echo $list['convention_id']; ?>)">
			<?php if(isset($list['abstract_send']) and $list['abstract_send'] == 2): ?> 重新发送 <?php else: ?> 发送<?php endif; ?>
		</a>
      </div>
    </div>	
	
	
    <input type="hidden" name="fid" value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:''); ?>">
    <input type="hidden" name="convention_id" value="<?php echo (isset($list['convention_id']) && ($list['convention_id'] !== '')?$list['convention_id']:$convention_id); ?>">
    <input type="hidden" id="fileid" name="fileid" value="<?php echo (isset($list['fileid']) && ($list['fileid'] !== '')?$list['fileid']:0); ?>">	
    <input type="hidden" id="uid" name="uid" value="<?php echo (isset($list['creator_id']) && ($list['creator_id'] !== '')?$list['creator_id']:0); ?>">	

	<hr>
	<div class="layui-form-item" id="paper">
	  <label class="layui-form-label">全文上传<?php html_sign();?></label>
	  <div class="layui-upload">
		  <button type="button" class="layui-btn" id="img">
			  <?php if(isset($list['file_path']) and $list['fid']): ?> 重新上传<?php else: ?>点击上传 <?php endif; ?>
		  </button>
		  <span class="layui-upload-list">
			<table class="layui-table">
			  <thead>
				<tr>
				  <th>文件名</th>
				  <th>大小</th>
				</tr>
			  </thead>
			  <tbody id="demoList">
				<tr>
					<td><?php echo (isset($list['file_name']) && ($list['file_name'] !== '')?$list['file_name']:''); ?></td>
					<td><?php echo (isset($list['file_size']) && ($list['file_size'] !== '')?$list['file_size']:0); ?>kb</td>
				</tr>
			  </tbody>
			</table>
		  </span>
	  </div>
	</div>

<!-- 	<div class="layui-form-item" id="paper2">
	  <label class="layui-form-label xbs768">全文审核</label>
	  <div class="layui-input-block">
		<input type="radio" name="paper_status" value="1" title="待审核" checked>
		<input type="radio" name="paper_status" value="2" title="通过" <?php if(isset($list['paper_status']) and $list['paper_status'] == 2): ?> checked <?php endif; ?>>
		<input type="radio" name="paper_status" value="3" title="不通过" <?php if(isset($list['paper_status']) and  $list['paper_status'] == 3): ?> checked <?php endif; ?>>
	  </div>
	</div>  -->

    <div class="layui-form-item">
      <label class="layui-form-label xbs768">状态</label>
      <div class="layui-input-block">
        <input type="radio" name="record_status" value="1" title="启用" checked>
        <input type="radio" name="record_status" value="2" title="禁用" <?php if(isset($list['record_status']) and $list['record_status'] == 2): ?> checked <?php endif; ?>>
        <input type="radio" name="record_status" value="-1" title="标记删除" <?php if(isset($list['record_status']) and  $list['record_status'] == -1): ?> checked <?php endif; ?>>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label"></label>
      <button class="layui-btn" lay-filter="save" lay-submit="" type="submit">保存</button>
    </div>
  </form>
</div>

<script>
	$(document).ready(function(){
		var yes_no=<?php echo (isset($list['yes_no']) && ($list['yes_no'] !== '')?$list['yes_no']:1); ?>;
		if (yes_no== "2") {
			$("#paper,#paper2").show();
		}else {
			$("#paper,#paper2").hide();
		}
	});
	
	function send(fid,uid,convention_id){
		var url="/meet/paper";
		var urls="/meet/edit_paper?fid="+fid;
		var status=$('#checked input[name="abstract_status"]:checked ').val();
		$.ajax({
		  type: "post",
		  url: url,
		  data: {_send:1,urls:urls,uid:uid,convention_id:convention_id,status:status},
		  dataType: "json",
		  success: function (data) {
			if (data) {
			  layer.msg("发送成功", {icon: 1, time: 500});
			} else {
			  layer.msg("发送失败", {icon: 1, time: 500});
			}
			setTimeout(function () {
			  window.location.href = urls;
			}, 500);
		  }
		});
	}
	
	layui.use(["upload","form"],function(){
		var $ = layui.jquery
		,upload = layui.upload
		,form = layui.form;
		//是否 参加评选
		form.on('radio(publics)', function (data) {        
			if ($('#IsPurchased input[name="yes_no"]:checked ').val() == "2") {
				$("#paper,#paper2").show();
			}else {
				$("#paper,#paper2").hide();
			}
			form.render();
		});
		var fid='<?php echo (isset($list['fileid']) && ($list['fileid'] !== '')?$list['fileid']:0); ?>';
		//上传
		var uploadInst = upload.render({
		  elem: '#img'
		  ,url: '/upload'
		  ,data: {fid:fid,source_type:4}
		  ,accept: 'file'
		  ,exts: 'pdf'
		  ,multiple: true
		  ,before: function(obj){
		  var files = this.files = obj.pushFile(); //将每次选择的文件追加到文件队列
		  //读取本地文件
		  obj.preview(function(index, file, result){
			  var tr = $(['<tr id="upload-'+ index +'">'
				,'<td>'+ file.name +'</td>'
				,'<td>'+ (file.size/1014).toFixed(1) +'kb</td>'
			  ,'</tr>'].join(''));
			  $("#demoList").html(tr);
			});
		  }
		  ,done: function(res){
			//如果上传成功
			if(res.code==200){
			  $('#fileid').attr('value', res.data);
			  return layer.msg('上传成功');
			}else{
			  return layer.msg('上传失败');
			}
		  }
		});
	});
</script>
</body>
</html>