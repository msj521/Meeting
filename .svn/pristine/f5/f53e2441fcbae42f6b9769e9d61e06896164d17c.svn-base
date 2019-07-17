<?php
namespace app\admin\controller;

use app\admin\common\Base;
use think\Db;
use think\Model;
use think\Request;

class Exam extends Base {

    /**
     * @var \think\Request Request实例
     */
    protected $request;
    protected $table;
    protected $table_two;
    protected $path;
    protected $return;
    protected $edit;
    protected $update;
    protected $del;

    protected function _initialize() {
        parent::_initialize();
        $this->path=$this->request->path();
        $this->title=get_menu_title(request()->path());
        $this->assign("title", $this->title);
        
        switch($this->path){
            /* 考试列表 */
             case "exam/index";
             case "exam/edit";
             case "exam/update";
             case "exam/del";
                $this->table="exam_info";
                $this->table_two="exam_info";
                $this->return="/exam/index";
                $this->edit="/exam/edit";
                $this->update="/exam/update";
                $this->del="/exam/del";
                $this->assign("title", "考试列表");
                break;         
            case "exam/result";
            case "exam/result_del";
                $this->table="v_exam_result";
                $this->table_two="exam_result_info";
                $this->return="/exam/result";
                $this->del="/exam/result_del";
                $this->assign("title", "成绩单");
                break; 
            case "exam/record";
            case "exam/record_del";
                $this->table="v_exam_record";
                $this->table_two="exam_record_info";
                $this->return="/exam/record";
                $this->del="/exam/record_del";
                $this->assign("title", "答题记录");
                break; 
             case "exam/subject";
             case "exam/subject_edit";
             case "exam/subject_update";
             case "exam/subject_del";
                $this->table="v_exam_subject";
                $this->table_two="exam_subject_info";
                $this->return="/exam/subject";
                $this->edit="/exam/subject_edit";
                $this->update="/exam/subject_update";
                $this->del="/exam/subject_del";
                $this->assign("title", "考试题目");
                break; 
        }

        $this->assign("index", $this->return);
        $this->assign("edit", $this->edit);
        $this->assign("update", $this->update);
        $this->assign("del", $this->del);
     }
    /**
     * @return string|void
     * 列表
     */
    public function Index() {
        $where = array();
        //parent::initIndex($request,$where);
        $string = '';
        $data = array_filter($_GET);
        if (!empty($data)) {
            $string = isset($data['string']) ? trim($data['string']) : "";
            if ($string) {
                $like = array('like', "%" . $string . "%");
                switch($this->path){
                     case "exam/index";
                        $where['exam_name|description']=$like;
                        break;         
                    case "exam/result";
                        $where['exam_name|user_name']=$like;
                        break; 
                     case "exam/subject";
                        $where['exam_name|user_name|subject_name']=$like;
                        break;      
                     case "exam/record";
                        $where['exam_name|user_name|subject_name']=$like;
                        break;   
                }
                
            }
        }

        $fid=isset($data['fid'])?$data['fid']:0;
        $exam_id=isset($data['exam_id'])?$data['exam_id']:0;
        $uid=isset($data['uid'])?$data['uid']:0;
        if( $this->table!="v_exam" && $fid>0){
            $where['exam_id']=$fid;
        }

        //答题记录
        if($this->table=="v_exam_record" && $fid && $exam_id && $uid){
            $where['exam_id']=$exam_id;
            $where['result_id']=$fid;
            $where['creator_id']=$uid;
        }
       
        $list = $this->sific_list($where,$this->table);
        $count = count($list);
        $this->assign("list", $list);
        $this->assign("fid", $fid);
        $this->assign("exam_id", $exam_id);
        $this->assign("uid", $uid);

        return $this->fetch("$this->return", ['cnt' => $count, 'string' => $string]);
    }

    /**
     * 考试编辑
     */
    public function Edit() {
        $param = $this->request->param(true);
        $fid=isset($param['fid'])?$param['fid']:0;
        $exam_id=isset($param['exam_id'])?$param['exam_id']:0;

        $list = $this->sific_edit($this->table);
        $this->assign("fid", $fid);
        $this->assign("exam_id", $exam_id);
        $this->assign("list", $list);

        /* 考试题目选项 */
        $where=[];
        $option_list=[];
        if($fid && $exam_id){
            $where=['subject_id'=>$fid,'exam_id'=>$exam_id];
            $option_list=Db::table("exam_option_info")
                            ->where($where)
                            ->order('fid', "desc")
                            ->select();
        }
        $this->assign("option_list",json_encode($option_list));

        return $this->fetch("$this->edit");
    }



    public function Update() {

        if ($this->request->isPost()) {
            $data = $this->request->param(true);
            $fid=isset($data['fid'])?$data['fid']:0;

            $b=0;
            if ($this->table_two=="exam_info" && isset($data['exam_name'])) {
                $b=NoRepetition($fid,['exam_name'=>trim($data['exam_name'])],$this->table_two);
            }
    
            if($b>0){
                $this->error('名称已存在！');
            }
            //var_dump($data,$this->table_two);die;
            /* 主表更新 */
            $status = $this->sific_update($data,$this->table_two);     
            $expert_ids =isset($data['option_list']) ? json_decode(htmlspecialchars_decode($data['option_list']),true) :[];        
            $exam_id=isset($data['exam_id'])?$data['exam_id']:0;

            //var_dump($data,$expert_ids);die;
            /*添加[考试题目选项]之前删除相关[考试题目选项] 再进行添加*/
            $location="$this->return";
            if($this->table_two=="exam_subject_info" && $exam_id){
                $arr= [];
                foreach ($expert_ids as $key => $value) {
                    if($value['fid']<0) continue;
                    $arr[]=$value['fid'];  
                }
                $data_fid['fid']=implode(",",$arr);                 
                Db::table('exam_option_info') 
                            ->where(['exam_id'=>$exam_id,'subject_id'=>$fid])
                            ->whereNotIn('fid',$data_fid['fid'])
                            ->delete();
                $location="$this->return?fid=$exam_id";             
            }

            if ($status) {
                //[考试题目选项]处理
                Db::startTrans();
                try {
                    if (count($expert_ids)>0) {
                        foreach ($expert_ids as $key => $value) {
                            $tmp = [];
                            $tmp = HandleParamsForInsert('exam_option_info',$value);
                            if($value['fid']<0) continue;

                            if(isset($value['fid']) && $value['fid']>0){
                                $tmp['updater_id']=fid?fid:1;
                                Db::table('exam_option_info')->where(['fid'=>$value['fid']])->setField($tmp);
                            }else{
                                unset($tmp['fid']);
                                $tmp['creator_id'] =fid?fid:1;
                                $tmp['create_time'] =date("Y-m-d H:i:s",time());
                                $tmp['subject_id'] =$fid?$fid:$status;
                                $tmp['exam_id'] =$exam_id;
                                Db::table("exam_option_info")->insert($tmp);
                                //echo Db::table("exam_option_info")->getLastSql();
                            }
                        }
                    }
                }catch (\Exception $e) {
                    echo $e->getMessage();
                    $this->error("表单提交失败~~".$e->getMessage());
                }
                Db::commit();
                
                echo "<script>var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);parent.window.location.href='$location';</script>";
                exit;
            } else {
                $this->error("表单提交失败~~1");
            }
        } else {
            $this->error("表单提交失败~~2");
        }
    }

    /**
     * 考试管理 | 基础资料删除
     */
    public function Delete() {
        $data = $this->request->param(true);
        $fid=isset($data['fid'])?$data['fid']:'';
        //var_dump($data);die;

        $status = $this->sific_delete($data,$this->table_two);
        //考试删除同时删除相关字表数据
        
        if(isset($status['code']) && $status['code']==1 && !empty($fid) && $data['type']==-2){
            Db::startTrans();
            try {
                
                if($this->table_two=="exam_info"){
                    $where=['exam_id'=>$fid];
                    //考试题目
                    $this->sondel($where,"exam_subject_info");
                    //考试题目选项
                    $this->sondel($where,"exam_option_info");
                    //考试结果表
                    $this->sondel($where,"exam_result_info");
                    //考试答题记录表
                    $this->sondel($where,"exam_record_info");
                }

            }catch (\Exception $e) {
                echo $e->getMessage();
                $this->error("删除失败~~".$e->getMessage());
            }
            Db::commit();
        }
        return $status;
    }

    function sondel($where,$table){
        Db::table("$table")->where($where)->delete();
    }

}
