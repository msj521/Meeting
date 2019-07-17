$(function () {

	 var $div_li =$("div.about_class ul li");
		    $div_li.click(function(){
				$(this).addClass("selected")            //当前<li>元素高亮
					   .siblings().removeClass("selected");  //去掉其他同辈<li>元素的高亮
	            var index =  $div_li.index(this);  // 获取当前点击的<li>元素 在 全部li元素中的索引。
				$("div#oboutlist > div")   	//选取子节点。不选取子节点的话，会引起错误。如果里面还有div 
						.eq(index).show()   //显示 <li>元素对应的<div>元素
						.siblings().hide(); //隐藏其他几个同辈的<div>元素
			})
		    
		$(".meeting_nav_ul li:has(div)").hover(function(){
			$(this).children("div").show();
        },function(){
		    $(this).children("div").hide();
		});	
	//会议切换
	var $mtclass_li =$("div.mtclass ul li");
		    $mtclass_li.click(function(){
				$(this).addClass("action")           
					   .siblings().removeClass("action");  
	            var index =  $mtclass_li.index(this);  
				$("div.mtcontent > div").eq(index).show().siblings().hide(); 
				
			})
	var $about_classlistlf_li =$("div.about_classlistlf ul li a");
	    $about_classlistlf_li.click(function(){
			$(this).addClass("action")           
				   .parent().siblings().find('a').removeClass("action");  
	        var index =  $about_classlistlf_li.index(this);  
			$("div.about_classlistrg > div").eq(index).show().siblings().hide(); 
			
		})
	    var $div_li2 =$("div.btn-group a");
	    $div_li2.click(function(){
			$(this).addClass("action")           
				   .siblings().removeClass("action");  
	        var index =  $div_li2.index(this);  
			$("div.huiyitime > div").eq(index).show().siblings().hide(); 
			
		})
	    var $div_li3 =$("div.zhuansech a");
	    $div_li3.click(function(){
			$(this).addClass("action").siblings().removeClass("action");  
			
		})
	    //详情切换
	    
	     var $div_info =$("div.tablist ul li");
	    $div_info.click(function(){
			$(this).addClass("action")           
				   .siblings().removeClass("action");  
	        var index =  $div_info.index(this);  
			$("div.tablistct > div").eq(index).show().siblings().hide(); 
			
		})
	    
	    /*个人中心*/
	    var $userlistlf_nav =$("div.userlistlf_nav ul li a");
	    $userlistlf_nav.click(function(){
			$(this).addClass("action")           
				   .parent().siblings().find('a').removeClass("action");  
			
		})
	    
	    /*弹框*/
	   $(".closes").click(function(){
	   	 $(".uplist").hide();
	   });
	   $(".modifyrg a").click(function(){
	   	$(".uplist").show();
	   })
	   
	   $(".closes2").click(function(){
	   	 $(".uplist2").hide();
	   });
	   $(".modifylf a").click(function(){
	   	$(".uplist2").show();
	   })
	   
	   
	//鼠标移动
	 $(".bg_img").hover(function () {
        	$(".bg_ct").show();
       }, function () {
            $(".bg_ct").hide();
          })
        
       
         
        //学院滑动效果
        $(".fenleiul li").hover(function(){
        	$(this).find('.fltitle').animate({
				    top:'-30px',
				  });
			 $(this).find(".ab_ct").show();	  
        },function(){
        	$(this).find('.fltitle').animate({
				    top:'',
				  });
			$(this).find(".ab_ct").hide();
        })
        
       
		//视频弹框
		$("#closes").click(function(){
			$(".prompt").hide();
		})
		$(".btnps").click(function(){
			$(".prompt").hide();
		})
			//判断是否IE8执行
		if($.support.leadingWhitespace){
			
		}else{
			$(".kjrukul li:nth-child(2)").css("float","left","margin-left","450px");
			$(".kjrukul li:nth-child(3)").css("float","right");
			$(".huiy02img:nth-child(1)").css("margin-bottom","10px");
//			$(".bg_ct").text("aaaa")
		}
		
		//学院新样式事件
		$(".college_ul li").hover(function(){
        	$(this).find('.college_ct').show();
        },function(){
        	$(this).find('.college_ct').hide();
        })
		
		$('#firstpane').on('click', 'h3', function() {
		   if($(this).hasClass('current')){
		        $(this).removeClass("current").next("div.menu_body").slideUp("slow");
				$(this).parent().siblings().find("h3.menu_head").removeClass("current").next('div.menu_body').slideUp("slow");
		    }else{
		        $(this).addClass('current').next("div.menu_body").slideDown("slow");
				$(this).parent().siblings().find("h3.menu_head").removeClass("current").next('div.menu_body').slideUp("slow");
		    }
		});
		
		$('#firstpane2').on('click', 'h3', function() {
		    if($(this).hasClass('current2')){
		        $(this).removeClass("current2").next("div.menu_body2").slideUp("slow");
				$(this).parent().siblings().find("h3.menu_head2").removeClass("current2").next('div.menu_body2').slideUp("slow");
		    }else{
		        $(this).addClass('current2').next("div.menu_body2").slideDown("slow");
				$(this).parent().siblings().find("h3.menu_head2").removeClass("current2").next('div.menu_body2').slideUp("slow");
		    }
		});
		
		
	//首页滑动
	$('.live_ul').on('mouseenter', 'li', function() {//绑定鼠标进入事件
	   $(this).find('.layer').show();
	});
	$('.live_ul').on('mouseleave', 'li', function() {//绑定鼠标划出事件
	    $(this).find('.layer').hide();
	});
	
	 //会议列表表滑动
        $('.meeting_ul').on('mouseenter', 'li', function() {//绑定鼠标进入事件
		   	$(this).find('.mt_layer').show();
			});
		$('.meeting_ul').on('mouseleave', 'li', function() {//绑定鼠标划出事件
			$(this).find('.mt_layer').hide();
		});
          //会议模块滑动
        $('.meeting_ul2').on('mouseenter', 'li', function() {//绑定鼠标进入事件
		   	$(this).find('.mt_layer').show();
			});
		$('.meeting_ul2').on('mouseleave', 'li', function() {//绑定鼠标划出事件
			$(this).find('.mt_layer').hide();
		});
         //培训列表表滑动
        $('.train_ul').on('mouseenter', 'li', function() {//绑定鼠标进入事件
		   	$(this).find('.train_layer').show();
			});
		$('.train_ul').on('mouseleave', 'li', function() {//绑定鼠标划出事件
			$(this).find('.train_layer').hide();
		});
        //培训
        $('.train_ul2').on('mouseenter', 'li', function() {//绑定鼠标进入事件
		   	$(this).find('.train_layer').show();
			});
		$('.train_ul2').on('mouseleave', 'li', function() {//绑定鼠标划出事件
			$(this).find('.train_layer').hide();
		});
        //会议直播
        $('.mtlive_ul').on('mouseenter', 'li', function() {//绑定鼠标进入事件
		   	$(this).find('.layer').show();
			});
		$('.mtlive_ul').on('mouseleave', 'li', function() {//绑定鼠标划出事件
			$(this).find('.layer').hide();
		});

        $('.user_train_ul').on('mouseenter', 'li', function() {//绑定鼠标进入事件
		   	$(this).find('.user_train_layer').show();
			});
		$('.user_train_ul').on('mouseleave', 'li', function() {//绑定鼠标划出事件
			$(this).find('.user_train_layer').hide();
		});

		  //搜索会议模块滑动
        $('.list_p2').on('mouseenter', 'li', function() {
		   	$(this).find('.mt_layer').show();
			});
		$('.list_p2').on('mouseleave', 'li', function() {
			$(this).find('.mt_layer').hide();
		});
		  //搜索直播模块滑动
        $('.list_p2').on('mouseenter', 'li', function() {
		   	$(this).find('.layer').show();
			});
		$('.list_p2').on('mouseleave', 'li', function() {
			$(this).find('.layer').hide();
		});
		  //培训搜索模块滑动
        $('.list_p2').on('mouseenter', 'li', function() {
		   	$(this).find('.train_layer').show();
			});
		$('.list_p2').on('mouseleave', 'li', function() {
			$(this).find('.train_layer').hide();
		});

			//alert事件
		  $('body').on('click','#alert_btn', function() {
			   	$("#alert").hide();
			   	return true;
		  });
		  $('body').on('click','.daytiem_close', function() {
			   	$("#alert").hide();
			   	return true;
		  });
		  
		  //首页搜索事件
		var search_btn = $(".search_btn a");
		search_btn.click(function(){
				var searchName = $("#search").val();
				$(".search_btn a").attr("href","/searchlist?keyword="+searchName);
		})
		
		  //搜索模块滑动
        $('.searchlist').on('mouseenter', 'li', function() {//绑定鼠标进入事件
		   	$(this).find('.mt_layer').show();
			});
		$('.searchlist').on('mouseleave', 'li', function() {//绑定鼠标划出事件
			$(this).find('.mt_layer').hide();
		});
		$('.searchlist').on('mouseenter', 'li', function() {//绑定鼠标进入事件
		   	$(this).find('.layer').show();
			});
		$('.searchlist').on('mouseleave', 'li', function() {//绑定鼠标划出事件
			$(this).find('.layer').hide();
		});
		$('.searchlist').on('mouseenter', 'li', function() {//绑定鼠标进入事件
		   	$(this).find('.train_layer').show();
			});
		$('.searchlist').on('mouseleave', 'li', function() {//绑定鼠标划出事件
			$(this).find('.train_layer').hide();
		});
		
		
});



