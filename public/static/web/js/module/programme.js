$(function() {

    if (getNowTime() > setFutureTime(2019, 3, 20, 17, 0, 0)) {
        showLaert('十分抱歉，评优报名截止日期已过！');
        setTimeout(() => {
            window.location.href = '/'
        }, 2000);
    }




    // var uploadurl = "api/convention/upload_article";
    var programme_url = 'api/convention/programme'
    var prog_data = {
        "convention_id": convention_id,
        "uid": cook_uid
    };
    var type_check = 'write';
    var fid = -1;
    var file_id = '';

    function prog_func(data) {
        //第一次进去该页面填报信息
        if (data == '') {
            return;
        }
        //获取成功数据 渲染到对应页面
        if (data.code == 200) {
            var hospital_name = JSON.parse(data.list.hospital_name.replace(/&quot;/g, '"'));
            var contact = JSON.parse(data.list.contact.replace(/&quot;/g, '"'));
            var establishment = data.list.establishment.replace(/&quot;/g, '');
            var team_members = data.list.team_members.replace(/&quot;/g, '');
            var profession = JSON.parse(data.list.profession.replace(/&quot;/g, '"'));
            var training_status = JSON.parse(data.list.training_status.replace(/&quot;/g, '"'));
            var article_author = JSON.parse(data.list.article_author.replace(/&quot;/g, '"'));
            var part_time = JSON.parse(data.list.part_time.replace(/&quot;/g, '"'));
            var thematic_report = JSON.parse(data.list.thematic_report.replace(/&quot;/g, '"'));
            var monograph_list = JSON.parse(data.list.monograph_list.replace(/&quot;/g, '"'));
            var Honor = JSON.parse(data.list.Honor.replace(/&quot;/g, '"'));
            var highlight_event = data.list.highlight_event.replace(/&quot;/g, '"');
            $('.hospital_name').val(hospital_name.hospitalName); //医院名称
            $('select').val(hospital_name.hospitalDec); //医院等级
            $('.bed_num').val(hospital_name.bedNum); //床位数
            $('.contact_people').val(contact.contact_people); //联系人姓名
            $('.contact_phone').val(contact.contact_phone); //联系人号码
            $('.contact_email').val(contact.contact_email); //联系人email
            $('#credit_time').val(establishment); //成立时间
            $('.group_name').val(team_members); //团队成员
            //设置table表的信息
            table_msg_set(profession, '.select_4');
            table_msg_set(training_status, '.select_5');
            table_msg_set(article_author, '.select_6');
            table_msg_set(part_time, '.select_7');
            table_msg_set(thematic_report, '.select_8');
            table_msg_set(monograph_list, '.select_9');
            table_msg_set(Honor, '.select_10');
            $('#prog_txt').val(highlight_event); //亮点事项

            if (data.list.file_id) {
                $('#test3').text('重新上传');
            }
            type_check = 'update';
            fid = data.list.fid;
            file_id = data.list.file_id;
        }
    }

    ajax_all_Filed("true", "true", "GET", programme_url, "json", prog_data, prog_func);

    var unintact = false; //信息是否填写完整
    $('.programme_submit').click(function() {
        Loadings()
        unintact = false;
        //医院名称
        var hospital_data = {
            hospitalName: $('.hospital_name').val(),
            hospitalDec: $('select').val(),
            bedNum: $('.bed_num').val()
        };
        //联系人基本信息
        var programme_1 = {
            contact_people: $('.contact_people').val(),
            contact_phone: $('.contact_phone').val(),
            contact_email: $('.contact_email').val(),
        };
        //成立时间
        var programme_2 = $('#credit_time').val();
        //团队成员
        var programme_3 = $('.group_name').val();
        //亮点事项
        var programme_11 = $('#prog_txt').val();
        var programme_4 = table_msg_get('.select_4');
        var prog_data_submit = {
            "convention_id": convention_id,
            "uid": cook_uid,
            "type": 1,
            "file_id": file_id,
            "hospital_name": JSON.stringify(hospital_data),
            "contact": JSON.stringify(programme_1),
            "establishment": JSON.stringify(programme_2),
            "team_members": JSON.stringify(programme_3),
            "profession": JSON.stringify(programme_4),
            "training_status": JSON.stringify(table_msg_get('.select_5')),
            "article_author": JSON.stringify(table_msg_get('.select_6')),
            "part_time": JSON.stringify(table_msg_get('.select_7')),
            "thematic_report": JSON.stringify(table_msg_get('.select_8')),
            "monograph_list": JSON.stringify(table_msg_get('.select_9')),
            "Honor": JSON.stringify(table_msg_get('.select_10')),
            "highlight_event": programme_11
        }
        if (type_check === 'update' && fid > 0) {
            prog_data_submit.type = 2;
            prog_data_submit.fid = fid;
        }
        //检测信息填写是否完整
        check_request();
        if (unintact) {
            $('.newloading').remove();
            // showLaert('您的数据填写不完整，请补充提交内容再提交数据！(温馨提示：1、2、3、4和12为必填项)');
            return false;
        } else {
            ajax_all_Filed("true", "true", "POST", programme_url, "json", prog_data_submit, prog_func_submit);
        }

        function prog_func_submit(data) {
            $('.newloading').remove();
            showLaert(data.msg);
            setTimeout(function() {
                if (data.code == 413) {
                    window.location.href = "/login";
                } else {
                    window.location.reload();
                }
            }, 3000);
        }

    })

    //添加列表
    $('body').on('click', '.table_add', function() {
            var length = $(this).prev().find('th').length;
            var str = '<tr>'
            for (var i = 0; i < length; i++) {
                str += '<td><input type="text" value=""></td>'
            }
            str += '</tr>';
            $(this).prev().find('tbody').append(str)
        })
        //表单元素输入宽度自适应
    $('tbody').on('input', 'input', function() {
        var now_width = $(this).val().length * parseInt($(this).css('font-size'));
        var origin_width = parseInt($(this).css('width'));
        if (now_width > 160) {
            $(this).css('width', now_width);
        }
    })

    //layui文件上传
    layui.use('upload', function() {
        var $ = layui.jquery,
            upload = layui.upload;
        //指定允许上传的文件类型
        upload.render({
            elem: '#test3',
            url: '/upload',
            accept: 'file', //普通文件
            exts: 'zip|rar',
            before: function(obj) { //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
                Loadings()
            },
            done: function(res) {
                $('.newloading').remove();
                if (res.code == 200) {
                    $('#test3').hide();
                    showLaert('上传成功!');
                    file_id = res.data;
                } else {
                    this.error(index, upload);
                }
            },
            error: function() {
                showLaert('上传异常，请重新上传!')
            }
        });
    });

    //检测信息是否完整
    function check_request() {
        //医院名称
        //1.联系人信息
        //3.团队成员检测
        if (!$('.hospital_name').val() || !$('.contact_people').val() || !$('.contact_phone').val() || !$('.contact_email').val() || !$('.group_name').val() || !$('.bed_num').val() || !$('#credit_time').val() || !file_id) {
            unintact = true;
            if (!$('.hospital_name').val()) {
                showLaert('医院名称未填写！');
            }
            if (!$('.contact_people').val()) {
                showLaert('联系人未填写！');
            }
            if (!$('.contact_phone').val()) {
                showLaert('联系人电话未填写！');
            }
            if (!$('.contact_email').val()) {
                showLaert('联系人email未填写！');
            }
            if (!$('.group_name').val()) {
                showLaert('第3项未填写！');
            }
            if (!$('.bed_num').val()) {
                showLaert('床位数未填写！')
            }
            if (!$('#credit_time').val()) {
                showLaert('成立时间未填写！')
            }
        }
        if (!table_msg_get('.select_4') || !table_msg_get('.select_4').join()) {
            unintact = true;
        }
    }
    //获取table的信息返回一个数组
    function table_msg_get(selector) {
        var store_arr = [];
        //table的行tr
        for (var i = 0; i < $(selector + ' tbody tr').length; i++) {
            //存储table行的信息
            var check_arr = [];
            //tr的列td
            for (var j = 0; j < $(selector + ' table th').length; j++) {
                check_arr.push($(selector + ' table tbody tr').eq(i).find('td').eq(j).find('input').val())
            }
            var writed = false; //对应列是否填写信息
            var empty_cont = false; //对应列是否为空
            check_arr.forEach(function(val, index) {
                    //为空时
                    if (selector == '.select_4') {
                        if (!val) {
                            empty_cont = true;
                        } else {
                            writed = true;
                        }
                    }
                })
                //填写了没有空项就存储
            if (selector == '.select_4') {
                if (writed && !empty_cont) {
                    var obj = {};
                    check_arr.forEach(function(val, index) {
                        obj['programme' + index] = val;
                    })
                    store_arr.push(obj);
                }
            } else {
                var obj = {};
                check_arr.forEach(function(val, index) {
                    obj['programme' + index] = val;
                })
                store_arr.push(obj);
            }

            //填写了有空 提示用户补充填报信息
            if (writed && empty_cont) {
                unintact = true;
                for (var k = 0; k < check_arr.length; k++) {
                    if (!check_arr[k]) {
                        $('.select_4 table tbody tr').eq(i).find('td').eq(k).css({ border: '1px solid #f00' })
                    }
                }
                showLaert('第4项没有按照要求填写！请填写完整再提交！')
                return false;
            }
        }
        return store_arr;
    }

    //设置table的信息
    function table_msg_set(data_arr, selector) {
        //判断数据的长度是否大于table的tbody的行数 大于则添加至数据的长度
        if (data_arr.length > $(selector + ' tbody tr').length) {
            var str = '';
            for (var i = 0; i < data_arr.length - $(selector + ' tbody tr').length; i++) {
                str += '<tr>';
                for (var j = 0; j < $(selector + ' th').length; j++) {
                    str += '<td><input type="text" value=""></td>';
                }
                str += '</tr>';
            }
            $(selector + ' tbody').append(str)
        }
        //循环数据放入对应的列表
        for (var i = 0; i < data_arr.length; i++) {
            for (var j = 0; j < $(selector + ' table th').length; j++) {
                $(selector + ' table tbody tr').eq(i).find('td').eq(j).find('input').val(data_arr[i]['programme' + j]);
                if (data_arr[i]['programme' + j].length > 8) {
                    $(selector + ' table tbody tr').eq(i).find('td').eq(j).find('input').css('width', data_arr[i]['programme' + j].length * 20 + 'px');
                }
            }
        }
    }
})