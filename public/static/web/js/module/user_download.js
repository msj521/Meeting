$(function() {
	var uploadurl = "/api/user/upload_convention"
	if(cook_uid == null) {
		window.location.href = "/login";
		return false;
	}

	function uploadlist(data) {
		if(data.code == 414) {
			return false;
		}

		var data = data.data.data;
		var str = "";
		if(data.length > 0) {
			$("#firstpane2").css("display", "block");
			for(var i = 0; i < data.length; i++) {
				str += '<div class="firstpanelist2">';
				str += '<h3 class="menu_head2 " title="' + data[i].convention_name + '">';
				str += '<div class="ellipsis" style="float: left; width: 50%;"><img src="/static/web/images/dian.png" />' + data[i].convention_name + '</div>';
				str += '<div style="float: left; font-size:12px; color:#555">注：A开头编号为摘要编号，F开头编号为全文编号</div>'
				str += '</h3>';
				str += '<div style="display:none" class="menu_body2">';
				str += '<table class="table table-striped" id="table_user">';
				str += '<thead>';
				str += '<th>摘要编号</th>';
				str += '<th>摘要标题</th>';
				str += '<th>所属专题</th>';
				str += '<th>呈现方式</th>';
				str += '<th>审核状态</th>';
				str += '</thead>';
				str += '<tbody>';
				for(var j = 0; j < data[i].list.length; j++) {
					str += '<tr title="' + data[i].list[j].fid + '">';
					str += '<td>';
					str += 'A0' + data[i].list[j].fid;
					str += '</td>';
					str += '<td><div class="ellipsis" style="width:150px; ">';
					str += data[i].list[j].title;
					str += '</div></td>';
					str += '<td><div class="ellipsis" style="width:150px;">';
					str += data[i].list[j].class_name_zh;
					str += '</div></td>';
					str += '<td>';
					if(data[i].list[j].shape == 1) {
						str += '口头和壁报';
					} else {
						str += '壁报';
					}

					str += '</td>';
					if(data[i].list[j].abstract_status == 1) {
						str += '<td style="color:#FFB300">待审核</td>';
					} else if(data[i].list[j].abstract_status == 2) {
						str += '<td style="color:#34B4B7">审核成功</td>';
					} else {
						str += '<td style="color:#CE2424">审核失败</td>';
					}
					str += '</tr>';
				}
				
				for(var j = 0; j < data[i].list.length; j++) {
					if(data[i].list[j].yes_no == 2) {
						str += '<tr title="' + data[i].list[j].fid + '">';
						str += '<td>';
						str += 'F0' + data[i].list[j].fid;
						str += '</td>';
						str += '<td><div class="ellipsis" style="width:150px;">';
						str += data[i].list[j].title;
						str += '</div></td>';
						str += '<td><div class="ellipsis" style="width:150px;">';
						str += data[i].list[j].class_name_zh;
						str += '</div></td>';
						str += '<td>';
						if(data[i].list[j].shape == 1) {
							str += '口头和壁报';
						} else {
							str += '壁报';
						}

						str += '</td>';
						if(data[i].list[j].paper_status == 1) {
							str += '<td style="color:#FFB300">待审核</td>';
						} else if(data[i].list[j].paper_status == 2) {
							str += '<td style="color:#34B4B7">审核成功</td>';
						} else {
							str += '<td style="color:#CE2424">审核失败</td>';
						}
						str += '</tr>';
					}
				}

				str += '</tbody>';
				str += '</table>'
				str += '</div>';
				str += '</div>';
			}
			$("#firstpane2").append(str)

		} else {
			$(".null_div").css("display", "block")
		}

		$("#firstpane2 .menu_body2:eq(0)").show();
		$("#firstpane2 .menu_head2:eq(0)").addClass("current2");

		//tr绑定事件
		$("#table_user tbody tr").click(function() {
			var title = $(this).find('td').eq(0).text();
			var fid = $(this).attr("title");
			$("#abs_name").show()
			var zyaotitle = ""; //标题
			var special = ""; //所属专题
			var shape = ""; //发表形式
			var objective = ""; //目的
			var method = ""; //方法
			var result = ""; //结果
			var conclusion = "" //结论

			function uploadlist(data) {
				var data = data.data.data[0];
				if(data.list=="" || data.list==null) return;
				var list = data.list;
				for(var j = 0; j < list.length; j++) {
					if(fid!=list[j].fid) continue;
					zyaotitle = list[j].title;
					special = list[j].class_name_zh;
					if(list[j].shape==1){
						shape = "口头和壁报";
					}else{
						shape = "壁报";
					}
					objective = list[j].objective
					method = list[j].method;
					result = list[j].result
					conclusion = list[j].conclusion
				}
				$("#fid").text(title);
				$("#zyaotitle").text(zyaotitle);
				$("#special").text(special);
				$("#shape").text(shape);
				$("#objective").text(objective);
				$("#method").text(method);
				$("#result").text(result);
				$("#conclusion").text(conclusion);
			}
			var data = {
				"page": 1,
				"pagesize": 100,
				"uid": cook_uid
			};
			ajax_all_Filed("true", "true", "GET", uploadurl, "json", data, uploadlist); //调用函数
		})

	}
	var data = {
		"page": 1,
		"pagesize": 100,
		"uid": cook_uid
	};
	ajax_all_Filed("true", "true", "GET", uploadurl, "json", data, uploadlist); //调用函数

})