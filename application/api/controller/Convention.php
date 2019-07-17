<?php
namespace app\api\controller;

use think\Db;
use think\Request;
use app\api\common\Base;

class Convention extends Base {
	
	/**
	*SIFIC2019现场发票采集
	*/
	public function Gather_Invoice(){
		$heard = request()->param();
        $heard = array_filter($heard);
        $data = [];
		$where=array();
		$status=0;
		$type=!empty($heard['type'])?$heard['type']:0;
		$open_id=!empty($heard['open_id'])?$heard['open_id']:0;
		$where['open_id']=$open_id;
		$info = Db::table('convention_2019_invoice')->where($where)->find();
		$heard=HandleParamsForInsert('convention_2019_invoice',$heard);
		//提交数据
		if(!empty($open_id)){
			if($type==1 && empty($info)){
				$heard['create_time'] = date("Y-m-d H:i:s", time());
				$status = Db::table('convention_2019_invoice')->insertGetId($heard);
			}elseif($type==1 && !empty($info)){
				//更新数据
				$heard['update_time'] = date("Y-m-d H:i:s", time());
				$status = Db::table('convention_2019_invoice')->where($where)->update($heard);
			}
			if($status && $type==1){
				$data = [
					'code' => '200',
					'msg' => '申请成功'
				];
			}elseif($status==0 && $type==1){
				$data = [
					'code' => '410',
					'msg' => '申请失败'
				];				
			}elseif(!empty($info)){
				$data = [
					'code' => '412',
					'msg' => '发票已申请',
					'data'=>$info
				];
			}
		}else{
			$data = [
				'code' => '412',
				'msg' => '请重新扫码！'
			];	
		} 
		$this->setRedisValue(json_encode($data),1000);
		echo json_encode($data);exit; 
	}
	
	/**
	*SIFIC2019培训班签到
	*/
	public function Training_Sigin(){
		$heard = request()->param();
		$heard = array_filter($heard);
		$open_id=!empty($heard['open_id'])?$heard['open_id']:0;
		$status =0;
		$code=412;
		$msg="";
        $data = []; 
		$where=array();
		$where['open_id']=$open_id;
		$info = Db::table('convention_2019_sigin')->where($where)->order("fid desc")->find();
        if(!empty($heard) && !empty($open_id)){
            $type=!empty($heard['type'])?$heard['type']:0;
			$a_time=date("Y-m-d 12:00:00");// 中午12点
			$b_time=date("Y-m-d 14:00:00");//下午14点
			$c_time=date("Y-m-d 21:00:00");//下午17点
			$_time=date("Y-m-d H:i:s");//当前时间
			$update_time=!empty($info['update_time'])?$info['update_time']:0;//获取最后一次签到时间		
            //加载数据
			/*if($_time<date("Y-m-d 08:00:00") || ($_time>$a_time && $_time<$b_time)){
				$msg="签到时间未到！";
			}elseif($_time>$c_time){
				$msg="签到时间已截止！";
			}elseif(date("Y-m-d 08:00:00")<$update_time && $update_time<$a_time && $_time<$a_time){
				$msg="上午已签到";
			}elseif($b_time<$update_time && $c_time>$update_time){
				$msg="下午已签到";
			}else{
				$code=410;
				$msg="未签到，请继续签到";
            }*/
            $start_time = date("Y-m-d 06:00:00");
            if($_time<$start_time){
				$msg="签到时间未到！";
			}elseif($_time>$c_time){
				$msg="签到时间已截止！";
			}elseif($start_time<$update_time && $update_time<$c_time){
				$msg="今日已签到";
			}else{
				$code=410;
				$msg="今日未签到，请继续签到";
			}
			if($type==1){
				//提交数据
				$heard=HandleParamsForInsert('convention_2019_sigin',$heard);
				$status = Db::table('convention_2019_sigin')->insertGetId($heard);
				if($status){
					$msg="签到成功";		
					$code=200;
				}else{
					$msg="签到失败,请重新扫码！";		
					$code=412;			
				}
			}   
		}else{
			$msg="请重新扫码！";		
			$code=412;		
		}
		$this->setRedisValue(json_encode($data),1000);
		$data=["code"=>$code,"msg"=>$msg,"data"=>$info];
		echo json_encode($data);exit; 
	}

	/**
	*SIFIC2019感控实践优秀基层医院
	*/
	public function Grass_roots(){
		//self::AliPay();die;
		$heard = request()->param();
		$convention_id =!empty($heard['convention_id'])?$heard['convention_id']:0;
        $uid =!empty($heard['uid'])?$heard['uid']:0;
        $type =!empty($heard['type'])?$heard['type']:0;
        $data = [];

        if($convention_id>0 && $uid>0){
            $list = Db::table('convention_sign_control')->where(['convention_id' =>$convention_id,'creator_id' =>$uid])->find();
            //加载数据
            if(!empty($list) && $type==0) {
                $data = [
                    'code' => '200',
                    'msg' => '获取成功',
                    'list'=>$list
                ];
            }elseif($type>0){
                $status=0;
                $heard=HandleParamsForInsert('convention_sign_control',$heard);//var_dump($heard);die;

                if($type==1){
                    //提交数据
                    $heard['creator_id'] =$uid;
					$heard['create_time'] = date("Y-m-d H:i:s", time());
                    $status = Db::table('convention_sign_control')->insertGetId($heard);
                }elseif($type==2 && !empty($heard['fid'])){
                    //更新数据
                    //var_dump($type);die;
                    $heard['update_time'] = date("Y-m-d H:i:s", time());
                    $status = Db::table('convention_sign_control')->where(["fid"=>$heard['fid']])->update($heard);
                }
                //echo Db::table("convention_sign_control")->getLastsql();die;
                if($status){
                    $data = [
                        'code' => '200',
                        'msg' => '提交成功'
                    ];
                }else{
                    $data = [
                        'code' => '410',
                        'msg' => '提交失败'
                    ];				
                }
            }
        }else{
            $data = [
                'code' => '413',
                'msg' => '加载失败'
            ];
        } 

		$this->setRedisValue(json_encode($data),1000);
		echo json_encode($data);exit; 
	}

	/**
     * 会议报名---支付宝支付
     */
     public function AliPay(){
		$heard = request()->param();
        $pay_number =!empty($heard['param'])?$heard['param']:0;
		$order = Db::table("v_convention_order")->where(['pay_number'=>$pay_number,'order_status'=>1])->find();
		//判断订单是否存在
		if(empty($order) || $order=="") {
			$data = [
				'code' => '414',
				'msg' => '支付失败！订单无效'
			];
			//echo json_encode($data);exit; 
			echo "<script>alert('支付失败！订单无效');window.location.href ='/';</script>";exit;
		}
        //引入支付宝支付
        require_once EXTEND_PATH.'/AliPay/config.php';
        require_once EXTEND_PATH.'/AliPay/pagepay/service/AlipayTradeService.php';
        require_once EXTEND_PATH.'/AliPay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php';
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = $order['pay_number'];
        //订单名称，必填
        $subject = $order['ticket_name'];
        //付款金额，必填
        $total_amount = $order['price'];
		//商家描述
		$body="2019SIFIC-第15届上海国际医院感染控制论坛（ SIFIC ）学术年会-会议报名费";

        //构造参数
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);
        //电脑网站支付请求
        $aop = new \AlipayTradeService($config);
		$invoice=!empty($order['invoice_status'])?$order['invoice_status']:0;
		$url="/meetingname";
		if($invoice==1){
			$url="/ip_fapiao?convention_id=47";
		}
		$return_url=$config['return_url'].$url;
		//var_dump($body);die;
        $response = $aop->pagePay($payRequestBuilder,$return_url,$config['notify_url']);
		//接口请求日志
		RequestLog("/api/convention/return_url",$heard);
	 }

	 /**
     * 会议报名---支付获取订单
     */
     public function Create_Order(){
		//self::AliPay();die;
		$heard = request()->param();
        $convention_id =!empty($heard['convention_id'])?$heard['convention_id']:0;
        $uid =!empty($heard['uid'])?$heard['uid']:0;
		$order = Db::table('v_convention_order')->where(['convention_id' =>$convention_id,'creator_id' =>$uid,'order_status'=>1])->find();
		
		$data = [
			'code' => '410',
			'msg' => '获取失败！'
		];
		
		if($convention_id>0 && $uid>0 && !empty($order)) {
            $data = [
                'code' => '200',
                'msg' => '获取成功',
				'orderinfo'=>$order
            ];	
		}
		$this->setRedisValue(json_encode($data),1000);
        echo json_encode($data);exit; 
	 }

	 /**
     * 会议报名---发票申请
     */
     public function Apply_invoice(){
		$header = request()->param();
        $convention_id =isset($header['convention_id'])?$header['convention_id']:0;
        $uid =isset($header['uid'])?$header['uid']:0;
		//后台唯一认证 fid
        $fid =!empty($header['cifis'])?$header['cifis']:0;
        if ($convention_id>0 && $uid>0) {
			$info=[];
			$info['bill_type']=!empty($header['bill_type'])?$header['bill_type']:0;
			$info['bill_title']=!empty($header['bill_title'])?$header['bill_title']:0;
			$info['tax_num']=!empty($header['tax_num'])?$header['tax_num']:0;
			$info['address']=!empty($header['address'])?$header['address']:0;
			$info['account_bank']=!empty($header['account_bank'])?$header['account_bank']:0;
			$info['account']=!empty($header['account'])?$header['account']:0;
			$info['sign_addr']=!empty($header['sign_addr'])?$header['sign_addr']:0;
			$info['sign_tel']=!empty($header['sign_tel'])?$header['sign_tel']:0;
			$info['bill_status']=!empty($header['bill_status'])?$header['bill_status']:1;
			$info['official_invoice']=!empty($header['official_invoice'])?$header['official_invoice']:"";
            Db::table('convention_signup_info')->where(['convention_id'=>$convention_id,"creator_id"=>$uid,'pay_status'=>2])->update($info);
            $data = [
                'code' => '200',
                'msg' => '申请成功'
            ];
        }elseif($convention_id>0 && $fid>0){
			//后台处理 获取发票信息 
			$filed="bill_type,bill_title,tax_num,address,sign_addr,sign_tel,bill_status,account_bank,account,official_invoice";
			$ip_fapiao=Db::table('convention_signup_info')->where(['convention_id'=>$convention_id,"creator_id"=>$fid])->field($filed)->find();
			$data = [
                'code' => '200',
				'msg' => '获取成功',
                'data' => $ip_fapiao
            ];
		}else{
            $data = [
                'code' => '414',
                'msg' => '申请失败',
            ];
        }
		$this->setRedisValue(json_encode($data),1000);
        echo json_encode($data);exit; 
	 }

    /**
     * 会议报名---报名 支付回调
     */
     public function Payment(){
		 
        $heard = request()->param();
        $pay_number =isset($heard['out_trade_no'])?$heard['out_trade_no']:0;
		$order_where=["pay_number"=>$pay_number,'order_status'=>1];
		$order = Db::table("v_convention_order")->where($order_where)->find();
		$invoice =0;
		//var_dump($order);die;
		$where =array();
		//判断订单是否存在
		if(empty($order) || $order==""  || $order['creator_id']<0) {
			$data = [
				'code' => '414',
				'msg' => '支付失败！请刷新再试'
			];
			echo "<script>alert('支付失败！订单无效');window.location.href='/';</script>";exit;
		}else{
			$param=['convention_id'=>$order['convention_id'],'uid'=>$order['creator_id']];
			try{
				if (!empty($heard['trade_status']) && $heard['trade_status'] == 'TRADE_SUCCESS') {
					Db::startTrans();
					//年会报名成功生成支付订单
					$where['convention_id']=$order['convention_id'];
					$where['creator_id']=$order['creator_id'];
					$where['record_status']=1;
					
					//更新会议报名状态
					$signup_detail=[
						'pay_status'=>2,
						'signup_status'=>2,
						'actual_pay'=>$order['price']
					];
					//var_dump($signup_detail);die;
					Db::table('convention_signup_info')->where($where)->update($signup_detail);
					
					//更新会议报名订单状态
					$order_detail = ['order_status' => 2,'alipay_number'=>json_encode($heard)];
					$where['pay_number']=$pay_number;
					Db::table('convention_order_info')->where($where)->update($order_detail);
					Db::commit();
					//支付宝异步通知
					echo "success";
					Send_Report(3,$param);
				}
			}catch(\Exception $e){
				//验证失败
				echo "fail";
				Send_Report(4,$param);
				Db::rollback();
			}
		}
		//接口请求日志
		RequestLog("/api/convention/pay_return",$heard);
    }
    
    /**
     * 会议报名---获取个人信息
     */
     public function Personal_Information(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $user_name =isset($heard['user_name'])?$heard['user_name']:0;
        $email =isset($heard['email'])?$heard['email']:0;
        $uid =isset($heard['uid'])?$heard['uid']:0;
		$convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
		
		$result=[];
		$where['record_status']=1;
		if($convention_id && $uid){
			$where['convention_id']=$convention_id;
			$where['creator_id']=$uid;
		}else{
			$where['user_name']=$user_name;
			$where['email']=$email;
		}
		
		$convention_signup = Db::table("v_convention_signup_detail")->where($where)->find();
		//echo Db::table("v_convention_signup_detail")->getLastSql();
		$enduser_copy = Db::table("v_enduser")->where(['fid'=>$uid,'record_status'=>1])->find();
		//获取注意字段
		$take_care = Db::table("v_convention")->where(['fid'=>$convention_id,'record_status'=>1])->value('take_care');
		$take_care=htmlspecialchars_decode($take_care);
		$take_care=array_filter(explode("<p>@</p>",$take_care));
		if(!empty($convention_signup)){
			$result=$convention_signup;
			$result['type']=1;
		}else{
			$result=$enduser_copy;
			$result['type']=0;
		}
		
		//会议报名预计到场离场时间
		$detail_name=Db::table("v_venue_time")->field("detail_name")
			->where(['convention_id'=>$convention_id,'record_status'=>1])
			->select();
		$result['meeting_time']=$detail_name;
		$result['class_list']=classify(11);
		$result['take_care']=$take_care;
        if (!empty($result)) {
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                "data"=>$result,         
            ];
        }else{
            $data = [
                'code' => '414',
                'msg' => '获取失败',
				"data"=>$result,
            ];
        }
        $this->setRedisValue(json_encode($data),1000);
        echo json_encode($data);exit; 
    }
    
    /**
     * 会议报名---摘要及全文列表
     */
     public function Author_Abstract(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $result = Db::table("v_paper_abstract")->where(["record_status"=>1,"convention_id"=>$convention_id,'creator_id'=>$uid])->select();

        if (!empty($result) && $convention_id>0) {
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                "data"=>$result
            ];
        }else{
            $data = [
                'code' => '414',
                'msg' => '获取失败',
            ];
        }
        $this->setRedisValue(json_encode($data),1000);
        echo json_encode($data);exit; 
    }
    
    
    /**
     * 会议报名 摘要增加作者  摘要 convention_paper_author
     */
     public function Paper_Author(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $uid =isset($heard['uid'])?$heard['uid']:0;
		$param=['convention_id'=>$convention_id,'uid'=>$uid];
		//type  1 摘要 2 全文
        $type =isset($heard['type'])?$heard['type']:1;
        $fileid =isset($heard['file_id'])?$heard['file_id']:0;
        $yes_no =isset($heard['yes_no'])?$heard['yes_no']:1;
        $pid =isset($heard['pid'])?$heard['pid']:1;
        $author_status=0;
        $abstract_status=0;
        $data = ['code' => '414','msg' => '保存失败'];
        //作者列表
        $author_list =isset($heard['author_list'])?$heard['author_list']:"";
        // 摘要
        $abstract_content =isset($heard['abstract_content'])?$heard['abstract_content']:"";

        if(!$uid){
            $data=["code"=>413,"msg"=>"请登录后操作"];
        }else if(empty($author_list) && $type==1){
            $data=["code"=>413,"msg"=>"保存失败！请先增加作者"];
        }else if(empty($abstract_content) && $type==1){
            $data=["code"=>413,"msg"=>"保存失败！请填写摘要信息"];
        }else if(!$fileid && $type==2){
            $data=["code"=>413,"msg"=>"论文上传失败"];
        }else if($author_list && $abstract_content && $type==1){
            try{
                Db::startTrans();
                //插入摘要内容
                $abstract_status=Db::name("convention_paper_abstract")->insertGetId($abstract_content);
				foreach($author_list as &$v){
					$v['abstract_id']=$abstract_status;
				}
                //插入作者数据
                $author_status=Db::name("convention_paper_author")->insertAll($author_list);			
                Db::commit();
            }catch(\Exception $e){
                Db::rollback();
            }

            if ($author_status && $abstract_status) {
                $data = [
                    'code' => '200',
                    'msg' => '摘要保存成功',
                    'data'=>['file_id'=>$abstract_status]
                ];
				//摘要提交成功发送邮件
				Send_Report(5,$param);
            }
        }else if($fileid>0 && $type==2 && $pid>0){
            $status=Db::table('convention_paper_abstract')
				->where(["fid"=>$pid,"convention_id"=>$convention_id,'creator_id'=>$uid])
				->update(['fileid'=>$fileid,"yes_no"=>$yes_no]);
            if ($status) {
                $data = [
                    'code' => '200',
                    'msg' => '全文保存成功'
                ];
				//论文成功发送邮件
				Send_Report(7,$param);	
            }
        }
        $this->setRedisValue(json_encode($data),1000);
        echo json_encode($data);exit; 
    }
    
    /**
     * 会议 个人中心下载证书
     */
     public function Download_Certificate(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $uid =isset($heard['uid'])?$heard['uid']:0;
        
        $result = Db::table("v_convention_signup_detail")
            ->where(["convention_id"=>$convention_id,"record_status"=>1,"creator_id"=>$uid,'pay_status'=>2])
            ->field('org_name,user_name,fid')
            ->find();

        if (!empty($result)) {
            Send_Report(9,$result);
            $data = [
                'code' => '200',
                'msg' => '下载成功'
            ];
        }else{
            $data = [
                'code' => '414',
                'msg' => '下载失败',
            ];
        }
        $this->setRedisValue(json_encode($data),1000);
        echo json_encode($data);exit; 
    }
    
    /**
     * 会议分类标签
     */
     public function ConventionClassList(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $class_list = classify(7);
        $data = [
            'code' => '200',
            'msg' => '获取成功',
            'data' => [
                'class_list' => $class_list
            ]
        ];
       echo json_encode($data);exit;
    }
    /**
     * 会议列表
     */
    public function ConventionList(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $class_id =isset($heard['class_id'])?$heard['class_id']:0;
        $page =isset($heard['page'])?$heard['page']:1;
        $pagesize =isset($heard['pagesize'])?$heard['pagesize']:40;

        $where=["record_status"=>1];

        if ($class_id>0) {
            $where=["class_id"=>$class_id];
        }
        $flied="fid,digest,start_time,top_image_url,class_id,class_name,web_image_url,app_image_url,convention_name,sort";
        $result = Db::table("v_convention")
                ->field($flied)
                ->where($where)
                ->order(['sort'=>'desc','fid'=>'desc'])
                ->limit(($page-1)*$pagesize,$pagesize)
                ->select();
        $total = Db::table("v_convention")
                ->where($where)
                ->count();

        $class_list = classify(7);
        //查询数据库，判断账号是否存在

        $data = [
            'code' => '200',
            'msg' => '获取成功',
            'data' => [
                'class_list' => $class_list,
                'convention_list' => $result,
                'total' => $total
            ]
        ];

       $this->setRedisValue(json_encode($data),1000);
       echo json_encode($data);exit;
    }

     /**
     * 会议指南
     */
    public function ConventionBase(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $devicetype =isset($heard['devicetype'])?$heard['devicetype']:"";
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $uid =isset($heard['uid'])?$heard['uid']:0;

        if ($devicetype=='web') {
            /* 会议详情 Web前端使用*/
            $result = Db::table("v_convention")
            ->where(["fid"=>$convention_id,"record_status"=>1])
            ->find();
            /* 新闻动态 */
            $news = Db::table('convention_news_info')
                        ->field("fid,title,content,create_time")
                        ->where(['record_status'=>1,'convention_id'=>$convention_id])
                        ->order(['sort'=>'desc'])
                        ->limit(8)
                        ->select();
            /* 会议参展商 */            
            $exhibitors = Db::table('v_convention_exhibitor')
            ->field("fid,convention_id,image_url,org_name,booth,org_id,web_url,exhibitor_type")
            ->where(['record_status'=>1,'convention_id'=>$convention_id])
            ->order(['sort'=>'asc'])
            ->select();
            /* 会议报名订单号 */            
            $convention_order = Db::table('v_convention_signup_detail')
            ->field("fid,order_number,user_name,convention_id,pay_type,pay_status")
            ->where(['record_status'=>1,'convention_id'=>$convention_id,'creator_id'=>$uid])
            ->find();
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                'data' => [
                    'convention_info' => $result,
                    'convention_news' => $news,
                    'convention_exhibitors' => $exhibitors,
                    'convention_order' => $convention_order,
                ]
            ];
        }else if ($devicetype=="webapp"){
            /* 会议详情 App嵌套网页使用*/
            $result = Db::table("v_convention")
            ->where(["fid"=>$convention_id,"record_status"=>1])
            ->find();
            $map_list = Db::table('v_convention_download')
            ->where(['record_status'=>1,'convention_id'=>$convention_id,'download_type'=>6])
            ->select();
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                'data' => [
                    'convention_info' => $result,
                    'map_list'=>$map_list
                ]
            ];
        }else{
            /* 会议详情 App使用*/
            /*$result = Db::table("v_convention")
            ->field('fid,top_image_url,web_image_url,class_id,class_name,convention_name,app_image_url')
            ->where(["fid"=>$convention_id,"record_status"=>1])
            ->find();*/
            $result = [];
            $result['fid']=47;
            $result['top_image_url']="/uploads/20190523/9431c489bbd83785ec29f9f10234168d.jpg";
            $result['web_image_url']="/uploads/20190523/bd15e864b97ef8f97a439df178a58a9a.jpg";
            $result['class_id']=105;
            $result['class_name']="SIFIC专栏";
            $result['convention_name']="第15届上海国际医院感染控制论坛（SIFIC）暨 第3届东方耐药与感染大会（OCAMRI）联合会议";
            $result['app_image_url']="/uploads/20190523/62882a45c38aad7ff6317a3dd9b370bc.jpg";

            $result['live_url'] = "http://123.001yixue.com/?c=activity&a=live&id=189032&referVisitorId=371944&from=singlemessage&isappinstalled=0";
            $result['image_list'] = ['http://2019.sific.com.cn/uploads/20190516/e93bcefbec51fcd136436fdbf0a54dde.jpg']; 
	        $menu = [
                'top_menu'=>[
                    0=>'会议日程',
                    1=>'我的日程',
                    2=>'参会指南',
                    3=>'参展商',
                    4=>'参会专家',
                    /*5=>'照片墙',
                    6=>'扫一扫',
                    7=>'直播'
                    7=>'查日程',
                    8=>'直播'*/
                    5=>'专家秘书',
                    6=>'照片墙',
                    7=>'扫一扫',
                    8=>'查日程',
                    9=>'直播'
                ],
                'bottom_menu'=>[
                    0=>'正在进行',
                    1=>'即将进行',
                    2=>'资料汇编',
                    3=>'论文集',
                    4=>'会议课件'
                ]
            ];
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                'data' => [
                    'convention_info' => $result,
                    'menu_list'=>$menu
                ]
            ];
            
        }
        $this->setRedisValue(json_encode($data),1000);
        echo json_encode($data);exit;
    }

     /**
     * 会议新闻
     */
    public function ConventionNews(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $devicetype = $heard['devicetype'];
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $news_id =isset($heard['news_id'])?$heard['news_id']:0;

        if ($devicetype=='web') {
            $news = Db::table('convention_news_info')
            ->where(['record_status'=>1,'convention_id'=>$convention_id,'fid'=>$news_id])
            ->field("fid,create_time,title,content")
            ->find();
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                'data' => $news
            ];
        }
        //$this->setRedisValue(json_encode($data),1000);
        echo json_encode($data);exit;
    }

    /**
     * 会议专家列表
     */
    public function ExpertList(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $str =isset($heard['str'])?$heard['str']:"";
        $tables = Db::query("call p_convention_expert($convention_id)");
		$tables = Db::table('v_expert')->select();
/*         if (isset($tables[0][0]) && count($tables[0][0])>0) {
            $expert_list = $tables[0]; */
			if($tables){
			$expert_list = $tables; 
            $arr=[];
            if (count($expert_list)>0) {                
                foreach ($expert_list as &$vo) {
					$user= getFirstChar($vo['expert_name']);
					$image_url="/uploads/default.jpg";
					if(empty($vo['web_image_url'])){
						$vo['web_image_url']=$image_url;
					}
					if(empty($vo['app_image_url'])){
						$vo['app_image_url']=$image_url;
					}
					
					//$user= strtoupper(substr($CUtf8_PY::encode($vo['expert_name']),0,1));
					if($vo['fid']==107){
						$user="P";
					}else if($vo['fid']==160 || $vo['fid']==250){
						$user="Q";
					}else if($vo['fid']==143){
						$user="C";
					}

					if($str && $user==$str){
						array_push($arr,$vo);
					}else{
						$vo['sort']=$user;
					}
                }
				
				if(empty($str)){		
					$last_names = array_column($expert_list,'sort');
					array_multisort($last_names,SORT_ASC,$expert_list);
					$arr=$expert_list;
				}
            }
            
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                'data' => [
                    'expert_list' => $arr
                ]
            ];
        }else{
            $data = [
                'code' => '414',
                'msg' => '数据不存在',
            ];
        }
        $this->setRedisValue(json_encode($data),1000);
       echo json_encode($data);exit;
    }
    /**
     * 专家参会列表
     */
    public function ExpertMeet(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $expert_id =isset($heard['expert_id'])?$heard['expert_id']:0;

        $convention = Db::query("call p_expert_convention($convention_id,$expert_id)");
        $class_list = Db::table('base_class_conf')->where(['class_type'=>8,'record_status'=>1])->select();
        
        $expert_meet = [];
        if (isset($convention[0]) && count($convention[0])>0) {
            $expert_meet = $convention[0];
            foreach ($expert_meet as &$vo) {
                $role_ids = explode(",",$vo['role_ids']);
                $expert_ids = explode(",",$vo['expert_ids']);
                $expert_index = array_search($expert_id,$expert_ids);
                $vo['role_id']=1;
                $vo['role_name']="讲者";
                /*$role_id = $role_ids[$expert_index];
                $vo['role_id']=$role_id;
                foreach ($class_list as $class) {
                    if ($class['fid']==$vo['role_id']) {
                        $vo['role_name']=$class['class_name_zh'];
                    }
                }*/
            }
        }
        usort($expert_meet, array($this, "cmp"));
        $expert_info = Db::table('v_expert')->where(['record_status'=>1,'fid'=>$expert_id])->find();
        $data = [
            'code' => '200',
            'msg' => '获取成功',
            'data' => [
                'expert_meet' => $expert_meet,
                'expert_info' => $expert_info
            ]
        ];
        $this->setRedisValue(json_encode($data),1000);
        echo json_encode($data);exit;
    }
    
    function cmp($a, $b)
    {
        return strcmp($a["start_date"], $b["start_date"]);
    }
            
    /**
     * 专家详情
     */
    public function ExpertDetail(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $expert_id =isset($heard['expert_id'])?$heard['expert_id']:0;

        $expert = Db::table('v_expert')
        ->where(['fid'=>$expert_id,"record_status"=>1])
        ->find();
        if (!empty($expert)){
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                'data' => $expert
            ];
        }else{
            $data = [
                'code' => '414',
                'msg' => '数据不存在',
            ];
        }
        $this->setRedisValue(json_encode($data),1000);
       echo json_encode($data);exit;
    }

    /**
     * 参展商列表  参展商详情
     */
    public function ExhibitorList(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $page =isset($heard['page'])?$heard['page']:1;
        $pagesize =isset($heard['pagesize'])?$heard['pagesize']:40;
        $org_id =isset($heard['org_id'])?$heard['org_id']:0;//参展商id
        /* 参展商列表 */
        $result = Db::table("v_convention_exhibitor")
        ->where(["convention_id"=>$convention_id,"record_status"=>1])
        ->limit(($page-1)*$pagesize,$pagesize)
        ->order("exhibitor_type,sort","asc")
        ->select();
		//echo Db::table('v_convention_exhibitor')->getLastSql();die;
        /* 参展商详情  如果org_id 存在是详情*/
        $Org_Detail = [];
        if($org_id>0){
            $Org_Detail = Db::table("v_convention_exhibitor")
                ->where(["convention_id"=>$convention_id,'org_id'=>$org_id,"record_status"=>1])
                ->find();
        }

        $data = [
            'code' => '200',
            'msg' => '获取成功',
            'data' => [
                'exhibitor_list' => $result,
                'org_detail' => $Org_Detail
            ]
        ];

        $this->setRedisValue(json_encode($data),1000);
       echo json_encode($data);exit;
    }

    /**
     * 照片墙分类
     */
    public function PhotoWallClass(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $class_list = Db::table('v_convention_photo_info')
        ->where(['convention_id'=>$convention_id,'record_status'=>1])
        ->group('class_name')
        ->select();

        if (!empty($class_list)) {
            $data = [
                'code' => '200',
                'msg' => '评论成功',
                'data' => [
                    'class_list' => $class_list
                ]
            ];
        }else{
            $data = [
                'code' => '414',
                'msg' => '数据不存在',
            ];
        }
        $this->setRedisValue(json_encode($data),1000);
       echo json_encode($data);exit;
    }
    /**
     * 照片墙列表
     */
    public function PhotoWallList(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $photo_id =isset($heard['photo_id'])?$heard['photo_id']:0;
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $page =isset($heard['page'])?$heard['page']:1;
        $pagesize =isset($heard['pagesize'])?$heard['pagesize']:40;
        
        $result = Db::table("v_convention_photo_list")
        ->where(["photo_id"=>$photo_id,"convention_id"=>$convention_id,"record_status"=>1,'check'=>2])
        ->limit(($page-1)*$pagesize,$pagesize)
        ->order(['fid'=>'desc'])
        ->select();

        /* 返回点赞状态 */
        if ($uid>0){
            foreach($result as &$v){
                $where=["photo_list_id"=>$v['fid'],"convention_id"=>$convention_id,"creator_id"=>$uid];
                $praise = Db::table("convention_photo_praise")->where($where)->count();
                $v['praise_type']=$praise==0 ? 0 : 1;
            }
        }else{
            foreach($result as &$v){
                $v['praise_type']=0;
            }
        }
        $data = [
            'code' => '200',
            'msg' => '获取成功',
            'data' => [
                'photo_list' => $result
            ]
        ];

        $this->setRedisValue(json_encode($data),1000);
       echo json_encode($data);exit;
    }

    /**
     * 照片墙点赞
     */
    public function PhotoWallPraise(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $photo_list_id =isset($heard['photo_list_id'])?$heard['photo_list_id']:0;
        $uid =isset($heard['uid'])?$heard['uid']:0;

        Db::startTrans();
        try{  
            /* 判断用户是否点赞 */
            $where=["photo_list_id"=>$photo_list_id,"convention_id"=>$convention_id,"creator_id"=>$uid];
            $cnt = Db::table("convention_photo_praise")->where($where)->count(); 
            if ($cnt==0){
                $praise = Db::table("convention_photo_list")
                    ->where(['fid'=>$photo_list_id,'convention_id'=>$convention_id])
                    ->value("praise_num");
                /* 没有点赞 执行更新点赞数 */
                Db::table('convention_photo_list')->where(["fid"=>$photo_list_id,"convention_id"=>$convention_id])->update(['praise_num'=>($praise+1)]);
                /* 没有点赞 执行插入点赞记录 */
                Db::table('convention_photo_praise')->insertGetId($where);
                //echo Db::table('convention_photo_list')->getLastSql();die;
            }
            /* 返回点赞数 */
            $praise = Db::table("convention_photo_list")
                ->where(['fid'=>$photo_list_id,'convention_id'=>$convention_id])
                ->value("praise_num");
            $data = [
                'code' => '200',
                'msg' => '点赞成功',
                'data' => [
                    'praise_num' => $praise,
                    'praise_type' =>1
                ]
            ];
        Db::commit();
        }catch (\Exception $e) {
            // 回滚事务
        Db::rollback();
            $error_msg = $e->getMessage();
            $data = [
                'code' => '413',
                'msg' => '点赞失败,'.$error_msg
            ];
        }
        $this->setRedisValue(json_encode($data),1000);
        echo json_encode($data);exit;
    }
        
    /**
     * 照片墙 上传
     */
    public function PhotoWallUpload(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $photo_list_id =isset($heard['photo_list_id'])?$heard['photo_list_id']:0;
        $image_ids =isset($heard['image_id'])?$heard['image_id']:'';

        Db::startTrans();
        try{  
            /* 保存图片 获取上传图片ID */
            if (gettype($image_ids)=='string') {
                $image_ids = json_decode(htmlspecialchars_decode($image_ids),true);
            }
            $params = [];
            for ($i=0; $i < count($image_ids); $i++) { 
                $base64_string = $image_ids[$i];
                $url =ROOT_PATH. 'public' . DS . 'uploads/'; // 自定义文件上传路径
                $file_info = base64_image_content($base64_string,$url);
                $file_path = '/uploads'. DS .$file_info['path'];
				$data = [
					'file_name'=>'',
					'file_path'=>$path,
					'file_size'=>0,
					'source_type'=>$type,
					'record_status'=>-1,
					'create_time'=>date("Y-m-d H:i:s", time()),
					'creator_id'=>$uid
				];
                $source_id =Db::table('base_source_info')->insertGetId($data);
                $param = [
                    'app_image_id'=>$source_id,
                    'photo_id'=>$photo_list_id,
                    'convention_id'=>$convention_id,
                    'creator_id'=>$uid,
                    'create_time'=>date("Y-m-d H:i:s", time())
                ];
                $params[] = $param;
            }
            Db::table('convention_photo_list')->insertAll($params);
            $data = [
                'code' => '200',
                'msg' => '上传成功'
            ];
            Db::commit();
        }catch (\Exception $e) {
            // 回滚事务
        Db::rollback();
            $error_msg = $e->getMessage();
            $data = [
                'code' => '413',
                'msg' => '点赞失败,'.$error_msg
            ];
        }
        $this->setRedisValue(json_encode($data),1000);
        echo json_encode($data);exit;
    }
       
    /**
     * 发表播客
     * podcast_id=0 发表播客 podcast_id=播客ID 删除播客
     */
    public function Podcast(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $heard = array_filter($heard);
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $from_id =isset($heard['uid'])?$heard['uid']:0;
        $content =isset($heard['content'])?$heard['content']:'';
        $image_ids =isset($heard['image_id'])?$heard['image_id']:'';
        $podcast_id =isset($heard['podcast_id'])?$heard['podcast_id']:0;

        Db::startTrans();
        try {
            if($podcast_id==0 && $convention_id>0){
                /* 保存图片 获取上传图片ID */
                if (gettype($image_ids)=='string') {
                    $image_ids = json_decode(htmlspecialchars_decode($image_ids),true);
                }
                $source=[];
                for ($i=0; $i < count($image_ids); $i++) { 
                    $base64_string = $image_ids[$i];
                    $url =ROOT_PATH. 'public' . DS . 'uploads/'; // 自定义文件上传路径
                    $file_info = base64_image_content($base64_string,$url);
                    $file_path = '/uploads'. DS .$file_info['path'];
                    $source_id = save_file_to_db($file_path,1,$from_id);
                    $source[]=$source_id;
                }
                /* 播客数据插入 */  
                $source=implode(",",$source);
                //鉴黄start
                //$content =CheckContent($content);
                //鉴黄end
                $data = [
                    'convention_id'=>$convention_id,
                    'content'=>$content,
                    'image_ids'=>"$source",
                    'user_id'=>$from_id,
                    'creator_id'=>$from_id,
                    'updater_id'=>$from_id,
                    'create_time'=>date("Y-m-d H:i:s", time())
                ];
                $fid=Db::table('convention_podcast_info')->insertGetId($data);
                /* 播客数据插入成功后 返回当前发表的一条 */
                $podcast_list = Db::table("v_convention_podcast")
                    ->where(['convention_id'=>$convention_id,'fid'=>$fid])
                    ->find();
                $image_list = Db::table('base_source_info')
                    ->field('file_path as image_url')
                    ->wherein('fid',"$source")
                    ->where(['record_status'=>1])
                    ->select();
                $podcast_list['image_list'] = $image_list;    
                $data = [
                    'code' => '200',
                    'msg' => '提交成功',
                    'data'=>$podcast_list
                ];
            }else if($podcast_id>0 && $convention_id>0){
                $image_ids = Db::table("convention_podcast_info")
                    ->where(['convention_id'=>$convention_id,'fid'=>$podcast_id])
                    ->find();
                /* 删除播客列表 */
                Db::table("convention_podcast_info")
                    ->where(['fid'=>$podcast_id])
                    ->delete();
                /* 删除博客列表同时删除 评论 */
                Db::table("convention_podcast_comment")
                    ->where(['podcast_id'=>$podcast_id])
                    ->delete();
                /* 删除博客列表同时删除 点赞*/
                Db::table("convention_podcast_praise")
                    ->where(['podcast_id'=>$podcast_id])
                    ->delete();
                /* 删除博客列表同时删除 服务器图片资源*/     
                del_image_path($image_ids['image_ids']);
                /* 删除博客列表同时删除 上传图片*/
                Db::table('base_source_info')
                    ->wherein('fid',$image_ids["image_ids"])
                    ->delete();
                $data = [
                    'code' => '200',
                    'msg' => '删除成功'
                ];    
            }
            Db::commit();
        }catch (\Exception $e) {
            logs($e->getMessage());
            // 回滚事务
            Db::rollback();
            $error_msg = $e->getMessage();
            $data = [
                'code' => '413',
                'msg' => '提交失败,'.$error_msg
            ];
        }
        $this->setRedisValue(json_encode($data),1000);
       echo json_encode($data);exit;
    }
    /**
     * 播客列表
     */
    public function PodcastList(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $heard = array_filter($heard);
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $page =isset($heard['page'])?$heard['page']:1;
        $pagesize =isset($heard['pagesize'])?$heard['pagesize']:40;
        $ismy =isset($heard['ismy'])?$heard['ismy']:0; //是否是个人中心我的播客

        /* 播客列表 */
        $where=["convention_id"=>$convention_id,"record_status"=>1];
        if($ismy==1){
            $where=["convention_id"=>$convention_id,'creator_id'=>$uid,"record_status"=>1];
        }
        $result = Db::table("v_convention_podcast")
        ->where($where)
        ->limit(($page-1)*$pagesize,$pagesize)
        ->order(['fid'=>'desc'])
        ->select();

        /* 播客评论数据 */
        $comment_list = Db::table("v_convention_podcast_comment")
                ->where(['convention_id'=>$convention_id,'record_status'=>1])
                ->order(['fid'=>'asc'])
                ->select();

        if (!empty($result)) {
            foreach ($result as &$vo) {
                $image_ids = $vo['image_ids'];
                $comment_data = [];
                foreach ($comment_list as $comment) {
                    if ($vo['fid']==$comment['podcast_id']) {
                        $comment_data[] = $comment;
                    }
                }
                $vo['comment_list'] = $comment_data;
                $image_list=[];
                $image_list = Db::table('base_source_info')
                    ->field('file_path as image_url')
                    ->wherein('fid',$image_ids)
                    ->where(['record_status'=>1])
                    ->select();
                $vo['image_list'] = $image_list;
                /* 判断是否点过赞 */
                $num=Db::table('convention_podcast_praise')
                    ->where(['convention_id'=>$convention_id,'podcast_id'=>$vo['fid'],'from_id'=>$uid,'to_id'=>$vo['user_id']])
                    ->count();
                    //echo Db::table('convention_podcast_praise')->getLastSql();die;
                $vo['praise_type']=$num;
            }
        }
        $data = [
            'code' => '200',
            'msg' => '获取成功',
            'data' => [
                'podcast_list' => $result
            ]
        ];
        //$this->setRedisValue(json_encode($data),1000);
       echo json_encode($data);exit;
    }
    
    /**
     * 播客评论
     * comment_id=0 提交评论 comment_id=播客评论id 删除评论
     */
    public function PodcastComment(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $heard = array_filter($heard);
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $podcast_id =isset($heard['podcast_id'])?$heard['podcast_id']:0;
        $from_id =isset($heard['from_id'])?$heard['from_id']:0;
        $to_id =isset($heard['to_id'])?$heard['to_id']:0;
        $content =isset($heard['content'])?$heard['content']:'';
        $comment_id =isset($heard['comment_id'])?$heard['comment_id']:0;
        Db::startTrans();
        try {
            if($comment_id==0 && $convention_id>0){
                //鉴黄start
                $content =CheckContent($content);
                //鉴黄end
                $data = [
                    'convention_id'=>$convention_id,
                    'podcast_id'=>$podcast_id,
                    'from_id'=>$from_id,
                    'to_id'=>$to_id,
                    'content'=>$content,
                    'creator_id'=>$from_id,
                    'updater_id'=>$from_id,
                    'create_time'=>date("Y-m-d H:i:s", time())
                ];
                $fid=Db::table('convention_podcast_comment')->insertGetId($data);
                /* 评论成功后返回 当前评论的一条 */
                $comment_list = Db::table("v_convention_podcast_comment")
                    ->where(['convention_id'=>$convention_id,'fid'=>$fid,'record_status'=>1])
                    ->find();
                $data = [
                    'code' => '200',
                    'msg' => '评论成功',
                    'data' =>$comment_list
                ];                    
            }else if($comment_id>0 && $convention_id>0){
                Db::table("convention_podcast_comment")
                    ->where(['convention_id'=>$convention_id,'fid'=>$comment_id,'to_id'=>$to_id])
                    ->delete();
                    $data = [
                        'code' => '200',
                        'msg' => '删除成功'
                    ];                    
            }
            Db::commit();
        }catch (\Exception $e) {
            logs($e->getMessage());
            // 回滚事务
            Db::rollback();
            $error_msg = $e->getMessage();
            $data = [
                'code' => '413',
                'msg' => '评论失败,'.$error_msg
            ];
        }
        $this->setRedisValue(json_encode($data),1000);
       echo json_encode($data);exit;
    }

    /**
     * 播客点赞
     */
    public function PodcastPraise(){
        $heard = request()->param();
        $heard = array_filter($heard);
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $podcast_id =isset($heard['podcast_id'])?$heard['podcast_id']:0;
        $from_id =isset($heard['from_id'])?$heard['from_id']:0;
        $to_id =isset($heard['to_id'])?$heard['to_id']:0;
       
        Db::startTrans();
        try {
            /* 根据查询统计判断 是否已点赞 */
            $praise_type=Db::table('convention_podcast_praise')->where(['convention_id'=>$convention_id,'podcast_id'=>$podcast_id,'from_id'=>$from_id,'to_id'=>$to_id])->count();
            $where=['convention_id'=>$convention_id,'fid'=>$podcast_id];  
            $Praise =Db::table("v_convention_podcast")
                    ->where($where)
                    ->value('praise');
            if($praise_type==0 && $convention_id>0){
                /* 更新点赞数 */
                Db::table('v_convention_podcast')->where($where)->update(['praise'=>$Praise+1]);
                /* 跟新同时插入一条记录 */
                $param=HandleParamsForInsert("convention_podcast_praise",$heard);
                Db::table('convention_podcast_praise')->insertGetId($param);
            }
            /* 插入成功后返回实时点赞数 */
            $Praise =Db::table("v_convention_podcast")
                ->where($where)
                ->value('praise');
            $data = [
                'code' => '200',
                'msg' => '点赞成功',
                'data' => [
                    'praise' => $Praise,
                    'praise_type' =>1
                ]
            ];            
            Db::commit();
        }catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            $error_msg = $e->getMessage();
            $data = [
                'code' => '413',
                'msg' => '点赞失败,'.$error_msg
            ];
        }
        $this->setRedisValue(json_encode($data),1000);
        echo json_encode($data);exit;
    }
    
    /**
     * 会议一级日程列表
     */
    public function ScheduleFirst(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $search_type =isset($heard['search_type'])?$heard['search_type']:0;
        $selectdate =isset($heard['selectdate'])?$heard['selectdate']:'';
        $search =isset($heard['search'])?$heard['search']:'';
        $ismy =isset($heard['ismy'])?$heard['ismy']:0; //是否是个人中心我的添加日程 0不是 1是
        $time=date("Y-m-d H:i:s");
        $selectdate_list = Db::table('v_convention_schedulefirst')
        ->Distinct(true)
        ->field('selectdate')
        ->where(['record_status'=>1,'convention_id'=>$convention_id])
        ->order('selectdate')        
        ->select();

        $where = ["convention_id"=>$convention_id,"record_status"=>1];
        if ($search_type==0) {
            #全部

        }elseif ($search_type==1){
            # 正在进行
            // $where[] = [
            //     Db::raw('start_date >= NOW()'),
            //     Db::raw('end_date <= NOW()'),
            // ];
            $where['start_date'] = array('elt',$time);
            $where['end_date'] = array('egt',$time);
            // $where[] = [
            //     'start_date'=>['>'=>'now()'],
            //     'end_date'=>['<'=>'now()']
            // ];
        }elseif ($search_type==2){
            # 即将进行
            $where['start_date'] = array('egt',$time);
        }elseif ($search_type==3){
            // #按日期
            if (count($selectdate)>0){
                $where['selectdate']=array('eq',$selectdate);
            }
            // $where[]=['exp'=>$selectdate];
            // 'date_sub(curdate(), INTERVAL 7 DAY) <= date(c.ccnexttime)';
        }elseif ($search_type==4){
            // #搜索
            $where['schedule_name']=array('like','%'.$search.'%');
            // $where[]=['exp'=>$selectdate];
            // 'date_sub(curdate(), INTERVAL 7 DAY) <= date(c.ccnexttime)';
        }

        if ($ismy>0){
            //个人中心 加我添加过的筛选条件
            $increase = Db::table('convention_schedule_increase')
            ->distinct('schedulefirst_id')
            ->where(['creator_id'=>$uid])
            ->select();
            $my_ids = [];
            foreach ($increase as $my) {
                $my_ids[] = $my['schedulefirst_id'];
            }
            $my_str = implode(',',$my_ids);
            $where['fid'] = array('in',$my_str);
        }

        $result = Db::table("v_convention_schedulefirst")
        ->where($where)
        //->order(['start_date'=>'asc','room_id'=>'desc','fid'=>'desc'])
        ->order(['start_date'=>'asc','room_id'=>'asc'])
        ->select();


        $data = [
            'code' => '200',
            'msg' => '获取成功',
            'data' => [
                'schedulefirst_list' => $result,
                'selectdate' => $selectdate_list
            ]
        ];

       // $this->setRedisValue(json_encode($data),1000);
        echo json_encode($data);exit;
    }
        
    /**
     * 会议二级日程列表
     */
    public function ScheduleSecond(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $schedulefirst_id =isset($heard['schedulefirst_id'])?$heard['schedulefirst_id']:0;
        $uid =isset($heard['uid'])?$heard['uid']:0;

        $schedulefirst = Db::table("v_convention_schedulefirst")
        ->where(['fid'=>$schedulefirst_id,'record_status'=>1])            
        ->order(['start_date'=>'asc'])
        ->find();

        if (!empty($schedulefirst)) {
            /* 返回一级日程专家信息 */
            $lists=self::schedule_expert_list($heard,$schedulefirst,1);
            $schedulefirst['expert_list']=$lists['expert_list'];
             /* 标记是否已添加我的日程 */
            $schedulefirst['increase_type']=$lists['increase_type'];

            $schedulesecond = Db::table('convention_schedulesecond_info')
            ->where(['schedulefirst_id'=>$schedulefirst_id,'record_status'=>1])
            ->order(['start_date'=>'asc'])
            ->select();
            
            if (count($schedulesecond)>0) {
                foreach ($schedulesecond as &$key) {
                    /* 返回二级日程专家信息 */
                    $list=self::schedule_expert_list($heard,$key,2);
                    $key['expert_list']=$list['expert_list'];
                    /* 标记是否已添加我的日程 */
                    $key['increase_type']=$list['increase_type'];
                }
            }
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                'data' => [
                    'schedulefirst_info' => $schedulefirst,
                    'schedulesecond_list' => $schedulesecond
                ]
            ];
            
        }else{
            $data = [
                'code' => '414',
                'msg' => '数据不存在',
            ];
        }
        $this->setRedisValue(json_encode($data),1000);
       echo json_encode($data);exit;
    }
     /**
     * 会议二级日程 评论区列表
     */
    public function ScheduleComment(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $schedulefirst_id =isset($heard['schedulefirst_id'])?$heard['schedulefirst_id']:0;
        $uid =isset($heard['uid'])?$heard['uid']:0;

        $schedulefirst = Db::table("v_convention_schedulefirst")
        ->where(['fid'=>$schedulefirst_id,'record_status'=>1])            
        ->order(['start_date'=>'asc'])
        ->find();
        
        $comment_list = Db::table("v_convention_schedulefirst_comment")
        ->where(['record_status'=>1,'convention_id'=>$convention_id,'schedulefirst_id'=>$schedulefirst_id])
        ->order(['fid'=>'desc'])
        ->select();

        $data = [
            'code' => '200',
            'msg' => '获取成功',
            'data' => [
                'schedulefirst_info' => $schedulefirst,
                'comment_list' => $comment_list,
                'duration'=>5 //刷新频率
            ]
        ];
            
        $this->setRedisValue(json_encode($data),1000);
       echo json_encode($data);exit;
    }
    /**
    * 会议二级日程 评论发布
    */
   public function Comment(){
       // $heard=$this->getAllHeaders();
       $heard = request()->param();
       $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
       $schedulefirst_id =isset($heard['schedulefirst_id'])?$heard['schedulefirst_id']:0;
       $uid =isset($heard['uid'])?$heard['uid']:0;
       $content =isset($heard['content'])?$heard['content']:'';
       Db::startTrans();
       try{
			//鉴黄start
            $content =CheckContent($content);
            if ($convention_id>0 && $schedulefirst_id>0 && $content != ''){
                $datas = [];
                $datas['convention_id']=$convention_id;
                $datas['schedulefirst_id']=$schedulefirst_id;
                $datas['content']=$content;
                $datas['creator_id']=$uid;
                $datas['create_time']=date("Y:m:d H:i:s", time());
                $status = Db::table('convention_schedulefirst_comment')->insertGetId($datas);
                // echo json_encode(Db::table('convention_schedulefirst_comment')->getLastSql());exit;
                $data = [
                    'code' => '200',
                    'msg' => '提交成功,需要审核后才能显示，请您耐心等待'
                ];
                Db::commit();
            }else{
                $data = [
                    'code' => '413',
                    'msg' => '提交失败,参数有误'
                ];
            }
       }catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            $error_msg = $e->getMessage();
            $data = [
                'code' => '413',
                'msg' => '提交失败,'.$error_msg
            ];
        }
           
       //$this->setRedisValue(json_encode($data),1000);
       echo json_encode($data);exit;
   }

    /**
     * 封装日程返回专家信息  添加我的日程状态
     */
    public function schedule_expert_list($data,$list,$type){
        $expert_ids =isset($list['expert_ids'])?$list['expert_ids']:"";
        $role_ids = isset($list['role_ids'])?$list['role_ids']:"";
        $uid = isset($data['uid'])?$data['uid']:"";
        $expert_ids = explode(',',$expert_ids);
        $role_ids = explode(',',$role_ids);
        $expert_list = [];
        $info=[];
        /* 返回日程专家信息 */
        for ($i=0; $i < count($expert_ids); $i++) { 
            $expert_id = $expert_ids[$i];
            $role_id = $role_ids[$i];
            $expert_name = Db::table('v_expert')->field('expert_name,app_image_url')->where(['fid'=>$expert_id])->find();
            $role_name = Db::table('base_class_conf')->field('class_name_zh as role_name')->where(['fid'=>$role_id])->find();
            $expert_list[] = [
                'expert_id' => $expert_id,
                'expert_name' => $expert_name['expert_name'],
                'app_image_url' => $expert_name['app_image_url'],
                'role_id' => $role_id,
                'role_name' => $role_name['role_name']
            ];
        }
        /* 标记是否已添加我的日程 */
        $heard=['convention_id'=>$data['convention_id'],'schedulefirst_id'=>$data['schedulefirst_id'],'creator_id'=>$uid];
        $increase_type = Db::table('convention_schedule_increase')->where($heard)->value("schedulesecond_id");
        $fid=$type==2?$list['fid']:-1;
        $increase_type = in_array($fid,explode(",",$increase_type))==true?1:0;
        //最终结果返回 
        $info['expert_list']=$expert_list;
        $info['increase_type']=$increase_type;
        return $info;
    }

    /**
     * 添加我的日程
     */
    public function ScheduleIncrease(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $heard = array_filter($heard);
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $schedulefirst_id =isset($heard['schedulefirst_id'])?$heard['schedulefirst_id']:0;
        $schedulesecond_id =isset($heard['schedulesecond_id'])?$heard['schedulesecond_id']:0;
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $table="convention_schedule_increase";
        if($convention_id>0 && $schedulefirst_id>0 && $uid>0 && !empty($schedulesecond_id)){
            Db::startTrans();
            try{
                $datas=[];
                $datas['convention_id']=$convention_id;
                $datas['schedulefirst_id']=$schedulefirst_id;
                $datas['creator_id']=$uid;
                /* 添加之前删除已添加重新添加机制 */
                //schedulesecond_id -1 表示一级日程 -2 表示取消
                DB::table($table)->where($datas)->delete();
                if($schedulesecond_id!=-2){
                    /* 添加我的日程 */
                    $datas['schedulesecond_id']="$schedulesecond_id";
                    $datas['create_time']=date("Y:m:d H:i:s");
                    //var_dump($heard);die;
                    DB::table($table)->insertGetId($datas);
                }
                $data = [
                    'code' => '200',
                    'msg' => '提交成功'
                ];
                Db::commit();
            }catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                $error_msg = $e->getMessage();
                $data = [
                    'code' => '413',
                    'msg' => '提交失败,'.$error_msg
                ];
            }
        }else{
            $data = [
                'code' => '413',
                'msg' => '请求失败',
            ];
        }
        $this->setRedisValue(json_encode($data),1000);
       echo json_encode($data);exit;
    }
    
    /**
     * 会议室定位
     */
    public function RoomLocation(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $room_id = isset($heard['room_id'])?$heard['room_id']:0;

        $result = Db::table("v_convention_room")
        ->where(["fid"=>$room_id,'convention_id'=>$convention_id,"record_status"=>1])
        ->find();

        if (!empty($result)) {
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                'data' => [
                    'room_info' => $result
                ]
            ];
        }else{
            $data = [
                'code' => '414',
                'msg' => '数据不存在',
            ];
        }
        $this->setRedisValue(json_encode($data),1000);
       echo json_encode($data);exit;
    }


  //支付方式选择
  public function PayType(){
    $param = request()->param();
    $convention_id = isset($param['convention_id']) ? $param['convention_id'] : 0;
    $uid = isset($param['uid']) ? $param['uid'] : 0;
    $pay_type =isset($param['pay_type'])?$param['pay_type']:'';

    $status=0;
    /* 支付方式选择 */
    if(!empty($pay_type)){
        if($pay_type>0 && $uid>0 && $convention_id>0){
            $status=Db::table('convention_signup_info')
                ->where(['creator_id'=>$uid,'convention_id'=>$convention_id])
                ->update(['pay_type'=>$pay_type]);
        }
        $data = [
            'code' => '200',
            'msg' => '提交成功',
            'data' => ['pay_type' =>$pay_type]
        ];
    }else{
        $data=result(413,"提交失败");
    }
    echo json_encode($data);exit;
  }
  //会议报名详情
  public function Sign(){
    $param = request()->param();
    $convention_id = isset($param['convention_id']) ? $param['convention_id'] : 0;
    $uid = isset($param['uid']) ? $param['uid'] : 0;
	$signup_info=[];
	if($uid==0 || $uid<0){
		$data=result(413,"请从新登陆！");
		echo json_encode($data);exit;			
    }
    /* 用户基本信息 */
    $userinfo = Db::table("v_enduser")
    ->where(['fid'=>$uid,"record_status"=>1])
    ->field("user_name,fid,tel,org_name,job_id")
    ->find();
    /* 自定义题目 */
    $sign_list = Db::table("convention_sign_info")
    ->where(['convention_id'=>$convention_id,"record_status"=>1])
    ->order(['sort'=>'desc','fid'=>'desc'])
    ->select();

    /* 自定义题目选项 */
    $sign_detail_list = Db::table('convention_sign_detail')
    ->where(['record_status'=>1,'convention_id'=>$convention_id])
    ->order(['sort'=>'desc','fid'=>'desc'])
    ->select();

    if (count($sign_list)>0) {
        foreach ($sign_list as &$vo) {
            $detail_list = [];
            foreach ($sign_detail_list as $detail) {
                if ($vo['fid']==$detail['signup_id']) {
                    $detail_list[] = $detail;
                }
            }
            $vo['detail_list'] = $detail_list;
        }
    }
    /* 门票类型 */
    $ticket_list = Db::table('convention_sign_ticket')
    ->where(['record_status'=>1,'convention_id'=>$convention_id])
    ->order(['fid'=>'asc'])
    ->select();

    if ($uid>0) {
        # 用户已填写的信息
        $signup_info = Db::table('convention_signup_info')
        ->where(['record_status'=>1,'convention_id'=>$convention_id,'creator_id'=>$uid])
        ->find();
        $signup_detail_list = Db::table('convention_signup_detail')
        ->where(['record_status'=>1,'convention_id'=>$convention_id,'creator_id'=>$uid])
        ->select();
        if (empty($signup_info)) {
            //未报名
            foreach ($ticket_list as &$ticket) {
                $ticket['pay_status'] = 0;
            }

        }else{
            //已报名
            foreach ($ticket_list as &$ticket) {
                if ($ticket['fid']==$signup_info['ticket_id']) {
                    $ticket['pay_status'] = $signup_info['pay_status'];
                }
                if ($ticket['fid']==$signup_info['ticket_id']) {
                    $ticket['user_value'] = $signup_info['ticket_id'];
                }else{
                    $ticket['user_value'] = '';
                }
            }
            foreach ($sign_list as &$sign) {
                $sign['user_value'] = '';
                foreach ($signup_detail_list as $signup_detail) {
                    if ($signup_detail['sign_id']==$sign['fid']) {
                        $sign['user_value'] = $signup_detail['value'];
                    }
                }
            }
        }
    }
    
    $data = [
        'code' => '200',
        'msg' => '获取成功',
        'data' => [
            'userinfo' => $userinfo,
            'sign_list' => $sign_list,
            'ticket_list' => $ticket_list,
            'signup_info' => $signup_info
        ]
    ];
    $this->setRedisValue(json_encode($data),1000);
    echo json_encode($data);exit;
  }


    /**
    * 会议报名 提交
    */
   public function SignUp(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $heard = array_filter($heard);
        $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
        $user_id =!empty($heard['uid'])?$heard['uid']:0;
		//通过后台编辑参会者信息
        $admin_fid =!empty($heard['cifis'])?$heard['cifis']:0;
        $sign_info =isset($heard['sign_info'])?$heard['sign_info']:[];
        $sign_data =isset($heard['sign_data'])?$heard['sign_data']:[];
        if($user_id==0 || $user_id<0){
			$data=result(413,"提交失败");
			echo json_encode($data);exit;			
        }
        
        Db::startTrans();
        try {
            $sign_old = Db::table('convention_signup_info')
				->where(['record_status'=>1,'creator_id'=>$user_id,'convention_id'=>$convention_id])
				->find();
            $sign_info['convention_id'] = $convention_id;
            $sign_info['creator_id'] = $user_id;
            $sign_info['updater_id'] = $user_id;
            $sign_info['order_number'] =date('Y')."T0".$user_id;
            $sign_info['create_time'] = date("Y-m-d H:i:s", time());
            $sign_info=HandleParamsForInsert('convention_signup_info',$sign_info);
			//控制一个账号报名多个
			$tel=Db::table('v_enduser')->where(['fid'=>$user_id])->value('tel');//账号手机号
			$tel=substr($tel,-11,11);
			$sign_tel=substr($sign_info['tel'],-11,11);
			// IF($user_id==2599){
				// var_dump($sign_tel,$tel,$heard);die;
			// }
			if(empty($tel) || $tel!=$sign_tel){
				$data=result(413,"账号与报名手机号不一致，请勿重新报名");
				echo json_encode($data);exit;
			}
			
            if (empty($sign_old)) {
				$sign_info['pay_status'] =1;
                $signup_id = Db::table('convention_signup_info')->insertGetId($sign_info);
            }else{
                $signup_id = $sign_old['fid'];
                Db::table('convention_signup_info')->where(['fid'=>$signup_id])->update($sign_info);
            }
			
            $detail_list = [];
            Db::table('convention_signup_detail')->where("signup_id",$signup_id)->delete();
            foreach ($sign_data as $vo) {
                $detail = [
                    'convention_id' => $convention_id,
                    'signup_id' => $signup_id,
                    'value' => $vo['value'],
                    'sign_id' => $vo['sign_id'],
                    'field_type' => $vo['field_type'],
                    'creator_id' => $user_id,
                    'updater_id' => $user_id,
                    'create_time' => date("Y-m-d H:i:s", time())
                ];
                $detail_list[] = $detail;
            }
            Db::table('convention_signup_detail')->insertAll($detail_list);
			//判断订单号是否创建 为创建进行创建
			$order=Db::table('convention_order_info')->where(['convention_id'=>$convention_id,'creator_id'=>$user_id])->value("pay_number");
			//通过后台编辑参会者信息不发送有邮件  不创建订单
			if((empty($sign_old) || empty($order)) && $admin_fid==0){
				//年会报名成功生成支付订单 convention_order_info
				//创建前删除之前失败订单
				Db::table('convention_order_info')->where(['convention_id' =>$convention_id,'creator_id' =>$user_id,'order_status'=>1])->delete();
				$danhao = date('YmdHis') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
				$order_detail = [
					'convention_id' => $convention_id,
					'ticket_id' =>$sign_info['ticket_id'],
					'order_number' =>$sign_info['order_number'],
					'pay_number' =>$danhao,
					'pay_type' =>$sign_info['pay_type'],
					'order_status' => 1,
					'invoice_status' => $sign_info['invoice_status'],
					'record_status' =>1,
					'creator_id' => $user_id,
					'create_time' => date("Y-m-d H:i:s", time())
				];
				Db::table('convention_order_info')->insertGetId($order_detail);
			}else{
				$order_detail = [
					'ticket_id' =>$sign_info['ticket_id'],
					'pay_type' =>$sign_info['pay_type'],
					'invoice_status' => $sign_info['invoice_status'],
					'creator_id' => $user_id
				];		
				//后台修改用户信息同时更新订单信息
				Db::table('convention_order_info')->where(['convention_id'=>$convention_id,'creator_id'=>$user_id])->update($order_detail);	
			}
            Db::commit();
			//支付方式线下支付发邮件 没有包过名
			$param=['convention_id'=>$convention_id,'uid'=>$user_id];
			if((empty($sign_old) && !empty($sign_info['pay_type']) && $sign_info['pay_type']==1) ||
				(!empty($sign_old) && $sign_old['pay_type']==2 && $sign_info['pay_type']==1)
			){
				Send_Report(4,$param);
			}			
            $data = [
                'code' => '200',
                'msg' => '提交成功'
            ];
        }catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            $error_msg = $e->getMessage();
            $data = [
                'code' => '413',
                'msg' => '提交失败,'.$error_msg
            ];
        }
        echo json_encode($data);exit;
   }
   
   /**
   * 会议直播
   */
  public function Live(){
      // $heard=$this->getAllHeaders();
      $heard = request()->param();
      $convention_id =isset($heard['convention_id'])?$heard['convention_id']:0;
      $page =isset($heard['page'])?$heard['page']:1;
      $pagesize =isset($heard['pagesize'])?$heard['pagesize']:40;

      Db::startTrans();
      try {
           $result = Db::table('v_convention_live')
           ->where(['convention_id'=>$convention_id,'record_status'=>1])
           ->limit(($page-1)*$pagesize,$pagesize)
           ->order(['sort'=>'desc','fid'=>'desc'])
           ->select();
           Db::commit();
           $data = [
               'code' => '200',
               'data' => $result,
               'msg' => '获取成功'
           ];
       }catch (\Exception $e) {
           logs($e->getMessage());
           // 回滚事务
           Db::rollback();
           $error_msg = $e->getMessage();
           $data = [
               'code' => '413',
               'msg' => '获取失败,'.$error_msg
           ];
       }
     echo json_encode($data);exit;
  }

  public function Download(){
    $param = request()->param();
    $module = isset($param['module']) ? $param['module'] : '';
    $convention_id = isset($param['convention_id']) ? $param['convention_id'] : 0;
    $download_type = 0;
    if($module=='B1'){
        //$theme="会议通知";
        $download_type=1;
    }elseif($module=='B2'){
        //$theme="会议课件";
        $download_type=2;
    }elseif($module=='B3'){
        //$theme="论文集";
        $download_type=7;
    }elseif($module=='B4'){
        //$theme="资料汇编";
        $download_type=4;
    }elseif($module=='B5'){
        //$theme="企业交流手册";
        $download_type=5;
    }elseif($module=='B6'){
        //$theme="展区布置图";
        $download_type=6;
    }
    $download_list = Db::table('v_convention_download')
    ->where(['convention_id'=>$convention_id,'download_type'=>$download_type,'record_status'=>1])
    ->select();
    $data = [
        'code'=>'200',
        'data'=>$download_list,
        'msg'=>'获取成功'
    ];
    $this->setRedisValue(json_encode($data),1000);
    echo json_encode($data);exit;
  }
  public function Article(){
    $param = request()->param();
    $module = isset($param['module']) ? $param['module'] : '';
    $convention_id = isset($param['convention_id']) ? $param['convention_id'] : 0;
    $article_type = 0;
    //1.关于城市，2.会场介绍，3会议酒店，4周边餐饮,5.历届简介，6.大会征文通知,7.秘书处
    if($module=='Z'){
        //$theme="关于城市";
        $article_type=1;
    }elseif($module=='X'){
        //$theme="会场介绍";
        $article_type=2;
    }elseif($module=='V'){
        //$theme="会议酒店";
        $article_type=3;
    }elseif($module=='N'){
        //$theme="周边餐饮";
        $article_type=4;
    }elseif($module=='A1'){
        //$theme="历届简介";
        $article_type=5;
    }elseif($module=='A2'){
        //$theme="大会征文通知";
        $article_type=6;
    }elseif($module=='A3'){
        //$theme="秘书处";
        $article_type=7;
    }

    $article_list = Db::table('convention_article_info')
    ->where(['convention_id'=>$convention_id,'article_type'=>$article_type,'record_status'=>1])
    ->select();
    $data = [
        'code'=>'200',
        'data'=>$article_list,
        'msg'=>'获取成功'
    ];
    $this->setRedisValue(json_encode($data),1000);
    echo json_encode($data);exit;
  }
//场馆图
  function Map(){
    $param = request()->param();
    $convention_id = isset($param['convention_id']) ? $param['convention_id'] : 0;
    $map = Db::table('v_convention_map')
    ->where(['record_status'=>1,'convention_id'=>$convention_id])
    ->select();
    $data = [
        'code'=>'200',
        'data'=>[
            'map_list' => $map
        ],
        'msg'=>'获取成功'
    ];
    $this->setRedisValue(json_encode($data),1000);
    echo json_encode($data);exit;
  }
  //会议剪影  荣誉
  function History(){
    $param = request()->param();
    $convention_id = isset($param['convention_id']) ? $param['convention_id'] : 0;
    $history_type = isset($param['history_type']) ? $param['history_type'] : 0; //1代表历届会议剪影，2代表荣誉
    
    $history_list = Db::table('v_convention_history_info')
	->order("sort asc")
    ->where(['record_status'=>1,'convention_id'=>$convention_id,'history_type'=>$history_type])
    ->select();

    if (count($history_list)>0) {
        foreach ($history_list as &$vo) {
            $images = $vo['image_ids'];
            $image_list = Db::table('base_source_info')->wherein('fid',$images)->select();
            $vo['image_list'] = $image_list;
        }
    }
    $data = [
        'code' => '200',
        'msg' => '获取成功',
        'data' => $history_list
    ];
    $this->setRedisValue(json_encode($data),1000);
    echo json_encode($data);exit;
  }

//上传论文集
  public function UploadArticle(){
    $param = request()->param();
    $convention_id = isset($param['convention_id']) ? $param['convention_id'] : 0;
    $uid = isset($param['creator_id']) ? $param['creator_id'] : 0;
    $file_ids = isset($param['file_ids']) ? $param['file_ids'] : 0;
    
	if (!$uid) {
        $data = [
            'code' => '401',
            'msg' => '请登录后上传'
        ];
    }else if(!$convention_id){
        $data = [
            'code' => '401',
            'msg' => '数据丢失'
        ];
    }else if(!$file_ids){
        $data = [
            'code' => '401',
            'msg' => '上传失败'
        ];
    }else{
	    $data = HandleParamsForInsert('convention_download_info',$param);
	    $data['download_type'] = 3;
	    $data['creator_id'] = $uid;
	    $data['create_time'] = date("Y-m-d H:i:s", time());
	
	    $status = Db::table('convention_download_info')->insert($data);
	
	    if ($status) {
	        $data = [
	            'code' => '200',
	            'msg' => '上传成功'
	        ];
	    }else{
	        $data = [
	            'code' => '401',
	            'msg' => '上传失败'
	        ];
	    }
	}
    echo json_encode($data);exit;
  }
  //获取卓越之星信息
  public function ExcellentInfo(){
    $param = request()->param();
    $convention_id = isset($param['convention_id']) ? $param['convention_id'] : 0;
    $creator_id = isset($param['uid']) ? $param['uid'] : 0;

    $excellent_info = Db::table('convention_sign_excellent')
    ->where(['record_status'=>1,'convention_id'=>$convention_id,'creator_id'=>$creator_id])
    ->find();

    // echo Db::table("convention_sign_excellent")->getLastsql();die;

    $data = [
        'code' => '200',
        'msg' => '获取成功',
        'data' => $excellent_info
    ];
    echo json_encode($data);exit;
  }

  public function ExcellentUpload(){
    $params = request()->param();
    $uid = !empty($params['uid']) ? $params['uid'] : 0;
    $fid = !empty($params['fid']) ? $params['fid'] : 0;
    if($uid<0){

    }
    try {
        Db::startTrans();
        if ($fid>0 && $uid>0){
            //修改
            $params = HandleParamsForInsert('convention_sign_excellent',$params);
            $params['updater_id']=$uid;
            $where=["creator_id"=>$uid];
            $status = DB::table('convention_sign_excellent')->where('creator_id',$uid)->update($params);
            if ($status>0){
                $data = [
                    'code' => '200',
                    'msg' => '修改成功'
                ];
            }else{  
                $data = [
                    'code' => '431',
                    'msg' => '修改失败'
                ];
            }
        }else{
            //新增
            $params['creator_id']=$uid;
            $params['create_time']=date("Y-m-d H:i:s", time());
            $params = HandleParamsForInsert('convention_sign_excellent',$params);
            $status = DB::table('convention_sign_excellent')->insert($params);            
            if ($status>0){
                $data = [
                    'code' => '200',
                    'msg' => '新增成功'
                ];
            }else{  
                $data = [
                    'code' => '431',
                    'msg' => '新增失败'
                ];
            }
        }
        Db::commit();
    } catch (\Throwable $th) {
        $error_msg=$th->getMessage();
        $data = [
            'code' => '430',
            'msg' => '操作失败，'.$error_msg
        ];
        Db::rollback();
    }
    echo json_encode($data);exit;
  }


  	/**
	*获取卓越之星信息
	*/
	public function ExcellentPost(){
		$heard = request()->param();
		$convention_id =!empty($heard['convention_id'])?$heard['convention_id']:0;
        $uid =!empty($heard['uid'])?$heard['uid']:0;
        $type =!empty($heard['type'])?$heard['type']:0;
        $data = [];
        try {
            Db::startTrans();
            if($convention_id>0 && $uid>0){
                $list = Db::table('convention_sign_excellent')->where(['convention_id' =>$convention_id,'creator_id' =>$uid])->find();
                //加载数据 $type=0
                if(!empty($list) && $type==0) {
                    $data = [
                        'code' => '200',
                        'msg' => '获取成功',
                        'list'=>$list
                    ];
                }elseif($type>0){
                    $status=0;
                    $heard=HandleParamsForInsert('convention_sign_excellent',$heard);//var_dump($heard);die;

                    if($type==1){
                        //提交数据  $type=1
                        $heard['creator_id'] =$uid;
                        $heard['create_time'] = date("Y-m-d H:i:s", time());
                        $status = Db::table('convention_sign_excellent')->insertGetId($heard);
                    }elseif($type==2 && !empty($heard['fid'])){
                        //更新数据 $type=2
                        //var_dump($type);die;
                        $heard['update_time'] = date("Y-m-d H:i:s", time());
                        $status = Db::table('convention_sign_excellent')->where(["fid"=>$heard['fid']])->update($heard);
                    }
                    //echo Db::table("convention_sign_control")->getLastsql();die;
                    if($status){
                        $data = [
                            'code' => '200',
                            'msg' => '提交成功'
                        ];
                    }else{
                        $data = [
                            'code' => '410',
                            'msg' => '提交失败'
                        ];				
                    }
                }
            }else{
                $data = [
                    'code' => '413',
                    'msg' => '加载失败'
                ];
            } 
            Db::commit();
        } catch (\Throwable $th) {
            $error_msg=$th->getMessage();
            $data = [
                'code' => '430',
                'msg' => '操作失败，'.$error_msg
            ];
            Db::rollback();
        }

		$this->setRedisValue(json_encode($data),1000);
		echo json_encode($data);exit; 
	}
	
    /**
	*能建问卷签到
	*/
	public function Question_Sign(){
		$heard = request()->param();
		$heard = array_filter($heard);
		$open_id=!empty($heard['open_id'])?$heard['open_id']:0;
        $type=!empty($heard['type'])?$heard['type']:0;
		$where['open_id']=$open_id;
		$where['record_status']=1;
		$info = Db::table('convention_question_sign')->where($where)->find();
        try {
            //code...
            Db::startTrans();
            if ($type==1){
                if (empty($info)){
                    //新增
                    $heard=HandleParamsForInsert('convention_question_sign',$heard);
                    Db::table('convention_question_sign')->where(['fid'=>$info['fid']])->insert($heard);
                }else{
                    //修改
                    $heard=HandleParamsForInsert('convention_question_sign',$heard);
                    Db::table('convention_question_sign')->where(['fid'=>$info['fid']])->update($heard);
                }
                $data = [
                    'code'=>200,
                    'data'=>$info,
                    'msg'=>'保存成功'
                ];
            }else{
                //查询
                $data = [
                    'code'=>200,
                    'data'=>$info,
                    'msg'=>'获取成功'
                ];
            }
            Db::commit();
        } catch (\Throwable $th) {
            $error_msg=$th->getMessage();
            $data = [
                'code' => '430',
                'msg' => '操作失败，'.$error_msg
            ];
            Db::rollback();
        }
        
		echo json_encode($data);exit; 
	}
    /**
	*能建问卷签到
	*/
	public function Question_Detail(){
		$heard = request()->param();
		$heard = array_filter($heard);
		$open_id=!empty($heard['open_id'])?$heard['open_id']:0;
        $type=!empty($heard['type'])?$heard['type']:0;
		$where['open_id']=$open_id;
		$where['record_status']=1;
		$info = Db::table('convention_question_detail')->where($where)->find();
        
        try {
            //code...
            Db::startTrans();
            if ($type==1){
                if (empty($info)){
                    //新增
                    $heard=HandleParamsForInsert('convention_question_detail',$heard);
                    Db::table('convention_question_detail')->where(['fid'=>$info['fid']])->insert($heard);
                }else{
                    //修改
                    $heard=HandleParamsForInsert('convention_question_detail',$heard);
                    Db::table('convention_question_detail')->where(['fid'=>$info['fid']])->update($heard);
                }
                $data = [
                    'code'=>200,
                    'data'=>$info,
                    'msg'=>'保存成功'
                ];
            }else{
                //查询
                $data = [
                    'code'=>200,
                    'data'=>$info,
                    'msg'=>'获取成功'
                ];
            }
            Db::commit();
        } catch (\Throwable $th) {
            $error_msg=$th->getMessage();
            $data = [
                'code' => '430',
                'msg' => '操作失败，'.$error_msg
            ];
            Db::rollback();
        }
        
		echo json_encode($data);exit; 
	}
}   