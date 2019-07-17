$(function() {
    //专家接口
    var expert_url = "api/convention/expert_list";
    var letter = '';
    //专家列表
    function expert(data) {
        if (data.code == 414) {
            return false;
        }
        //获取专家列表
        var expert_list = data.data.expert_list;

        for (var i = 0; i < expert_list.length; i++) {
            if (expert_list[i].fid != 343 && expert_list[i].fid != 251 && expert_list[i].fid != 355 && expert_list[i].fid != 275) {
                $('<li>' + '<a href="/expertinfo?convention_id=' + convention_id + '&expert_id=' + expert_list[i].fid + '">' +
                    '<img src="' + expert_list[i].web_image_url + '" />' +
                    '<p>' + expert_list[i].expert_name + '</p>' +
                    '</a>' + '</li>').appendTo(".guest_ul");
            }
        }

    }
    var expertdata = {
        "convention_id": convention_id
    };
    ajax_all_Filed("true", "true", "POST", expert_url, "json", expertdata, expert); //调用函数	

    //点击分类事件
    $('.guest_ss').on('click', 'div', function() {
        if ($(this).text() == "全部") {
            letter = '';
        } else {
            letter = $(this).text();
        }

        $(".guest_ul li").remove();
        $(this).addClass("active").siblings().removeClass("active");
        var expertdata = {
            "convention_id": convention_id,
            "str": letter
        };
        ajax_all_Filed("true", "true", "POST", expert_url, "json", expertdata, expert); //调用函数	

    });

})