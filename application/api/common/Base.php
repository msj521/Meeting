<?php
namespace app\api\common;

use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use app\api\model\TUser;
use app\api\model\TUserToken;
use app\api\model\VUsercode;
use app\api\model\TUsercode;
use Qcloud\Sms\SmsSingleSender;
use app\api\model\VSysUserRoleGroup;
use app\api\model\TSysUserRoleGroup;
//use My\RedisPackage;
use think\Cache;

class Base extends Controller {

    public function _initialize() {
        parent::_initialize();   
        $URL=request()->domain();
        define("URL", $URL);
		define("user_name", Session::get('user_name'));
		$path=$this->request->path();
        $params=request()->param();

        if (strpos(request()->url(),"convention_base") !== false){
            return;
        }
        
        if (isset($params['test']) || isset($params['tes'])) {
            //接口测试
            //self::Version();
        }else{
            // 1.验证签名
            self::checkSign($params);
            //2.验证access_token
            //self::access_token($params);
            //3.验证接口是否可用
            self::access_api($params);
            //4.发现新版本
            self::Version();
            
        }
			//接口请求日志
			//RequestLog("$path",$params);
	}
        //self::Version();
        // 切换到redis操作
        //$redis=new Redis;
        //var_dump($redis);die;
        //获取缓存
        //$this->getRedisValue();
 
    /**
     * @return string|void
     * 1.签名验证
     */
    public function CheckSign($param){
        // $param=array_filter($param);
        $clientSign=isset($param['sign'])?$param['sign']:null;
        $app_key=isset($param['key'])?$param['key']:null;
        $time=isset($param['time'])?$param['time']:null;
        $app_secret = Db::table('app_info')
                ->where(['app_key'=>$app_key,'record_status'=>1])
                ->value('app_secret');
        //传值验证
        if(empty($clientSign)){
            $data = [
                'code'=>'420',
                'msg'=>'请求失败！sign丢失'
            ];
        }elseif(empty($app_secret) || !isset($time)){
            $data = [
                'code'=>'421',
                'msg'=>'请求失败！无效访问'
            ];
        }elseif(isset($time) && strtotime('+6000 second',$time)<strtotime("now")){
            // var_dump(strtotime('+6000 second',$param['time']));
            // var_dump(strtotime("now"));
            // var_dump(strtotime('+6000 second',$param['time'])<strtotime("now"));die;
            $data = [
                'code'=>'422',
                'msg'=>'请求失效！接口失效'
            ];
        }else{
            //真正签名
            $reserverstr="key$app_key"."time$time".$app_secret;
            $reserverSign = strtoupper(md5($reserverstr));
            if($clientSign!=$reserverSign){
                $data = [
                    'code'=>'423',
                    'msg'=>'请求失败！签名错误'
                ];
            }else{
                $data = [
                    'code'=>'200',
                    'msg'=>'请求成功'
                ];
            }
        }
        return  json_encode($data); 
    }

    /**
     * @return string|void
     * 2.验证access_token
     */
    public function access_token($params){
        if (isset($params['devicetype'])) {
                # web跳过token验证  App-Login里的很多方法都不需要登录，所以绕开token检测
                $type = get_class($this);
                if ($params['devicetype'] != 'web' && $type != 'app\api\controller\Login') {
                    $user_id =isset($params['uid']) ? $params['uid'] : 0;
                    $access_token =isset($params['token']) ? $params['token'] : 0;
                    if (!$this->checkToken($user_id,$access_token)) {
                        $data = [
                            'code'=>'420',
                            'msg'=>'请求失败！请重新登录'
                        ];
                        echo json_encode($data);exit;
                    }
                }
        }else{
            $data=[
                'code' => '430',
                'msg' => 'devicetype丢失'
            ];
            echo json_encode($data);exit;
        }
    }

    /**
     * @return string|void
     * 3.验证接口是否可用
     */
    public function access_api($params){
        $app_key = isset($params['key'])?$params['key']:'';
        $app_info = Db::table('app_info')->where(['app_key'=>$app_key,'record_status'=>1])->find();
        $app_id = isset($app_info['fid']) ? $app_info['fid'] : 0;
        $version_id = $app_info['version_id'];
        $route = request()->path();
        $app_acl_info = Db::query("select * from app_acl_info where app_id=$app_id and record_status=1 and UNIX_TIMESTAMP(expire_time)>UNIX_TIMESTAMP(NOW())");
        if (empty($app_acl_info)) {
            $data=[
                'code' => '412',
                'msg' => '无权访问'
            ];
            echo json_encode($data);exit;
        }else{
            $flag = false;
            foreach ($app_acl_info as $vo) {
                if ($vo['function']=='%' || $vo['function']==$route) {
                    $flag = true;
                    break;
                }
            }
            if (!$flag) {
                $data=[
                    'code' => '412',
                    'msg' => '无权访问'
                ];
                echo json_encode($data);exit;
            }
        }
    }
    
    /**
     * @return string|void
     * 4.发现新版本
     */
    public function Version(){
        $params = request()->param();
        $uid =isset($params['uid'])?$params['uid']:0;
        $devicetype =isset($params['devicetype'])?$params['devicetype']:'';
        //版本号
        $version_no = isset($params['appVersion']) ? intval($params['appVersion']) : 0;
        //第一条广告的记录不验证版本
        if (strpos(request()->url(),"start_ad") !== false){
            return;
        }

        $app_type = 0;
        if ($devicetype == 'android'){
            $app_type = 1;
        }else if ($devicetype == 'ios'){
			if($version_no=="1.0.4") return;
            $app_type = 2;
        }else if ($devicetype == 'web'){
            $app_type = 3;
        }
        //所有版本中的最新版本
        $where = ['record_status'=>1,'app_postfix'=>$app_type];
        $version_list = Db::table('v_version')->where($where)->select();
        $new_list = [];
        foreach ($version_list as $vo) {
            if ($vo['version_no']>$version_no){
                $new_list[] = $vo;
                if ($vo['force_type']==3){
                    $data = [
                        'code'=>'9999',
                        'msg'=>'发现新版本，请更新后使用',
                        'data'=>$vo
                    ];
                    echo json_encode($data);exit;
                }
            }
        }
    }

    //==========方法===========
    //生成接口RedisKey
    public function getRedisKey(){
        $requestParams=request()->param();
        unset($requestParams['sign']);
        unset($requestParams['time']);
        $str = "";
        foreach ($requestParams as $key => $value) {
            $str .= json_encode($key).json_encode($value);
        }
        $str = md5($str);
        return $str;
    }
    //设置缓存
    public function setRedisValue($data,$exprie=0){
        // $redis = new RedisPackage();
        // $redisKey = $this->getRedisKey();
        // $redis::set($redisKey,$data,$exprie);
    }
    //获取缓存
    public function getRedisValue(){
        $redis = new RedisPackage();
        $redisKey = $this->getRedisKey();
        $redisValue = $redis::get($redisKey);
        if (!empty($redisValue)) {
            echo $redisValue;exit;
        }
    }
    //检验token
    public function checkToken($user_id,$token){
        $user_token = Db::table('app_token_info')->where(['user_id'=>$user_id,'access_token'=>$token,'record_status'=>1])->find();
        if (empty($user_token)) {
            return false;
        }
        $expire_time = $user_token['expire_time'];
        $expiration = $user_token['expiration'];
        if (strtotime($expire_time) < strtotime('now')) {
            return false;
        }
        return true;
    }

    /**
     * 获取所有 以 HTTP开头的header参数
     * @return array
     */
    public function getAllHeaders(){
        $headers = array();
        foreach($_SERVER as $key=>$value){
            var_dump($key);
            if(substr($key, 0, 10)==='HTTP_SIFIC'){
                $key = substr($key, 10);
                $key = str_replace('_', ' ', $key);
                $key = str_replace(' ', '-', $key);
                $key = strtolower($key);
                $headers[$key] = $value;
            }
        }
        exit;
        return $headers;
    }

    /**
    *判断用户是否登录 在后台入口调用
    */
    public  function Is_Login(){
      //如果登录常量为空，表示没有登录
      if(is_null(FID)){
        $this->redirect("/login");
      }
    }

    /**
    *判断用户如果已经登录  不允许再次登录
    */
    public  function web_Login() {
      //如果登录常量为空，表示没有登录
      if(!is_null(FID) && $_POST['FTel']==FTel){
        $this->error("请不要重复登录~~","/");
      }
    }
	
	
	
	/**
	 * PHP 汉字转拼音
	 *  echo CUtf8_PY::encode('字符串'); //编码为拼音首字母
	 *  echo CUtf8_PY::encode('字符串', 'all'); //编码为全拼音
	 */
    private static $_aMaps = array(
        'a'=>-20319,'ai'=>-20317,'an'=>-20304,'ang'=>-20295,'ao'=>-20292,
        'ba'=>-20283,'bai'=>-20265,'ban'=>-20257,'bang'=>-20242,'bao'=>-20230,'bei'=>-20051,'ben'=>-20036,'beng'=>-20032,'bi'=>-20026,'bian'=>-20002,'biao'=>-19990,'bie'=>-19986,'bin'=>-19982,'bing'=>-19976,'bo'=>-19805,'bu'=>-19784,
        'ca'=>-19775,'cai'=>-19774,'can'=>-19763,'cang'=>-19756,'cao'=>-19751,'ce'=>-19746,'ceng'=>-19741,'cha'=>-19739,'chai'=>-19728,'chan'=>-19725,'chang'=>-19715,'chao'=>-19540,'che'=>-19531,'chen'=>-19525,'cheng'=>-19515,'chi'=>-19500,'chong'=>-19484,'chou'=>-19479,'chu'=>-19467,'chuai'=>-19289,'chuan'=>-19288,'chuang'=>-19281,'chui'=>-19275,'chun'=>-19270,'chuo'=>-19263,'ci'=>-19261,'cong'=>-19249,'cou'=>-19243,'cu'=>-19242,'cuan'=>-19238,'cui'=>-19235,'cun'=>-19227,'cuo'=>-19224,
        'da'=>-19218,'dai'=>-19212,'dan'=>-19038,'dang'=>-19023,'dao'=>-19018,'de'=>-19006,'deng'=>-19003,'di'=>-18996,'dian'=>-18977,'diao'=>-18961,'die'=>-18952,'ding'=>-18783,'diu'=>-18774,'dong'=>-18773,'dou'=>-18763,'du'=>-18756,'duan'=>-18741,'dui'=>-18735,'dun'=>-18731,'duo'=>-18722,
        'e'=>-18710,'en'=>-18697,'er'=>-18696,
        'fa'=>-18526,'fan'=>-18518,'fang'=>-18501,'fei'=>-18490,'fen'=>-18478,'feng'=>-18463,'fo'=>-18448,'fou'=>-18447,'fu'=>-18446,
        'ga'=>-18239,'gai'=>-18237,'gan'=>-18231,'gang'=>-18220,'gao'=>-18211,'ge'=>-18201,'gei'=>-18184,'gen'=>-18183,'geng'=>-18181,'gong'=>-18012,'gou'=>-17997,'gu'=>-17988,'gua'=>-17970,'guai'=>-17964,'guan'=>-17961,'guang'=>-17950,'gui'=>-17947,'gun'=>-17931,'guo'=>-17928,
        'ha'=>-17922,'hai'=>-17759,'han'=>-17752,'hang'=>-17733,'hao'=>-17730,'he'=>-17721,'hei'=>-17703,'hen'=>-17701,'heng'=>-17697,'hong'=>-17692,'hou'=>-17683,'hu'=>-17676,'hua'=>-17496,'huai'=>-17487,'huan'=>-17482,'huang'=>-17468,'hui'=>-17454,'hun'=>-17433,'huo'=>-17427,
        'ji'=>-17417,'jia'=>-17202,'jian'=>-17185,'jiang'=>-16983,'jiao'=>-16970,'jie'=>-16942,'jin'=>-16915,'jing'=>-16733,'jiong'=>-16708,'jiu'=>-16706,'ju'=>-16689,'juan'=>-16664,'jue'=>-16657,'jun'=>-16647,
        'ka'=>-16474,'kai'=>-16470,'kan'=>-16465,'kang'=>-16459,'kao'=>-16452,'ke'=>-16448,'ken'=>-16433,'keng'=>-16429,'kong'=>-16427,'kou'=>-16423,'ku'=>-16419,'kua'=>-16412,'kuai'=>-16407,'kuan'=>-16403,'kuang'=>-16401,'kui'=>-16393,'kun'=>-16220,'kuo'=>-16216,
        'la'=>-16212,'lai'=>-16205,'lan'=>-16202,'lang'=>-16187,'lao'=>-16180,'le'=>-16171,'lei'=>-16169,'leng'=>-16158,'li'=>-16155,'lia'=>-15959,'lian'=>-15958,'liang'=>-15944,'liao'=>-15933,'lie'=>-15920,'lin'=>-15915,'ling'=>-15903,'liu'=>-15889,'long'=>-15878,'lou'=>-15707,'lu'=>-15701,'lv'=>-15681,'luan'=>-15667,'lue'=>-15661,'lun'=>-15659,'luo'=>-15652,
        'ma'=>-15640,'mai'=>-15631,'man'=>-15625,'mang'=>-15454,'mao'=>-15448,'me'=>-15436,'mei'=>-15435,'men'=>-15419,'meng'=>-15416,'mi'=>-15408,'mian'=>-15394,'miao'=>-15385,'mie'=>-15377,'min'=>-15375,'ming'=>-15369,'miu'=>-15363,'mo'=>-15362,'mou'=>-15183,'mu'=>-15180,
        'na'=>-15165,'nai'=>-15158,'nan'=>-15153,'nang'=>-15150,'nao'=>-15149,'ne'=>-15144,'nei'=>-15143,'nen'=>-15141,'neng'=>-15140,'ni'=>-15139,'nian'=>-15128,'niang'=>-15121,'niao'=>-15119,'nie'=>-15117,'nin'=>-15110,'ning'=>-15109,'niu'=>-14941,'nong'=>-14937,'nu'=>-14933,'nv'=>-14930,'nuan'=>-14929,'nue'=>-14928,'nuo'=>-14926,
        'o'=>-14922,'ou'=>-14921,
        'pa'=>-14914,'pai'=>-14908,'pan'=>-14902,'pang'=>-14894,'pao'=>-14889,'pei'=>-14882,'pen'=>-14873,'peng'=>-14871,'pi'=>-14857,'pian'=>-14678,'piao'=>-14674,'pie'=>-14670,'pin'=>-14668,'ping'=>-14663,'po'=>-14654,'pu'=>-14645,
        'qi'=>-14630,'qia'=>-14594,'qian'=>-14429,'qiang'=>-14407,'qiao'=>-14399,'qie'=>-14384,'qin'=>-14379,'qing'=>-14368,'qiong'=>-14355,'qiu'=>-14353,'qu'=>-14345,'quan'=>-14170,'que'=>-14159,'qun'=>-14151,
        'ran'=>-14149,'rang'=>-14145,'rao'=>-14140,'re'=>-14137,'ren'=>-14135,'reng'=>-14125,'ri'=>-14123,'rong'=>-14122,'rou'=>-14112,'ru'=>-14109,'ruan'=>-14099,'rui'=>-14097,'run'=>-14094,'ruo'=>-14092,
        'sa'=>-14090,'sai'=>-14087,'san'=>-14083,'sang'=>-13917,'sao'=>-13914,'se'=>-13910,'sen'=>-13907,'seng'=>-13906,'sha'=>-13905,'shai'=>-13896,'shan'=>-13894,'shang'=>-13878,'shao'=>-13870,'she'=>-13859,'shen'=>-13847,'sheng'=>-13831,'shi'=>-13658,'shou'=>-13611,'shu'=>-13601,'shua'=>-13406,'shuai'=>-13404,'shuan'=>-13400,'shuang'=>-13398,'shui'=>-13395,'shun'=>-13391,'shuo'=>-13387,'si'=>-13383,'song'=>-13367,'sou'=>-13359,'su'=>-13356,'suan'=>-13343,'sui'=>-13340,'sun'=>-13329,'suo'=>-13326,
        'ta'=>-13318,'tai'=>-13147,'tan'=>-13138,'tang'=>-13120,'tao'=>-13107,'te'=>-13096,'teng'=>-13095,'ti'=>-13091,'tian'=>-13076,'tiao'=>-13068,'tie'=>-13063,'ting'=>-13060,'tong'=>-12888,'tou'=>-12875,'tu'=>-12871,'tuan'=>-12860,'tui'=>-12858,'tun'=>-12852,'tuo'=>-12849,
        'wa'=>-12838,'wai'=>-12831,'wan'=>-12829,'wang'=>-12812,'wei'=>-12802,'wen'=>-12607,'weng'=>-12597,'wo'=>-12594,'wu'=>-12585,
        'xi'=>-12556,'xia'=>-12359,'xian'=>-12346,'xiang'=>-12320,'xiao'=>-12300,'xie'=>-12120,'xin'=>-12099,'xing'=>-12089,'xiong'=>-12074,'xiu'=>-12067,'xu'=>-12058,'xuan'=>-12039,'xue'=>-11867,'xun'=>-11861,
        'ya'=>-11847,'yan'=>-11831,'yang'=>-11798,'yao'=>-11781,'ye'=>-11604,'yi'=>-11589,'yin'=>-11536,'ying'=>-11358,'yo'=>-11340,'yong'=>-11339,'you'=>-11324,'yu'=>-11303,'yuan'=>-11097,'yue'=>-11077,'yun'=>-11067,
        'za'=>-11055,'zai'=>-11052,'zan'=>-11045,'zang'=>-11041,'zao'=>-11038,'ze'=>-11024,'zei'=>-11020,'zen'=>-11019,'zeng'=>-11018,'zha'=>-11014,'zhai'=>-10838,'zhan'=>-10832,'zhang'=>-10815,'zhao'=>-10800,'zhe'=>-10790,'zhen'=>-10780,'zheng'=>-10764,'zhi'=>-10587,'zhong'=>-10544,'zhou'=>-10533,'zhu'=>-10519,'zhua'=>-10331,'zhuai'=>-10329,'zhuan'=>-10328,'zhuang'=>-10322,'zhui'=>-10315,'zhun'=>-10309,'zhuo'=>-10307,'zi'=>-10296,'zong'=>-10281,'zou'=>-10274,'zu'=>-10270,'zuan'=>-10262,'zui'=>-10260,'zun'=>-10256,'zuo'=>-10254
    );

    /**
     * 将中文编码成拼音
     * @param string $utf8Data utf8字符集数据
     * @param string $sRetFormat 返回格式 [head:首字母|all:全拼音]
     * @return string
     */
    public static function encode($utf8Data, $sRetFormat='head'){
        $sGBK = iconv('UTF-8', 'GBK', $utf8Data);
        $aBuf = array();
        for ($i=0, $iLoop=strlen($sGBK); $i<$iLoop; $i++) {
            $iChr = ord($sGBK{$i});
            if ($iChr>160)
                $iChr = ($iChr<<8) + ord($sGBK{++$i}) - 65536;
            if ('head' === $sRetFormat)
                $aBuf[] = substr(self::zh2py($iChr),0,1);
            else
                $aBuf[] = self::zh2py($iChr);
        }
        if ('head' === $sRetFormat)
            return implode('', $aBuf);
        else
            return implode('', $aBuf);
    }

    /**
     * 中文转换到拼音(每次处理一个字符)
     * @param number $iWORD 待处理字符双字节
     * @return string 拼音
     */
    private static function zh2py($iWORD) {
        if($iWORD>0 && $iWORD<160 ) {
            return chr($iWORD);
        } elseif ($iWORD<-20319||$iWORD>-10247) {
            return '';
        } else {
            foreach (self::$_aMaps as $py => $code) {
                if($code > $iWORD) break;
                $result = $py;
            }
            return $result;
        }
    }


}