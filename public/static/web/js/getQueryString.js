//var DEFAULT_VERSION = 8.0;
//		var ua = navigator.userAgent.toLowerCase();
//		var isIE = ua.indexOf("msie")>-1;
//		var safariVersion;
//		if(isIE){
//		safariVersion =  ua.match(/msie ([\d.]+)/)[1];
//		}
//		if(safariVersion <= DEFAULT_VERSION ){
//		  // 进行你所要的操作
//		  self.location='/tips'; 
//		  //window.location.href='';
//		};

/* 检查ie浏览器版本 */
(function() {
    var o = navigator.userAgent.match(/MSIE (\d+)/);
    o = o && o[1];
    // ie9 以下 || o != null
    if (!!o && o < 8) {
        // 更新页面
        var newUrl = '/tips';
        location.href = newUrl;
    }
})();

var storage = window.localStorage;
var preUrl = window.location.href; //获取用户浏览地址
var pu_url = "/login?preUrl=" + preUrl; //拼接跳转地址

// 创建Base64对象
var Base64 = {
        _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
        encode: function(e) {
            var t = "";
            var n, r, i, s, o, u, a;
            var f = 0;
            e = Base64._utf8_encode(e);
            while (f < e.length) {
                n = e.charCodeAt(f++);
                r = e.charCodeAt(f++);
                i = e.charCodeAt(f++);
                s = n >> 2;
                o = (n & 3) << 4 | r >> 4;
                u = (r & 15) << 2 | i >> 6;
                a = i & 63;
                if (isNaN(r)) {
                    u = a = 64
                } else if (isNaN(i)) {
                    a = 64
                }
                t = t + this._keyStr.charAt(s) + this._keyStr.charAt(o) + this._keyStr.charAt(u) + this._keyStr.charAt(a)
            }
            return t
        },
        decode: function(e) {
            if (e == undefined || e == null) {
                return ""
            }
            var t = "";
            var n, r, i;
            var s, o, u, a;
            var f = 0;
            e = e.replace(/[^A-Za-z0-9+/=]/g, "");
            while (f < e.length) {
                s = this._keyStr.indexOf(e.charAt(f++));
                o = this._keyStr.indexOf(e.charAt(f++));
                u = this._keyStr.indexOf(e.charAt(f++));
                a = this._keyStr.indexOf(e.charAt(f++));
                n = s << 2 | o >> 4;
                r = (o & 15) << 4 | u >> 2;
                i = (u & 3) << 6 | a;
                t = t + String.fromCharCode(n);
                if (u != 64) {
                    t = t + String.fromCharCode(r)
                }
                if (a != 64) {
                    t = t + String.fromCharCode(i)
                }
            }
            t = Base64._utf8_decode(t);
            return t
        },
        _utf8_encode: function(e) {
            e = e.replace(/rn/g, "n");
            var t = "";
            for (var n = 0; n < e.length; n++) {
                var r = e.charCodeAt(n);
                if (r < 128) {
                    t += String.fromCharCode(r)
                } else if (r > 127 && r < 2048) {
                    t += String.fromCharCode(r >> 6 | 192);
                    t += String.fromCharCode(r & 63 | 128)
                } else {
                    t += String.fromCharCode(r >> 12 | 224);
                    t += String.fromCharCode(r >> 6 & 63 | 128);
                    t += String.fromCharCode(r & 63 | 128)
                }
            }
            return t
        },
        _utf8_decode: function(e) {
            var t = "";
            var n = 0;
            var r = c1 = c2 = 0;
            while (n < e.length) {
                r = e.charCodeAt(n);
                if (r < 128) {
                    t += String.fromCharCode(r);
                    n++
                } else if (r > 191 && r < 224) {
                    c2 = e.charCodeAt(n + 1);
                    t += String.fromCharCode((r & 31) << 6 | c2 & 63);
                    n += 2
                } else {
                    c2 = e.charCodeAt(n + 1);
                    c3 = e.charCodeAt(n + 2);
                    t += String.fromCharCode((r & 15) << 12 | (c2 & 63) << 6 | c3 & 63);
                    n += 3
                }
            }
            return t
        }
    }
    //获取参数方法
function getQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return decodeURI(r[2]);
    return null;
}
var live_id = getQueryString("live_id");
var video_id = getQueryString("video_id");
var training_id = getQueryString("training_id");
var convention_id = 47; //getQueryString("convention_id");
var expert_id = getQueryString("expert_id");
var keyword = getQueryString("keyword");
var nav_id = getQueryString("nav_id");
var suid = getQueryString("suid");
var news_id = getQueryString("news_id");
var type = getQueryString("type");
var sr = getQueryString("sr");
//html转义
function htmls(a) {
    a = "" + a;
    return a.replace(/&lt;/g, "<").replace(/&gt;/g, ">").replace(/&amp;/g, "&").replace(/&quot;/g, '"').replace(/&apos;/g, "'");
}
//时间截取年月天
function timeStamp2String(time) {

    return time ? time.substr(0, 10) : '';
}

//获取浏览器信息
var userAgent = navigator.userAgent.toLowerCase();
jQuery.browser = {
    version: (userAgent.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [])[1],
    safari: /webkit/.test(userAgent),
    opera: /opera/.test(userAgent),
    msie: /msie/.test(userAgent) && !/opera/.test(userAgent),
    mozilla: /mozilla/.test(userAgent) && !/(compatible|webkit)/.test(userAgent)
};
//获取cookie

var cook_tel = $.cookie("tel"); //获取cookie中的用户名    
var cook_pwd = $.cookie("pwd"); //获取cookie中的登陆密码    
var cook_token = $.cookie("cook_token");
var cook_uid = $.cookie("cook_uid");

//获取验证码
var countdown = 60;

function settime(obj) {
    if (countdown == 0) {
        obj.removeAttribute("disabled");
        $("#yzm_btn").removeClass("yzm_btn")
        $("#yzm_btn").addClass("yzm_btn2");
        obj.value = "免费获取验证码";
        countdown = 60;
        return;
    } else {
        obj.setAttribute("disabled", true);
        $("#yzm_btn").removeClass("yzm_btn2");
        $("#yzm_btn").addClass("yzm_btn");
        obj.value = "重新发送(" + countdown + ")";
        countdown--;
    }
    setTimeout(function() {
        settime(obj)
    }, 1000)
}

//封装弹框
function showPrompt(tip) {
    $('body #alert').remove();
    $('<div class="pulic_t_div" id="alert"><div class="pulic_t_divct"><div class="pulic_t_txt"><div class="daytiem_close"></div><div class="subject_title">提示</div><div class="subject_txt">' + tip + '</div><div style="width: 100%; float: left; text-align: center;"><button class="subject_t_btn" id="alert_btn">确定</button></div></div></div></div>').appendTo('body');
    return false;
}

function showLaert(tip) {
    $('body #alert').remove();
    $('<div class="pulic_t_div" id="alert"><div class="pulic_t_divct"><div class="pulic_t_txt"><div class="daytiem_close"></div><div class="subject_title">提示</div><div class="subject_txt">' + tip + '</div><div style="width: 100%; float: left; text-align: center;"><button class="subject_t_btn" id="alert_btn">确定</button></div></div></div></div>').appendTo('body');
    return false;
}

function appShowAlert(tip) {
    $('body .alert').remove();
    $('<div class="alert"><div class="alert_box"><h5>提示</h5><p>' + tip + '</p><button onclick="removeAlert()">确定</button></div></div>').appendTo('body');
    return false;
}

function removeAlert() {
    $('body .alert').remove();
}

//获取当前时间戳
function getNowTime() {
    var nowTime = new Date();
    return nowTime.getTime();
}

//获取未来时间戳
function setFutureTime(y, m, d, h, minu, sec) {
    h = h || 0;
    minu = minu || 0;
    sec = sec || 0;
    var futureTime = new Date();
    futureTime.setFullYear(y, m, d);
    futureTime.setHours(h);
    futureTime.setMinutes(minu);
    futureTime.setSeconds(sec);
    return futureTime.getTime();
}

function Loadings() {
    $('<div class="newloading"><img src="/static/web/images/loading.gif"/>></div>').appendTo('body');
}



var creditarr = new Array();

//页面加载完毕后开始执行的事件
creditarr = [{
        id: 116,
        list: [
            { name: "主任医师" },
            { name: "主任药师" },
            { name: "主任护师" },
            { name: "主任技师" },
            { name: "教授" },
            { name: "研究员" },
            { name: "副主任医师" },
            { name: "副主任药师" },
            { name: "副主任护师" },
            { name: "副主任技师" },
            { name: "副教授" },
            { name: "副研究员" },
            { name: "非医疗类" }
        ]
    },
    {
        id: 115,
        list: [
            { name: "主治医师" },
            { name: "主管药师" },
            { name: "主管护师" },
            { name: "主管技师" },
            { name: "讲师" },
            { name: "助理研究员" },
            { name: "非医疗类" }

        ]
    },
    {
        id: 114,
        list: [
            { name: "医师" },
            { name: "医士" },
            { name: "药师" },
            { name: "药士" },
            { name: "护师" },
            { name: "护士" },
            { name: "技师" },
            { name: "技士" },
            { name: "助理讲师" },
            { name: "研究实习员" },
            { name: "非医疗类" },

        ]
    },
]