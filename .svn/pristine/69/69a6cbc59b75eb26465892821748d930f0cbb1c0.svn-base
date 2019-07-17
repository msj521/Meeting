<?php
namespace app\admin\controller;

use think\Db;
use app\admin\common\Base;
use think\Request;

class Live extends Base {

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
            /* 值播 */
             case "live/index";
             case "live/edit";
             case "live/update";
             case "live/del";
                $this->table="v_live";
                $this->table_two="live_info";
                $this->return="/live/index";
                $this->edit="/live/edit";
                $this->update="/live/update";
                $this->del="/live/del";
                break;         
            case "live/chat";
            case "live/chat_del";
                $this->table="v_live_chat";
                $this->table_two="live_chat";
                $this->return="/live/chat";
                $this->del="/live/chat_del";
                break;
            /* 录播 */   
             case "live/video";
             case "live/video_edit";
             case "live/video_update";
             case "live/video_del";
                $this->table="v_video";
                $this->table_two="video_info";
                $this->return="/live/video";
                $this->edit="/live/video_edit";
                $this->update="/live/video_update";
                $this->del="/live/video_del";
                break;         
             case "live/video_play";
             case "live/video_play_del";
                $this->table="v_video_play";
                $this->table_two="video_play_info";
                $this->return="/live/video_play";
                $this->del="/live/video_play_del";
                $this->assign("title", "播放记录");
                break;
             case "live/video_comment";
             case "live/video_comment_del";
                $this->table="v_video_comment";
                $this->table_two="video_comment_info";
                $this->return="/live/video_comment";
                $this->del="/live/video_comment_del";
                $this->assign("title", "录播评论");
                break;        
             case "live/video_praise";
             case "live/video_praise_del";
                $this->table="v_video_comment_detail";
                $this->table_two="video_comment_detail";
                $this->return="/live/video_praise";
                $this->del="/live/video_praise_del";
                $this->assign("title", "点赞记录");
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
    public function Index(Request $request) {
        $where = array();
        //parent::initIndex($request,$where);
        $string = '';
        $start = "";
        $end = "";
        $check = "";
        $data = array_filter($_GET);
        if (!empty($data)) {
            $string = isset($data['string']) ? $data['string'] : "";
            $start = isset($data['start_time']) ? $data['start_time'] : "";
            $end = isset($data['end_time']) ? $data['end_time'] : "";
            $check= isset($data['check']) ? $data['check'] : "";

            if ($start && $end) {
                $where["start_date"] =array('>', $start);
                $where["end_date"] = array('<', $end);
            }

            if ($check){
                $where["check"] =$check;
            }

			$key = table_key($this->table);
			if(!empty($key) && $string){
				$like = array('like', "%" . $string . "%");
				$where[$key] = $like;
			}
           
        }
        //var_dump($where);
        if($this->table=="v_video_comment_detail" && isset($data['fid'])){
            $where['comment_id']=$data['fid'];
        }elseif($this->table=="v_video_play" && isset($data['fid'])){
            $where['video_id']=$data['fid'];
			$this->assign("video_id",$data['fid']);
        }

        $list = $this->sific_list($where,$this->table);
        
        $count = count($list);
        $this->assign("list", $list);
        $this->assign("start", $start);
        $this->assign("end", $end);
        $this->assign("check", $check);



        /*录播审核状态*/
        $check_status = check_status(-1);
        $this->assign("check_status", $check_status);

        return $this->fetch("$this->return", ['cnt' => $count, 'string' => $string]);
    }

    /**
     * 直播编辑
     */
    public function Edit() {
        $param = $this->request->param(true);
        $fid=isset($param['fid'])?$param['fid']:0;

        /* 修改推流状态 */
        if($fid && isset($param['action'])){
            $request=live_status($param['action'],$fid);
            if(!empty($request)){
                return 200;
            }
        }


        $list = $this->sific_edit($this->table);
        if($list && isset($list['web_id']) || isset($list['app_id'])){
            $list['image_url'] =SourceInfo($list['web_id'],1);
            $list['image_urls'] =SourceInfo($list['app_id'],1);

            if($this->table=="v_live"){
                $live_url=Db::table("live_url_info")->where('live_id',$fid)->find();
                if(!empty($live_url)){
                    $list['rtmp_url'] = $live_url['rtmp_url'];
                    $list['hls_url'] =$live_url['hls_url'];
                    $list['push_url'] =$live_url['push_url'];
                    $list['flash_url'] =$live_url['flash_url'];
                }

                $list['live']=live_status("DescribeLiveStreamState",$fid);
            }

            if($this->table=="v_video"){
                $video_url=Db::table("v_video_url")->where('video_id',$fid)->find();
                if(isset($video_url['play_url'])){
                    $list['play_url'] = $video_url['play_url'];
                    $list['source_id'] = $video_url['source_id'];
                }
            }
        }

        $this->assign("list", $list);
        
        /*分类*/
        $type=$this->table=="v_live"?5:6;
        $Class = classify($type);
        $this->assign("class", $Class);

        //专家列表
        $expert_list=Db::table("base_expert_info")
            ->where(["record_status"=>1])
            ->field('fid,expert_name')
            ->select();
        $this->assign("expert_list", $expert_list);

        //角色列表
        $role_list=classify(7);
        $this->assign("role_list", $role_list);

        /* 直播人员列表 */
        $expert_select='';
        if($this->table=="v_live"){
            $expert_select=Db::table('v_live_expert')
                ->where(['live_id'=>$fid])
                ->select();
        }

        /* 录播人员列表  */
        if($this->table=="v_video"){
            $expert_select=Db::table('v_video_expert')
                ->where(['video_id'=>$fid])
                ->select();
        }
 
        $this->assign("expert_select", json_encode($expert_select));

        return $this->fetch("$this->edit");
    }



    public function Update() {

        if ($this->request->isPost()) {
            $data = $this->request->param(true);
            $fid=isset($data['fid'])?$data['fid']:0;
            $b=0;
            if ($this->table_two=="live_info" && isset($data['title'])) {
                $b=NoRepetition($fid,['title'=>$data['title']],$this->table_two);
            }

            if ($this->table_two=="video_info" && isset($data['video_title'])) {
                $b=NoRepetition($fid,['video_title'=>trim($data['video_title'])],$this->table_two);
            }

            if($b>0){
                $this->error('标题已存在！');
            }
			
            if(isset($data['web_image_id']) && empty($data['web_image_id'])){
                $this->error("web必须上传");
            }elseif(isset($data['app_image_id']) && empty($data['app_image_id'])){
				$this->error("APP必须上传");
			}           
            /* 上传视屏至腾讯云 */
            if(isset($data['web_image_id']) && isset($data['fileid'])){
				/* 上传成功后进行转码 */
				$vdeo_transcoding=video_edit($data['fileid'],'ConvertVodFile');
				if($vdeo_transcoding['code']>0){
					$this->error("视屏上传至腾讯云失败！请重新操作");
				}
            }

            $status = $this->sific_update($data,$this->table_two);

            $expert_ids =isset($data['expert_ids']) ? json_decode(htmlspecialchars_decode($data['expert_ids']),true) :[];
            
            
            //var_dump($data,$expert_ids);die;
            if ($this->table_two=="live_info") {
                $arr= [];
                foreach ($expert_ids as $key => $value) {
                    if(!isset($value['fid'])) continue;
                    $arr[]=$value['expert_id'];  
                }
                $data['expert_id']=implode(",",$arr);
                Db::table('live_expert_info')
                    ->where(['live_id'=>$fid])
                    ->whereNotIn('expert_id',$data['expert_id'])
                    ->delete();
            }
            
            if ($this->table_two=="video_info") {
                $arr= [];
                foreach ($expert_ids as $key => $value) {
                    if(!isset($value['fid'])) continue;
                    $arr[]=$value['expert_id'];  
                }
                $data['expert_id']=implode(",",$arr);
                Db::table('video_expert_info')
                    ->where(['video_id'=>$fid])
                    ->whereNotIn('expert_id',$data['expert_id'])
                    ->delete();
            }

            if ($status) {
                //专家增加处理
                Db::startTrans();
                try {
                    if (count($expert_ids)>0) {
                        foreach ($expert_ids as $key => $value) {
                            $tmp = [];
                            if(isset($value['fid'])){
                                $tmp['updater_id']=fid?fid:1;

                                //直播
                                if($this->table_two=="live_info"){
                                    $tmp = HandleParamsForInsert('live_expert_info',$value);
                                    Db::table('live_expert_info')->where("fid",$value['fid'])->setField($tmp);
                                }

                                //录播
                                if($this->table_two=="video_info"){
                                    $tmp = HandleParamsForInsert('video_expert_info',$value);
                                    Db::table('video_expert_info')->where("fid",$value['fid'])->setField($tmp);
                                }
                            }else{
                                $tmp['expert_id'] =$value['expert_id'];
                                $tmp['creator_id'] =fid?fid:1;
                                $tmp['create_time'] =date("Y-m-d H:i:s",time());

                                //直播
                                if($this->table_two=="live_info"){
                                    $tmp['live_id'] = $fid?$fid:$status;
                                    Db::table('live_expert_info')->insertGetId($tmp);
                                }

                                //录播
                                if($this->table_two=="video_info"){
                                    $tmp['video_id'] = $fid?$fid:$status;
                                    Db::table('video_expert_info')->insertGetId($tmp);
                                }
        
                            }
                        }
                    }

                    //直播地址处理
                    if($this->table_two=="live_info"){
                        /*live_id	int	N	Fk	直播ID,关联live_info.fid
                        push_url	nvarchar(100)	N		拉流地址 这是指HLS地址
                        rtmp_url	nvarchar(100)	N		拉流app端可电脑端
                        flash_url	nvarchar(100)	N		电脑端flash
                        hls_url	nvarchar(100)	N		hs端页面 */
                        //拉流地址 
                        $play_id=$fid?$fid:$status;
                        $play_url = getPlayUrl("41302", $play_id);
                        
                        //推流地址
                        $end_time = $data['end_date'];
                        //默认增加一天的余量
                        $end_time = date("Y-m-d H:i:s",strtotime("+1 day",strtotime($end_time)));
                        $str_time=intval($end_time);
                        $key='0b99b656bc8b2ea3ebe4549f8d297f0f';
                        $push_url = getPushUrl("41302", $play_id, $key, $str_time);

                        $live_url=Db::table('live_url_info')->where("live_id",$play_id)->find();
                        
                        $tmp_url=[];
                        if($play_id && !empty($live_url)){
                            $tmp_url['live_id'] = $play_id;
                            $tmp_url['push_url'] = $push_url;
                            $tmp_url['rtmp_url'] = $play_url[0];
                            $tmp_url['flash_url'] = $play_url[1];
                            $tmp_url['hls_url'] = $play_url[2];
                            $tmp_url['updater_id']=fid?fid:1;
                            //var_dump($tmp_url);die;
                            Db::table('live_url_info')->where("live_id",$play_id)->setField($tmp_url);
                        }else{
                            $tmp_url['push_url'] = $push_url;
                            $tmp_url['rtmp_url'] = $play_url[0];
                            $tmp_url['flash_url'] = $play_url[1];
                            $tmp_url['hls_url'] = $play_url[2];
                            $tmp_url['live_id'] = $fid?$fid:$status;
                            $tmp_url['creator_id'] =fid?fid:1;
                            $tmp_url['create_time'] =date("Y-m-d H:i:s",time());
                            Db::table('live_url_info')->insertGetId($tmp_url);
                        }
                        //echo Db::table('live_url_info')->getlastsql();die;
                    }

                    //录播地址处理
                    if($this->table_two=="video_info"){
                        /* fid
                            video_id
                            source_id
                            record_status
                            creator_id
                            create_time
                            updater_id
                            update_time 
                        */
                        $play_url=[];
                        if($fid){
                            $play_url['source_id'] =$data['source_id'];
                            $play_url['updater_id']=fid?fid:1;
                            //var_dump($play_url,1);die;
                            Db::table('video_url_info')->where("video_id",$fid)->setField($play_url);
                        }else{
                            $play_url['video_id'] = $fid?$fid:$status;
                            $play_url['source_id'] = $data['source_id'];
                            $play_url['creator_id'] =fid?fid:1;
                            $play_url['create_time'] =date("Y-m-d H:i:s",time());
                            //var_dump($play_url);die;
                            Db::table('video_url_info')->insertGetId($play_url);
                        }
                    }

                }catch (\Exception $e) {
                    echo $e->getMessage();
                    $this->error("表单提交失败~~".$e->getMessage());
                }
                Db::commit();

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
     * 直播管理 | 基础资料删除
     */
    public function Delete() {
        $data = $this->request->param(true);
        $fid=isset($data['fid'])?$data['fid']:'';

        /*   '/live/video_comment_del' => string '' (length=0)
                'fid' => string '30' (length=2)
                'urls' => string '/live/video_comment' (length=19)
                'type' => string '2' (length=1)
                'check' => string '5' (length=1) 
        */
        //录播评论审核处理
        if(isset($data['type']) && isset($data['check']) &&  $data['type']==5 && !empty($fid)){
            $status = $this->sific_update($data,$this->table_two);
            return $status;
        }




        $status = $this->sific_delete($data,$this->table_two);
        //直播删除同时删除相关字表数据
        
        if(isset($status['code']) && $status['code']==1 && !empty($fid) && $data['type']==-2){
            Db::startTrans();
            try {

                if($this->table_two=="live_info"){
                    $where=['live_id'=>$fid];
                    //删除直播专家
                    $this->sondel($where,"live_expert_info");
                    //删除直播地址
                    $this->sondel($where,"live_url_info");
                    //删除直播消息
                    $this->sondel($where,"live_chat");
                }

                if($this->table_two=="video_info"){
                    $where=['video_id'=>$fid];
                    //删除录播专家
                    $this->sondel($where,"video_expert_info");
                    //删除录播地址
                    $this->sondel($where,"video_url_info");
                    //删除录播点赞
                    $this->sondel($where,"video_comment_detail");
                    //删除录播评论
                    $this->sondel($where,"video_comment_info");
                    //删除录播播放记录
                    $this->sondel($where,"video_play_info");
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
