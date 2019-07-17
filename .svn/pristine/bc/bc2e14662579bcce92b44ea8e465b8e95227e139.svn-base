var worker_arr = ""
$(function() {
    var paperurl = "/api/convention/author" //添加
    var uploadurl = "api/convention/upload_article";
    var userurl = "/api/convention/personal"; //个人信息
    var file_id = ''; //上传论文返回fiid

    //var type = 1;type=1摘要；2是论文
    //提交简历本地缓存
    worker_arr = new Array(); //添加作者数组
    var abstract_content = new Array(); //摘要数组  
    function getuser(data) {
        var Class_list = data.data.class_list;
        var absstr = "";
        for (var i = 0; i < Class_list.length; i++) {
            absstr += '<option value="' + Class_list[i].fid + '">' + Class_list[i].class_name_zh + '</option>'
        }
        $("#special").append(absstr)
    }
    var getuserdata = {
        "convention_id": convention_id,
        "uid": cook_uid,
    };
    ajax_all_Filed("true", "true", "POST", userurl, "json", getuserdata, getuser); //调用函数


    //获取使用我的注册信息
    $(".opt input[name=myinfo]").on("change", function(argument) {
        if ($(".opt input[name=myinfo]").is(':checked')) {
            function getuser(data) {
                var telString = data.data.tel;
                var arr = new Array();
                arr = telString.split("-");
                if (value_z == 3) {
                    $("#name").val(data.data.user_name); //姓名
                    $("#job_jib").val(data.data.org_name)
                    $("#quhao").val(arr[0]);
                    $("#tel").val(arr[1]); //手机号
                } else {
                    $("#quhao").val(arr[0]);
                    $("#name").val(data.data.user_name); //姓名
                    $("#job_jib").val(data.data.org_name); //单位;
                    $("#address").val(data.data.unit_address); //地址
                    $("#tel").val(arr[1]); //手机号
                    $("#email").val(data.data.email) //email
                }
            }
            var getuserdata = {
                "convention_id": convention_id,
                "uid": cook_uid,
            };
            ajax_all_Filed("true", "true", "GET", userurl, "json", getuserdata, getuser); //调用函数
        } else {
            $("#quhao").val('');
            $("#name").val(''); //姓名
            $("#job_jib").val(''); //单位;
            $("#address").val(''); //地址
            $("#tel").val(''); //手机号
            $("#email").val(''); //email
        }
    })




    //保存作者和摘要
    var pid = "";
    $("#add_abslist").click(function() {

        var s = 0;
        var ss = 0;
        for (var i = 0; i < worker_arr.length; i++) {
            if (worker_arr[i].author_type == 1) {
                s++;
            }

            if (worker_arr[i].author_type == 2) {
                ss++;
            }
        }

        if (s > 1) {
            showLaert("文章作者不能重复！");
            return;
        }

        if (ss > 1) {
            showLaert("通讯作者不能重复！");
            return;
        }

        if ($("#titles").val() == "") {
            showLaert("标题不能为空！");
            return;
        }
        if ($("#keyword").val() == "") {
            showLaert("关键字不能为空！");
            return;
        }
        if ($("#special").val() == 0) {
            showLaert("请选择所属专题！");
            return;
        }
        if ($(".opt input[name=xw]:checked").val() == undefined) {
            showLaert("请选择发表形式！");
            return;
        }
        if ($("#objective").val() == "") {
            showLaert("请填写目的内容！");
            return;
        }
        if ($("#method").val() == "") {
            showLaert("请填写方法内容！");
            return;
        }
        if ($("#result").val() == "") {
            showLaert("请填写结果内容！");
            return;
        }
        if ($("#conclusion").val() == "") {
            showLaert("请填写结论内容！");
            return;
        }
        //加载
        Loadings();
        var paper = new Object();
        paper.title = $("#titles").val();
        paper.keyword = $("#keyword").val();
        paper.special = $("#special").val();
        paper.shape = $(".opt input[name=xw]:checked").val()
        paper.objective = $("#objective").val();
        paper.method = $("#method").val();
        paper.result = $("#result").val();
        paper.conclusion = $("#conclusion").val();
        paper.convention_id = convention_id;
        paper.creator_id = cook_uid;
        abstract_content.push(paper)

        function addabstract(data) {
            $("body .newloading").remove();
            if (data.code == 200) {
                showLaert(data.msg)
                $("#add_abslist").hide()
                $(".opt input[name=pingxuan]").prop("disabled", "");
                $("#add_quanwlist").attr("disabled", false)
                $(".opt input[name=pingxuan]").click(function() {
                    var value = $(this).val()
                    if (value == 2) {
                        $(".abs_file").show()
                        $(".tipls_div").show()
                    } else {
                        $(".abs_file").hide()
                        $(".tipls_div").hide()
                    }
                })
                pid = data.data.file_id;

            } else {
                showLaert(data.msg)
            }

        }

        var userdata = {
            "convention_id": convention_id,
            "uid": cook_uid,
            "file_id": "",
            "type": 1,
            "author_list": worker_arr,
            "abstract_content": abstract_content[0]
        };
        ajax_all_Filed("true", "true", "POST", paperurl, "json", userdata, addabstract); //调用函数
    })

    //保存全文文件

    $("#add_quanwlist").click(function() {
        Loadings();
        var yes_no = $("#pingxuanlist input[name='pingxuan']:checked").val()
        if (yes_no == 2) {
            function addabstract(data) {
                if (data.code == 200) {
                    $("body .newloading").remove();
                    showLaert(data.msg)
                    $("body").on('click', '#alert_btn', function() {
                        window.location.href = "/abstract_list?convention_id=" + convention_id + "";
                    })

                }
            }
            var userdata = {
                "convention_id": convention_id,
                "uid": cook_uid,
                "pid": pid,
                "file_id": file_id,
                "type": yes_no,
                "yes_no": yes_no
            };

            ajax_all_Filed("true", "true", "POST", paperurl, "json", userdata, addabstract); //调用函数
        } else {
            $("body .newloading").remove();
            showLaert('摘要保存成功！')
            $("body").on('click', '#alert_btn', function() {
                window.location.href = "/abstract_list?convention_id=" + convention_id + "";
            })
        }

    })

    //上传论文
    layui.use('upload', function() {
        var $ = layui.jquery,
            upload = layui.upload;
        //指定允许上传的文件类型
        upload.render({
            elem: '#test3',
            url: '/upload',
            accept: 'file', //普通文件
            exts: 'pdf|docx|doc|dot|wps|wpt',
            done: function(res) {
                if (res.code == 200) {
                    function uploadinfo(data) {
                        showLaert('全文上传成功！')
                    }
                    var uploaddata = {
                        "convention_id": convention_id,
                        "download_title": '论文集',
                        "file_ids": res.data,
                        "creator_id": cook_uid
                    };
                    ajax_all_Filed("true", "true", "POST", uploadurl, "json", uploaddata, uploadinfo); //调用函数	
                    file_id = res.data;
                } else {
                    this.error(index, upload);
                }

            }
        });
    });

    //选择作者事件
    var value_z = 1;
    $(".opt input[name='zhuz']").click(function() {
        value_z = $(this).val();
        if (value_z == 3) {
            $(".hideinput").hide();
            $(".pusinput").val("");
            $(".opt input[name=myinfo]").prop("checked", false);
            $("#phone").attr("style", "display:none;");
        } else {
            $(".hideinput").show();
            $(".pusinput").val("")
            $(".opt input[name=myinfo]").prop("checked", false);
            $("#phone").attr("style", "display:;");
        }
    })

    //添加作者按钮事件
    $("#add_worker").click(function() {
        var str = ""
        var quhao = $("#quhao").val(); //手机区号
        var telStr = /^(13|15|17|18|19)\d{9}$/; //手机表达式
        var emailStr = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/; //邮箱验证
        if (value_z == "") {
            showLaert("请选择作者身份！");
            return;
        }
        if (value_z == 3) {
            if ($("#name").val() == "") {
                showLaert("姓名不能为空！");
                return;
            }
            if ($("#job_jib").val() == "") {
                showLaert("单位不能为空！");
                return;
            }
        } else {
            if ($("#name").val() == "") {
                showLaert("姓名不能为空！");
                return;
            }
            if ($("#job_jib").val() == "") {
                showLaert("单位不能为空！");
                return;
            }
            if ($("#address").val() == "") {
                showLaert("地址不能为空！");
                return;
            }
            if (quhao == "") {
                showLaert("手机区号不能为空！");
                return;
            }
            if ($("#tel").val() == "") {
                showLaert("手机号不能为空或格式错误！");
                return;
            }
            if ($("#email").val() == "" || $("#email").val().search(emailStr) == -1) {
                showLaert("email不能为空或格式有误！");
                return;
            }
        }


        var workerlists = new Object();
        workerlists.author_name = $("#name").val(); //姓名
        workerlists.company = $("#job_jib").val(); //单位;
        workerlists.address = $("#address").val(); //地址
        if (value_z != 3) {
            workerlists.tel = quhao + '-' + $("#tel").val(); //手机号
        }
        workerlists.tel = $("#tel").val();
        workerlists.email = $("#email").val() //email
        workerlists.author_type = value_z; //选项状态
        workerlists.convention_id = convention_id;
        workerlists.creator_id = cook_uid;
        worker_arr.push(workerlists)

        $(".abs_table tbody tr").remove()
        for (var i = 0; i < worker_arr.length; i++) {
            str += '<tr>'
            str += '<td>' + worker_arr[i].author_name + '</td>'
            str += '<td><div class="ellipsis" style="width:100px;">'
            str += worker_arr[i].company
            str += '</div></td>'
            str += '<td><div class="ellipsis" style="width:100px;">'
            str += worker_arr[i].address
            str += '</div></td>'
            str += '<td><div class="ellipsis" style="width:108px;">'
            str += worker_arr[i].tel
            str += '</div></td>'
            str += '<td><div class="ellipsis" style="width:100px;">'
            str += worker_arr[i].email
            str += '</div></td>'
            str += '<td>';
            if (worker_arr[i].author_type == 1) {
                str += '<img src="/static/web/images/icon_useyourselfmessege.png" />';
            }
            str += '</td>';
            str += '<td>'
            if (worker_arr[i].author_type == 2) {
                str += '<img src="/static/web/images/icon_useyourselfmessege.png" />';
            }
            str += '</td>'
            str += '<td><a href="javascript:void(0)" class="delss" onclick="delclick($(this))" title="' + i + '">删除</a></td>'
            str += '</tr>'
        }
        $(".abs_table tbody").append(str);

        $("#quhao").val('');
        $("#name").val(''); //姓名
        $("#job_jib").val(''); //单位;
        $("#address").val(''); //地址
        $("#tel").val(''); //手机号
        $("#email").val('') //email
        $(".opt input[name=myinfo]").prop("checked", false);
        $(".opt input[name=zhuz]").prop("checked", false);

    })


    //监听减少字数
    $("#objective").on("input propertychange", function() {
        var $this = $(this),
            _val = $this.val(),
            count = "";
        var valLen = _val.length + getChineseNum(_val);
        $this.val(getStringQuery(_val, 200));
        if (valLen > 200) {
            $("#text-count").text(0);
        } else {
            count = 200 - valLen;
            $("#text-count").text(count);
        }
    });

    $("#method").on("input propertychange", function() {
        var $this = $(this),
            _val = $this.val(),
            count = "";
        var valLen = _val.length + getChineseNum(_val);
        $this.val(getStringQuery(_val, 600));
        if (valLen > 600) {
            $("#text-count2").text(0);
        } else {
            count = 600 - valLen;
            $("#text-count2").text(count);
        }
    });
    $("#result").on("input propertychange", function() {
        var $this = $(this),
            _val = $this.val(),
            count = "";
        var valLen = _val.length + getChineseNum(_val);
        $this.val(getStringQuery(_val, 600));
        if (valLen > 600) {
            $("#text-count3").text(0);
        } else {
            count = 600 - valLen;
            $("#text-count3").text(count);
        }
    });
    $("#conclusion").on("input propertychange", function() {
        var $this = $(this),
            _val = $this.val(),
            count = "";
        var valLen = _val.length + getChineseNum(_val);
        $this.val(getStringQuery(_val, 200));
        if (valLen > 200) {
            $("#text-count4").text(0);
        } else {
            count = 200 - valLen;
            $("#text-count4").text(count);
        }
    });


    $("#upper_level_btn").click(function() {
        window.location.href = "/abstract_list?convention_id=" + convention_id + "";
    })


    //条件渲染、判断系统时间是否超过了2019年3月31日，若是则隐藏摘要参加《中华医院感染杂志》的评选模块
    timeout20190331();
})

//超过2019.03.31
function timeout20190331() {
    var futrueTime1 = new Date();
    futrueTime1.setFullYear(2019, 3, 1)
    futrueTime1.setHours(0);
    futrueTime1.setMinutes(0);
    futrueTime1.setSeconds(0);
    var futrue_time1 = futrueTime1.getTime(); //2019年4月1日00:00的时间戳
    var nowTime = new Date();
    var now_time = nowTime.getTime(); //现在的时间戳
    //超过了2019年3月31日时
    if (now_time >= futrue_time1) {
        $('.timeOutHid').hide();
    }
}

//删除作者代码
function delclick(str) {
    var worker_arr_id = str.attr("title");
    $(".abs_table tbody tr").remove()
    var str = "";
    for (var i = 0; i < worker_arr.length; i++) {
        if (worker_arr_id == i) {
            worker_arr.splice(i, 1)
        }
    }
    for (var j = 0; j < worker_arr.length; j++) {
        if (worker_arr.length != 0) {
            str += '<tr>'
            str += '<td>' + worker_arr[j].author_name + '</td>'
            str += '<td><div class="ellipsis" style="width:100px;">'
            str += worker_arr[j].company
            str += '</div></td>'
            str += '<td><div class="ellipsis" style="width:100px;">'
            str += worker_arr[j].address
            str += '</div></td>'
            str += '<td><div class="ellipsis" style="width:108px;">'
            str += worker_arr[j].tel
            str += '</div></td>'
            str += '<td><div class="ellipsis" style="width:100px;">'
            str += worker_arr[j].email
            str += '</div></td>'
            str += '<td>';
            if (worker_arr[j].author_type == 1) {
                str += '<img src="/static/web/images/icon_useyourselfmessege.png" />';
            }
            str += '</td>';
            str += '<td>'
            if (worker_arr[j].author_type == 2) {
                str += '<img src="/static/web/images/icon_useyourselfmessege.png" />';
            }
            str += '</td>'
            str += '<td><a href="javascript:void(0)" class="delss" onclick="delclick($(this))" title="' + j + '">删除</a></td>'
            str += '</tr>'
        }
    }

    $(".abs_table tbody").append(str);
}

function getChineseNum(val) {
    var len = 0;
    for (var i = 0; i < val.length; i++) {
        var a = val.charAt(i);
        if (a.match(/[^\x00-\xff]/ig) != null) {
            len += 1;
        }
    }
    return len;
}
//截取  val原始字符串  checker位数
function getStringQuery(val, checker) {
    var len = 0;
    var str = "";
    for (var i = 0; i < val.length; i++) {
        var a = val.charAt(i);
        str = str + val[i];
        if (a.match(/[^\x00-\xff]/ig) != null) {
            len += 2;
        } else {
            len += 1;
        }
        if (len > checker) {
            return str;
        }
    }
    return str;
}