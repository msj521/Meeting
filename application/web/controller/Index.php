<?php
namespace app\web\controller;

use think\Controller;
use think\Db;
class Index extends Controller
{
    protected function _initialize() {
        parent::_initialize();
        $html=web_menu();
        $this->assign("html",$html);
    }

    public function index()
    {
       return $this->fetch("index/index");
    }
    public function meeting()
    {
       return $this->fetch("meeting/index");
    }
    public function live()
    {
       return $this->fetch("live/index");
    }
    public function video()
    {
       return $this->fetch("video/index");
    }
    public function livesinfo(){
    	return $this->fetch("live/live_info");
    }
    public function convention(){
    	return $this->fetch("meeting/meeting_info");
    }
    public  function videoinfo(){
    	return $this->fetch("video/video_info");
    }
    public function recordinfo(){
    	return $this->fetch("video/record_info");
    }
	public function introduce(){
		$this->assign('module','B1');
    	return $this->fetch("meeting/introduce");
    }
    public function expertlist(){
    	return $this->fetch("meeting/expertlist");
    }
    public function expertinfo(){
    	return $this->fetch("meeting/expertinfo");
    }
    public function schedule(){
    	return $this->fetch("meeting/schedule");
    }
    public function paper(){
    	return $this->fetch("meeting/paper");
    }
    public function zhwen(){
    	$this->assign('module','A2');
    	return $this->fetch("meeting/hotel");
    }
    public function newsinfo(){
    	return $this->fetch("meeting/newsinfo");
    }
    public function payment(){
    	return $this->fetch("meeting/payment");
    }
    public function login(){
    	return $this->fetch("login/index");
    }
    public function forget(){
    	return $this->fetch("login/forget_pwd");
    }
    public function userinfo(){
    	return $this->fetch("user/index");
    }
    
    public function mytrain(){
    	return $this->fetch("user/mytrain");
    }
    
    public function mydownload(){
    	return $this->fetch("user/mydownload");
    }
    public function shoplist(){
    	return $this->fetch("user/shoplist");
    }
    public function meetingname(){
    	return $this->fetch("user/meetingname");
    }
    public function modify(){
    	return $this->fetch("user/modify");
    }
    public function siginfo(){
    	return $this->fetch("meeting/siginfo");
    }
     public function courseware(){
		// $this->assign('module','B2');
    	return $this->fetch("meeting/meeting_pdf");
    }
     public function paperji(){
		$this->assign('module','B3');
    	return $this->fetch("meeting/introduce");
    }
     public function assembly(){
		$this->assign('module','B4');
    	return $this->fetch("meeting/introduce");
    }
    public function manual(){
		$this->assign('module','B5');
    	return $this->fetch("meeting/introduce");
    }
    public function city(){
    	$this->assign('module','Z');
    	return $this->fetch("meeting/hotel");
    }
    public function hotel(){
		$this->assign('module','V');
    	return $this->fetch("meeting/hotel");
    }
    public function huichang(){
    	$this->assign('module','X');
    	return $this->fetch("meeting/hotel");
    }
    public function diet(){
    	$this->assign('module','N');
    	return $this->fetch("meeting/hotel");
    }
    public function lijiejj(){
    	$this->assign('module','A1');
    	return $this->fetch("meeting/hotel");
    }
    public function mishuchu(){
    	return $this->fetch("meeting/mishuchu");
    }
    public function metlive(){
    	return $this->fetch("meeting/live");
    }
    public function map(){
    	return $this->fetch("meeting/map");
    }
    public function support(){
    	return $this->fetch("meeting/support");
    }
    public function silhouette(){
    	return $this->fetch("meeting/silhouette");
    }
    public function honor(){
    	return $this->fetch("meeting/honor");
    }
    public function register(){
    	return $this->fetch("register/register");
    }
    public function searchlist(){
    	return $this->fetch("public/searchlist");
    }
    public function xieyi(){
    	return $this->fetch("public/xieyi");
    }
    public function about(){
    	return $this->fetch("public/about");
    }
    public function copyright(){
    	return $this->fetch("public/copyright");
    }
    public function disclaimer(){
    	return $this->fetch("public/disclaimer");
    }
    public function report(){
    	return $this->fetch("public/report");
    }
    public function contact(){
    	return $this->fetch("public/contact");
    }
    public function tips(){
    	return $this->fetch("public/tips");
    }
    public function ip_guide(){
    	return $this->fetch("public/ip_guide");
    }
    public function ip_baomin(){
    	return $this->fetch("public/ip_baomin");
    }
    public  function ip_pady(){
    	return $this->fetch("public/ip_pady");
    }
    public  function ip_mishu(){
    	return $this->fetch("public/ip_mishu");
    }
    public  function ip_czs(){
    	return $this->fetch("public/ip_czs");
    } 
    public  function ip_zhwen(){
    	return $this->fetch("public/ip_zhwen");
    }
    public  function ip_contact(){
    	return $this->fetch("public/ip_contact");
    }
    public  function ip_annual_baomin(){
    	return $this->fetch("public/ip_annual_baomin");
    }
    public  function agenda(){
    	return $this->fetch("meeting/agenda");
    }
    public  function abstract_list(){
    	return $this->fetch("meeting/abstract_list");
    }
    public  function add_abstract(){
    	return $this->fetch("meeting/add_abstract");
    }
     public  function annual_meeting(){
    	return $this->fetch("meeting/annual_meeting");
    }
    public  function annual_meeting_payment(){
    	return $this->fetch("meeting/annual_meeting_payment");
    }
    public  function invoice(){
    	return $this->fetch("meeting/invoice");
    }
    public  function invoice_info(){
    	return $this->fetch("meeting/invoice_info");
    }
	    public  function ip_annual_meeting(){
    	return $this->fetch("public/ip_annual_meeting");
    }
    public  function ip_annual_meeting02(){
    	return $this->fetch("public/ip_annual_meeting02");
    }
    public  function ip_annual_meeting03(){
    	return $this->fetch("public/ip_annual_meeting03");
    }
    public  function ip_fapiao(){
    	return $this->fetch("public/ip_fapiao");
    }
    //SIFIC2019感控实践优秀基层医院 活动方案
    public  function programme(){
      return $this->fetch("meeting/programme");
   }
   //SIFIC2019感控实践优秀基层医院 活动方案详情
   public  function programme_detail(){
      return $this->fetch("meeting/programme_detail");
   }
   //SIFIC2019卓越感控追梦之星
   public function excellent_person(){
      return $this->fetch("meeting/excellent_person");
   }

   public function excellent_introduce(){
      return $this->fetch("meeting/excellent_introduce");
   }

   //SIFIC2019现场签到
   public function Training_Sigin()
   {
      return $this->fetch("index/training_sigin");
   }
   //SIFIC2019现场发票采集
   public function Gather_Invoice()
   {
      return $this->fetch("index/gather_tnvoice");
   }
   //ICU开班签到
   public function sign_in()
   {
      return $this->fetch("other/SignIn");
   }
   //调研问卷
   public function feedback()
   {
      return $this->fetch("other/feedBack");
   }
   public function NoticeRead()
   {
      return $this->fetch("meeting/system_message");
   }
}
