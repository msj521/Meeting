$(function(){
	// 获取第一张图片的节点对象
var firstImg = $('#ul li').first().clone();
// 添加到最后的位置 并设置 ul 的宽度
$('#ul').append(firstImg).width($('#ul li').length * $('#ul img').width());

var i = 0;
var imgW = $('#ul img').width();
var timer;

// 下一张
$('#next').click(function() {
    moveImg(++i);
});

// 上一张
$('#prev').click(function() {
    moveImg(--i);
});

// 移动到指定的图片
function moveImg() {
    // alert(num);

    // 最后一张
    if (i == $('#ul li').length) {
        $('#ul').css({
            left: 0
        })
        i = 1;
    }

    // 是第一张的时候			
    if (i == -1) {
        i = $('#ul li').length - 2;
        $('#ul').css({
            left: ($('#ul li').length - 1) * -800
        });
    }

    // 移动图片动画
    $('#ul').stop().animate({
        left: i * -imgW
    }, 400);
    // // 换一下每个图片的小标记
    if (i == ($('#ul li').length - 1)) {
        $('#ol li').eq(0).addClass('bg').siblings().removeClass('bg');
    } else {
        $('#ol li').eq(i).addClass('bg').siblings().removeClass('bg');
    }
}


// 点击小图片，跳转到指定的图片
//$('#ol li').click(function() {
//  i = $(this).index();
//  moveImg();
//});
$(function(){
	$('#ol').on('click','li',function(){
		i = $(this).index();
	    moveImg();
	})
})

function autoPlay() {
    timer = setInterval(function() {
        i++;
        moveImg();
    }, 3000);
}

autoPlay();

// 鼠标移入幻灯片清除定时器
$('#play').mouseover(function() {
    $('#play button').show();
    clearInterval(timer)
}).mouseout(function() {
    // 鼠标离开重新播放
    autoPlay();
    $('#play button').hide();
})

})

