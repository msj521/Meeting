$(function() {
	//专家详情接口
	var expert_info = "api/convention/expert_detail"
	//专家详情
	function expertinfo(data) {
		if(data.code == 414) {
			return false;
		}
		var expert_info = data.data;
		$("#expert_img").attr({
			src: expert_info.web_image_url,
			alt: ""
		})
		$("#expert_name").text(expert_info.expert_name);
		$("#expert_ct").text(expert_info.introduction);
	}
	var expertinfodata = {
		"convention_id": convention_id,
		"expert_id": expert_id
	};
	ajax_all_Filed("true", "true", "GET", expert_info, "json", expertinfodata, expertinfo); //调用函数	

})