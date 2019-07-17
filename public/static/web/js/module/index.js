$(function() {
	//首页接口
	var bannerurl = "/api/index/first_page";
	//广告位接口
	var adsense = "api/adsense";

	function homelist(data) {
		if(data.code == 414) {
			return false;
		}
		var banner = data.data.banner_list;
		var live_list = data.data.live_list;
		var convention_list = data.data.convention_list;
		var video_list = data.data.video_list;
		//轮播图
		for(var i = 0; i < banner.length; i++) {
			$('<li style="background:url(' + banner[i].web_image_url + ') 50% 0 no-repeat;">' + '<a href="' + banner[i].location_url + '"></a>' + '</li>').appendTo(".slides");
		}
		$('.flexslider').flexslider({
			directionNav: true,
			pauseOnAction: false
		});

		//直播列表
		var str = "";
		for(var i = 0; i < live_list.length; i++) {
			str += '<li><a href="/livesinfo?live_id=' + live_list[i].fid + '"><div class="live_info">';
			if(live_list[i].vip == 1) {
				str += '<div class="vip"></div>';
			}
			str += '<div class="layer"></div>'
			str += '<div class="live_title ellipsis">' + live_list[i].title + '</div>';
			str += '<div class="live_img"><img src="' + live_list[i].web_image_url + '" /></div>';
			str += '<div class="live_ms">';
			str += '<div class="live_ms_lf">';
			str += '<div class="tl_img">';
			str += '<img src="/static/web/images/icon_experts.png">';
			str += '</div>';
			str += '<div class="tl_name ellipsis">' + live_list[i].expert_name + '</div>';
			str += '</div>';
			str += '<div class="liev_ms_rg">';
			str += '<div class="zjclass2">' + live_list[i].class_name + '</div>';
			str += '<div class="guank2">' + live_list[i].play_count + '</div>';
			str += '</div></div></div></a></li>';
		}
		$("#home_live_ul").append(str)

		//会议
		for(var i = 0; i < 4; i++) {
			if(convention_list[i] == null) {
				break
			}
			
			$('<li>' + '<a href="/convention?convention_id=' + convention_list[i].fid + '&nav_id=1">' +
				'<div class="mt_info">' +
				'<div class="mt_layer">' + '</div>' +
				'<div class="mt_img">' +
				'<img src="' + convention_list[i].web_image_url + '" />' +
				'</div>' +
				'<div class="live_ms">' +
				'<div class="meeting_title ellipsis">' +
				convention_list[i].convention_name +
				'</div>' +
				'<p class="mt_time">' + '时间：' +  convention_list[i].start_time.substring(0,10) + '</p>' +
				'</div>' +
				'</div>' +
				'</a>' +
				'</li>').appendTo(".meeting_ul");
		}
		
		for(var i = 4; i < convention_list.length; i++) {
			if(convention_list[i].fid == null) {
				break
			}
			$('<li>' +
				'<div class="hot_txt ellipsis">' + '<a href="/convention?convention_id=' + convention_list[i].fid + '&nav_id=1">' + convention_list[i].convention_name + '</a>' + '</div>' +
				'<p>' + convention_list[i].start_time.substring(0,10) + '</p>' +
				'</li>').appendTo(".hot_news");
		}

		//培训
		var html = "";
		for(var i = 0; i < video_list.length; i++) {
			html += '<li><a href="/videoinfo?training_id=' + video_list[i].fid + '">';
			html += '<div class="train_info">';
			html += '<div class="train_layer"></div>';
			html += '<div class="train_img"><img src="' + video_list[i].web_image_url + '" /></div>';
			html += '<div class="live_ms">'
			html += '<div class="meeting_title ellipsis">';
			html += video_list[i].product_name;
			html += '</div>';
			html += '<div class=""><div class="tcname ellipsis">讲师：';
			if(video_list[i].expert_name != null) {
				html += video_list[i].expert_name;
			} else {
				html += '';
			}
			html += '</div>';
			if(video_list[i].price == 0.00) {
				str += '<div class="free">免费</div>';
			} else {
				if(video_list[i].price != null) {
					str += '<div class="free">¥' + video_list[i].price + '</div>';
				} else {
					str += '<div class="free">¥</div>';
				}
			}
			html += '</div></div></div></a></li>';
		}
		$(".train_ul").append(html)
		//合作合伙
		for(var i = 0; i < data.data.partner_list.length; i++) {
			$('<li><a href="' + data.data.partner_list[i].web_url + '"><img src="' + data.data.partner_list[i].web_image_url + '"></a></li>').appendTo(".partner_list")
		}

	}
	
	var data = {};
	ajax_all_Filed("true", "true", "POST", bannerurl, "json", data, homelist); //调用函数

	function adsenses(data) {
		//广告位
		if(data.code == 200) {
			if(data.data.ad_list[0].number_id == 1) {
				$('<a  target="_blank" href="' + data.data.ad_list[0].url + '">' + '<img src="' + data.data.ad_list[0].web_image_url + '" />' + '</a>').appendTo("#logos1");
			} else if(data.data.ad_list[1].number_id == 2) {
				$('<a target="_blank" href="' + data.data.ad_list[1].url + '">' + '<img src="' + data.data.ad_list[1].web_image_url + '" />' + '</a>').appendTo("#logos2");
			}
		} else if(data.code == 414) {
			$(".logoslist").hide();
			return false;
		}
	}
	var adsensedata = {
		"type": 1
	};
	ajax_all_Filed("true", "true", "POST", adsense, "json", adsensedata, adsenses); //调用函数
})