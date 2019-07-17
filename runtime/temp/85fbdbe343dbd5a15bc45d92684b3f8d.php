<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:79:"/home/wwwroot/default/SIFIC/public/../application/admin/view/product/parge.html";i:1547782249;s:69:"/home/wwwroot/default/SIFIC/application/admin/view/public/header.html";i:1548327812;}*/ ?>
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

          <input type="hidden" name="fid" value="<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:''); ?>">
          <input type="hidden" name="product_type" value="<?php echo (isset($list['product_type']) && ($list['product_type'] !== '')?$list['product_type']:''); ?>">
          
          <div class="layui-form-item" style="display: inline-block;" id="live">
              <label for="L_sign" class="layui-form-label"></label>
              <a class="layui-btn" onclick="video_add(1)"><i class="layui-icon">&#xe608;</i>添加直播<?php html_sign();?> </a>
          </div>

          <div class="layui-form-item" style="display: inline-block;" id="video2">
              <label for="L_sign" class="layui-form-label"></label>
              <a class="layui-btn" onclick="video_add(2)">
              <i class="layui-icon">&#xe608;</i>添加录播<?php html_sign();?></a>
          </div>

          <div class="layui-form-item" style="display: inline-block;" id="video3">
              <label for="L_sign" class="layui-form-label"></label>
              <a class="layui-btn" onclick="video_add(3)">
              <i class="layui-icon">&#xe608;</i>添加考试<?php html_sign();?></a>
          </div>

          <div class="layui-form-item" style="margin-left: 110px;">
              <table id="video_table" lay-filter="video_table"></table>
              <input type="hidden"  name="fids">
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
  var select_list = <?php echo $select_list;?>;

	$(document).ready(function(){
    $msj=<?php echo (isset($list['product_type']) && ($list['product_type'] !== '')?$list['product_type']:0); ?>;
    publics($msj);
  });

  for (var i = 0; i < select_list.length; i++) {
    if(select_list[i].main_type==1){
        select_list[i].main_type='直播';
    }else if(select_list[i].main_type==2){
        select_list[i].main_type='录播';
    }else{
        select_list[i].main_type='考试';
    }
  }


  layui.use(['jquery','form','layer','table'], function(){
    $ = layui.jquery;
    var form = layui.form
    ,layer = layui.layer;
    init_expert_table();
  });

  function publics(type){
    if(type==2){
      $("#live").attr("style","display:none");
      $("#video2,#video3").attr("style","display:inline-block");
    }else{
      $("#live").attr("style","display:inline-block");
      $("#video2,#video3").attr("style","display:none");
    }

  }

 //创建列表
 function init_expert_table(){
    $("input[name='fids']").val(JSON.stringify(select_list));
    var array = new Array();
      for (var i = select_list.length - 1; i >= 0; i--) {
        var dicts = JSON.parse(JSON.stringify(select_list[i]));
        dicts['manager'] = '<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>'; 
        array.push(dicts);
      }
      var table = layui.table;

      table.render({
          elem: '#video_table'
          ,height: 315
          ,cols: [[ //表头
            {field: 'main_id', title: 'ID'}
            ,{field: 'title', title: '章节-标题' }
            ,{field: 'main_type', title: '类型'}
            ,{field: 'sort', title: '排序'} 
            ,{field: 'manager', title: '操作'}
          ]]
          ,data: array
        });
      //监听工具条
      table.on('tool(video_table)', function(obj){
        var data = obj.data;
        var Delete_fid = data.main_id;
        var Delete_Type = data.main_type;
        if(obj.event === 'detail'){
          video_add();
        } else if(obj.event === 'del'){
          layer.confirm('真的删除行么', function(index){
            for (var i = select_list.length - 1; i >= 0; i--) {
               if (select_list[i].main_id == Delete_fid && select_list[i].main_type == Delete_Type){
                  select_list.splice(i,1);
               }
             } 
            init_expert_table();
            layer.close(index);
          });
        } else if(obj.event === 'edit'){
          video_add();
        }
      });
  }

//创建弹窗
function video_add(type){

    if (type==1) {
        var content = '\
              <form class="layui-form" id="defaultForm" style="margin:20px 20px 20px 0px;">\
                \
                <div class="layui-form-item">\
                    <label class="layui-form-label xbs768">直播</label>\
                    <div class="layui-input-block">\
                      <select name="main_id"  lay-search="">\
                        <option value="">直接选择或搜索选择</option>\
                        <?php if(is_array($live_list) || $live_list instanceof \think\Collection || $live_list instanceof \think\Paginator): $i = 0; $__LIST__ = $live_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>\
                          <option value="<?php echo $vo['fid'].",".$vo['title']; ?>"><?php echo $vo['title']; ?></option>\
                        <?php endforeach; endif; else: echo "" ;endif; ?>\
                      </select>\
                    </div>\
                </div>\
                <div class="layui-form-item layui-form-text">\
                    <label for="sort" class="layui-form-label">排序</label>\
                    <div class="layui-input-block" >\
                        <input type="number" name="sort"  class="layui-input" value=0>\
                    </div>\
                </div>\
              </form>\
                ';
    }else if (type==2){
        var content = '\
              <form class="layui-form" id="defaultForm" style="margin:20px 20px 20px 0px;">\
                \
                <div class="layui-form-item">\
                    <label class="layui-form-label xbs768">录播</label>\
                    <div class="layui-input-block">\
                      <select name="main_id"  lay-search="">\
                        <option value="">直接选择或搜索选择</option>\
                        <?php if(is_array($video_list) || $video_list instanceof \think\Collection || $video_list instanceof \think\Paginator): $i = 0; $__LIST__ = $video_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>\
                          <option value="<?php echo $vo['fid'].",".$vo['title']; ?>"><?php echo $vo['title']; ?></option>\
                        <?php endforeach; endif; else: echo "" ;endif; ?>\
                      </select>\
                    </div>\
                </div>\
                <div class="layui-form-item">\
                    <label class="layui-form-label xbs768">章节</label>\
                    <div class="layui-input-block">\
                      <select name="section_id"  lay-search="">\
                        <option value="">直接选择或搜索选择</option>\
                        <?php if(is_array($product_section) || $product_section instanceof \think\Collection || $product_section instanceof \think\Paginator): $i = 0; $__LIST__ = $product_section;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>\
                          <option value="<?php echo $vo['fid'].",".$vo['title']; ?>"><?php echo $vo['title']; ?></option>\
                        <?php endforeach; endif; else: echo "" ;endif; ?>\
                      </select>\
                    </div>\
                </div>\
                <div class="layui-form-item">\
                    <label for="sort" class="layui-form-label">排序</label>\
                    <div class="layui-input-block" >\
                        <input type="number" name="sort" class="layui-input" value=0>\
                    </div>\
                </div>\
              </form>\
                ';
    }else if (type==3){
        var content = '\
              <form class="layui-form" id="defaultForm" style="margin:20px 20px 20px 0px;">\
                \
                <div class="layui-form-item">\
                    <label class="layui-form-label xbs768">考试</label>\
                    <div class="layui-input-block">\
                      <select name="main_id"  lay-search="">\
                        <option value="">直接选择或搜索选择</option>\
                        <?php if(is_array($product_exam) || $product_exam instanceof \think\Collection || $product_exam instanceof \think\Paginator): $i = 0; $__LIST__ = $product_exam;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>\
                          <option value="<?php echo $vo['fid'].",".$vo['exam_name']; ?>"><?php echo $vo['exam_name']; ?></option>\
                        <?php endforeach; endif; else: echo "" ;endif; ?>\
                      </select>\
                    </div>\
                </div>\
                <div class="layui-form-item">\
                    <label class="layui-form-label xbs768">章节</label>\
                    <div class="layui-input-block">\
                      <select name="section_id"  lay-search="">\
                        <option value="">直接选择或搜索选择</option>\
                        <?php if(is_array($product_section) || $product_section instanceof \think\Collection || $product_section instanceof \think\Paginator): $i = 0; $__LIST__ = $product_section;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>\
                          <option value="<?php echo $vo['fid'].",".$vo['title']; ?>"><?php echo $vo['title']; ?></option>\
                        <?php endforeach; endif; else: echo "" ;endif; ?>\
                      </select>\
                    </div>\
                </div>\
                <div class="layui-form-item">\
                    <label for="sort" class="layui-form-label">排序</label>\
                    <div class="layui-input-block" >\
                        <input type="number" name="sort"  class="layui-input" value=0>\
                    </div>\
                </div>\
              </form>\
                ';    
    }     
    
                       
    layer.open({
      type: 1,  
      area: ['50%', '70%'],  
      content: content,  
      btn: ['保存', '取消']  
      ,yes: function(index, layero){  
        var values = $("#defaultForm").serializeArray();
        console.log(values)
        var section_title = values[1].value.split(',')[1];
        var main_id = values[0].value.split(',')[0];
        var title = values[0].value.split(',')[1];
        var sort = values[1].value;
        var section_ids = 0;
        if(type==1){
          main_type="直播";
          section_id=section_ids;
        }else if(type==2){
          main_type="录播";
          title=section_title+"-"+title;
          sort = values[2].value;
          section_id=values[1].value.split(',')[0]; 
        }else if(type==3){
          main_type="考试";
          title=section_title+"-"+title;
          sort = values[2].value;
          section_id=values[1].value.split(',')[0]; 
        }
        var main_type= main_type;
        var product_id = "<?php echo (isset($list['fid']) && ($list['fid'] !== '')?$list['fid']:''); ?>";
        var product_type = type;
        if (!main_id) {
              layer.msg('选择无效，请重新选择');
              return;
        }
        if ((section_id==0 || !section_id) && product_type==2) {
              layer.msg('选择无效，请重新选择章节');
              return;
        }

        var dicts = {"main_id":main_id,"title":title,"sort":sort,"main_type":main_type,"product_id":product_id,"product_type":product_type,"section_id":section_id};
        //检查是否已经被选中
        for (var i = select_list.length - 1; i >= 0; i--) {
          if (main_id>0) {
            if (select_list[i].main_id==main_id){
              layer.msg('已经添加过了哦');
              return;
            }
            if (select_list[i].sort==sort){
              layer.msg('排序ID不能相同哦');
              return;
            }
          }else{
              layer.msg('选择无效，请重新选择');
              return;
          }
        }
        select_list.push(dicts);
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
</body>
</html>