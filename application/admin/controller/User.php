<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Model;
use app\admin\common\Base;
use think\Exception;

class User extends Base {

    /**
     * @var \think\Request Request实例
     */
    protected $request;
    protected $table;
    protected $path;
    protected $return;

    protected function _initialize() {
        parent::_initialize();
        $this->path=$this->request->path();
		Admin_Login(fid);
        switch($this->path){
            /* 普通用户 */
            case "user/index";
            case "user/edit";
            case "user/update";
            case "user/delete";
                $this->table="enduser_info";
                $this->return="user/index";
                break;
            /* 管理员 */    
            case "user/role/index";
            case "user/role/edit";
            case "user/role/update";
            case "user/role/delete";
                $this->table="user_info";
                $this->return="user/role/index";
                break;
        }
    }

    /**
     * @return string|void
     * 用户管理 |用户列表,角色列表
     */
    public function Index() {
        $where = array();
        //parent::initIndex($request,$where);
        $data = array_filter($_GET);
        $name = "";
        /*搜索功能*/
        if (!empty($data)) {
            $name = isset($data['user_name']) ? $data['user_name'] : "";
            $like = array('like', "%" . $name . "%");
            $where['user_name|nick_name|tel|diy_org'] = $like;
        }

        $list = $this->sific_list($where,$this->table);

        $count = count($list);
        $this->assign("list", $list);
        $route=get_menu_title($this->path);
        /*分配首页相关路由*/
        switch($this->path){
            case "user/index";
                $this->assign("index","/user/index");
                $this->assign("edit", "/user/edit");
                $this->assign("update", "/user/update");
                $this->assign("del", "/user/delete");
                $this->assign("title",$route);
                break;
            case "user/role/index";
                $this->assign("index","/user/role/index");
                $this->assign("edit", "/user/role/edit");
                $this->assign("update", "/user/role/update");
                $this->assign("del", "/user/role/delete");
                $this->assign("title", $route);
                break;
        }

        return $this->fetch("user/index", ['cnt' => $count, 'user_name' => $name]);
    }

    /**
     * 用户管理 |用户列,角色编辑
     */
    public function UserEdit() {
        $fid = isset($_GET['fid']) && !empty($_GET['fid']) ? $_GET['fid'] : 0;
        //var_dump($this->table,$this->path);
        if ($fid > 0) {
            $user_info = Db::table($this->table)
                ->where("fid", $fid)
                ->find();
            if ($user_info) {
                $user_info['image_url'] =SourceInfo($user_info['web_image_id'],1);
            }else{
                $user_info = [];
            }
            $data = [
                'user_info'=>$user_info,
            ];
            $this->assign('data',$data);
        }
		
		//专家列表
        $expert_list=Db::table("base_expert_info")
        ->where(["record_status"=>1])
        ->field('fid,expert_name')
        ->select();
        $this->assign("expert_list", $expert_list);
		
        /*分配首页相关路由*/
        switch($this->path){
            case "user/edit";
                $this->assign("update", "/user/update");
                break;
            case "user/role/edit";
                $this->assign("update", "/user/role/update");
                break;
        }
        $job = classify(1);
        $edu = classify(2);
        $org = Db::table('base_org_conf')
            ->field("fid,org_name")
            ->select();
        $this->assign('job',$job);
        $this->assign('edu',$edu);
        $this->assign('org',$org);

        return $this->fetch("user/edit");
    }

    /**
     *  用户管理 |用户,角色更新
     */
    public function UserUpdate() {

        if ($this->request->isPost()) {
            $data = $this->request->param(true);
            $fid = isset($data['fid']) ? $data['fid'] : 0;

            if($fid==0){
                $tmp_user = Db::table($this->table)->where('tel',$data['tel'])->find();
                if (isset($tmp_user) && count($tmp_user)>0) {
                    $this->error($data['tel']."   手机号码已被注册");
                }
            }
            $data['web_image_id'] =isset($data['web_image_id'])?$data['web_image_id']:0;;
            $password = isset($data['password']) ? $data['password'] : "";
            if (strlen($password)<=16 && !isset($data['prohibit_status'])) {
                $data['password'] = md5($password);
            }

            $status = $this->sific_update($data,$this->table);
            /* 直播即时通讯禁言 */
            if(isset($data['prohibit_status']) && $status){
                return 1;
            }
            if ($status) {
                echo "<script>var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);parent.location.href='/$this->return';</script>";
                exit;
            } else {
                $this->error("表单提交失败~~存储失败");
            }
        } else {
            $this->error("表单提交失败~~请求数据不存在");
        }
    }

    /**
     * 用户管理 |用户,角色删除，批量删除
     */
    public function UserDelete() {
        $data = $this->request->param(true);
        $status = $this->sific_delete($data,$this->table);
        return $status;
    }
}
