var emailStr = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/; //邮箱验证
var cardStr = /^(\d{7}(\d|X|x)|\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/; //身份证验证
var telStr = /^(13|14|15|17|18|19)\d{9}$/; //手机表达式
//姓名验证
function user_name() {
    if ($("#user_name").val() == "") {
        $("#user_name").next().removeClass("annual_tips_ys").addClass("annual_tips_no");
        $("#user_name").next().html("姓名不能为空！");
        return false;
    } else {
        $("#user_name").next().removeClass("annual_tips_no").addClass("annual_tips_ys");
        $("#user_name").next().html("");
        return true;
    }
    return true;
}
//出生年月验证
function credit_time() {
    if ($("#credit_time").val() == "") {
        $("#credit_time").next().removeClass("annual_tips_ys").addClass("annual_tips_no");
        $("#credit_time").next().html("请选择出生年月！");
        return false;
    } else {

        $("#credit_time").next().removeClass("annual_tips_no").addClass("annual_tips_ys");
        $("#credit_time").next().html("");
        return true;
    }
    return true;
}
//毕业时间验证
function graduation_time() {
    if ($("#graduation_time").val() == "") {
        $("#graduation_time").next().removeClass("annual_tips_ys").addClass("annual_tips_no");
        $("#graduation_time").next().html("请选择毕业时间！");
        return false;
    } else {
        $("#graduation_time").next().removeClass("annual_tips_no").addClass("annual_tips_ys");
        $("#graduation_time").next().html("");
        return true;
    }
    return true;
}
//地址验证
function unit_address() {
    if ($("#unit_address").val() == "") {
        $("#unit_address").next().removeClass("annual_tips_ys").addClass("annual_tips_no");
        $("#unit_address").next().html("单位地址不能为空！");
        return false;
    } else {
        $("#unit_address").next().removeClass("annual_tips_no").addClass("annual_tips_ys");
        $("#unit_address").next().html("");
        return true;
    }
    return true;
}

//传真验证
function unit_fax() {
    if ($("#unit_fax").val() == "" || $("#unit_fax_guo").val() == "" || $("#unit_fax_qu").val() == "" || $("#unit_fax").val().length > 8 || $("#unit_fax").val().length < 7) {
        $("#unit_fax_tips").removeClass("annual_tips_ys").addClass("annual_tips_no");
        $("#unit_fax_tips").html("传真号不能为空或请填写完整！");
        return false;
    } else {
        $("#unit_fax_tips").removeClass("annual_tips_no").addClass("annual_tips_ys");
        $("#unit_fax_tips").html("");
        return true;
    }
    return true;
}


//单位电话号验证
function unit_tel() {
    if ($("#unit_tel").val() == "" || $("#unit_tel_qu").val() == "" || $("#unit_tel_guo").val() == "" || $("#unit_tel").val().length > 8 || $("#unit_tel").val().length < 7) {
        $("#unit_tel_tips").removeClass("annual_tips_ys").addClass("annual_tips_no");
        $("#unit_tel_tips").html("电话号不能为空或请填写完整！");
        return false;
    } else {
        $("#unit_tel_tips").removeClass("annual_tips_no").addClass("annual_tips_ys");
        $("#unit_tel_tips").html("");
        return true;
    }
    return true;
}
//身份证验证
function card() {
    if ($("#card").val().search(cardStr) == -1 || $("#card").val() == "") {
        $("#card").next().removeClass("annual_tips_ys").addClass("annual_tips_no");
        $("#card").next().html("身份证号不能为空或格式错误！");
        return false;
    } else {
        $("#card").next().removeClass("annual_tips_no").addClass("annual_tips_ys");
        $("#card").next().html("");
        return true;
    }
    return true;
}

//地址验证
function unit_address() {
    if ($("#unit_address").val() == "") {
        $("#unit_address").next().removeClass("annual_tips_ys").addClass("annual_tips_no");
        $("#unit_address").next().html("单位地址不能为空！");
        return false;
    } else {
        $("#unit_address").next().removeClass("annual_tips_no").addClass("annual_tips_ys");
        $("#unit_address").next().html("");
        return true;
    }
    return true;
}
//邮箱验证
function email_check() {
    if ($("#email").val().search(emailStr) == -1 || $("#email").val() == "") {
        $("#email").next().removeClass("annual_tips_ys").addClass("annual_tips_no");
        $("#email").next().html("邮箱不能为空或格式错误");
        return false;
    } else {
        $("#email").next().removeClass("annual_tips_no").addClass("annual_tips_ys");
        $("#email").next().html("");
        return true;
    }
    return true;
}

//手机验证
function mobile_check() {
    if ($("#tel").val().search(telStr) == -1 || $("#tel").val() == "" || $("#tel_qu").val() == "") {
        $("#tel_tips").removeClass("annual_tips_ys").addClass("annual_tips_no");
        $("#tel_tips").html("手机号和区号不能为空或格式错误");
        return false;
    } else {
        $("#tel_tips").removeClass("annual_tips_no").addClass("annual_tips_ys");
        $("#tel_tips").html("");
        return true;
    }
    return true;
}
//入会时间验证
function start_time() {
    if ($("#start_time").val() == 0) {
        $("#start_time").next().removeClass("annual_tips_ys").addClass("annual_tips_no");
        $("#start_time").next().html("请选择入会时间！");
        return false;
    } else {
        $("#start_time").next().removeClass("annual_tips_no").addClass("annual_tips_ys");
        $("#start_time").next().html("");
        return true;
    }
    return true;
}
//离开时间验证
function end_time() {
    if ($("#end_time").val() == 0) {
        $("#end_time").next().removeClass("annual_tips_ys").addClass("annual_tips_no");
        $("#end_time").next().html("请选择离开时间！");
        return false;
    } else {
        $("#end_time").next().removeClass("annual_tips_no").addClass("annual_tips_ys");
        $("#end_time").next().html("");
        return true;
    }
    return true;
}
$("#user_name").blur(user_name);
$("#credit_time").blur(credit_time);
$("#email").blur(email_check);
$("#tel").blur(mobile_check);
$("#unit_address").blur(unit_address);
$("#card").blur(card);
$("#unit_tel").blur(unit_tel);
$("#unit_fax").blur(unit_fax);
$("#graduation_time").blur(graduation_time);
$("#start_time").blur(start_time);
$("#end_time").blur(end_time);

//公共时间控件触发
function pcredit_time(id) {
    if ($(id).val() == "") {
        $(id).next().removeClass("annual_tips_ys").addClass("annual_tips_no");
        $(id).next().html("请选择时间！");
        return false;
    } else {
        $(id).next().removeClass("annual_tips_no").addClass("annual_tips_ys");
        $(id).next().html("");
        return true;
    }
    return true;
}


//学分验证
function credit_status() {
    if ($("#credit_status").val() == 0) {
        $("#credit_status").next().removeClass("annual_tips_ys").addClass("annual_tips_no");
        $("#credit_status").next().html("请选择是否需要学分！");
        return false;
    }
}

//职称验证
function gender() {
    if ($("#gender").val() == 0) {
        $("#gender").next().removeClass("annual_tips_ys").addClass("annual_tips_no");
        $("#gender").next().html("请选择称谓！");
        return false;
    }
}

//职位验证
function job_id() {
    if ($("#job_id").val() == 0) {
        $("#job_id").next().removeClass("annual_tips_ys").addClass("annual_tips_no");
        $("#job_id").next().html("请选择职位！");
        return false;
    }
}

//部门/科室验证
function deparitment() {
    if ($("#deparitment").val() == 0) {
        $("#deparitment").next().removeClass("annual_tips_ys").addClass("annual_tips_no");
        $("#deparitment").next().html("请选择部门/科室！");
        return false;
    }
}

//职称1验证
function credit_type() {
    if ($("#credit_type").val() == 0) {
        $("#credit_type").next().removeClass("annual_tips_ys").addClass("annual_tips_no");
        $("#credit_type").next().html("请选择职称级别！");
        return false;
    }
}

//是否来自基层验证
function basic_level() {
    if ($("#basic_level").val() == "") {
        $("#basic_level").next().removeClass("annual_tips_ys").addClass("annual_tips_no");
        $("#basic_level").next().html("请选择是否来自基层！");
        return false;
    }
}
//最高学历验证
function education_id() {
    if ($("#education_id").val() == 0) {
        $("#education_id").next().removeClass("annual_tips_ys").addClass("annual_tips_no");
        $("#education_id").next().html("请选择学历！");
        return false;
    }
}
//学位验证
function degree_id() {
    if ($("#degree_id").val() == 0) {
        $("#degree_id").next().removeClass("annual_tips_ys").addClass("annual_tips_no");
        $("#degree_id").next().html("请选择学位！");
        return false;
    }
}
//省份验证
function province_id() {
    if ($("#province_id").val() == 0 || $("#province_id").val() == "" || $("#city_id").val() == 0 || $("#city_id").val() == "") {
        $("#ss_tilps").removeClass("annual_tips_ys").addClass("annual_tips_no");
        $("#ss_tilps").html("请选择省/市！");
        return false;
    }
}
$('#province_id').change(function() {
        if ($(this).val() != 0 || $(this).val() != "") {
            $(this).next().next().removeClass("annual_tips_no").addClass("annual_tips_ys");
            $(this).next().next().html("");
            return true;
        }
    })
    //市点击消除
$('#city_id').change(function() {
    if ($(this).val() != 0 || $(this).val() != "") {
        $(this).next().removeClass("annual_tips_no").addClass("annual_tips_ys");
        $(this).next().html("");
        return true;
    }
})


//通用
$('.pulic_select').change(function() {
    if ($(this).val() != 0 || $(this).val() != "") {
        $(this).next().removeClass("annual_tips_no").addClass("annual_tips_ys");
        $(this).next().html("");
        return true;
    }
})

//获取数据验证
function get_annualbtn_tips() {
    if ($("#email").val() == "" || $("#email").val().search(emailStr) == -1) {
        showLaert("邮箱不能为空或填写错误！");
        email_check();
        return;
    }
    if ($("#user_name").val() == "") {
        showLaert("姓名不能为空！");
        user_name();
        return;
    }
}
//下一步验证
function annualbtn_tips() {

    if ($("#email").val() == "" || $("#email").val().search(emailStr) == -1) {
        showLaert("邮箱不能为空或填写错误！");
        email_check();
        return false;
    }

    if ($("#user_name").val() == "") {
        showLaert("姓名不能为空！");
        user_name();
        return false;
    }
    if ($("#credit_status").val() == 0) {
        showLaert("请选择是否需要学分！");
        credit_status()
        return false;
    }
    if ($("#credit_time").val() == "") {
        showLaert("请选择出生年月！");
        credit_time();
        return false;
    }
    if ($("#gender").val() == 0) {
        showLaert("请选择你的称谓！");
        gender();
        return false;
    }
    if ($("#job_id").val() == 0) {
        showLaert("请选择你的职位！");
        job_id();
        return false;
    }
    if ($("#deparitment").val() == 0) {
        showLaert("请选择你的部门科室！");
        deparitment();
        return false;
    }
    if ($("#credit_type").val() == 0) {
        showLaert("请选择职称级别！");
        credit_type();
        return false;
    }
    if ($("#basic_level").val() == "") {
        showLaert("是否来自基层请选择！");
        basic_level();
        return false;
    }
    if ($("#graduation_time").val() == "") {
        showLaert("请选择毕业时间！");
        graduation_time();
        return false;
    }
    if ($("#education_id").val() == 0) {
        showLaert("请选择学历！");
        education_id();
        return false;
    }
    if ($("#degree_id").val() == 0) {
        showLaert("请选择学位！");
        degree_id();
        return false;
    }
    if ($("#province_id").val() == 0) {
        showLaert("请选择省！");
        province_id();
        return false;
    }
    if ($("#city_id").val() == 0) {
        showLaert("请选择市！");
        province_id();
        return false;
    }

    if ($("#unit_address").val() == 0) {
        showLaert("企业地址不能为空！");
        unit_address()
        return false;
    }

    if ($("#card").val() == "" || $("#card").val().search(cardStr) == -1) {
        showLaert("身份证不能为空或填写错误！");
        card();
        return false;
    }
    if ($("#unit_tel_guo").val() == "") {
        showLaert("企业电话国号不能为空！");
        unit_tel();
        return false;
    }
    if ($("#unit_tel_qu").val() == "") {
        showLaert("企业电话区号不能为空！");
        unit_tel();
        return false;
    }
    if ($("#unit_tel").val() == "") {
        showLaert("企业电话不能为空！");
        unit_tel();
        return false;
    }
    if ($("#unit_fax_guo").val() == "") {
        showLaert("传真国号不能为空！");
        unit_fax();
        return false;
    }
    if ($("#unit_fax_qu").val() == "") {
        showLaert("传真区号不能为空！");
        unit_fax();
        return false;
    }
    if ($("#unit_fax").val() == "") {
        showLaert("企业传真不能为空！");
        unit_fax();
        return false;
    }
    if ($("#tel_qu").val() == "") {
        showLaert("手机区号不能为空！");
        return false;
    }
    if ($("#tel").val() == "" || $("#tel").val().search(telStr) == -1) {
        showLaert("手机号码不能为空或填写错误！");
        //mobile_check();
        return false;
    }
}
//最后验证
function total_btn() {
    if ($("#start_time").val() == 0) {
        showLaert("请选择到会时间！");
        start_time();
        return false;
    }

    if ($("#end_time").val() == 0) {
        showLaert("请选择离开时间！");
        end_time();
        return false;
    }
}