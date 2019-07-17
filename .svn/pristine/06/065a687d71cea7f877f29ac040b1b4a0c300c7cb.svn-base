$(function() {
	var forgeturl = "/api/login/update_pwd";
	var sendcodeurl = "api/login/send_code" //验证码

	//密码验证  
	function password_check() {
		//var reg = /^\d{6,9}$/; //正则表达式 必须以数字开头和结尾  6-9位
		var reg = /^[A-Za-z]+[0-9]+[A-Za-z0-9]*|[0-9]+[A-Za-z]+[A-Za-z0-9]*$/g;
		var password1=$("#password").val();
		if(password1=="" || password1.length<6) {
			$("#password").next().removeClass("yes2").addClass("no2");
			$("#password").next().html("密码至少6位");
			return false;
		} else {
			$("#password").next().removeClass("no2").addClass("yes2");
			$("#password").next().html("");
			/*  alert("验证成功");*/
			return true;
		}
		return true;
	}

	function password_check2() {
		//var reg = /^\d{6,9}$/;
		var reg = /^[A-Za-z]+[0-9]+[A-Za-z0-9]*|[0-9]+[A-Za-z]+[A-Za-z0-9]*$/g;
		var password2=$("#password2").val();
		var password=$("#password").val();
		if(password2=="" || password2.length<6) {
			$("#password2").next().removeClass("yes2").addClass("no2");
			$("#password2").next().html("密码至少6位");
			/*alert("密码只能是6-9位数字");*/
			return false;
		} else {
			if(password2 !== password) {
				$("#password2").next().removeClass("yes2").addClass("no2");
				$("#password2").next().html("两次输入的密码不相同！");
				return false;
			} else {
				$("#password2").next().removeClass("no2").addClass("yes2");
				$("#password2").next().html("");
				return true;
			}
		}
		return true;
	}

	//手机验证
	function mobile_check() {
		var reg = /^(13|14|15|16|17|18|19)\d{9}$/;
		if($("#tel").val().search(reg) == -1) {
			$("#tel").next().removeClass("yes2").addClass("no2");
			$("#tel").next().html("手机格式不正确");
			return false;
		} else {
			$("#tel").next().removeClass("no2").addClass("yes2");
			$("#tel").next().html("");
			return true;
		}
		return true;
	}
	//验证ma
	function message_check() {
		var reg = /^\d{6,9}$/;
		if($("#message").val().search(reg) == -1) {
			$("#yzm_btn").next().removeClass("yes2").addClass("no2");
			$("#yzm_btn").next().html("验证码必须6位");
			return false;
		} else {
			$("#yzm_btn").next().removeClass("no2").addClass("yes2");
			$("#yzm_btn").next().html("");
			return true;
		}
		return true;
	}

	$("#tel").blur(mobile_check);
	$("#password").blur(password_check);
	$("#password2").blur(password_check2);
	$("#message").blur(message_check);
	/*手机为空验证码禁用*/
	$("#yzm_btn").attr('disabled', "true");
	$("#tel").bind("input propertychange change", function(event) {
		if($("#tel").val() == "" || $("#tel").val().length < 11) {
			$("#yzm_btn").attr('disabled', "true");
			$("#yzm_btn").removeClass("yzm_btn").addClass("yzm_btn2");
		} else {
			$("#yzm_btn").removeAttr("disabled");
		}
	})
	var countdown = 60;

	function settime(obj) {

		if(countdown == 0) {
			obj.removeAttribute("disabled");
			$("#yzm_btn").removeClass("yzm_btn")
			$("#yzm_btn").addClass("yzm_btn2");
			obj.value = "免费获取验证码";
			countdown = 60;
			return;
		} else {
			obj.setAttribute("disabled", true);
			$("#yzm_btn").removeClass("yzm_btn2");
			$("#yzm_btn").addClass("yzm_btn");
			obj.value = "重新发送(" + countdown + ")";
			countdown--;
		}
		setTimeout(function() {
			settime(obj)
		}, 1000)
	}
	$("#yzm_btn").click(function() {
		var tel = $("#tel").val(); //手机号
		function sendcode(data) {
			if(data.code == 200) {
				alert(data.msg)
			} else if(data.code == 419) {
				alert(data.msg);
			}
		}
		var data = {
			"tel": tel
		};
		ajax_all_Filed("true", "true", "POST", sendcodeurl, "json", data, sendcode); //调用函数
	})
	$("#forget_btn").attr('disabled', "true");
	$(".ret_input").bind("input propertychange change", function(event) {
		var password=$("#password").val();
		var password2=$("#password2").val();
		if($("#tel").val() == "" || password == "" || password.length < 6 || password2 == "" || password2.length < 6 || $("#message") == "") {
			$("#forget_btn").attr('disabled', "true");
			$("#forget_btn").removeClass("retrieve_btn2").addClass("retrieve_btn");
			return false;
		} else {
			$("#forget_btn").removeAttr("disabled");
			$("#forget_btn").removeClass("retrieve_btn").addClass("retrieve_btn2");
		}
	});
	$("#forget_btn").click(function() {
		var password2=$("#password2").val();
		var tel = $("#tel").val(); //手机号
		var password = password2; //用户密码
		var message = $("#message").val(); //验证码
		function forgetpwd(data) {
			if(data.code == 200) {
				showLaert(data.msg);
				window.location.href = "/login";
			}else{
				showLaert(data.msg);
				return false;
			}
		}
		var data = {
			"tel": tel,
			"password":$.md5(password),
			"message": message,
		};
		ajax_all_Filed("true", "true", "POST", forgeturl, "json", data, forgetpwd); //调用函数		
	})

})