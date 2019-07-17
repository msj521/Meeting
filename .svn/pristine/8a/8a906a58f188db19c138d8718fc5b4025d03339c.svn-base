$(function() {

	var videourl = "/api/product/training_list";
	var adsense = "api/adsense";
	var class_id = 0;
	var page = 1;
	var pagesize = 6;
	var arr = new Array();

	function videolist(data) {
		if(data.code == 414) {
			return false;
		}
		//获取培训列表json
		arr = data.data.product_list
		if($(".classify_rg").text().trim().length <= 0) {
			$('<button value="0" class="active">' + '全部' + '</button>').appendTo(".classify_rg");
			for(var i = 0; i < data.data.class_list.length; i++) {
				$('<button value="' + data.data.class_list[i].fid + '">' + data.data.class_list[i].class_name_zh + '</button>').appendTo(".classify_rg");

			}
		}
		
		var str = "";
		for(var i = 0; i < arr.length; i++) {
			str += '<li>';
			str += '<a href="/videoinfo?training_id=' + arr[i].fid + '">';
			str += '<div class="train_info">';
			str += '<div class="train_layer"></div>';
			str += '<div class="train_img">';
			str += '<img src="' + arr[i].web_image_url + '" />';
			str += '</div>';
			str += '<div class="live_ms">';
			str += '<div class="meeting_title ellipsis">';
			str += arr[i].product_name;
			str += '</div>';
			str += '<div class="">';
			str += '<div class="tcname ellipsis">讲师：';
			if(arr[i].expert_name != null) {
				str += arr[i].expert_name;
			} else {
				str += '';
			}
			str += '</div>';
			if(arr[i].price == 0.00) {
				str += '<div class="free">免费</div>';
			} else {
				if(arr[i].price != null) {
					str += '<div class="free">¥' + arr[i].price + '</div>';
				} else {
					str += '<div class="free">¥</div>';
				}
			}
			str += '</div>';
			str += '</div>';
			str += '</div>';
			str += '</a>';
			str += '</li>';

		}
		
		$(".train_ul2").append(str);
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
				$(".train_ul2 li").remove();
				page = current;
				var data = {
					'product_type': 2,
					"page": page,
					"pagesize": pagesize,
					"class_id": class_id
				};
				ajax_all_Filed("true", "true", "GET", videourl, "json", data, videolist); //调用函数
			}
		});
	}
	
	var data = {
		'product_type': 2,
		"page": page,
		"pagesize": pagesize,
		"class_id": class_id
	};
	
	ajax_all_Filed("true", "true", "GET", videourl, "json", data, videolist); //调用函数

	$('.classify_rg').on('click', 'button', function() {
		class_id = $(this).val();
		page = 1;
		$(".train_ul2 li").remove();
		$(this).addClass("active").siblings().removeClass("active");
		var data = {
			'product_type': 2,
			"page": page,
			"pagesize": pagesize,
			"class_id": class_id
		};
		ajax_all_Filed("true", "true", "GET", videourl, "json", data, videolist); //调用函数

	});

	function adsenses(data) {
		//广告位
		if(data.code == 200) {
			if(data.data.ad_list[0].number_id == 1) {
				$('<a  target="_blank" href="' + data.data.ad_list[0].url + '">' + '<img src="' + data.data.ad_list[0].web_image_url + '" />' + '</a>').appendTo("#logos1");
			}
		} else if(data.code == 414) {
			$(".logoslist").hide();
			return false;
		}
	}
	var adsensedata = {
		"type": 4
	};
	ajax_all_Filed("true", "true", "POST", adsense, "json", adsensedata, adsenses); //调用函数

})