$(function() {
	var selectinfo = "/api/login/baseinfo"
	var education_ids = "";
	var job_listids = "";
	var org_ids = "";
	function selectinfos(data) {
		if(data.code == 414) {
			return false;
		}
		var job_list = data.data.job_list;
		var education_list = data.data.education_list;
		var region_list = data.data.region_list;

		//学历
		var str = "";
		for(var i = 0; i < education_list.length; i++) {
			str += '<option value="'
			str += education_list[i].fid;

			str += '"';
			if(education_ids == education_list[i].fid) {
				str += 'selected="selected"';
			}
			str += '>';
			str += education_list[i].class_name_zh;
			str += '</option>';
		}
		$("#update_education_names").append(str);

		//修改学历
		$('#update_education_name_btn').on('click', function() {
			var options = $("#update_education_names option:selected").val();
			function clasupdate(data) {
				if(data.code == 200) {
					alert(data.msg);
				}
			}
			var data = {
				"token": cook_token,
				"uid": cook_uid,
				"column": 'education_id',
				"value": options
			};
			ajax_all_Filed("true", "true", "POST", upurl, "json", data, clasupdate); //调用函数
			$(".pulic_t_div").hide();
		});

		//职称获取
		var org = "";
		for(var i = 0; i < job_list.length; i++) {
			org += '<option value="'
			org += job_list[i].fid;
			org += '"';
			if(education_ids == job_list[i].fid) {
				org += 'selected="selected"';
			}
			org += '>';
			org += job_list[i].class_name_zh;
			org += '</option>';
		}
		$("#update_job_names").append(org);
		//修改职称
		$('#update_job_name_btn').on('click', function() {
			var options = $("#update_job_names option:selected").val();

			function clasupdate(data){
				if(data.code == 200) {
					alert(data.msg);
				}
			}
			var data = {
				"token": cook_token,
				"uid": cook_uid,
				"column": 'job_id',
				"value": options
			};
			ajax_all_Filed("true", "true", "POST", upurl, "json", data, clasupdate); //调用函数
			$(".pulic_t_div").hide();
		});
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
	var data = {};
	ajax_all_Filed("true", "true", "GET", selectinfo, "json", data, selectinfos); //调用函数

})