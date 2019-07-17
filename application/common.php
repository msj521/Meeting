<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Db;
use think\Model;
use think\Request;
use think\Log;
use \think\Exception;
use app\api\model\AppInfo;
use app\api\model\LogTerminalInfo;
use app\api\model\LogServiceRuntime;
use app\api\model\LogLogin;
use app\api\model\LogAppUx;
use app\api\model\LogApiCall;
use think\Config;
use think\Debug;
use Vod\VodApi;

/**
 * 列表参数解析
 */
function Querys($Query) {
    $data = array();
    if (is_array($Query)) {
        foreach ($Query as $k => $v) {
            $Left = $v['Left'];
            $Logic = $v['Logic'];
            $Right = $v['Logic'] == "like" ? "%" . $v['Right'] . "%" : $v['Right'];
            $data[$Left] = [$Logic, $Right];
        }
    }
    return $data;
}

/**
 * 请求日志
 */
function RequestLog($type, $content) {
    $dir = $_SERVER['DOCUMENT_ROOT'] . '/request_logs/';
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $filename = $dir. 'sific_log.txt';
    if (!file_exists($filename)) {
        touch($filename);
    }
    $ip = $_SERVER['REMOTE_ADDR'];
    $url = "http://api.map.baidu.com/location/ip?ak=2TGbi6zzFm5rjYKqPPomh9GBwcgLW5sS&ip={$ip}&coor=bd09ll";//新浪借口获取访问者地区
    $arr=json_decode(file_get_contents($url),true);
    $address=isset($arr['content']['address'])?$arr['content']['address']:"";
    $Ts = fopen($filename, "a+");
    fputs($Ts, "操作者：".user_name. "\r\n" ."操作IP地址：".$ip."----".$address. "\r\n" ."执行类型：$type". "\r\n" ."执行日期：".date('Y-m-d H:i:s') . "\n" . "操作内容：" . var_export($content, true). "\r\n\r\n");
    fclose($Ts);
}

/**
 * @param $class_type
 * 获取基础分类
 */
function classify($class_type) {
    $where = 'record_status=1';
    if ($class_type > 0) {
        $where .= " and class_type=" . $class_type;
        $data = Db::table('base_class_conf')
            ->where($where)
            ->field("fid,class_name_zh")
            ->order("sort desc")
            ->select();

    }else {
        $data = [];
    }
    return$data;
}

/**
 * @param $fid 
 * 获取基础分类
 */
function classify_name($fid) {
    $where = 'record_status=1';
    if($fid>0) {
        $where .= " and fid=" . $fid;
        $data = Db::table('base_class_conf')
            ->where($where)
            ->field("class_name_zh")
            ->find();
    }else {
        $data = [];
    }
    return $fid>0 && isset($data['class_name_zh'])?$data['class_name_zh']:$data;
}

/**
 * 错误日志
 */
function logs($e) {
    $path = request()->path();
    return "错误地址：" . $path . "---错误信息：" . $e;
}

/**
 * 批量处理ImageUrl
 */
function HandleImageUrl($data, $key) {
    $api_url = config('api_url');
    $newdata = [];
    if ($data) {
        foreach ($data as $val) {
            $val[$key] = $api_url . $val[$key];
            $newdata[] = $val;
        }
    }
    return $newdata;
}

/**
 * 处理单个ImageUrl
 */
function HandleImageUrl_Single($data, $key) {
    $api_url = config('api_url');
    if ($data) {
        $data[$key] = $api_url . $data[$key];
    }
    return $data;
}

/**
 *判断字段是否存在
 */
function Exists($param, $table) {
    $exist = array();
    //var_dump(!empty($exist));exit;
    $len = count($param);
    if ($len > 0) {
        $key = array_keys($param)[0];
        $sql = "Describe $table $key";
        $exist = Db::query($sql);
    }
    return !empty($exist) ? $exist : 0;
}

/**
 * $file
 * 上传图片
 */
function uploads($file) {
    $file_patch = '';
    if ($file) {
        //上传的时候的原文件名
        $dir = ROOT_PATH . 'public/uploads'; // 自定义文件上传路径
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $map = [
            'ext' => 'jpg,jpeg,png,gif,mp4,rm,rmvb,mpeg1-4,mov,mtv,dat,wmv,avi,3gp,amv,dmv,flv',
            'size' => 300000000
        ];
        $info = $file->validate($map)->move($dir); // 将文件上传指定目录
        //获取文件的路径
        $file_patch = str_replace('\\', '/', $info->getSaveName());
    }
    return $file_patch;
}



/**
 * $user_id 用户ID
 * $where 初始查询条件
 * $pid 初始查询条件
 * 根据用户ID查询后台管理的菜单
 */
function menu_for_user($user_id = 0,$where=[],$pid=0) {
    $menu_all = Db::table('base_menu_info')->where($where)->order('sort asc')->select();
    if ($user_id <0) {
        $userrolegroup = Db::table('t_sys_userrolegroup')->where('user_id', $user_id)->select();
        $group_list = [];
        foreach ($userrolegroup as $key => $value) {
            array_push($group_list, $value['FRoleGroupID']);
        }
        $module = Db::table('t_sys_rolegroup_detail')->DISTINCT(true)->field("FModuleID")->wherein('FRoleID', $group_list)->select();
        $module_list = [];
        foreach ($module as $key => $value) {
            array_push($module_list, $value['FModuleID']);
        }
        $menu_origin = Db::table('base_menu_info')->wherein('fid', $module_list)->select();
        $menu_user = [];
        foreach ($menu_all as $key => $value) {
            $flag = findParentTree($menu_all, $value, $menu_origin);
            if ($flag) {
                array_push($menu_user, $value);
            }
        }

        // echo Db::table('t_sys_rolegroup_detail')->getLastSql();EXIT;
        // var_dump(json_encode($menu_user) );die;

        $menu_all = $menu_user;
    }
    $treemenu = getTree($menu_all, $pid);

    if (isset($treemenu[0])){
        $content="
        <div class='left-nav'>
          <div id='side-nav'>
            <ul id='nav'>
                <ul class='sub-menu'>";
        menu_splice($treemenu,$content);
        $content.="     </ul>
                    </ul>
                </div>
                </div>";
    }else{
        $content = '您没有菜单权限';
    }

    return $content;
}

//树形图递归
/**
 * @param $data 数据源
 * @param $pid 上级ID的字段名
 * @return array|string 根据用户ID查询后台管理的菜单
 */
function getTree($data, $pid) {
    $tree = [];
    foreach ($data as $k => $v) {
        if ($v['pid'] == $pid) {        //父亲找到儿子
            if (array_key_exists('children', $v)) {
            } else {
                $v['children'] = [];
            }
            $child = getTree($data, $v['fid']);
            $v['children'] = $child ? $child : [];
            $tree[] = $v;
        }
    }
    return $tree;
}
//拼接菜单结构
function menu_splice($menus,&$content){
    foreach($menus as $vo) {
        $route=isset($vo['route']) ? $vo['route'] : 'javascript:;';
        $name=$vo['menu_name'];
        $children=$vo['children'];
        $icon = isset($vo["icon_cls"]) ? $vo["icon_cls"] : "&#xe6a7;";  //默认icon "<"
        $content .= "<li>
                        <a _href='$route'>
                            <i class='iconfont'>".$icon."</i>
                            <cite>$name</cite>";
        $content .= isset($children[0]) ? "<i class='iconfont nav_right'>&#xe697;</i>" : "";
        $content .= "</a>";
        if (isset($children[0])) {
            $content .= "<ul class='sub-menu'>";
            menu_splice($children,$content);
            $content .= "</ul>";
        }
        $content .= "</li >";
    }
}


/**
 * @param $menu_all 所有数据
 * @param $menu_one 被检查的数据
 * @param &menu_checker 检测核对数据
 * 返回 true是有关联 false 无关联
 */
function findParentTree($menu_all, $menu_one, $menu_checker) {
    foreach ($menu_checker as $k => $v) {
        if ($menu_one['FID'] == $v['FID']) {
            return true;
        }
        foreach ($menu_all as $key => $value) {
            if ($value['FParentID'] == $menu_one['FID']) {
                $flag = findParentTree($menu_all, $value, $menu_checker);
                if ($flag) {
                    return true;
                }
            }
        }
    }
    return false;
}


//把树形结构处理成需要的字段和结构,树形结构用到
function handleTree($menu) {
    $dict = [];
    foreach ($menu as $key => $value) {
        $dic = [];
        $dic['id'] = $value['FID'];
        $dic['name'] = $value['FName'];
        $dic['spread'] = $value['FSpread'] == 1 ? true : false;
        if (!empty($value['FChildren'])) {
            $FChildren = $value['FChildren'];
            $dic['children'] = handleTree($FChildren);
        }
        array_push($dict, $dic);
    }
    return $dict;
}

/**  过滤不属于表字段的数据
 * @param $table  表名称
 * @param $params 匹配前的数据
 * 返回 表字段     匹配后的数据
 */
function HandleParamsForInsert($table, $params) {
    $data = Db::query("select COLUMN_NAME from information_schema.COLUMNS where table_name = '$table';");
    $new = [];
    foreach ($data as $key => $value) {
        if (array_key_exists($value['COLUMN_NAME'], $params)) {
            $new[$value['COLUMN_NAME']] = $params[$value['COLUMN_NAME']];
        }
    }
    return $new;
}

/**
 * 根据大会父级 ID 获取会议室
 * @param $FParentID
 */
function Get_Room($FParentID) {
    if ($FParentID) {
        $RoomList = Db::table('v_conference_room')
            ->field('FName,FID')
            ->where('FConferenceID', $FParentID)
            ->select();
    } else {
        $RoomList = ["code" => 0, 'msg' => '参数有误~~'];
    }
    return $RoomList;
}


function path() {
    return request()->get();
}






/**
 * @param $start 2018-06-18 13:00:00
 * @param $date 2018-06-18 15:00:00
 * 日期类型处理 两个日期处理成 2018-06-18 13:00-15:00
 */
function date_to_datediff($start,$end){
    $start_tamp = strtotime($start);
    $end_tamp = strtotime($end);
    $start_date = date('Y-n-j H:i',$start_tamp);
    $end_date = date('H:i',$end_tamp);

    return $start_date.'-'.$end_date;
}


//树形图递归
function getCityTree($data, $pId){
    $tree = [];
    foreach($data as $k => $v)
    {
        if($v['pid'] == $pId)
            {        //父亲找到儿子
                if (array_key_exists('children', $v)) {
                }else{
                    $v['children']=[];
                }
                $child =getCityTree($data, $v['fid']);
                $v['children'] = $child ? $child : [];
                $tree[] = $v;
            }
        }
        return $tree;
}

//处理ImageUrl
function Handleurl($data,$key){
    if($data){
        foreach($data as $val){
           $val[$key] = URL.$val[$key];
           $newdata[] = $val;
        }       
    }else{
        $newdata = [];
    }
    return $newdata;
}


/*==============================================直播相关接口=======================================================*/
function getPushUrl($bizId, $streamId, $key=null, $time=null){
    if ($key && $time) {
        $txTime = strtoupper(base_convert(strtotime($time), 10, 16));
        //txSecret = MD5( KEY + livecode + txTime )
        //livecode = bizid+"_"+stream_id  如 8888_test123456
        $livecode = $bizId . "_" . $streamId; //直播码
        $txSecret = md5($key . $livecode . $txTime);
        $ext_str = "?" . http_build_query(array(
                "bizid" => $bizId,
                "txSecret" => $txSecret,
                "txTime" => $txTime
            ));
    }
    return "rtmp://" . $bizId . ".livepush.myqcloud.com/live/" . $livecode . (isset($ext_str) ? $ext_str : "");
}
function getPlayUrl($bizId, $streamId){
    $livecode = $bizId . "_" . $streamId; //直播码
    return array(
        "rtmp://liveplay.sific.vip/live/" . $livecode,
        "http://liveplay.sific.vip/live/" . $livecode . ".flv",
        "http://liveplay.sific.vip/live/" . $livecode . ".m3u8"
    );
}
//http://" . $bizId . ".liveplay.myqcloud.com/live/
//在线人数腾讯接口
function People($appid,$inter,$time,$key){
    $sign=md5($key.$time);
    $video_id=file_get_contents("http://statcgi.video.qcloud.com/common_access?cmd=$appid&interface=$inter&t=$time&sign=$sign");
    return $video_id;
}

//获取直播中的列表方法
function Live($appid,$interface,$time,$key){
    $sign=md5($key.$time);
    $video_id=file_get_contents("http://fcgi.video.qcloud.com/common_access?appid=$appid&interface=$interface&t=$time&sign=$sign");

    return $video_id;
}
//浏览次数加一
function add_num($table,$FID){
    $list = Db::table($table)->where('FID',$FID)->select();
    if (isset($list) && isset($list[0]['FNum'])) {
        $data = $list[0];
        $data['FNum'] = $data['FNum']+1;
        Db::table($table)->update($data);
    }
}



/*==============================================api接口=======================================================*/
    /**
	 * 获取app_key app_secret
	 */
	function GetKey(){
		$param=request()->param();//$this->getAllHeaders();
        $param=array_filter($param);
        $error_msg=Config::get('error_msg');
		if(!isset($param['resource'])){
			$data=[
				'code'=>'401',
				'msg'=>$error_msg[401]
			];
		}elseif(!isset($param['type'])){
			$data=[
				'code'=>'402',
				'msg'=>$error_msg[402]
			];
		}elseif(!isset($param['app_name'])){
			$data=[
				'code'=>'403',
				'msg'=>$error_msg[403]
			];
		}elseif(!isset($param['app_type'])){
			$data=[
				'code'=>'404',
				'msg'=>$error_msg[404]
			];
		}elseif(!isset($param['version_id'])){
			$data=[
				'code'=>'405',
				'msg'=>$error_msg[405]
			];
        }
        
        if(count($param)==5){
			$datas=AppInfo::get($param)->field("app_key")->order("fid","desc")->find()->toArray();
			$data=[
				'code'=>'200',
				'msg'=>$error_msg[200],
				'data'=>$datas
			];
		}else{
            $data=[
				'code'=>'406',
				'msg'=>$error_msg[406]
			];
        }
		die(json_encode($data));
    }
    
    /**
	 * 记录智能终端数据日志
     * log_terminal_info
	 */
	function log_terminal_info(){
		$param=request()->param();//$this->getAllHeaders();
        $param=array_filter($param);
        $error_msg=Config::get('error_msg');
        if(empty($param)){
            $data=[
				'code'=>'407',
				'msg'=>$error_msg[407]
            ];
            die(json_encode($data));
        }
        $imei=isset($param['imei'])?$param['imei']:-1;
        try{
            $data=LogTerminalInfo::where(['imei'=>$imei])->find();
            if(empty($data)){
                $param['imei']=$imei;
                $param['model']=2;
                $param['cpu']=3;
                $param['flash']=4;
                $param['content']=5;
                $param['status']=6;
                $param['creator_id']=7;
                $param['create_time']=date("Y-m-d H:i:s");
                LogTerminalInfo::insert($param);
            }
            /* 如果是status=2，则这太智能终端不允许访问系统。 */
            if(isset($data['status']) && $data['status']==2){
                $data=[
                    'code'=>'410',
                    'msg'=>$error_msg[410]
                ];
                die(json_encode($data));
            }else{
                $loginfo=LogTerminalInfo::where(['imei'=>$imei])->update(['update_time'=>date("Y-m-d H:i:s")]);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
	}

    /**
	 * 系统运行日志
     * log_service_runtime
	 */
	function log_service_runtime($param){
        if(empty($param)){
            return false;
        }
        try{
            $interface = [
                'title' => request()->url(),
                'content'    =>$param,
                'elapse'  =>Debug::getRangeTime('begin','end')/1000,
                'create_time'  =>date("Y-m-d H:i:s")
            ];
            LogServiceRuntime::insert($interface);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    
    /**
	 * log_login 
     * 用户登录日志
	 */
	function log_login($param){
        $error_msg=Config::get('error_msg');
        /* 判断是否传参 */
        if(empty($param)){
            $data=[
                'code'=>'409',
                'msg'=>$error_msg[409]
            ];
            die(json_encode($data));
        }

        try{
            /* 查询登录失败次数 */
            $where=['terminal_id'=>1,'region_id'=>2];
            $error_num=Db::table('log_login')
                                ->where($where)
                                ->field("error_num,log_cnt")
                                ->order("fid","desc")
                                ->find();   
            $num=isset($error_num['error_num'])?$error_num['error_num']:0;
            $cnt=isset($error_num['log_cnt'])?$error_num['log_cnt']:1;
            $ip=request()->ip();
            /* 判断是否达到上限 */
            if($param['code']!=200 && isset($error_num['error_num']) && $error_num['error_num']>=3){
                $data=[
                    'code'=>'408',
                    'msg'=>$error_msg[408]
                ]; 
                die(json_encode($data));
            }           
            $interface = [
                'terminal_id'  => 1,
                'region_id'    =>2,
                'login_result' =>$param['code']==200?1:0,
                'error_num'    =>$param['code']==200?0:1,
                'error_limit'  =>3,
                'record_status'=>0,
                'log_cnt'    =>$cnt,
                'log_ip'    =>"$ip",
                'create_time'  =>date("Y-m-d H:i:s")
            ];
            if(empty($error_num)){
                LogLogin::insert($interface);
            }else{
                $array=[
                    'login_result'    =>$param['code']==200?1:0,
                    'error_num'    =>$param['code']==200?0:$num+1,
                    'log_cnt'    =>$cnt+1,
                    'log_ip'    =>"$ip",
                    'create_time'  =>date("Y-m-d H:i:s")
                ];
                LogLogin::where($where)->update($array);
                //echo LogLogin::getLastSql();die;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    

    /**
	 * APP UI交互日志
     * log_app_ux
	 */
	function log_app_ux($param){
        $error_msg=Config::get('error_msg');
        /* 判断是否传参 */
        if(empty($param)){
            $data=[
                'code'=>'409',
                'msg'=>$error_msg[409]
            ];
            die(json_encode($data));
        }
        
        try{
            if(!empty($param)){
                LogAppUx::insert($param);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    
    /**
	 * API运行日志
     * log_api_call
	 */
	function log_api_call($param){
        $error_msg=Config::get('error_msg');
        /* 判断是否传参 */
        if(empty($param)){
            $data=[
                'code'=>'409',
                'msg'=>$error_msg[409]
            ];
            return json_encode($data);
        }
        try{
            if(!empty($param)){
                LogApiCall::insert($param);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
	}

/**
 * @param $type
 * 会议类型
 */
function app_type($type){
    $level="";
    if ($type == -1) {
        $level=[1 => "WEB管理端", 2 => "WEB前端",3=>"APP客户端"];
    } else {
        switch ($type) {
            case 1:
                $level = "WEB管理端";
                break;
            case 2:
                $level = "WEB前端";
                break;
            case 3:
                $level = "APP客户端";
                break;
        }
    }
    return $level;
}

/**
 * @param $type
 *状态
 */
function is_status($type){
    $status="";
    if ($type ==5) {
        $status=[1 => "启用",2=> "禁用",-1 => "标记删除",-2=> "彻底删除"];
    } else {
        switch ($type) {
            case 1:
                $status = "启用";
                break;
            case 2:
                $status = "禁用";
                break;
            case -1:
                $status = "标记删除";
                break;
            case -2:
                $status = "彻底删除";
                break;
        }
    }
    return $status;
}


/**
 * @param $type
 * @return array|string
 */
function is_no($type) {
    if ($type == -1) {
        return [1=>"是",2=>"否"];
    } else {
        return $type == 1 ? "是" : "否";
    }
}

/**
 * @param $type
 * @return array|string
 */
function history_type($type) {
    if ($type == -1) {
        return [1=>"剪影",2=>"荣誉"];
    } else {
        return $type == 1 ? "剪影" : "荣誉";
    }
}

/**
 * @param $type 广告位级别
 * @return array|string
 */
 function adsense_level($type) {
    if ($type == -1) {
        return [1 => "1级", 2 => "2级", 3 => "3级",4=>"4级"];
    } else {
        switch ($type) {
            case 1:
                $level = "1级";
                break;
            case 2:
                $level = "2级";
                break;
            case 3:
                $level = "3级";
                break;
           case 4:
                $level = "4级";
                break;     
        }
        return $level;
    }
}


/**
 * @param $type 广告位几号位
 * @return array|string
 */
function adsense_number($type) {
    if ($type == -1) {
        return [1 => "1号位", 2 => "2号位",3=>"3号位"];
    } else {
        switch ($type) {
            case 1:
                $level = "1号位";
                break;
            case 2:
                $level = "2号位";
                break;   
            case 2:
                $level = "3号位";
                break;   
        }
        return $level;
    }
}

/**
 * @param $type
 * @return array|string
 */
 function banner_type($type) {
    if ($type == -1) {
        return [1 => "首页", 2 => "会议", 3 => "直播" ,4=>"培训" ];
    } else {
        $banner="";
        switch ($type) {
            case 1:
                $banner = "首页";
                break;
            case 2:
                $banner = "会议";
                break;
            case 3:
                $banner = "直播";
                break;
            case 4:
                $banner = "培训";
                break;                
        }
        return $banner;
    }
}


/**
 * @param 获取资源地址
 * @param $fid 资源fid
 * @param $source_type 资源类别
 * @return array|string
 */
function SourceInfo($fid,$source_type) {
	$where=['fid'=>$fid,'source_type'=>$source_type,'record_status'=>"1"];
	$data=Db::table("base_source_info")->where($where)->field('file_path')->find();
	return isset($data['file_path'])?$data['file_path']:"";
}

/**
 * @param 获取资源地址
 * @param $fid 资源fid
 * @param $source_type 资源类别
 * @return array|string
 */
function SourceInfo_tow($fid,$source_type) {
    if ($fid>0) {
        $where=['fid'=>$fid,'source_type'=>$source_type];
        $data=Db::table("base_source_info")->where($where)->find();
        return $data;
    }
}


/**
 * @param 图片上传处理
 * @param $data 数据源
 * @return array|string
 */
function UploadSourceInfo($data) {
    $status=0;
    if (!empty($data)){
        $image_id=isset($data['image_id'])?$data['image_id']:0;
        $data=HandleParamsForInsert('base_source_info',$data);
        if($image_id && $image_id>0) {
            unset($data['fid']);
            $where=['fid'=>$image_id];
            $data['updater_id'] = fid;
            //var_dump($data);die;
            $status=Db::table("base_source_info")->where($where)->setField($data);
        }else{
            $data['create_time'] = date("Y-m-d H:i:s", time());
            $data['creator_id'] = fid;
            $status=Db::name('base_source_info')->insertGetId($data);
        }
    }
    return $status;
}

/**
 * 根据路由PID 获取请求title
 * @param $pid
 * @return mixed|string
 */
function find_menu_title($pid){
    $title='';
    if ($pid) {
        $title=Db::table('base_menu_info')
            ->where('fid',$pid)
            ->field('menu_name')
            ->find();
    }
    return !empty($title['menu_name'])?$title['menu_name']:"";
}
/**
 * 根据路由 获取请求title
 * @param $route
 * @return mixed|string
 */
function get_menu_title($route){
    $title='';
    if (!empty($route)) {
        $title=Db::table('base_menu_info')
            ->where('route',$route)
            ->field('menu_name')
            ->find();
    }
    return !empty($title['menu_name'])?$title['menu_name']:"";
}


/**
 * 获取分类名称
 * @param $ItemId 根据基础分类
 * 基础分类 1.职称 2.学历 3.职业 4.科室 5.直播 6.录播 7.会议 8.会议角色 9.学位
 */
function get_class_type($ItemId) {
    if ($ItemId>0) {
        $class_type="";
        switch($ItemId){
            case 1:
                $class_type="职称";
                break;
            case 2:
                $class_type="学历";
                break;
            case 3:
                $class_type="职业";
                break;
            case 4:
                $class_type="科室";
                break;
            case 5:
                $class_type="直播";
                break;
            case 6:
                $class_type="录播";
                break;
            case 7:
                $class_type="会议";
                break;
            case 8:
                $class_type="日程角色";
                break;
            case 9:
                $class_type="学位";
                break;
            case 10:
                $class_type="职称级别";
				break;
			case 11:
                $class_type="所属专题";
                break;
        }
        return $class_type;
    } else {
        $class_type=[
            1=>"职称",
            2=>"学历",
            3=>"职业",
            4=>"科室",
            5=>"直播",
            6=>"录播",
            7=>"会议",
			8=>"日程角色",
            9=>"学位",
            10=>"职称级别",
            11=>"所属专题",
        ];
        return $class_type;
    }
}

/**
 * @param $type 图片相关资源类
 * @return array|string
 */
function source_type($type){
    //1 代表图片 2 视频 3 音频 4 文档 5 其他
    if ($type>0) {
        $class_type="";
        switch($type){
            case 1:
                $class_type="图片";
                break;
            case 2:
                $class_type="视频";
                break;
            case 3:
                $class_type="音频";
                break;
            case 4:
                $class_type="文档";
                break;
            case 5:
                $class_type="其他";
                break;
        }
        return $class_type;
    } else {
        $class_type=[
            1=>"图片",
            2=>"视频",
            3=>"音频",
            4=>"文档",
            5=>"其他",
        ];
        return $class_type;
    }
}
/**
 * @param $type 
 * @return array|string
 */
function download_type($type){
    //1 会议通知 2 会议课件 3 论文集 4 资料汇编 5 企业交流手册
    if ($type>0) {
        $class_type="";
        switch($type){
            case 1:
                $class_type="会议通知";
                break;
            case 2:
                $class_type="会议课件";
                break;
            case 3:
                $class_type="论文集";
                break;
            case 4:
                $class_type="资料汇编";
                break;
            case 5:
                $class_type="企业交流手册";
                break;
            case 6:
                $class_type="场馆布局图";
                break;
        }
        return $class_type;
    } else {
        $class_type=[
            1=>"会议通知",
            2=>"会议课件",
            3=>"论文集",
            4=>"资料汇编",
            5=>"企业交流手册",
            6=>"场馆布局图",
        ];
        return $class_type;
    }
}

/**
 * @param $type 展位级别
 * @return array|string
 */
function exhibitor_type($type){
    //1 特别支持  2 A级支持 3 B级支持 4 C级支持
    if ($type>0) {
        $class_type="";
        switch($type){
            case 1:
                $class_type="特别支持";
                break;
            case 2:
                $class_type="A级支持";
                break;
            case 3:
                $class_type="B级支持";
                break;
            case 4:
                $class_type="C级支持";
                break;
            case 4:
                $class_type="其他";
                break;
        }
        return $class_type;
    } else {
        $class_type=[
            1=>"特别支持",
            2=>"A级支持",
            3=>"B级支持",
            4=>"C级支持",
            5=>"其他",
        ];
        return $class_type;
    }
}

/**
 * @param $type 终端资源类
 * @return array|string
 */
function resource_type($type) {
    if ($type == -1) {
        return [1=>"内部",2=>"第三方"];
    } else {
        return $type == 1 ? "内部" : "第三方";
    }
}

/**
 * @param $type 产品打包类型
 * @return array|string
 */
function product_type($type) {
    if ($type == -1) {
        return [1=>"直播",2=>"录播"];
    } else {
        return $type == 1 ? "直播" : "直播";
    }
}

/**
 * @param $type 运行系统
 * @return array|string
 */
function sys_type($type) {
    if ($type == -1) {
        return [1=>"android",2=>"ios",3=>"web"];
    } else {
        switch($type){
            case 1:
                $sys_type="android";
                break;
            case 2:
                $sys_type="ios";
                break;
            case 3:
                $sys_type="web";
                break;
        }
        return $sys_type;
    }
}

/**
 * @param $type 升级控制，
 * @return array|string
 */
function version_up_type($type) {
    $sys_type="";
    if ($type == -1) {
        return [
            1=>"登录后不提醒，用户可以在配置管理中自行升级",
            2=>"登录后提醒用户升级，不强制",
            3=>"登陆后强制用户升级"];
    } else {
        switch($type){
            case 1:
                $sys_type="登录后不提醒，用户可以在配置管理中自行升级";
                break;
            case 2:
                $sys_type="登录后提醒用户升级，不强制";
                break;
            case 3:
                $sys_type="登陆后强制用户升级";
                break;
        }
        return $sys_type;
    }
}

/**
 * @param $type 审核
 * @return array|string
 */
 //0 待审核 1 审核通过 2 审核不通
function check_status($type) {
    $status="";
    if ($type == -1) {
        return [
            1=>"待审核",
            2=>"审核通过",
            3=>"审核不通"
        ];
    } else {
        switch($type){
            case 1:
                $status="待审核";
                break;
            case 2:
                $status="审核通过";
                break;
            case 3:
                $status="审核不通";
                break;
        }
        return $status;
    }
}


/**
 * 获取应用信息
 * @param $app_id
 * @return array|string
 */
 function get_app_info($app_id) {

    if($app_id>0){
        $app_info=Db::table("app_info")
            ->where(["record_status"=>1,"fid"=>$app_id])
            ->field('fid,app_name')
            ->find();
    }else{
        $app_info=Db::table("app_info")
            ->where("record_status",1)
            ->field('fid,app_name')
            ->order("fid desc")
            ->select();
    }
    return $app_id>0 && !empty($app_info)?$app_info['app_name']:$app_info;            
}

/**
 * 获取用户信息
 * @param $user_id
 * @param $type
 * @return array|string
 */
 function get_enduser_info($user_id,$type) {
    $table=$type==1?"enduser_info":"user_info";
    
    if($user_id>0){
        $user_info=Db::table("$table")
            ->where(["record_status"=>1,"fid"=>$user_id])
            ->field('fid,user_name')
            ->find();
    }else{
        $user_info=Db::table("$table")
            ->where("record_status",1)
            ->field('fid,user_name')
            ->order("fid desc")
            ->select();
    }
    return $user_id>0 && !empty($user_info)?$user_info['user_name']:$user_info;            
}
/**
 * 获取终端IMEI信息
 * @param $user_id
 * @return array|string
 */
 function get_version_info($version_id) {
    if($version_id>0){
        $version_info=Db::table("version_info")
            ->where(["record_status"=>1,"fid"=>$version_id])
            ->field('fid,version_no,app_type,app_postfix')
            ->find();
    }else{
        $version_info=Db::table("version_info")
            ->where("record_status",1)
            ->field('fid,version_no,app_type,app_postfix')
            ->order("fid desc")
            ->select();
    }
    return $version_id>0 && !empty($version_info)?$version_info['version_no']:$version_info;            
}


/**
 * 获取终端IMEI信息
 * @param $user_id
 * @return array|string
 */
 function get_terminal_info($user_id) {
    if($user_id>0){
        $terminal_info=Db::table("log_terminal_info")
            ->where(["record_status"=>1,"user_id"=>$user_id])
            ->field('fid,imei')
            ->find();
    }else{
        $terminal_info=Db::table("log_terminal_info")
            ->where("record_status",1)
            ->field('fid,imei')
            ->order("fid desc")
            ->select();
    }
    return $terminal_info;            
}

/**
 * @param $table
 * 返回 表字段
 */
 function table_key($table) {
    $values = "";
    if ($table) {
        try {
            $sql = "select DISTINCT(COLUMN_NAME) as names from information_schema.COLUMNS where table_name = '$table' and (COLUMN_TYPE like '%varchar%' or COLUMN_TYPE like '%text%');";
            $data = Db::query($sql);
            if (!empty($data)) {
                $keys = array_values($data);
                foreach ($keys as $v) {
                    $values .= $v['names'] . '|';
                }
            }
            $values .= rtrim($values, '|');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    return $values;
}

/**
 * @param 数据添加标题不允许相同
 * @param $fid  主键ID
 * @param $filed 标题
 * @param $table 操作表
 * @return array|string
 */
function NoRepetition($fid,$filed,$table){
    $status=0;
    if($fid>0){
        $status=Db::table("$table")
            ->where($filed)
            ->whereNotIn('fid',$fid)
            ->find();
    }else{
        $status=Db::table("$table")
            ->where($filed)
            ->find();
    }
    return $status;
}
/* 上传视屏至腾讯云 */
function Upload_tencent($data){
    $secretId = "AKIDQOK4QeTqhXH9mCvqzwwJhtdebaVhlPtr";
    $secretKey = "gFh1AxBNO0xJctzteFfuxpTvBHCyYwEJ";
    if(empty($data) || count($data)!=3){
        $result=['code'=>0,'msg'=>'参数不全'];
    }
    require_once(EXTEND_PATH.'Tencent/cos-sdk-v5/cos-autoloader.php');
    require_once(EXTEND_PATH.'Tencent/qcloudapi-sdk-php/src/QcloudApi/QcloudApi.php');
    require_once(EXTEND_PATH.'Tencent/src/Vod/VodApi.php');
    require_once(EXTEND_PATH.'Tencent/src/Vod/Conf.php');
    VodApi::initConf($secretId,$secretKey);
    $dir =ROOT_PATH. 'public';
    try {
        $result = VodApi::upload(
        array (
            'videoPath' => $dir.$data[0],//视频路径
            'coverPath' => $dir.$data[1],//携带路径
        ),array (
            'videoName' =>$data[2]//视屏名称
            )
        );
    } catch (\Exception $e) {
        $result=$e->getMessage();
    }
    return $result;
}

/**
 * @param 培训获取播放地址 
 * @param $fileId ID 
 * @param $Action 接口名称 
 * 签名-接口回调
 */ 
function video_edit($fileId,$Action){
    $Timestamp=time();
    $rand=rand();
    $secretId = "AKIDQOK4QeTqhXH9mCvqzwwJhtdebaVhlPtr";
    $secretKey = "gFh1AxBNO0xJctzteFfuxpTvBHCyYwEJ";
    $str="/v2/index.php?Action=$Action&Nonce=$rand&Region=ap-shanghai&SecretId=$secretId&Timestamp=$Timestamp&fileId=$fileId"; 
    /* 签名 */
    $srcStr = "GETvod.api.qcloud.com$str";
    //echo '签名--'.$srcStr."<br>";
    $signStr = base64_encode(hash_hmac('sha1', $srcStr, $secretKey, true));
    $signStr = urlencode($signStr);

    /* 接口请求 */
    $url="https://vod.api.qcloud.com$str&Signature=$signStr";
    //echo '回调--'.$url."<br>";
    $result=file_get_contents($url);
    //echo $urls; json_decode($result,true)['transcodeInfo']['transcodeList']
    //var_dump(json_decode($result,true));die;
    //echo $urls;die;
    return json_decode($result,true);
}

/**
 * @param 直播状态操作 
 * @param $Action 接口类型 
 * @param $StreamName 接口名称 
 * 签名-接口回调
 */ 
function live_status($Action,$live_id){

    if(!$Action || !$live_id){
        $result=['code'=>410,'msg'=>'参数有误！'];
    }
    $secretId = "AKIDQOK4QeTqhXH9mCvqzwwJhtdebaVhlPtr";
    $secretKey = "gFh1AxBNO0xJctzteFfuxpTvBHCyYwEJ";
    //   DropLiveStream 断开 DescribeLiveStreamState 查看状态  ForbidLiveStream 禁播  ResumeLiveStream 恢复
    //  active 直播中  inactive 断开  forbid 禁止
    // 公共参数  
    $param["Nonce"] = rand();
    $param["Timestamp"] = time();
    $param["Region"] = "ap-shanghai";
    $param["SecretId"] = "$secretId";
    $param["Action"] = "$Action";
    $param["Version"] = "2018-08-01";
    $param["AppName"] = "live";
    $param["DomainName"] = "41302.livepush.myqcloud.com";
    $param["StreamName"] = '41302_'.$live_id;
    //var_dump($param);die;
    // 参数排序
    ksort($param);
    // 生成待签名字符串
    $signStr="";
    $sign = "GETlive.ap-shanghai.tencentcloudapi.com/?";
    foreach ( $param as $key => $value ) {
        $signStr = $signStr . $key . "=" . $value . "&";
    }
    $signStr = substr($signStr, 0, -1);

    // 生成签名
    $signature = base64_encode(hash_hmac("sha1", $sign.$signStr, "$secretKey", true));
    $signature =urlencode($signature);

    /* 接口请求 */
    $request="https://live.ap-shanghai.tencentcloudapi.com?$signStr&Signature=$signature";
    //echo '回调--'.$request."<br>";
    $result=file_get_contents($request);
    $result=json_decode($result,true);
    if($Action=="DescribeLiveStreamState" && !empty($result) && isset($result['Response']['StreamState'])){
        $result=$result['Response']['StreamState'];
    }else{
        $result=$result['Response']['RequestId'];
    }
    //var_dump($result);die;
    //echo $urls;die;
    return $result;
}

/**
 * @param $Url 接口实例域名 
 * @param $Action 接口名称 
 * 签名-消息队列
 */ 
function Cmq($msg_body){
    require_once (EXTEND_PATH.'Tencent/qc_cmq_php_sdk/cmq/cmq_api.php');
    require_once CMQAPI_ROOT_PATH . '/account.php';
    require_once CMQAPI_ROOT_PATH . '/queue.php';
    require_once CMQAPI_ROOT_PATH . '/cmq_exception.php';
    $secretId = "AKIDQOK4QeTqhXH9mCvqzwwJhtdebaVhlPtr";
    $secretKey = "gFh1AxBNO0xJctzteFfuxpTvBHCyYwEJ";
    $url='https://cmq-queue-sh.api.qcloud.com';
    /* 创建队列 */
    //$instance = CreateQueue($secretId,$secretKey,$url);

    //$instance = ReceiveMessage($secretId,$secretKey,$url);
    if($msg_body){
        /* 发送消息 */
        SendMessage($secretId,$secretKey,$url,$msg_body);
    }

    /* 接收消息 */
    $instance = ReceiveMessage($secretId,$secretKey,$url);
    if(is_array($instance)){
        echo " ";
    }
}

/* 创建消息队列 */
function CreateQueue($secretId,$secretKey,$url) { 
    $queue_name = "SIFIC1";
    $my_account = new Account($url, $secretId, $secretKey); 
    $my_queue = $my_account->get_queue($queue_name); 

    $queue_meta = new QueueMeta(); 
    $queue_meta->queueName = $queue_name; 
    $queue_meta->pollingWaitSeconds = 10; 
    $queue_meta->visibilityTimeout = 10; 
    $queue_meta->maxMsgSize = 1024; 
    $queue_meta->msgRetentionSeconds = 500*3600;

    try{ 
        $my_queue->create($queue_meta);
        return $queue_meta; 
    } catch (CMQExceptionBase $e){ 
        return $e->data; 
    } 
}
 
//发送消息 
function SendMessage($secretId, $secretKey, $url,$msg_body) { 
    $queue_name = "SIFIC_1"; 
    $my_account = new Account($url, $secretId, $secretKey); 

    $my_queue = $my_account->get_queue($queue_name); 
    $msg = new Message($msg_body); 
    try { 
        $re_msg = $my_queue->send_message($msg);
        return $re_msg->msgId;
    } catch (CMQExceptionBase $e) { 
        return $e->data; 
    } 
}
 
//接收消息 
function ReceiveMessage($secretId, $secretKey, $url) { 
    $queue_name = "SIFIC_1"; 
    $my_account = new Account($url, $secretId, $secretKey);

    $my_queue = $my_account->get_queue($queue_name);
    $receiptHandle=null;
    while (TRUE) { 
        try{ 
            $recv_msg = $my_queue->receive_message(1);
            echo $recv_msg->msgBody."\r\n";
            //$receiptHandle=$recv_msg->msgId;
        } catch (CMQExceptionBase $e) { 
            return $e->data;
        } 

//删除消息 
        // try 
        // { 
        //     $my_queue->delete_message($receiptHandle); 
        //     echo "Delete Message Succeed!  ReceiptHandle:" . $receiptHandle . "\n"; 
        // } 
        // catch (CMQExceptionBase $e) 
        // { 
        //     echo "Delete Message Fail! Exception: " . $e; 
        //     return; 
        // } 
    }
}

//删除队列
function DeleteQueue($secretId, $secretKey, $url) { 
    $queue_name = "SIFIC"; 
    $my_account = new Account($url, $secretId, $secretKey); 
    $my_queue = $my_account->get_queue($queue_name); 
    try { 
        $my_queue->delete(); 
        return $queue_name; 
    } catch (CMQExceptionBase $e) { 
        return $e->data; 
    } 
}

/* 前端会议导航栏控制 */
function web_menu(){
    $convention_id=!empty($_GET['convention_id'])?$_GET['convention_id']:47;
    $where=" app_type = 2 AND record_status = 1 AND (convention_ids  not like ('%$convention_id%') OR ISNULL(convention_ids))";
    $navLlist=Db::table('base_menu_info')
            ->where($where)
            ->field('pid,fid,menu_name,route')
            ->order("fid","asc")
            ->select();
    //echo Db::table("base_menu_info")->getLastSql();die;
    $html='';
    $i=0;
    $navLlist=getTree($navLlist,0);
    foreach($navLlist as $k=>$v){
        $i++;
        $menu_name=$v['menu_name'];
        $route=$v['route'];
        $children=children($v['children']);
        $html.="{
            id:'$i',
            name: '$menu_name', 
            url:'$route',
            subMenu: [$children]
        },";  
    }
    return $html;
}

function children($navLlist){
    $i=0;
    $html="";
    foreach($navLlist as $k=>$v){
        $i++;
        $menu_name=$v['menu_name'];
        $route=$v['route'];
        $html.="{
            suid:'$i',
            name: '$menu_name', 
            url:'$route'
        },";  
    }
    return $html;
}
/* 请求返回状态 */
function result($code,$msg){
    return  [ 'code' =>$code,'msg' =>$msg];
}

/* 删除图片同时删除服务器图片资源 */
function del_image_path($image_ids){
    $path=Db::table('base_source_info')
        ->wherein('fid',$image_ids)
        ->select();
    if(empty($path)){return true;}    
    foreach($path as $v){
        if(empty($v['file_path'])){return true;}    
        $file_path =ROOT_PATH. 'public'.$v['file_path'];
        if(file_exists($file_path)){
            unlink($file_path);
        }
    }
    return true;
}


/* 读取富文本编辑器 附件并下载 */
function get_edit_docx($data){
    require_once (EXTEND_PATH."PHPWord-develop/bootstrap.php");
    $html =ROOT_PATH. 'public' . DS . 'html.txt';
    $file=file_get_contents("$html");
    $reg='/href=\"([^\"]+)/';
    preg_match_all($reg,$file,$array);
    print_r($array);die;
    if(isset($array[1]) && empty($array[1])){
        return json_encode(['code'=>401,'msg'=>"数据不存在"]);
    }

    for($i=0;$i<count($array[1]);$i++){
        $file =ROOT_PATH . 'public'.$array[1][$i];
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($file);
        $file_to =ROOT_PATH . 'public/conference_template/'."enrolment/"."2019_$i.docx";
        $templateProcessor->saveAs($file_to);
    }
}

/**
*会议报名及摘要全文发送邮件
*$type 发送类型
*$data 发送条件参数
*/
function Send_Report($type,$data){
	
	require_once (EXTEND_PATH."PHPWord-develop/bootstrap.php");
	$uid=isset($data['uid'])?$data['uid']:0;
	$fid=isset($data['fid'])?$data['fid']:0;
	//var_dump($data['fid']);die;
	$convention_id=isset($data['convention_id'])?$data['convention_id']:47;
	$where=[];
	$where['record_status']=1;
	//导出摘要
	$abstract="";
	$convention="";
	if($type==10 && $uid>0 && $convention_id>0){
		$where['convention_id']=$convention_id;
		$where['creator_id']=$uid;		
		$where['fid']=$fid;		
		//获取某一用户摘要信息
		$abstract=DB::table("v_paper_abstract")->where($where)->select();
	}elseif($type==10 && $uid==0 && $convention_id>0){
		$where['convention_id']=$convention_id;	
		if($fid>0){
			$where['fid']=$fid;	
		}
		//获取所有用户摘要信息
		//->wherein('fid',$fid)  导出当前页
		$abstract=DB::table("v_paper_abstract")->where($where)->select();
	}else{
		$where['convention_id']=$convention_id;
		$where['creator_id']=$uid;
		//获取会议报名信息
		$convention=DB::table("v_convention_signup_detail")->where($where)->find();
		//获取摘要及全文
		if($fid>0){
			$where['fid']=$fid;	
		}
		$abstract=DB::table("v_paper_abstract")->where($where)->find();
	}
	//echo DB::table("v_paper_abstract")->getLastSql();die;
	//var_dump($convention,$abstract);DIE;
	
    $report_type="";
	$pwd="";//重置密码
	//公共参数
	$top="第15届上海国际医院感染控制论坛注册秘书处";
	$tel=$type==3 || $type==4?"021-5864 9185":"021-3279 8783";
	$year="SIFIC".date("Y");
	$send_email='';
	//此处是设置会议报名摘要发送者邮箱
	$email='';
	$password='';

	switch($type){
        case 1:
            //账户成功创建函
            $report_type="账户成功创建函";
            $result_address="enrolment";
            $content="";
			$email="Registration@sific.org.cn";
			$password="ZED3xFgGTtSLAUBR";
            break; 
		case 2:
            //重置密码确认
            $report_type="重置密码确认";
            $result_address="enrolment";
			$pwd=isset($data['pwd'])?$data['pwd']:"";
			$send_email=isset($data['email'])?$data['email']:"1053804748@qq.com";
			$email="Registration@sific.org.cn";
			$password="ZED3xFgGTtSLAUBR";
			$content="";
            break;
        case 3:
            //付款确认涵
            $report_type="付款确认函";
            $result_address="enrolment";
            $content="";
			$email="Registration@sific.org.cn";
			$password="ZED3xFgGTtSLAUBR";
            break;
        case 4:    
            //付款通知单
            $report_type="付款通知单";
            $result_address="enrolment";
            $content="";
			$email="Registration@sific.org.cn";
			$password="ZED3xFgGTtSLAUBR";			
            break;
        case 5:    
            //摘要提交确认信
            $report_type="摘要提交确认信";
            $result_address="abstracts_papers";
			$content="";
			$email="abstract@sific.org.cn";
			$password="AhLsK2yguFrZaPzG";			
            break;		
        case 6:
            //摘要接受确认函
            $report_type="摘要接受确认函";
            $result_address="abstracts_papers";
			$content ="";
			$email="abstract@sific.org.cn";
			$password="AhLsK2yguFrZaPzG";			
            break;				
        case 7:
            //全文提交确认信
            $report_type="全文提交确认信";
            $result_address="abstracts_papers";
            $content="";
			$email="abstract@sific.org.cn";
			$password="AhLsK2yguFrZaPzG";			
            break;
        case 8:   
            //全文评审通知
            $report_type="全文评审通知";
            $result_address="abstracts_papers";
			$content="";
			$email="abstract@sific.org.cn";
			$password="AhLsK2yguFrZaPzG";			
            break;
		case 9:   
            //会议报名证书下载
            $report_type="证书";
            $result_address="certificate";
            $org_name=$data['org_name'];
            $fid=$data['fid'];
            $path=SourceInfo(820,4);
            $UserName=$data['user_name'];
            break;
		case 10:    
            //导出-SIFIC摘要作者信息
            $result_address="abstracts_papers";
            $content="";
            break;
		case 11:    
            //会前群发参会指南
            $result_address="enrolment";
			$email="Registration@sific.org.cn";
			$password="ZED3xFgGTtSLAUBR";
            break;	
    }
	
	if($type==2){
		$content="系统已重置您的登录密码为：".$pwd.". 请使用新密码登录http://forum.sific.vip/login。如有任何疑问，请随时与我们处联系！";
		YearEmail($send_email,$user_name,"$year-$report_type","",$report_type,$content,$email,$password);
	}elseif($type==9){
		//读取文件
		$dir=ROOT_PATH . 'public/conference_template/';
		//读取模板地址
		$template_file =empty($path)?$dir. "$report_type.docx":ROOT_PATH ."public".$path;
		//生成模板地址
		$file_to =$dir."$result_address/"."$fid-$UserName-$report_type.docx";  

		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template_file);
		$templateProcessor->setValue('Convention',$org_name);
		$templateProcessor->setValue('UserName',$UserName);

		$templateProcessor->saveAs($file_to);
		$pdf=$dir."$result_address";
		//   /home/wwwroot/default/SIFIC/public/conference_template/certificate/施卉证书.pdf
		//   /home/wwwroot/default/SIFIC/public/conference_template/certificate/施卉证书.docx
		exec("export HOME=/tmp && libreoffice --headless -convert-to pdf $file_to -outdir $pdf");
		/* 下载本地 */
		$pdf=$pdf."/$fid-$UserName-$report_type.pdf";
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename='$UserName$report_type.pdf' ");
		header("Content-Length: ". filesize($pdf));
		readfile($pdf);
	}elseif($type==10){
		if(empty($abstract)){ return;}
		$filename="$year-摘要.docx";
		//读取文件
		$dir=ROOT_PATH . 'public/conference_template/';
		//读取模板地址
		$template_file= $dir. $filename;
		$aFiles=array();
		foreach($abstract as $vo){
			$abstract_id=empty($vo['fid'])?0:$vo['fid'];
			$arr[]=$abstract_id;
			$user_name=empty($vo['user_name'])?"":$vo['user_name'];
			//生成模板地址
			$file_to =$dir."$result_address/A0".$abstract_id."-".$user_name."-摘要.docx";  
			$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template_file);
			$where['abstract_id']=$abstract_id;
			if(isset($where['fid'])){unset($where['fid']);}
			$author=DB::table("v_paper_author")
				->distinct(true)
				->field("company,author_name,address,user_name")
				->where($where)
				->select();
			//echo DB::table("v_paper_author")->getLastSql();die;
			Author_handling($author,$templateProcessor);
			$templateProcessor->setValue('title',$vo['title']);
			//正文部分为
			$templateProcessor->setValue('objective',$vo['objective']);
			$templateProcessor->setValue('method',$vo['method']);
			$templateProcessor->setValue('result',$vo['result']);
			$templateProcessor->setValue('conclusion',$vo['conclusion']);
			//echo $file_to;die;
			$templateProcessor->saveAs($file_to);
			$aFiles[]=$file_to;
		}
		/* 下载本地 */
		pro_zip($aFiles,time()."-2019SIFIC摘要");
	}elseif($type==11){
		$wheres=array();
		$wheres['convention_id']=47;
		//$wheres['pay_status']=2;
		$wheres['record_status']=1;
		//$wheres['creator_id']=6;
		//获取会议报名信息
		$convention=DB::table("v_convention_signup_detail")->where($wheres)->where("fid",">",3422)->select();
		//读取文件
		$dir=ROOT_PATH . "public/conference_template/email/参会指南.html"; 
		$dir=ROOT_PATH . "public/conference_template/SIFIC2019参会须知.pdf"; 
		$Content = "<p>
					尊敬的各位老师们:
					</p>
					<p>
						2019年第15届上海国际医院感控控制论坛SIFIC将于5月30日在上海跨国采购会展中心正式拉开序幕。线上注册渠道已关闭。由于现场注册人数众多，请参会老师尽量错开5月30日上午的培训班注册高峰。具体参会须知请见附件。
					</p>
					<p>
						*温馨提示：5月30日上午仅有上海市医院感染管理岗位培训班和SIFIC版主大会2场活动。建议岗位培训班参会老师于上午7点-8点45分之间前来注册或签到，9点培训班课程正式开始。非岗位培训班参会老师建议避开注册高峰，可于 5月30日上午10:30后或者下午前来注册签到。
					</p>
					<p>
						<br/>
					</p>";
		foreach($convention as $vo){
			//发送者邮件达到上线切换邮箱
			$send_email=!empty($vo['email'])?$vo['email']:"1053804748@qq.com";
			$user_name=!empty($vo['user_name'])?$vo['user_name']:"2019 SIFIC秘书处";
			$report_type="SIFIC 2019参会须知";
			try{
				YearEmail($send_email,$user_name,"2019 SIFIC秘书处",$dir,$report_type,$Content,$email,$password);
			} catch (\Exception $e) {
				// $email="abstract@sific.org.cn";
				// $password="AhLsK2yguFrZaPzG";
				// YearEmail($send_email,$user_name,"2019 SIFIC秘书处",$dir,$report_type,$Content,$email,$password);
				
			}
		}
		die;
		//批量导出上传文件并且替换加密名称
		$wheres['convention_id']=47;
		$wheres['record_status']=1;
		$wheres['abstract_status']=2;
		$abstracts=DB::table("v_paper_abstract")->where($wheres)->where('fileid','>',0)->select();
		//读取模板地址
		$aFiles=array();
		foreach($abstracts as $vo){
			//生成模板地址
			$template_file=empty($vo['file_path'])?"":$vo['file_path'];
			$template_file=ROOT_PATH . "public".$template_file;
			$file_name=empty($vo['title'])?"":$vo['title'];
			$doc=explode(".",$template_file)[1];
			$file_to =ROOT_PATH . "public/conference_template/certificate/$file_name.$doc";
			echo $template_file."<br>";
			echo $file_to;
			exec("cp  $template_file $file_to",$output,$re);
			var_dump($re);
			echo "<br>";
			//$file_to =ROOT_PATH . "public/conference_template/certificate/$file_name.doc";
			//$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template_file);
			//$templateProcessor->saveAs($file_to);
			//$aFiles[]=$file_to;
		}
		/* 下载本地 */
		//pro_zip($aFiles,"2019SIFIC摘要");
		die;
	}else{	
		//会议相关信息
		$image="http://2019.sific.com.cn".$convention['web_image_url'];
		$user_name=!empty($abstract['user_name'])?$abstract['user_name']:$convention['user_name'];
		$cstime="2019年5月30日-6月1日";
		$address=$convention['address'];
		$convention_name=$convention['convention_name'];
		$pay_mode=$convention['pay_mode']?$convention['pay_mode']:"";
		$price=$convention['price']?$convention['price']:"";
		$order_number=$convention['order_number']?$convention['order_number']:"";
		$time=$convention['update_time']?$convention['update_time']:"";
		$ticket_name=$convention['ticket_name']?$convention['ticket_name']:"";
	
		//摘要及全文相关数据
		$TYPE='';
		$_status='';
		if($abstract['yes_no']==2 && $type!=8 && $type!=6){
			$TYPE="F0".$abstract['fid'];
		}else{
			$TYPE=$type==8?"F0".$abstract['fid']:"A0".$abstract['fid'];
			$_status=$type==8?'paper_status':'abstract_status';
		}
		
		//type==6 管理员发送摘要审核邮件
		$status=!empty($data['status'])?$data['status']:0;
		$send_fid=empty($abstract['fid'])?0:$abstract['fid'];
		if($status>0){
			DB::table("convention_paper_abstract")->where(['fid'=>$send_fid])->update(['abstract_send'=>2,'abstract_status'=>$status]);
		}
		
		$abstract_status=$status==2?"接受":($status==3?"拒绝":"待审核");
		$title=empty($abstract['title'])?:$abstract['title'];
		$keyword=empty($abstract['keyword'])?:$abstract['keyword'];
		$special=!empty($abstract['special'])&& $abstract['special']==1?"口头和壁报":"壁报";
		$subject=$abstract['class_name_zh']?$abstract['class_name_zh']:"";
		$send_email=!empty($convention['email'])?$convention['email']:'1053804748@qq.com';
		//读取文件
		$dir=ROOT_PATH . "public/conference_template/email/$report_type.html"; 
		$fileContent = file_get_contents($dir);
		//从$fileContent字符串中把{$content}替换为$content的内容，并返回字符串
		$arr=array('$report_type','$top','$email','$year','$image','$user_name','$cstime','$address','$convention_name','$TYPE','$title',
		'$tel','$keyword','$special','$abstract_status','$subject','$send_email','$pay_mode','$order_number','$price','$time','$ticket_name');
		$arr2=array("$report_type","$top","$email","$year","$image","$user_name","$cstime","$address","$convention_name","$TYPE","$title",
		"$tel","$keyword","$special","$abstract_status","$subject","$send_email","$pay_mode","$order_number","$price","$time","$ticket_name");
		$content = str_replace($arr,$arr2,$fileContent);
		
		//发送者邮件达到上线切换邮箱
		try{
            YearEmail($send_email,$user_name,"$year-$report_type","",$report_type,$content,$email,$password);
        } catch (\Exception $e) {
			$email="abstract@sific.org.cn";
			$password="AhLsK2yguFrZaPzG";
            YearEmail($send_email,$user_name,"$year-$report_type","",$report_type,$content,$email,$password);
        }
	}
	//每次执行前刷新缓存 
	ob_flush();
	flush();
}

/**
*导出摘要-作者信息处理
*$author 作者数据集
*
**/
function  Author_handling($author,$templateProcessor){
	$author_list="";
	$company_list="";
	foreach($author as $k=>$v){
		$author_name=empty($v['author_name'])?"":$v['author_name'];
		$company=empty($v['company'])?"":$v['company'];
		$address=empty($v['address'])?"":$v['address'];
		$author_list.=($k+1).".".$author_name.", ";
		$company_list.=($k+1).".".$company.",".$address."; ";
	}
	//作者列表 及 单位地址
	$templateProcessor->setValue('author',$author_list);
	$templateProcessor->setValue('company',$company_list);
	return $templateProcessor;
}

/**
 * $address 收件人地址
 * $from_name 发件人名称
 * $dir 添加附件(注意：路径不能有中文)
 * $subject 邮件标题
 * $body 邮件内容，可以是HTML
 */
function Email($address,$from_name,$dir,$subject,$body){
    import("PHPMailer.PHPMailer", EXTEND_PATH);
    import("PHPMailer.SMTP", EXTEND_PATH); 

    $mail = new \PHPMailer(true); //建立邮件发送类
    $mail->CharSet = "UTF-8";//设置信息的编码类型
    $mail->IsSMTP(); // 使用SMTP方式发送
    $mail->Host = "smtp.qq.com"; //使用163邮箱服务器
    $mail->SMTPAuth = true; // 启用SMTP验证功能
    $mail->Username = "yufc@vip.qq.com"; //你的163服务器邮箱账号
    $mail->Password = 'prgieqnhwbwfbigi'; // 授权码
    $mail->Port = 465;//邮箱服务器端口号
    $mail->From = "yufc@vip.qq.com"; //邮件发送者email地址
    $mail->FromName = $from_name;//发件人名称
    $mail->AddAddress("$address", "admin"); //收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
    //$mail->AddAttachment($dir); // 添加附件(注意：路径不能有中文)
    $mail->IsHTML(true);//是否使用HTML格式
    $mail->Subject = $subject; //邮件标题
    $mail->Body = $body; //邮件内容，上面设置HTML，则可以是HTML
    $mail->SMTPSecure = 'ssl';

    if (!$mail->Send()) 
    {
        $data = [
            'code'=>'430',
            'msg'=>"邮件发送失败,错误原因: " . $mail->ErrorInfo
        ];
        echo json_encode($data); exit;
    }else{
        //echo "邮件发送成功";exit; 
        return true;
    }
}

/**
 *年会相关邮件发送
 * $address 收件人地址
 * $from_name 发件人名称
 * $dir 添加附件(注意：路径不能有中文)
 * $subject 邮件标题
 * $body 邮件内容，可以是HTML
 */
function YearEmail($address,$user_name,$from_name,$dir,$subject,$body,$username,$password){
    import("PHPMailer.PHPMailer", EXTEND_PATH);
    import("PHPMailer.SMTP", EXTEND_PATH); 

    $mail = new \PHPMailer(true); //建立邮件发送类
    $mail->CharSet = "UTF-8";//设置信息的编码类型
    $mail->IsSMTP(); // 使用SMTP方式发送
    $mail->Host = "smtp.qiye.163.com"; //使用163邮箱服务器
    $mail->SMTPAuth = true; // 启用SMTP验证功能
    $mail->Username =$username; // yufc@vip.qq.com你的163服务器邮箱账号
    $mail->Password =$password; // prgieqnhwbwfbigi 授权码
    $mail->Port = 994;//邮箱服务器端口号
    $mail->From =$username; //邮件发送者email地址
    $mail->FromName = $from_name;//发件人名称
    $mail->AddAddress("$address", "$user_name"); //收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
    //$mail->AddAttachment($dir); // 添加附件(注意：路径不能有中文)
    $mail->IsHTML(true);//是否使用HTML格式
    $mail->Subject = $subject; //邮件标题
    $mail->Body = $body; //邮件内容，上面设置HTML，则可以是HTML
    $mail->SMTPSecure = 'ssl';

    if (!$mail->Send()) 
    {
        $data = [
            'code'=>'430',
            'msg'=>"邮件发送失败,错误原因: " . $mail->ErrorInfo
        ];
        //echo json_encode($data);
    }else{
        //echo "邮件发送成功"; 
        //return true;
    }
} 

/**
 *sific
 * $address 收件人地址
 * $from_name 发件人名称
 * $dir 添加附件(注意：路径不能有中文)
 * $subject 邮件标题
 * $body 邮件内容，可以是HTML
 */
function SificEmail($address,$user_name,$from_name,$dir,$subject,$body,$username,$password){
    import("PHPMailer.PHPMailer", EXTEND_PATH);
    import("PHPMailer.SMTP", EXTEND_PATH); 

    $mail = new \PHPMailer(true); //建立邮件发送类
    $mail->CharSet = "UTF-8";//设置信息的编码类型
    $mail->IsSMTP(); // 使用SMTP方式发送
    $mail->Host = "smtp.exmail.qq.com"; //使用163邮箱服务器
    $mail->SMTPAuth = true; // 启用SMTP验证功能
    $mail->Username =$username; // liumeng@sific.vip
    $mail->Password =$password; // 7JjCrwfzwvoiirdA 授权码
    $mail->Port = 465;//邮箱服务器端口号
    $mail->From =$username; //邮件发送者email地址
    $mail->FromName = $from_name;//发件人名称
    $mail->AddAddress("$address", "$user_name"); //收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
    $mail->AddAttachment($dir); // 添加附件(注意：路径不能有中文)
    $mail->IsHTML(true);//是否使用HTML格式
    $mail->Subject = $subject; //邮件标题
    $mail->Body = $body; //邮件内容，上面设置HTML，则可以是HTML
    $mail->SMTPSecure = 'ssl';

    if (!$mail->Send()) 
    {
        $data = [
            'code'=>'430',
            'msg'=>"邮件发送失败,错误原因: " . $mail->ErrorInfo
        ];
        //echo json_encode($data);
    }else{
        //echo "邮件发送成功"; 
        //return true;
    }
}


/* 导出会议论文及摘要 */
//付款状态	注册号码	摘要编号	提交时间	注册姓名	单位	电话	邮箱	
//*文章作者	*手机	*邮箱	*单位	地址
//*通讯作者 *手机	*邮箱	*单位	地址	
//*发表形式	*所属专题	*标题	*关键字	是否上传保存摘要	是否参加《中华感染学杂志》	全文编号	是否上传全文附件		
function Paper_Export()
{
    //找到当前脚本所在路径
    $path = dirname(__FILE__); 
    //引入IOFactory.php 文件里面的PHPExcel_IOFactory这个类
    import('PHPExcel.Classes.PHPExcel');
    import('PHPExcel.Classes.PHPExcel.IOFactory.PHPExcel_IOFactory');
    $PHPExcel = new \PHPExcel();
    $PHPSheet = $PHPExcel->getActiveSheet();
    $PHPSheet->setTitle("会议论文及摘要");
    /* 基本信息 */
    $PHPSheet->setCellValue("A1","付款状态");
    $PHPSheet->setCellValue("B1","注册号码");
    $PHPSheet->setCellValue("C1","摘要编号");
    $PHPSheet->setCellValue("D1","注册姓名");
    $PHPSheet->setCellValue("E1","单位");
    $PHPSheet->setCellValue("F1","电话");
    $PHPSheet->setCellValue("G1","邮箱");
    /* 文章作者 */
    $PHPSheet->setCellValue("H1","*文章作者");
    $PHPSheet->setCellValue("I1","*手机");
    $PHPSheet->setCellValue("J1","*邮箱");
    $PHPSheet->setCellValue("K1","*单位");
    $PHPSheet->setCellValue("L1","地址");
    /* 通讯作者 */
    $PHPSheet->setCellValue("M1","*通讯作者");
    $PHPSheet->setCellValue("N1","*手机");
    $PHPSheet->setCellValue("O1","*邮箱");
    $PHPSheet->setCellValue("P1","单位");
    $PHPSheet->setCellValue("Q1","地址");
    /* 摘要信息 */
    $PHPSheet->setCellValue("R1","*发表形式");
    $PHPSheet->setCellValue("S1","*所属专题");
    $PHPSheet->setCellValue("T1","*标题");
    $PHPSheet->setCellValue("U1","*关键字");
    $PHPSheet->setCellValue("V1","是否上传保存摘要");
    $PHPSheet->setCellValue("W1","是否参加《中华感染学杂志》");
    $PHPSheet->setCellValue("X1","全文编号");
    $PHPSheet->setCellValue("Y1","是否上传全文附件");
    $PHPSheet->setCellValue("Z1","提交时间");

    $convention_id=isset($_GET['_ids'])?$_GET['_ids']:0;
    $fid=isset($_GET['fid'])?$_GET['fid']:0;
    $where['convention_id']=$convention_id;
    $where['record_status']=1;
    $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
    'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');


    // var_dump($sign_detail);die;  
	/* 摘要信息   ->wherein('fid',$fid)*/
	$paper = Db::table("v_paper_abstract")->where(["record_status"=>1])->select();
    $i = 2;
    foreach($paper as $key => $value){
		
		$where['creator_id']=$value['creator_id'];
        /* 报名记录 */
		$sign_detail= Db::table("v_convention_signup_detail")
            ->where($where)
            ->find();
		if(empty($sign_detail)) continue;	
        if($sign_detail['pay_status']==1){
            $sign_detail['pay_status']="待审核";
        }elseif($sign_detail['pay_status']==2){
            $sign_detail['pay_status']="支付成功";
        }else{
            $sign_detail['pay_status']="支付失败";
        }
		//echo DB::table("v_convention_signup_detail")->getLastSql();die;
		$abs_num="A0".$value['fid'];
		
		$author_where=[];
		$author_where['record_status']=1;
		$author_where['abstract_id']=$value['fid'];
		$author_where['creator_id']=$value['creator_id'];
		$author_where['type']=1;
		//通讯作者
		$article_author = Db::table("v_paper_author")->where($author_where)->find();
		//文章作者
		$author_where['type']=2;
		$tel_author = Db::table("v_paper_author")->where($author_where)->find();
		
		/* 报名基本信息 */
        $PHPSheet->setCellValue("A".$i,''.$sign_detail['pay_status'].'');

        $PHPSheet->setCellValue('B'.$i,''.$sign_detail['order_number'].'');
		
        $PHPSheet->setCellValue('C'.$i,''.$abs_num.'');
		
        $PHPSheet->setCellValue('D'.$i,''.$sign_detail['user_name'].'');
		
        $PHPSheet->setCellValue('E'.$i,''.$sign_detail['org_name'].'');
		
        $PHPSheet->setCellValue('F'.$i,''.$sign_detail['tel'].'');
		
        $PHPSheet->setCellValue('G'.$i,''.$sign_detail['email'].'');

		/* 文章作者 */
        $PHPSheet->setCellValue('H'.$i,''.$article_author['author_name'].'');
		
        $PHPSheet->setCellValue('I'.$i,''.$article_author['tel'].'');
		
        $PHPSheet->setCellValue('J'.$i,''.$article_author['email'].'');
		
        $PHPSheet->setCellValue("K".$i,''.$article_author['company'].'');
		
        $PHPSheet->setCellValue("L".$i,''.$article_author['address'].'');
		
		/* 通讯作者 */
        $PHPSheet->setCellValue("M".$i,''.$tel_author['author_name'].'');
		
        $PHPSheet->setCellValue("N".$i,''.$tel_author['tel'].'');
		
        $PHPSheet->setCellValue("O".$i,''.$tel_author['email'].'');
		
        $PHPSheet->setCellValue("P".$i,''.$tel_author['company'].'');
		
        $PHPSheet->setCellValue("Q".$i,''.$tel_author['address'].'');
		



		//摘要信息  发表形式
        $shape='';
        switch($value['shape']){
            case 1;
                $shape='口头和壁报';
                break;
            case 2;
                $shape='壁报';
                break;
            case 3;
                $shape='其他';
                break;
        }

		$yes_no=isset($value['yes_no']) && $value['yes_no']==2?"是":"否";
		$abstract_is=!empty($value)?"是":"否";
		$paper_is=!empty($value['fileid'])?"是":"否";
		$number=isset($value['yes_no']) && $value['yes_no']==2?"F0".$value['fid']:"";
        $PHPSheet->setCellValue("R".$i,''.$shape.'');
        $PHPSheet->setCellValue("S".$i,''.$value['class_name_zh'].'');
        $PHPSheet->setCellValue("T".$i,''.$value['title']." ");
        $PHPSheet->setCellValue("U".$i,''.$value['keyword'].'');
        $PHPSheet->setCellValue("V".$i,''.$abstract_is.'');
        $PHPSheet->setCellValue("W".$i,''.$yes_no." ");
        $PHPSheet->setCellValue("X".$i,''.$number." ");
        $PHPSheet->setCellValue("Y".$i,''.$paper_is." ");
        $PHPSheet->setCellValue("Z".$i,''.$value['update_time']." ");

		$i++;
    }
    ob_end_clean();//清除缓冲区,避免乱码
    $filename="会议论文及摘要.xlsx";
    $PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel,"Excel2007");
    header('Content-Disposition: attachment;filename="会议论文及摘要.xlsx"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //表示在$path路径下面生成demo.xlsx文件
    $PHPWriter->save("php://output");die;
}

/* 导出会议摘要-作者信息 */
function Abstract_Export(){
	$param=request()->param();
	$param=array_filter($param);
    //找到当前脚本所在路径
    $path = dirname(__FILE__); 
    //引入IOFactory.php 文件里面的PHPExcel_IOFactory这个类
    import('PHPExcel.Classes.PHPExcel');
    import('PHPExcel.Classes.PHPExcel.IOFactory.PHPExcel_IOFactory');
    $PHPExcel = new \PHPExcel();
    $PHPSheet = $PHPExcel->getActiveSheet();
    $PHPSheet->setTitle("作者列表");
    $PHPSheet->setCellValue("A1","摘要编号");
    $PHPSheet->setCellValue("B1","提交时间");
    $PHPSheet->setCellValue("C1","*姓名");
    $PHPSheet->setCellValue("D1","*手机");
    $PHPSheet->setCellValue("E1","*邮箱");
    $PHPSheet->setCellValue("F1","单位");
    $PHPSheet->setCellValue("G1","地址");
    $PHPSheet->setCellValue("H1","*文章作者/通讯作者");

    $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
    'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

    $convention_id=isset($param['_id'])?$param['_id']:0;
    $creator_id=isset($param['creator_id'])?$param['creator_id']:0;
    $fid=isset($param['fid'])?$param['fid']:0;
	//->wherein('abstract_id',$fid)
    $result = Db::table("v_paper_author")->where(["record_status"=>1,"convention_id"=>$convention_id])->select();
	//echo Db::table("v_paper_author")->getLastSql();die;
	$i=2;
    foreach($result as $vo){
        $PHPSheet->setCellValue('A'.$i,''."A0".$vo['abstract_id'].'');
        $PHPSheet->setCellValue('B'.$i,''.$vo['update_time'].'');
        $PHPSheet->setCellValue('C'.$i,''.$vo['user_name'].'');
        $PHPSheet->setCellValue('D'.$i,''.$vo['tel'].'');
        $PHPSheet->setCellValue('E'.$i,''.$vo['email'].'');
        $PHPSheet->setCellValue('F'.$i,''.$vo['company'].'');
        $PHPSheet->setCellValue('G'.$i,''.$vo['address'].'');
        $PHPSheet->setCellValue('H'.$i,''.$vo['author_name'].'');
		$i++;
    }

    ob_end_clean();//清除缓冲区,避免乱码
    $filename="SIFIC".date("Y");
    $filename=$filename."-$convention_id-摘要作者.xlsx";
    $PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel,"Excel2007");
    header("Content-Disposition: attachment;filename=$filename");
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //表示在$path路径下面生成demo.xlsx文件
    $PHPWriter->save("php://output");die;
}

/* 导出会议报名记录 */
function Excel()
{
    //找到当前脚本所在路径
    $path = dirname(__FILE__); 
    //引入IOFactory.php 文件里面的PHPExcel_IOFactory这个类
    import('PHPExcel.Classes.PHPExcel');
    import('PHPExcel.Classes.PHPExcel.IOFactory.PHPExcel_IOFactory');
    $PHPExcel = new \PHPExcel();
    $PHPSheet = $PHPExcel->getActiveSheet();
    $PHPSheet->setTitle("报名记录");
    $PHPSheet->setCellValue("A1","*报名时间");
    $PHPSheet->setCellValue("B1","*注册编号");
    $PHPSheet->setCellValue("C1","*邮箱");
    $PHPSheet->setCellValue("D1","*姓名");
    $PHPSheet->setCellValue("E1","*称谓");
    $PHPSheet->setCellValue("F1","*部门/科室");
    $PHPSheet->setCellValue("G1","*职称");
    $PHPSheet->setCellValue("H1","*职称基本");
    $PHPSheet->setCellValue("I1","*省份");
    $PHPSheet->setCellValue("J1","*城市");
    $PHPSheet->setCellValue("K1","*单位");
    $PHPSheet->setCellValue("L1","*手机号");
    $PHPSheet->setCellValue("M1","*参会类型");
	
	$PHPSheet->setCellValue("N1","*支付状态");
	$PHPSheet->setCellValue("O1","支付方式");
	$PHPSheet->setCellValue("P1","应收款");
    $PHPSheet->setCellValue("Q1","已收款");
    $PHPSheet->setCellValue("R1","手续费");
    $PHPSheet->setCellValue("S1","收款编号");
	
    $PHPSheet->setCellValue("T1","是否需要发票");
    $PHPSheet->setCellValue("U1","发票类型");
    $PHPSheet->setCellValue("V1","发票抬头");
    $PHPSheet->setCellValue("W1","纳税人识别号");
	$PHPSheet->setCellValue("X1","邮寄地址");
    //$PHPSheet->setCellValue("X1","是否需要学分证");
    $PHPSheet->setCellValue("Y1","出生日期");
    $PHPSheet->setCellValue("Z1","毕业时间");
	
    $PHPSheet->setCellValue("AA1","学历");
    $PHPSheet->setCellValue("AB1","学位");
    $PHPSheet->setCellValue("AC1","是否来自基层");
    $PHPSheet->setCellValue("AD1","单位地址");
    $PHPSheet->setCellValue("AE1","身份证");
    $PHPSheet->setCellValue("AF1","单位电话");
    $PHPSheet->setCellValue("AG1","预计到会日期");
    $PHPSheet->setCellValue("AH1","预计离开日期");
    $PHPSheet->setCellValue("AI1","职位");
    $PHPSheet->setCellValue("AJ1","已开发票号");
	
    $convention_id=isset($_GET['export_id'])?$_GET['export_id']:0;
    $where['convention_id']=$convention_id;
	
	if (!empty($_GET['pay_status'])){
		$where["pay_status"]=$_GET['pay_status'];
	}
	if (!empty($_GET['bill_status'])){
		$where["bill_status"]=$_GET['bill_status'];
	}
	if (!empty($_GET['pay_type'])){
		$where["pay_type"] =$_GET['pay_type'];
	}
	
	if (!empty($_GET['start_time']) && !empty($_GET['end_time'])) {
		$where["update_time"] =array('>', $_GET['start_time']);
		$where["update_time"] = array('<', $_GET['end_time']);
	}
	
    $where['record_status']=1;
    $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
    'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
	// No. 	 注册时间 	 注册编号 	 *邮箱 	 姓名 	 *出生年月 	 *称谓 	 *职位 	 *部门/科室 	 职称1 	 *职称2 	 *毕业时间 	 *最高学历 	 
	//*学位 	 *国家 	 *省份/城市 	 *单位/企业 	 是否来自基层 	 *单位地址 	 *身份证 	 
	//*单位电话 	 单位传真 	 *手机号 	 注册类型 	 支付方式 	应收款	 已收款 	 手续费 	 付款状况 	 首信易订单号 	
	// 收款编号 	 银行转账 	 银行收款日期 	 是否需要开具发票 	 预计到会日期 	 预计离开日期 	 备注 					

    /*获取 报名配置 题目 */
/*     $sign_info= Db::table("convention_sign_info")->where($where)->order('sort','asc')->select();
    $s=23;
    foreach($sign_info as $k=>$v){
        $s++;
        if(!isset($cellName[$s])) continue;
        $PHPSheet->setCellValue($cellName[$s].'1',$v['field_name']);
        // echo $v['field_name'].$cellName[$s].'1'."<br>";
    } */

    /* 报名记录 */
    $sign_detail= Db::table("v_registration_information_form")
            ->where($where)
            ->order('fid', "desc")
            ->select();

  
    $i = 2;
    foreach($sign_detail as $key => $value)
    {
        $province_id=base_region(0,$value['province_id']);//省
        $city_id=base_region($value['province_id'],$value['city_id']);//市
        $country_id=base_region($value['city_id'],$value['city_id']);//区
        $sti=empty($province_id)?"":$city_id;//.'-'.$country_id;
        $bill_type=isset($value['bill_is']) &&  $value['bill_is']=="否"?"":(isset($value['bill_type'])&&$value['bill_type']==2?"增值税专用票":'普通发票'); 

        $credit_status=!empty($value['credit_status']) && $value['credit_status']==1?'是':'否'; //学分信息填写状态
         //职称级别
        $credit_type='';
        switch($value['credit_type']){  
            case 114;
                $credit_type='初级';
                break;
            case 115;
                $credit_type='中级';
                break;
            case 116;
                $credit_type='副高及以上';
                break;
        }
        $PHPSheet->setCellValue('A'.$i,''.$value['update_time'].'');
        $PHPSheet->setCellValue('B'.$i,''.$value['order_number'].'');
        $PHPSheet->setCellValue('C'.$i,''.$value['email'].'');
        $PHPSheet->setCellValue('D'.$i,''.$value['user_name'].'');
        $PHPSheet->setCellValue('E'.$i,''.$value['gender'].'');
        $PHPSheet->setCellValue('F'.$i,''.$value['department'].'');
        $PHPSheet->setCellValue('G'.$i,''.$value['job_id'].'');
        $PHPSheet->setCellValue('H'.$i,''.$credit_type.'');
        $PHPSheet->setCellValue('I'.$i,''.$province_id.'');
        $PHPSheet->setCellValue('J'.$i,''.$sti.'');
        $PHPSheet->setCellValue("K".$i,''.$value['org_name'].'');
        $PHPSheet->setCellValue("L".$i,''.$value['tel'].'');
        $PHPSheet->setCellValue("M".$i,''.$value['ticket_name'].'');
		
        $PHPSheet->setCellValue("N".$i,''.$value['pay_state'].'');
        $PHPSheet->setCellValue("O".$i,''.$value['prices'].'');
        $PHPSheet->setCellValue("P".$i,''.$value['price'].'');
        $PHPSheet->setCellValue("Q".$i,''.$value['actual_pay'].'');
        $PHPSheet->setCellValue("R".$i,''.$value['actual_pays'].'');
        $PHPSheet->setCellValue("S".$i,''.$value['pay_number'].'');
		
        $PHPSheet->setCellValue("T".$i,''.$value['bill_is'].'');
        $PHPSheet->setCellValue("U".$i,''.$bill_type.'');
        $PHPSheet->setCellValue("V".$i,''.$value['bill_title'].'');
        $PHPSheet->setCellValue("W".$i,''.$value['tax_num']." ");
        //$PHPSheet->setCellValue("X".$i,''.$credit_status.'');
		$PHPSheet->setCellValue("X".$i,''.$value['address'].'');
        $PHPSheet->setCellValue("Y".$i,''.$value['credit_time'].'');
        $PHPSheet->setCellValue("Z".$i,''.$value['graduation_time'].'');


        $PHPSheet->setCellValue("AA".$i,''.$value['education_id']." ");
        $PHPSheet->setCellValue("AB".$i,''.$value['degree_id']." ");
		$PHPSheet->setCellValue("AC".$i,''.$value['basic_level']." ");
		$PHPSheet->setCellValue("AD".$i,''.$value['unit_address']." ");
		$PHPSheet->setCellValue("AE".$i,''.$value['card']." ");
		$PHPSheet->setCellValue("AF".$i,''.$value['unit_tel']." ");
		$PHPSheet->setCellValue("AG".$i,''.$value['start_time']." ");
		$PHPSheet->setCellValue("AH".$i,''.$value['end_time']." ");
		$degree8=Title_Level($value['credit_type'],"");

		if($degree8){
			if($value['credit_title']==0){
			$degree8=$degree8[0];
			}else{
				$degree8=$degree8[$value['credit_title']-1];
			}
		}else{
			$degree8="无";
		}
		//echo ($value['user_name']."----".$degree8."<br>");
		$PHPSheet->setCellValue("AI".$i,''.$degree8." ");
		$PHPSheet->setCellValue("AJ".$i,''.$value['official_invoice']." ");



/*         $signup_detail=signup_detail($value['creator_id'],$value['convention_id']);  
        $s=23;
        foreach($signup_detail as $vo){
            $s++;
            if($vo['sign_id']){
                $filed = Db::table("convention_sign_detail")
                ->where('fid',$vo['value'])
                ->value("detail_name");
                    
            $filed=empty($filed)?"否":$filed;
            if(!isset($cellName[$s])) continue;
            //echo Db::table("convention_sign_detail")->getLastSql().";<br>";
                $PHPSheet->setCellValue($cellName[$s].$i,''.$filed.'');
            }
        } */
        $i++;
    }
    ob_end_clean();//清除缓冲区,避免乱码
    $filename="会议报名记录.xlsx";
    $PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel,"Excel2007");
    header('Content-Disposition: attachment;filename="会议报名记录.xlsx"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //表示在$path路径下面生成demo.xlsx文件
    $PHPWriter->save("php://output");die;
}

/* 获取报名后自定义字段的内容处理 */
function signup_detail($uid,$convention_id)
{
    $where=['creator_id'=>$uid,'convention_id'=>$convention_id,'record_status'=>1];
    $signup_detail = Db::table("v_convention_sign_detail")
            ->where($where)
            ->order(['sort'=>'asc'])
            ->select();
    return $signup_detail;
}

/* 省市区*/
function base_region($pid,$fid)
{
    $name = Db::table("base_region_conf")
            ->where(['pid'=>$pid,'fid'=>$fid])
            ->value('region_name');
    return $name;
}



/* 压缩整个目录 */
function addFileToZip($path,$zip){
    $handler=opendir($path); //打开当前文件夹由$path指定。
    while(($filename=readdir($handler))!==false){
        if($filename != "." && $filename != ".."){//文件夹文件名字为'.'和‘..’，不要对他们进行操作
            if(is_dir($path."/".$filename)){// 如果读取的某个对象是文件夹，则递归
                addFileToZip($path."/".$filename, $zip);
            }else{ //将文件加入zip对象
                $zip->addFile($path."/".$filename);
            }
        }
    }
    @closedir($path);
}
/* 生成zip文件 */
function pro_zip($aFiles,$sname){
    //$path =ROOT_PATH. 'public' . DS . 'request_logs/sific_log.txt';
    $filename =ROOT_PATH. 'public' . DS ."Zip/$sname.zip";
	if(!file_exists($filename)){
		exec("zip -r $filename");
	}else{
		exec("rm -rf $filename");
	}
    $zip = new \ZipArchive();
        //打开压缩包
    if($zip->open($filename,\ZipArchive::CREATE)==TRUE){
        //var_dump($filename);die;  
        //self::addFileToZip($aFiles,$zip);     
        foreach ($aFiles as $file){
            //var_dump($file);die;
            //向压缩包中添加文件        
            $zip->addFile($file,basename($file));   
        }        
        $zip->close();
    }
    //下面是输出下载;
    header ( "Cache-Control: max-age=0" );
    header ( "Content-Description: File Transfer" );
    header ( 'Content-disposition: attachment; filename=' . basename ( $filename ) ); // 文件名
    header ( "Content-Type: application/zip" ); // zip格式的
    header ( "Content-Transfer-Encoding: binary" ); // 告诉浏览器，这是二进制文件
    header ( 'Content-Length: ' . filesize ( $filename ) ); // 告诉浏览器，文件大小
    @readfile ( $filename );//输出文件;
}

/* HTML生成PDF */
function pdf(){
    require_once(EXTEND_PATH.'Tcpdf/tcpdf.php'); 
    //实例化 
    $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false); 

    // 设置文档信息 
    $pdf->SetCreator('Helloweba'); 
    $pdf->SetAuthor('yueguangguang'); 
    $pdf->SetTitle('上海市院内感染质控中心'); 
    $pdf->SetSubject('TCPDF Tutorial'); 
    $pdf->SetKeywords('TCPDF, PDF, PHP'); 
    
    // 设置页眉和页脚信息 
    $pdf->SetHeaderData('logo.png', 30, '',  '上海市院内感染质控中心2018年下半年督查',array(255,0,0), array(0,0,0)); 
    //$pdf->setFooterData(array(0,64,0), array(0,64,128)); 
    
    // 设置页眉和页脚字体 
    $pdf->setHeaderFont(Array('stsongstdlight', '', '18')); 
    //$pdf->setFooterFont(Array('helvetica', '', '8')); 
    
    // 设置默认等宽字体 
    $pdf->SetDefaultMonospacedFont('courier'); 
    
    // 设置间距 
    $pdf->SetMargins(15, 27, 20); 
    $pdf->SetHeaderMargin(5); 
    //$pdf->SetFooterMargin(10); 
    
    // 设置分页 
    $pdf->SetAutoPageBreak(TRUE, 25); 

    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    // set default font subsetting mode 
    $pdf->setFontSubsetting(true); 
    
    //设置字体 
    $pdf->SetFont('stsongstdlight', '', 12); 
    
    $pdf->AddPage();
    $padding='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $time="2018年9月10日";
    $html ="
        <style>
        .ct{width: 595px; height: 842px; margin:20px auto; padding: 47px 47px 20px 47px; background: #fff;}
        .info{padding-right: 25px;font-size:14px;}
        .qm_img{width: 155px; height: 60px; margin-left: 25px;}
        .info2{color: #333;text-align: right; font-size:14px; }
        .gaiz{width: 101px; height: 101px;}
        .info3{color: #333; font-size:14px}
        .gaiz img{width: 200px; height: 110px;}
        </style>
        <div class='ct'>
            <p><strong>基础信息：</strong></p>      
            <div class='info'>$padding 医院名称：复旦大学附属妇产科医院</div>
            <div class='info'>$padding 检查时间：2018-8-20</div>
            <div class='info'>$padding 检查者：王小二、张三</div>
            <p><strong>现场打分：</strong></p> 
            <div class='info'>$padding 总分：90</div>
            <div class='info'>$padding 得分：80</div>
            <p><strong>存在不足：</strong></p>";
    $html.="      
            <div class='info'>$padding
                一、医院感染管理委员会会议：每年至少2次（第一部分-手卫生检查）<br>
                $padding$padding 1.无记录扣1分。<br>
                $padding$padding 2.无记录扣1分。<br>
            $padding 评价：医务人员血源性病原体职业暴露评价医务人员血源性病原体职业暴露评价医务人员血源性病原体职业暴露</div>";

    $html.='       
            <p><strong>医院签名：</strong></p>
                <img src="http://sific.vip/uploads/20181009/68c5e8bf355bb2de4cf7f8f55b19ac04.jpg" class="qm_img"/>
            <div class="info2"><div class="gaiz"><img src="http://msjfu.com/uploads/147.png" /></div>'.$time.'  </div><br/>
            <div class="info3">地址：上海市枫林路180号4号楼322 邮编：2000032   办公电话：64041990-2307   传真：64038770</div>
            <div class="info3">内部交流：<a href="#">www.baidu.com</a>   网址：<a href="#">bbs.icchina.org.cn</a>   联系人：13918249861(高晓东)</div>
        </div>
    '; 
    $dir =ROOT_PATH. 'public' . DS . 'uploads';
    $pdf->writeHTML($html);
    //输出PDF 
    $pdf->Output("$dir/t.pdf", 'F');
}


//保存文件路径到数据库  APP上传图片
function save_file_to_db($path,$type,$uid){
    $data = [
        'file_name'=>'',
        'file_path'=>$path,
        'file_size'=>0,
        'source_type'=>$type,
        'create_time'=>date("Y-m-d H:i:s", time()),
        'creator_id'=>$uid
    ];
    $source_id = Db::table('base_source_info')->insertGetId($data);
    return $source_id ? $source_id : 0;
}
function base64_image_content($base64_image_content,$path){
    //匹配出图片的格式
    $tmp = date('Ymd',time());
    $new_file = $path.$tmp;
    if(!file_exists($new_file)){
        //检查是否有该文件夹，如果没有就创建，并给予最高权限
        mkdir($new_file, 0777, true);
    }
    $tmp_name =guid().".png";
    $new_file = $new_file."/".$tmp_name;
    if (file_put_contents($new_file, base64_decode($base64_image_content))){
        $info = [
            'path'=>$tmp."/".$tmp_name,
            'size'=>filesize($new_file)
        ];
        return $info;
    }else{
        return false;
    }
}
//生成UUID
function guid(){ 
    mt_srand((double)microtime()*10000);
    $charid = strtoupper(md5(uniqid(rand(), true))); 
    $hyphen = chr(45);
    $uuid = substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12);
    return $uuid; 
}

//鉴黄 内容
function CheckContent($content){ 
    $dir =ROOT_PATH. 'public' . DS . 'key.txt';
    $file=file_get_contents("$dir");
    $file=explode("|",$file);
    $arr=[];
    foreach($file as $v){
        $arr[]="/$v/";
    }
    $two="***";
    $content =preg_replace($arr,$two,$content);
    return $content;
}

/**
 * 直播 录播 权限判断
*/
function Comment_authority($uid,$training_id,$product_type){
	$sql="SELECT COUNT(*) AS count FROM product_info pi 
			LEFT JOIN `product_order_info` poi on pi.fid=poi.product_id 
			WHERE  (pi.price=0 and pi.`product_type` = $product_type AND pi.`fid` = $training_id) or 
			(poi.`order_status` = 2  AND  poi.`user_id` = $uid  AND poi.`product_id` = $training_id) LIMIT 1";
    $result=Db::query($sql);
    return isset($result[0]['count'])?$result[0]['count']:0;
}

/* 获取基础分类FID*/
function base_class($name,$type)
{
    $class_id = Db::table("base_class_conf")
            ->where(['class_name_zh'=>$name,'record_status'=>1,"class_type"=>$type])
            ->value('fid');
    return $class_id>0?$class_id:0;
}
/**
 * 用户数据同步  导入excel同步数据=库
 */
function user_base() {
    //找到当前脚本所在路径
    $path = dirname(__FILE__); 
    //引入IOFactory.php 文件里面的PHPExcel_IOFactory这个类
    import('PHPExcel.Classes.PHPExcel');
    import('PHPExcel.Classes.PHPExcel.IOFactory.PHPExcel_IOFactory');
    $objPHPExcel = new \PHPExcel();

    $file = request()->file('file');
    if(!$file){
        /* $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/exam');
        $filename = $file->getInfo()["name"];
        $path = '/public/uploads/exam/'.$info->getSaveName(); */
        $path=ROOT_PATH . 'public' . DS ."2018年参会者个人信息.xlsx";
        $objReader=\PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel=$objReader->load($path,'utf-8');
        $sheet=$objPHPExcel->getSheet(0);//获取第一个工作表
        $highestRow=$sheet->getHighestRow();//取得总行数
        $highestColumn=$sheet->getHighestColumn(); //取得总列数
        $excel_array=$objPHPExcel->getsheet(0)->toArray();   //转换为数组格式
        array_shift($excel_array);  //删除第一个数组(标题);
        $data = [];
        foreach($excel_array as $k=>$v) {
            $data[$k]['email'] = $v[1];
            $data[$k]['user_name'] = $v[2];
            $data[$k]['nick_name'] = $v[2];
            $data[$k]['credit_time'] = $v[3];
            $data[$k]['gender'] = $v[4]=="先生"?1:2;

            //学位
            $degree5=0;
            $degree7=0;
            $degree8=0;
            $degree10=0;
            $degree11=0;

            if($v[5]){
                $degree5=base_class($v[5],1);
            }
            
            if($v[7]){
                $degree7=base_class($v[7],10);
            }
            
            if($v[8]){
                $degree8=Title_Level($degree7,$v[8]);
            }
            if($v[10]){
                $degree10=base_class($v[10],2);
            }
            
            if($v[11]){
                $degree11=base_class($v[11],9);
            }

            $data[$k]['job_id'] =$v[5];
            $data[$k]['department'] = $v[6];
            $data[$k]['credit_type'] = $degree7;
            $data[$k]['credit_title'] = $degree8;
            $data[$k]['graduation_time'] = $v[9];
            $data[$k]['education_id'] =$degree10;
            $data[$k]['degree_id'] =$degree11;

            //省市
            $arr=explode("/",$v[12]);
            $province_id = Db::table("base_region_conf")->where("region_name","like","%".$arr[0]."%")->value('fid');
            $city_id = Db::table("base_region_conf")->where("region_name",$arr[1])->value('fid');
            //var_dump($province_id,$city_id);die;
            $data[$k]['province_id'] = $province_id;
            $data[$k]['city_id'] =$city_id;
            $data[$k]['diy_org'] = $v[13];
            $data[$k]['basic_level'] =$v[14]=="是"?1:0;
            $data[$k]['unit_address'] = $v[15];
            $data[$k]['card'] = $v[16];
            $data[$k]['unit_tel'] = $v[17]=="--"?"":$v[17];
            $data[$k]['unit_fax'] =$v[18]=="--"?"":$v[18];
            $data[$k]['tel'] = $v[19]=="--"?"":$v[19];
            $data[$k]['password'] = "e10adc3949ba59abbe56e057f20f883e";
        }

        $res = Db::name("enduser_info")->insertAll($data);
        //unlink($path); //删除excel文件

        die;
        if($res){
            return json(["code"=>200,"msg"=>"导入成功"]);
        }else{
            return json(["code"=>40000,"msg"=>"导入失败"]);
        }
    }
}


if(!function_exists('Title_Level')){
	/**
	 * 年会报名 根据职称级别获取职称分类
	 *@param $type 1.初级 2.中级 3.副高级以上
	 *@param $key 三个级别索引
	 *return string
	 */
	function Title_Level($type,$key){
		$class_type='';
		$arr=[];
        switch($type){
            case 114:
				$arr=[
					"医师",
					"医士",
					"药师",
					"药士",
					"护师",
					"护士",
					"技师",
					"技士",
					"助理讲师",
					"研究实习员",
					"非医疗类"
				];
            break;
            case 115:
				$arr=[
					"主治医师",
					"主管药师",
					"主管护师",
					"主管技师",
					"讲师",
					"助理研究员",
					"非医疗类"
				];
            break;
            case 116:
				$arr=[
					"主任医师",
					"主任药师",
					"主任护师",
					"主任技师",
					"教授",
					"研究员",
					"副主任医师",
					"副主任药师",
					"副主任护师",
					"副主任技师",
					"副教授",
					"副研究员",
					"非医疗类"
				];
            break;	
        }
		
		if(empty($key)){
			$class_type=$arr;
		}else{
			$class_type=array_search($key,$arr);
		}
        return $class_type;
	}
}

    /* 根据首字母 获取演讲嘉宾 */
	function getFirstChar($s){
        $s0 = mb_substr($s,0,3); //获取名字的姓
        $s = iconv('UTF-8','gbk', $s0); //将UTF-8转换成GB2312编码
        //dump($s0);
        if (ord($s0)>128) {
            //汉字开头，汉字没有以U、V开头的
            $asc=ord($s{0})*256+ord($s{1})-65536;
            if($asc>=-20319 and $asc<=-20284)return "A";
            if($asc>=-20283 and $asc<=-19776)return "B";
            if($asc>=-19775 and $asc<=-19219)return "C";
            if($asc>=-19218 and $asc<=-18711)return "D";
            if($asc>=-18710 and $asc<=-18527)return "E";
            if($asc>=-18526 and $asc<=-18240)return "F";
            if($asc>=-18239 and $asc<=-17760)return "G";
            if($asc>=-17759 and $asc<=-17248)return "H";
            if($asc>=-17247 and $asc<=-17418)return "I";
            if($asc>=-17417 and $asc<=-16475)return "J";
            if($asc>=-16474 and $asc<=-16213)return "K";
            if($asc>=-16212 and $asc<=-15641)return "L";
            if($asc>=-15640 and $asc<=-15166)return "M";
            if($asc>=-15165 and $asc<=-14923)return "N";
            if($asc>=-14922 and $asc<=-14915)return "O";
            if($asc>=-14914 and $asc<=-14631)return "P";
            if($asc>=-14630 and $asc<=-14150)return "Q";
            if($asc>=-14149 and $asc<=-14091)return "R";
            if($asc>=-14090 and $asc<=-13319)return "S";
            if($asc>=-13318 and $asc<=-12839)return "T";
            if($asc>=-12838 and $asc<=-12557)return "W";
            if($asc>=-12556 and $asc<=-11848)return "X";
            if($asc>=-11847 and $asc<=-11056)return "Y";
            if($asc>=-11055 and $asc<=-10247)return "Z";
        }else if(ord($s)>=48 and ord($s)<=57){ 
            //数字开头
            switch(iconv_substr($s,0,1,'utf-8')){
                case 1:return "Y";
                case 2:return "E";
                case 3:return "S";
                case 4:return "S";
                case 5:return "W";
                case 6:return "L";
                case 7:return "Q";
                case 8:return "B";
                case 9:return "J";
                case 0:return "L";
            }
        }else if(ord($s)>=65 and ord($s)<=90){ //大写英文开头
            return substr($s,0,1);
        }else if(ord($s)>=97 and ord($s)<=122){ //小写英文开头
            return strtoupper(substr($s,0,1));
        }else{
            return iconv_substr($s0,0,1,'utf-8');
        //中英混合的词语，不适合上面的各种情况，因此直接提取首个字符即可
        }
    }
	
	/* 省市区排序处理 */
	function class_sort($data){
		$array=[];
		if(!empty($data)){	
			foreach($data as &$vo){
				$user= getFirstChar($vo['region_name']);
				$vo['sort']=$user;
			}
			$last_names = array_column($data,'sort');
			array_multisort($last_names,SORT_ASC,$data);
			$array=$data;
		}
		return $array;
	}

	/* 表单必填项标记 */
	function html_sign(){
		echo "<span style='color:red;'>*</span>";
	}
	
    function Admin_Login($UID){
		//如果登录常量为空，表示没有登录
		if(is_null($UID)){
			echo "<script>var index = parent.parent.parent.layer.getFrameIndex(window.name);
			parent.parent.parent.layer.close(index);parent.parent.parent.window.location.href='/admin';</script>";
			exit;
		}
    }















































































































































