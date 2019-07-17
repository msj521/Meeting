<?php
namespace app\web\controller;

use app\admin\common\Base;
use think\Db;
use think\Model;
use think\Request;

class Authorization extends Base {

    /**
     * @var \think\Request Request实例
     */
     protected function _initialize() {
        parent::_initialize();
       
    }   
    /**
     * @return string|void
     * 
     */
    public function Sign() {
        $params = request()->param();
        return $this->fetch("meeting/sign_index");
    }
    public function SignWechat() {
        $params = request()->param();
        return $this->fetch("meeting/sign_wechat");
    }
    public function WeChat() {
        $params = request()->param();
        $code = !empty($params['code'])?$params['code']:"";
        $appid="wx52a019041e2dda35";
        $secret="ebdab822f546d25cb4fb911c0d9f4c27";
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$secret."&code=".$code."&grant_type=authorization_code"; 
        //echo $url;die;
        $response = file_get_contents($url);
        $responseArray = json_decode($response,true);
        $access_token = !empty($responseArray['access_token'])?$responseArray['access_token']:"";
        $openid = !empty($responseArray['openid'])?$responseArray['openid']:"";
        //var_dump($responseArray);
        $url_user = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
        
        $response_user = file_get_contents($url_user);
        $user_info = json_decode($response_user);
        $this->assign("userinfo", $user_info);
        return $this->fetch("index/training_sigin");

        //参考 https://www.cnblogs.com/jinxiaohang/p/7193505.html
        /*
            openid  用户的唯一标识
            nickname    用户昵称
            sex 用户的性别，值为1时是男性，值为2时是女性，值为0时是未知
            province    用户个人资料填写的省份
            city    普通用户个人资料填写的城市
            country 国家，如中国为CN
            headimgurl  用户头像，最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640*640正方形头像），用户没有头像时该项为空
            privilege   用户特权信息，json 数组，如微信沃卡用户为（chinaunicom）
        */
    }

    public function gatherTnvoiceWechat() {
        $params = request()->param();
        $code =!empty($params['code'])?$params['code']:"";
        $appid="wx52a019041e2dda35";
        $secret="ebdab822f546d25cb4fb911c0d9f4c27";
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$secret."&code=".$code."&grant_type=authorization_code"; 
        //echo $url;die;
        $response = file_get_contents($url);
        $responseArray = json_decode($response,true);
        $access_token = !empty($responseArray['access_token'])?$responseArray['access_token']:"";
        $openid = !empty($responseArray['openid'])?$responseArray['openid']:"";
        //var_dump($responseArray);
        $url_user = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
        
        $response_user = file_get_contents($url_user);
        $user_info = json_decode($response_user);
        $this->assign("userinfo", $user_info);
        return $this->fetch("index/gather_tnvoice");
    }

    public function QuestionSign() {
        $params = request()->param();
        return $this->fetch("other/sign_wechat");
    }
    public function QuestionWeChat() {
        $params = request()->param();
        $code = !empty($params['code'])?$params['code']:"";
        $appid="wx52a019041e2dda35";
        $secret="ebdab822f546d25cb4fb911c0d9f4c27";
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$secret."&code=".$code."&grant_type=authorization_code"; 
        //echo $url;die;
        $response = file_get_contents($url);
        $responseArray = json_decode($response,true);
        $access_token = !empty($responseArray['access_token'])?$responseArray['access_token']:"";
        $openid = !empty($responseArray['openid'])?$responseArray['openid']:"";
        //var_dump($responseArray);
        $url_user = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
        
        $response_user = file_get_contents($url_user);
        $user_info = json_decode($response_user);
        $this->assign("userinfo", $user_info);
        return $this->fetch("other/SignIn");
    }

    public function QuestionDetail() {
        $params = request()->param();
        return $this->fetch("other/detail_wechat");
    }
    public function QuestionDetailWeChat() {
        $params = request()->param();
        $code = !empty($params['code'])?$params['code']:"";
        $appid="wx52a019041e2dda35";
        $secret="ebdab822f546d25cb4fb911c0d9f4c27";
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$secret."&code=".$code."&grant_type=authorization_code"; 
        //echo $url;die;
        $response = file_get_contents($url);
        $responseArray = json_decode($response,true);
        $access_token = !empty($responseArray['access_token'])?$responseArray['access_token']:"";
        $openid = !empty($responseArray['openid'])?$responseArray['openid']:"";
        //var_dump($responseArray);
        $url_user = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
        
        $response_user = file_get_contents($url_user);
        $user_info = json_decode($response_user);
        $this->assign("userinfo", $user_info);
        return $this->fetch("other/feedBack");
    }
}
