<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:81:"/home/wwwroot/default/SIFIC/public/../application/admin/view/live/video_edit.html";i:1547779065;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1548327812;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/upload.html";i:1547778295;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/expert.html";i:1538112383;}*/ ?>
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
<script src="//imgcache.qq.com/open/qcloud/js/vod/sdk/ugcUploader.js"></script>
<style type="text/css">
	.text-danger{
		color: red;
	}
	.control-label{
		text-align: left !important;
	}
	#resultBox {
		width: 100%;
		height: 80px;
		border: 1px solid #888;
		padding: 5px;
		overflow: auto;
		margin-bottom: 20px;
	}
	.uploaderMsgBox {
		width: 100%;
		border-bottom: 1px solid #888;
	}
	[act=cancel-upload]{
		text-decoration: none;
		cursor:pointer;
	}
</style>
<body>
        <!-- 右侧主体结束 -->
    <div class="x-body layui-anim layui-anim-up">
        <!-- 右侧内容框架，更改从这里开始 -->
        <form class="layui-form" action="<?php echo (isset($update) && ($update !== '')?$update:'/'); ?>" method="post" enctype="multipart/form-data">
            <div class="layui-form-item">
              <label class="layui-form-label">标题<?php html_sign();?></label>
              <div class="layui-input-block">
                <input type="text"  name="video_title" lay-verify="required" autocomplete="off" placeholder="请输入标题" class="layui-input" value="<?php echo (isset($list['title']) && ($list['title'] !== '')?$list['title']:''); ?>">
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">时长</label>
              <div class="layui-input-block">
                <input type="text"  name="duration"  autocomplete="off" placeholder="请输入标题" class="layui-input" value="<?php echo (isset($list['duration']) && ($list['duration'] !== '')?$list['duration']:''); ?>">
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">分辨率</label>
              <div class="layui-input-block">
                <input type="text"  name="resolution" autocomplete="off" placeholder="请输入" class="layui-input" value="<?php echo (isset($list['resolution']) && ($list['resolution'] !== '')?$list['resolution']:''); ?>">
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">码率</label>
              <div class="layui-input-block">
                <input type="text"  name="bitcode"  autocomplete="off" placeholder="请输入" class="layui-input" value="<?php echo (isset($list['bitcode']) && ($list['bitcode'] !== '')?$list['bitcode']:''); ?>">
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">限量</label>
              <div class="layui-input-block">
                <input type="text"  name="max_num"  autocomplete="off" placeholder="请输入" class="layui-input" value="<?php echo (isset($list['max_num']) && ($list['max_num'] !== '')?$list['max_num']:''); ?>">
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">限时</label>
              <div class="layui-input-block">
                <input type="text"  name="max_time"  autocomplete="off" placeholder="请输入" class="layui-input" value="<?php echo (isset($list['max_time']) && ($list['max_time'] !== '')?$list['max_time']:''); ?>">
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">播放量</label>
              <div class="layui-input-block">
                <input type="play_count" name="play_count" placeholder="请输入播放量" class="layui-input" value="<?php echo (isset($list['play_count']) && ($list['play_count'] !== '')?$list['play_count']:0); ?>">
              </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label for="description" class="layui-form-label">简介</label>
                <div class="layui-input-block" >
                    <textarea placeholder="请输入直播简介" required id="description" name="description" autocomplete="off"
                    class="layui-textarea" style="height: 80px;"><?php echo (isset($list['description']) && ($list['description'] !== '')?$list['description']:''); ?></textarea>
                </div>
            </div>


            <div class="layui-form-item">
              <label for="class_id" class="layui-form-label">录播类型<?php html_sign();?></label>
              <div class="layui-input-block">
                <select name="class_id" lay-verify="required" lay-search="">
                  <option value="">--选择或者搜索--</option>
                  <?php if(is_array($class) || $class instanceof \think\Collection || $class instanceof \think\Paginator): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                  <option value="<?php echo $vo['fid']; ?>" <?php if(isset($list['class_id']) and $vo['fid'] == $list['class_id']): ?> selected="selected" <?php endif; ?> ><?php echo $vo['class_name_zh']; ?></option>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>
            </div>
            
            <div class="layui-form-item">
                <label class="layui-form-label xbs768">置顶</label>
                  <div class="layui-input-block">
                    <select name="sort" lay-verify="required" >
                      <option value="0">普通</option>
                      <option value="1" <?php if(isset($list['sort']) and $list['sort'] == 1): ?> selected="selected" <?php endif; ?> >一级置顶</option>
                      <option value="2" <?php if(isset($list['sort']) and $list['sort'] == 2): ?> selected="selected" <?php endif; ?> >二级置顶</option>
                      <option value="3" <?php if(isset($list['sort']) and $list['sort'] == 3): ?> selected="selected" <?php endif; ?> >三级置顶</option>
                    </select>     
                  </div>
            </div>

            <div class="layui-form-item">
                <label for="L_sign" class="layui-form-label">专家<?php html_sign();?></label>
               <a class="layui-btn" onclick="expert_add()"><i class="layui-icon">&#xe608;</i>添加专家</a>
            </div>

            <div class="layui-form-item" style="margin-left: 110px;">
                <table id="expert_table" lay-filter="expert_table"></table>
                <input type="hidden"  name="expert_ids" lay-verify="required">
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label xbs768">是否推荐</label>
              <div class="layui-input-block">
                <input type="radio" name="recommend" value="0" title="普通" <?php if(isset($list['recommend']) and $list['recommend'] == 1): else: ?> checked <?php endif; ?>>
                <input type="radio" name="recommend" value="1" title="推荐" <?php if(isset($list['recommend']) and $list['recommend'] == 1): ?> checked <?php endif; ?>>
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label xbs768">VIP才能观看</label>
              <div class="layui-input-block">
                <input type="radio" name="vip" value="1" title="是" <?php if(isset($list['vip']) and $list['vip'] == 1): ?> checked <?php endif; ?>>
                <input type="radio" name="vip" value="0" title="否" <?php if(isset($list['vip']) and $list['vip'] == 1): else: ?> checked <?php endif; ?>>
              </div>
            </div>
			
			<div id="form2">
				<input id="addVideo-file" type="file" style="display:none;">
				<input id="addCover-file" type="file" style="display:none;">
			</div>
			注意：<span style="color:red;">1.上传过程中请勿关闭或刷新页面 &nbsp; 2.上传步骤 1-2-3</span>
			<div class="row" style="padding:10px;">
				<a id="addVideo" href="javascript:void(0);" class="layui-btn">1.添加视频</a>
				<a id="addCover" href="javascript:void(0);" class="layui-btn">2.添加封面</a>
				<a id="uploadFile" href="javascript:void(0);" class="layui-btn">3.上传</a>
			</div>
			<div class="row" id="resultBox"></div>
			
          <input type="hidden" name="fid" value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:''); ?>">
		  
			<div class="layui-form-item" <?php if(!isset($list['view_play_url'])): ?> style="display:none;" <?php endif; ?>>
				<label class="layui-form-label">视频预览</label>
				<div class="layui-upload">
					<div style="float: left; width: 150px; text-align: center;">
						<div class="layui-upload-list">
						  <video controls="controls"  width="300">
							<source src="<?php echo (isset($list['view_play_url']) && ($list['view_play_url'] !== '')?$list['view_play_url']:''); ?>"  id="videos" type="video/mp4" />
						  </video>
						</div>
					</div>
				</div>
			</div>
		  
          <input type="hidden" name="source_id"  id="source_id" value="<?php echo (isset($list['source_id']) && ($list['source_id'] !== '')?$list['source_id']:0); ?>"> 
          <input type="hidden" name="view_play_url"  id="play_url" value="<?php echo (isset($list['view_play_url']) && ($list['view_play_url'] !== '')?$list['view_play_url']:''); ?>"> 
          <input type="hidden" name="fileid" id="fileid" value="<?php echo (isset($list['fileid']) && ($list['fileid'] !== '')?$list['fileid']:0); ?>">
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
              <input type="radio" name="record_status" value="1" title="启用"checked>
              <input type="radio" name="record_status" value="2" title="禁用" <?php if(isset($list['record_status']) and $list['record_status'] == 2): ?> checked <?php endif; ?>>
              <input type="radio" name="record_status" value="-1" title="标记删除" <?php if(isset($list['record_status']) and  $list['record_status'] == -1): ?> checked <?php endif; ?>>
            </div>
          </div>

            <div class="layui-form-item">
              <label for="L_sign" class="layui-form-label"></label>
              <button class="layui-btn" lay-filter="add" lay-submit="">保存</button>
            </div>
        </form>
        <!-- 右侧内容框架，更改从这里结束 -->
    </div>
<!-- 专家添加 -->
<script>
    var expertSelect = <?php echo $expert_select;?>;
  
    layui.config({
      base: '../static/admin/dist/'
    }).extend({
      formSelects: 'formSelects-v3.min'
    }).use(['jquery','form','layer','table', 'formSelects','laydate'], function(){
        $ = layui.jquery;
      var form = layui.form
      ,layer = layui.layer;
  
      laydate = layui.laydate;//日期插件
      //渲染日期
      laydate.render({
        elem: '#start_date' //指定元素
        ,type: 'datetime'
      });
      laydate.render({
        elem: '#end_date' //指定元素
        ,type: 'datetime'
      });
      
      init_expert_table();
  
      
    });
  
     //创建列表
    function init_expert_table(){
  
      $("input[name='expert_ids']").val(JSON.stringify(expertSelect));
      var array = new Array();
        for (var i = expertSelect.length - 1; i >= 0; i--) {
          var dict = JSON.parse(JSON.stringify(expertSelect[i]));
          dict['manager'] = '<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>'; 
          array.push(dict);
        }
        var table = layui.table;
  
        table.render({
            elem: '#expert_table'
            ,height: 315
            ,cols: [[ //表头
              {field: 'expert_id', title: 'ID'}
              ,{field: 'expert_name', title: '专家' }
              ,{field: 'manager', title: '删除'}
            ]]
            ,data: array
          });
        //监听工具条
        table.on('tool(expert_table)', function(obj){
          var data = obj.data;
          var Delete_FID = data.expert_id;
          if(obj.event === 'detail'){
            expert_add();
            // layer.msg('ID：'+ data.id + ' 的查看操作');
          } else if(obj.event === 'del'){
            layer.confirm('真的删除行么', function(index){
              for (var i = expertSelect.length - 1; i >= 0; i--) {
                 if (expertSelect[i].expert_id == Delete_FID){
                    expertSelect.splice(i,1);
                 }
               } 
              init_expert_table();
              layer.close(index);
            });
          } else if(obj.event === 'edit'){
            // layer.alert('编辑行：<br>'+ JSON.stringify(data))
            expert_add();
  
          }
        });
    }
  //多选搜索下拉框把数组拼接的字符串放到form中
  function handlerVals(arr,key){
    var str = arr.map(function(val){
      return val.val;
    }).join(',');
    $("input[name='"+ key +"']").val(str);
  }
  
  //创建弹窗
  function expert_add(){
  
      var content = '\
                <form class="layui-form" id="defaultForm" style="margin:20px 20px 20px 0px;">\
                  \
              <div class="layui-form-item">\
                  <label class="layui-form-label xbs768">专家</label>\
                  <div class="layui-input-block">\
                    <select name="expert_ids" required lay-search="">\
                      <option value="">直接选择或搜索选择</option>\
                      <?php if(is_array($expert_list) || $expert_list instanceof \think\Collection || $expert_list instanceof \think\Paginator): $i = 0; $__LIST__ = $expert_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>\
                        <option value="<?php echo $vo['fid'].",".$vo['expert_name']; ?>"><?php echo $vo['expert_name']; ?></option>\
                      <?php endforeach; endif; else: echo "" ;endif; ?>\
                    </select>\
                  </div>\
              </div>\
              \
                </form>\
                  ';
  
      layer.open({
        type: 1,  
        area: ['500px', '400px'],  
        content: content,  
        btn: ['保存', '取消']  
        ,yes: function(index, layero){  
          var values = $("#defaultForm").serializeArray();
          console.log(values);
          var expert_id = values[0].value.split(',')[0];
          var expert_name = values[0].value.split(',')[1];     
         var dict = {"expert_id":expert_id,"expert_name":expert_name};
  
          //检查是否已经被选中
          if (expert_id>0) {
              for (var i = expertSelect.length - 1; i >= 0; i--) {
                  if (expertSelect[i].expert_id==expert_id){
                    layer.msg('已经添加过了哦');
                    return;
                  }
              }
          }else{
              layer.msg('选择专家无效，请重新选择');
              return;
          }
          expertSelect.push(dict);
          init_expert_table();
          layer.closeAll();
        },btn2: function(index, layero){  
        
        },cancel: function(){  
            
        }
      });
      //重新渲染
      var form = layui.form;
      form.render();
    }
    </script>
<script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
	var index=0;
	var cosBox=[];
	
	/**
	 * 计算签名
	**/
	var getSignature = function(callback){
		$.ajax({
			url: '/api/live/js_sign?test=123',  //获取客户端上传签名的 URL
			type: 'POST',
			dataType: 'json',
			success: function(result){
				if(result) {
					callback(result);
				} else {
					return '获取签名失败';
				}
			}
		});
	};
	
	//删除已上传
	var video_del = function(fileid){
		$.ajax({
			url: '/api/live/js_sign?test=123&fileid='+fileid,
			type: 'POST',
			dataType: 'json',
			success: function(result){
				return result;
			}
		});
	};


	function getAntiLeechUrl(videoUrl, callback) {
		$.ajax({
			url: 'https://demo.vod2.myqcloud.com/ugc-upload/',
			data: JSON.stringify({
				"Action": "GetAntiLeechUrl",
				Url: videoUrl,
			}),
			type: 'POST',
			dataType: 'json',
			success: function(res){
				if(res.data && res.data.url) {
					callback(res.data.url);
				} else {
					return '获取防盗链视频地址失败';
				}

			}
		});
	}	
	
	/**
	 * 添加上传信息模块
	 */
	var addUploaderMsgBox = function(type){
		var html = '<div class="uploaderMsgBox" name="box'+index+'">';
		if(!type || type == 'hasVideo') {
			html += '视频名称：<span name="videoname'+index+'"></span>；' +
				'计算sha进度：<span name="videosha'+index+'">0%</span>；' +
				'上传进度：<span name="videocurr'+index+'">0%</span>；' +
				'fileId：<span name="videofileId'+index+'">   </span>；' +
				'上传结果：<span name="videoresult'+index+'">   </span>；<br>' +
				'地址：<span name="videourl'+index+'">   </span>；'+
				'<a href="javascript:void(0);" name="cancel'+index+'" cosnum='+index+' act="cancel-upload">取消上传</a><br>';
		}
		if(!type || type == 'hasCover') {
			html += '封面名称：<span name="covername'+index+'"></span>；' +
			'计算sha进度：<span name="coversha'+index+'">0%</span>；' +
			'上传进度：<span name="covercurr'+index+'">0%</span>；' +
			'上传结果：<span name="coverresult'+index+'">   </span>；<br>' +
			'地址：<span name="coverurl'+index+'">   </span>；<br>' +
			'</div>'
		}
		html += '</div>';
		$('#resultBox').append(html);
		return index++;
	};

	/**
	 *上传视频+封面
	**/
	var videoFileList = [];
	var coverFileList = [];
	// 给addVideo添加监听事件
	$('#addVideo-file').on('change', function (e) {
		var videoFile = this.files[0];
		videoFileList[0] = videoFile;
		$('#result').append(videoFile.name +　'\n');

	});
	$('#addVideo').on('click', function () {
		$('#addVideo-file').click();
	});
	// 给addCover添加监听事件
	$('#addCover-file').on('change', function (e) {
		var coverFile = this.files[0];
		coverFileList[0] = coverFile;
		$('#result').append(coverFile.name +　'\n');

	});
	$('#addCover').on('click', function () {
		$('#addCover-file').click();
	});

	var startUploader = function(fileid){
		if(videoFileList.length){
			var num = addUploaderMsgBox();
			if(!coverFileList[0]){
				$('[name=covername'+num+']').text('没有上传封面');
			}
			var resultMsg = qcVideo.ugcUploader.start({
				videoFile: videoFileList[0],
				coverFile: coverFileList[0],
				getSignature: getSignature,
				allowAudio: 1,
				success: function(result){
					if(result.type == 'video') {
						$('[name=videoresult'+num+']').text('上传成功');
						$('[name=cancel'+num+']').remove();
						cosBox[num] = null;
					} else if (result.type == 'cover') {
						$('[name=coverresult'+num+']').text('上传成功');
					}
				},
				error: function(result){
					if(result.type == 'video') {
						$('[name=videoresult'+num+']').text('上传失败>>'+result.msg);
					} else if (result.type == 'cover') {
						$('[name=coverresult'+num+']').text('上传失败>>'+result.msg);
					}
				},
				progress: function(result){
					if(result.type == 'video') {
						$('[name=videoname'+num+']').text(result.name);
						$('[name=videosha'+num+']').text(Math.floor(result.shacurr*100)+'%');
						$('[name=videocurr'+num+']').text(Math.floor(result.curr*100)+'%');
						$('[name=cancel'+num+']').attr('taskId', result.taskId);
						cosBox[num] = result.cos;
					} else if (result.type == 'cover') {
						$('[name=covername'+num+']').text(result.name);
						$('[name=coversha'+num+']').text(Math.floor(result.shacurr*100)+'%');
						$('[name=covercurr'+num+']').text(Math.floor(result.curr*100)+'%');
					}
				},
				finish: function(result){
					//上传成功 
					if(result.fileId>0){
						video_del(fileid);
					}
					$('#fileid').val(result.fileId);
					$('#play_url').val(result.videoUrl);
					$('[name=videofileId'+num+']').text(result.fileId);
					getAntiLeechUrl(result.videoUrl, function (newUrl) {
						$('[name=videourl'+num+']').text(newUrl);
					});
					if(result.coverUrl) {
						$('[name=coverurl'+num+']').text(result.coverUrl);
					}
					if(result.message) {
						$('[name=videofileId'+num+']').text(result.message);
					}
				}
			});
			if(resultMsg){
				$('[name=box'+num+']').text(resultMsg);
			}
		} else {
			$('#result').append('请添加视频！\n');
		}

	}

	// 上传按钮点击事件
	$('#uploadFile').on('click', function () {
		var secretId = $('#secretId').val();
		var secretKey = $('#secretKey').val();
		var fileid=$('#fileid').val();
		startUploader(fileid);
		//$('#form2')[0].reset();
	});
	
	/*
	 * 取消上传绑定事件，示例一与示例二通用
	 */
	$('#resultBox').on('click', '[act=cancel-upload]', function() {
		var cancelresult = qcVideo.ugcUploader.cancel({
			cos: cosBox[$(this).attr('cosnum')],
			taskId: $(this).attr('taskId')
		});
		console.log(cancelresult);
	});
</script>
</body>
</html>