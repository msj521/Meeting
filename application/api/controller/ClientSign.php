<?php
namespace app\api\controller;

use think\Db;
use think\Model;
use think\api\model\AppInfo;
use think\Request;
use app\api\common\Base;
use think\Cache;
use think\Debug;

class ClientSign extends Base {
    protected $app_key=123456;
    protected $app_secret= 'asdfghjklzxcvbnm';
    /**
     * @return string|void
     * 签名验证
     */
    public function CheckSign(){
	    $appid=123456;
		$appsecret= 'asdfghjklzxcvbnm';
    	$param=request()->param();//$this->getAllHeaders();//;
    	$param=array_filter($param);
		var_dump($param);
		ksort($param);
		$clientSign=isset($param['access_token'])?$param['access_token']:null;
    	if(empty($param)){
    		$result=[
    			"code" => "400",
    			"msg"  => "请求失败！参数丢失"	
    		];
    	}elseif(empty($clientSign)){
    		$result=[
    			"code" => "401",
    			"msg"  => "请求失败！access_token参数丢失"	
    		];
    	}else{

			/*$model=Model::find()->where("appid=:appid")->params([":appid"=>$serverArray['appid']])->one();
			 if($model){
			   $serverSecret=$model->appsecret;
			}*/

			unset($param['access_token']);
			unset($param['atool_timestamp']);
			#生成服务端str
			$str="";
			foreach ($param as $k => $v) {
			 $str .= $k.$v;
			}
			$reserverstr=$str.$appsecret;
			$reserverSign = strtoupper(md5($reserverstr));
			//echo($reserverstr);
			//echo($reserverSign);die;
			if($clientSign!=$reserverSign){
			    $result=[
	    			"code" => "402",
	    			"msg"  => "非法请求"	
	    		];
			}else{
				$result=[
	    			"code" => "200",
	    			"msg"  => "请求成功"	
	    		];
			}
		}
	    return json($result);    	
    }


	/**
	 * 获取app_key app_secret
	 */
	public function getkey(){
		Debug::remark('begin');
		$data=GetKey();
        Debug::remark('end');
		//生成接口请求日志记录
		log_service_runtime($data);
		return $data;
	}

}      