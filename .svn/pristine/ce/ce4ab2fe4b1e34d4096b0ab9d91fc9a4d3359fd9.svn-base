<?php
namespace app\api\controller;

use think\Db;
use think\Request;
use app\api\common\Base;

class Product extends Base {

    /**
     * 分类标签
     */
     public function ProductClassList(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $class_list = classify(6);
        $data = [
            'code' => '200',
            'msg' => '获取成功',
            'data' => [
                'class_list' => $class_list
            ]
        ];
       echo json_encode($data);exit;
    }

    /**
     * 培训列表
     */
    public function ProductList(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $class_id =isset($heard['class_id'])?$heard['class_id']:0;
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $page =isset($heard['page'])?$heard['page']:1;
        $pagesize =isset($heard['pagesize'])?$heard['pagesize']:40;
        $product_type =isset($heard['product_type'])?$heard['product_type']:0;
        $vip =isset($heard['vip'])?$heard['vip']:0;
        
        $where['product_type'] =$product_type;
        $where['record_status'] =1; 
        if ($class_id>0) {
            $where["class_id"]=$class_id;
        }

        /* VIP列表 */
        if ($vip>0) {
            $where["price"]=["<>",0];
        }

        $result = Db::table("v_product")
                ->where($where)
                ->order(['recommend'=>'desc','sort'=>'desc','fid'=>'desc'])
                ->limit(($page-1)*$pagesize,$pagesize)
                ->select();       
        $total = Db::table("v_product")
                ->where($where)
                ->count();
        //ECHO Db::table("v_product")->GETLASTSQL();die;
        $class_list = classify(6);
        
        $data = [
            'code' => '200',
            'msg' => '获取成功',
            'data' => [
                'class_list' => $class_list,
                'product_list' => $result,
                'total' => count($total)
            ]
        ];
       echo json_encode($data);exit;
    }
    
    /**
     * 培训详情
     */
    public function TrainingDetail(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $training_id =isset($heard['training_id'])?$heard['training_id']:0;

        $training = Db::query("call p_training_detail($training_id,'$uid')");

        $training_info = isset($training[0]) ? $training[0] : '';
        $training_expert = isset($training[1]) ? $training[1] : [];
        $training_video = isset($training[2]) ? $training[2] : [];

        if (count($training_info)>0) {
            $section = [];
            if (count($training_video)>0 && isset($training_video[0])) {
                foreach ($training_video as $vo) {
                    
                    /* 获取腾讯云视屏接口 */
                    $play_url_tow=[];
                    if(!empty($vo['fileid'])){
                        $video_capture=video_edit($vo['fileid']."&infoFilter.0=transcodeInfo",'GetVideoInfo');
                        if($video_capture['code']==0){
                            $video_url=isset($video_capture['transcodeInfo']['transcodeList'])?$video_capture['transcodeInfo']['transcodeList']:"";
                            if(!empty($video_url)){
                                foreach($video_url as $v){
                                    $play_url_tow[]=base64_encode($v['url']);
                                }
                            }
                        }
                    }
                    $vo['play_url']=$play_url_tow;
                    /* 考试列表 */
                    $flag = false;
                    foreach ($section as $key) {
                        if ($key['section_id']==$vo['section_id']) {
                            $flag = true;
                        }
                    }
                
                    if ($flag) {
                        foreach ($section as &$se) {
                            if ($se['section_id']==$vo['section_id']) {
                                array_push($se['children'],$vo);
                            }
                        }
                    }else{
                        $section[] = [
                            'section_id'=>$vo['section_id'],
                            'section_name'=>$vo['section_name'],
                            'children'=>[
                                '0'=>$vo
                            ]
                        ];
                    }
                }
            }

            /* 返回收藏状态 */
            $status = Db::table('product_collect_info')
                ->where(['record_status'=>1,'product_id'=>$training_id,'creator_id'=>$uid])
                ->count();
            $training_info[0]['collect_status']=$status; 

            // 返回录播包权限  等于0时无权观看  大于0时有权观看  
            $result = Comment_authority($uid,$training_id,2);
            $training_info[0]['authority_status']=$result; 

            $data = [
                'code' => '200',
                'msg' => '获取成功',
                'data' => [
                    'training_info' => $training_info[0],
                    'expert_list' => $training_expert,
                    'video_list' => $section
                ]
            ];
        }else{
            $data = [
                'code' => '414',
                'msg' => '数据不存在',
            ];
        }
       echo json_encode($data);exit;
    }
                
    /**
     * 录播详情--web
     */
    public function VideoDetail(){
        $heard = request()->param();
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $training_id =isset($heard['training_id'])?$heard['training_id']:0;
        $video_id =isset($heard['video_id'])?$heard['video_id']:0;

        if ($uid==0) {
            $data = [
                'code'=>'422',
                'msg'=>'请登录后再播放'
            ];
            echo json_encode($data);exit;
        }

        $video = Db::query("call p_video_detail($training_id,$video_id)");

        $video_info = isset($video[0]) ? $video[0] : [];
        $video_expert = isset($video[1]) ? $video[1] : [];
        $video_video = isset($video[2]) ? $video[2] : [];

        if (isset($heard['devicetype']) && $heard['devicetype']!='web') {//手机端
            
            /* 获取腾讯云视屏接口 */
            $play_url_tow=[];
            if(!empty($video_info[0]['fileid'])){
                $video_capture=video_edit($video_info[0]['fileid']."&infoFilter.0=transcodeInfo",'GetVideoInfo');
                if($video_capture['code']==0){
                    $video_url=isset($video_capture['transcodeInfo']['transcodeList'])?$video_capture['transcodeInfo']['transcodeList']:"";
                    if(!empty($video_url)){
                        foreach($video_url as $v){
                            $play_url_tow[]=base64_encode($v['url']);
                        }
                    }
                }
            }
            if (empty($play_url_tow)) {
                $play_url_tow[] = base64_encode(URL.$play_url['play_url']);
            }

            $result = Comment_authority($uid,$training_id,2);
            if ($result==0) {
                $play_url_data = [
                    'code' => '410',
                    'msg' => '可试看5分钟',
                ];
            }else{
                $play_url_data = [
                    'code'=>'200',
                    'data'=>$play_url_tow,
                    'msg'=>'获取成功'
                ];
            }
            echo json_encode($play_url_data);exit;
        }
        
        
        $comment = Db::table('v_video_comment')
        ->field('fid,video_id,content,user_name,nick_name,app_image_url,web_image_url,praise_num,create_time')
        ->where(['record_status'=>1,'video_id'=>$video_id,'check'=>1])
        ->order(['fid'=>'desc'])
        ->select();
        if (count($comment)>0){
	        foreach ($comment as &$vo){
	            $comment_detail = Db::table('video_comment_detail')
	            ->where(['record_status'=>1,'creator_id'=>$uid,'video_id'=>$video_id,'comment_id'=>$vo['fid']])
	            ->select();
	            if (count($comment_detail)>0){
	            	$vo['is_praise'] = 1;
	            }else{
	            	$vo['is_praise'] = 0;
	            }
	        }
        }
        
        if (isset($video_info)&&count($video_info)>0) {
            $section = [];
            if (isset($video_video)&&count($video_video)>0) {
                foreach ($video_video as $vo) {
                    $flag = false;
                    foreach ($section as $key) {
                        if ($key['section_id']==$vo['section_id']) {
                            $flag = true;
                        }
                    }
                    if ($flag) {
                        foreach ($section as &$se) {
                            if ($se['section_id']==$vo['section_id']) {
                                array_push($se['children'],$vo);
                            }
                        }
                    }else{
                        $section[] = [
                            'section_id'=>$vo['section_id'],
                            'section_name'=>$vo['section_name'],
                            'children'=>[
                                '0'=>$vo
                            ]
                        ];
                    }
                }
            }
            $result = Comment_authority($uid,$training_id,2);
            $play_url = Db::table("v_video_url")
            ->where(["video_id"=>$video_id,"record_status"=>1])
            ->order(['fid'=>'desc'])
            ->find();

            /* 获取腾讯云视屏接口 */
            $play_url_tow=[];
            if(!empty($video_info[0]['fileid'])){
                $video_capture=video_edit($video_info[0]['fileid']."&infoFilter.0=transcodeInfo",'GetVideoInfo');
                if($video_capture['code']==0){
                    $video_url=isset($video_capture['transcodeInfo']['transcodeList'])?$video_capture['transcodeInfo']['transcodeList']:"";
                    if(!empty($video_url)){
                        foreach($video_url as $v){
                            $play_url_tow[]=base64_encode($v['url']);
                        }
                    }
                }
            }
            //var_dump($play_url_tow);die;
            if (empty($play_url_tow)) {
                //  $play_url['play_url'] = base64_encode(URL.$play_url['play_url']);
                $play_url_tow[] = base64_encode(URL.$play_url['play_url']);
            }

            if ($result==0) {
                $play_url_data = [
                    'code' => '410',
                    'msg' => '可试看5分钟',
                    'data'=>$play_url_tow
                ];
            }else{
	            $play_url_data = [
	                'code'=>'200',
	                'data'=>$play_url_tow,
	                'msg'=>'获取成功'
	            ];
            }
            $play_info = Db::table('video_play_info')
            ->where(['record_status'=>1,'video_id'=>$video_id,'product_id'=>$training_id,'creator_id'=>$uid])
            ->find();
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                'data' => [
                    'video_info' => $video_info[0],
                    'expert_list' => $video_expert,
                    'video_list' => $section,
                    'comment_list' => $comment,
                    'play_url' => $play_url_data,
                    'play_info'=>$play_info
                ]
            ];
        }else{
            $data = [
                'code' => '414',
                'msg' => '数据不存在',
            ];
        }
       echo json_encode($data);exit;
    }    
//     /**
//     * 录播地址
//     */
//    public function VideoUrl(){
//        $params = request()->param();
//        $uid =isset($params['uid'])?$params['uid']:0;
//        $video_id =isset($params['video_id'])?$params['video_id']:0;

//        //判断是否有权限播放      
//        $results = Db::query("call p_play_authority($uid,$video_id,2)");
//        $result = $results[0][0]['result'];
       
//        if ($result==0) {
//            $data = [
//                'code' => '410',
//                'msg' => '无权播放',
//            ];
//            echo json_encode($data);exit;
//        }

//        $play_url = Db::table("v_video_url")
//        ->where(["video_id"=>$video_id,"record_status"=>1])
//        ->order(['fid'=>'desc'])
//        ->find();
//        if (!empty($play_url)) {
//             $play_url['play_url'] = base64_encode($play_url['play_url']);
//        }
//        $data = [
//            'code' => '200',
//            'msg' => '获取成功',
//            'data' => [
//                'play_url' => $play_url
//            ]
//        ];
//       echo json_encode($data);exit;
//    }

    /**
     * 培训评论列表
     */
    public function TrainingCommentList(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $video_id =isset($heard['video_id'])?$heard['video_id']:0;
        $page =isset($heard['page'])?$heard['page']:1;
        $pagesize =isset($heard['pagesize'])?$heard['pagesize']:40;

        $comment = Db::table('v_video_comment')
        ->field('fid,video_id,content,user_name,nick_name,app_image_url,web_image_url,praise_num,create_time')
        ->where(['record_status'=>1,'video_id'=>$video_id,'check'=>1])
        ->order(['fid'=>'asc'])
        ->limit(($page-1)*$pagesize,$pagesize)
        ->select();
        
        if (count($comment)>0){
	        foreach ($comment as &$vo){
	            $comment_detail = Db::table('video_comment_detail')
	            ->where(['record_status'=>1,'creator_id'=>$uid,'video_id'=>$video_id,'comment_id'=>$vo['fid']])
	            ->select();
	            if (count($comment_detail)>0){
	            	$vo['is_praise'] = 1;
	            }else{
	            	$vo['is_praise'] = 0;
	            }
	        }
        }
        $data = [
            'code' => '200',
            'msg' => '获取成功',
            'data' => $comment
        ];

       echo json_encode($data);exit;
    }

    /**
     * 培训发起评论
     */
    public function TrainingComment(){ 
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $video_id =isset($heard['video_id'])?$heard['video_id']:0;
        $training_id =isset($heard['training_id'])?$heard['training_id']:0;
        $content =isset($heard['content'])?$heard['content']:'';

        //评论权限，用户有权观看时才能评论
        //$results = Db::query("call p_play_authority($uid,$video_id,2)");
        $result=Comment_authority($uid,$training_id,2);
        //echo $result;die;
        if ($result==0) {
            $data = [
                'code' => '410',
                'msg' => '无权评论，请购买后再评论',
            ];
            echo json_encode($data);exit;
        }

        $status=0;
        if (strlen($content)>0) {
            //鉴黄start
            $content =CheckContent($content);
            //鉴黄end
            $data = [
                'video_id' => $video_id,
                'content' => $content,
                'check' => 1,
                'creator_id' => $uid,
                'create_time' => date("Y-m-d H:i:s", time()),
                'updater_id' => $uid
            ];
            $status = Db::table('video_comment_info')->insertGetId($data);
        }else{
            $data = [
                'code' => '410',
                'msg' => '评论失败,必须填写内容',
            ];
            echo json_encode($data);exit;
        }

        if ($status==0) {
            $data = [
                'code' => '410',
                'msg' => '评论失败',
            ];
            echo json_encode($data);exit;
        }

        $comment = Db::table('v_video_comment')
        ->field('fid,video_id,content,user_name,nick_name,app_image_url,web_image_url,praise_num,create_time')
        ->where(['record_status'=>1,'fid'=>$status,'check'=>1])
        ->find();

        if (!empty($comment)) {
            $data = [
                'code' => '200',
                'msg' => '评论成功',
                'data' => $comment
            ];
        }else{
            $data = [
                'code' => '414',
                'msg' => '数据不存在',
            ];
        }
       echo json_encode($data);exit;
    }
    
    /**
     * 培训发起评论点赞
     */
    public function TrainingCommentParise(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $video_id =isset($heard['video_id'])?$heard['video_id']:0;
        $training_id =isset($heard['training_id'])?$heard['training_id']:0;
        $comment_id =isset($heard['comment_id'])?$heard['comment_id']:0;

        if ($uid>0) {
            $comment = Db::table('video_comment_detail')
            ->where(['record_status'=>1,'creator_id'=>$uid,'video_id'=>$video_id,'comment_id'=>$comment_id])
            ->select();
            if (empty($comment)) {
                $comment_data = [
                    'video_id' => $video_id,
                    'comment_id' => $comment_id,
                    'creator_id' => $uid,
                    'create_time' => date("Y-m-d H:i:s", time())
                ];
                Db::table('video_comment_detail')->insert($comment_data);
                $data = [
                    'code' => '200',
                    'msg' => '点赞成功'
                ];
            }else{
                $data = [
                    'code' => '200',
                    'msg' => '已点过赞'
                ];
            }
        }else{
            $data = [
                'code' => '414',
                'msg' => '需要用户登录，请登录后重试',
            ];
        }
       echo json_encode($data);exit;
    }
    /**
     * 录播播放地址 A
     */
    public function PlayUrl(){
        $params = request()->param();
        $uid =isset($params['uid'])?$params['uid']:0;
        $video_id =isset($params['video_id'])?$params['video_id']:0;
        $training_id =isset($params['training_id'])?$params['training_id']:0;

        //判断是否有权限播放      
        $result=Comment_authority($uid,$training_id,2);
        if ($result==0) {
            $data = [
                'code' => '410',
                'msg' => '无权播放',
            ];
            echo json_encode($data);exit;
        }

        $play_url_list = Db::table("video_url_info")
        ->where(["video_id"=>$video_id,"record_status"=>1])
        ->order(['is_main'=>'desc','fid'=>'desc'])
        ->select();
        if (count($play_url_list)>0) {
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                'data' => [
                    'play_url' => $play_url_list
                ]
            ];
        }else{
            $data = [
                'code' => '414',
                'msg' => '数据不存在',
            ];
        }
       echo json_encode($data);exit;
    }
    /**
     * 保存播放位置
     */
    public function SaveVideoLocation(){
        $heard = request()->param();
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $video_id =isset($heard['video_id'])?$heard['video_id']:0;
        $training_id =isset($heard['training_id'])?$heard['training_id']:0;
        $playback_position =isset($heard['playback_position'])?$heard['playback_position']:0;
        $duration_diff =isset($heard['duration'])?$heard['duration']:0;//本次用掉的时长

        $video_info = Db::table('video_info')->where(['fid'=>$video_id,'record_status'=>1])->find();
        if (!empty($video_info)) {
            $max_time = $video_info['max_time'];//最大播放时长
            $duration = $video_info['duration'];//视频时长
            $video_play = Db::table('video_play_info')->where(['video_id'=>$video_id,'product_id'=>$training_id,'record_status'=>1])->find();
            $cur_duration = $duration_diff + (isset($video_play['cur_duration']) ? $video_play['cur_duration'] : 0);

            $play_finish=0;
            if (!empty($video_play) && $video_play['play_finish']!=1){
                var_dump($playback_position/$duration);die;
                $play_finish = $playback_position/$duration > 0.95 ? 1 : 0;
            }
            $play_data = [
                'product_id'=>$training_id,
                'video_id'=>$video_id,
                'duration'=>$max_time,
                'cur_duration'=>$cur_duration,
                'playback_position'=>$playback_position,
                'play_finish'=>$play_finish,
                'creator_id'=>$uid
            ];
            if (!empty($video_play)) {
                Db::table('video_play_info')->where('fid',$video_play['fid'])->update($play_data);
            }else{
                $play_data['creator_id'] = $uid;
                $play_data['create_time'] = date("Y-m-d H:i:s", time());
                Db::table('video_play_info')->insert($play_data);
            }
            $result=Comment_authority($uid,$training_id,2);
            if ($result==0 && $cur_duration>=$max_time) { 
                $data = [
                    'code'=>'411',
                    'msg'=>'已超出您的播放权限'
                ];
                echo json_encode($data);exit;
            }

        }
        $data = [
            'code'=>'200',
            'msg'=>'可以继续播放'
        ];
        echo json_encode($data);exit;
    }
    /**
     * 获取考试信息
     */
    public function TrainingExam(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $training_id =isset($heard['training_id'])?$heard['training_id']:0;
        $exam_id =isset($heard['exam_id'])?$heard['exam_id']:0;

        $exam_info = Db::table('exam_info')->where(['fid'=>$exam_id,'record_status'=>1])->find();
        $exam_subject_list = Db::table('exam_subject_info')->where(['exam_id'=>$exam_id,'record_status'=>1])->select();
        $exam_option_list = Db::table('exam_option_info')->where(['exam_id'=>$exam_id,'record_status'=>1])->select();

        if (!empty($exam_info)) {
            if (count($exam_subject_list)>0) {
                $subject_list = [];
                foreach ($exam_subject_list as &$subject) {
                    $option_list = [];
                    foreach ($exam_option_list as $option) {
                        if ($subject['fid']==$option['subject_id']) {
                            $option_list[] = $option;
                        }
                    }
                    $subject['option_list'] = $option_list;
                    $subject_list[] = $subject;
                }
                $exam_info['subject_list'] = $subject_list;

                $data = [
                    'code' => '200',
                    'msg' => '获取成功',
                    'data' => [
                        'exam_info' => $exam_info
                    ]
                ];
            }else{
                $data = [
                    'code' => '413',
                    'msg' => '试题不存在',
                ];
            }
        }else{
            $data = [
                'code' => '414',
                'msg' => '考试不存在',
            ];
        }
       echo json_encode($data);exit;
    }
    /**
     * 上传考试信息 提交考卷
     * exam_id
     * subject_id
     * option_ids
     */
    public function TrainingUpload(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $uid =isset($heard['uid'])?$heard['uid']:0;
        $exam_id =isset($heard['exam_id'])?$heard['exam_id']:0;
        $exam_data =isset($heard['exam_data'])?$heard['exam_data']:'';

        $subject_list = json_decode(htmlspecialchars_decode($exam_data),true);
        $exam_info = Db::table('exam_info')->where(['fid'=>$exam_id,'record_status'=>1])->find();

        Db::startTrans();
        try {
            //生成考试结果
            $result_id = 0;

            if (count($subject_list)>0 && !empty($exam_info)) {
                $user_score = 0;
                $right_num = 0;
                $wrong_num = 0;
                foreach ($subject_list as $subject) {
                    $subject_id = $subject['subject_id'];
                    $option_ids = $subject['option_ids'];
                    $subject_info = Db::table('exam_subject_info')->where(['fid'=>$subject_id,'record_status'=>1])->find();
                    $option_list = Db::table('exam_option_info')
                    ->where(['subject_id'=>$subject_id,'record_status'=>1])
                    ->order(['fid'=>'desc'])
                    ->select();
                    $right_options = '';
                    foreach ($option_list as $option) {
                        if ($option['correct']==1) {
                            $right_options .= $option['fid'].',';
                        }
                    }
                    $option_ids = $option_ids.',';
                    if ($option_ids==$right_options) {
                        #回答正确
                        $user_score = $user_score + $subject_info['score'];
                        $right_num = $right_num + 1;
                    }else{
                        #回答错误
                        $wrong_num = $wrong_num + 1;
                    }
                }

                $result_data = [
                    'exam_id' => $exam_id,
                    'score_total' => $exam_info['score_total'],
                    'score_pass' => $exam_info['score_pass'],
                    'score_user' => $user_score,
                    'right_num' => $right_num,
                    'wrong_num' => $wrong_num,
                    'pass' => $user_score>=$exam_info['score_pass'] ? 1 : 0,
                    'creator_id' => $uid,
                    'create_time' => date("Y-m-d H:i:s", time())
                ];
                $result_id = Db::name('exam_result_info')->insertGetId($result_data);
            
                //填写考试记录表
                $subjects = [];
                foreach ($subject_list as $subject) {
                    $subject_id = $subject['subject_id'];
                    $option_ids = $subject['option_ids'];
                    $subject_data = [
                        'exam_id' => $exam_id,
                        'result_id' => $result_id,
                        'subject_id' => $subject_id,
                        'option_ids' => $option_ids,
                        'creator_id' => $uid,
                        'create_time' => date("Y-m-d H:i:s", time()),
                        'updater_id' => $uid
                    ];
                    $subjects[] = $subject_data;
                }
                Db::table('exam_record_info')->insertAll($subjects);
                $data = [
                    'code' => '200',
                    'msg' => '提交成功',
                    'data' => $result_data
                ];
            }else {
                $data = [
                    'code' => '422',
                    'msg' => '提交失败',
                ];
            }
            Db::commit();
        } catch (\Exception $e) {
            logs($e->getMessage());
            // 回滚事务
            Db::rollback();
            $error_msg = $e->getMessage();
            $data = [
                'code' => '413',
                'msg' => '提交失败,'.$error_msg
            ];
        }
       echo json_encode($data);exit;
    }    

    
    /**
     * 直播产品包详情
     */
    public function LivingDetail(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $living_id =isset($heard['living_id'])?$heard['living_id']:0;

        $living = Db::query("call p_living_detail($living_id)");
        $living_info = isset($living[0]) ? $living[0] : [];
        $living_video = isset($living[1]) ? $living[1] : [];
        //返回直播状态
        foreach($living_video as &$v){
            //1 未开始 2 已结束 3 直播中 4 断开 5 禁播
            $status=4;
            $date=date("Y-m-d H:i:s");
            $start=$v['start_date'];
            $end=$v['end_date'];
            $ss=live_status("DescribeLiveStreamState",$v['fid']);
            if($start>$date){
                $status=1;
            }else if($v['end_date']<$date){
                $status=2;
            }else if($start<$date && $end<$date && $ss=="active"){
                $status=3;
            }else if($start<$date && $end<$date && $ss=="inactive"){
                $status=4;
            }else if($start<$date && $end<$date && $ss=="forbid"){
                $status=5;
            }
            $v['live_status'] =$status; 
        }
        $living_expert = isset($living[2]) ? $living[2] : [];
        if (!empty($living_info)) {
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                'data' => [
                    'living_info' => $living_info[0],
                    'expert_list' => $living_expert,
                    'video_list' => $living_video
                ]
            ];
        }else{
            $data = [
                'code' => '414',
                'msg' => '数据不存在',
            ];
        }
       echo json_encode($data);exit;
    }

    /**
     * 录播产品包收藏
     */
    public function TrainingCollect(){
        // $heard=$this->getAllHeaders();
        $heard = request()->param();
        $training_id =isset($heard['training_id'])?$heard['training_id']:0;
        $uid =isset($heard['uid'])?$heard['uid']:0;

        $collect = Db::table('product_collect_info')->where(['record_status'=>1,'product_id'=>$training_id,'creator_id'=>$uid])->find();
        if (empty($collect)) {
            $collect_data = [
                'product_id'=>$training_id,
                'product_type'=>2,
                'create_time'=>date("Y-m-d H:i:s", time()),
                'creator_id' => $uid
            ];
            Db::table('product_collect_info')->insert($collect_data);
            $data = [
                'code' => '200',
                'msg' => '收藏成功',
            ];
        }else{
            $data = [
                'code' => '410',
                'msg' => '您已收藏',
            ];
        }
       echo json_encode($data);exit;
    }
}      