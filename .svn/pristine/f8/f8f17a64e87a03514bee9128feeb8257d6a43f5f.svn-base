$(function() {
	var training = "/api/user/training"
	if(cook_uid == null) {
		window.location.href = "/login";
		return false;
	}

	function trains(data) {
		if(data.code == 414) {
			return false;
		}
		if(data.data.data.length > 0) {
			$(".user_train_ul").css("display", "block")
			for(var i = 0; i < data.data.data.length; i++) {
				$('<li>' +
					'<a href="/videoinfo?training_id=' + data.data.data[i].fid + '">' +
					'<div class="train_info">' +
					'<div class="user_train_layer">' + '</div>' +
					'<div class="user_train_img">' +
					'<img src="' + data.data.data[i].web_image_url + '" />' +
					'</div>' +
					'<div class="live_ms">' +
					'<div class="meeting_title ellipsis" style="font-size: 16px;">' +
					data.data.data[i].product_name +
					'</div>' +
					'<div class="">' +
					'<div class="tcname ellipsis" style="font-size: 12px;">' + '讲师：' + data.data.data[i].expert_name + '</div>' +
					'</div>' +

					'</div>' +
					'</div>' +
					'</a>' +
					'</li>').appendTo(".user_train_ul")
			}
		} else {
			$(".null_div").css("display", "block")
		}

	}
	var data = {
		"page": 1,
		"pagesize": 100,
		"uid": cook_uid
	};
	ajax_all_Filed("true", "true", "POST", training, "json", data, trains); //调用函数
})