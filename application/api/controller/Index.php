<?php
namespace app\api\controller;

use think\Db;
use think\Request;
use app\api\common\Base;

class Index extends Base {

    /**
     * 首页
     */
    public function FirstPage(){

        $params=request()->param();
        //轮播
        $banner = Db::table('v_ad_banner')
            ->where(["record_status"=>1])
            ->order(['sort'=>'asc','fid'=>'desc'])
            ->select();
            
        if ($params['devicetype'] != 'web'){
            //会议
            $convention = Db::table('v_convention')
            ->where(["record_status"=>1])
            ->order(['sort'=>'desc','fid'=>'desc'])
            ->limit(0,4)
            ->select();

            //直播
            $live = Db::table('v_live')
            ->where(["record_status"=>1])
            ->order(['recommend'=>'desc','sort'=>'desc','fid'=>'desc'])
            ->limit(0,4)
            ->select();
            
            //培训
            $product = Db::table('v_product')
            ->where(["record_status"=>1,'product_type'=>2])
            ->order(['recommend'=>'desc','sort'=>'desc','fid'=>'desc'])
            ->limit(0,4)
            ->select();      
			
            //合作伙伴
            $partner = [];

            $app_type = 0;
            if ($params['devicetype'] == 'andriod'){
                $app_type = 1;
            }else if ($params['devicetype'] == 'ios'){
                $app_type = 2;
            }else if ($params['devicetype'] == 'web'){
                $app_type = 3;
            }
            //所有版本中的最新版本        
            $version_list =Db::table("v_version_info")
            ->where(['record_Status'=>1,'app_postfix'=>$app_type])
            ->order('version_no desc')->limit(1)->select();
            $version_list =Db::table("v_version_info")->where(['record_Status'=>1])->order('version_no desc')->limit(1)->select();
            $version_info = count($version_list)>0 ? $version_list[0]['version_no'] : 0;
        }else{
            //会议
            $convention = Db::table('v_convention')
            ->where(["record_status"=>1])
            ->order(['sort'=>'desc','fid'=>'desc'])
            ->limit(0,11)
            ->select();
            //直播
            $live = Db::table('v_live')
            ->where(["record_status"=>1])
            ->order(['recommend'=>'desc','sort'=>'desc','fid'=>'desc'])
            ->limit(0,6)
            ->select();
            //培训
            $product = Db::table('v_product')
            ->where(["record_status"=>1,'product_type'=>2])
            ->order(['recommend'=>'desc','sort'=>'desc','fid'=>'desc'])
            ->limit(0,6)
            ->select();
            //合作伙伴
            $partner = Db::table('v_partner')
            ->where(["record_status"=>1])
            ->order(['fid'=>'desc'])
            ->limit(0,12)
            ->select();
			//版本号
			$version_info=[];
        }

        if (count($banner)>0 || count($convention)>0 || count($live)>0 || count($product)>0) {
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                'data' => [
                    'banner_list' => $banner,
                    'convention_list' => $convention,
                    'live_list' => $live,
                    'video_list' => $product,
                    'partner_list' => $partner,
                    'version_no' => $version_info
                ]
            ];
        }else{
            $data = [
                'code' => '414',
                'msg' => '数据不存在',
            ];
        }
       $this->setRedisValue(json_encode($data),10);
       echo json_encode($data);exit;
    }

    public function Search(){
        $params=request()->param();
        $key = isset($params['keyword']) ? $params['keyword'] : '';
        $module = isset($params['module']) ? $params['module'] : 1;
        $class_id = isset($params['class_id']) ? $params['class_id'] : 0;

        $page =isset($params['page'])?$params['page']:1;
        $pagesize =isset($params['pagesize'])?$params['pagesize']:40;
        if ($module==1) {
            # 直播
            if ($class_id>0) {
                $result = Db::table("v_live")
                ->where(["class_id"=>$class_id,"record_status"=>1])
                ->where('title','like',"%$key%")
                ->limit(($page-1)*$pagesize,$pagesize)
                ->select();
                $total = Db::table("v_live")
                ->where(["class_id"=>$class_id,"record_status"=>1])
                ->where('title','like',"%$key%")
                ->count();
            }else{
                $result = Db::table("v_live")
                ->where(["record_status"=>1])
                ->where('title','like',"%$key%")
                ->limit(($page-1)*$pagesize,$pagesize)
                ->select();
                $total = Db::table("v_live")
                ->where(["record_status"=>1])
                ->where('title','like',"%$key%")
                ->count();
            }
        }else if ($module==2){
            # 会议
            if ($class_id>0) {
                $result = Db::table("v_convention")
                ->where(["class_id"=>$class_id,"record_status"=>1])
                ->where('convention_name','like',"%$key%")
                ->limit(($page-1)*$pagesize,$pagesize)
                ->select();
                $total = Db::table("v_convention")
                ->where(["class_id"=>$class_id,"record_status"=>1])
                ->where('convention_name','like',"%$key%")
                ->count();
            }else{
                $result = Db::table("v_convention")
                ->where(["record_status"=>1])
                ->where('convention_name','like',"%$key%")
                ->limit(($page-1)*$pagesize,$pagesize)
                ->select();
                $total = Db::table("v_convention")
                ->where(["record_status"=>1])
                ->where('convention_name','like',"%$key%")
                ->count();
            }
        }else if ($module==3){
            # 培训
            if ($class_id>0) {
                $result = Db::table("v_product")
                ->where(["product_type"=>2,"class_id"=>$class_id,"record_status"=>1])
                ->where('product_name','like',"%$key%")
                ->limit(($page-1)*$pagesize,$pagesize)
                ->select();
                $total = Db::table("v_product")
                ->where(["product_type"=>2,"class_id"=>$class_id,"record_status"=>1])
                ->where('product_name','like',"%$key%")
                ->count();
            }else{
                $result = Db::table("v_product")
                ->where(["product_type"=>2,"record_status"=>1])
                ->where('product_name','like',"%$key%")
                ->limit(($page-1)*$pagesize,$pagesize)
                ->select();
                $total = Db::table("v_product")
                ->where(["product_type"=>2,"record_status"=>1])
                ->where('product_name','like',"%$key%")
                ->count();
            }

        }
        $convention_class = classify(7); //会议
       
        $live_class = classify(5); //直播

        $training_class = classify(6); //培训

        $data = [
            'code' => '200',
            'msg' => '获取成功',
            'data' => [
                'class_info' => [
                    'live_class' => $live_class,
                    'convention_class' => $convention_class,
                    'training_class' => $training_class
                ],
                'data_list' => $result,
                'total' => $total
            ]
        ];
        $this->setRedisValue(json_encode($data),100);
       echo json_encode($data);exit;
    }

    public function Adsense(){
        $params=request()->param();
        $module = isset($params['type']) ? $params['type'] : 0;
        $ad = Db::table('v_ad_adsense')
            ->where(['record_status'=>1,'module'=>$module])
            ->select();
        if (count($ad)>0) {
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                'data' => [
                    'ad_list' => $ad
                ]
            ];
        }else{
            $data = [
                'code' => '414',
                'msg' => '数据不存在',
            ];
        }
        $this->setRedisValue(json_encode($data),10);
        echo json_encode($data);exit;
    }
    //年会App启动页的广告
    public function StartAd(){
        $params=request()->param();
        $uid = isset($params['uid']) ? $params['uid'] : 0;

        $data = [
            'code'=>'200',
            'msg'=>'获取成功',
            'data'=>[
                'images'=>[
                    0=>'http://2019.sific.com.cn/uploads/20190516/865d65deaf75f6b46bbe0611ae02cde0.jpg'
                ],
                'duration'=>5
            ]
        ];
        echo json_encode($data);exit;
    }
}      