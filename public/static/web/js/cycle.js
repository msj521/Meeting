var overlay;
/*
 * ȫѡ�ͷ�ѡ
 */

// --��ͷȫѡ�򱻵���---
function ChkAllClick(sonName, cbAllId) {
    var arrSon = document.getElementsByName(sonName);
    var cbAll = document.getElementById(cbAllId);
    var tempState = cbAll.checked;
    for (i = 0; i < arrSon.length; i++) {
        if (arrSon[i].checked != tempState) arrSon[i].click();
    }
    
}

// --���ѡ�򱻵���---
function ChkSonClick(sonName, cbAllId) {
    var arrSon = document.getElementsByName(sonName);
    var cbAll = document.getElementById(cbAllId);
    
    for (var i = 0; i < arrSon.length; i++) {
        if (!arrSon[i].checked) {
        	
            cbAll.checked = false;
            return;
        }
    }
    cbAll.checked = true;
}

// --��ѡ������---
function ChkOppClick(sonName) {
    var arrSon = document.getElementsByName(sonName);
    for (i = 0; i < arrSon.length; i++) {
        arrSon[i].click();
    }
}


/*--------loading���ط���----------------------*/
//loading 
function loading_chc(){
	var opts = {
		lines: 13, // The number of lines to draw
		length: 11, // The length of each line
		width: 5, // The line thickness
		radius: 17, // The radius of the inner circle
		corners: 1, // Corner roundness (0..1)
		rotate: 0, // The rotation offset
		color: '#FFF', // #rgb or #rrggbb
		speed: 1, // Rounds per second
		trail: 60, // Afterglow percentage
		shadow: false, // Whether to render a shadow
		hwaccel: false, // Whether to use hardware acceleration
		className: 'spinner', // The CSS class to assign to the spinner
		zIndex: 2e9, // The z-index (defaults to 2000000000)
		top: 'auto', // Top position relative to parent in px
		left: 'auto' // Left position relative to parent in px
	};
	
	var demo = document.createElement("div");
	demo.setAttribute("id","demo");
	demo.style.background="#0ba29b";
	//demo.style.position="absolute";
	demo.style.position="fixed";
	demo.style.width="100%";
	demo.style.height="100%";
	
	var target = document.createElement("div");
	document.body.appendChild(demo);
	demo.appendChild(target);
	var spinner = new Spinner(opts).spin(target);
	overlay = iosOverlay({
		text: "Loading",
		spinner: spinner
	});



	return false;
}


//ʱ�����͸�ʽת��
Date.prototype.format = function(format){
        var o = {
            "M+" : this.getMonth()+1, //month
            "d+" : this.getDate(), //day
            "h+" : this.getHours(), //hour
            "m+" : this.getMinutes(), //minute
            "s+" : this.getSeconds(), //second
            "q+" : Math.floor((this.getMonth()+3)/3), //quarter
            "S" : this.getMilliseconds() //millisecond
        }

        if(/(y+)/.test(format)) {
            format = format.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));
        }

        for(var k in o) {
            if(new RegExp("("+ k +")").test(format)) {
                format = format.replace(RegExp.$1, RegExp.$1.length==1 ? o[k] : ("00"+ o[k]).substr((""+ o[k]).length));
            }
        }
        return format;
    }

//��ȡ�������Ӣ��
     function toWeek(week){
     	var enWeek="";
     	switch(week){
    		case 0:
    			enWeek="Sunday";
    		break;
    		case 1:
    			enWeek="Monday";
    		break;
    		case 2:
    			enWeek="Tuesday";
    		break;
    		case 3:
    			enWeek="Wednesday";
    		break;
    		case 4:
    			enWeek="Thursday";
    		break;
    		case 5:
    			enWeek="Friday";
    		break;
    		case 6:
    			enWeek="Saturday";
    		break;
    	}
    	return enWeek;
     }
     
      function toMonth(month){
     	var enmonth="";
     	switch(month){
    		case 1:
    			enmonth="January";
    		break;
    		case 2:
    			enmonth="February";
    		break;
    		case 3:
    			enmonth="March";
    		break;
    		case 4:
    			enmonth="April";
    		break;
    		case 5:
    			enmonth="May";
    		break;
    		case 6:
    			enmonth="June";
    		break;
    		case 7:
    			enmonth="July";
    		break;
    		case 8:
    			enmonth="August";
    		break;
    		case 9:
    			enmonth="September";
    		break;
    		case 10:
    			enmonth="October";
    		break;
    		case 11:
    			enmonth="November";
    		break;
    		case 12:
    			enmonth="December";
    		break;
    	}
    	return enmonth;
     }
      
  //ת������ΪӢ�ĸ�ʽ
      function forEngDate(data){
    	  
    	  var dt = new Date(Date.parse(data.replace(/-/g, "/")));
		    //var m=new Array("January","Feb","Mar","Apr","May","Jun","Jul","Aug","Spt","Oct","Nov","Dec");
		    var days_=dt.getDate();
		    //var d=new Array("st","nd","rd","th");
		    mn=dt.getMonth()+1;
		    wn=dt.getDay();
		    
		    /*��
		    dn=dt.getDate();
		    var dns;
		    if(((dn)<1) ||((dn)>3)){
		    	dns=d[3];
		    }
		    else
		    {
			    dns=d[(dn)-1];
			    if((dn==11)||(dn==12)){
			    	dns=d[3];
			    }
		    }
		    */
		    
		   // console.log(toWeek(wn)+", "+toMonth(mn)+" "+days_+","+dt.getFullYear());
    	  return toWeek(wn)+", "+toMonth(mn)+" "+days_+","+dt.getFullYear();
      }
      
      
    //�������������������ʱ�򸡶�
	function scrollFixed_Div($div_){
		//��ȡҪ��λԪ�ؾ�������������ľ���
	    var navH = $div_.offset().top;
	
	    //�������¼�
	    $(window).scroll(function() {
	        //��ȡ�������Ļ�������
	        var scroH = $(this).scrollTop();
	        //�������Ļ���������ڵ��ڶ�λԪ�ؾ�������������ľ��룬�͹̶�����֮�Ͳ��̶�
	        if (scroH >= navH) {
	            $div_.css({
	                "position": "fixed",
	                "top": 0,
	                "width":1105,
	                "z-index":10001
	            });
	        } else if (scroH<navH) {
	            $div_.css({
	                "position": "static"
	            });
	        }
	    });
	}
	
	//��ȡ����
	function getUrlParam(name){
	    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)"); //����һ������Ŀ�������������ʽ����
	    var r = window.location.search.substr(1).match(reg);  //ƥ��Ŀ�����
	    if (r!=null) return unescape(r[2]); return null; //���ز���ֵ
	}
	
	
	//ƴ��ʱ��������ַ���--12:20-15:30
	function showTimes_(times_){
		//alert(times_);
	//	console.log(times_);
			var houseTiem="";
					//ƴ��ʱ���ַ���
					var time_1=times_.split(" ")[1].split("-")[0],//ʱ���
						time_2=times_.split(" ")[1].split("-")[1];
						
						//alert('Date.parse(times_.split(" ")[0]+" "+time_1)='+times_.split(" ")[0]+" "+time_1);
						//Date.parse(data.replace(/-/g, "/"))
					var t1_=Date.parse((times_.split(" ")[0]+" "+time_1).replace(/-/g, "/")),
						t2_=Date.parse((times_.split(" ")[0]+" 12:00").replace(/-/g, "/")),
						t3_=Date.parse((times_.split(" ")[0]+" "+time_2).replace(/-/g, "/")),
						t4_=Date.parse((times_.split(" ")[0]+" 12:00").replace(/-/g, "/"));
							//console.log("t1_<t2_="+(t1_<t2_)+"--t3_<t4_="+(t3_<t4_));
					if(t1_<t2_){
						//houseTiem+=time_1+" am";
						houseTiem+=parseInt(time_1.split(":")[0])+":"+time_1.split(":")[1]+" am";
					}else{
						if(time_1.split(":")[0]<=12){
							houseTiem+=(time_1.split(":")[0])+":"+time_1.split(":")[1]+" pm";
						}else{
							houseTiem+=(time_1.split(":")[0]-12)+":"+time_1.split(":")[1]+" pm";
							//houseTiem+=time_1+" pm";
						}
					}

					if(t3_<t4_){
						//houseTiem+="-"+time_2+" am";
						houseTiem+="-"+parseInt(time_2.split(":")[0])+":"+time_2.split(":")[1]+" am";
						 
					}else{
						if(time_2.split(":")[0]<=12){
							houseTiem+="-"+(time_2.split(":")[0])+":"+time_2.split(":")[1]+" pm";
						}else{
							//houseTiem+="-"+time_2+" pm";
							houseTiem+="-"+(time_2.split(":")[0]-12)+":"+time_2.split(":")[1]+" pm";
						}
					}
					
					//console.log(houseTiem);
					return houseTiem;
					//alert(forEngDate(times_.split(" ")[0]));
	}