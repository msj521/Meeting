<?php
namespace app\admin\controller;

use app\admin\common\Base;
use think\Db;
use think\Model;
use think\Request;

class Meeting extends Base {
    /**
     * @return string|void
     * 会议列表
     */
    public function Index(Request $request) {
        parent::initIndex($request);

        $where = array();
        $string = '';
        $start = "";
        $end = "";
        $FType = "";

        $data = array_filter($_GET);
        if (!empty($data)) {
            $string = isset($data['string']) ? $data['string'] : "";
            $start = isset($data['start_time']) ? $data['start_time'] : "";
            $end = isset($data['end_time']) ? $data['end_time'] : "";
            $FType = isset($data['FType']) ? $data['FType'] : "";

            if ($start && $end) {
                $where["FCreateDate"] = array('between', "$start,$end");
            }

            if ($FType) {
                $where["FType"] = $FType;
            }
            if ($string) {
                $table = get_edit();
                $key = table_key($table[0]);
                if(!empty($key)){
                    $like = array('like', "%" . $string . "%");
                    $where[$key] = $like;
                }
            }
        }

        $list = $this->sific_list($where);
        $count = count($list);
        $this->assign("list", $list);
        $this->assign("start", $start);
        $this->assign("end", $end);
        $this->assign("FType", $FType);
        $meet=meet_type();
        $this->assign("meet", $meet);
        return $this->fetch("meeting/index", ['cnt' => $count, 'string' => $string]);
    }

    /**
     * 会议编辑
     */
    public function Edit() {
        $param = $this->request->param(true);
        $list = $this->sific_edit($param);
        $this->assign("list", $list);
        $meet=meet_type();
        $this->assign("meet", $meet);
        /*是否显示*/
        $is_no = is_no(-1);
        $this->assign("is_no", $is_no);
        return $this->fetch("meeting/edit");
    }

    /**
     * 会议添加 更新
     */
    public function Update() {
        if ($this->request->isPost()) {
            $data = $this->request->param(true);
            $file = request()->file('img');

            if (is_null($file) && empty($data['FImageUrl'])) {
                $this->error("图片必须上传~~");
            }

            if ($file) {
                $filepatch = uploads($file);
                if (is_null($filepatch)) {
                    $this->error("图片上传失败");
                }
                //获取文件的路径
                $data['FImageUrl'] = "/uploads/" . $filepatch;
            }
            $data['FCreateDate'] = date("Y-m-d H:i:s", time());
            $data['FCreator'] =FID;
            //年会排序
            $FOrder=Db::table('v_conference')->where("FType","SIFIC年会")->max('FOrder');
            //var_dump(FID,$FOrder);DIE;
            if($data['FType']=="SIFIC年会" && !isset($data['FID'])){
                $data['FOrder']=$FOrder+1;
            }

            try {
                $status = $this->sific_update($data);
                /*生成静态文件*/
                if($status>1) $data['FID']=$status;
                $this->meeting_file($data);
                
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            
            if ($status) {
                echo "<script>var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);parent.window.location.href='/meet/index';</script>";
                exit;
            } else {
                $this->error("表单提交失败~~1");
            }
        } else {
            $this->error("表单提交失败~~2");
        }
    }

    /**
     * 会议删除
     */
    public function Delete() {
        $data = $this->request->param(true);
        try {
            $status = $this->sific_delete($data,1,"all");
            /*生成静态文件*/
            $this->meeting_file($data);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        if ($status) {
            $data_status = ["code" => "1", "msg" => "删除成功"];
        } else {
            $data_status = ["code" => "0", "msg" => "删除失败"];
        }
        return $data_status;
    }


    /**
     * 会议-参展商列表
     */
    public function Business() {
        $where = array();
        $where_exh = array();
        $FName = '';
        $exh = '';
        $FID = 0;
        $exhibitor = array();
        $data = array_filter($_GET);
        if (!is_null($data)) {

            /*会议信息列表   FName 会议名称*/
            $FName = isset($data['FName']) ? $data['FName'] : "";
            if ($FName) {
                $like = array('like', "%" . $FName . "%");
                $where["FName"] = $like;
            }

            /*参加会议的商家  exh 厂商名称*/
            $exh = isset($data['exh']) ? $data['exh'] : "";
            if ($exh) {
                $like = array('like', "%" . $exh . "%");
                $where_exh["FName"] = $like;
            }

            $FID = isset($data['FID']) ? $data['FID'] : "";
            if ($FID) {
                $where_exh["FConferenceID"] = $FID;
                $exhibitor = model('v_conference_exhibitor')
                    ->where($where_exh)
                    ->order('FID', "desc")
                    ->paginate(15, false, ['query' => request()->param()]);
            }
            /*排除会议存在商家*/
            $FOrgID = model('v_conference_exhibitor')
                ->where("FConferenceID", $FID)
                ->column('FOrgID');
            $where['FID'] = array('not in', $FOrgID);
        }

        $list = $this->sific_list($where);
        $this->assign("list", $list);

        $this->assign("exhibitor", $exhibitor);

        return $this->fetch("/meeting/business", ['FName' => $FName, 'exh' => $exh, 'FID' => $FID]);
    }

    /**
     * 会议-参展商编辑
     */
    public function meet_edit() {

        $FParentID = isset($_GET['FParentID']) ? $_GET['FParentID'] : "";
        $FOrgID = isset($_GET['FOrgID']) ? $_GET['FOrgID'] : "";
        $this->assign("FParentID", $FParentID);
        $this->assign("FOrgID", $FOrgID);

        if ($this->request->isPost()) {
            $data = array_filter($_POST);
            if (is_null($data)) {
                $this->error("参数丢失~~");
            }

            if (isset($data['FParentID']) && isset($data['FOrgID'])) {
                $data['FCreateDate'] = date("Y-m-d H:i:s", time());
                $data['FCreator'] = FID;
                $FParentID = $data['FParentID'];
                $status=$this->sific_update($data);
                if ($status) {
                    /*生成静态文件*/
                    if($status>1) $data['FID']=$FParentID;
                    $this->meeting_file($data);
                    echo "<script>var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);parent.window.location.href='/meet/business?FID=$FParentID';</script>";
                    exit;
                } else {
                    $this->error("添加失败~~");
                }
            } else {
                $this->error("参数丢失2~~");
            }
        }

        /*分类*/
        $Class = classify(1005);
        $this->assign("class", $Class);

        return $this->fetch("meeting/exh_edit");
    }


    /**
     *会议-参展商删除
     */
    public function meet_delete() {
        $data = $this->request->param(true);
        $data=array_filter($data);
        $status = $this->sific_delete($data,1,0);
        if ($status) {
            /*生成静态文件*/
            if(!empty($data["urls"])) {
                $FParentID=explode("=",$data["urls"])[1];
            }
            $datas['FID']=$FParentID;
            $this->meeting_file($datas);
            $data_status = ["code" => "1", "msg" => "删除成功"];
        } else {
            $data_status = ["code" => "0", "msg" => "删除失败"];
        }
        return $data_status;
    }





    /**
     * 会议-日程列表
     */
    public function Agenda() {

        $where = array();
        $string = '';
        $start = "";
        $end = "";

        $data = array_filter($_GET);
        if (!empty($data)) {
            $string = isset($data['string']) ? $data['string'] : "";
            $start = isset($data['start_time']) ? $data['start_time'] : "";
            $end = isset($data['end_time']) ? $data['end_time'] : "";

            if ($start && $end) {
                $where["FCreateDate"] = array('between', "$start,$end");
            }
            if ($string) {
                $table = get_edit();
                $key = table_key($table[0]);
                if(!empty($key)){
                    $like = array('like', "%" . $string . "%");
                    $where[$key] = $like;
                }
            }
        }
        /*大会主键ID*/
        $FParentID = isset($_GET['FID']) ? $_GET['FID'] : ''; //1
        $where['FConferenceID'] = $FParentID;

        $list = $this->sific_list($where);
        $count = count($list);
        $this->assign("list", $list);
        $this->assign("start", $start);
        $this->assign("end", $end);

        return $this->fetch("/meeting/agenda", ['cnt' => $count, 'string' => $string, 'FParentID' => $FParentID]);
    }

    /**
     * 会议-日程编辑
     */
    public function agenda_edit() {
        $param = $this->request->param(true);

        /*大会主键ID*/
        $FParentID = isset($_GET['FParentID']) ? $_GET['FParentID'] : '';
        $list = $this->sific_edit($param);
        $this->assign("list", $list);
        $room=Get_Room($FParentID);
        $this->assign("room", $room);

        /*日程ID*/
        $FMeetingID = isset($_GET['FID']) ? $_GET['FID'] : 0;
        $expert_select = Db::table('v_conference_meeting_person')
            ->where(['FConferenceID' => $FParentID,'FParentID' => $FMeetingID])
            ->Field('FUserID,FUserName,FOrganization,FRoleTypeID,FRoleName')
            ->select();

        $this->assign("expert_select", json_encode($expert_select));


        $expert_list = Db::table('v_user_video_extend')
            ->Field('FID,FName,FOrganization')
            ->select();
        $this->assign("expert_list", $expert_list);

        $role_list = Db::table('t_item')->where(['FItemClassID'=>1004,'FDelete'=>0])->select();
        $this->assign('role_list',$role_list);

        return $this->fetch("meeting/edit_agenda", ['FParentID' => $FParentID]);
    }

    /**
     *会议-日程更新
     */
    public function agenda_update() {

        if ($this->request->isPost()) {
            $data = $this->request->param(true);
            $data['FCreateDate'] = date("Y-m-d H:i:s", time());
            $FParentID = isset($data['FParentID']) && !empty($data['FParentID']) ? $data['FParentID'] : "";
            if (is_null($FParentID)) {
                $this->error("父级ID丢失~~");
            }

            $FExpertIDs = isset($data['FExpertIDs']) ? json_decode(htmlspecialchars_decode($data['FExpertIDs']),true) : [];
            $data = HandleParamsForInsert('t_conference_meeting',$data);
            $FID = isset($data['FID']) ? $data['FID'] : 0;

            Db::startTrans();
            try {
                if ($FID>0) {
                    Db::table('t_conference_meeting')
                    ->strict(true)
                    ->where('FID', $FID)
                    ->setField($data);
                    // echo Db::table($table[0])->getLastSql();EXIT; //打印执行sql

                    Db::table('t_conference_meeting_person')->where(['FParentID'=>$FID,'FConferenceID'=>$FParentID])->delete();

                }else{
                    // Db::table('t_video')->strict(true)->insert($data);
                    $FID = Db::name('conference_meeting')->insertGetId($data);   
                    $data['FID'] = $FID;
                }

                //插入子表
                if (count($FExpertIDs)>0) {
                    $params = [];
                    foreach ($FExpertIDs as $key => $value) {
                        $tmp = [];
                        $tmp = HandleParamsForInsert('t_conference_meeting_person',$value);
                        $tmp['FParentID'] = $FID;
                        $tmp['FConferenceID'] = $FParentID;
                        array_push($params, $tmp);
                    }
                    Db::table('t_conference_meeting_person')->insertAll($params);

// echo Db::table('t_video_expert')->getLastSql();die;
                }

                // 提交事务
                Db::commit();

                echo "<script>var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);parent.window.location.href='/meet/agenda?FID=$FParentID';</script>";
                exit;

            } catch (\Exception $e) {
                logs($e->getMessage());
                var_dump($e->getMessage());
                // 回滚事务
                Db::rollback();
                $this->error("表单提交失败~~1");
            }

        } else {
            $this->error("表单提交失败~~2");
        }

    }

    /**
     *会议-日程删除
     */
    public function agenda_delete() {
        $data = $this->request->param(true);

        $status = $this->sific_delete($data,1,"all");
        if ($status) {
            $data_status = ["code" => "1", "msg" => "删除成功"];
        } else {
            $data_status = ["code" => "0", "msg" => "删除失败"];
        }
        return $data_status;
    }


    /**
     * 会议-时间日程列表
     */
    public function agenda_time() {

        $where = array();
        $string = '';
        $start = "";
        $end = "";

        $data = array_filter($_GET);
        if (!empty($data)) {
            $string = isset($data['string']) ? $data['string'] : "";
            $start = isset($data['start_time']) ? $data['start_time'] : "";
            $end = isset($data['end_time']) ? $data['end_time'] : "";

            if ($start && $end) {
                $where["FStartDate"] =['<=',$start];
                $where["FStartDate"] = ['>= ',$end];
            }
            if ($string) {
                $like = array('like', "%" . $string . "%");
                $where['FTitle|FRoomName']=$like;
            }
        }
        /*大会主键ID*/
        $FMeetingID = isset($_GET['FID']) ? $_GET['FID'] : ''; //2
        $FConferenceID = isset($_GET['FParentID']) ? $_GET['FParentID'] : ''; //1
        $where['FMeetingID'] = $FMeetingID;//2
        $where['FConferenceID'] = $FConferenceID;//1
        $this->assign("FMeetingID", $FMeetingID);//2
        $this->assign("FConferenceID", $FConferenceID);//1

        $list = $this->sific_list($where);

        $count = count($list);
        $this->assign("list", $list);
        $this->assign("start", $start);
        $this->assign("end", $end);

        return $this->fetch("/meeting/agenda_time", ['cnt' => $count, 'string' => $string]);
    }

    /**
     * 会议-时间日程编辑
     */
    public function agenda_time_edit() {
        $param = $this->request->param(true);
        /*大会主键ID*/
        $FID = isset($_GET['FID']) ? $_GET['FID'] : ''; //3
        $FMeetingID = isset($_GET['FMeetingID']) ? $_GET['FMeetingID'] : ''; //2
        $FConferenceID = isset($_GET['FConferenceID']) ? $_GET['FConferenceID'] : ''; //1

        $where['FID'] = $FID;
        $where['FMeetingID'] = $FMeetingID;
        $where['FConferenceID'] = $FConferenceID;
        $this->assign("FMeetingID", $FMeetingID);
        $this->assign("FConferenceID", $FConferenceID);

        $list = $this->sific_edit($param);
        $this->assign("list", $list);

        $expert_select = Db::table('v_conference_meeting_time_person')
            ->where('FParentID', $FMeetingID)
            ->where('FConferenceID', $FConferenceID)
            ->Field('FUserID,FUserName,FOrganization')
            ->select();
        $this->assign("expert_select", $expert_select);


        $expert_list = Db::table('v_user_video_extend')
            ->Field('FID,FName,FOrganization')
            ->select();
        $this->assign("expert_list", $expert_list);

        return $this->fetch("meeting/agenda_time_edit");
    }

    /**
     *会议-时间日程更新
     */
    public function agenda_time_update() {

        if ($this->request->isPost()) {
            $data = $this->request->param(true);
            /*大会主键ID*/
            $FConferenceID = isset($_POST['FConferenceID']) ? $_POST['FConferenceID'] : ''; //2
            $FMeetingID = isset($_POST['FParentID']) ? $_POST['FParentID'] : ''; //1

            $FExpertIDs = isset($_POST['FExpertIDs']) ? $_POST['FExpertIDs'] : ''; //1
            $FExpertIDs = explode(',',$data['FExpertIDs']);

            if (is_null($FConferenceID)) {
                $this->error("FConferenceID丢失~~");
            }else if (is_null($FMeetingID)) {
                $this->error("FMeetingID丢失~~");
            }

            $data = HandleParamsForInsert('t_conference_meeting_time',$data);
            $FID = isset($data['FID']) ? $data['FID'] : 0;

            Db::startTrans();
            try {
                if ($FID>0) {
                    Db::table('t_conference_meeting_time')
                    ->strict(true)
                    ->where('FID', $FID)
                    ->setField($data);
                    // echo Db::table($table[0])->getLastSql();EXIT; //打印执行sql

                    Db::table('t_conference_meeting_time_person')
                    ->where(['FParentID'=>$FID,'FConferenceID'=>$FConferenceID,'FMeetingID'=>$FMeetingID])
                    ->delete();

                }else{
                    // Db::table('t_video')->strict(true)->insert($data);
                    $FID = Db::name('conference_meeting_time')->insertGetId($data);   
                    $data['FID'] = $FID;
                }

                //插入子表
                if (count($FExpertIDs)>0) {
                    $params = [];
                    foreach ($FExpertIDs as $key => $value) {
                        $tmp = [];
                        $tmp['FParentID'] = $FID;
                        $tmp['FConferenceID'] = $FConferenceID;
                        $tmp['FMeetingID'] = $FMeetingID;
                        $tmp['FUserID'] = $value;
                        $tmp['FRoleTypeID'] = 0;
                        array_push($params, $tmp);
                    }
                    Db::table('t_conference_meeting_time_person')->insertAll($params);

// echo Db::table('t_video_expert')->getLastSql();die;
                }

                // 提交事务
                Db::commit();

                $this->meeting_time($data);

                echo "<script>var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);parent.window.location.href='/meet/time_agenda?FID=$FMeetingID&FParentID=$FConferenceID';</script>";
                exit;

            } catch (\Exception $e) {
                logs($e->getMessage());
                var_dump($e->getMessage());
                // 回滚事务
                Db::rollback();
                $this->error("表单提交失败~~1");
            }
        } else {
            $this->error("表单提交失败~~2");
        }

    }

    /**
     *会议-时间日程删除
     */
    public function agenda_time_delete() {
        $data = $this->request->param(true);
        $datas=Db::table("v_conference_meeting_time")
            ->where('FID',$data['FID'])
            ->field("FID,FMeetingID as FParentID,FConferenceID")
            ->find();
        //var_dump($data);die;
        $status = $this->sific_delete($data,1,0);
        if ($status) {
            $this->meeting_time($datas);
            $data_status = ["code" => "1", "msg" => "删除成功"];
        } else {
            $data_status = ["code" => "0", "msg" => "删除失败"];
        }
        return $data_status;
    }



    /**
     * 会议-会议室列表
     */
    public function Room() {

        $where = array();
        $string = '';
        $start = "";
        $end = "";

        $data = array_filter($_GET);
        if (!empty($data)) {
            $string = isset($data['string']) ? $data['string'] : "";
            $start = isset($data['start_time']) ? $data['start_time'] : "";
            $end = isset($data['end_time']) ? $data['end_time'] : "";

            if ($start && $end) {
                $where["FCreateDate"] = array('between', "$start,$end");
            }
            if ($string) {
                $table = get_edit();
                $key = table_key($table[0]);
                if(!empty($key)){
                    $like = array('like', "%" . $string . "%");
                    $where[$key] = $like;
                }
            }
        }
        /*大会主键ID*/
        $FParentID = isset($_GET['FID']) ? $_GET['FID'] : '';
        $where['FConferenceID'] = $FParentID;

        $list = $this->sific_list($where);
        $count = count($list);
        $this->assign("list", $list);
        $this->assign("start", $start);
        $this->assign("end", $end);

        return $this->fetch("/meeting/room", ['cnt' => $count, 'string' => $string, 'FParentID' => $FParentID]);
    }


    /**
     * 会议-会议室编辑
     */
    public function room_edit() {
        $param = $this->request->param(true);
        /*大会主键ID*/
        $FParentID = isset($_GET['FParentID']) ? $_GET['FParentID'] : '';
        $list = $this->sific_edit($param);
        $this->assign("list", $list);
        return $this->fetch("meeting/edit_room", ['FParentID' => $FParentID]);
    }

    /**
     *会议-会议室更新
     */
    public function room_update() {
        //var_dump($_POST);exit;
        if ($this->request->isPost()) {
            $data = $this->request->param(true);
            $file = request()->file('img');

            $FParentID = isset($data['FParentID']) && !empty($data['FParentID']) ? $data['FParentID'] : "";
            if (is_null($FParentID)) {
                $this->error("父级ID丢失~~");
            }
            if (is_null($file) && empty($data['FMapUrl'])) {
                $this->error("图片必须上传~~");
            }

            if ($file) {
                $filepatch = uploads($file);
                if (is_null($filepatch)) {
                    $this->error("图片上传失败");
                }
                //获取文件的路径
                $data['FMapUrl'] = "/uploads/" . $filepatch;
            }
            $data['FCreateDate'] = date("Y-m-d H:i:s", time());
            $data['FCreator'] = FID;

            $status = $this->sific_update($data);
            if ($status) {
                echo "<script>var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);parent.window.location.href='/meet/room?FID=$FParentID';</script>";
                exit;
            } else {
                $this->error("表单提交失败~~1");
            }
        } else {
            $this->error("表单提交失败~~2");
        }
    }

    /**
     *会议-会议室删除
     */
    public function room_delete() {
        $data = $this->request->param(true);

        $status = $this->sific_delete($data,1,0);
        if ($status) {
            $data_status = ["code" => "1", "msg" => "删除成功"];
        } else {
            $data_status = ["code" => "0", "msg" => "删除失败"];
        }
        return $data_status;
    }
}

