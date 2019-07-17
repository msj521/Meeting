$(function() {
    var siginfourl = "/api/convention/sign";
    var signupurl = "/api/convention/signup"; //
    var userurl = "/api/user/user_info"; //会议信息接口
    var sign_list = "";
    var signup_info = "";
    var canh_prlist_rg = $("div.canh_prlist_rg div");
    //发票的两个状态值
    var f1 = $("#f1").text();
    var f2 = $("#f2").text();
    //学分信息填写选项值
    var varlue = "";
    var fap = ""

    function userinfo(data) {
        if (data.code == 414) {
            return false;
        }
        $("#user_name").val(data.data.user_info.user_name);
        $("#tel").val(data.data.user_info.tel);
        $("#org_name").val(data.data.user_info.org_name);
        $("#job_name").val(data.data.user_info.job_name);
    }
    var userdata = {
        "token": cook_token,
        "uid": cook_uid
    };
    ajax_all_Filed("true", "true", "GET", userurl, "json", userdata, userinfo); //调用函数

    function siginfo(data) {
        if (data.code == 414) {
            return false;
        }
        var ticket_list = data.data.ticket_list;
        sign_list = data.data.sign_list;
        signup_info = data.data.signup_info;
        var str = "";
        var valueid = ""
        for (var i = 0; i < ticket_list.length; i++) {
            valueid = ticket_list[i].user_value;
            str += '<tr>';
            str += '<td>';
            str += ticket_list[i].ticket_name;
            str += '</td>';
            str += '<td>';
            str += timeStamp2String(ticket_list[i].end_time);
            str += '</td>';
            str += '<td>';
            str += '<div class="ellipsis" style="width:300px" title="' + ticket_list[i].description + '">' + ticket_list[i].description + '</div>';
            str += '</td>';
            str += '<td><p class="price">';
            str += '¥';
            str += ticket_list[i].price;
            str += '</p></td><td>';
            str += '<div class="opt">'
            str += '<input class="magic-radio" type="radio" name="1" id="' + ticket_list[i].fid + '" value="' + ticket_list[i].fid + '"'
            if (valueid == ticket_list[i].fid) {
                str += 'checked';
            }
            str += '>'
            str += '<label for="' + ticket_list[i].fid + '"></label>'
            str += '</div>'
            str += '</td>';
            str += '</tr>';
        }
        $(".table tbody").append(str);
        if (valueid == "" || valueid == null) {
            $('.table tbody input:radio').eq(0).attr('checked', 'true');
        }

        var html = "";
        for (var i = 0; i < sign_list.length; i++) {
            var user_value = sign_list[i].user_value;
            html += '<div class="sigin_txt">';
            html += '<div class="form-group">'
            html += ' <label for="name">' + sign_list[i].field_name + '</label>'
            if (sign_list[i].field_type == 1) {
                html += '<input type="text" class="form-control myclass_' + sign_list[i].fid + '" value="';
                if (user_value == sign_list[i].user_value) {
                    html += sign_list[i].user_value;
                }
                html += '">';
            } else if (sign_list[i].field_type == 4) {
                html += '<select class="form-control myclass_' + sign_list[i].fid + '">'
                html += '<option value="0">请选择</option>'
                for (var j = 0; j < sign_list[i].detail_list.length; j++) {

                    html += '<option value="' + sign_list[i].detail_list[j].fid + '"';
                    if (user_value == sign_list[i].detail_list[j].fid) {
                        html += 'selected = "selected"';
                    }
                    html += '>';
                    html += sign_list[i].detail_list[j].detail_name;
                    html += '</option>';
                }

                html += '</select>'
            } else if (sign_list[i].field_type == 5) {
                html += '<input type="text" id="datetime_' + sign_list[i].fid + '"  class="Myclass_timeselect form-control myclass_' + sign_list[i].fid + ' layui-input" value="';
                if (user_value != null) {
                    html += sign_list[i].user_value;
                }
                html += '" placeholder="选择时间" >'; //onfocus="dateTime(\''+sign_list[i].fid+'\')"
            }
            for (var j = 0; j < sign_list[i].detail_list.length; j++) {
                if (sign_list[i].field_type == 2) {
                    html += '<div class="radio">'
                    html += '<label>'
                    html += ' <input type="radio" name="radio' + sign_list[i].fid + '" class="myclass_' + sign_list[i].fid + '" value="' + sign_list[i].detail_list[j].fid + '" ';
                    if (user_value == sign_list[i].detail_list[j].fid) {
                        html += 'checked'
                    }
                    html += '>'
                    html += sign_list[i].detail_list[j].detail_name;
                    html += '</label>'
                    html += '</div>'
                } else if (sign_list[i].field_type == 3) {
                    html += '<div class="checkbox">'
                    html += '<label>'
                    html += ' <input type="checkbox" class="myclass_' + sign_list[i].fid + '" value="' + sign_list[i].detail_list[j].fid + '" '
                    if (user_value != undefined) {
                        var str1 = "," + user_value + ",";
                        var str2 = "," + sign_list[i].detail_list[j].fid + ",";
                        if (str1.indexOf(str2) > -1) {
                            html += 'checked';
                        }
                    }
                    html += '>'
                    html += sign_list[i].detail_list[j].detail_name;
                    html += '</label>'
                    html += '</div>'
                }
            }

            html += '</div>'
            html += '</div>'
        }
        $("#canh_pr").append(html);

        //绑定公共时间事件
        $('.Myclass_timeselect').each(function() {
            var id = '#' + $(this).attr("id");
            layui.use('laydate', function() {
                var laydate = layui.laydate;
                laydate.render({
                    elem: id,
                });
            })
        })

        if (!signup_info) {
            return false;
        }
        $("#bill_type").val(signup_info.bill_type);
        $("#bill_title").val(signup_info.bill_title);
        $("#tax_num").val(signup_info.tax_num);
        $("#sign_addr").val(signup_info.sign_addr);
        $("#sign_tel").val(signup_info.sign_tel);
        $("#account_bank").val(signup_info.account_bank);
        $("#address").val(signup_info.address);
        $("#account").val(signup_info.account);
        $("#credit_type").val(signup_info.credit_type);
        $("#credit_time").val(signup_info.credit_time);
        $("#credit_title").val(signup_info.credit_title);
        //学分信息填写选项读取
        $("#xuefen .opt input[type=radio]").each(function() {
            var eachvalue = $(this).val();
            varlue = eachvalue;
            if (eachvalue == signup_info.credit_status) {
                $(this).attr("checked", 'true')
                if (signup_info.credit_status == 2) {
                    $("#turediv").show();
                }
            }
        });
        //职称级别
        $("#credit_type option").each(function() {
            var eachvalues = $(this).val();
            if (eachvalues == signup_info.credit_type) {
                $(this).attr("checked", 'true')
            }
        });
        if (f1 == signup_info.bill_type) {
            $("#f1").addClass("invoice_action")
            $("#khuh").hide()
        } else {
            $("#f1").addClass("")
        }
        if (f2 == signup_info.bill_type) {
            $("#f2").addClass("invoice_action")
            $("#khuh").show()
        } else {
            $("#f2").addClass("")
        }

    }
    var data = {
        "convention_id": convention_id,
        "uid": cook_uid
    };
    ajax_all_Filed("true", "true", "POST", siginfourl, "json", data, siginfo); //调用函数

    $("#tj_dingdan").click(function() {
        var ticket_list_fid = $(".table input[type=radio]:checked").val();

        if (ticket_list_fid == undefined || ticket_list_fid == "") {
            showLaert("报名失败！还没选择参会类型")
        }
        var bill_type = $("#bill_type").val();
        var bill_title = $("#bill_title").val();
        var tax_num = $("#tax_num").val();
        var sign_addr = $("#sign_addr").val();
        var sign_tel = $("#sign_tel").val();
        var account_bank = $("#account_bank").val();
        var address = $("#address").val();
        var account = $("#account").val();
        var credit_time = $("#credit_time").val();
        var credit_type = $("#credit_type option:checked").val();
        var credit_title = $("#credit_title").val();
        if (bill_title == null || bill_title == "") {
            showLaert("发票抬头不能为空！");
            return;
        }
        if (tax_num == null || tax_num == "") {
            showLaert("税号不能为空！");
            return;
        }
        if (fap == "增值税专用发票") {
            if (account_bank == null || account_bank == "") {
                showLaert("开户行不能为空！");
                return;
            }
        }

        if (address == null || address == "") {
            showLaert("邮寄地址不能为空！");
            return;
        }
        var sign_data = Array();
        for (var i = 0; i < sign_list.length; i++) {
            var class_name = "myclass_" + sign_list[i].fid;
            if (sign_list[i].field_type == 1) {
                var value = $("." + class_name).val();
                if (sign_list[i].require == 1) {
                    if (value == "" || value == 0) {
                        showLaert(sign_list[i].field_name + "不能为空！");
                        return;
                    }
                }
                var model = {
                    'sign_id': sign_list[i].fid,
                    'value': value,
                    'field_type': sign_list[i].field_type
                }
                sign_data.push(model);
            } else if (sign_list[i].field_type == 2) {
                var value = $("." + class_name + ":checked").val();
                var model = {
                    'sign_id': sign_list[i].fid,
                    'value': value,
                    'field_type': sign_list[i].field_type
                }
                if (sign_list[i].require == 1) {
                    if (value == "" || value == 0) {
                        showLaert(sign_list[i].field_name + "不能为空！");
                        return;

                    }
                }
                sign_data.push(model);
            } else if (sign_list[i].field_type == 3) {
                var value = $("." + class_name + ":checked").map(function(index, elem) {
                    return $(elem).val();
                }).get().join(',');
                var model = {
                    'sign_id': sign_list[i].fid,
                    'value': value,
                    'field_type': sign_list[i].field_type
                }
                if (sign_list[i].require == 1) {
                    if (value == "" || value == 0) {
                        showLaert(sign_list[i].field_name + "不能为空！");
                        return;
                    }
                }
                sign_data.push(model);
            } else if (sign_list[i].field_type == 4) {
                var value = $("." + class_name).val();
                var model = {
                    'sign_id': sign_list[i].fid,
                    'value': value,
                    'field_type': sign_list[i].field_type
                }
                if (sign_list[i].require == 1) {
                    if (value == "" || value == 0) {
                        showLaert(sign_list[i].field_name + "不能为空！");
                        return;
                    }
                }
                sign_data.push(model);
            } else if (sign_list[i].field_type == 5) {
                var value = $("." + class_name).val();
                var model = {
                    'sign_id': sign_list[i].fid,
                    'value': value,
                    'field_type': sign_list[i].field_type
                }
                if (sign_list[i].require == 1) {
                    if (value == "" || value == 0) {
                        showLaert(sign_list[i].field_name + "不能为空！");
                        return;
                    }
                }
                sign_data.push(model);
            }

        }

        function dingdan(data) {
            if (data.code == 200) {
                showLaert(data.msg)
                $("#alert_btn").click(function() {
                    window.location.href = "/payment?convention_id=" + convention_id + "";
                })
            }

        }
        var data = {
            "convention_id": convention_id,
            "uid": cook_uid,
            "sign_info": {
                "ticket_id": ticket_list_fid,
                "bill_type": bill_type,
                "bill_title": bill_title,
                "sign_addr": sign_addr,
                "sign_tel": sign_tel,
                "tax_num": tax_num,
                "account_bank": account_bank,
                "address": address,
                "account": account,
                "credit_status": varlue,
                "credit_time": credit_time,
                "credit_title": credit_title,
                "credit_type": credit_type
            },
            "sign_data": sign_data
        };
        ajax_all_Filed("true", "true", "POST", signupurl, "json", data, dingdan);
    })

    canh_prlist_rg.click(function() {
        $(this).addClass("invoice_action")
            .siblings().removeClass("invoice_action");
        fap = $(this).text();
        if (fap == "" || fap == null) {
            $("#bill_type").val("普通发票")
        } else {
            if (fap == "增值税专用发票") {
                $("#khuh").show()
            } else {
                $("#khuh").hide()
            }
            $("#bill_type").val(fap)
        }

    })
    $("#xuefen .opt input[type=radio]").click(function() {
        varlue = $(this).val();
        if (varlue == 2) {
            $("#turediv").show()
        } else {
            $("#turediv").hide()
        }

    });

})