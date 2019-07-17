<?php
namespace app\api\controller;

use think\Db;
use think\Model;
use think\Request;
use app\api\common\Base;
use app\api\model\AppInfo;
use Qcloud\Sms\SmsSingleSender;

class User extends Base {

    //个人中心 -- 获取用户基本资料
    public function UserInfo(){
        //获取用户名 token
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $uid =isset($heard['uid'])?$heard['uid']:0;
        //查询数据库，判断账号是否存在
		// ->field('fid,nick_name,user_name,tel,description,diy_org,email
        // ,education_id,education_name,job_id,org_id,org_name,app_image_id
        // ,department_id,department,depart,app_image_url,web_image_url,province_id,city_id,country_id')
        $result = Db::table("v_enduser")
        ->where(["fid"=>$uid,"record_status"=>1])
        ->find();
		

        if (!empty($result)) {
            $result['web_image_url'] = $result['web_image_url'];
            $result['app_image_url'] = $result['app_image_url'];
			$credit_type_name=Db::table('base_class_conf')->where(['fid'=>$result['credit_type'],'record_status'=>1])->value('class_name_zh');
			$credit_title_name=isset(Title_Level($result['credit_type'],'')[$result['credit_title']-1])?Title_Level($result['credit_type'],'')[$result['credit_title']-1]:'';
            $result['credit_type_name'] =$credit_type_name?$credit_type_name:"";
            $result['credit_title_name'] =$credit_title_name?$credit_title_name:"";	
            $notice_count = Db::table('convention_notice_info')->where(['record_status'=>1])->count();
            $user_notice_count = Db::table('convention_notice_detail')->where(['creator_id'=>$uid,'record_status'=>1])->count();
            $diff_count = $user_notice_count >= $notice_count ? 0 : $notice_count - $user_notice_count;
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                'data' => [
                    'user_info' => $result,
                    'user_notice'=>$diff_count,
                ]
            ];
        }else{
            $data = [
                'code' => '414',
                'msg' => '用户不存在',
            ];
        }
       echo json_encode($data);exit;
    }
    
    //根据省市获取医院
    public function OrgList(){
        $province_id = $this->request->get('province_id');
        $city_id = $this->request->get('city_id');
        $town_id = $this->request->get('town_id');
        $org_name = $this->request->get('org_name');
        $spell = $this->request->get('spell');

        $where = ['record_status'=>1];
        if ($province_id>0) {
            $where[] = ['province_id'=>$province_id];
        }
        if ($city_id>0) {
            $where[] = ['city_id'=>$city_id];
        }
        if ($town_id>0) {
            $where[] = ['town_id'=>$town_id];
        }
        if ($org_name != '') {
            $where['org_name'] = array('like', "%" . $org_name . "%");
        }
        if ($spell != '') {
            $where['spell'] = array('like', "%" . $spell . "%");
        }

        $Organizations = DB::table("base_org_conf")
                         ->where($where)
                         ->field("fid,org_name")
                         ->select();

        if(empty($Organizations)){
            $data = [
                'code' => '400',
                'msg' => '获取失败',
                'data' => []
            ];
        }else{
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                'data' => $Organizations
            ];
        }
        echo json_encode($data);exit;
    }

    //修改用户基本信息
    public function UpdateBase(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $data=array_filter($heard);
        $uid =isset($data['fid'])?$data['fid']:$data['uid'];
        //$this->checkToken($uid,$token);

        if(empty($data)|| empty($uid)){
            $data = [
                'code'=>'219',
                'msg'=>'参数有误'
            ];
          echo json_encode($data);exit;
        }
        
        $data['update_time']=date("Y-m-d H:i:s");
        $data=HandleParamsForInsert("enduser_info",$data);
        $user_info =Db::table("enduser_info")->where("fid",$uid)->update($data);
        $user_list =Db::table("v_enduser")->where("fid",$uid)->find();
        //echo Db::table("enduser_info")->getLastSql();die;
        if ($user_info) {
			$credit_type_name=Db::table('base_class_conf')->where(['fid'=>$user_list['credit_type'],'record_status'=>1])->value('class_name_zh');
			$credit_title_name=isset(Title_Level($user_list['credit_type'],'')[$user_list['credit_title']-1])?Title_Level($user_list['credit_type'],'')[$user_list['credit_title']-1]:'';
            $user_list['credit_type_name'] =$credit_type_name?$credit_type_name:"";
            $user_list['credit_title_name'] =$credit_title_name?$credit_title_name:"";		
            $data = [
                'code'=>'200',
                'msg'=>'修改成功',
                'data'=>$user_list
            ];
        }else{
            $data = [
                'code'=>'218',
                'msg'=>'修改失败'
            ];
        }
        echo json_encode($data);exit;
    }

    //修改密码
    public function UpdatePassword(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $uid =isset($heard['uid'])?$heard['uid']:'';
        $new_pwd =isset($heard['new_pwd'])?$heard['new_pwd']:'';
        $old_pwd =isset($heard['old_pwd'])?$heard['old_pwd']:'';
		
        $user_info = Db::table('enduser_info')->where(['fid'=>$uid,'record_status'=>1])->find();
        if ($user_info) {      
            $status = Db::table('enduser_info')->where(['fid'=>$uid])->update(['password'=>$new_pwd]);
            if ($status) {
                $data = [
                    'code'=>'200',
                    'msg'=>'修改成功',
                    'data'=>''
                ];
			//$param=['pwd'=>$new_pwd,'uid'=>$uid,'email'=>$user_info['email']];	
			//密码重置发送邮件
			//Send_Report(2,$param);	
            }else{
                $data = [
                    'code'=>'217',
                    'msg'=>'修改失败'
                ];
            }
        }else{
            $data = [
                'code'=>'218',
                'msg'=>'用户不存在或密码错误'
            ];
        }
        echo json_encode($data);exit;
    }

    /** 
     * 上传头像
     */
    public function UploadImg(){
        $xmlstr = file_get_contents('php://input')?file_get_contents('php://input') : gzuncompress($GLOBALS['HTTP_RAW_POST_DATA']);//得到post过来的二进制原始数据  
        $arr = explode("[x]",$data,3);  
        $url = $arr[0];  //网址参数  
        $sitename = $arr[1];  //站名参数  
        $data = $arr[2];  //图片二进制字符串  
        $filename=time().'.png';  
        if(file_put_contents($filename,$data)){  
            echo 'success';  
        }else{  
            echo 'failed';  
        }
    }
    /**
     * 购买记录
     */
    public function Order(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $page =isset($heard['page'])?$heard['page']:1;
        $pagesize =isset($heard['pagesize'])?$heard['pagesize']:40;
        if ($uid>0) {
            $product_order = Db::table('v_product_order')
            ->where(['user_id'=>$uid,'record_status'=>1])
            ->limit(($page-1)*$pagesize,$pagesize)
            ->select();
            $count = Db::table('v_product_order')
            ->where(['user_id'=>$uid,'record_status'=>1])
            ->count();
            $data = [
                'code'=>'200',
                'msg'=>'获取成功',
                'data' =>  [
                    'data' => $product_order,
                    'total' => $count
                ]
            ];
        }else{
            $data = [
                'code'=>'410',
                'msg'=>'获取失败'
            ];
        }
        echo json_encode($data);exit;
    }

    /**
     * 消息会议列表
     */
    public function NoticeConvention(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $page =isset($heard['page'])?$heard['page']:1;
        $pagesize =isset($heard['pagesize'])?$heard['pagesize']:40;
        if ($uid>0) {

            $convention_notice = Db::table('convention_notice_info')
            ->field('convention_id,count(1) as sum')
            ->where(['record_status'=>1])
            ->group('convention_id')
            ->select();

            $convention_notice_detail = Db::table('convention_notice_detail')
            ->field('convention_id,count(1) as sum')
            ->where(['creator_id'=>$uid,'record_status'=>1])
            ->group('convention_id')
            ->select();
            $convention_ids = [];
            foreach ($convention_notice as $key => $value) {
                $convention_ids[] = $key['convention_id'];
            }

            $convention_list = Db::table('v_convention')
            ->field('fid,convention_name,app_image_url as image_url,class_id,class_name')
            ->where(['record_status'=>1])
            ->wherein('convention_id',$convention_ids)
            ->limit($page,$pagesize)
            ->select();

            //计算未读消息数量
            foreach ($convention_list as &$con) {
                $fid = $con['fid'];
                $notice_num = 0;
                foreach ($convention_notice as $notice) {
                    if ($notice['convention_id']==$fid){
                        $notice_num = $notice['sum'];
                    }
                }
                $user_notice_num = 0;
                foreach ($convention_notice_detail as $det) {
                    if ($det['convention_id']==$fid){
                        $user_notice_num = $det['sum'];
                    }
                }
                $con['unread_num'] = $notice_count-$user_notice_num;
            }

            $data = [
                'code'=>'200',
                'msg'=>'获取成功',
                'data' => $convention_list
            ];
        }else{
            $data = [
                'code'=>'410',
                'msg'=>'获取失败'
            ];
        }
        echo json_encode($data);exit;
    }

    /**
     * 消息列表
     */
    public function NoticeList(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $uid =isset($heard['uid'])?$heard['uid']:0;
        //$convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $page =isset($heard['page'])?$heard['page']:1;
        $pagesize =isset($heard['pagesize'])?$heard['pagesize']:40;
		$timing=date("Y-m-d H:i:s");
        $notice = Db::table('convention_notice_info')
        ->field('fid,title,convention_id,content,timing as create_time,sort,record_status,updater_id,update_time,to_users,path_url,creator_id')
        ->where(['record_status'=>1])
        ->where('timing','<=',$timing)
        ->order("timing desc")
		->select();
        $notice_detail =  Db::table('convention_notice_detail')
        ->field('notice_id,creator_id')
        ->where(['creator_id'=>$uid,'record_status'=>1])
        ->select();

        $system_notices=array();
        $my_notices=array();
        //标记是否是未读
        foreach ($notice as &$vo) {
            $has_read = 0;
            foreach ($notice_detail as $key) {
                if ($vo['fid']==$key['notice_id']) {
                    $has_read = 1;
                }
            }
            $vo['has_read'] = $has_read;

            if ($vo['to_users']!=null){
                $tar = ','.$vo['to_users'].',';
                $userstr = ','.$uid.',';
                if (strpos($tar,$userstr)>0){
                    //个人消息
                    array_push($my_notices,$vo);
                }
            }else{
                array_push($system_notices,$vo);
            }
        }

        $data = [
            'code'=>'200',
            'msg'=>'获取成功',
            'data' => [
                'system_notices'=>$system_notices,
                'my_notices'=>$my_notices
            ]
        ];

        echo json_encode($data);exit;
    }
    /**
     * 读取系统消息时 添加一条一看记录
     */
    public function NoticeRead(){
        $heard = request()->param();
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $fid =isset($heard['fid'])?$heard['fid']:0;
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;

        if ($uid>0 && $fid>0) {
			$info=Db::table('convention_notice_info')->where(['convention_id'=>$convention_id,'fid'=>$fid,'record_status'=>1])->find();
            $notice_detail=['convention_id'=>$convention_id,'notice_id'=>$fid,'creator_id'=>$uid,'create_time'=>date("Y-m-d H:i:s")];
            Db::table('convention_notice_detail')->insertGetId($notice_detail);
            $data = [
                'code'=>'200',
                'msg'=>'读取成功',
                'data'=>$info
            ];
        }else{
            $data = [
                'code'=>'410',
                'msg'=>'读取失败'
            ];
        }
        echo json_encode($data);exit;
    }
    /**
     * 收藏
     */
    public function Collect(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $page =isset($heard['page'])?$heard['page']:1;
        $pagesize =isset($heard['pagesize'])?$heard['pagesize']:40;
        if ($uid>0) {
            $collect = Db::table('v_product_collect')
            ->where(['creator_id'=>$uid,'record_status'=>1])
            ->limit(($page-1)*$pagesize,$pagesize)
            ->select();
            $data = [
                'code'=>'200',
                'msg'=>'获取成功',
                'data' => $collect
            ];
        }else{
            $data = [
                'code'=>'410',
                'msg'=>'获取失败'
            ];
        }
        echo json_encode($data);exit;
    }
    /**
     * 我的培训
     */
    public function Training(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $page =isset($heard['page'])?$heard['page']:1;
        $pagesize =isset($heard['pagesize'])?$heard['pagesize']:40;
        if ($uid>0) {
            $video_product = Db::table('video_play_info')
            ->distinct(true)
            ->field('product_id')
            ->where(['creator_id'=>$uid,'record_status'=>1])
            ->select();

            $product_ids = [];
            if (count($video_product)>0) {
                foreach ($video_product as $key) {
                    $product_ids[] =$key['product_id'];;
                }
            }
            $product_list = Db::table('v_product')
            ->where(['record_status'=>1])
            ->wherein('fid',$product_ids)
            ->limit(($page-1)*$pagesize,$pagesize)
            ->select();

            $data = [
                'code'=>'200',
                'msg'=>'获取成功',
                'data' => [
                    'data' => $product_list,
                    'total' => count($product_list)
                ]
            ];
        }else{
            $data = [
                'code'=>'410',
                'msg'=>'请登录'
            ];
        }
        echo json_encode($data);exit;
    }

    /**
     * 我的上传会议列表
     */
    public function UploadConvention(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $page =isset($heard['page'])?$heard['page']:1;
        $pagesize =isset($heard['pagesize'])?$heard['pagesize']:40;
        if ($uid>0) {

	        $convention =Db::table('v_paper_abstract')
		            ->distinct(true)->field('convention_name,convention_id')
		            ->where(['creator_id'=>$uid,'record_status'=>1])
                    ->limit(($page-1)*$pagesize,$pagesize)
		            ->select();
            
		    foreach($convention as &$v){
/* 		    	$list =Db::table('v_convention_download')
		    	->distinct(true)
		            ->where(['creator_id'=>$uid,'record_status'=>1,'convention_id'=>$v['convention_id'],'download_type'=>3])
		            ->select(); */
				$list = Db::table("v_paper_abstract")->where(["record_status"=>1,"convention_id"=>$v['convention_id'],'creator_id'=>$uid])->select();		
		    	$v['list']=$list;
            }  
            $count =count($convention);     
            $data = [
                'code'=>'200',
                'msg'=>'获取成功',
                'data' => [
                    'data' => $convention,
                    'total' => $count
                ]
            ];
        }else{
            $data = [
                'code'=>'410',
                'msg'=>'请登录后重试'
            ];
        }
        echo json_encode($data);exit;
    }
    /**
     * 我的上传
     */
    public function UploadList(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $page =isset($heard['page'])?$heard['page']:1;
        $pagesize =isset($heard['pagesize'])?$heard['pagesize']:40;
        if ($uid>0) {
            $convention_download = Db::table('v_convention_download')
            ->where(['creator_id'=>$uid,'record_status'=>1,'download_type'=>3,'convention_id'=>$convention_id])
            ->limit(($page-1)*$pagesize,$pagesize)
            ->select();

            $count = Db::table('v_convention_download')
            ->where(['creator_id'=>$uid,'record_status'=>1,'download_type'=>3,'convention_id'=>$convention_id])
            ->limit(($page-1)*$pagesize,$pagesize)
            ->count();

            $data = [
                'code'=>'200',
                'msg'=>'获取成功',
                'data' => [
                    'data' => $convention_download,
                    'total' => $count
                ]
            ];
        }else{
            $data = [
                'code'=>'410',
                'msg'=>'获取失败'
            ];
        }
        echo json_encode($data);exit;
    }

    //报名会议列表
    public function SignConvention(){
        $heard = request()->param();
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $page =isset($heard['page'])?$heard['page']:1;
        $pagesize =isset($heard['pagesize'])?$heard['pagesize']:40;
        if ($uid>0) {
            $convention_signup = Db::table('v_convention_signup_detail')
					->where(['record_status'=>1,'creator_id'=>$uid])
					->field("fid,convention_id,tax_num,certificate,convention_name,price,pay_status,pay_type,web_image_url,update_time,tel,user_name,bill_type,address,organizer,pay_mode,pay_state,bill_status,official_invoice")
					->select();
			foreach($convention_signup as &$v){
				$result = Db::table("v_paper_abstract")->where(["record_status"=>1,"convention_id"=>$v['convention_id'],'creator_id'=>$uid])->count();
				$v['draft']=$result;
			}
            $count =count($convention_signup);
            $data = [
                'code'=>'200',
                'msg'=>'获取成功',
                'data' => [
                    'data' => $convention_signup,
                    'total' => $count
                ]
            ];
        }else{
            $data = [
                'code'=>'410',
                'msg'=>'请登录'
            ];
        }
        echo json_encode($data);exit;
    }
    //上传头像
    public function UploadUserImg(){
        $param = request()->param();
        $param = array_filter($param);
        $creator_id = isset($param['creator_id']) ? $param['creator_id'] :$param['uid'];
        $wab_image_id = isset($param['wab_image_id']) ? $param['wab_image_id'] : 0;
        $app_image_id = isset($param['app_image_id']) ? $param['app_image_id'] : 0;
        $image = isset($param['image']) ? $param['image'] :0;

        /*app 上传图片ID */
        if (gettype($image)=='string') {
            $image = json_decode(htmlspecialchars_decode($image),true);
            for ($i=0; $i < count($image); $i++) { 
                $base64_string = $image[$i];
                $url =ROOT_PATH. 'public/uploads/'; // 自定义文件上传路径
                $file_info =base64_image_content($base64_string,$url);
                $file_path = '/uploads'."/".$file_info['path'];
                if($app_image_id>0) {
                    $data = [
                        'file_path'=>$file_path,
                        'update_time'=>date("Y-m-d H:i:s", time()),
                        'updater_id'=>$creator_id
                    ];
                    Db::table("base_source_info")->where(['fid'=>$app_image_id])->setField($data);
                    $app_image_id=$app_image_id;
                }else{
                    $data = [
                        'file_path'=>$file_path,
                        'source_type'=>1,
                        'create_time'=>date("Y-m-d H:i:s", time()),
                        'creator_id'=>$creator_id
                    ];
                    $app_image_id=Db::name('base_source_info')->insertGetId($data);
                }
            }
        }
        /* 更新用户信息 */
        $arr=[];
        $arr['update_time']=date("Y-m-d H:i:s", time());
        $arr['updater_id']=$creator_id;
        if (!$creator_id) {
            $data = [
                'code' => '401',
                'msg' => '请登录后上传'
            ];
        }
        
        if($app_image_id>0){
            $arr['app_image_id']=$app_image_id;
        }
        
        if($wab_image_id>0){
            $arr['web_image_id']=$wab_image_id;
        }

        $status = Db::table('enduser_info')
                ->where("fid",$creator_id)
                ->setField($arr);  
        $user_list =Db::table("v_enduser")->where("fid",$creator_id)->find();           
        if ($status) {
            $data = [
                'code' => '200',
                'msg' => '上传成功',
                'data'=> $user_list     
            ];
        }else{
            $data = [
                'code' => '401',
                'msg' => '上传失败'
            ];
        }
        echo json_encode($data);exit;
    }

    //APP 检查版本升级  并执行插入更新记录
    public function Check_Upgrades(){
        $param = request()->param();
        $param = array_filter($param);
        $uid = isset($param['uid']) ? $param['uid'] :$param['uid'];
        $devicetype = isset($param['devicetype']) ? $param['devicetype'] : '';
        $version_id = isset($param['fid']) ? $param['fid'] :0;
        $imei = isset($param['imei']) ? $param['imei']:"";
        $dl_phone_type = isset($param['phone_type'])?$param['phone_type']:"";  

        $app_type = 0;
        if ($devicetype == 'andriod'){
            $app_type = 1;
        }else if ($devicetype == 'ios'){
            $app_type = 2;
        }else if ($devicetype == 'web'){
            $app_type = 3;
        }

        $where=['app_postfix'=>$app_type,"record_status"=>1];
        $version_info =Db::table("v_version_info")->where($where)->order("fid","desc")->find(); 

        if (!empty($version_info) && $version_id==-1) {
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                'data'=> $version_info     
            ];
        }elseif($version_id>0) {
            /* 添加更新记录 */
            $ip = $_SERVER['REMOTE_ADDR'];
            //新浪借口获取访问者地区
            $url = "http://api.map.baidu.com/location/ip?ak=2TGbi6zzFm5rjYKqPPomh9GBwcgLW5sS&ip={$ip}&coor=bd09ll";
            $arr=json_decode(file_get_contents($url),true);
            $address=isset($arr['content']['address'])?$arr['content']['address']:"";
            $dataS=[
                'app_type'=>$app_type,
                'version_id'=>$version_id,
                'user_id'=>$uid,
                'imei'=>$imei,
                'dl_time'=>date("Y:m:d H:i:s",time()),
                'dl_ip'=>$ip,
                'dl_phone_type'=>$dl_phone_type,
                'dl_location'=>$address
            ];
            Db::table('version_dl_log')->insertGetId($dataS);
            /* 更新下载次数 */
            $where=['app_postfix'=>$app_type,"fid"=>$version_id,"record_status"=>1];
            Db::table("version_info")->where($where)->update(['dl_num'=>$version_info['dl_num']+1]);
            $data = [
                'code' => '200',
                'msg' => '安装成功'
            ];
        }else{
            $data = [
                'code' => '200',
                'msg' => '您目前已是最新版本'
            ];
        }
        echo json_encode($data);exit;
    }

    //我的日程
    public function ConventionSchedule(){
        $param = request()->param();
        $param = array_filter($param);
        $uid = isset($param['uid']) ? $param['uid'] :$param['uid'];
        $page =isset($uid['page'])?$uid['page']:1;
        $pagesize =isset($uid['pagesize'])?$uid['pagesize']:40;
        if($uid>0){
            /* 通过判断添加日程 获取会议fid */
            $convention=Db::table("convention_schedule_increase")
                ->distinct(true)
                ->field('convention_id')
                ->where("creator_id",$uid)
                ->select();    
            $convention_id=[];
            foreach($convention as $v){
                $convention_id[]=$v['convention_id'];
            }
            $convention_id=implode(",",$convention_id);
            $where=["record_status"=>1];
            $flied="fid,digest,start_time,class_name,app_image_url,convention_name,top_image_url";
            $result = Db::table("v_convention")
                    ->field($flied)
                    ->where($where)
                    ->wherein("fid",$convention_id)
                    ->order(['sort'=>'desc','fid'=>'desc'])
                    ->limit(($page-1)*$pagesize,$pagesize)
                    ->select();
            //echo Db::table("v_convention")->getLastSql();die;        
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                'data' => [
                    'convention_list' => $result,
                    'total' => count($result)
                ]
            ];
        }else{
            $data = [
                'code'=>'410',
                'msg'=>'请登录'
            ];
        }

       $this->setRedisValue(json_encode($data),1000);
       echo json_encode($data);exit;
    }
    //意见反馈
    public function FeedBack(){
        $param = request()->param();
        $param = array_filter($param);
        $uid = isset($param['uid']) ? $param['uid'] :0;
        $content = isset($param['content']) ? $param['content'] :"";
        if($uid>0){
            if(!empty($content)){
                $datas=[
                    'content'=>$content,
                    'creator_id'=>$uid,
                    'create_time'=>date("Y-m-d H:i:s"),
                ];
                Db::table("feed_back")->insertGetId($datas);
                $data = [
                    'code' => '200',
                    'msg' => '反馈成功'
                ];
            }else{
                $data = [
                    'code'=>'410',
                    'msg'=>'反馈失败 内容不能为空'
                ];
            }
        }else{
            $data = [
                'code'=>'410',
                'msg'=>'请登录'
            ];
        }
       $this->setRedisValue(json_encode($data),1000);
       echo json_encode($data);exit;
    }

    //删除
    public function Delete(){
        $heard = request()->param();
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $fid = isset($heard['fid'])?$heard['fid']:$heard['convention_id'];
        $type = isset($heard['type'])?$heard['type']:"";
        $table="";
        $fid_type="fid";
        $creator_id="creator_id";
        switch($type){
            case "order"://购买记录删除
                $table="product_order_info";
                $creator_id="user_id";
                break;
            case "signconvention"://报名记录删除
                $table="convention_signup_info";
                $fid_type="convention_id";
                //报名记录标记删除同时删除 报名自定字段
                Db::table("convention_signup_detail")->where(['creator_id'=>$uid])->wherein('convention_id',$fid)->delete();
                //报名记录标记删除同时删除 摘要及全文 作者
                Db::table("convention_paper_abstract")->where(['creator_id'=>$uid,'convention_id'=>$fid])->delete();
                Db::table("convention_paper_author")->where(['creator_id'=>$uid,'convention_id'=>$fid])->delete();
                break;
            case "collect"://删除收藏
                $table="product_collect_info";
                break;
            case "notice"://删除消息
                $table="convention_notice_info";
                //同事删除消息详情
                Db::table("convention_notice_detail")->where(['creator_id'=>$uid])->wherein('notice_id',$fid)->delete();
                break;
            case "training"://培训记录删除
                $table="video_play_info";
                $fid_type="product_id";
                break;
            case "conventionschedule"://日程删除
                $table="convention_schedule_increase";
                $fid_type="convention_id";
                break;
        }
        if ($uid>0) {
            if ($fid>0 && !empty($type)) {
                Db::table($table)->where([$creator_id=>$uid])->wherein($fid_type,$fid)->update(['record_status'=>-1]);
                //echo Db::table($table)->getlastsql();die;
                $data = [
                    'code'=>'200',
                    'msg'=>'删除成功'
                ];
            }else{
                $data = [
                    'code'=>'411',
                    'msg'=>'删除失败'
                ];
            }
        }else{
            $data = [
                'code'=>'410',
                'msg'=>'请登录'
            ];
        }
        echo json_encode($data);exit;
    }
}