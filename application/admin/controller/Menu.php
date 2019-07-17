<?php
namespace app\admin\Controller;

use app\admin\common\Base;
use think\Db;
use think\Model;

class Menu extends Base{
    protected $table;
    protected function _initialize() {
        parent::_initialize();
        $this->table="base_menu_info";
		Admin_Login(fid);
        $this->title=get_menu_title(request()->path());
        $this->assign("title", $this->title);
    }
    /**
     * @return string|void
     * 菜单管理
     */
    public function Index() {
        $where = array();
        $string = '';
        $FType = "";

        $data = array_filter($_GET);
        if (!empty($data)) {
            $string = isset($data['string']) ? $data['string'] : "";
            $FType = isset($data['app_type']) ? $data['app_type'] : "";
            if ($FType) {
                $where["app_type"] = $FType;
            }
            if ($string) {
                $like = array('like', "%" . $string . "%");
                $where['menu_name|route'] = $like;
            }
        }

        $list = $this->sific_list($where,$this->table);
        $count = count($list);
        $this->assign("list", $list);
        $this->assign("FType", $FType);
        $menu=app_type(-1);
        $this->assign("menu", $menu);
        return $this->fetch("menu/index", ['cnt' => $count, 'string' => $string]);
    }

    /**
     * @return string|void
     * 会议中心 菜单展示
     */
    public function Meet() {
        $where = ['record_status'=>1,'app_type'=>2];
        $string = '';
        $data = array_filter($_GET);
        $convention_id=!empty($data['fid'])?$data['fid']:0;
        $convention_name=!empty($data['BT'])?$data['BT']:"";
        if($convention_id==0) {
            echo "<script>alert('参数丢失');var index = parent.layer.getFrameIndex(window.name);
            parent.layer.close(index);parent.location.href='/meet/index';</script>";
            exit;
        }

        if (!empty($data)) {
            $string = isset($data['string']) ? $data['string'] : "";
            if ($string) {
                $like = array('like', "%" . $string . "%");
                $where['menu_name|route'] = $like;
            }
        }

        $list = $this->sific_list($where,$this->table);
        $count = count($list);
        $this->assign("list", $list);
        $this->assign("convention_id", $convention_id);
        $this->assign("convention_name", $convention_name);

        $menu_status=['启用','禁用'];
        $this->assign("menu_status", $menu_status);
        return $this->fetch("menu/meet_menu", ['cnt' => $count, 'string' => $string]);
    }


    /**
     * 会议中心 菜单展示 操作
     */
    public function MeetEdit() {
        $param = $this->request->param(true);
        $list = $this->sific_edit($this->table);

        $status=0;
        /* 重要参数 会议fid  如丢失返回 会议列表*/
        if(isset($param['convention_id']) && empty($param['convention_id'])){
            $status=0;
        }

        $arr=[];
        if(!empty($list)){
            /* 获取convention_ids用 , 隔开返回数组 */
            $convention_ids=explode(",",$list['convention_ids']);
            $convention_ids=!empty($convention_ids)?$convention_ids:$arr;
            //type 1：启用 2：禁用
            if($param['type']==2){
                //禁用是向 convention_ids 字段追加会议FId
                array_push($convention_ids,$param['convention_id']);
                //追加结果 去重
                array_unique($convention_ids);
            }else{
                //启用 排除 convention_ids 字段会议FId
                $convention_ids=array_diff($convention_ids,[$param['convention_id']]);
            }
            /* 最终结果用 , 拼接 返回字符窜*/
            $convention_ids=implode(",",array_filter($convention_ids));

            $arr['convention_ids']=$convention_ids;
            $arr['fid']=$param['fid'];
            //var_dump($arr);die;
            $status = $this->sific_update($arr,$this->table);
            
        }
        return $status;
    }
    /**
     * 基础数据编辑
     */
    public function Edit() {
        $param = $this->request->param(true);
        $list = $this->sific_edit($this->table);
        $this->assign("list", $list);

        /*菜单类型*/
        $Class = app_type(-1);
        $this->assign("class", $Class);

        /*是否启用*/
        $is_no = is_no(-1);
        $this->assign("is_no", $is_no);

        /*一级菜单*/
        $parent=Db::table('base_menu_info')
            ->where(['record_status'=>1,'pid'=>0])
            ->field('pid,fid,menu_name')
            ->select();
        $this->assign("parent",$parent);

        return $this->fetch("menu/edit");
    }

    /**
     * 基础数据添加 更新
     */
    public function Update() {
        if ($this->request->isPost()) {
            $data = $this->request->param(true);
            $fid=isset($data['fid'])?$data['fid']:0;
            $b=0;
            if ($this->table=="base_menu_info" && isset($data['menu_name'])) {
                $b=NoRepetition($fid,['menu_name'=>trim($data['menu_name']),'app_type'=>trim($data['app_type'])],$this->table);
            }

            if($b>0){
                $this->error('名称已存在！');
            }
            //var_dump($data);die;
            if(empty($data['fid'])){
                $data['create_time'] =date("Y-m-d H:i:s", time());
            }
            $status = $this->sific_update($data,$this->table);

            if ($status) {
                echo "<script>var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);parent.location.href='menu/index';</script>";
                exit;
            } else {
                $this->error("表单提交失败~~1");
            }
        } else {
            $this->error("表单提交失败~~2");
        }
    }

    /**
     * 基础数据删除
     */
    public function Delete() {
        $data = $this->request->param(true);
        $status = $this->sific_delete($data,2,0);
        if ($status) {
            $data_status = ["code" => "1", "msg" => "删除成功"];
        } else {
            $data_status = ["code" => "0", "msg" => "删除失败"];
        }
        return $data_status;
    }





}
