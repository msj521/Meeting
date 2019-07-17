<?php
namespace app\admin\Controller;

use app\admin\common\Base;
use think\Db;
use think\Model;

class Empower extends Base {

    /**
     * @var \think\Request Request实例
     */
    protected $request;
    protected $table;
    protected $path;
    protected $return;
    protected $edit;

    protected function _initialize() {
        parent::_initialize();
        $this->path=$this->request->path();
        $this->title=get_menu_title($this->path);
        $this->assign("title", $this->title);
        switch($this->path){
            case "sys/empower";
            case "sys/empower/edit";
            case "sys/empower/update";
            case "sys/empower/delete";
                $this->table="app_info";
                $this->return="/sys/empower";
                $this->edit="empower/edit";
                break;
            case "sys/token";
            case "sys/token/delete";
                $this->table="app_token_info";
                $this->return="/sys/token";
                $this->edit="empower/token_edit";
                break;
            case "sys/acl";
            case "sys/acl/edit";
            case "sys/acl/update";
            case "sys/acl/delete";
                $this->table="app_acl_info";
                $this->return="/sys/acl";
                $this->edit="empower/acl_edit";
                break;
        }
    }

    /**
     * @return string|void
     * 系统管理 | 授权  API接口APPKEY配置数据表
     */
    public function AppInfo() {
        //parent::initIndex($request);
        $where = array();
        $string = '';
        $app_type_id= "";
        $resource_type_id= "";
        $data = array_filter($_GET);
        if (!empty($data)) {
            $string = isset($data['string']) ? $data['string'] : "";
            $app_type_id = isset($data['app_type']) ? $data['app_type'] : "";
            $resource_type_id = isset($data['resource_type_id']) ? $data['resource_type_id'] : "";
            if ($app_type_id) {
                $where["app_type"] = $app_type_id;
            }

            if ($resource_type_id) {
                $where["resource"] = $resource_type_id;
            }

            if ($string) {
                $like = array('like', "%" . $string . "%");
                $where["app_secret|app_key|app_name|version_id|fid"] = $like;
            }
        }
        $list = $this->sific_list($where,$this->table);
        $count = count($list);

        /*应用端类型*/
        $app_type =app_type(-1);
        $this->assign("app_type", $app_type);

        /*应用资源类型*/
        $resource_type =resource_type(-1);
        $this->assign("resource_type", $resource_type);

        $this->assign("list", $list);
        $this->assign("app_type_id", $app_type_id);
        $this->assign("resource_type_id", $resource_type_id);
        //var_dump($data);
        return $this->fetch("empower/index", ['cnt' => $count, 'string' => $string]);
    }

    /**
     * @return string|void
     * 系统管理 | 授权  API接口TOKEN数据表
     */
    public function AppToken() {
        //parent::initIndex($request);
        $where = array();
        $string = '';
        $data = array_filter($_GET);
        if (!empty($data)) {
            $string = isset($data['string']) ? $data['string'] : "";
            if ($string) {
                $like = array('like', "%" . $string . "%");
                $where["app_name|user_name|imei|fid"] = $like;
            }
        }
        $list = $this->sific_list($where,"v_app_token_info");
        $count = count($list);
        $this->assign("list", $list);
        //var_dump($data);
        return $this->fetch("empower/token", ['cnt' => $count, 'string' => $string]);
    }

    /**
     * @return string|void
     * 系统管理 | 授权  API接口TOKEN数据表
     */
     public function AppAcl() {
        //parent::initIndex($request);
        $where = array();
        $string = '';
        $data = array_filter($_GET);
        if (!empty($data)) {
            $string = isset($data['string']) ? $data['string'] : "";
            if ($string) {
                $like = array('like', "%" . $string . "%");
                $where["app_name|version|function|fid"] = $like;
            }
        }
        $list = $this->sific_list($where,"v_app_acl_info");
        $count = count($list);
        $this->assign("list", $list);
        //var_dump($data);
        return $this->fetch("empower/acl", ['cnt' => $count, 'string' => $string]);
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

        //应用资源类型
        $resource_type =resource_type(-1);
        $this->assign("resource_type", $resource_type);

        /* API接口权限配置数据表 */

        //获取应用信息
        $app_info=get_app_info(-1);
        $this->assign("app_info", $app_info);

        //获取版本号
        $version_info=get_version_info(-1);
        $this->assign("version_info", $version_info);


        return $this->fetch("$this->edit");
    }

    /**
     * 系统管理|授权 添加 更新
     */
    public function Update() {
        if ($this->request->isPost()) {
            $data = $this->request->param(true);
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
     * 系统管理|授权   删除
     */
    public function Delete() {
        $data = $this->request->param(true);
        $status = $this->sific_delete($data,$this->table);
        return $status;
    }

}
