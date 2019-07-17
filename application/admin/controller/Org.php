<?php
namespace app\admin\Controller;

use app\admin\common\Base;
use think\Db;
use think\Model;
use think\Request;

class Org extends Base {

    protected $table;
    protected function _initialize() {
        parent::_initialize();
        $this->table="base_org_conf";
    }
    /**
     * @return string|void
     * 单位机构
     */
     public function Index() {
        //parent::initIndex($request);
        $where = array();
        $string = '';
        $class_type= "";
        $data = array_filter($_GET);
        if (!empty($data)) {
            $string = isset($data['string']) ? $data['string'] : "";
            $class_type = isset($data['class_type']) ? $data['class_type'] : "";
            if ($class_type) {
                $where["class_type"] = $class_type;
            }

            if ($string) {
                $like = array('like', "%" . $string . "%");
                $where["class_name_zh|remark"] = $like;
            }
        }
        $list = $this->sific_list($where,$this->table);
        $count = count($list);

        /*基础分类*/
        $Class =get_class_type(0);
        $this->assign("class", $Class);

        $this->assign("list", $list);
        $this->assign("class_type", $class_type);
        //var_dump($data);
        return $this->fetch("org/index", ['cnt' => $count, 'string' => $string]);
    }

    /**
     * 参展商 数据编辑
     */
     public function Edit() {
        $list = $this->sific_edit($this->table);
        $this->assign("list", $list);

        /*分类*/
        $Class = get_class_type(0);
        $this->assign("class_type", $Class);
        return $this->fetch("org/edit");
    }

    /**
     * 参展商数据添加 更新
     */
     public function Update() {
        if ($this->request->isPost()) {
            $data = $this->request->param(true);
            if((isset($data['web_image_id']) && empty($data['web_image_id'])) 
            ||(isset($data['app_image_id']) && empty($data['app_image_id'])) ){
                $data['web_image_id']=0;
                $data['app_image_id']=0;
            }            
            $status = $this->sific_update($data,$this->table);
            if ($status) {
                echo "<script>var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);parent.window.location.href='/org/index';</script>";
                exit;
            } else {
                $this->error("表单提交失败~~1");
            }
        } else {
            $this->error("表单提交失败~~2");
        }
    }

    /**
     * 单位机构 删除
     */
     public function Delete() {
        $data = $this->request->param(true);
        $status = $this->sific_delete($data,$this->table);
        return $status;
    }

}