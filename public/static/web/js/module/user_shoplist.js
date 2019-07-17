$(function() {
	var orderurl = "/api/user/order";
	var orderdeleteurl = "/api/user/delete";
	var page = 1;
	var pagesize = 6;
	if(cook_uid == null) {
		window.location.href = "/login";
		return false;
	}

	function order(data) {
		var orderlist = data.data.data;
		if(data.code == 414) {
			return false;
		}
		if(orderlist.length > 0) {
			$(".shoplist").css("display", "block")
			str = "";
			for(var i = 0; i < orderlist.length; i++) {
				str += '<li>';
				str += '<div class="shop_title">';
				str += '<div class="shop_lt_t">' + orderlist[i].create_time + '</div>';
				str += '<div class="shop_ct_t">' + '订单编号：' + orderlist[i].fid + '</div>';
				str += '<div class="shop_rg_t">';
				str += '<button class="bbtns" value="' + orderlist[i].fid + '">';
				str += ' <span class="glyphicon glyphicon-trash"></span>';
				str += '</button></div>';
				str += '</div>';
				str += '<div class="shop_ct">';
				str += '<div class="shop_lt_tc">';
				str += '<img src="' + orderlist[i].web_image_url + '" />';
				str += '</div>';
				str += '<div class="shop_ct_tc">';
				str += '<div class="shoptle ellipsis">' + orderlist[i].product_name + '</div>';
				str += '<p>' + '有效期：' + orderlist[i].create_time + '至' + orderlist[i].expire_time + '</p>';
				str += '</div>';
				str += '<div class="shop_ct_tc2">' + '¥' + orderlist[i].price_origin + '</div>';
				if(orderlist[i].order_status == 1) {
					str += '<div class="shop_rg_tc" style="color:#F5A623">待审核</div>';
				} else if(orderlist[i].order_status == 2) {
					str += '<div class="shop_rg_tc">购买成功</div>';
				} else if(orderlist[i].order_status == 3) {
					str += '<div class="shop_rg_tc" style="color:red">审核失败</div>';
				}
				str += '</div>';
				str += '</li>';
			}
			$(".shoplistul").append(str)
		} else {
			$(".null_div").css("display", "block")
		}
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
				$(".shoplistul li").remove();
				page = current;
				var data = {
					"page": page,
					"pagesize": pagesize,
					"uid": cook_uid
				};
				ajax_all_Filed("true", "true", "POST", orderurl, "json", data, order); //调用函数
			}
		});

	}
	var data = {
		"page": page,
		"pagesize": pagesize,
		"uid": cook_uid
	};
	ajax_all_Filed("true", "true", "POST", orderurl, "json", data, order); //调用函数

	$('.shoplistul').on('click', '.bbtns', function() {
		var fid = $(this).val();

		function orderdelete(data) {
			if(data.code == 200) {
				showLaert(data.msg)
				$("#alert_btn").on('click', function() {
					window.location.reload();
				})
			}
		}
		var data = {
			"uid": cook_uid,
			"fid": fid
		};
		ajax_all_Filed("true", "true", "POST", orderdeleteurl, "json", data, orderdelete); //调用函数
	});
})