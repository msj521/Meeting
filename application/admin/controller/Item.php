<?php
namespace app\admin\Controller;

use app\admin\common\Base;
use think\Db;
use think\Model;

class Item extends Base {

    /**
     * @var \think\Request Request实例
     */
    protected $request;
    protected $table;
    protected $path;
    protected $return;
    protected $edit;
    protected $index;
    protected $title;

    protected function _initialize() {
        parent::_initialize();
        $this->path=$this->request->path();
		Admin_Login(fid);
        $this->title=get_menu_title($this->path);
        $this->assign("title", $this->title);
        switch($this->path){
            /* 基础资料 */
            case "sys/item";
            case "sys/item/edit";
            case "sys/item/update";
            case "sys/item/delete";
                $this->table="base_class_conf";
                $this->return="/sys/item";
                $this->edit="item/edit";
                $this->index="item/index";
                break;
           /* 医院 */
            case "sys/hospital";
            case "sys/hospital/edit";
            case "sys/hospital/update";
            case "sys/hospital/delete";
                $this->table="base_org_conf";
                $this->return="/sys/hospital";
                $this->edit="hospital/edit";
                $this->index="hospital/index";
                break;
           /* 企业*/
            case "sys/org";
            case "sys/org/edit";
            case "sys/org/update";
            case "sys/org/delete";
                $this->table="base_org_conf";
                $this->return="/sys/org";
                $this->edit="org/edit";
                $this->index="org/index";
                break;
           /* 合作伙伴 */
            case "sys/partner";
            case "sys/partner/edit";
            case "sys/partner/update";
            case "sys/partner/delete";
                $this->table="base_partner_conf";
                $this->return="/sys/partner";
                $this->edit="partner/edit";
                $this->index="partner/index";
                break;
           /* 资源列表 */
            case "sys/source";
            case "sys/source/edit";
            case "sys/source/update";
            case "sys/source/delete";
                $this->table="base_source_info";
                $this->return="/sys/source";
                $this->edit="source/edit";
                $this->index="source/index";
                break;
            /* 登录日志 */    
            case "sys/log_login";
            case "sys/log_login/delete";
                $this->table="v_log_login";
                $this->index="log/log_login";
                break;
            /* app ui交互日志 */    
            case "sys/log_app";
            case "sys/log_app/delete";
                $this->table="v_log_app_ux";
                $this->index="log/log_app";
                break;
            /* API运行日志 */    
            case "sys/log_api";
            case "sys/log_api/delete";
                $this->table="v_log_api_call";
                $this->index="log/log_api";
                break;
            /* 系统运行日志 */    
            case "sys/log_service";
            case "sys/log_service/delete";
                $this->table="log_service_runtime";
                $this->index="log/log_service";

                break;
            /* 智能终端IMEI */    
            case "sys/log_terminal";
            case "sys/log_terminal/delete";
                $this->table="v_log_terminal_info";
                $this->index="log/log_terminal";
                break;
            /* 平台声明 */
            case "sys/explain";
            case "sys/explain/edit";
            case "sys/explain/update";
            case "sys/explain/delete";
                $this->table="base_explain_info";
                $this->return="/sys/explain";
                $this->edit="explain/edit";
                $this->index="explain/index";
                break;    
        }
    }
   

    /**
     * @return string|void
     * 系统管理 | 基础资料列表
     */
    public function Index() {
        //parent::initIndex($request);
        $where = array();
        $string = '';
        $class_type= "";
        $data = array_filter($_GET);
        $status ="";
        $app_type_id ="";
        $source_type_id ="";
        if (!empty($data)) {
            $string = isset($data['string']) ? $data['string'] : "";
            $status = isset($data['status']) ? $data['status'] : "";
            $app_type_id = isset($data['app_type_id']) ? $data['app_type_id'] : "";
            $class_type = isset($data['class_type']) ? $data['class_type'] : "";
            $source_type_id = isset($data['source_type_id']) ? $data['source_type_id'] : "";
            if ($class_type) {
                $where["class_type"] = $class_type;
            }

            if ($app_type_id) {
                $where["app_type"] = $app_type_id;
            }

            if ($source_type_id) {
                $where["source_type"] = $source_type_id;
            }

            if ($status) {
                $where["status"] = $status;
            }

            if ($string) {
                $like = array('like', "%" . $string . "%");
                switch($this->path){
                    case "sys/item";
                        $where["class_name_zh|remark|fid"] = $like;
                        break;
                    case "sys/source";
                        $where["file_path|file_size|fid"] = $like;
                        break;
                    case "sys/org";
                    case "sys/hospital";
                    case "sys/partner";
                        $where["org_name|tel|description|fax|address|web_url|fid"] = $like;
                        break;
                    case "sys/log_login";
                        $where["user_name|imei|region_name|fid"] = $like;
                        break;
                    case "sys/log_app";
                        $where["user_name|ip|imei|fid"] = $like;
                        break;
                    case "sys/log_api";
                        $where["user_name|ip|imei|fid"] = $like;
                        break;
                    case "sys/log_terminal";
                        $where["imei|model|user_name|fid"] = $like;
                        break;
                }
            }
        }

        if ($this->path=="sys/hospital") {
            $where["type"] = 1;
        }else if($this->path=="sys/org"){
            $where["type"] = 2;
        }

        $list = $this->sific_list($where,$this->table);
        $count = count($list);

        /*基础分类*/
        $Class =get_class_type(0);
        $this->assign("class", $Class);

        /*应用端类型*/
        $app_type =app_type(-1);
        $this->assign("app_type", $app_type);
        $this->assign("app_type_id", $app_type_id);

        /*是否被锁定*/
        $is_no=[1=>"否",2=>"是"];
        $this->assign("is_no", $is_no);
        $this->assign("status", $status);

        
        /*图片及资源表*/
        $source_type=source_type(-1);
        $this->assign("source_type", $source_type);
        $this->assign("source_type_id", $source_type_id);

        $this->assign("list", $list);
        $this->assign("class_type", $class_type);
        //var_dump($data);
        return $this->fetch("$this->index", ['cnt' => $count, 'string' => $string]);
    }

    /**
     * 获取省市区资料
     */
    public function GetRegion(){
        $param = $this->request->param(true);
        $pid = isset($param['pid']) ? $param['pid'] : 0;

        $region = Db::table('base_region_conf')->where(['record_status'=>1,'pid'=>$pid])->select();

        $data = [
            'code'=>'200',
            'msg'=>'获取成功',
            'region'=>$region
        ];
        echo json_encode($data); exit;
    }
    
    /**
     * 系统管理 | 基础资料编辑
     */
    public function Edit() {
        $list = $this->sific_edit($this->table);
        if($list && (isset($list['web_image_id']) || isset($list['licence_id']))){
            $list['image_url'] =SourceInfo($list['web_image_id'],1);
            $list['image_urls'] =SourceInfo($list['licence_id'],1);
        }
        $this->assign("list", $list);
        /*基础分类*/
        $class_type =get_class_type(0);

        $this->assign("class_type",$class_type);
        /*分类*/
        $province_list = Db::table('base_region_conf')->where(['record_status'=>1,'level'=>1])->select();
        $city_list = Db::table('base_region_conf')->where(['record_status'=>1,'level'=>2])->select();
        $country_list = Db::table('base_region_conf')->where(['record_status'=>1,'level'=>3])->select();
        $this->assign("province_list", $province_list);
        $this->assign("city_list", $city_list);
        $this->assign("country_list", $country_list);
        /*图片及资源表*/
        $source_type=source_type(-1);
        $this->assign("source_type", $source_type);


        /* 平台声明 */
        $param = $this->request->param(true);
        switch($param){
            case isset($param['A']) && empty($param['A']);
            case isset($param['B']) && empty($param['B']);
            case isset($param['C']) && empty($param['C']);
            case isset($param['D']) && empty($param['D']);
            case isset($param['E']) && empty($param['E']);
            case isset($param['F']) && empty($param['F']);
                $theme="";
                $filed="";
                if(isset($param['A'])){
                    $theme="关于我们";
                    $filed="about_us";   
                }elseif(isset($param['B'])){
                    $theme="版权声明";
                    $filed="statement";   
                }elseif(isset($param['C'])){
                    $theme="免责声明";
                    $filed="disclaimer";   
                }elseif(isset($param['D'])){
                    $theme="举报投诉";
                    $filed="report_complaints";   
                }elseif(isset($param['E'])){
                    $theme="意见建议";
                    $filed="opinion";   
                }elseif(isset($param['F'])){
                    $theme="联系我们";
                    $filed="contact_us";   
                }

                $this->assign("field", $filed);
                $this->assign("result", $list[$filed]);     
                break;
        }

        return $this->fetch("$this->edit");
    }

    /**
     * 系统管理 | 基础资料更新
     */
    public function Update() {
        if ($this->request->isPost()) {
            $data = $this->request->param(true);
            if((isset($data['web_image_id']) && empty($data['web_image_id'])) 
            ||(isset($data['app_image_id']) && empty($data['app_image_id'])) ){
                $data['web_image_id']=0;
                $data['app_image_id']=0;
            }

            if(isset($data['web_url']) && !empty($data['web_url'])){
                if (!preg_match('/(http:\/\/)|(https:\/\/)/i', $data['web_url'])) {
                    $data['web_url']="http://".$data['web_url'];
                }
            }
			//var_dump($data,$this->table);die;
            $status = $this->sific_update($data,$this->table);
            if ($status) {
                echo "<script>var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);parent.window.location.href='$this->return';</script>";
                exit;
            } else {
                $this->error("表单提交失败~~1");
            }
        } else {
            $this->error("表单提交失败~~2");
        }
    }

    /**
     * 系统管理 | 基础资料删除
     */
    public function Delete() {
        $table=$this->table=="v_log_terminal_info"?"log_terminal_info":$this->table;
        $data = $this->request->param(true);
        $status = $this->sific_delete($data,$this->table);
        return $status;
    }

}
