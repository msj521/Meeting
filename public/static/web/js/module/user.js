$(function () {

	var userurl = "/api/user/user_info";
	var upurl = "/api/user/update_base";
	var selectinfo = "/api/login/baseinfo"
	var org_list = "/api/login/org_list"; //医院接口
	var update_pwd = "/api/user/update_pwd";
	//bnner
	var education_ids = "";
	var job_listids = "";
	var org_ids = "";
	var province_id = "";
	var city_id = "";
	var country_id = "";
	var departments = "";
	if (cook_uid == null) {
		window.location.href = "/login";
		return false;
	}


	function userinfo(data) {
		if (data.code == 414) {
			return false;
		}
		var userinfo = data.data.user_info;
		education_ids = data.data.user_info.education_id;
		//  	job_listids = data.data.user_info.job_id;
		org_ids = data.data.user_info.org_id;
		province_id = data.data.user_info.province_id;
		city_id = data.data.user_info.city_id;
		country_id = data.data.user_info.country_id;
		$("#update_job_names").val(data.data.user_info.job_id);
		$("#update_tels").val(data.data.user_info.tel);
		$("#update_names").val(data.data.user_info.user_name);
		$("#update_class_names").val(data.data.user_info.nick_name);
		departments = data.data.user_info.department_id;
		$('<option value="' + data.data.user_info.org_id + '">' + data.data.user_info.org_name + '</option>').appendTo("#update_org_names");

		if (cook_token || data.data.code == 200) {
			$("#user_name").text(userinfo.user_name);//判断登录状态,是登录状态，渲染用户信息到对应位置
			$("#tel").text(userinfo.tel)
			$("#job_name").text(userinfo.job_id)
			var department = userinfo.depart ? userinfo.depart : userinfo.department;
			$("#department").text(department)
			$("#education_name").text(userinfo.education_name)
			$("#org_name").text(userinfo.org_name)
			$("#org_name").attr("title", userinfo.org_name)
			$("#nick_name").text(userinfo.nick_name)
			$(".userimgs").attr("src", userinfo.web_image_url);
			$("#demo1").attr("src", userinfo.web_image_url);
		} else {
			location.href = "/login";//判断登录状态,没有登录则跳转至login
		}

		$("#update_pwd").click(function () {
			$("#pu_pawd").show()
		})
	}

	var data = {
		"token": cook_token,
		"uid": cook_uid
	};
	ajax_all_Filed("true", "true", "GET", userurl, "json", data, userinfo); //调用函数

	$(".out").click(function () {
		//点击退出登录
		$.cookie("tel", "", {
			expires: -1
		});//删除cookie中的tel值
		$.cookie("pwd", "", {
			expires: -1
		});//删除cookie中的pwd值
		$.cookie("cook_token", "", {
			expires: -1
		});//删除cookie中的cookie_uid值
		$.cookie("cook_uid", "", {
			expires: -1
		});
		location.href = "/";//将路由跳转至首页
	})

	function selectinfos(data) {
		var job_list = data.data.job_list;
		var education_list = data.data.education_list;
		var region_list = data.data.region_list;
		var department = data.data.department //部门科室
		//部门科室
		var departmenttr = "";
		for (var i = 0; i < department.length; i++) {
			departmenttr += '<option value="' + department[i].fid + '"';
			if (departments == department[i].fid) {
				departmenttr += 'selected="selected"';
			}
			departmenttr += '>';
			departmenttr += department[i].class_name_zh;
			departmenttr += '</option>';

		}
		$("#department_s").append(departmenttr);

		//学历
		var str = "";
		for (var i = 0; i < education_list.length; i++) {
			str += '<option value="'
			str += education_list[i].fid;

			str += '"';
			if (education_ids == education_list[i].fid) {
				str += 'selected="selected"';
			}
			str += '>';
			str += education_list[i].class_name_zh;
			str += '</option>';

		}
		$("#update_education_names").append(str);
	
		//省绑定
		var shen = "";
		var shi = "";
		var qu = "";
		for (var i = 0; i < region_list.length; i++) {
			shen += '<option value="'
			shen += region_list[i].fid;
			shen += '"';
			if (province_id == region_list[i].fid) {
				shen += 'selected="selected"';
			}
			shen += '>';
			shen += region_list[i].region_name;
			shen += '</option>';
		}
		$("#region_s").append(shen);
		//市绑定
		for (var i = 0; i < region_list.length; i++) {
			for (var j = 0; j < region_list[i].children.length; j++) {
				shi += '<option value="';
				shi += region_list[i].children[j].fid;
				shi += '"';
				if (city_id == region_list[i].children[j].fid) {
					shi += 'selected="selected"';
				}
				shi += '>';
				shi += region_list[i].children[j].region_name;
				shi += '</option>';
			}
		}
		$("#region_ss").append(shi);
		//区绑定
		for (var i = 0; i < region_list.length; i++) {
			for (var j = 0; j < region_list[i].children.length; j++) {
				for (var k = 0; k < region_list[i].children[j].children.length; k++) {
					qu += '<option value="';
					qu += region_list[i].children[j].children[k].fid;
					qu += '"';
					if (country_id == region_list[i].children[j].children[k].fid) {
						qu += 'selected="selected"';
					}
					qu += '>';
					qu += region_list[i].children[j].children[k].region_name;
					qu += '</option>';
				}
			}
		}
		$("#region_sss").append(qu);

		$("#region_s").change(function () {
			var now_province = $(this).val();
			$("#region_ss").html('<option value="">请选择城市</option>');
			for (var i = 0; i < region_list.length; i++) {
				if (region_list[i].fid == now_province) {
					var children = region_list[i].children;
					for (var k = 0; k < children.length; k++) {
						$("#region_ss").append('<option value="' + children[k].fid + '">' + children[k].region_name + '</option>');
					}
				}
			}
		});
		$("#region_ss").change(function () {
			var now_province = $(this).val();
			$("#region_sss").html('<option value="">请选择区</option>');
			for (var i = 0; i < region_list.length; i++) {
				for (var j = 0; j < region_list[i].children.length; j++) {
					for (var k = 0; k < region_list[i].children[j].children.length; k++) {
						if (region_list[i].children[j].fid == now_province) {
							$("#region_sss").append('<option value="' + region_list[i].children[j].children[k].fid + '">' + region_list[i].children[j].children[k].region_name + '</option>');
						}
					}
				}
			}
		});
	}
	var data = {};
	ajax_all_Filed("true", "true", "GET", selectinfo, "json", data, selectinfos); //调用函数
	//三级触发医院数据
	$("#region_sss").change(function () {
		var province_id = $("#region_s").val();
		var city_id = $("#region_ss").val();
		var country_id = $("#region_sss").val();

		function orglist(data) {
			var arr = data.data;
			$("#update_org_names").html('<option value="">请选择所属单位</option>');
			//职称获取
			var orgs = "";
			for (var i = 0; i < arr.length; i++) {
				orgs += '<option value="'
				orgs += arr[i].fid;

				orgs += '"';
				if (org_ids == arr[i].fid) {
					orgs += 'selected="selected"';
				}
				orgs += '>';
				orgs += arr[i].org_name;
				orgs += '</option>';

			}
			$("#update_org_names").append(orgs);

		}
		var orglistdata = {
			"province_id": province_id,
			"city_id": city_id,
			"country_id": country_id,
			"org_name": '',
			"spell": ''
		};
		ajax_all_Filed("true", "true", "POST", org_list, "json", orglistdata, orglist); //调用函数
	});

	//提交修改			
	$("#update_pulic_btn").click(function () {
		Loadings();
		var user_name = $("#update_names").val();
		var tel = $("#update_tels").val();
		var department_id = $("#department_s").val();
		var nick_name = $("#update_class_names").val();
		var education_id = $("#update_education_names").val();
		var org_id = $("#update_org_names option:selected").val();
		var job_id = $("#update_job_names").val();
		var province_id = $("#region_s option:selected").val();
		var city_id = $("#region_ss option:selected").val();
		var country_id = $("#region_sss option:selected").val();

		function listupdate(data) {
			if (data.code == 200) {
				showLaert(data.msg)
				$("#alert_btn").on('click', function () {
					window.location = "/userinfo"
				})
			}
		}
		var data = {
			"fid": cook_uid,
			"user_name": user_name, //姓名
			"tel": tel, //手机
			"nick_name": nick_name, //昵称
			"education_id": education_id, //学历
			"department_id": department_id, //部门
			"job_id": job_id, //职称
			"org_id": org_id, //医院
			"province_id": province_id, //省
			"city_id": city_id, //市
			"country_id": country_id //区
		};

		ajax_all_Filed("true", "true", "POST", upurl, "json", data, listupdate); //调用函数
	})

	//关闭弹出框
	$(".daytiem_close").click(function () {
		$(".pulic_t_div").hide()
	})

	//判断密码修改成功与否
	$('#pu_pawd_btn').on('click', function () {
		var old_pwd = $("#old_pwd").val();
		var new_pwd = $("#new_pwd").val();
		var new_pwd2 = $("#new_pwd2").val();
		if (old_pwd == "" || new_pwd == "" || new_pwd2 == "") {
			$("#tis_txt").text("密码和新密码不能为空！")
			return false;
		} else if (old_pwd.length < 6 || new_pwd.length < 6 || new_pwd2.length < 6) {
			$("#tis_txt").text("密码必须至少6位")
			return false;
		} else if (new_pwd != new_pwd2) {
			$("#tis_txt").text("重复新密码不一致！")
			return false;
		} else {
			Loadings();

			function clasupdate(data) {
				if (data.code == 200) {
					showLaert(data.msg)
					$("#alert_btn").on('click', function () {
						$.cookie("tel", "", {
							expires: -1
						});
						$.cookie("pwd", "", {
							expires: -1
						});
						$.cookie("cook_token", "", {
							expires: -1
						});
						$.cookie("cook_uid", "", {
							expires: -1
						});
						location.href = pu_url;
					})

				} else if (data.code == 218) {
					$("#tis_txt").text(data.msg)
				}
			}
			//md5加密传输
			var data = {
				"new_pwd": $.md5(new_pwd),
				"old_pwd": $.md5(old_pwd),
				"uid": cook_uid
			};
			ajax_all_Filed("true", "true", "POST", update_pwd, "json", data, clasupdate); //调用函数
		}

	});

	$(".userimgs").click(function () {
		$("#update_img").show();
	})
})