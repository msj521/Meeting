<?php
namespace app\admin\Controller;

use app\admin\common\Base;
use think\Db;
use think\Model;
use app\admin\model\UserInfo;
use think\Session;

class Index extends Base {
    /**
     * @return string|void
     * 首页
     */
    public function Index() {
        //判断是否登录
        $this->Is_Login(); 

        //parent::initIndex($request);
        //var_dump(self::pdf());die;
        $data = array_filter($_GET);
        $fid = isset($data['fid']) ? $data['fid'] : 1001;

        if ($fid>0) {
            $menu_list = menu_for_user(0,["app_type"=>1,'record_status'=>1],$fid);
            $this->assign("menu", $menu_list);
        }

        /*头部父级菜单*/
        $parent=Db::table('base_menu_info')
            ->where(["app_type"=>1,'pid'=>0,'record_status'=>1])
			->wherein('fid','1001,1005,1006,1007')
            ->field('fid,menu_name,route')
            ->order("sort","asc")
            ->select();
        $this->assign("parent", $parent);

        $menu_index =Db::table('base_menu_info')
            ->where(["app_type"=>1,'pid'=>$fid,'sort'=>1,'record_status'=>1])
            ->field('route')
            ->find();
        $this->assign("menu_index", $menu_index);

        /*获取请求标题*/
        $this->assign("title", find_menu_title($fid));
        return $this->fetch("index/index");
    }

    /**
     * @return string|void
     * 基础数据 | 参厂商
     */
    public function welcome() {
        return $this->fetch("index/welcome");
    }
    /**
     * @return string|void
     * 登录
     */
    public function login() {

        if($this->request->isPost()){
            //不允许重复登录 
            $this->already_Login();
            //获取表单信息
            $data=$this->request->param();
            $data=array_filter($data);
            $tel=$data['tel'];
            $password=md5($data['password']);
            $where=['tel'=>$tel,"record_status"=>1];
            $admin=UserInfo::get($where);

            //判断用户角色  不允许普通用户登录
            // if(!empty($admin)){
            //     $wheres=['FUserID'=>$admin->FID,"FRoleGroupID"=>1000];
            //     $UserRole=TSysUserRoleGroup::get($wheres);
            // }
            //判断用户名 密码是否正确
            if(is_null($admin)){
                $status=["code"=>0,"msg"=>"用户不存在~~"];
            }elseif($admin->password!=$password){
                $status=["code"=>0,"msg"=>"密码错误~~"];
            }else{
                //用户名密码验证通过
                $status=["code"=>1,"msg"=>"登录成功"];
                //更新登录时间
                $time=date("Y-m-d H:i:s",time());
                $admin->isUpdate(true)->save(["update_time"=>"$time"]);

                //var_dump($admin->FID);die;
                //将登录信息保存到session
                Session::set("tel",$tel);
                Session::set("user_name",$admin->user_name);
                Session::set("fid",$admin->fid);
            }
            $ss=$status;
            $ss['tel']=$data['tel'];
            //操作日志
            RequestLog("用户登录",$ss);
            return $status;
        }
        return $this->fetch("index/logins");
    }

    /**
     * @return string|void
     * 退出登陆
     */
    public function login_out() {
        session::clear();
        $this->success('退出成功','/logins');
    }


    public function module($meun){
        $content = '<div class="left-nav">
                        <div id="side-nav">
                            <ul id="nav">';

        $this->insertNode($meun,$content,true);                               

        $content = $content.'</ul>
                        </div>
                    </div>';
        return $content;
    }

    public function insertNode($meun,&$content,$first){
        foreach ($meun as $key => $value) {
            $FName = $value['menu_name'];
            $FController = $value['route'];
            $FChildren = $value['FChildren'];
            $FIconCls = $value['icon_cls'];
            if (count($FController)<1) {
                $FController = 'javascript:;';
            }
            if (count($FIconCls)<1) {
                $FIconCls = '&#xe6b8;';
            }
            if ($first) {
                $content = $content.'<li>
                                        <a href="'.$FController.'">
                                            <i class="iconfont">'.$FIconCls.'</i>
                                            <cite>'.$FName.'</cite>
                                            <i class="iconfont nav_right">&#xe697;</i>
                                        </a>';
            }else {
                $content = $content.'<li>
                                        <a _href="'.$FController.'">
                                            <i class="iconfont">&#xe723;</i>
                                            <cite>'.$FName.'</cite>
                                        </a>';
            }
            if (!empty($FChildren)) {
                $content = $content.'   <ul class="sub-menu">';
                $this->insertNode($FChildren,$content,false);
                $content = $content.'   </ul>';
            }
            $content = $content.'   </li>';
        }
    }

}