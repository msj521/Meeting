<?php
namespace app\api\controller;

use think\Db;
use think\Model;
use think\Request;
use app\api\common\Base;
use app\api\model\AppInfo;
use Qcloud\Sms\SmsSingleSender;
use think\Session;

class Login extends Base {
    
    /**
     * @return string|void
     * 登录接口
     */
    public function UserLogin() {
        //获取用户名 密码
        $tel = $this->request->post('tel');
        $user_pwd = $this->request->post('password');
        $imei = $this->request->post('imei');
        $model = $this->request->post('model');
        $cpu = $this->request->post('cpu');
        $memory = $this->request->post('memory');
        $flash = $this->request->post('flash');
        $content = $this->request->post('content');
        $app_key = $this->request->post('appkey');
        //1.保存设备信息   
        if (isset($imei) && $imei != '') {
            $terminal = Db::table('log_terminal_info')->where(['imei'=>$imei])->find();
            if (empty($terminal)) {
                $data_terminal = [
                    'imei' => $imei,
                    'model' => $model,
                    'cpu' => $cpu,
                    'memory' => $memory,
                    'flash' => $flash,
                    'content' => $content
                ];
                $terminal_id = Db::name('log_terminal_info')->insertGetId($data_terminal);
            }else{
                $terminal_id = $terminal['fid'];
            }
        }else{
            $data = [
                'code' => '401',
                'msg' => '登录失败，设备信息错误'
            ]; 
            echo  json_encode($data);exit;
        }
	
        //查询数据库，判断账号是否存在     		
		$sql="SELECT * FROM `v_enduser` WHERE `record_status` = 1  AND (SUBSTRING(tel FROM -11 FOR 11) = '$tel' or tel = '$tel' ) LIMIT 1";
		$result = Db::query($sql);
        if (!empty($result[0])) { 
			$result=$result[0];
            $result['web_image_url'] = URL.$result['web_image_url'];
            //判断密码是否正确
            if ($result['password'] ==$user_pwd) {
                $app_info = Db::table('app_info')->where(['app_key'=>$app_key])->find();
                $app_id = isset($app_info['fid']) ? $app_info['fid'] : 0;
                $version_id = isset($app_info['version_id']) ? $app_info['version_id'] : 0;
                
                //2.生成 新access_token
                $user_id=$result['fid'];
                $access_token =$this->request->token('__token__', 'sha1');
                $time_now=date('Y-m-d H:i:s',time());
                $time_expiration=date('Y-m-d H:i:s',strtotime('+10000 minute'));  //token有效期
                $data_token = [
                    'app_id'=>$app_id,
                    'user_id' => $user_id,
                    'terminal_id' => $terminal_id,
                    'access_token' => $access_token,
                    'issue_time' => $time_now,
                    'expiration' => 60,
                    'expire_time' => $time_expiration,
                    'creator_id' => $user_id,
                    'create_time' => $time_now
                ];
                Db::table('app_token_info')->insert($data_token);
				
				//登录存用户名用于请求日志
				Session::set("user_name",$result['user_name']."-".$result['tel']);
				
                $data = [
                    'code' => '200',
                    'msg' => '登录成功',
                    'data' => [
                        'access_token' => $access_token,
                        'user_info' => $result,
                        'url' => array_filter(request()->param())
                    ]
                ];

            } else {
                $data = [
                    'code' => '415',
                    'msg' => '如您忘记密码，可点击"忘记密码"，进行密码重置',
                    //'msg' => '密码错误，重新输入',
                ];
            }
            //账号不存在，请注册
        } else {
            $data = [
                'code' => '414',
                'msg' => '用户不存在请注册',
            ];
        }
        //var_dump($data);die;
        echo  json_encode($data);exit;
    }
 
    //发送验证码
    public function SendCode(){
        $tel = $this->request->post('tel');
        if(strlen($tel) == 11) {
            $res = preg_match_all("/^1[345789]\d{9}$/", $tel, $phone);
            if ($res) {
                $info=Db::table('v_enduser_code')->where(['tel'=>$tel,'status'=>1])->find();
                //var_dump($info);die;
                if ($info) {
                    //一小时内已经发送过验证码
                    $data = [
                        'code' => '419',
                        'msg' => '已发送过短信，请5分钟后重试',
                    ];
                }else{
                    $message = $this->Message($phone[0][0]);
                    if ($message['code'] == 200) {
                        $data = [
                            'tel' => $tel,
                            'code' => $message['data']['message'],
                            'create_time' => date('Y-m-d H:i:s')
                        ];
                        Db::table('enduser_code')->insert($data);
                        $data = [
                            'code' => '200',
                            'msg' => '短信发送成功,有限期5分钟',
                        ];
                    }
                }
            }else{
                $data = [
                    'code' => '418',
                    'msg' => '手机号格式不正确',
                ];
            }
        }else {
            $data = [
                'code' => '417',
                'msg' => '长度必须是11位',
            ];
        }
        echo json_encode($data);exit;
    }

    //忘记密码-检测验证码
    public function CheckCode(){
        $tel = $this->request->post('tel');
        $code = $this->request->post('message');

        $info=Db::table('v_enduser_code')->where(['tel'=>$tel,'status'=>1,'code'=>$code])->find();

        if (!empty($info)) {
            $data = [
                'code' => '200',
                'msg' => '验证通过',
            ];
        }else{
            $data = [
                'code' => '413',
                'msg' => '验证失败',
            ];
        }
        echo json_encode($data);exit;
    }
    //获取用户基本资料
    public function UserInfo(){
        //获取用户名 token
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $uid =isset($heard['user_id'])?$heard['user_id']:0;
        //查询数据库，判断账号是否存在
        $result = Db::table("v_enduser")->where(["fid"=>$uid,"record_status"=>1])->find();
        if ($result) {
            $result['image_url'] = URL.$result['image_url'];

            $user_set = Db::table("enduser_set")->where(["user_id"=>$uid,"record_status"=>1])->select();
            $data = [
                'code' => '200',
                'msg' => '登陆成功',
                'data' => [
                    'user_info' => $result,
                    'user_set'=>$user_set,
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

    //修改密码
    public function UpdatePassword()
    {
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $tel =isset($heard['tel'])?$heard['tel']:$this->request->post('tel');
        $user_pwd =isset($heard['password'])?$heard['password']:$this->request->post('password');
        $user_code = isset($heard['message'])?$heard['message']:$this->request->post('message');
        $info = Db::table("v_enduser_code")->where(['tel' =>$tel,'code'=>$user_code,'status'=>1])->find();
        if (!empty($info)) {
			$sql="SELECT * FROM `enduser_info` WHERE `record_status` = 1  AND SUBSTRING(tel FROM -11 FOR 11) = '$tel' LIMIT 1";
			$user = Db::query($sql);	
            if (!empty($user[0])) {
				$user=$user[0];
                $user['password']=$user_pwd;
                $user['update_time']= date('Y-m-d H:i:s');
                $user =HandleParamsForInsert("enduser_info",$user);
                $status = Db::table('enduser_info')->update($user);
                if ($status) {
                    $data = [
                        'code' => '200',
                        'msg' => '修改成功',
                    ];
				//密码重置发送邮件
				//$param=['pwd'=>$user_pwd,'uid'=>$tel,'email'=>$user['email']];				
				//Send_Report(2,$param);
                } else {
                    $data = [
                        'code' => '415',
                        'msg' => '修改失败',
                    ];
                }
            }else{
                $data = [
                    'code' => '416',
                    'msg' => '修改失败，用户不存在',
                ];
            }
        } else {
            $data = [
                'code' => '421',
                'msg' => '验证码输入错误请重新输入',
            ];
        }
        echo  json_encode($data);exit;
    }

        //注册
    public function Register(){
        
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $heard = array_filter($heard);
		$tel =isset($heard['tel'])?$heard['tel']:$this->request->post('tel');
		$user_code = isset($heard['message'])?$heard['message']:$this->request->post('message');
		$user_name =isset($heard['user_name'])?$heard['user_name']: $this->request->post('user_name');
		
		//验证是否注册过
		$sql="SELECT * FROM `enduser_info` WHERE `record_status` = 1  AND SUBSTRING(tel FROM -11 FOR 11) = '$tel' LIMIT 1";
		$user = Db::query($sql);
		if($user){
			$data = [
				'code' => '415',
				'msg' => '手机号码已被注册,请登录',
			];
			echo  json_encode($data);exit;
		}
		
        $info = Db::table("v_enduser_code")->where(['tel' =>$tel,'code'=>$user_code,'status'=>1])->find();
        if(!empty($info)){
			$heard=HandleParamsForInsert("enduser_info",$heard);
			$heard ['nick_name']= $user_name;
			$heard ['create_time']= date('Y-m-d H:i:s');
			$status = Db::table('enduser_info')->insert($heard);
			if ($status) {
				$data = [
					'code' => '200',
					'msg' => '注册成功',
				];
			}else{
				$data = [
					'code' => '413',
					'msg' => '注册失败',
				];
			}
        }else{
            $data = [
                'code' => '421',
                'msg' => '验证码输入错误请重新输入',
            ];
        }
        echo  json_encode($data);exit;
    }

    //获取注册基础资料
    public function BaseInfo(){
        //职位
        //$jobs = classify(3);
        //学历
        $educations = classify(2);
        //学位
        $degree_list = classify(9);
		//部门科室
        $department = classify(4);
		//学分级别
        $credit_type = classify(10);
		//学分职称
		foreach($credit_type as &$v){
			$v['credit_title']=Title_Level($v['fid'],"");
		}

        $region_data = Db::table("base_region_conf")->field('fid,region_name,pid,code,level')->select();
        $region =getCityTree($region_data,0);
		$region =class_sort($region);
		//var_dump(class_sort($region));die;
        $data = [
            'code' => '200',
            'msg' => '获取成功',
            'data' => [
                //'job_list' => $jobs,
                'education_list' => $educations,
                'degree_list' => $degree_list,
                'credit_type' => $credit_type,
                'department' => $department,
                'region_list' => $region
            ]
        ];
        echo  json_encode($data);exit;
    }

    //根据省市获取医院
    public function OrgList(){
        $province_id = $this->request->post('province_id');
        $city_id = $this->request->post('city_id');
        $town_id = $this->request->post('town_id');
        $org_name = $this->request->post('org_name');
        $spell = $this->request->post('spell');

        $where = ['record_status'=>1];
		
		$where['province_id'] = $province_id>0?$province_id:9;
		
        $where['city_id'] =$city_id>0?$city_id:819;

        if ($town_id>0) {
            $where['country_id'] = $town_id;
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

        if(count($Organizations)>0){
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                'data' => $Organizations
            ];
        }else{
            $data = [
                'code' => '400',
                'msg' => '获取失败',
                'data' => []
            ];
        }
        echo json_encode($data);exit;
    }

    
 
     /*发送验证码*/
     public function Message($user_phone){
         // 短信应用SDK AppID
 
         $appid = 1400076876;// 1400开头
         // 短信应用SDK AppKey
         $appkey = "2f010a288bd3332319ea9afa3abe0c8f";
 
         // 需要发送短信的手机号码
         $phoneNumber= $user_phone;
 
         // 短信模板ID，需要在短信应用中申请
         $templateId = '98108';  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请
 
         // 签名
         $smsSign = "上海斯菲克微生物应用技术研究中心"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`
 
         // 指定模板ID单发短信
         $code=str_pad(mt_rand(0, 999999), 6, "0", STR_PAD_BOTH);
         try {
             $sender = new SmsSingleSender($appid,$appkey);
             $params = [$code, 1];
         // 假设模板内容为：测试短信，{1}，{2}，{3}，上学。
             $result = $sender->sendWithParam("86", $phoneNumber, $templateId,
                 $params,$smsSign, "", "");
             $data = [
                 'code' => '200',
                 'msg' => '发送短信成功',
                 'data'=>[
                     'result'=>$result,
                     'message'=>$code
                 ]
             ];
             return  $data;
         } catch(\Exception $e) {
             echo var_dump($e);
         }
     }
}