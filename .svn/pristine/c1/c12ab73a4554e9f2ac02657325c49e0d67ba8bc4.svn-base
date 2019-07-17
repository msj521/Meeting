<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:84:"/home/wwwroot/default/SIFICYear/public/../application/admin/view/meet/edit_sign.html";i:1540453471;s:73:"/home/wwwroot/default/SIFICYear/application/admin/view/public/header.html";i:1548327812;s:73:"/home/wwwroot/default/SIFICYear/application/admin/view/public/top_js.html";i:1548124979;}*/ ?>
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
        <form class="layui-form"  action="<?php echo (isset($update) && ($update !== '')?$update:'/'); ?>" method="post" enctype="multipart/form-data">

            <div class="layui-form-item">
                  <label for="field_name" class="layui-form-label">已有字段名*</label>
                  <div class="layui-input-block">
                    <input disabled="disabled"style="color: red;" value="参会人、联系电话、单位、职称" class="layui-input">
                  </div>
            </div>

            <div class="layui-form-item">
                  <label for="field_name" class="layui-form-label">字段名</label>
                  <div class="layui-input-block">
                    <input type="text" id="field_name" lay-verify="required" name="field_name" autocomplete="off" value="<?php echo (isset($list['field_name']) && ($list['field_name'] !== '')?$list['field_name']:''); ?>" class="layui-input">
                  </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label xbs768">是否必填</label>
              <div class="layui-input-block">
                <input type="radio" name="require" value="1" title="必填" checked >
                <input type="radio" name="require" value="2" title="非必填" <?php if(isset($list['require']) and $list['require'] == 2): ?> checked <?php endif; ?>>
              </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label xbs768">题目类型</label>
              <div class="layui-input-block">
                <input type="radio" name="field_type" value="1" title="填空题" checked >
                <input type="radio" name="field_type" value="2" title="单选题" <?php if(isset($list['field_type']) and $list['field_type'] == 2): ?> checked <?php endif; ?>>
                <input type="radio" name="field_type" value="3" title="多选题" <?php if(isset($list['field_type']) and $list['field_type'] == 3): ?> checked <?php endif; ?>>
                <input type="radio" name="field_type" value="4" title="下拉选择" <?php if(isset($list['field_type']) and  $list['field_type'] == 4): ?> checked <?php endif; ?>>
                <input type="radio" name="field_type" value="5" title="时间" <?php if(isset($list['field_type']) and  $list['field_type'] == 5): ?> checked <?php endif; ?>>
              </div>
            </div>

            <div class="layui-form-item">
              <label for="sort" class="layui-form-label">报名明细</label>
                <table class="layui-hide" id="func" lay-data="{id:'myTable'}" lay-filter="myTable"></table>
            </div>

            <div class="layui-form-item">
              <label for="sort" class="layui-form-label">排序</label>
              <div class="layui-input-block">
                <input type="number" id="sort" name="sort" autocomplete="off" value="<?php echo (isset($list['sort']) && ($list['sort'] !== '')?$list['sort']:''); ?>" class="layui-input">
              </div>
            </div>

            <input type="hidden" name="convention_id" value="<?php echo (isset($list['convention_id']) && ($list['convention_id'] !== '')?$list['convention_id']:$fid); ?>">
            <input type="hidden" name="fid" value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:''); ?>">
            <input type="hidden" id="option_list" name="option_list" value="">

            <div class="layui-form-item">
              <label class="layui-form-label xbs768">状态</label>
              <div class="layui-input-block">
                <input type="radio" name="record_status" value="1" title="启用" checked >
                <input type="radio" name="record_status" value="2" title="禁用" <?php if(isset($list['record_status']) and $list['record_status'] == 2): ?> checked <?php endif; ?>>
                <input type="radio" name="record_status" value="-1" title="标记删除" <?php if(isset($list['record_status']) and  $list['record_status'] == -1): ?> checked <?php endif; ?>>
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
    <script type="text/html" id="barTool">
      <div class="td-manage">  
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
      </div>
    </script>
</body>
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

<script>
var option_list = <?php echo $option_list;?>;

if (option_list.length==0) {
  option_list = Array();
}
//console.log(option_list);
var table;

var option_model = {
  'fid':-1,
  'detail_name':'',
  'sort':'',
};
option_list.push(option_model);

layui.use(['tree', 'layer','table'], function(){
    table = layui.table;
    initTabel(option_list,table);
    //监听工具条
  table.on('tool(myTable)', function(obj){
    var data = obj.data;
    if(obj.event === 'del'){
      if (data.fid==-1) {
        layer.msg('此数据为空，不需要删除！');
        return;
      }
      for (let i = 0; i < option_list.length; i++) {
        const element = option_list[i];
        if (element.fid==data.fid) {
          option_list.splice(i,1);
          break;
        }
/*         if (element.sort==data.sort){
              layer.msg('排序ID不能相同哦');
              return;
        } */
      } 
      initTabel(option_list,table);
    }
  });
  //监听单元格编辑
  table.on('edit(myTable)', function(obj){
    var value = obj.value //得到修改后的值
    ,data = obj.data //得到所在行所有键值
    ,field = obj.field; //得到字段

    if (data.fid==-1) {
      //新增
      for (let i = 0; i < option_list.length; i++) {
        var element = option_list[i];
        if (element.fid=='-1') {
          element.fid = 0;
        }
      }
      var option_model = {
        'fid':-1,
        'detail_name':'',
        'sort':'',
      };
      option_list.push(option_model);
    }
      initTabel(option_list,table);
  });
});

function initTabel(data,table){

  table.render({
    elem: '#func'
    ,data:data
    ,cols: [[
      {field:'detail_name', title: '选项名称',edit: 'text'},
      {field:'sort', title: '排序',edit: 'text'}
      ,{fixed: 'right', width:150, title:'操作',align:'center', toolbar: '#barTool'}
    ]]    
  });  
  var option_str = JSON.stringify(option_list);
  $('#option_list').val(option_str);
}
</script>
</html>