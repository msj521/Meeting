//账号验证
function zhanghao_yz() {
	var reg = /^[A-Za-z]\w+$/; //正则表达式 必须以字母开头的账号
	if($("#account").val().search(reg) == -1) {
		$("#account").next().html("账号必须是以 字母开头的 可以包含数字字母下划线的字符串");

		/*alert("密码只能是6-9位数字");*/
		return false;
	} else {
		$("#account").next().html("账号验证成功");
		/*  alert("验证成功");*/
		return true;
	}
	return true;
}
//密码验证  让其只能是 6位 纯数字的密码
function password_check() {
	var reg = /^\d{6,9}$/; //正则表达式 必须以数字开头和结尾  6-9位
	if($("#passwordId").val().search(reg) == -1) {
		$("#passwordId").next().html("密码只能是6-9位数字");
		/*alert("密码只能是6-9位数字");*/
		return false;
	} else {
		$("#passwordId").next().html("密码验证成功");
		/*  alert("验证成功");*/
		return true;
	}
	return true;
}

function password_check2() {
	var reg = /^\d{6,9}$/;
	if($("#passwordId2").val().search(reg) == -1) {
		$("#passwordId2").next().html("密码只能是6-9位数字");
		/*alert("密码只能是6-9位数字");*/
		return false;
	} else {
		if($("#passwordId").val() !== $("#passwordId2").val()) {
			$("#passwordId2").next().html("两次输入的密码不相同");
			return false;
		} else {
			$("#passwordId2").next().html("密码确认成功");
			return true;
		}
	}
	return true;
}

//邮箱验证
function email_check() {
	var reg = /^\w+@\w+(\.\w+){1,2}$/; //因为邮箱 xxx @ xxx . xxx     xxx 可以是 数字字母下划线 结束 可以 是 .com 或者 .com.cn
	if($("#emailId").val().search(reg) == -1) {
		$("#emailId").next().html("邮箱格式不正确 xxx @ xxx . xxx");
		/*alert("密码只能是6-9位数字");*/
		return false;
	} else {
		$("#emailId").next().html("邮箱验证成功");
		return true;
	}
	return true;
}

//手机验证
function mobile_check() {
	var reg = /^(13|15|17|18|19)\d{9}$/; //因为邮箱 xxx @ xxx . xxx     xxx 可以是 数字字母下划线 结束 可以 是 .com 或者 .com.cn
	if($("#mobile").val().search(reg) == -1) {
		$("#mobile").next().html("手机格式不正确 应该是 1 （3|5|7|8）xxx xxx xxx  总共11位的纯数字");
		/*alert("密码只能是6-9位数字");*/
		return false;
	} else {
		$("#mobile").next().html("手机验证成功");
		return true;
	}
	return true;
}

//网站验证
function web_check() {
	var eg3 = /^http:\/\/www\..+?(\.\w+){1,2}$/g;
	var str = $("#web").val();
	if(str.search(eg3) !== -1) //找到了  就 不等于 -1了
	{
		$("#web").next().html("网站验证正确");
		return true;
	} else {
		$("#web").next().html("注意网站的书写格式");
		return false;
	}
	return true;
}
$("#account").blur(zhanghao_yz);
$("#passwordId").blur(password_check);
$("#passwordId2").blur(password_check2);
$("#emailId").blur(email_check);
$("#mobile").blur(mobile_check);
$("#web").blur(web_check);

function tijiao() {
	/* alert( typeof (zhanghao_yz() && password_check() && password_check2() && email_check() && mobile_check() && web_check()));
	 * 这里弹出 boolean 类型的值
	 * */
	if($("#account").val() == "" || $("#passwordId").val() == "" || $("#name_shengao").val() == "" || $("#emailId").val() == "" || $("#mobile").val() == "" || $("#wangzhan").val() == "") {
		$("#reset").next().html("看看你是不是填完了");
		return false;
	}
	if(!(zhanghao_yz() && password_check() && password_check2() && email_check() && mobile_check() && web_check())) { //只要有其中一项 返回值是 false 就会 进入 这个 语句
		$("#reset").next().html("上面的验证都通过了吗？");
		return false;
	} else {
		$("#reset").next().html("好的 验证通过了。");
		return true;
	}
	return true;
}
$("#myform").submit(function() {
	return tijiao();
});
$("#login_btn").click(function() {
	return tijiao();
});