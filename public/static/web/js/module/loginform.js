/**验证码代码
 * 生成一个随机数**/
function randomNum(min, max) {
	return Math.floor(Math.random() * (max - min) + min);
}
/**生成一个随机色**/
function randomColor(min, max) {
	var r = randomNum(min, max);
	var g = randomNum(min, max);
	var b = randomNum(min, max);
	return "rgb(" + r + "," + g + "," + b + ")";
}
/**绘制验证码图片**/
function drawPic() {
	var canvas = document.getElementById("canvas");
	var width = 120;
	var height = 39;
	//获取该canvas的2D绘图环境 
	var code = "";
	if(canvas != null) {
		var ctx = canvas.getContext('2d');
		ctx.textBaseline = 'bottom';
		/**绘制背景色**/
		ctx.fillStyle = randomColor(180, 240);
		//颜色若太深可能导致看不清
		ctx.fillRect(0, 0, width, height);
		/**绘制文字**/
		var str = 'ABCEFGHJKLMNPQRSTWXY123456789';

		//生成四个验证码
		for(var i = 1; i <= 4; i++) {
			var txt = str[randomNum(0, str.length)];
			code = code + txt;
			ctx.fillStyle = randomColor(50, 160);
			//随机生成字体颜色
			ctx.font = randomNum(15, 40) + 'px SimHei';
			//随机生成字体大小
			var x = 10 + i * 20;
			var y = randomNum(30, 30); //调试区域
			var deg = randomNum(-45, 45);
			//修改坐标原点和旋转角度
			ctx.translate(x, y);
			ctx.rotate(deg * Math.PI / 180);
			ctx.fillText(txt, 0, 0);
			//恢复坐标原点和旋转角度
			ctx.rotate(-deg * Math.PI / 180);
			ctx.translate(-x, -y);
		}

		/**绘制干扰线**/
		for(var i = 0; i < 3; i++) {
			ctx.strokeStyle = randomColor(40, 180);
			ctx.beginPath();
			ctx.moveTo(randomNum(0, width / 2), randomNum(0, height / 2));
			ctx.lineTo(randomNum(0, width / 2), randomNum(0, height));
			ctx.stroke();
		}
		/**绘制干扰点**/
		for(var i = 0; i < 50; i++) {
			ctx.fillStyle = randomColor(255);
			ctx.beginPath();
			ctx.arc(randomNum(0, width), randomNum(0, height), 1, 0, 2 * Math.PI);
			ctx.fill();
		}
	}
	return code;
}
//初始化验证码
verCode = drawPic();
var reflashCode = document.getElementById("reflashCode");
if(reflashCode != null) {
	document.getElementById("reflashCode").onclick = function(e) {
		e.preventDefault();
		verCode = drawPic();
	}
}

//密码验证  让其只能是 6位 纯数字的密码
function password_check() {
	var len = $("#passwordId").val().length;
	//var reg ="^([A-Z]|[a-z]|[0-9]|[`~!@#$%^&*()+=|{}':;',\\\\[\\\\].<>/?~！@#￥%……&*（）——+|{}【】‘；：”“'。，、？]){6,20}$"; //正则表达式 必须以数字开头和结尾  6-9位
	if(len < 6 || len == 0) {
		$("#passwordId").next().removeClass("yes").addClass("no");
		$(".error_txt").text("密码最少6位");
		/*alert("密码只能是6-9位数字");*/
		return false;
	} else {
		$("#passwordId").next().removeClass("no").addClass("yes");
		$(".error_txt").text("");
		/*  alert("验证成功");*/
		return true;
	}
	return true;
}
//手机验证
function mobile_check() {
	var reg = /^(13|14|15|16|17|18|19)\d{9}$/; //因为邮箱 xxx @ xxx . xxx     xxx 可以是 数字字母下划线 结束 可以 是 .com 或者 .com.cn
	if($("#mobile").val().search(reg) == -1) {
		$("#mobile").next().removeClass("yes").addClass("no");
		$(".error_txt").text("手机格式错误");
		/*alert("密码只能是6-9位数字");*/
		return false;
	} else {
		$("#mobile").next().removeClass("no").addClass("yes");
		$(".error_txt").text("");
		return true;
	}
	return true;
}

$("#passwordId").blur(password_check);
$("#mobile").blur(mobile_check);

function logins() {
	/* alert( typeof (zhanghao_yz() && password_check() && password_check2() && email_check() && mobile_check() && web_check()));
	 * 这里弹出 boolean 类型的值
	 * */
	if($("#passwordId").val() == "" || $("#mobile").val() == "") {
		$(".error_txt").text("账号密码不能为空！");
		return false;
	}
	if(!(password_check() && mobile_check())) { //只要有其中一项 返回值是 false 就会 进入 这个 语句
		$(".error_txt").text("");
		return false;
	} else {
		$(".error_txt").text("");
		return true;
	}
	return true;
}

//$("#login_btn").removeAttr("disabled"); 
//$("#login_btn").attr('disabled',"true");
$(function() {
	var loginurl = "/api/login/userlogin";
	$("#login_btn").attr('disabled', "true");
	$(".pos_input input").bind("input propertychange change", function(event) {
		if($("#mobile").val() == "" || $("#passwordId").val() == "" || $("#passwordId").val().length < 6) {
			$("#login_btn").attr('disabled', "true");
			$("#login_btn").removeClass("login_btn2").addClass("login_btn");
			return false;
		} else {
			$("#login_btn").removeAttr("disabled");
			$("#login_btn").removeClass("login_btn").addClass("login_btn2");

		}
	});
	var access_token = '';
	var user_infofid = '';
	var user_data = '';

	function setCookie() {
		var tel = $("#mobile").val();
		var pwd = ($("#passwordId").val());
		var cook_token = access_token;
		var cook_uid = user_infofid;
		$.cookie("tel", tel, {
			expires: 7
		}); //调用jquery.cookie.js中的方法设置cookie中的用户名    18952479780  123456
		$.cookie("pwd", pwd, {
			expires: 7
		});
		$.cookie("cook_token", cook_token, {
			expires: 7
		});
		$.cookie("cook_uid", cook_uid, {
			expires: 7
		});
	}
	$("#login_btn").click(function() {

		var tel = $("#mobile").val();
		var pwd = $("#passwordId").val();
		var yzm = $("#yzm").val();
		var reg = /^(13|14|15|16|17|18|19)\d{9}$/;
		if(tel.search(reg) == -1) {
			$(".error_txt").text("手机格式错误");
			return false;
		}
		if(yzm.toUpperCase() != verCode.toUpperCase()) {
			$(".error_txt").text("验证码错误");
			return false;
		}

		function login(data) {
			if(data.code == 200) {
				access_token = data.data.access_token;
				user_infofid = data.data.user_info.fid;
				setCookie()
				storage.setItem('user_info', JSON.stringify(data.data.user_info));

				$("#mobile").val('');
				$("#passwordId").val('');
				//跳转页面访问
				var backToPreUrl = window.location.href.split("preUrl=");
				window.location.href = backToPreUrl[1];
			} else if(data.code == 415) {
				$(".error_txt").text(data.msg);
			} else if(data.code == 414) {
				$(".error_txt").text(data.msg);
			}
		}
		var logindata = {
			"tel": tel,
			"password":$.md5(pwd),
			"imei": userAgent
		};
		ajax_all_Filed("true", "true", "POST", loginurl, "json", logindata, login); //调用函数
	})
	//回车提交
	$('#yzm').keyup(function(event) {
		if(event.keyCode == 13) {
			var tel = $("#mobile").val();
			var pwd = $("#passwordId").val();
			var yzm = $("#yzm").val();
			var reg = /^(13|14|15|16|17|18|19)\d{9}$/;
			if(tel.search(reg) == -1) {
				$(".error_txt").text("手机格式错误");
				return false;
			}
			if(yzm.toUpperCase() != verCode.toUpperCase()) {
				$(".error_txt").text("验证码错误");
				return false;
			}

			function login(data) {
				if(data.code == 200) {
					access_token = data.data.access_token;
					user_infofid = data.data.user_info.fid;
					setCookie()
					storage.setItem('user_info', JSON.stringify(data.data.user_info));

					$("#mobile").val('');
					$("#passwordId").val('');
					//window.location.href = '/';
					//跳转页面访问
					var backToPreUrl=window.location.href.split("preUrl=");
					if(backToPreUrl!=""||backToPreUrl!=null){
						window.location.href=backToPreUrl[1];
					}else{
						window.location.href='/';
					}

				} else if(data.code == 415) {
					$(".error_txt").text(data.msg);
				} else if(data.code == 414) {
					$(".error_txt").text(data.msg);
				}
			}
			var logindata = {
				"tel": tel,
				"password": $.md5(pwd),
				"imei": userAgent
			};
			ajax_all_Filed("true", "true", "POST", loginurl, "json", logindata, login); //调用函数
		}
	});
})