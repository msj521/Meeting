$(function() {
    //报名列表接口
    var conventionurl = "/api/user/sign_convention";
    //删除报名接口
    var ct_delete = "/api/user/delete";
    //
    var ct_deletess = "/api/convention/certificate";
    var page = 1;
    var pagesize = 6;
    if (cook_uid == null) {
        window.location.href = "/login";
        return false;
    }

    function conventionlist(data) {
        if (data.code == 414) {
            return false;
        }

        var convention = data.data.data;
        if (convention.length > 0) {
            $(".shoplist").css("display", "block")
            var str = "";
            for (var i = 0; i < convention.length; i++) {
                var status = "";
                switch (convention[i].pay_status) {
                    case 1:
                        status = "未支付";
                        break;
                    case 2:
                        status = "报名成功";
                        break;
                    default:
                        status = "报名失败";
                        break;
                }
                str += '<li>';
                str += '<div class="shop_title">';
                str += '<div class="shop_lt_t">会议分类</div>';
                str += '<div class="shop_ct_c">注册编号：<span>2019T0' + cook_uid + '</span></div><div class="shop_rg_t">';
                if (convention[i].draft > 0) {
                    str += '<a href="/abstract_list?convention_id=' + convention[i].convention_id + '" style="color: #239397;">已投稿</a>&nbsp;&nbsp;'
                } else {
                    str += '<a href="/abstract_list?convention_id=' + convention[i].convention_id + '" style="color: #239397;">未投稿</a>&nbsp;&nbsp;'
                }
                if (convention[i].certificate == 1) {
                    str += '<a href="http://sific.vip/api/convention/certificate?test=123&uid=' + cook_uid + '&convention_id=' + convention[i].convention_id + '" style="color: #239397;">下载证书</a>'
                }
                if (convention[i].tax_num == null || convention[i].tax_num == "") {
                    if (convention[i].pay_status == 2) {
                        str += '<a href="/ip_fapiao?convention_id=' + convention[i].convention_id + '" style="margin-left: 10px; margin-right: 10px; color: #239397;" >申请发票</a>';
                    }
                } else {
                    if (convention[i].bill_status == 1) {
                        str += '<a href="javascript:void(0)" style="margin-left: 10px; margin-right: 10px; color: #239397;" >开票中</a>';
                    } else {
                        str += '<a href="javascript:void(0)" style="margin-left: 10px; margin-right: 10px; color: #239397;" id="yifapiao">发票已开(' + convention[i].official_invoice + ')</a>';
                    }
                    //str += '<a href="javascript:void(0)" style="margin-left: 10px; margin-right: 10px; color: #239397;" id="yifapiao">发票已申请</a>';
                }



                str += '<button class="bbtns" value="' + convention[i].convention_id + '">';
                str += '<span class="glyphicon glyphicon-trash"></span>';
                str += '</button></div>';
                str += '</div>';
                str += '<div class="shop_ct">';
                str += '<div class="shop_lt_tc">';
                str += '<a href="annual_meeting?convention_id=' + convention[i].convention_id + '"><img src="' + convention[i].web_image_url + '" /></a>';
                str += '</div>';
                str += '<div class="shop_ct_tc">';
                if (getNowTime() > setFutureTime(2019, 4, 27, 17, 0, 0)) {
                    if (convention[i].pay_status == 2) {
                        str += '<div class="shoptle ellipsis"><a href="annual_meeting?convention_id=' + convention[i].convention_id + '">' + convention[i].convention_name + '</a></div>';
                    } else {
                        str += '<div class="shoptle ellipsis"><a href="/newsinfo?convention_id=47&news_id=36">' + convention[i].convention_name + '</a></div>';
                    }
                } else {
                    str += '<div class="shoptle ellipsis"><a href="annual_meeting?convention_id=' + convention[i].convention_id + '">' + convention[i].convention_name + '</a></div>';
                }
                str += '<p>时间：' + convention[i].update_time + '</p>';
                str += '</div>';
                str += '<div class="shop_ct_tc2" style="font-size: 15px; color: #F45C0C;font-weight:bold">¥' + convention[i].price + '</div>';
                if (status == "报名成功") {
                    str += '<div class="shop_rg_tc" style="color:#555555">' + status + '</div>';
                } else if (status == "未支付") {
                    str += '<div class="shop_rg_tc"><input type="botton" class="fuk_btn" value="付款" style="text-align:center;background:#232323;border-radius:5px;cursor:pointer"/></div>';
                }
                str += '</div>';
                str += '</li>';
            }
            $("#meeting_name").append(str)

            //			$("#yifapiao").click(function(){
            //				showLaert('确定删除吗？')
            //			})

        } else {
            $(".null_div").css("display", "block")
        }
        $("#pagination").pagination({
            currentPage: page,
            totalPage: Math.ceil(data.data.total / pagesize),
            isShow: false,
            count: Math.ceil(data.data.total / pagesize) <= 10 ? Math.ceil(data.data.total / pagesize) : 10,
            homePageText: "首页",
            endPageText: "尾页",
            prevPageText: "上一页",
            nextPageText: "下一页",
            callback: function(current) {
                $("#meeting_name li").remove();
                page = current;
                var data = {
                    "page": page,
                    "pagesize": pagesize,
                    "uid": cook_uid
                };
                ajax_all_Filed("true", "true", "POST", conventionurl, "json", data, conventionlist); //调用函数
            }
        });
        //付款
        $(".fuk_btn").click(function() {
            if (getNowTime() > setFutureTime(2019, 4, 27, 17, 0, 0)) {
                window.location.href = "/newsinfo?convention_id=47&news_id=36"
            } else {
                window.location.href = "/annual_meeting_payment"
            }
        })

        //删除当前会议报名信息
        var convention_idss = "";
        $('.bbtns').on('click', function() {
            showLaert('确定删除吗？');
            convention_idss = $(this).val();

        });
        $("body").on('click', '#alert_btn', function() {
            function ctdelete(data) {
                if (data.code == 200) {
                    showLaert(data.msg);
                    location.reload()
                }
            }
            var data = {
                "uid": cook_uid,
                "convention_id": convention_idss,
                "type": "signconvention"
            };
            ajax_all_Filed("true", "true", "POST", ct_delete, "json", data, ctdelete); //调用函数
        })

    }
    var data = {
        "page": page,
        "pagesize": pagesize,
        "uid": cook_uid
    };
    ajax_all_Filed("true", "true", "POST", conventionurl, "json", data, conventionlist); //调用函数
})