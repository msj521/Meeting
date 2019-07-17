<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:86:"/home/wwwroot/default/SIFICYear/public/../application/admin/view/meet/edit_agenda.html";i:1538103862;s:73:"/home/wwwroot/default/SIFICYear/application/admin/view/public/header.html";i:1548327812;s:78:"/home/wwwroot/default/SIFICYear/application/admin/view/public/meet_expert.html";i:1538107051;}*/ ?>
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
  <form class="layui-form" action="/meet/update_agenda" method="post" enctype="multipart/form-data">
    <div class="layui-form-item">
      <label for="schedule_name" class="layui-form-label">日程名称</label>
      <div class="layui-input-block">
        <input class="layui-input" id="schedule_name" name="schedule_name" required lay-verify="schedule_name"  value="<?php echo (isset($list['schedule_name']) && ($list['schedule_name'] !== '')?$list['schedule_name']:''); ?>">
      </div>
    </div>

    <div class="layui-form-item">
      <label for="description" class="layui-form-label">日程描述</label>
      <div class="layui-input-block">
        <textarea placeholder="请输入内容" class="layui-textarea" type="text" id="description" name="description"><?php echo (isset($list['description']) && ($list['description'] !== '')?$list['description']:''); ?></textarea>
      </div>
    </div>


    <!-- 专家添加 -->
<div class="layui-form-item">
  <label for="L_sign" class="layui-form-label">
  </label>
 <a class="layui-btn" onclick="expert_add()"><i class="layui-icon">&#xe608;</i>添加专家</a>
</div>

<div class="layui-form-item" style="margin-left: 110px;">
  <table id="expert_table" lay-filter="expert_table"></table>
  <input type="hidden"  name="expert_ids">
</div>
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
            ,{field: 'class_name_zh', title: '担任角色'} 
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
            <div class="layui-form-item">\
                <label class="layui-form-label xbs768">担任角色</label>\
                <div class="layui-input-block">\
                  <select name="role_ids" required lay-search="">\
                    <option value="">直接选择或搜索选择</option>\
                    <?php if(is_array($role_list) || $role_list instanceof \think\Collection || $role_list instanceof \think\Paginator): $i = 0; $__LIST__ = $role_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>\
                      <option value="<?php echo $vo['fid'].",".$vo['class_name_zh']; ?>"><?php echo $vo['class_name_zh']; ?></option>\
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
        var expert_id = values[0].value.split(',')[0];
        var expert_name = values[0].value.split(',')[1];
        var role_id = values[1].value.split(',')[0];
        var class_name_zh = values[1].value.split(',')[1];        
       var dict = {"expert_id":expert_id,"expert_name":expert_name,"class_name_zh":class_name_zh,"role_ids":role_id};

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


    <div class="layui-form-item">
      <label for="room_id" class="layui-form-label">会议室</label>
      <div class="layui-input-block">
        <select name="room_id" id="room_id">
          <?php if(is_array($room) || $room instanceof \think\Collection || $room instanceof \think\Paginator): $i = 0; $__LIST__ = $room;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <option value="<?php echo $vo['fid']; ?>" <?php if(isset($list['room_id']) and $vo['fid'] == $list['room_id']): ?> selected="selected"  <?php endif; ?> ><?php echo $vo['room_name']; ?></option>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">开始时间</label>
      <div class="layui-input-block">
        <input class="layui-input" id="start_date" required lay-verify="start_date" name="start_date" value="<?php echo (isset($list['start_date']) && ($list['start_date'] !== '')?$list['start_date']:''); ?>">
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">结束时间</label>
      <div class="layui-input-block">
        <input class="layui-input" id="end_date"  required lay-verify="end_date" name="end_date" value="<?php echo (isset($list['end_date']) && ($list['end_date'] !== '')?$list['end_date']:''); ?>">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">状态</label>
      <div class="layui-input-block">
        <input type="radio" name="record_status" value="1" title="启用" checked>
        <input type="radio" name="record_status" value="2" title="禁用" <?php if(isset($list['record_status']) and $list['record_status'] == 2): ?> checked <?php endif; ?>>
        <input type="radio" name="record_status" value="-1" title="标记删除" <?php if(isset($list['record_status']) and  $list['record_status'] == -1): ?> checked <?php endif; ?>>
      </div>
    </div>
    <input type="hidden" name="fid" value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:''); ?>">
    <input type="hidden" name="schedulefirst_id" value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:''); ?>">
    <input type="hidden" name="convention_id" value="<?php echo (isset($convention_id) && ($convention_id !== '')?$convention_id:''); ?>">

    <div class="layui-form-item">
      <label class="layui-form-label"></label>
      <button class="layui-btn" lay-filter="save" lay-submit="" type="submit">保存</button>
    </div>
  </form>
</div>

</body>
</html>