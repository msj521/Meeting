	var selectinfo = "/api/login/baseinfo"
	var org_list = "/api/login/org_list"; //医院接口
	var sendcodeurl = "api/login/send_code" //验证码
	var regurl = "api/login/register";
	//姓名验证
	function zhanghao_yz() {
		//var reg = /^[A-Za-z]\w+$/; //正则表达式 必须以字母开头的账号
		//var reg =/^[\u2E80-\u9FFF]+$/;//只输入汉字
		var reg = '^[a-zA-Z0-9_\u4e00-\u9fa5]+$';
		if($("#user_name").val().search(reg) == -1 || $("#user_name").val() == "") {
			$("#user_name").next().removeClass("yes2").addClass("no2");
			$("#user_name").next().html("姓名不能为空！");
			return false;
		} else {
			$("#user_name").next().removeClass("no2").addClass("yes2");
			$("#user_name").next().html("");
			return true;
		}
		return true;
	}
	//密码验证  
	function password_check() {
		//var reg = /^\d{6,9}$/; //正则表达式 必须以数字开头和结尾  6-9位
		//var reg = /^[A-Za-z]+[0-9]+[A-Za-z0-9]*|[0-9]+[A-Za-z]+[A-Za-z0-9]*$/g;
		if($("#password").val().length < 6) {
			$("#password").next().removeClass("yes2").addClass("no2");
			$("#password").next().html("密码必须至少6位");
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
		//var reg = /^[A-Za-z]+[0-9]+[A-Za-z0-9]*|[0-9]+[A-Za-z]+[A-Za-z0-9]*$/g;
		if($("#password2").val().length <6) {
			$("#password2").next().removeClass("yes2").addClass("no2");
			$("#password2").next().html("密码必须至少6位");
			/*alert("密码只能是6-9位数字");*/
			return false;
		} else {
			if($("#password2").val() !== $("#password").val()) {
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
		var tel = $("#tel").val();
		if(tel.search(reg) == -1) {
			$("#tel").next().removeClass("yes2").addClass("no2");
			$("#tel").next().html("手机格式不正确");
			return false;
		} else {
			$("#tel").next().removeClass("no2").addClass("yes2");
			$("#tel").next().html("");
			function register(data) {
				if(data.code == 415) {
					showLaert(data.msg)
					$("body").on('click', '#alert_btn', function() {
						window.location.href = "/login";
					})
				}
			}
			var data = {"tel": tel};
			ajax_all_Filed("true", "true", "POST", regurl, "json", data, register); //调用函数	
			
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
	//验证email
	function email_check() {
		var reg = /^[A-Za-z\d]+([-_.][A-Za-z\d]+)*@([A-Za-z\d]+[-.])+[A-Za-z\d]{2,4}$/;
		if($("#email").val().search(reg) == -1) {
			$("#email").next().removeClass("yes2").addClass("no2");
			$("#email").next().html("请填写正确的email格式");
			return false;
		} else {
			$("#email").next().removeClass("no2").addClass("yes2");
			$("#email").next().html("");
			return true;
		}
		return true;
	}

	$("#tel").blur(mobile_check);
	$("#password").blur(password_check);
	$("#password2").blur(password_check2);
	$("#user_name").blur(zhanghao_yz);
	$("#message").blur(message_check);
	$("#email").blur(email_check);
	/*手机为空验证码禁用*/
	$("#yzm_btn").attr('disabled', "true");
	$("#tel").bind("input propertychange change", function(event) {
		if($("#tel").val() == "" || $("#tel").val().length < 11) {
			$("#yzm_btn").attr('disabled', "true");
			$("#yzm_btn").removeClass("yzm_btn2").addClass("yzm_btn");
		} else {
			$("#yzm_btn").removeAttr("disabled");
			$("#yzm_btn").removeClass("yzm_btn").addClass("yzm_btn2");
		}
	})

	$("#yzm_btn").click(function() {
		var tel = $("#tel").val(); //手机号
		function sendcode(data) {
			if(data.code == 200) {
				showLaert(data.msg)
			} else {
				showLaert(data.msg)
			}
		}
		var data = {
			"tel": tel
		};
		ajax_all_Filed("true", "true", "POST", sendcodeurl, "json", data, sendcode); //调用函数

	})

	//获取下拉数据
	function selectinfos(data) {
		var credit_type = data.data.credit_type;//职称1
		var job_list = data.data.job_list;
		var education_list = data.data.education_list;
		var region_list = data.data.region_list;
		var department  = data.data.department//部门科室
		//部门科室
			var departmenttr ="";
			for(var i = 0; i < department.length; i++) {
				departmenttr += '<option value="'+department[i].fid+'">';
				departmenttr += department[i].class_name_zh;
				departmenttr += '</option>';
			}
			$("#deparitment").append(departmenttr);
		//学历
		var str = "";
		for(var i = 0; i < education_list.length; i++) {
			str += '<option value="'
			str += education_list[i].fid;
			str += '"';
			str += '>';
			str += education_list[i].class_name_zh;
			str += '</option>';

		}
		$("#education_id").append(str);
		//职称获取
//		var org = "";
//		for(var i = 0; i < job_list.length; i++) {
//			org += '<option value="'
//			org += job_list[i].fid;
//			org += '"';
//			org += '>';
//			org += job_list[i].class_name_zh;
//			org += '</option>';
//
//		}
//		$("#job_id").append(org);
		var credit ="";
			for(var i = 0; i < credit_type.length; i++) {
				credit += '<option value="'+credit_type[i].fid+'">';
				credit += credit_type[i].class_name_zh;
				credit += '</option>';
	
			}
			$("#credit_type").append(credit);

		//省
		var shen = "";
		for(var i = 0; i < region_list.length; i++) {
			shen += '<option value="'
			shen += region_list[i].fid;
			shen += '"';
			shen += '>';
			shen += region_list[i].region_name;
			shen += '</option>';

		}
		$("#region_s").append(shen);
		$("#region_s").change(function() {
			var now_province = $(this).val();
			$("#region_ss").html('<option value="">请选择城市</option>');
			for(var i = 0; i < region_list.length; i++) {
				if(region_list[i].fid == now_province) {
					var children = region_list[i].children;
					for(var k = 0; k < children.length; k++) {
						$("#region_ss").append('<option value="' + children[k].fid + '">' + children[k].region_name + '</option>');
					}
				}
			}
		});
		$("#region_ss").change(function() {
			var now_province = $(this).val();
			$("#region_sss").html('<option value="">请选择区</option>');
			for(var i = 0; i < region_list.length; i++) {
				for(var j = 0; j < region_list[i].children.length; j++) {
					for(var k = 0; k < region_list[i].children[j].children.length; k++) {
						if(region_list[i].children[j].fid == now_province) {
							$("#region_sss").append('<option value="' + region_list[i].children[j].children[k].fid + '">' + region_list[i].children[j].children[k].region_name + '</option>');
						}

					}
				}

			}
		});
		
		
	}
	var selectdata = {};
	ajax_all_Filed("true", "true", "GET", selectinfo, "json", selectdata, selectinfos); //调用函数	
	//获取下拉单位数据
	
	$("#region_sss").change(function() {
		var province_id = $("#region_s").val();
		var city_id = $("#region_ss").val();
		var town_id = $("#region_sss").val();

		function orglist(data) {
			$("#org_id option").remove();
			var arr = data.data;
			//职称获取
			var orgs = "";
			for(var i = 0; i < arr.length; i++) {
				orgs += '<option value="'
				orgs += arr[i].fid;
				orgs += '"';
				orgs += '>';
				orgs += arr[i].org_name;
				orgs += '</option>';

			}
			orgs += '<option value="0">';
			orgs += '其他'
			orgs += '</option>';
			$("#org_id").append(orgs);
			$(".selectpicker").selectpicker('refresh');
		}
		var orglistdata = {
			"province_id": province_id,
			"city_id": city_id,
			"town_id": town_id,
			"org_name": '',
			"spell": ''
		};
		ajax_all_Filed("true", "true", "POST", org_list, "json", orglistdata, orglist); //调用函数
		
	});

	$(function() {
		$("#retrieve_btn").attr('disabled', "true");
		$("#rg_checkbox").attr('checked', "true");
		//
		$(".jianting").bind("input propertychange change", function(event) {
			if($("#tel").val() == "" || $("#password").val() == "" || $("#password").val().length < 6 || $("#password2").val() == "" || $("#password2").val().length < 6 || $("#user_name").val() == "") {
				$("#retrieve_btn").attr('disabled', "true");
				$("#retrieve_btn").removeClass("retrieve_btn2").addClass("retrieve_btn");
				return false;
			} else {

				$("#retrieve_btn").removeAttr("disabled");
				$("#retrieve_btn").removeClass("retrieve_btn").addClass("retrieve_btn2");
			}
		});
		
		$("#retrieve_btn").click(function() {
			var user_name = $("#user_name").val(); //用户姓名
			var tel = $("#tel").val(); //手机号
			var password = $("#password").val(); //用户密码
			var email = $("#email").val(); //邮箱
			var job_id = $("#job_id").val(); //职称
			var org_id = $("#org_id").val(); //机构
			var diy_org = $("#diy_org").val(); //自定义单位
			var deparitment = $("#deparitment").val(); //部门
			var education_id = $("#education_id").val(); //学历ID
			var message = $("#message").val(); //验证码
			var province_id = $("#region_s").val();
			var city_id = $("#region_ss").val();
			var town_id = $("#region_sss").val();
			//		$("input[type='checkbox']").is(':checked')
			var credit_title = $("#credit_title").val();
			var credit_type = $("#credit_type").val()
			if(email == "" || email == null) {
				showLaert("邮箱必须填写！")
				return false;
			}
			if($("#rg_checkbox").is(':checked')) {
				function register(data) {
					if(data.code == 200) {
						$("body .newloading").remove();
						showLaert(data.msg);
						$("body").on('click', '#alert_btn', function() {
							window.location.href = "/login";
						})

					} else if(data.code == 421) {
						showLaert(data.msg)
					} else if(data.code == 415) {
						showLaert(data.msg)
					}
				}
				var data = {
					"user_name": user_name,
					"tel": tel,
					"password": $.md5(password),
					"email": email,
					"province_id": province_id,
					"city_id": city_id,
					"country_id": town_id,
					"org_id": org_id,
					"job_id": job_id,
					"diy_org": diy_org,
					"department_id": deparitment,
					"education_id": education_id,
					"credit_type":credit_type,
					"credit_title":credit_title,
					"message": message
				};
				ajax_all_Filed("true", "true", "POST", regurl, "json", data, register); //调用函数	
			} else {
				showLaert("请勾选协议")
				return false;
			}

		})
		//职称选择
		var credit_titlestr ="";
	    $("#credit_type").change(function(){
	        var now_province=$(this).val();
	        for(var i =0; i<creditarr.length; i++)
	        {	
	        	if(now_province == creditarr[i].id){
	        		for(var k=0; k<creditarr[i].list.length;k++){
	        			credit_titlestr += '<option value="'+(k+1)+'">';
						credit_titlestr += creditarr[i].list[k].name;
						credit_titlestr += '</option>';
	        		}
		    		
	        	}
	        }
	        $("#credit_title option").remove(); 
		   	$("#credit_title").append(credit_titlestr); 
		   	credit_titlestr="";
	    });
	    
	    //监听选择医院vaule
	    
	    var org_id_index = $("#org_id option:selected").val();
	    $("#org_id").change(function(){
	    	org_id_index = $("#org_id option:selected").val();
	    	if(org_id_index>0){
	    	$("#beyong").hide()
	    	$("#diy_org").val('')
		    }else{
		    	$("#beyong").show()
		    	
		    }
	    })
	    
	})