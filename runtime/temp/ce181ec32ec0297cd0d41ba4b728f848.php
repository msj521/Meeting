<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:88:"/home/wwwroot/default/SIFIC/public/../application/web/view/public/ip_annual_meeting.html";i:1548325864;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>会议报名</title>
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta content="telephone=no" name="format-detection"/>
    <link rel="stylesheet" href="/static/web/css/ydui.css?rev=@@hash"/>
    <link rel="stylesheet" href="/static/web/css/demo.css"/>
    <script src="/static/web/js/ydui.flexible.js"></script>
	<script type="text/javascript">
		function getQueryString(name) {
			var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
			var r = window.location.search.substr(1).match(reg);
			if(r != null) return decodeURI(r[2]);
			return null;
		}
		var convention_id = getQueryString("convention_id");
		var cook_uid = getQueryString("cook_uid");
        var cook_token = getQueryString("cook_token");
//		var convention_id = 45;
//		var cook_uid = 2641;
//		var cook_token='ec1d65127d3d7db5890c429e85237a4f2029eb2e'
	</script>
	<style>
	.cell-select{height: 0.6rem; width: 100%;}
	.hairline .g-scrollview{padding-bottom: 1rem;}
	</style>
</head>
<body style="background: #F1F4F6;">
<section class="g-flexview">
    <section class="g-scrollview">
		<div class="ip_annual_ct">
			<div id="title_abs" style=" margin-bottom: 0.3rem; display: inline-block; width: 100%;"></div>
			<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					邮箱<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<input type="text" name="" id="email" value="" class="txtinput" />
				</div>
			</div>	
			<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					姓名<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<input type="text" name="" id="user_name" value="" class="txtinput" style="width: 60%; float: left;" />
					<input type="button" id="getinfo_btn" value="获取个人信息"/>
				</div>
			</div>	
		</div>
		<p style="color: #598DC4; padding: 0.2rem;" > （如果您去年注册过，请填写去年注册所用的邮箱及姓名，点击获取个人信息， 即可显示您的信息，请仔细核对您的信息，如果没有，请直接填写。）</p>
		<div class="ip_annual_ct">
			<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					是否需要学分<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<select class="cell-select" id="credit_status">
		                <option value="0">请选择</option>
						<option value="1">是</option>
						<option value="2">否</option>
		            </select>
				</div>
			</div>	
			<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					出生年月<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<input type="text" name="" id="credit_time" value="" class="txtinput" />
				</div>
			</div>	
			<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					称谓<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<select class="cell-select" id="gender">
		                <option value="0">请选择</option>
						<option value="1">先生</option>
						<option value="2">女士</option>
		            </select>
				</div>
			</div>	
			<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					职位<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<input type="text" name="" id="job_id" value="" class="txtinput" />
				</div>
			</div>	
			<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					部门/科室<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<select class="cell-select" id="deparitment">
		                <option value="0">请选择</option>
		            </select>
				</div>
			</div>	
			<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					职称级别<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<select class="cell-select" id="credit_type">
						<option value="0">请选择</option>
		            </select>
				</div>
			</div>	
			<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					职称<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<select class="cell-select" id="credit_title">
		               
		            </select>
				</div>
			</div>	
			<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					是否来自基层<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<select class="cell-select" id="basic_level">
		                <option value="">请选择</option>
						<option value="1">是</option>
						<option value="0">否</option>
		            </select>
				</div>
			</div>	
			<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					毕业时间<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<input type="text" name="" id="graduation_time" value="" class="txtinput" />
				</div>
			</div>	
			<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					最高学历<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<select class="cell-select" id="education_id">
		                <option value="0">请选择</option>
		            </select>
				</div>
			</div>	
			<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					学位<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<select class="cell-select" id="degree_id">
		               <option value="0">请选择</option>
		            </select>
				</div>
			</div>	
			<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					省份/城市<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<select class="cell-select" id="province_id" style="width: 48%; float: left;">
		               <option value="0">请选择省</option>
		            </select>
		            <select class="cell-select" id="city_id" style="width: 48%; float: right;">
		                <option value="0">请选择市</option>
		            </select>
				</div>
			</div>	
			<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					单位/企业<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<select class="cell-select" id="org_id"></select>
				</div>
			</div>
			<div class="ip_annual_ctlist" id="diy_orglist" style="display: none;">
				<div class="ip_annual_ctlist_txt">
					备注单位<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<input type="text" name="" id="diy_org" value="" class="txtinput" />
				</div>
			</div>
		</div>
		<p style="color: #598DC4; padding: 0.2rem;" >如果您未在以上列表中查找到您的单位信息，请勾选句末空白框，并请您在以上 框中填写您的单位名称</p>
    	<div class="ip_annual_ct">
    		<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					单位地址<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<input type="text" name="" id="unit_address" value="" class="txtinput" />
				</div>
			</div>	
			<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					身份证<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<input type="text" name="" id="card" value="" class="txtinput" />
				</div>
			</div>	
			<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					单位电话<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<input type="text" name="" id="unit_tel_guo" value="" class="txtinput" style="width: 25%; float: left;"/>
					<input type="text" name="" id="unit_tel_qu" value="" class="txtinput" style="width: 25%; float: left; margin: 0 5% 0 5%;"/>
					<input type="text" name="" id="unit_tel" value="" class="txtinput" style="width: 40%; float: right;"/>
					<p style="color: #598DC4;">（例如：86-21-12345687）</p>
				</div>
			</div>	
			<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					单位传真<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<input type="text" name="" id="unit_fax_guo" value="" class="txtinput" style="width: 25%; float: left;"/>
					<input type="text" name="" id="unit_fax_qu" value="" class="txtinput" style="width: 25%; float: left; margin: 0 5% 0 5%;"/>
					<input type="text" name="" id="unit_fax" value="" class="txtinput" style="width: 40%; float: right;"/>
					<p style="color: #598DC4;">（例如：86-21-12345687）</p>
				</div>
			</div>	
			<div class="ip_annual_ctlist">
				<div class="ip_annual_ctlist_txt">
					手机号<span>*</span>
				</div>
				<div class="ip_annual_ctlist_input">
					<input type="text" name="" id="tel_qu" value="" class="txtinput" style="width: 30%; float: left;" />
					<input type="text" name="" id="tel" value="" class="txtinput" style="width: 65%; float: right;"/>
					<p style="color: #598DC4;">（例如：86-137******86）</p>
				</div>
			</div>	
    	</div>
    	<div class="bottomlist">
    		<input type="button" name="" id="next_btn" value="下一步" class="next_btn"/>
    	</div>
    </section>
</section>
<link rel="stylesheet" type="text/css" href="/static/web/css/LCalendar.min.css"/>
<script type="text/javascript" src="/static/web/libs/jquery/jquery.js" ></script>
<script type="text/javascript" src="/static/web/js/LCalendar.js" ></script>
<script src="/static/web/js/ajax.js"></script>
<script src="/static/web/js/md5.js"></script>
<script src="/static/web/js/app/ip_annualsiginfo.js"></script>

</body>
</html>
<script type="text/javascript">
		var calendar = new LCalendar();
		var calendar2 = new LCalendar();
		calendar.init({
			'trigger': '#credit_time', //标签id
			'type': 'date', //date 调出日期选择 datetime 调出日期时间选择 time 调出时间选择 ym 调出年月选择,
		});
		calendar2.init({
			'trigger': '#graduation_time', //标签id
			'type': 'date', //date 调出日期选择 datetime 调出日期时间选择 time 调出时间选择 ym 调出年月选择,
		});

	</script>