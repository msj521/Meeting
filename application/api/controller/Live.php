<?php
namespace app\api\controller;

use think\Db;
use think\Request;
use app\api\common\Base;

class Live extends Base {

    /**
     * 分类标签
     */
     public function LiveClassList(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $class_list = classify(5);
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
     * 直播列表
     */
    public function LiveList(){
        $params = request()->param();
        $class_id =isset($params['class_id'])?$params['class_id']:0;
        $page =isset($params['page'])?$params['page']:1;
        $pagesize =isset($params['pagesize'])?$params['pagesize']:40;

        $where=["record_status"=>1];

        if ($class_id>0) {
            $where=["class_id"=>$class_id];
        }

        $result = Db::table("v_live")
                ->where($where)
                ->order(['recommend'=>'desc','sort'=>'desc','fid'=>'desc'])
                ->limit(($page-1)*$pagesize,$pagesize)
                ->select();
        $total = Db::table("v_live")
                ->where($where)
                ->count();

        $class_list = classify(5);

        $data = [
            'code' => '200',
            'msg' => '获取成功',
            'data' => [
                'class_list' => $class_list,
                'live_list' => $result,
                'total' => $total
            ]
        ];

       echo json_encode($data);exit;
    }
    
    /**
     * 直播详情
     */
    public function LiveDetail(){
        $params = request()->param();
        $live_id =isset($params['live_id'])?$params['live_id']:0;
        $uid =isset($params['uid'])?$params['uid']:0;
        //直播产品包->直播包详情->直播性情
        $live_info = Db::table("v_live")->where(["fid"=>$live_id,"record_status"=>1])->find();
        if (!empty($live_info)) {

            /* 直播专家列表 */
            $live_expert = Db::table('v_live_expert')
            ->where(['live_id'=>$live_id,"record_status"=>1])
            ->order(['sort'=>'desc','fid'=>'desc'])
            ->select();

            /* 获取拉流地址 */
            $live_url=$this->LiveUrl();
            /* 更新浏览量 */
            Db::table('live_info')->where('fid',$live_info['fid'])->update(['play_count'=>$live_info['play_count']+1]);
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                'data' => [
                    'live_info' => $live_info,
                    'expert_list' => $live_expert,
                    'live_url' =>$live_url,
                ]
            ];
        }else{
            $data = [
                'code' => '414',
                'msg' => '数据不存在',
            ];
        }
       echo json_encode($data);exit;
    }
        
    /**
     * 专家详情
     */
    public function ExpertDetail(){
        $params = request()->param();
        $expert_id =isset($params['expert_id'])?$params['expert_id']:0;

        $expert = Db::table('v_expert')
        ->where(['fid'=>$expert_id,"record_status"=>1])
        ->find();
        $data = [
            'code' => '200',
            'msg' => '获取成功',
            'data' => $expert
        ];

       echo json_encode($data);exit;
    }

    /**
     * 直播通讯
     */
    public function Chat(){
        $params = request()->param();
        $user_id =isset($params['uid'])?$params['uid']:0;
        $live_id =isset($params['live_id'])?$params['live_id']:0;
        $content =isset($params['content'])?$params['content']:'';
        // Cmq($content);die;
        if (strlen($content)>0) {
            //鉴黄start
            $content =CheckContent($content);
            //鉴黄end
            $content_data = [
                'live_id' => $live_id,
                'message' => $content,
                'creator_id' => $user_id,
                'create_time' => date("Y-m-d H:i:s",time())
            ];
            /* 用户禁言 */
            $user_status = Db::table("enduser_info")->where(["fid"=>$user_id,"prohibit_status"=>2])->count();
            if($user_status==1){
                $data = [
                    'code' => '410',
                    'msg' => '您已被禁言！',
                ];
                echo json_encode($data);exit; 
            }else{
                Db::table('live_chat')->insert($content_data);
            }  
        }
		
        $chat_list = Db::table('v_live_chat')
        ->where(["live_id"=>$live_id,"record_status"=>1])
        ->order(['fid'=>'desc'])
        ->select(); 
        
        //设置刷新时间默认10  一分钟内有超过20条评论 刷新时间设为5 
        $time_space = 10000;

        $live_info = Db::table('live_info')->where(['record_status'=>1,'fid'=>$live_id])->find();
        $time_space = $live_info["refresh_time"];

        $data = [
            'code' => '200',
            'msg' => '获取成功',
            'data' => [
                'chat_list' => $chat_list,
                'time_space' => $time_space
            ]
        ];

       echo json_encode($data);exit;
    }


    /**
     * 拉流地址
     */
    public function LiveUrl(){
        $params = request()->param();
        $user_id =isset($params['uid'])?$params['uid']:0;
        $live_id =isset($params['live_id'])?$params['live_id']:0;

        //判断是否有权限播放      
        $results = Db::query("call p_play_authority($user_id,$live_id,1)");
        $result =$results[0][0]['result'];
        if ($result==0) {
            $data = [
                'code' => '410',
                'msg' => '无权播放',
            ];
            return $data;
        }

        $play_url_list = Db::table("live_url_info")
        ->where(["live_id"=>$live_id,"record_status"=>1])
        ->field('fid,rtmp_url,hls_url,flash_url')
        ->find();

        if (!empty($play_url_list)) {
            $play_url_list['rtmp_url'] = base64_encode($play_url_list['rtmp_url']);
            $play_url_list['hls_url'] = base64_encode($play_url_list['hls_url']);
            $play_url_list['flash_url'] = base64_encode($play_url_list['flash_url']);
            $play_url_list['live_status'] = live_status("DescribeLiveStreamState",$live_id);
        }

        $data = [
            'code' => '200',
            'msg' => '获取成功',
            'data' => [
                'play_url' => $play_url_list
            ]
        ];
       return $data;
    }
	
	/**
	 * @param 录播签名
	 * @param fileid 腾讯云文件ID
	 */ 
	function Video_Sign(){
		$params = request()->param();
        $fileid =isset($params['fileid'])?$params['fileid']:0;
		$signature=0;
		/* 上传视屏至腾讯云 判断是否已经上传 如果上传删除后再上传 */
		if($fileid>0){
			$signature=video_edit($fileid."&priority=0",'DeleteVodFile');
		}else{
			// 确定 App 的云 API 密钥
			$secret_id = "AKIDQOK4QeTqhXH9mCvqzwwJhtdebaVhlPtr";
			$secret_key = "gFh1AxBNO0xJctzteFfuxpTvBHCyYwEJ";
			// 确定签名的当前时间和失效时间
			$current = time();
			$expired = $current + 86400;  // 签名有效期：1天

			// 向参数列表填入参数
			$arg_list = array(
				"secretId" => $secret_id,
				"currentTimeStamp" => $current,
				"expireTime" => $expired,
				"random" => rand());

			// 计算签名
			$orignal = http_build_query($arg_list);
			$signature = base64_encode(hash_hmac('SHA1', $orignal, $secret_key, true).$orignal);
		}
		return $signature;
	}
}     