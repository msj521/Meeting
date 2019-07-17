<?php
namespace app\admin\Controller;

use app\admin\common\Base;
use think\Db;
use think\Model;

class Version extends Base {

    /**
     * @var \think\Request Request实例
     */
    protected $request;
    protected $table;
    protected $table_tow;
    protected $path;
    protected $return;
    protected $edit;

    protected function _initialize() {
        parent::_initialize();
        $this->path=$this->request->path();
        $this->title=get_menu_title($this->path);
        $this->assign("title", $this->title);
        switch($this->path){
            case "sys/version";
            case "sys/version/edit";
            case "sys/version/update";
            case "sys/version/delete";
                $this->table="v_version_info";
                $this->table_tow="version_info";
                $this->return="/sys/version";
                $this->edit="version/edit";
                break;
            case "sys/version_log";
            case "sys/version_log/delete";
                $this->table="app_token_info";
                $this->table_tow="app_token_info";
                $this->return="/sys/version_log";
                $this->edit="version/token_edit";
                break;
            case "sys/version_up";
            case "sys/version_up/edit";
            case "sys/version_up/update";
            case "sys/version_up/delete";
                $this->table="version_dl_info";
                $this->table_tow="version_dl_info";
                $this->return="/sys/version_up";
                $this->edit="version/version_up_edit";
                break;
        }
    }

    /**
     * @return string|void
     * 系统管理 | 授权  API接口APPKEY配置数据表
     */
    public function VersionInfo() {
        //parent::initIndex($request);
        $where = array();
        $string = '';
        $app_type_id= "";
        $sys_type_id= "";
        $data = array_filter($_GET);
        if (!empty($data)) {
            $string = isset($data['string']) ? $data['string'] : "";
            $app_type_id = isset($data['app_type']) ? $data['app_type'] : "";
            $sys_type_id = isset($data['sys_type_id']) ? $data['sys_type_id'] : "";
            if ($app_type_id) {
                $where["app_type"] = $app_type_id;
            }

            if ($sys_type_id) {
                $where["app_postfix"] = $sys_type_id;
            }

            if ($string) {
                $like = array('like', "%" . $string . "%");
                $where["version_no|memo|fid"] = $like;
            }
        }

        $list = $this->sific_list($where,$this->table);
        $count = count($list);

        /*应用端类型*/
        $app_type =app_type(-1);
        $this->assign("app_type", $app_type);

        /*运行系统*/
        $sys_type =sys_type(-1);
        $this->assign("sys_type", $sys_type);

        $this->assign("list", $list);
        $this->assign("app_type_id", $app_type_id);
        $this->assign("sys_type_id", $sys_type_id);
        //var_dump($data);
        return $this->fetch("version/index", ['cnt' => $count, 'string' => $string]);
    }

    /**
     * @return string|void
     * 系统管理 | 授权  API接口TOKEN数据表
     */
    public function VersionUp() {
        //parent::initIndex($request);
        $where = array();
        $string = '';
        $data = array_filter($_GET);
        if (!empty($data)) {
            $string = isset($data['string']) ? $data['string'] : "";
            if ($string) {
                $like = array('like', "%" . $string . "%");
                $where["version_no|user_name|memo|fid"] = $like;
            }
        }
        $list = $this->sific_list($where,"v_version_dl_info");
        $count = count($list);
        $this->assign("list", $list);
        //var_dump($data);
        return $this->fetch("version/version_up", ['cnt' => $count, 'string' => $string]);
    }

    /**
     * @return string|void
     * 系统管理 | 授权  API接口TOKEN数据表
     */
     public function VersionLog() {
        //parent::initIndex($request);
        $where = array();
        $string = '';
        $app_type_id = '';
        $data = array_filter($_GET);
        if (!empty($data)) {
            $string = isset($data['string']) ? $data['string'] : "";
            $app_type_id = isset($data['app_type']) ? $data['app_type'] : "";
            if ($app_type_id) {
                $where["app_type"] = $app_type_id;
            }
            if ($string) {
                $like = array('like', "%" . $string . "%");
                $where["imei|version_no|user_name|fid"] = $like;
            }
        }
        $list = $this->sific_list($where,"v_version_dl_log");
        $count = count($list);
        $this->assign("list", $list);

        //应用端类型
        $app_type =app_type(-1);
        $this->assign("app_type", $app_type);
        $this->assign("app_type_id", $app_type_id);
        //var_dump($data);
        return $this->fetch("version/version_log", ['cnt' => $count, 'string' => $string]);
    }
    /**
     * 系统管理|授权
     */
    public function Edit() {
        $list = $this->sific_edit($this->table);
        $this->assign("list", $list);

        /* API接口APPKEY配置数据表  资源引用 */

        //应用端类型
        $app_type =app_type(-1);
        $this->assign("app_type", $app_type);

        /* API接口权限配置数据表 */

        //获取应用信息
        $app_info=get_app_info(-1);
        $this->assign("app_info", $app_info);

        //获取版本号
        $version_info=get_version_info(-1);
        $this->assign("version_info", $version_info);

        /*运行系统*/
        $sys_type =sys_type(-1);
        $this->assign("sys_type", $sys_type);

        /*用户列表*/
        $enduser_info =get_enduser_info(-1,1);
        $this->assign("user_info", $enduser_info);

        /*升级控制*/
        $version_up_type =version_up_type(-1);
        $this->assign("version_up_type", $version_up_type);

        return $this->fetch("$this->edit");
    }

    /**
     * 系统管理|授权 添加 更新
     */
    public function Update() {
        if ($this->request->isPost()) {
            $data = $this->request->param(true);
            $fid = isset($data['fid']) ? $data['fid'] : 0;
            if($fid==0){
                $password = isset($data['dl_pass']) ? $data['dl_pass'] : "";
                if (strlen($password)<=16) {
                    $data['dl_pass'] = md5($password);
                }
            }
			//var_dump($data,$this->table_tow);die;
            $status = $this->sific_update($data,$this->table_tow);
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
     * 系统管理|授权   删除
     */
    public function Delete() {
		$data = $this->request->param(true);
        $status = $this->sific_delete($data,$this->table_tow);
        return $status;
    }

}
