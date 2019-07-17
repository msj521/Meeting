<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:76:"/home/wwwroot/default/SIFIC/public/../application/admin/view/meet/paper.html";i:1548380709;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1548327812;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/top_js.html";i:1548124979;}*/ ?>
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
    <span class="layui-breadcrumb">
      <a><cite>会议管理</cite></a>
      <a><cite>摘要及全文</cite></a>
    </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);"
      title="刷新">
      <i class="layui-icon" style="line-height:30px">ဂ</i>
    </a>
  </div>
  <div class="x-body">
    <form class="layui-form x-center" action="<?php echo (isset($index) && ($index !== '')?$index:'/'); ?>" method="get">
      <input type="hidden" name="fid" value="<?php echo (isset($convention_id) && ($convention_id !== '')?$convention_id:0); ?>">
      <div class="layui-form-pane" style="text-align: center;">
	  
	    <div class="layui-input-inline">
			<select name="special_id" lay-search="">
			  <option value="">所属专题</option>
			  <?php if(is_array($special) || $special instanceof \think\Collection || $special instanceof \think\Paginator): $i = 0; $__LIST__ = $special;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
			  <option value="<?php echo $vo['fid']; ?>" <?php if(isset($special_id) and $vo['fid'] == $special_id): ?> selected="selected" <?php endif; ?> ><?php echo $vo['class_name_zh']; ?></option>
			  <?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
        </div>
		<div class="layui-input-inline">
          <input type="text" name="author_name" value="<?php echo $author_name; ?>" placeholder="请输入作者" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-input-inline">
          <input type="text" name="string" value="<?php echo $string; ?>" placeholder="请输入查询内容" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-input-inline" style="width:80px">
          <button class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </div>
      </div>
  </div>
  </form>
  <xblock>
    <button class="layui-btn" >共有数据：<?php echo $cnt; ?> 条</button>
	<button class="layui-btn layui-btn-danger" >参加评选：<?php echo $yes_yes; ?> 条</button>
  </xblock>
  <table class="layui-hide" id="table" lay-filter="tableTool"></table>

  <div class="page">
    <?php echo $list->render(); ?>
  </div>
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

  //编辑
  function member_edit (title,url,urls,id,w,h) {
    x_admin_consult(title,url,urls,id,w,h);
  }

  /*通用跳转编辑页面*/
  function x_admin_consult(title,url,urls,id,w,h){
    if (title == null || title == '') {
      title=false;
    };
    if (url == null || url == '') {
      url="404.html";
    };
    if (w == null || w == '') {
      w=($(window).width()*0.9);
    };
    if (h == null || h == '') {
      h=($(window).height() - 50);
    };

    layer.open({
      type: 2,
      area: [w+'px', h +'px'],
      fix: false, //不固定
      maxmin: true,
      shadeClose: false,
      shade:0.4,
      title: title,
      content: url+"?fid="+id,
      cancel: function(){
        setTimeout(function () {
          window.location.href = urls;
        }, 1);
      }
    });
  }


  /*通用删除处理*/
  function member_del(id, url, urls) {

    if (id == -1) {
      var ids = tableCheck.getData();
    } else {
      var ids = id;
    }
    if (ids == '' || ids == null || ids < 0) {
      layer.msg('请选择要删除的数据！', {icon: 2, time:2000});
    } else {
      //询问框
      layer.confirm('确认要删除吗？ '+ ids, {
        btn: ['标记','彻底']
      }, function(){
        is_del(ids,url,urls,-1);
      }, function(){
        is_del(ids,url,urls,-2);
      });
    }
  }

  function is_del(ids,url,urls,type){
    //发异步删除数据
    $.ajax({
      type: "post",
      url: url,
      data: {fid:ids,urls:urls,type:type},
      dataType: "json",
      success: function (data) {
        if (data.code == 1) {
          layer.msg(data.msg, {icon: 1, time: 500});
        } else {
          layer.msg(data.msg, {icon: 1, time: 500});
        }
        setTimeout(function () {
          window.location.href = urls;
        }, 1);
      }
    });
  }
</script>





<script>
  // 会议-编辑
  function member_edits(title, url, urls,id, pid,room_id, w, h) {
    x_admin_consults(title, url,urls, id, pid,room_id, w, h);
  }

  function x_admin_consults(title, url,urls,id,pid,room_id, w, h) {
    if (title == null || title == '') {
      title = false;
    };
    if (url == null || url == '') {
      url = "404.html";
    };
    if (w == null || w == '') {
      w = ($(window).width() * 0.9);
    };
    if (h == null || h == '') {
      h = ($(window).height() - 50);
    };

    if (pid == '' || pid == null || pid < 0) {
      layer.msg('参数丢失~~', {icon: 2, time: 3000});
    } else {
      layer.open({
        type: 2,
        area: [w + 'px', h + 'px'],
        fix: false, //不固定
        maxmin: true,
        shadeClose: false,
        shade: 0.4,
        title: title,
        content: url + "?fid=" + id +"&convention_id=" + pid +"&room_id="+room_id,
        cancel: function () {
          //do something
          window.location.href = urls + "?fid=" + pid +"&B"+room_id
        }
      });
    }
  }

   /*通用删除处理*/
  function member_dels(id, url, urls,pid) {

    if (id == -1) {
      var ids = tableCheck.getData();
    } else {
      var ids = id;
    }
    if (ids == '' || ids == null || ids < 0) {
      layer.msg('请选择要删除的数据！', {icon: 2, time:2000});
    } else {
      //询问框
      layer.confirm('确认要删除吗？ '+ ids, {
        btn: ['标记','彻底']
      }, function(){
        is_dels(ids,url,urls,-1,pid);
      }, function(){
        is_dels(ids,url,urls,-2,pid);
      });
    }
  }

  function is_dels(ids,url,urls,type,pid){
    //发异步删除数据
    $.ajax({
      type: "post",
      url: url,
      data: {fid:ids,urls:urls,type:type},
      dataType: "json",
      success: function (data) {
        if (data.code == 1) {
          layer.msg(data.msg, {icon: 1, time: 500});
        } else {
          layer.msg(data.msg, {icon: 1, time: 500});
        }
        setTimeout(function () {
           window.location.href = urls + "?fid="+pid;
        }, 500);
      }
    });
  }
</script>

<!-- 审核操作 -->
<script>
  function member_check(id, url, urls){
    if (id == -1) {
      var ids = tableCheck.getData();
    } else {
      var ids = id;
    }
    if (ids == '' || ids == null || ids < 0) {
      layer.msg('请选择要审核的数据！', {icon: 2, time:2000});
    }else {
      layer.confirm('是否通过', {
        btn: ['是','否']
      }, function(){
        iss_check(ids,url,urls,2);
      }, function(){
        iss_check(ids,url,urls,3);
      });
    }
  }

  function iss_check(ids,url,urls,check){
    //发异步审核数据
    $.ajax({
      type: "post",
      url: url,
      data: {fid:ids,urls:urls,check:check,type:5},
      dataType: "json",
      success: function (data) {
        if (data>0) {
          layer.msg("审核成功", {icon: 1, time: 1000});
        } else {
          layer.msg("审核失败", {icon: 1, time: 1000});
        }
        setTimeout(function () {
          window.location.href = urls;
        }, 1000);
      }
    });
  }
</script>

  <script type="text/html" id="barTool">
	<div class="td-manage">
	  
	  <a title="作者列表" href="javascript:;" lay-event="abstract" style="text-decoration:none">
		<i class="iconfont">&#xe699;</i>
	  </a>
	  <a title="审核" href="javascript:;" lay-event="check" style="text-decoration:none;margin:0px 30px 0px 50px">
		<i class="iconfont">&#xe6b2;</i>
	  </a>
	  
	  <a title="删除" href="javascript:;" lay-event="del" style="text-decoration:none">
		<i class="iconfont">&#xe69d;</i>
	  </a>
	</div>
</script>

<script type="text/html" id="toolbar">
  <div class="layui-btn-container">
    <button class="layui-btn" lay-event="getCheckData">全文及摘要报告</button>
    <button class="layui-btn" lay-event="getCheckLength">导出作者</button>
    <button class="layui-btn" lay-event="isAll">导出全文</button>
  </div>
</script>

 <script type="text/html" id="a">
  {{#  if(d.file_path){ }}
	<a href="{{d.file_path}}" style="color:red" target="_blank">预览全文</a>
  {{#  }else { }}
    无
  {{#  } }}
</script>

 <script type="text/html" id="b">
	<a  class="layui-btn" href="/meet/paper?convention_id={{d.convention_id}}&fid={{d.fid}}&uid={{d.creator_id}}&_idss">导出</a>
</script>

 <script>
    var dataList = <?php echo json_encode($list);?>;
    //console.log(dataList);
    for (var i = 0; i < dataList.data.length; i++) {
	 //数据状态
      if (dataList.data[i].record_status == 1) {
        dataList.data[i].record_status = '启用';
      } else if (dataList.data[i].record_status == 2) {
        dataList.data[i].record_status = '禁用';
      } else if (dataList.data[i].record_status == -1) {
        dataList.data[i].record_status = '标记删除';
      } else if (dataList.data[i].record_status == -2) {
        dataList.data[i].record_status = '彻底删除';
      }
	  
	  //摘要审核状态
      if (dataList.data[i].abstract_status == 1) {
        dataList.data[i].abstract_status = '待审核';
      } else if (dataList.data[i].abstract_status == 2) {
        dataList.data[i].abstract_status = '通过';
      } else if(dataList.data[i].abstract_status == 3) {
        dataList.data[i].abstract_status = '不通过';
      } 	
	  
	  //论文审核状态
      if (dataList.data[i].paper_status == 1) {
        dataList.data[i].paper_status = '待审核';
      } else if (dataList.data[i].paper_status == 2) {
        dataList.data[i].paper_status = '通过';
      } else if(dataList.data[i].paper_status == 3) {
        dataList.data[i].paper_status = '不通过';
      }
	  
	  //发表形式
      if (dataList.data[i].shape == 1) {
        dataList.data[i].shape = '口头和壁报';
      } else if (dataList.data[i].shape == 2) {
        dataList.data[i].shape = '壁报';
      }
	  
 	  //是否参加评选
      if (dataList.data[i].yes_no == 1) {
        dataList.data[i].yes_no = '否';
      } else if (dataList.data[i].yes_no == 2) {
        dataList.data[i].yes_no = '是';
      } 

    }

    layui.use(['table', 'layer'], function () {
      var layer = layui.layer;
      var table = layui.table;
      table.render({
        elem: '#table'
		,toolbar: '#toolbar'
        ,data: dataList.data
        , cols: [[
		  {type: 'checkbox', fixed: 'left'}
          ,{ field: 'fid', width: 100, title: '摘要编号' }
          , { field: 'title', width: 160, title: '标题' }
          , { field: 'class_name_zh', width: 160, title: '所属专题' }
		  , { field: 'author_name', width: 150, title: '作者' }
          , { field: 'shape', width: 100, title: '发表形式' }
          , { field: 'yes_no', width: 100, title: '参加评选' }
          , { title: '预览', width: 100,toolbar:"#a" }
          , { title: '全文及摘要报告', width: 130,toolbar:"#b" }
          , { field: 'abstract_status', width: 100, title: '摘要审核' }
          , { field: 'paper_status', width: 100, title: '全文审核' }
          , { field: 'record_status', width: 100, title: '此条状态' }
          , { field: 'update_time', width: 180, title: '创建时间' }
          , { field: 'user_name', width: 120, title: '申请者' }
          , { fixed: 'right', title: '作者 —— 审核 —— 删除', width: 215, align: 'center', toolbar: '#barTool' }
        ]]
        , page: false
        , limit: dataList.data.length
      });
	  
		//头工具栏事件  //批量导出
		table.on('toolbar(tableTool)', function(obj){
			var checkStatus = table.checkStatus(obj.config.id);
			var data = checkStatus.data;
			var convention_id='<?php echo (isset($convention_id) && ($convention_id !== '')?$convention_id:0); ?>';
			var fids=[];
			for (var key in data) {
				fids[key]=data[key].fid;
			}

			var url="?fid="+convention_id;
			switch(obj.event){
				//全文及摘要报告
				case 'LAYTABLE_COLS':
				case 'LAYTABLE_EXPORT':
				case 'LAYTABLE_PRINT':
					 return true;
				case 'getCheckData':
					url='?_idss&convention_id='+convention_id+'&fid='+fids;
					break;
				//导出作者
				case 'getCheckLength':
					url='?_id='+convention_id+'&fid='+fids;				
					break;
				//导出全文
				case 'isAll':
					url='?_ids='+convention_id+'&fid='+fids;				
					break;
			};
			
			if(fids.length==0){
				layer.alert("请选择执行数据");
				return false;
			}
			window.location.href='/meet/paper'+url;
			<!-- <a class="layui-btn"  href="/meet/paper?convention_id=<?php echo (isset($convention_id) && ($convention_id !== '')?$convention_id:0); ?>&uid=0&_idss">全文及摘要报告</a> -->
			<!-- <a class="layui-btn" href="/meet/paper?_id=<?php echo (isset($convention_id) && ($convention_id !== '')?$convention_id:0); ?>">导出作者</a> -->
			<!-- <a class="layui-btn" href="/meet/paper?_ids=<?php echo (isset($convention_id) && ($convention_id !== '')?$convention_id:0); ?>">导出全文</a> -->
		});

		//监听行工具条
		table.on('tool(tableTool)', function (obj) {
			var data = obj.data;
			if (obj.event === 'del') {
			  member_del(data.fid, '<?php echo (isset($del) && ($del !== '')?$del:' / '); ?>', '<?php echo (isset($index) && ($index !== '')?$index:'/'); ?>?fid=' + data.convention_id )
			} else if (obj.event === 'abstract') {
			  member_edit('作者列表','/meet/author','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>?fid=' + data.convention_id,data.fid,0,0)
			} else if (obj.event === 'check') {
			  member_edit('审核','<?php echo (isset($edit) && ($edit !== '')?$edit:"/"); ?>','<?php echo (isset($index) && ($index !== '')?$index:"/"); ?>?fid=' + data.convention_id,data.fid,0,0)
			}
		});
    });
</script>
</body>
</html>