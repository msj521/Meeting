<?php
namespace app\admin\Controller;

use app\admin\common\Base;
use think\Db;
use think\Model;

class Meet extends Base {

    /**
     * @var \think\Request Request实例
     */
     protected $request;
     protected $table;
     protected $tabletow;
     protected $path;
     protected $return;
     protected $edit;
     protected $update;
     protected $del;
     protected $two;
 
     protected function _initialize() {
        parent::_initialize();
        $this->path=$this->request->path();
        $this->title=get_menu_title(request()->path());
        $this->assign("title", $this->title);
        $this->assign("UID", fid);
		Admin_Login(fid);
        switch($this->path){
            case "meet/index";
            case "meet/edit";
            case "meet/switch";
            case "meet/update";
            case "meet/del";
                $this->table="v_convention";
                $this->tabletow="convention_info";
                $this->return="/meet/index";
                $this->edit="/meet/edit";
                $this->update="/meet/update";
                $this->del="/meet/del";
                break;
			/* 会议报名 */
            case "meet/sign_cnf";
                $this->table="v_convention";
                $this->return="/meet/sign_cnf";
                break;
            /* 会议室 */     
            case "meet/room";
            case "meet/edit_room";
            case "meet/update_room";
            case "meet/del_room";
                $this->table="convention_room_info";
                $this->tabletow="convention_room_info";
                $this->return="/meet/room";
                $this->edit="/meet/edit_room";
                $this->update="/meet/update_room";
                $this->del="/meet/del_room";
                $this->two="E";
                break;
            /* 会议日程 */     
            case "meet/agenda";
            case "meet/edit_agenda";
            case "meet/update_agenda";
            case "meet/del_agenda";
                $this->table="v_convention_schedulefirst";
                $this->tabletow="convention_schedulefirst_info";
                $this->return="/meet/agenda";
                $this->edit="/meet/edit_agenda";
                $this->update="/meet/update_agenda";
                $this->del="/meet/del_agenda";
                $this->two="F";
                break;
            /* 会议时间日程 */     
            case "meet/time_agenda";
            case "meet/time_edit_agenda";
            case "meet/time_update_agenda";
            case "meet/time_del_agenda";
                $this->table="v_convention_schedulesecond";
                $this->tabletow="convention_schedulesecond_info";
                $this->return="/meet/time_agenda";
                $this->edit="/meet/time_edit_agenda";
                $this->update="/meet/time_update_agenda";
                $this->del="/meet/time_del_agenda";
				$this->two="M";
                break;
            /*企业*/
            case "meet/exh";
            case "meet/edit_exh";
            case "meet/update_exh";
            case "meet/del_exh";
                $this->table="v_convention_exhibitor";
                $this->tabletow="convention_exhibitor_info";
                $this->return="/meet/exh";
                $this->edit="/meet/edit_exh";
                $this->update="/meet/update_exh";
                $this->del="/meet/del_exh";
                $this->two ="K";
                break;
            /* 会议新闻 */     
            case "meet/news";
            case "meet/edit_news";
            case "meet/update_news";
            case "meet/del_news";
                $this->table="convention_news_info";
                $this->tabletow="convention_news_info";
                $this->return="/meet/news";
                $this->edit="/meet/edit_news";
                $this->update="/meet/update_news";
                $this->del="/meet/del_news";
                $this->two ="P";
                break;
            /* 会议直播 */     
            case "meet/live";
            case "meet/edit_live";
            case "meet/update_live";
            case "meet/del_live";
                $this->table="v_convention_live_info";
                $this->tabletow="convention_live_info";
                $this->return="/meet/live";
                $this->edit="/meet/edit_live";
                $this->update="/meet/update_live";
                $this->del="/meet/del_live";
                $this->two ="H";
                break;
            /* 系统消息 */    
            case "meet/notice";
            case "meet/edit_notice";
            case "meet/update_notice";
            case "meet/del_notice";
                $this->table="convention_notice_info";
                $this->tabletow="convention_notice_info";
                $this->return="/meet/notice";
                $this->edit="/meet/edit_notice";
                $this->update="/meet/update_notice";
                $this->del="/meet/del_notice";
                $this->two ="L";
                break;
            /* 阅读记录 */    
            case "meet/notice_detail";
            case "meet/del_notice_detail";
                $this->table="v_convention_notice_detail";
                $this->tabletow="convention_notice_detail";
                $this->return="/meet/notice_detail";
                $this->del="/meet/del_notice_detail";
                break;
			/* 照片墙列表 */   
            case "meet/photo";
            case "meet/del_photo";			
            case "meet/edit_photo";
            case "meet/update_photo";
                $this->table="v_convention_photo_info";
                $this->tabletow="convention_photo_info";
                $this->return="/meet/photo";
				$this->del="/meet/del_photo";
                $this->update="/meet/update_photo";
                $this->edit="/meet/edit_photo";
                $this->two ="I";
                break;
            /* 照片墙点赞记录 */    
            case "meet/photo_detail";
            case "meet/del_photo_detail";
                $this->table="convention_photo_detail";
                $this->tabletow="convention_photo_detail";
                $this->return="/meet/photo_detail";
                $this->del="/meet/del_photo_detail";
                break;
            /* 播客 */    
            case "meet/podcast";
            case "meet/del_podcast";
                $this->table="v_convention_podcast";
                $this->tabletow="convention_podcast_info";
                $this->return="/meet/podcast";
                $this->del="/meet/del_podcast";
                $this->two ="J";
                break;
            /* 回复播客记录 */    
            case "meet/podcast_comment";
            case "meet/del_podcast_comment";
                $this->table="v_convention_podcast_comment";
                $this->tabletow="convention_podcast_comment";
                $this->return="/meet/podcast_comment";
                $this->del="/meet/del_podcast_comment";
				$this->two ="J";
                break;
            /* 荣誉与剪影 */    
            case "meet/honor";
            case "meet/edit_honor";
            case "meet/update_honor";
            case "meet/del_honor";
                $this->table="v_convention_history_info";
                $this->tabletow="convention_history_info";
                $this->edit="/meet/edit_honor";
                $this->update="/meet/update_honor";
                $this->return="/meet/honor";
                $this->del="/meet/del_honor";
                $this->two ="ZX";   
                break;  
            /* 报名配置 */
            case "meet/sign";
            case "meet/edit_sign";
            case "meet/update_sign";
            case "meet/del_sign";
                $this->table="convention_sign_info";
                $this->tabletow="convention_sign_info";
                $this->edit="/meet/edit_sign";
                $this->update="/meet/update_sign";
                $this->return="/meet/sign";
                $this->del="/meet/del_sign";
                $this->two ="ZS";
                 break;
            /* 门票类型 */
            case "meet/ticket";
            case "meet/edit_ticket";
            case "meet/update_ticket";
            case "meet/del_ticket";
                $this->table="convention_sign_ticket";
                $this->tabletow="convention_sign_ticket";
                $this->edit="/meet/edit_ticket";
                $this->update="/meet/update_ticket";
                $this->return="/meet/ticket";
                $this->del="/meet/del_ticket";
                $this->two ="ZK";
                 break;
            /* 报名记录 */
            case "meet/signup";
                $this->table="v_convention_signup_detail";
                $this->tabletow="convention_signup_info";
                $this->return="/meet/signup";
                $this->two ="ZJ";
                break;
            /* 报名详情 */
            case "meet/meeting_order";
			case "meet/edit_signup";
            case "meet/update_signup";
			case "meet/del_signup";			
                $this->return="/meet/meeting_order";
				$this->edit="/meet/edit_signup";
                $this->update="/meet/update_signup";
                $this->del="/meet/del_signup";
                $this->table="v_meeting_order";
				$this->tabletow="convention_signup_info";
				$this->two ="ZWS";
                break;
			/* 报名订单信息 */
            case "meet/signup_detail";
                $this->return="meet/signup_detail";
                $this->table="v_convention_sign_detail";
                $this->tabletow="convention_sign_detail";
                break;
            /* 会议食宿 */     
            case "meet/article";
                $this->table="v_convention";
                $this->tabletow="v_convention";
                $this->return="/meet/article";
                break;         
            case "meet/update_article";
                $this->table="convention_article_info";
                $this->tabletow="convention_article_info";
                $this->return="/meet/article";
                $this->update="/meet/update_article";
                break;              
            case "meet/filed";
                $this->table="v_convention";
                $this->return="/meet/filed";
                break;
			//摘要及全文	
			case "meet/paper";
            case "meet/edit_paper";
            case "meet/update_paper";			
            case "meet/del_paper";
                $this->table="v_paper_abstract";
                $this->tabletow="convention_paper_abstract";
                $this->return="/meet/paper";
                $this->edit="/meet/edit_paper";
                $this->update="/meet/update_paper";				
                $this->del="/meet/del_paper";
                $this->two ="PR";
                break;
			//摘要作者	
			case "meet/author";
            case "meet/edit_author";
            case "meet/update_author";			
            case "meet/del_author";
                $this->table="v_paper_author";
                $this->tabletow="convention_paper_author";
                $this->return="/meet/author";
                $this->del="/meet/del_author";
                $this->edit="/meet/edit_author";
                $this->update="/meet/update_author";				
                $this->two ="PA";
                break;  
            /* 会议资料上传 */                   
            case "meet/uploads";
            case "meet/edit_uploads";
            case "meet/update_uploads";
            case "meet/del_uploads";
                $this->table="v_convention_download";
                $this->tabletow="convention_download_info";
                $this->return="/meet/uploads";
                $this->edit="/meet/edit_uploads";
                $this->update="/meet/update_uploads";
                $this->del="/meet/del_uploads";
                $param=request()->param();
                if(isset($param['B1']) && empty($param['B1'])){
                    $theme="会议通知";
                    $download_type=1;
                    $this->two ="B1";
                }elseif(isset($param['B2']) && empty($param['B2'])){
                    $theme="会议课件";
                    $download_type=2;
                    $this->two ="B2";
                }elseif(isset($param['B3']) && empty($param['B3'])){
                    $theme="论文集";
                    $download_type=3;
                    $this->two ="B3";
                }elseif(isset($param['B4']) && empty($param['B4'])){
                    $theme="资料汇编";
                    $download_type=4;
                    $this->two ="B4";
                }elseif(isset($param['B5']) && empty($param['B5'])){
                    $theme="企业交流手册";
                    $download_type=5;
                    $this->two ="B5";
                }elseif(isset($param['B6']) && empty($param['B6'])){
                    $theme="展区布置图";
                    $download_type=6;
                    $this->two ="B6";
                }elseif(isset($param['B7']) && empty($param['B7'])){
                    $theme="证书模板";
                    $download_type=7;
                    $this->two ="B7";
                }else{
                    $theme="会议管理";
                    $download_type=isset($param['download_type'])?$param['download_type']:0;
                }
                $fid=isset($param['fid'])?$param['fid']:'';
                $this->assign("fids", $fid);
                $this->assign("theme", $theme);
                $this->assign("download_type",$download_type);
                break;            
        }

        $this->assign("index", $this->return);
        $this->assign("edit", $this->edit);
        $this->assign("update", $this->update);
        $this->assign("del", $this->del);
     }
	 
	 
	//会议报名相关统计 
	function  Sign_Cnt($data){

		$all_cnt=0;//报名总数
		$all_scnt=0;//报名成功数
		$all_money=0;//报名总金额
		$all_alpay=0;//报名支付宝总金额
		$all_acpay=0;//报名公账总金额
		//var_dump($data);
		$where="1=1 and record_status=1 and convention_id=47";
		
		if (!empty($data["start_time"]) && !empty($data["end_time"])) {
			$where.=" AND `update_time` BETWEEN ' ".$data["start_time"]." ' AND ' ".$data["end_time"]." ' ";
		}
		
		if (!empty($data["bill_status"])){
            $where.=" AND `bill_status` =".$data["bill_status"];
		}		
	
		if (!empty($data["pay_number"])){
			$where.=" AND `pay_number` =".$data["pay_number"];
		}
			   
		if (!empty($data["pay_status"])){
			$where.=" AND `pay_status` =".$data["pay_status"];
		}	
		
		if (!empty($data["pay_type"])){
			$where.=" AND `pay_type` =".$data["pay_type"];
		}
		$sql="
		SELECT COUNT(*) as all_cnt,
			(SELECT COUNT(*) FROM `v_meeting_order` where $where and pay_status=2) as all_scnt,
			(SELECT sum(actual_pay) FROM `v_meeting_order` where $where and pay_status=2) as all_money, 
			(SELECT sum(actual_pay) FROM `v_meeting_order` where $where and pay_type=5 and pay_status=2) as all_alpay,
			(SELECT sum(actual_pay) FROM `v_meeting_order` where $where and pay_type=1 and pay_status=2) as all_acpay 
		FROM `v_meeting_order` where $where ";
		
		//echo $sql;
		$request= Db::query($sql);
		$request= $request[0];
		//var_dump($request);
		$this->assign("all_cnt",$request['all_cnt']);
        $this->assign("all_scnt", $request['all_scnt']);
        $this->assign("all_money",$request['all_money']);
        $this->assign("all_alpay", $request['all_alpay']);
        $this->assign("all_acpay",$request['all_acpay']);
	}
	 
	 
    /**
     * @return string|void
     * 会议管理 | 会议列表
     */
    public function Index() {

        $where = array();
        $string = '';
        $start = "";
        $end = "";
        $class_id = "";
        $exh = '';
        $fid = 0;
        $exhibitor = array();
        $where_exh=[];
        $check = "";
        $special_id = "";
        $author_name = "";
        $pay_status = "";
        $pay_type = "";
        $pay_number = "";
        $bill_status  = "";
        $data = array_filter($_GET);
		//暂时使用评优报名状态查询
		$sign_control="";
        //$where['record_status']=1;
        if (!empty($data)) {
            $string = isset($data['string']) ? $data['string'] : "";
            $start = isset($data['start_time']) ? $data['start_time'] : "";
            $end = isset($data['end_time']) ? $data['end_time'] : "";
            $class_id = isset($data['class_id']) ? $data['class_id'] : "";
            $exh = isset($data['exh']) ? $data['exh'] : "";
            $check= isset($data['check']) ? $data['check'] : "";
            $special_id= isset($data['special_id']) ? $data['special_id'] : "";
            $author_name= isset($data['author_name']) ? $data['author_name'] : "";
            $pay_status= isset($data['pay_status']) ? $data['pay_status'] : "";
            $pay_type= isset($data['pay_type']) ? $data['pay_type'] : "";
            $pay_number= isset($data['pay_number']) ? $data['pay_number'] : "";
            $bill_status = isset($data['bill_status'])? $data['bill_status']: "";

            if ($start && $end && ($this->table!="v_convention_signup_detail" && $this->table!="v_meeting_order")) {
                $where["start_time"] =array('>', $start);
                $where["end_time"] = array('<', $end);
            }
            if ($class_id) {
                $where["class_id"] = $class_id;
            }

            if ($check){
                $where["check"] =$check;
            }            
			
			if ($bill_status){
                $where["bill_status "] =$bill_status ;
            }		
			
			if ($pay_number){
                $where["pay_number"] =$pay_number;
            }
			
            if ($special_id){
                $where["special"] =$special_id;
            }		
			           
			if ($pay_status){
                $where["pay_status"] =$pay_status;
            }	

			if ($pay_type){
                $where["pay_type"] =$pay_type;
            }		
			
            if ($author_name){
				$like = array('like', "%" . $author_name . "%");
                $where["author_name"] =$like;
            }

            if ($string || $exh) {
                $key = table_key($this->table);
                //var_dump($key);
                if(!empty($key) && $string){
                    $like = array('like', "%" . $string . "%");
                    $where[$key] = $like;
                }

                if(!empty($key) && $exh){
                    $like = array('like', "%" . $exh . "%");
                    $where[$key] = $like;
                }
                
            }

            $fid = isset($data['fid']) ? $data['fid']:0;
            $convention_id = $fid?$fid:(isset($data['convention_id']) ? $data['convention_id']:47);
            $room_id=isset($data['room_id'])?$data['room_id']:0;
            /* 会议室ID */
            $this->assign("room_id", $room_id);
            $this->assign("convention_id", $convention_id);
            $this->assign("fid", $fid);

            //会议主键ID
            if(!empty($this->two) && $fid){
                $where['convention_id']=$fid;
            }

            if($this->table=="convention_photo_detail" && $convention_id){
                $where['photo_id']=$convention_id;
            }else if($this->table=="v_convention_notice_detail" && $convention_id){
                $where['notice_id']=$convention_id; 
            }else if($this->table=="v_convention_download" && $convention_id){
                if(preg_match('/\d+/',$this->two,$arr))
                    if(isset($arr[0]) && $arr[0]==3){
                        $where="(download_type=3 or download_type=7) and convention_id=$convention_id";
                        //$where="(download_type=3) and convention_id=$convention_id";
                    }else{
                        $where['download_type']=$arr[0];
                    }
            }else if($this->table=="v_convention_schedulesecond" && $convention_id){
				$convention_id = isset($data['convention_id']) ? $data['convention_id']:0;
				$where['schedulefirst_id']=$fid;
				$where['convention_id']=$convention_id;
				$this->assign("convention_id", $convention_id);
            }else if($this->table=="v_convention_schedulefirst" && $convention_id){
				$where['convention_id']=$convention_id;
            }else if($this->table=="v_convention_sign_detail"){
				$arr=explode(",",$fid);
				if(count($arr)==3){
					$where['signup_id']=$arr[0];
					$where['creator_id']=$arr[1];
					$where['convention_id']=$arr[2];
				}
            }else if($this->table=="v_convention_podcast_comment"){
				$where['podcast_id']=$fid;
				$where['convention_id']=47;
            }else if($this->table=="v_paper_author"){
				//作者信息
				$where['abstract_id']=$fid;
				$where['convention_id']=47;
            }else if($this->table=="v_convention_signup_detail" || $this->table=="v_meeting_order"){
				if($start&&$end){
					$where['update_time']= array('between',"$start,$end");
				}
				self::Sign_Cnt($data);
			}

            if ($this->two=="K") {
                /*排除会议存在商家*/
                $FOrgID =Db::table($this->table)
                    ->where(["convention_id"=>$convention_id,'record_status'=>1])
                    ->column('org_id');
                $where_exh['fid'] = array('not in', $FOrgID);
                $like = array('like', "%" . $string . "%");
                $where_exh['org_name'] = $like;
                $where_exh['type'] = 2;
                $where['record_status']=1;
                $exhibitor = $this->sific_list($where_exh,"base_org_conf");
            }
        }

        /*审核状态*/
        $check_status = check_status(-1);
        $this->assign("check_status", $check_status);
		
		//有关导出
		if(isset($_GET['export_id']) && $_GET['export_id']>0){
			//会议报名导出
			Excel($_GET);
		}elseif(isset($_GET['_id']) && $_GET['_id']>0){
			//摘要作者导出
			Abstract_Export($_GET);
		}elseif(isset($_GET['_ids']) && $_GET['_ids']>0){
			//全文导出
			Paper_Export($_GET);
		}elseif(isset($_GET['_idss'])){
			//摘要导出
			//Send_Report(10,$_GET);
		}elseif(isset($_POST['_send'])){
			//发送摘要审核邮件
			//Send_Report(6,$_POST);
		}			

		//只显示年会
		if(empty($this->two)){
		  $where['fid']=47;  
		}
		
        $list = $this->sific_list($where,$this->table);
		//echo Db::table($this->table)->getLastSql();
        /* 获取报名后自定义字段的内容处理 */
        if($this->table=="v_convention_sign_detail" && count(explode(",",$fid))==3){
            $list = Db::table("$this->table")
                ->where($where)
                ->order('fid', "desc")
                ->select();
            foreach($list as &$vo){
                if($vo['fid']){
                    $filed = Db::table("convention_sign_detail")
                    ->where('fid',$vo['value'])
                    ->value("detail_name");
                    $vo['value']=empty($filed)?"否":$filed;
                }
            }
            //ar_dump( $list);die;
        }
        
        $count = count($list);
        $this->assign("list", $list);
        $this->assign("start", $start);
        $this->assign("end", $end);
        $this->assign("class_id", $class_id);
        $this->assign("exhibitor", $exhibitor);
        $this->assign("check", $check);
        $this->assign("special_id", $special_id);
        $this->assign("author_name", $author_name);
        $this->assign("pay_status", $pay_status);
        $this->assign("pay_type", $pay_type);
        $this->assign("pay_number", $pay_number);
        $this->assign("bill_status",$bill_status);
		//会议报名-摘要及全文-参加评选统计
		if($this->table=="v_paper_abstract"){
			$where['yes_no']=2;
			$yes_yes =Db::table("v_paper_abstract")->where($where)->select();
			$this->assign("yes_yes",COUNT($yes_yes));
		}
        
        /* 会议类别 */
        $meet=classify(7);
        $this->assign("meet", $meet);
        /* 摘要及全文所属专题 */
        $special=classify(11);
        $this->assign("special", $special);
        return $this->fetch("$this->return", ['cnt' => $count, 'string' => $string,'exh' => $exh]);
    }

    /**
     * 会议管理 | 会议编辑
     */
    public function Edit() {
        $param = $this->request->param(true);
        $fid=isset($param['fid'])?$param['fid']:0;
        $fmid=isset($param['fmid'])?$param['fmid']:0;
        $paper_id=isset($param['paper_id'])?$param['paper_id']:0;
        $convention_id=isset($param['convention_id'])?$param['convention_id']:0;
		
        $list = $this->sific_edit($this->table);

        if(isset($list['web_image_id'])){
            $list['image_url'] =SourceInfo($list['web_image_id'],1);
        }
		
		if(isset($list['app_image_id'])){
            $list['image_urls'] =SourceInfo($list['app_image_id'],1);
        }
		
		if(isset($list['top_image_url'])){
            $list['top_image_url'] =SourceInfo($list['top_image_id'],1);
        }

        /* 多图片处理 */
        if($list && isset($list['image_ids'])){
            $arr_image=[];
            $image_ids=explode(",",$list['image_ids']);
            foreach($image_ids as $v){
                $arr_image[]=SourceInfo_tow($v,1);
            }
            $this->assign("arr_image", $arr_image);
        }

        //会议直播
        if ($this->table=="v_convention_live_info"){
            $live =Db::table("live_info")
                ->where(["class_id"=>1151,'record_status'=>1])
                ->field('fid,class_id,title')
                ->select();
            $this->assign("live", $live);
        }

        $this->assign("list", $list);

        /* 荣誉与剪影 */
        $history_type=history_type(-1);
        $this->assign("history_type", $history_type);

        if($convention_id && request()->path()=='meet/edit_honor'){
            $honor =Db::table("convention_info")
                ->where("fid",$convention_id)
                ->field('convention_name,start_time,end_time,address')
                ->find();
            $start="";    
            $end="";    
            if(count($honor)==4){
                $start=date("Y年m月d日",strtotime($honor['start_time']));
                $end=date("d日",strtotime($honor['end_time']));
            }

            $honor['description']="大会时间：$start-$end   |   会场地址：".$honor['address'];  
            $this->assign("honor", $honor);
        }

        /* 会议类型 */
        $meet=classify(7);
        $this->assign("meet", $meet);

        /* 摘要及全文所属专题 */
        $special=classify(11);
        $this->assign("special", $special);

        //参展商
        $exhibitor_type=exhibitor_type(-1);
        $this->assign("exhibitor_type", $exhibitor_type);

        //会议室
        $room=Db::table("convention_room_info")
            ->where(['convention_id'=>$convention_id,'record_status'=>1])
            ->field('fid,room_name')
            ->select();
        $this->assign("room", $room);

        //会议报名
        $option_list=Db::table("convention_sign_detail")
            ->where(['convention_id'=>$convention_id,'signup_id'=>$fid,'record_status'=>1])
            ->select();
        $this->assign("option_list",  json_encode($option_list));


        //专家列表
        $expert_list=Db::table("base_expert_info")
        ->where(["record_status"=>1])
        ->field('fid,expert_name')
        ->select();
        $this->assign("expert_list", $expert_list);

        //角色列表
        $role_list=classify(8);
        $this->assign("role_list", $role_list);
		
        /* 日程人员列表 渲染*/
        if ($this->table=="v_convention_schedulefirst" || $this->table=="v_convention_schedulesecond"){
			
			$expert_list=explode(",",$list['expert_ids']);
			$base_expert=[];
			foreach($expert_list as $v){
				$base_expert[]=	Db::table("base_expert_info")
					->where('fid',$v)
					->field('fid,expert_name')
					->find();
			}
			
            $role=explode(",",$list['role_ids']);
            $expert_select=[];
            foreach($base_expert as $k=>$v){
                if(!isset($role[$k]))continue;
                $class_con=[];
                $base_class=Db::table("base_class_conf")
                    ->where('fid',$role[$k])
                    ->value('class_name_zh');
                    //echo $v['fid']."----".$role[$k]."<br>";
                    $class_con['expert_id']=$v['fid'];
                    $class_con['expert_name']=$v['expert_name'];
                    $class_con['class_name_zh']=$base_class;
                    $class_con['role_ids']=$role[$k];
                array_push($expert_select,$class_con);
            }

            $this->assign("expert_select", json_encode($expert_select));
        }
        /* 会议FID */
        $this->assign("convention_id", $convention_id);
        /* 一级日程FID */
        $this->assign("fmid", $fmid);
        /* 子集FID */
        $this->assign("fid", $fid);

        $room_id=isset($param['room_id'])?$param['room_id']:0;
        /* 会议室ID */
        $this->assign("room_id", $room_id);
		//摘要-作者编辑
        $this->assign("paper_id",$paper_id);

        switch($param){

            /* 会议内部HTML字段 */
            case isset($param['A']) && empty($param['A']);
            case isset($param['B']) && empty($param['B']);
            case isset($param['C']) && empty($param['C']);
            case isset($param['D']) && empty($param['D']);
            case isset($param['PC']) && empty($param['PC']);
            case isset($param['PY']) && empty($param['PY']);
            case isset($param['WT']) && empty($param['WT']);
            case isset($param['ZA']) && empty($param['ZA']);
                $theme="";
                $filed="";
                if(isset($param['A'])){
                    $theme="重要时间";
                    $filed="important_time";   
                }elseif(isset($param['B'])){
                    $theme="重要日期";
                    $filed="important_date";   
                }elseif(isset($param['C'])){
                    $theme="秘书处";
                    $filed="secretary";   
                }elseif(isset($param['D'])){
                    $theme="交通信息";
                    $filed="transport_info";   
                }elseif(isset($param['PC'])){
                    $theme="对公账户";
                    $filed="public_account";   
                }elseif(isset($param['PY'])){
                    $theme="支付宝支付";
                    $filed="alipay";   
                }elseif(isset($param['WT'])){
                    $theme="微信支付";
                    $filed="wechat";   
                }elseif(isset($param['ZA'])){
                    $theme="注意配置";
                    $filed="take_care";   
                }
                $this->assign("theme", $theme);
                $this->assign("field", $filed);
                $this->assign("result", $list[$filed]);     
                return $this->fetch("meet/switch");
                break;

            /* 会议场所 */
            case isset($param['Z']) || isset($param['X']);
            case isset($param['V']) || isset($param['N']);
            case isset($param['A1']) || isset($param['A2']);

                if(isset($param['Z'])){
                    $theme="关于城市";
                    $article_type=1;
                }elseif(isset($param['X'])){
                    $theme="会场介绍";
                    $article_type=2;
                }elseif(isset($param['V'])){
                    $theme="会议酒店";
                    $article_type=3;
                }elseif(isset($param['N'])){
                    $theme="周边餐饮";
                    $article_type=4;
                }elseif(isset($param['A1'])){
                    $theme="历届简介";
                    $article_type=5;
                }elseif(isset($param['A2'])){
                    $theme="大会征文通知";
                    $article_type=6;
                }

                $this->assign("theme", $theme);
                $this->assign("field", 'content');
                $this->assign("article_type",$article_type);
                $result=$this->get_article($fid,$article_type);
                $content=isset($result['content'])?$result['content']:'';
                $fids=isset($result['fid'])?$result['fid']:'';
                $this->assign("result",$content);
                $this->assign("fid",$fids);
                $this->assign("update", '/meet/update_article');
                return $this->fetch("meet/switch");
                break;
        }

        return $this->fetch("$this->edit");
    }

    /* 获取不同类型下内容 */
    public function get_article($convention_id,$article_type){
        $data=[];
        if(is_null($convention_id) || is_null($article_type)){
            return $data;
        }

        $data= Db::table("convention_article_info")
                ->where(['convention_id'=>$convention_id,'article_type'=>$article_type])
                ->field('fid,content')
                ->find();
        return !empty($data)?$data:$data;  
    }


    /**
     * 会议管理 | 会议添加 更新
     */
    public function Update() {
		
        if ($this->request->isPost()) {
            $data = $this->request->param(true);
            $fid=isset($data['convention_id'])?$data['convention_id']:0;
            $level =$this->tabletow=="convention_schedulefirst_info"?1:2;
            $b=0;
            if ($this->tabletow=="convention_info" && isset($data['convention_name'])) {
                $b=NoRepetition($data['fid'],['convention_name'=>trim($data['convention_name'])],$this->tabletow);
            }

            if($b>0){
                $this->error('名称已存在！');
            }
			
            if(isset($data['web_image_id']) && empty($data['web_image_id'])){
                $this->error("web必须上传");
            }elseif(isset($data['app_image_id']) && empty($data['app_image_id'])){
				$this->error("APP必须上传");
			}elseif(isset($data['top_image_id']) && empty($data['top_image_id'])){
				$this->error("会议头部必须上传");
			}
            $expert_ids ="";
            if ($this->table=="v_convention_schedulefirst" || $this->table=="v_convention_schedulesecond"){
                $expert_ids =isset($_POST['expert_ids']) ? json_decode(htmlspecialchars_decode($_POST['expert_ids']),true) :[];
            }else if ($this->table=="convention_sign_info"){
                $expert_ids =isset($_POST['option_list']) ? json_decode(htmlspecialchars_decode($_POST['option_list']),true) :[];
            }

            $return="$this->return?fid=$fid";
            /* 会议文件上传处理 */
            if ($fid && isset($data['download_type'])){
                $download_type=$data['download_type'];
                $data['download_type']=(empty($data['fid']) && $data['download_type']==3)?7:$data['download_type'];
                $return="/meet/uploads?fid=$fid&B$download_type";
            }elseif ($fid && $this->table=="v_convention_schedulesecond"){
                $schedulefirst_id=$data['schedulefirst_id'];
                $return="/meet/time_agenda?fid=$schedulefirst_id&convention_id=$fid&room_id=".$data['room_id'];
            }elseif ($fid && $this->table=="v_convention_schedulefirst"){
                $return="/meet/agenda?fid=$fid&F=0";
            }elseif ($fid && isset($data['P'])){
                $return="/meet/news?fid=$fid&P=0";
            } elseif (isset($data['paper_id'])&&$this->tabletow=="convention_paper_author"){
                $return="/meet/author?fid=".$data['paper_id'];
            }elseif (isset($data['public_account']) || isset($data['alipay']) || isset($data['wechat'])  || isset($data['take_care'])){
                $return="/meet/sign_cnf";
            }

            /* 会议时间日程 */
            if ($this->tabletow=="convention_schedulefirst_info" || $this->tabletow=="convention_schedulesecond_info") {
                $arr= [];
                $role_ids= [];
                foreach ($expert_ids as $key => $value) {
                    $arr[]=$value['expert_id'];  
                    $role_ids[]=$value['role_ids'];  
                }
                $data['expert_ids']=implode(",",$arr);
                $data['role_ids']=implode(",",$role_ids);
                //var_dump($arr,$role_ids,$data['expert_ids'],$data['role_ids']);die;
            }

            /* 会议报名明细 */
            if ($this->table=="convention_sign_info" && $fid && isset($data['field_type']) && $data['field_type']!=1) {
                $arr= [];
                foreach ($expert_ids as $key => $value) {
                    if($value['fid']<0) continue;
                    $arr[]=$value['fid'];
                }
                $datas['fid']=implode(",",$arr);
                Db::table('convention_sign_detail')
                    ->where(['convention_id'=>$fid,'signup_id'=>$data['fid']])
                    ->whereNotIn('fid',$datas['fid'])
                    ->delete();
            }
			
            $status = $this->sific_update($data,$this->tabletow);
			//echo Db::table($this->tabletow)->getLastSql();die;
			/*年会报名审核发邮件*/
			if($this->path=="meet/update_signup" && !empty($data["creator_id"]) && !empty($data["pay_status"])){
				$param=['convention_id'=>$fid,'uid'=>$data["creator_id"]];
				$order_status=1;
				if($data["pay_status"]==2){
					$order_status=2;
				}
				//审核不通过更新订单状态同时发送邮件
				Db::table('convention_order_info')->where(['convention_id'=>$fid,'creator_id'=>$data["creator_id"]])->update(['order_status'=>$order_status]);	
				
				// if($data["pay_status"]==2){
					// Send_Report(3,$param);
				// }else{
					// Send_Report(4,$param);
				// }
			}

            if ($status) {
                //会议报名 明细处理
                if (count($expert_ids)>0 && $this->table=="convention_sign_info") {
                    foreach ($expert_ids as $key => $value) {
                        $tmp = [];
                        if(empty($value['detail_name'])) continue;
                        if(isset($value['fid']) && $value['fid']>0){
                            $tmp = HandleParamsForInsert('convention_sign_detail',$value);
                            $tmp['updater_id']=fid?fid:1;
                            Db::table('convention_sign_detail')->where("fid",$value['fid'])->setField($tmp);
                        }else{
                            $tmp['convention_id'] =$fid;
                            $tmp['detail_name'] = $value['detail_name'];
                            $tmp['signup_id'] =$data['fid']?$data['fid']:$status;
                            $tmp['creator_id'] =fid?fid:1;
                            $tmp['sort'] =$value['sort'];
                            $tmp['create_time'] =date("Y-m-d H:i:s",time());
                            Db::table('convention_sign_detail')->insertGetId($tmp);
                        }
                    }
                }
				
				//照片墙后台上传处理
				if($this->path=="meet/update_photo" && $this->tabletow=="convention_photo_info"){
					if(!empty($data['image_ids'])){
						$image_arr=explode(",",$data['image_ids']);
						$one=array();
						$tow=array();
						foreach($image_arr as $v){
							$photo_id=Db::table('convention_photo_list')->where("app_image_id",$v)->find();
							if(empty($v) || !empty($photo_id)) continue;
							$one['app_image_id']=$v;
							$one['check']=2;
							$one['photo_id']=empty($data['fid'])?$status:$data['fid'];
							$one['convention_id']=$data['convention_id'];
							$tow[]=$one;
						}
						Db::table('convention_photo_list')->insertAll($tow);
					}
				}

                //echo Db::table('convention_sign_detail')->getLastSql();
                echo "<script>var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);parent.window.location.href='$return';</script>";
                exit;
            } else {
                $this->error("表单提交失败~~1");
            }
        } else {
            $this->error("表单提交失败~~2");
        }
    }


    /**
     * 会议管理 |删除
     */
     public function Delete() {
        $data = $this->request->param(true);
        $fid=isset($data['fid'])?$data['fid']:'';

        //审核处理
        if(isset($data['type']) && isset($data['check']) &&  $data['type']==5 && !empty($fid)){
            $status = $this->sific_update($data,$this->tabletow);
            return $status;
        }

        //报名记录标记删除同时删除 报名自定字段
        if(!empty($data['type'])  && !empty($data['creator_id']) && $this->tabletow=='convention_signup_info'){
			$where=['creator_id'=>$data['creator_id'],'convention_id'=>$data['convention_id']];
            Db::table("convention_signup_detail")->where($where)->delete();
			//报名记录标记删除同时删除 摘要及全文作者
			Db::table("convention_paper_abstract")->where($where)->delete();
			Db::table("convention_paper_author")->where($where)->delete();
        }elseif($this->tabletow=='convention_paper_abstract'){
            //摘要删除同时删除 作者
			Db::table("convention_paper_author")->where(['abstract_id'=>$fid])->delete();
        }elseif($this->tabletow=='convention_photo_info' && empty($data['photo_id'])){
            //照片墙图片处理
			Db::table("convention_photo_list")->where(['photo_id'=>$fid])->delete();
        }
		
		//删除照片墙图片类别
		if(!empty($data['photo_id']) && !empty($data['type'])){
			//删除
			if($data['type']==1){
				Db::table("base_source_info")->where(['fid'=>$data['photo_id']])->delete();
				$status = Db::table("convention_photo_list")->where(['photo_id'=>$fid,'app_image_id'=>$data['photo_id']])->delete();
			}
			//审核
			if($data['type']==2){
				Db::table("base_source_info")->where(['fid'=>$data['photo_id']])->update(['record_status'=>1]);
				$status = Db::table("convention_photo_list")->where(['photo_id'=>$fid,'app_image_id'=>$data['photo_id']])->update(['check'=>2]);
			}
        }else{
			$status = $this->sific_delete($data,$this->tabletow);
		}
		
        return $status;
    }
}

