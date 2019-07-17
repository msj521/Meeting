$(function() {
	var videoinfourl = "/api/product/training_detail";
	var collecturl = "/api/product/training_collect";

	function videoinfo(data) {
		$('<img src="' + data.data.training_info.web_image_url + '" />').appendTo(".peix_img");
		$("#class_name").text(data.data.training_info.class_name);
		$("#title").text(data.data.training_info.product_name);
		$("#product_name").text(data.data.training_info.product_name);
		$("#description").text(data.data.training_info.description);
		
		for(var i = 0; i < data.data.expert_list.length; i++) {
			$('<li>' + '<a>' +
				'<img src="' + data.data.expert_list[i].web_image_url + '" />' +
				'<p>' + data.data.expert_list[i].expert_name + '</p>' +
				'</a>' +
				'<div class="daos_ms">' +
				'<div class="daos_top">' + '</div>' +
				'<div class="daos_txt">' + data.data.expert_list[i].introduction + '</div>' +
				'</div>' +
				'</li>').appendTo(".guestlive_ul");
		}

		var str = "";
		for(var i = 0; i < data.data.video_list.length; i++) {
			str += '<li class="mulu_li">';
			str += data.data.video_list[i].section_name;
			str += '<ul>';
			for(var j = 0; j < data.data.video_list[i].children.length; j++) {
				if(data.data.video_list[i].children[j].main_type == 2) {
					if(data.data.video_list[i].children[j].multi_play == 1) {
						str += '<li><a href="/recordinfo?training_id=' + data.data.training_info.fid + '&video_id=' + data.data.video_list[i].children[j].main_id + '" ';
						if(data.data.video_list[i].children[j].play_finish === 1) {
							str += 'style="background: url(/static/web/images/icon_nostar.png) no-repeat; color: #232323;"';
						} else if(data.data.video_list[i].children[j].play_finish === 0) {
							str += 'style="background: url(/static/web/images/icon_progress.png) no-repeat; color: #232323;"';
						}
						str += '>' + data.data.video_list[i].children[j].name + '</a></li>';
					} else {
						str += '<li><a href="/recordinfo?training_id=' + data.data.training_info.fid + '&video_id=' + data.data.video_list[i].children[j].main_id + '" ';
						if(data.data.video_list[i].children[j].play_finish === 1) {
							str += 'style="background: url(/static/web/images/icon_nostar.png) no-repeat; color: #232323;"';
						} else if(data.data.video_list[i].children[j].play_finish === 0) {
							str += 'style="background: url(/static/web/images/icon_progress.png) no-repeat; color: #232323;"';
						}
						str += '>' + data.data.video_list[i].children[j].name + '</a></li>';
					}

				} else {
					str += '<li class="kaoshi"><a href="javascript:void(0)" ';
					if(data.data.video_list[i].children[j].pass === 1) {
						str += 'style="background: url(/static/web/images/icon_textedsmall.png) no-repeat; color: #232323;"';
					} else if(data.data.video_list[i].children[j].pass === 0) {
						str += 'style="background: url(/static/web/images/icon_textedsmall.png) no-repeat; color: #232323;"';
					} else {
						str += 'style="background: url(/static/web/images/icon_textsmall.png) no-repeat;"'
					}
					str += '>' + data.data.video_list[i].children[j].name + '</a></li>';
				}

			}
			str += '</ul>';
			str += '</li>';

		}
		$("#mulu_ul").append(str);
		if(data.data.video_list.length!=0){
			$('<a class="xuexi_btn" href="/recordinfo?training_id=' + data.data.training_info.fid + '&video_id=' + data.data.video_list[0].children[0].main_id + '">' + '开始学习' + '</a>').appendTo("#xuexi_btn");
		}
	}
	var data = {
		'training_id': training_id
	};
	ajax_all_Filed("true", "true", "GET", videoinfourl, "json", data, videoinfo); //调用函数

	$('.guestlive_ul').on('mouseenter', 'li', function() { //绑定鼠标进入事件
		$(this).find('.daos_ms').show();
	});
	$('.guestlive_ul').on('mouseleave', 'li', function() { //绑定鼠标划出事件
		$(this).find('.daos_ms').hide();
	});

})