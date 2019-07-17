$(function() {
	var liveurl = "/api/live/live_list";
	var adsense = "api/adsense";
	var class_id = 0;
	var page = 1;
	var pagesize = 6;
	//定义数组
	var arr = new Array();
	function livelist(data) {
		if(data.code == 414) {
			return false;
		}
		//内部声明变量
		arr = data.data.live_list;
		if($(".classify_rg").text().trim().length <= 0) {
			$('<button value="0" class="active">' + '全部' + '</button>').appendTo(".classify_rg");
			for(var i = 0; i < data.data.class_list.length; i++) {
				$('<button value="' + data.data.class_list[i].fid + '">' + data.data.class_list[i].class_name_zh + '</button>').appendTo(".classify_rg");

			}
		}
		//直播列表
		var str = "";
		for(var i = 0; i < arr.length; i++) {
			str +='<li>';
			str +='<a href="/livesinfo?live_id='+data.data.live_list[i].fid+'">';
			if(arr[i].vip == 1) {
				str += '<div class="vip"></div>';
			}
			str +='<div class="live_info">';
			str +='<div class="layer"></div>';
			str +='<div class="live_title ellipsis">'+data.data.live_list[i].title+'</div>';
			str +='<div class="live_img">';
			str +='<img src="'+data.data.live_list[i].app_image_url+'" />';
			str +='</div>';
			str +='<div class="live_ms">';
			str +='<div class="live_ms_lf">';
			str +='<div class="tl_img"><img src="/static/web/images/icon_experts.png"></div>';
			str +='<div class="tl_name ellipsis">'+data.data.live_list[i].expert_name+'</div>';
			str +='</div>';
			str +='<div class="liev_ms_rg">';
			str +='<div class="zjclass2">'+data.data.live_list[i].class_name+'</div>';
			str +='<div class="guank2">'+data.data.live_list[i].play_count+'</div>';
			str +='</div>';
			str +='</div>';
			str +='</div>';
			str +='</a>';
			str +='</li>';

		}
		$(".mtlive_ul").append(str);
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
			$(".mtlive_ul li").remove();
			page = current;
			var data = {
				"page": page,
				"pagesize": pagesize,
				"class_id": class_id
			};
			ajax_all_Filed("true", "true", "GET", liveurl, "json", data, livelist); //调用函数
		}
	});
}
var data = {
	"page": page,
	"pagesize": pagesize,
	"class_id": class_id
}; 
ajax_all_Filed("true", "true", "GET", liveurl, "json", data, livelist); //调用函数

//分类点击
$('.classify_rg').on('click', 'button', function() {
	class_id = $(this).val();
	page = 1;
	$(".mtlive_ul li").remove();
	$(this).addClass("active").siblings().removeClass("active");
	var data = {
		"page": page,
		"pagesize": pagesize,
		"class_id": class_id
	};
	ajax_all_Filed("true", "true", "GET", liveurl, "json", data, livelist); //调用函数

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
	"type": 3
}; ajax_all_Filed("true", "true", "POST", adsense, "json", adsensedata, adsenses); //调用函数

})