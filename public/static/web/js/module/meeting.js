$(function() {

	var meetingurl = "/api/convention/convention_list";
	var adsense = "api/adsense";
	var class_id = 0;
	var page = 1;
	var pagesize = 6;
	var arr = new Array();

	function meetinglist(data) {
		if(data.code == 414) {
			return false;
		}
		arr = data.data.convention_list
		if($(".classify_rg").text().trim().length <= 0) {//如果分类没有内容  渲染内容
			$('<button value="0" class="active">' + '全部' + '</button>').appendTo(".classify_rg");
			for(var i = 0; i < data.data.class_list.length; i++) {
				$('<button value="' + data.data.class_list[i].fid + '">' + data.data.class_list[i].class_name_zh + '</button>').appendTo(".classify_rg");
			}
		}
		//会议列表
		var str = ""
		for(var i = 0; i < arr.length; i++) {			//用es6模板字符串
			str += '<li>';
			str += '<a href="/convention?convention_id=' + arr[i].fid + '&nav_id=1">';
			str += '<div class="mt_info">';
			str += '<div class="mt_layer"></div>';
			str += '<div class="mt_img">';
			str += '<img src="' + arr[i].web_image_url + '" />';
			str += '</div>';
			str += '<div class="live_ms">';
			str += '<div class="meeting_title ellipsis">' + arr[i].convention_name + '</div>';
			str += '<p class="mt_time">' + '时间：' + arr[i].start_time.substring(0,10) + '</p>';
			str += '</div>';
			str += '</div>';
			str += '</a>';
			str += '</li>';

		}
		$(".meeting_ul2").append(str);
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
				$(".meeting_ul2 li").remove();
				page = current;
				var data = {
					"page": page,
					"pagesize": pagesize,
					"class_id": class_id
				};
				ajax_all_Filed("true", "true", "GET", meetingurl, "json", data, meetinglist); //调用函数
			}
		});

	}
	var data = {
		"page": page,
		"pagesize": pagesize,
		"class_id": class_id
	};
	ajax_all_Filed("true", "true", "GET", meetingurl, "json", data, meetinglist); //调用函数	会议列表处请求处理页面
	//分类点击
	$('.classify_rg').on('click', 'button', function() {
		class_id = $(this).val();
		page = 1;
		$(".meeting_ul2 li").remove();
		$(this).addClass("active").siblings().removeClass("active");
		var data = {
			"page": page,
			"pagesize": pagesize,
			"class_id": class_id
		};
		ajax_all_Filed("true", "true", "GET", meetingurl, "json", data, meetinglist); //调用函数     

	});

	function adsenses(data) {
		//广告位
		if(data.code == 200) {
			if(data.data.ad_list[0].number_id == 1) {
				$('<a  target="_blank" href="' + data.data.ad_list[0].url + '">' + '<img src="' + data.data.ad_list[0].web_image_url + '" />' + '</a>').appendTo("#logos1");//把获取到的数据插入到广告位
			}
		} else if(data.code == 414) {
			$(".logoslist").hide();//隐藏广告位
			return false;
		}
	}
	var adsensedata = {
		"type": 2
	};
	ajax_all_Filed("true", "true", "POST", adsense, "json", adsensedata, adsenses); //调用函数     广告位处请求处理页面

})