<?php
namespace app\admin\common;

use app\admin\model\TNews;
use app\admin\model\TUser;
use think\Controller;
use think\Db;
use think\Log;
use think\Session;

class Base extends Controller {
    protected $menu = [];
    protected $FUserID = 0;
    protected function _initialize() {
        parent::_initialize();
        $this->path=$this->request->path();
        $FUserID = Session::get('fid');
        if (empty($this->menu)) {
          $this->menu = menu_for_user($FUserID);
        }
        $URL=request()->domain();
        define("URL", $URL);
        define("fid", $FUserID);
        define("user_name", Session::get('user_name'));
        define("tel", Session::get('tel'));
        $dir=ROOT_PATH. 'public' . DS . 'request_logs';
    }

    /**
    *判断用户是否登录 在后台入口调用
    */
    protected  function Is_Login(){
      //如果登录常量为空，表示没有登录
      if(is_null(fid)){
        $this->redirect("/logins");
      }
    }

    /**
    *判断用户如果已经登录  不允许再次登录
    */
    protected  function already_Login() {
      //如果登录常量为空，表示没有登录
      if(!is_null(fid)  && $_POST['tel']==tel){
        $this->error("请不要重复登录~~","/");
      }
    }

    //找到路由对应的menuID
    public function find_menu_id($menu,$controller){
      if (count($menu)>0) {
        foreach ($menu as $key => $value) {
          if (strtoupper($value['route'])==strtoupper($controller)) {
            return $value['fid'];
          }else{
            $children = $value['children'];
            $flag = $this->find_menu_id($children,$controller);
            if (isset($flag) && $flag>0) {
              return $flag;
            }
          }
        }
      }
    }



    /**
     * @param $where
     * @param $table
     * @return array 公共数据列表
     */
    public function sific_list($where,$table) {
        $data = array();
		
        if ($table) {
            try {
                $data = Db::table("$table")
                    ->where($where)
                    ->order('fid', "desc")
                    ->paginate(10, false, ['query' => request()->param()]);
                //echo Db::table($table)->getLastSql();EXIT;
            } catch (\Exception $e) {
                echo $e->getMessage();
                Log::error(logs($e));
            }
        }
        //操作日志
        //RequestLog("$this->path",$data);
        return $data;
    }

    /**
     * @param $param
     * @param $table
     * @return array  基础数据编辑 详情页
     */
    public function sific_edit($table) {
        $param = $this->request->param(true);
        $data = array();
        if ($table && isset($param['fid'])) {
            $data = Db::table($table)
                ->where('fid',$param['fid'])
                ->find();
           //echo Db::table($table)->getLastSql();EXIT; //打印执行sql
        }
        //操作日志
        RequestLog("$this->path",$data);        
        return $data;
    }

    /**
     * @param $param
     * @param $table
     * @return array  基础数据更新
     */
    public function sific_update($param,$table) {
        $status = 0;
        $param=HandleParamsForInsert($table,$param);
        if ($table && isset($param['fid'])) {
            Db::startTrans();
            $fid=$param['fid'];
            unset($param['fid']);
            try {
                if($fid>0){
                    $param['update_time'] = date("Y-m-d H:i:s", time());
                    $param['updater_id'] = fid?fid:1;
                    $status = Db::table($table)
                        ->wherein("fid",$fid)
                        ->setField($param);
                }else{
                    $param['create_time'] = date("Y-m-d H:i:s", time());
                    $param['creator_id'] =fid?fid:1;
                    $status = Db::name($table)->insertGetId($param);
                }
                //echo Db::table($table)->getLastSql();die;
            } catch (\Exception $e) {
                echo $e->getMessage();
                Log::error(logs($e));
            }
            Db::commit();
        }
        //操作日志
        RequestLog("$this->path",$param);
        return $status;
    }

    /**
     * @param $data
     * @param $table
     * @return array 基础数据删除
     */
    public function sific_delete($data,$table) {
        
        $data = array_filter($data);
        //var_dump($data,$table);exit;  //打印接收参数
        $status = 0;
        if ($table && !empty($data)) {
            Db::startTrans();
            try {
                /*标记删除*/
                if($data['type']==-1){
                    $status = Db::table("$table")
                        ->wherein('fid',$data['fid'])
                        ->update(['record_status'=>-1]);

                    /* 删除图片同时  删除其他表关联字段资源ID */
                    if($status){
                        //image_ids 代表convention_history_info 主键id
                        //fid 代表base_source_info 主键id
                        if(isset($data['image_ids']) && isset($data['fid'])){
                            $image_ids=Db::table('convention_history_info')
                                        ->where('fid',$data['image_ids'])
                                        ->field('image_ids')
                                        ->find();
                            if(isset($image_ids['image_ids']) && !empty($image_ids['image_ids'])){
                                $image=explode(",",$image_ids['image_ids']);
                                if(in_array($data['fid'],$image)){
                                    $key=array_search($data['fid'],$image);
                                    unset($image[$key]);
                                }
                                $image=implode(",",$image);
                                Db::table('convention_history_info')
                                    ->where('fid',$data['image_ids'])
                                    ->update(['image_ids'=>"$image"]);
                            }
                        }
                    }
                }

                if ($data['type']==1 || $data['type']==2) {
                    //1 启用 2 禁用
                    $type=$data['type']==1?2:1;
                    if($table=="v_log_login"){ 
                        $status = Db::table("log_login")
                            ->wherein('fid',$data['fid'])
                            ->update(['record_status'=>$type,'error_num'=>0]);
                       
                    }else{
                        $status = Db::table("$table")
                            ->wherein('fid',$data['fid'])
                            ->update(['record_status'=>$type]);
                    }    
                }
 
                /*彻底删除*/
                if($data['type']==-2){
					//var_dump($data,$table);exit;
                    $status = Db::table("$table")
                        ->wherein('fid',$data['fid'])
                        ->delete();
                }
                // 提交事务
                Db::commit();
            } catch (\Exception $e) {
                logs($e->getMessage());
                // 回滚事务
                Db::rollback();
            }
        }
        
        if ($status) {
            $data_status = ["code" => "1", "msg" => "删除成功"];
        } else {
            $data_status = ["code" => "0", "msg" => "删除失败"];
        }
        //操作日志
        RequestLog("$this->path",$data);
        return $data_status;
    }


    public function user_role($FUserID,$FModuleID){
        $function_list = Db::query("call p_user_function($FUserID,$FModuleID)");
        return $function_list[0];
    }

}