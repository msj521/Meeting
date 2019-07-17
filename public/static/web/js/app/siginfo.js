$(function() {

    var siginfourl = "api/convention/sign";
    var signupurl = "api/convention/signup";
    var userurl = "/api/user/user_info";
    var sign_list = "";
    var signup_info = "";
    var canh_prlist_rg = $("#canh_prlist_rg div");
    var f1 = $("#f1").text();
    var f2 = $("#f2").text();
    //学分信息填写选项值
    var varlue = "";
    var fap = ""

    function userinfo(data) {
        if (data.code == 414) {
            return false;
        }
        $("#user_name").text(data.data.user_info.user_name);
        $("#tel").text(data.data.user_info.tel);
        $("#org_name").text(data.data.user_info.org_name);
        $("#job_name").text(data.data.user_info.job_name);
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
            str += '<div class="piaowulist">'
            str += '<div class="opttxt">'
            str += '<div class="opttxt_lf">' + ticket_list[i].ticket_name + '</div>'
            str += '<div class="opttxt_rg">¥:' + ticket_list[i].price + '元</div>'
            str += '</div>'
            str += '<div class="opt">'
            str += '<input class="magic-radio" type="radio" name="mp" id="' + ticket_list[i].fid + '" value="' + ticket_list[i].fid + '">'
            str += '<label for="' + ticket_list[i].fid + '"></label>'
            str += '</div>'
            str += '</div>'

        }
        $("#bm_leix").append(str);
        if (valueid == "" || valueid == null) {
            $('#bm_leix input:radio').eq(0).attr('checked', 'true');
        }
        //绑定单选checked
        $(".piaowulist").click(function() {
            var checked = $(this).children(".opt").children(".magic-radio").is(':checked')
            if (checked == false) {
                $(this).children(".opt").children(".magic-radio").prop('checked', 'true');
            } else {
                $(this).children(".opt").children(".magic-radio").prop('checked', '');
            }

        })
        var html = "";
        for (var i = 0; i < sign_list.length; i++) {
            var user_value = sign_list[i].user_value;

            html += '<p style="font-size: 0.3rem; padding: 0.2rem;">' + sign_list[i].field_name + '</p>';
            html += '<div class="sigin_xx cell-item"  style="padding-left:2%">'
            if (sign_list[i].field_type == 1) {
                //填空选择
                html += '<input type="text" class="cell-input myclass_' + sign_list[i].fid + '" value="';
                if (user_value == sign_list[i].user_value) {
                    html += sign_list[i].user_value;
                }
                html += '" autocomplete="off" style="width:100%; border-bottom:1px solid #D9D9D9"/>';
            } else if (sign_list[i].field_type == 4) {
                //下拉选择
                html += '<select class="cell-select myclass_' + sign_list[i].fid + '" style="width:100%;">'
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
                //时间选择
                html += '<input class="myclass_' + sign_list[i].fid + ' Myclass_timeselect cell-input" name="datetime_' + sign_list[i].fid + '" type="text" value="';
                if (user_value != null) {
                    html += sign_list[i].user_value;
                }
                html += '"placeholder="选择时间" id="datetime_' + sign_list[i].fid + '" readonly="readonly">';
            }

            for (var j = 0; j < sign_list[i].detail_list.length; j++) {
                if (sign_list[i].field_type == 2) {
                    html += '<div class="opt">'
                    html += '<input class="magic-radio myclass_' + sign_list[i].fid + '" type="radio" name="radio' + sign_list[i].fid + '" id="' + sign_list[i].detail_list[j].fid + '" value="' + sign_list[i].detail_list[j].fid + '"';
                    if (user_value == sign_list[i].detail_list[j].fid) {
                        html += 'checked';
                    }
                    html += '>';
                    html += '<label for="' + sign_list[i].detail_list[j].fid + '">' + sign_list[i].detail_list[j].detail_name + '</label>';
                    html += '</div>';
                } else if (sign_list[i].field_type == 3) {
                    html += '<div class="opt">'
                    html += '<input class="magic-checkbox myclass_' + sign_list[i].fid + '" type="checkbox" name="checkbox' + sign_list[i].fid + '" id="' + sign_list[i].detail_list[j].fid + '" value="' + sign_list[i].detail_list[j].fid + '"';
                    if (user_value != undefined) {
                        var str1 = "," + user_value + ",";
                        var str2 = "," + sign_list[i].detail_list[j].fid + ",";
                        if (str1.indexOf(str2) > -1) {
                            html += 'checked';
                        }
                    }
                    html += '>';
                    html += '<label for="' + sign_list[i].detail_list[j].fid + '">' + sign_list[i].detail_list[j].detail_name + '</label>';
                    html += '</div>';
                }
            }
            html += '</div>'
        }
        $("#canh_pr").append(html);

        $('.Myclass_timeselect').each(function() {
            var calendar = new LCalendar();
            calendar.init({
                'trigger': "#" + $(this).attr("id"), //标签id
                'type': 'date', //date 调出日期选择 datetime 调出日期时间选择 time 调出时间选择 ym 调出年月选择,
            });
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
        $("#xuefen input[type=radio]").each(function() {
            var eachvalue = $(this).val();
            varlue = eachvalue;
            if (eachvalue == signup_info.credit_status) {
                $(this).attr("checked", 'true')
                if (signup_info.credit_status == 2) {
                    $("#turediv").show();
                } else if (signup_info.credit_status == 1) {
                    $("#turediv").hide();
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
        var ticket_list_fid = $("#bm_leix input[type=radio]:checked").val();
        if (ticket_list_fid == undefined || ticket_list_fid == "") {
            alert("报名失败！还没选择参会类型")
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
            alert("发票抬头不能为空！");
            return;
        }
        if (tax_num == null || tax_num == "") {
            alert("税号不能为空！");
            return;
        }
        if (fap == "增值税专用发票") {
            if (account_bank == null || account_bank == "") {
                alert("开户行不能为空！");
                return;
            }
        }

        if (address == null || address == "") {
            alert("邮寄地址不能为空！");
            return;
        }
        var sign_data = Array();
        for (var i = 0; i < sign_list.length; i++) {
            var class_name = "myclass_" + sign_list[i].fid;
            if (sign_list[i].field_type == 1) {
                var value = $("." + class_name).val();
                if (sign_list[i].require == 1) {
                    if (value == "" || value == 0) {
                        alert(sign_list[i].field_name + "不能为空！");
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
                        alert(sign_list[i].field_name + "不能为空！");
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
                        alert(sign_list[i].field_name + "不能为空！");
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
                        alert(sign_list[i].field_name + "不能为空！");
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
                        alert(sign_list[i].field_name + "不能为空！");
                        return;
                    }
                }
                sign_data.push(model);
            }

        }

        function dingdan(data) {
            if (data.code == 200) {
                console.log(sign_data)
                alert(data.msg)
                    //window.location.href = '/ip_pady?convention_id='+convention_id+'&uid='+cook_uid+'';
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
        ajax_all_Filed("true", "true", "POST", signupurl, "json", data, dingdan); //调用函数
    })

    // canh_prlist_rg.click(function() {
    // 	$(this).addClass("invoice_action")
    // 		.siblings().removeClass("invoice_action");
    // 	fap = $(this).text();
    // 	if(fap == "" || fap == null) {
    // 		$("#bill_type").val("普通发票")
    // 	} else {
    // 		if(fap == "增值税专用发票") {
    // 			$("#khuh").show()
    // 		} else {
    // 			$("#khuh").hide()
    // 		}
    // 		$("#bill_type").val(fap)
    // 	}
    // })

    //点击选择发票类型
    $("#canh_prlist_rg div").on('click', 'div', function() {
        $(this).addClass('invoice_action').siblings().removeClass('invoice_action');
    })
    $("#xuefen input[type=radio]").click(function() {
        varlue = $(this).val();
        if (varlue == 2) {
            $("#turediv").show()
        } else {
            $("#turediv").hide()
        }

    });
    if (varlue == "" || varlue == null) {
        $('#xuefen input[type=radio]').eq(0).attr('checked', 'true');
        $("#turediv").show()
    }

})