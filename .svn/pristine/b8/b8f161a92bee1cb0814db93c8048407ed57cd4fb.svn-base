$(function() {

	//会议—会议一级日程
	var schedule_first = "api/convention/schedule_first"
	var schedule_second = "api/convention/schedule_second"

	//专家列表
	function schedule(data) {
		if(data.code == 414) {
			return false;
		}
		var selectdate = data.data.selectdate;
		var schedulefirst_list = data.data.schedulefirst_list;
		for(var i = 0; i < schedulefirst_list.length; i++) {
			for(var j = 0; j < selectdate.length; j++) {
				if(selectdate[j].children) {} else {
					selectdate[j].children = Array();
				}
				if(selectdate[j].selectdate == schedulefirst_list[i].selectdate) {
					selectdate[j].children.push(schedulefirst_list[i]);
				}
			}
		}
		for(var i = 0; i < selectdate.length; i++) {
			$('<li>' + selectdate[i].selectdate + '</li>').appendTo(".daytime_nav_ul")
		}
		$(".daytime_nav_ul li").first().addClass("action");
		str = "";
		for(var i = 0; i < selectdate.length; i++) {
			str += '<div style="display: none;">';
			str += '<div class="daytiem_txts">'
			str += '<ul class="daytiem_txt_ul">'
			for(var j = 0; j < selectdate[i].children.length; j++) {
				str += '<li title="' + selectdate[i].children[j].fid + '">';
				str += '<h1>';
				str += selectdate[i].children[j].schedule_name;
				str += '</h1>';
				str += '<div class="hqh_time">';
				str += selectdate[i].children[j].start_date.substring(16, 0);
				str += '至';
				str += selectdate[i].children[j].end_date.slice(11).substring(5, 0);
				str += '</div>';
				str += '<div class="hqh_addr">';
				str += selectdate[i].children[j].room_name;
				str += '</div>';
				if(selectdate[i].children[j].expert_name != null) {
					str += '<div class="hqh_addr" style="margin-left:0px">';
					str += '演讲者：' + selectdate[i].children[j].expert_name;
					str += '</div>';
				}

				str += '</li>';
			}
			str += '</ul>';
			str += '</div>';
			str += '</div>';
		}
		$(".daytiem_txt").append(str)
		$(".daytiem_txt > div").first().css("display", "block");
	}
	var scheduledata = {
		"convention_id": convention_id,
		"select_date": '',
		"search_type": 0
	};
	ajax_all_Filed("true", "true", "GET", schedule_first, "json", scheduledata, schedule); //调用函数		

	$('.daytime_nav_ul ').on('click', 'li', function() {
		$(this).addClass("action").siblings().removeClass("action");
		var index = $(".daytime_nav_ul li").index(this);
		$("div.daytiem_txt > div")
			.eq(index).show()
			.siblings().hide();
	});

	$('.daytiem_txt').on('click', 'li', function() {
		$("#schedule_name").text("");
		$(".schedule_ex").text("");
		$("#mtdate1").text("");
		$("#mtdate2").text("");
		$("#addr").text("");
		$(".tclist").text("");
		var schedulefirst_id = $(this).attr("title");

		function second(data) {
			var schedulefirst_info = data.data.schedulefirst_info;
			var expert_list = data.data.schedulefirst_info.expert_list;
			var schedulesecond_list = data.data.schedulesecond_list;

			var role_list = Array();
			var role_list2 = Array();
			for(var i = 0; i < expert_list.length; i++) {
				var roleName = expert_list[i].role_name;
				var flag = false;
				for(var j = i; j < role_list.length; j++) {
					if(role_list[j].roleName == roleName) {
						flag = true;
					}
				}
				if(!flag) {
					var model = {
						"roleName": roleName,
						'experts': Array()
					}
					role_list.push(model);
				}
			}
			for(var i = 0; i < expert_list.length; i++) {
				var roleName = expert_list[i].role_name;
				for(var j = i; j < role_list.length; j++) {
					if(role_list[j].roleName == roleName) {
						role_list[j].experts.push(expert_list[i]);
					}
				}
			}

			for(var i = 0; i < schedulesecond_list.length; i++) {
				for(var j = i; j < schedulesecond_list[i].expert_list.length; j++) {
					var roleName = schedulesecond_list[i].expert_list[j].role_name;
					var flag = false;
					for(var j = 0; j < role_list2.length; j++) {
						if(role_list2[j].roleName == roleName) {
							flag = true;
						}
					}
					if(!flag) {
						var model = {
							"roleName": roleName,
							'experts': Array()
						}
						role_list2.push(model);
					}

				}
			}
			for(var i = 0; i < schedulesecond_list.length; i++) {
				for(var j = i; j < schedulesecond_list[i].expert_list.length; j++) {
					var roleName = schedulesecond_list[i].expert_list[j].role_name;
					for(var k = 0; k < role_list2.length; k++) {
						if(role_list2[k].roleName == roleName) {
							role_list2[k].experts.push(schedulesecond_list[i].expert_list[j]);
						}
					}

				}
			}

			$(".daytiem_div").show();

			$("#schedule_name").text(schedulefirst_info.schedule_name);
			$("#mtdate1").text(schedulefirst_info.start_date);
			$("#mtdate2").text(schedulefirst_info.end_date);
			$("#addr").text(schedulefirst_info.room_name);
			var str = "";
			for(var i = 0; i < role_list.length; i++) {
				str += '<div>';
				str += role_list[i].roleName;
				str += ':';
				for(var j = 0; j < role_list[i].experts.length; j++) {
					str += role_list[i].experts[j].expert_name;
				}
				str += '</div>';
			}
			$(".schedule_ex").append(str);

			var html = "";
			for(var i = 0; i < schedulesecond_list.length; i++) {
				html += '<div class="tc_ctrg_txt">';
				html += '<div class="tcrg_time">';
				html += schedulesecond_list[i].start_date.substr(11, 5);
				html += '-'
				html += schedulesecond_list[i].end_date.substr(11, 5);
				html += '</div>';
				html += '<div class="tcrg_txt">';
				html += schedulesecond_list[i].schedule_name

				for(var j = 0; j < role_list2.length; j++) {
					html += '<div>';
					html += role_list2[j].roleName;
					html += ':';
					for(var k = 0; k < role_list2[j].experts.length; k++) {
						html += role_list2[j].experts[k].expert_name
					}
					html += '</div>';
				}

				html += '</div>';
				html += '</div>';
			}
			$(".tclist").append(html);
		}
		var seconddata = {
			"convention_id": convention_id,
			"schedulefirst_id": schedulefirst_id
		};
		ajax_all_Filed("true", "true", "GET", schedule_second, "json", seconddata, second); //调用函数	
	})

	$(".daytiem_close").click(function() {
		$(".daytiem_div").hide();
	})
})