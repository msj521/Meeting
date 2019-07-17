<?php
namespace app\api\controller;

use think\Db;
use think\Model;
use think\Request;
use app\api\common\Base;
use app\api\model\AppInfo;

class Sys extends Base {
	
	/**
	*评优报名列表拼接
	*/
	public function implodes($data){
		$str="";
		if(!empty($data)){
			foreach($data as $k=>$v){
				$str.=implode(",",$data[$k])."||";
			}
		}
		return $str;
	}
	
    public function signDetail(){
		$param=request()->param();
		$param=array_filter($param);
		//找到当前脚本所在路径
		$path = dirname(__FILE__); 
		//引入IOFactory.php 文件里面的PHPExcel_IOFactory这个类
		import('PHPExcel.Classes.PHPExcel');
		import('PHPExcel.Classes.PHPExcel.IOFactory.PHPExcel_IOFactory');
		$PHPExcel = new \PHPExcel();
		$PHPSheet = $PHPExcel->getActiveSheet();
		$PHPSheet->setTitle("报名列表");
		$PHPSheet->setCellValue("A1","医院名称");
		$PHPSheet->setCellValue("B1","医院等级");
		$PHPSheet->setCellValue("C1","*床位数");
		$PHPSheet->setCellValue("D1","*联系人");
		$PHPSheet->setCellValue("E1","*联系人电话");
		$PHPSheet->setCellValue("F1","联系人邮箱");
		$PHPSheet->setCellValue("G1","医院感染管理部门成立日期");
		$PHPSheet->setCellValue("H1","团队成员");

		$PHPSheet->setCellValue("I1","4.医院感染专职人员组成及专业");
		$PHPSheet->setCellValue("J1","5.参会情况");
		$PHPSheet->setCellValue("K1","6.2015年1月至今发表的文章列表");
		$PHPSheet->setCellValue("L1","7.员工担任医院感染控制相关学会委员");
		$PHPSheet->setCellValue("M1","8.省级以上培训班讲课");
		$PHPSheet->setCellValue("N1","9.参编过感控相关专著的列表");
		$PHPSheet->setCellValue("O1","10.SIFIC平台中获得荣誉、投稿或任职情况");
		$PHPSheet->setCellValue("P1","11.突出亮点事项");
		$PHPSheet->setCellValue("Q1","附件下载");
		
		$cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
		'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
		$i=2;
        $list = Db::table('v_convention_sign_control')->select();
        $arr = [];
        foreach ($list as $vo) {
            $hospital_name=json_decode(str_replace('&quot;','"',$vo['hospital_name']),true);
            $contact=json_decode(str_replace('&quot;','"',$vo['contact']),true);
            $establishment=json_decode(str_replace('&quot;','"',$vo['establishment']),true);
            $team_members=json_decode(str_replace('&quot;','"',$vo['team_members']),true);
			
            $profession=json_decode(str_replace('&quot;','"',$vo['profession']),true);
            $profession=self::implodes($profession);
			
            $training_status=json_decode(str_replace('&quot;','"',$vo['training_status']),true);
			$training_status=self::implodes($training_status);

            $article_author=json_decode(str_replace('&quot;','"',$vo['article_author']),true);
			$article_author=self::implodes($article_author);
			
            $part_time=json_decode(str_replace('&quot;','"',$vo['part_time']),true);
			$part_time=self::implodes($part_time);
			
            $thematic_report=json_decode(str_replace('&quot;','"',$vo['thematic_report']),true);
			$thematic_report=self::implodes($thematic_report);
			
            $monograph_list=json_decode(str_replace('&quot;','"',$vo['monograph_list']),true);
			$monograph_list=self::implodes($monograph_list);
			
            $Honor=json_decode(str_replace('&quot;','"',$vo['Honor']),true);
			$Honor=self::implodes($Honor);
			
            $highlight_event=$vo['highlight_event'];
			
            $file_id=json_decode(str_replace('&quot;','"',$vo['file_id']),true);
            $sort=json_decode(str_replace('&quot;','"',$vo['sort']),true);
            $update_time=json_decode(str_replace('&quot;','"',$vo['update_time']),true);    
    
            $data = [
                '医院名称'=>$hospital_name['hospitalName'],
                '医院等级'=>$hospital_name['hospitalDec'],
                '床位数'=>$hospital_name['bedNum'],
                '联系人'=>$contact['contact_people'],
                '联系人电话'=>$contact['contact_phone'],
                '联系人邮箱'=>$contact['contact_email'],
                '医院感染管理部门成立日期'=>$establishment,
                '团队成员'=>$team_members,
				
                '人员组织及专业'=>$profession,
                '参加培训情况'=>$training_status,
                '文章作者信息'=>$article_author,
                '常委学术兼职'=>$part_time,
                '专题报告'=>$thematic_report,
                '专著列表'=>$monograph_list,
                '荣誉'=>$Honor,
                '突出亮点事项'=>$highlight_event
            ];
            //$arr[] = $data;

            $PHPSheet->setCellValue('A'.$i,''.$hospital_name['hospitalName'].'');
            $PHPSheet->setCellValue('B'.$i,''.$hospital_name['hospitalDec'].'');
            $PHPSheet->setCellValue('C'.$i,''.$hospital_name['bedNum'].'');
            $PHPSheet->setCellValue('D'.$i,''.$contact['contact_people'].'');
            $PHPSheet->setCellValue('E'.$i,''.$contact['contact_phone'].'');
            $PHPSheet->setCellValue('F'.$i,''.$contact['contact_email'].'');
            $PHPSheet->setCellValue('G'.$i,''.$establishment.'');
            $PHPSheet->setCellValue('H'.$i,''.$team_members.'');
				
			$PHPSheet->setCellValue("I".$i,''.$profession);
			$PHPSheet->setCellValue("J".$i,''.$training_status);
			$PHPSheet->setCellValue("K".$i,''.$article_author);
			$PHPSheet->setCellValue("L".$i,''.$part_time);
			$PHPSheet->setCellValue("M".$i,''.$thematic_report);
			$PHPSheet->setCellValue("N".$i,''.$monograph_list);
			$PHPSheet->setCellValue("O".$i,''.$Honor);
			$PHPSheet->setCellValue("P".$i,''.$highlight_event);
			$URL="http://2019.sific.com.cn".$vo['file_path'];
			$PHPSheet->setCellValue("Q".$i,''.$vo['file_name']);
			$PHPSheet->getCell("Q".$i)->getHyperlink()->setUrl($URL);
			//$PHPSheet->getActiveSheet()->getCell(‘E26′)->getHyperlink()->setUrl(‘http://www.phpexcel.net’);
			
            $i++;
        }
		//var_dump($arr);die;
        ob_end_clean();//清除缓冲区,避免乱码
        $filename="SIFIC".date("Y");
        $filename=$filename."评优报名.xlsx";
        $PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel,"Excel2007");
        header("Content-Disposition: attachment;filename=$filename");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //表示在$path路径下面生成demo.xlsx文件
        $PHPWriter->save("php://output");die;
        echo json_encode($arr);
    }
	
	/*
	*追梦之星数据导出
	*/
	public function signDetails(){
		$param=request()->param();
		$param=array_filter($param);
		//找到当前脚本所在路径
		$path = dirname(__FILE__); 
		//引入IOFactory.php 文件里面的PHPExcel_IOFactory这个类
		import('PHPExcel.Classes.PHPExcel');
		import('PHPExcel.Classes.PHPExcel.IOFactory.PHPExcel_IOFactory');
		$PHPExcel = new \PHPExcel();
		$PHPSheet = $PHPExcel->getActiveSheet();
		$PHPSheet->setTitle("报名列表");
		$PHPSheet->setCellValue("A1","姓名");
		$PHPSheet->setCellValue("B1","性别");
		$PHPSheet->setCellValue("C1","会员名");
		$PHPSheet->setCellValue("D1","单位名称");
		$PHPSheet->setCellValue("E1","会员等级");
		$PHPSheet->setCellValue("F1","在线时长");
		$PHPSheet->setCellValue("G1","单位地址");
		$PHPSheet->setCellValue("H1","入职日期");
		$PHPSheet->setCellValue("I1","出生日期");
		$PHPSheet->setCellValue("J1","职务");
		$PHPSheet->setCellValue("K1","职称");
		$PHPSheet->setCellValue("L1","单位级别");
		$PHPSheet->setCellValue("M1","医院床位");
		$PHPSheet->setCellValue("N1","邮箱");
		$PHPSheet->setCellValue("O1","手机");
		
		$PHPSheet->setCellValue("P1","1.杂志发表");
		$PHPSheet->setCellValue("Q1","2.课题研究");
		$PHPSheet->setCellValue("R1","3.专题报告");
		$PHPSheet->setCellValue("S1","4.编著列表");
		$PHPSheet->setCellValue("T1","5.荣誉任职情况");
		$PHPSheet->setCellValue("U1","6.推荐人信息");
		$PHPSheet->setCellValue("V1","7.评价");
		$PHPSheet->setCellValue("W1","8.附件下载");
		
		$cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
		'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
		$i=2;
        $list = Db::table('v_convention_sign_excellent')->select();
        $arr = [];
        foreach ($list as $vo) {
			$apply_region=json_decode(str_replace('&quot;','"',$vo['apply_region']),true);
			//$apply_region=self::implodes($apply_region);
			//var_dump($apply_region);die;
            $apply_magazine=json_decode(str_replace('&quot;','"',$vo['apply_magazine']),true);
			$apply_magazine=self::implodes($apply_magazine);
			
            $apply_project_research=json_decode(str_replace('&quot;','"',$vo['apply_project_research']),true);
			$apply_project_research=self::implodes($apply_project_research);
			
            $apply_paper=json_decode(str_replace('&quot;','"',$vo['apply_paper']),true);
			$apply_paper=self::implodes($apply_paper);
			
            $apply_compilation=json_decode(str_replace('&quot;','"',$vo['apply_compilation']),true);
			$apply_compilation=self::implodes($apply_compilation);
			
            $apply_honor_history=json_decode(str_replace('&quot;','"',$vo['apply_honor_history']),true);
			$apply_honor_history=self::implodes($apply_honor_history);
			
            $apply_recommend_info=json_decode(str_replace('&quot;','"',$vo['apply_recommend_info']),true);
			$apply_recommend_info=self::implodes($apply_recommend_info);
			
            $PHPSheet->setCellValue('A'.$i,''.$vo['apply_name'].'');
            $PHPSheet->setCellValue('B'.$i,''.$vo['apply_sex'].'');
            $PHPSheet->setCellValue('C'.$i,''.$vo['apply_sific_name'].'');
            $PHPSheet->setCellValue('D'.$i,''.$vo['apply_company'].'');
            $PHPSheet->setCellValue('E'.$i,''.$vo['apply_member_level'].'');
            $PHPSheet->setCellValue('F'.$i,''.$vo['apply_online_time'].'');
            $PHPSheet->setCellValue('G'.$i,''.$vo['apply_online_time'].'');
            $PHPSheet->setCellValue('H'.$i,''.$vo['apply_entry_date'].'');
			$PHPSheet->setCellValue("I".$i,''.$vo['apply_birthday'].'');
			$PHPSheet->setCellValue("J".$i,''.$vo['apply_job'].'');
			$PHPSheet->setCellValue("K".$i,''.$vo['apply_title'].'');
			$PHPSheet->setCellValue("L".$i,''.$vo['apply_company_level'].'');
			$PHPSheet->setCellValue("M".$i,''.$vo['apply_bed_num'].'');
			$PHPSheet->setCellValue("N".$i,''.$vo['apply_email'].'');
			$PHPSheet->setCellValue("O".$i,''.$vo['apply_phone'].'');
			
			
			
			$PHPSheet->setCellValue("P".$i,''.$apply_magazine.'');
			$PHPSheet->setCellValue("Q".$i,''.$apply_project_research.'');
			$PHPSheet->setCellValue("R".$i,''.$apply_paper.'');
			$PHPSheet->setCellValue("S".$i,''.$apply_compilation.'');
			$PHPSheet->setCellValue("T".$i,''.$apply_honor_history.'');
			$PHPSheet->setCellValue("U".$i,''.$apply_recommend_info.'');
		
			$PHPSheet->setCellValue("V".$i,''.$vo['apply_evaluate'].'');
			$URL="http://2019.sific.com.cn".$vo['file_path'];
			$PHPSheet->setCellValue("W".$i,''.$vo['file_name']);
			$PHPSheet->getCell("W".$i)->getHyperlink()->setUrl($URL);

            $i++;
        }
		//var_dump($arr);die;
        ob_end_clean();//清除缓冲区,避免乱码
        $filename="SIFIC".date("Y");
        $filename=$filename."追梦之星.xlsx";
        $PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel,"Excel2007");
        header("Content-Disposition: attachment;filename=$filename");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //表示在$path路径下面生成demo.xlsx文件
        $PHPWriter->save("php://output");die;
        echo json_encode($arr);
    }
    
    /**
     * @return string|void
     * 版本检测接口
     */
    public function version_check() {
        $user_id = $this->request->get('user_id');
        $version = $this->request->get('version');
        $type = $this->request->get('type');
        
        $enduser_info = Db::table('enduser_info')->where(['fid'=>$user_id,'record_status'=>1])->find();
        $org_id = $enduser_info['org_id'];

        $version_new_list = [];
        //验证是否有可用的新版本
        $version_old = Db::table('version_info')->where(['type'=>$type,'version_no'=>$version,'status'=>1])->find();
        if (!empty($version_old)) {
            $version_id = $version_old['fid'];
            $version_list = Db::query('select * from version_info where type=$type and status=1 and fid>$version_id order by fid desc');     
            $version_ids = []; 
            if (count($version_list)>0) {
                foreach ($ver as $vo) {
                    $version_ids[] = $vo['fid'];
                }
                $version_dl_list = Db::table('version_dl_info')->wherein('version_id',$version_ids)->select();
                if (count($version_dl_list)>0) {
                    foreach ($version_dl_list as $version) {
                        $version_org_id = $version['org_id'];
                        $version_user_id = $version['user_id'];
                        $start_time = $version['start_time'];
                        $end_time = $version['end_time'];
                        $force_type = $version['force_type'];
                        $flag = false;
                        if ($version_org_id=0) {
                            # 所有人都可以下载
                            $flag = true;
                        }else if ($version_org_id>0 && $version_user_id=0){
                            # 指定部门的所有人员可以下载
                            $flag = true;
                        }else if ($version_org_id>0 && $version_user_id>0){
                            # 指定部门的指定人员可以下载
                            $flag = true;
                        }
                        if ($flag) {
                            $version_info = [
                                'force_type' => $version['force_type'],
                                'dl_pass' => $version['dl_pass'],
                                'memo' => $version['memo']
                            ];
                            $version_new_list[] = $version_info;
                        }
                    }
                }
            }

        }

        $data = [
            'code' => '200',
            'msg' => '获取成功',
            'data' => [
                'version_list' => $version_new_list
            ]
        ];
        echo  json_encode($data);exit;
    }

    /* 平台声明 */
    public function Explain(){
        $type = $this->request->get('type');
        if(empty($type) || !$type || $type!="sific"){
            $data = [
                'code' => '410',
                'msg' => '获取失败'
            ];
        }else{
            $explain_list=Db::table('base_explain_info')->where(['record_status'=>1])->find();
            $data = [
                'code' => '200',
                'msg' => '获取成功',
                'data' => [
                    'explain_list' => $explain_list
                ]
            ];
        }
        echo  json_encode($data);exit;
    }
    
}      