$(function() {

	var searchurl = "/api/index/search";
	var class_id = 0;
	var page = 1;
	var pagesize = 6;
	var module = 1;
	var live_flei;
	var convention_class;
	var training_class;
	var data_list;
	//	var arr = new Array();
	function search(data) {
		if(data.code == 414) {
			return false;
		}
		//获取直播分类json
		live_flei = data.data.class_info.live_class;
		//获取会议分类json
		convention_class = data.data.class_info.convention_class;
		//获取培训分类json
		training_class = data.data.class_info.training_class;
		data_list = data.data.data_list;
		if($("#module_list").text().trim().length <= 0) {
			$('<button value="0" class="active">' + '全部' + '</button>').appendTo("#module_list");
			for(var i = 0; i < live_flei.length; i++) {
				$('<button value="' + live_flei[i].fid + '">' + live_flei[i].class_name_zh + '</button>').appendTo("#module_list");
			}
		}
		//直播类型渲染
		if(module == 1) {
			var livestr = ""
			if($(".searchlist").text().trim().length <= 0) {
				livestr += '<ul class="mtlive_ul">';
				for(var i = 0; i < data_list.length; i++) {
					livestr += '<li><a href="/livesinfo?live_id=' + data_list[i].fid + '">';
					if(data_list[i].vip == 1) {
						livestr += '<div class="vip"></div>'
					}
					livestr += '<div class="live_info">'
					livestr += '<div class="layer"></div>'
					livestr += '<div class="live_title ellipsis">' + data_list[i].title + '</div>'
					livestr += '<div class="live_img">'
					livestr += '<img src="' + data_list[i].app_image_url + '" />'
					livestr += '</div>'
					livestr += '<div class="live_ms">'
					livestr += '<div class="live_ms_lf">'
					livestr += '<div class="tl_img">' + '<img src="/static/web/images/icon_experts.png"></div>'
					livestr += '<div class="tl_name ellipsis">' + data_list[i].expert_name + '</div>'
					livestr += '</div>'
					livestr += '<div class="liev_ms_rg">'
					livestr += '<div class="zjclass2">' + data_list[i].class_name + '</div>'
					livestr += '<div class="guank2">' + data_list[i].play_count + '</div>'
					livestr += '</div>'
					livestr += '</div>'
					livestr += '</div>'
					livestr += '</a>'
					livestr += '</li>'
				}

				livestr += '</ul>'
				$(".searchlist").append(livestr)
			}

		} else if(module == 2) {
			//会议类型渲染
			var meetingstr = ""
			if($(".searchlist").text().trim().length <= 0) {
				meetingstr += '<ul class="meeting_ul2">'
				for(var i = 0; i < data_list.length; i++) {
					meetingstr += '<li>'
					meetingstr += '<a href="/convention?convention_id=' + data_list[i].fid + '">'
					meetingstr += '<div class="mt_info">'
					meetingstr += '<div class="mt_layer"></div>'
					meetingstr += '<div class="mt_img">'
					meetingstr += '<img src="' + data_list[i].web_image_url + '" />'
					meetingstr += '</div>'
					meetingstr += '<div class="live_ms">'
					meetingstr += '<div class="meeting_title ellipsis">' + data_list[i].convention_name + '</div>'
					meetingstr += '<p class="mt_time">时间：' + data_list[i].start_time.substring(0,10) + '</p>'
					meetingstr += '</div>'
					meetingstr += '</div>'
					meetingstr += '</a>'
					meetingstr += '</li>'
				}
				meetingstr += '</ul>'
				$(".searchlist").append(meetingstr);
			}

		} else if(module == 3) {
			//培训类型渲染
			var trainstr = "";
			if($(".searchlist").text().trim().length <= 0) {
				trainstr += '<ul class="train_ul2">';
				for(var i = 0; i < data_list.length; i++) {
					trainstr += '<li><a href="/videoinfo?training_id=' + data_list[i].fid + '">';
					trainstr += '<div class="train_info">';
					trainstr += '<div class="train_layer"></div>';
					trainstr += '<div class="train_img">';
					trainstr += '<img src="' + data_list[i].web_image_url + '" />';
					trainstr += '</div>';
					trainstr += '<div class="live_ms">';
					trainstr += '<div class="meeting_title ellipsis">';
					trainstr += data_list[i].product_name;
					trainstr += '</div>';
					trainstr += '<div class="">';
					trainstr += '<div class="tcname ellipsis">讲师：';
					if(data_list[i].class_name != null) {
						trainstr += data_list[i].class_name;
					} else {
						str += '';
					}
					trainstr += '</div>';
					if(data_list[i].price == 0.00) {
						trainstr += '<div class="free">免费</div>';
					} else {
						trainstr += '<div class="free">¥' + data_list[i].price + '</div>';
					}
					trainstr += '</div>';
					trainstr += '</div>';
					trainstr += '</div>';
					trainstr += '</a>';
					trainstr += '</li>';
				}
				trainstr += '</ul>'
			}
			$(".searchlist").append(trainstr);
		}
		//分页
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
				$(".searchlist").text("");
				page = current;
				var data = {
					"page": page,
					"pagesize": pagesize,
					"class_id": class_id,
					"module": module,
					"keyword": keyword
				};
				ajax_all_Filed("true", "true", "POST", searchurl, "json", data, search); //调用函数
			}
		});

	}
	var data = {
		"page": page,
		"pagesize": pagesize,
		"class_id": class_id,
		"module": module,
		"keyword": keyword
	};
	ajax_all_Filed("true", "true", "POST", searchurl, "json", data, search); //调用函数

	//一级类点击事件
	$('#module').on('click', 'button', function() {
		module = $(this).val();
		page = 1;

		$(this).addClass("active").siblings().removeClass("active");
		$("#module_list button").remove();
		$(".searchlist").text("");
		$('<button value="0" class="active">' + '全部' + '</button>').appendTo("#module_list");
		if(module == 1) {
			for(var i = 0; i < live_flei.length; i++) {
				$('<button value="' + live_flei[i].fid + '">' + live_flei[i].class_name_zh + '</button>').appendTo("#module_list");
			}
		} else if(module == 2) {
			for(var i = 0; i < convention_class.length; i++) {
				$('<button value="' + convention_class[i].fid + '">' + convention_class[i].class_name_zh + '</button>').appendTo("#module_list");
			}
		} else if(module == 3) {
			for(var i = 0; i < training_class.length; i++) {
				$('<button value="' + training_class[i].fid + '">' + training_class[i].class_name_zh + '</button>').appendTo("#module_list");
			}
		}

		var data = {
			"page": page,
			"pagesize": pagesize,
			"class_id": class_id,
			"module": module,
			"keyword": keyword
		};
		ajax_all_Filed("true", "true", "POST", searchurl, "json", data, search); //调用函数

	});
	//二级类点击事件
	$('#module_list').on('click', 'button', function() {
		class_id = $(this).val();
		$(".searchlist").text("");
		$(this).addClass("active").siblings().removeClass("active");
		var data = {
			"page": page,
			"pagesize": pagesize,
			"class_id": class_id,
			"module": module,
			"keyword": keyword
		};
		ajax_all_Filed("true", "true", "POST", searchurl, "json", data, search); //调用函数
	});

})