<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

// 注册路由到index模块的News控制器的read操作
return [

    /*前端路由  */
    '/' => 'web/Index/convention',
    '/undefined' => 'web/Index/convention',
    '/lives'=>'web/index/live',
    '/livesinfo'=>'web/index/livesinfo',
    '/meeting'=>'web/index/meeting',
    '/convention'=>'web/index/convention',
    '/video'=>'web/index/video',
    '/videoinfo'=>'web/index/videoinfo',
    '/recordinfo'=>'web/index/recordinfo',
    '/introduce'=>'web/index/introduce',
    '/expertlist'=>'web/index/expertlist',
    '/expertinfo'=>'web/index/expertinfo',
    '/schedule'=>'web/index/schedule',
    '/paper'=>'web/index/paper',  
    '/login'=>'web/index/login',
 	'/register'=>'web/index/register',
    '/userinfo'=>'web/index/userinfo',
    '/mytrain'=>'web/index/mytrain',
    '/mydownload'=>'web/index/mydownload',
    '/signinfo'=>'web/index/signinfo',
    '/zhwen'=>'web/index/zhwen',
    '/courseware'=>'web/index/courseware',
    '/paperji'=>'web/index/paperji',
    '/assembly'=>'web/index/assembly',
    '/manual'=>'web/index/manual',
    '/city'=>'web/index/city',
    '/hotel'=>'web/index/hotel',
    '/huichang'=>'web/index/huichang',
    '/diet'=>'web/index/diet',
    '/lijiejj'=>'web/index/lijiejj',
    '/mishuchu'=>'web/index/mishuchu',
    '/metlive'=>'web/index/metlive',
    '/siginfo'=>'web/index/siginfo',
    '/forget'=>'web/index/forget',
    '/map'=>'web/index/map',
    '/support'=>'web/index/support',
    '/silhouette'=>'web/index/silhouette',
    '/honor'=>'web/index/honor',
    '/searchlist'=>'web/index/searchlist',
    '/shoplist'=>'web/index/shoplist',
    '/meetingname'=>'web/index/meetingname',
	'/newsinfo'=>'web/index/newsinfo',
	'/payment'=>'web/index/payment',
	'/xieyi'=>'web/index/xieyi',
	'/modify'=>'web/index/modify',
	'/about'=>'web/index/about',
	'/copyright'=>'web/index/copyright',
	'/disclaimer'=>'web/index/disclaimer',
	'/report'=>'web/index/report',
	'/contact'=>'web/index/contact',
    '/tips'=>'web/index/tips',
    '/agenda'=>'web/index/agenda',
    '/annual_meeting'=>'web/index/annual_meeting',
    '/annual_meeting_payment'=>'web/index/annual_meeting_payment',
    '/invoices'=>'web/index/invoice',
    '/invoice_info'=>'web/index/invoice_info',
    '/add_abstract'=>'web/index/add_abstract',
	'/abstract_list'=>'web/index/abstract_list',
    /*app路由*/
    '/ip_baomin' => 'web/index/ip_baomin',
	'/ip_guide'=>'web/index/ip_guide',
	'/ip_mishu'=>'web/index/ip_mishu', 
	'/ip_czs'=>'web/index/ip_czs',
	'/ip_zhwen'=>'web/index/ip_zhwen',
	'/ip_pady'=>'web/index/ip_pady',
	'/ip_annual_meeting'=>'web/index/ip_annual_meeting',
	'/ip_annual_meeting02'=>'web/index/ip_annual_meeting02',
	'/ip_annual_meeting03'=>'web/index/ip_annual_meeting03',
	'/ip_fapiao'=>'web/index/ip_fapiao',
    '/ip_contact'=>'web/index/ip_contact',
    '/programme'=>'web/index/programme',
    '/programme_detail'=>'web/index/programme_detail',
    '/excellent_person' => 'web/index/excellent_person',
    '/excellent_introduce' => 'web/index/excellent_introduce',
    '/training_sigin' => 'web/index/Training_Sigin',//SIFIC2019现场签到
    '/gather_invoice' => 'web/index/Gather_Invoice',//SIFIC2019现场发票采集
    '/sign_in' => 'web/index/sign_in',//ICU开班签到
    '/feedback' => 'web/index/feedback',//调研问卷
    '/read_notice' => 'web/index/NoticeRead',
    /* AP路由地址 */
    '[api]'=>[
        '/login/userlogin' => 'api/login/UserLogin',
        '/login/send_code' => 'api/login/SendCode',
        '/login/check_code' => 'api/login/CheckCode',
        '/login/baseinfo' => 'api/login/BaseInfo',
        '/login/org_list' => 'api/login/OrgList',
        '/login/update_pwd' => 'api/login/UpdatePassword',
        '/login/register' => 'api/login/Register',

        '/user/user_info' => 'api/user/UserInfo',
        '/user/update_base' => 'api/user/UpdateBase',
        '/user/upload_img' => 'api/user/UploadImg',
        '/user/update_user_img' => 'api/user/UploadUserImg',
        '/user/order' => 'api/user/Order',
        '/user/notice_convention' => 'api/user/NoticeConvention',
        '/user/notice_list' => 'api/user/NoticeList',
        '/user/read_notice' => 'api/user/NoticeRead',
        '/user/delete' => 'api/user/Delete',
        '/user/collect' => 'api/user/Collect',
        '/user/training' => 'api/user/Training',
        '/user/update_pwd' => 'api/user/UpdatePassword',
        '/user/upload_convention' => 'api/user/UploadConvention',
        '/user/upload_list' => 'api/user/UploadList',
        '/user/sign_convention' => 'api/user/SignConvention',
        '/user/version_info' => 'api/user/Check_Upgrades',
        '/user/convention_schedule' => 'api/user/ConventionSchedule',
        '/user/feed_back' => 'api/user/FeedBack',

        '/live/live_class_list' => 'api/live/LiveClassList',
        '/live/live_list' => 'api/live/LiveList',
        '/live/live_detail' => 'api/live/LiveDetail',
        '/live/expert_detail' => 'api/live/ExpertDetail',
        '/live/live_url' => 'api/live/LiveUrl',
        '/live/live_chat' => 'api/live/Chat',

        '/product/training_class_list' => 'api/product/ProductClassList',
        '/product/training_list' => 'api/product/ProductList',
        '/product/training_detail' => 'api/product/TrainingDetail',
        '/product/video_detail' => 'api/product/VideoDetail',
        '/product/video_url' => 'api/product/VideoUrl',
        '/product/living_detail' => 'api/product/LivingDetail',
        '/product/training_comment_list' => 'api/product/TrainingCommentList',
        '/product/training_comment' => 'api/product/TrainingComment',
        '/product/training_comment_parise' => 'api/product/TrainingCommentParise',
        '/product/training_exam' => 'api/product/TrainingExam',
        '/product/training_upload' => 'api/product/TrainingUpload',
        '/product/training_collect' => 'api/product/TrainingCollect',
        '/product/video_location' => 'api/product/SaveVideoLocation',
        

        '/convention/convention_class_list' => 'api/convention/ConventionClassList',
        '/convention/convention_list' => 'api/convention/ConventionList',
        '/convention/convention_base' => 'api/convention/ConventionBase',
        '/convention/convention_news' => 'api/convention/ConventionNews',
        '/convention/expert_list' => 'api/convention/ExpertList',
        '/convention/expert_meet' => 'api/convention/ExpertMeet',
        '/convention/expert_detail' => 'api/convention/ExpertDetail',
        '/convention/exhibitor_list' => 'api/convention/ExhibitorList',
        '/convention/photo_wall_class' => 'api/convention/PhotoWallClass',
        '/convention/photo_wall_detail' => 'api/convention/PhotoWallList',
        '/convention/photo_wall_praise' => 'api/convention/PhotoWallPraise',
        '/convention/photo_wall_upload' => 'api/convention/PhotoWallUpload',
        '/convention/podcast' => 'api/convention/Podcast',
        '/convention/podcast_list' => 'api/convention/PodcastList',
        '/convention/podcast_praise' => 'api/convention/PodcastPraise',
        '/convention/podcast_comment' => 'api/convention/PodcastComment',
        '/convention/schedule_first' => 'api/convention/ScheduleFirst',
        '/convention/schedule_second' => 'api/convention/ScheduleSecond',
        '/convention/schedule_increase' => 'api/convention/ScheduleIncrease',
        '/convention/room_location' => 'api/convention/RoomLocation',
        '/convention/sign_info' => 'api/convention/Sign',
        '/convention/signup' => 'api/convention/SignUp',
        '/convention/live' => 'api/convention/Live',
        '/convention/download' => 'api/convention/Download',
        '/convention/article' => 'api/convention/Article',
        '/convention/map' => 'api/convention/Map',
        '/convention/history' => 'api/convention/History',
        '/convention/sign' => 'api/convention/Sign',
        '/convention/signup' => 'api/convention/Signup',
        '/convention/upload_article' => 'api/convention/UploadArticle',
        '/convention/pay_type' => 'api/convention/PayType',
        '/convention/certificate' => 'api/convention/Download_Certificate',
        '/convention/personal' => 'api/convention/Personal_Information',
        '/convention/pay' => 'api/convention/Payment',
        '/convention/author' => 'api/convention/Paper_Author',
        '/convention/paper' => 'api/convention/Author_Abstract',
        '/convention/order' => 'api/convention/Create_Order',
        '/convention/return_url' => 'api/convention/AliPay',
        '/convention/submit_invoice' => 'api/convention/Apply_invoice',
        '/convention/programme' => 'api/convention/Grass_roots',
        '/convention/excellent' => 'api/convention/ExcellentPost',
        '/convention/training_sigin' => 'api/convention/Training_Sigin',
        '/convention/gather_invoice' => 'api/convention/Gather_Invoice',

        '/convention/question_sign' => 'api/convention/Question_Sign',//能建问卷签到
        '/convention/question_detail' => 'api/convention/Question_Detail',//能建问卷明细
		
        '/sys/explain' => 'api/Sys/Explain',
        '/live/js_sign' => 'api/Live/Video_Sign',


        '/index/first_page' => 'api/index/FirstPage',
        '/index/search' => 'api/index/Search',
        '/adsense' => 'api/index/Adsense',

        '/convention/start_ad' => 'api/index/StartAd',  //年会App启动页的广告
        '/convention/schedule_comment' => 'api/convention/ScheduleComment',
        '/convention/comment' => 'api/convention/Comment',
        
        '/sys/signDetail'=>'api/sys/signDetail'
    ],

    /* 后端路由地址 */
    '/admin'=>'admin/index/index',
    '/module' => 'admin/index/index',
    '/logins' => 'admin/index/login',
    '/louts' => 'admin/index/login_out',
    '/welcome' => 'admin/index/welcome',

    //导航栏管理
    '[menu]'=>[
        '/edit'=>'admin/Menu/Edit',
        '/del'=>'admin/Menu/Delete',
        '/update'=>'admin/Menu/Update',

        //前端 会议 菜单栏展示
        '/meet' => 'admin/Menu/Meet', 
        '/meetdel' => 'admin/Menu/MeetEdit',

        '/'=>'admin/Menu/index',
    ],

    //用户管理
    '[user]' => [
        //用户列表
        '/Edit' => 'admin/User/UserEdit',
        '/Update' => 'admin/User/UserUpdate',
        '/Delete' => 'admin/User/UserDelete',
        //角色列表

        '/role/Edit' => 'admin/User/UserEdit',
        '/role/Update' => 'admin/User/UserUpdate',
        '/role/Delete' => 'admin/User/UserDelete',
        '/role' => 'admin/User/Index',
        '/' => 'admin/User/Index',
    ],

    //上传文件路由
    '[upload]' => [
        '/img' => ['admin/Upload/Index', ['method' => 'post|get']],
        '/' =>  ['admin/Upload/Index', ['method' => 'post|get']],
    ],

    /* 系统管理 */
    '[sys]' => [ 

        /*平台声明*/
        '/explain/edit' => 'admin/Item/Edit',
        '/explain/update' => 'admin/Item/Update',
        '/explain/delete' => 'admin/Item/Delete',
        '/explain' => 'admin/Item/index',

        /*基础资料*/
        '/item/edit' => 'admin/Item/Edit',
        '/item/update' => 'admin/Item/Update',
        '/item/delete' => 'admin/Item/Delete',
        '/item' => 'admin/Item/index',

        /*医院*/
        '/hospital/edit' => 'admin/Item/Edit',
        '/hospital/update' => 'admin/Item/Update',
        '/hospital/delete' => 'admin/Item/Delete',
        '/hospital' => 'admin/Item/index',

        /*企业*/
        '/org/edit' => 'admin/Item/Edit',
        '/org/update' => 'admin/Item/Update',
        '/org/delete' => 'admin/Item/Delete',
        '/org' => 'admin/Item/index',
        '/region' => 'admin/Item/GetRegion', //医院编辑

        /*合作伙伴*/
        '/partner/edit' => 'admin/Item/Edit',
        '/partner/update' => 'admin/Item/Update',
        '/partner/delete' => 'admin/Item/Delete',
        '/partner' => 'admin/Item/index',
        
        /*资源列表*/
        '/source/edit' => 'admin/Item/Edit',
        '/source/update' => 'admin/Item/Update',
        '/source/delete' => 'admin/Item/Delete',
        '/source' => 'admin/Item/index',
       
        /*专家列表*/
        '/expert/edit' => 'admin/Expert/Edit',
        '/expert/update' => 'admin/Expert/Update',
        '/expert/delete' => 'admin/Expert/Delete',
        '/expert' => 'admin/Expert/index',

        /*授权-API接口APPKEY配置数据表*/
        '/empower/edit' => 'admin/Empower/Edit',
        '/empower/update' => 'admin/Empower/Update',
        '/empower/delete' => 'admin/Empower/Delete',
        '/empower' => 'admin/Empower/AppInfo',

        /*授权-API接口TOKEN数据表*/
        '/token/delete' => 'admin/Empower/Delete',
        '/token' => 'admin/Empower/AppToken',

        /*授权-API接口权限配置数据表*/
        '/acl/edit' => 'admin/Empower/Edit',
        '/acl/update' => 'admin/Empower/Update',
        '/acl/delete' => 'admin/Empower/Delete',
        '/acl' => 'admin/Empower/AppAcl',

        /*版本管理-软件版本数据表*/
        '/version/edit' => 'admin/Version/Edit',
        '/version/update' => 'admin/Version/Update',
        '/version/delete' => 'admin/Version/Delete',
        '/version' => 'admin/Version/VersionInfo',

        /*版本管理-软件版本升级配置数据表*/
        '/version_up/edit' => 'admin/Version/Edit',
        '/version_up/update' => 'admin/Version/Update',
        '/version_up/delete' => 'admin/Version/Delete',
        '/version_up' => 'admin/Version/VersionUp',

        /*版本管理-软件版本升级日志表*/
        '/version_log/delete' => 'admin/Version/Delete',
        '/version_log' => 'admin/Version/VersionLog',

        /*系统管理-运行日志*/
        '/log_login/delete' => 'admin/Item/Delete',
        '/log_login' => 'admin/Item/index',
        '/log_app' => 'admin/Item/index',
        '/log_api' => 'admin/Item/index',
        '/log_service' => 'admin/Item/index',
        '/log_terminal/delete' => 'admin/Item/Delete',        
        '/log_terminal' => 'admin/Item/index',

        
    ],

    /* 会议管理 */
    '[meet]' => [ 
        //会议-会议中心
        '/edit' => 'admin/Meet/Edit', 
        '/switch' => 'admin/Meet/Edit', 
        '/update' => 'admin/Meet/Update', 
        '/del' => 'admin/Meet/Delete',

        //会议-会议室
        '/room' => 'admin/Meet/Index', 
        '/edit_room' => 'admin/Meet/Edit',
        '/del_room' => 'admin/Meet/Delete',
        '/update_room' => 'admin/Meet/Update',

        // 参展商
        '/exh' => 'admin/Meet/Index',
        '/edit_exh' => 'admin/Meet/Edit',
        '/update_exh' => 'admin/Meet/Update',
        '/del_exh' => 'admin/Meet/Delete',

        // 新闻
        '/news' => 'admin/Meet/Index',
        '/edit_news' => 'admin/Meet/Edit',
        '/update_news' => 'admin/Meet/Update',
        '/del_news' => 'admin/Meet/Delete',

        // 系统消息
        '/notice' => 'admin/Meet/Index',
        '/edit_notice' => 'admin/Meet/Edit',
        '/update_notice' => 'admin/Meet/Update',
        '/del_notice' => 'admin/Meet/Delete',

        // 系统消息阅读记录
        '/notice_detail' => 'admin/Meet/Index',
        '/del_notice_detail' => 'admin/Meet/Delete',    

        // 荣誉与剪影
        '/honor' => 'admin/Meet/Index',
        '/edit_honor' => 'admin/Meet/Edit',
        '/update_honor' => 'admin/Meet/Update',
        '/del_honor' => 'admin/Meet/Delete',
    

        // 直播
        '/live' => 'admin/Meet/Index',
        '/edit_live' => 'admin/Meet/Edit',
        '/update_live' => 'admin/Meet/Update',
        '/del_live' => 'admin/Meet/Delete',

        // 会议食宿
        '/article' => 'admin/Meet/Index',
        '/edit_article' => 'admin/Meet/Edit',
        '/update_article' => 'admin/Meet/Update',
        '/del_article' => 'admin/Meet/Delete',

        // 会议资料上传型
        '/filed' => 'admin/Meet/Index',
        '/uploads' => 'admin/Meet/Index',
        '/edit_uploads' => 'admin/Meet/Edit',
        '/update_uploads' => 'admin/Meet/Update',
        '/del_uploads' => 'admin/Meet/Delete',

        // 多图片上传型
        '/picture' => 'admin/Meet/Index',


        // 照片墙
        '/photo' => 'admin/Meet/Index',
        '/edit_photo' => 'admin/Meet/Edit',
        '/update_photo' => 'admin/Meet/Update',
        '/del_photo' => 'admin/Meet/Delete',

        // 照片墙点赞记录
        '/photo_detail' => 'admin/Meet/Index',
        '/del_photo_detail' => 'admin/Meet/Delete',

        // 播客
        '/podcast' => 'admin/Meet/Index',
        '/del_podcast' => 'admin/Meet/Delete',

        // 回复播客记录
        '/podcast_comment' => 'admin/Meet/Index',
        '/del_podcast_comment' => 'admin/Meet/Delete',

        //会议-会议日程
        '/agenda' => 'admin/Meet/Index', 
        '/edit_agenda' => 'admin/Meet/Edit',
        '/del_agenda' => 'admin/Meet/Delete',
        '/update_agenda' => 'admin/Meet/Update',

        //会议-时间日程
        '/time_agenda' => 'admin/Meet/Index', 
        '/time_edit_agenda' => 'admin/Meet/Edit',
        '/time_del_agenda' => 'admin/Meet/Delete',
        '/time_update_agenda' => 'admin/Meet/Update',

        //会议-报名
        '/sign' => 'admin/Meet/Index', 
        '/edit_sign' => 'admin/Meet/Edit',
        '/del_sign' => 'admin/Meet/Delete',
        '/update_sign' => 'admin/Meet/Update',

        //会议-门票类型
        '/ticket' => 'admin/Meet/Index', 
        '/edit_ticket' => 'admin/Meet/Edit',
        '/del_ticket' => 'admin/Meet/Delete',
        '/update_ticket' => 'admin/Meet/Update',

        //会议-报名
        '/signup' => 'admin/Meet/Index', 
        '/meeting_order' => 'admin/Meet/Index', 
        '/signup_detail' => 'admin/Meet/Index', 
        '/edit_signup' => 'admin/Meet/Edit',
        '/update_signup' => 'admin/Meet/Update',
        '/del_signup' => 'admin/Meet/Delete',
		
        //会议-摘要及全文
        '/paper' => 'admin/Meet/Index',
		'/edit_paper' => 'admin/Meet/Edit',
        '/update_paper' => 'admin/Meet/Update',
        '/del_paper' => 'admin/Meet/Delete',
		
        //会议-摘要作者
        '/author' => 'admin/Meet/Index', 
		'/edit_author' => 'admin/Meet/Edit',
        '/update_author' => 'admin/Meet/Update',
        '/del_author' => 'admin/Meet/Delete',

        '/sign_cnf' => 'admin/Meet/Index',
        '/' => 'admin/Meet/Index',
    ],

    /* 直播管理 */
    '[live]'=>[
        //直播
        '/edit' => 'admin/Live/Edit',
        '/update' => 'admin/Live/Update',
        '/del' => 'admin/Live/Delete',
 
        //直播交流
        '/chat_del' => 'admin/Live/Delete',
        '/chat' => 'admin/Live/Index',

        //培训
        '/video_edit' => 'admin/Live/Edit',
        '/video_update' => 'admin/Live/Update',
        '/video_del' => 'admin/Live/Delete',
        '/video' => 'admin/Live/Index',

        //培训记录
        '/video_play_del' => 'admin/Live/Delete',
        '/video_play' => 'admin/Live/Index',

        //培训评论
        '/video_comment_del' => 'admin/Live/Delete',
        '/video_comment' => 'admin/Live/Index',

        //培训评论点赞
        '/video_praise_del' => 'admin/Live/Delete',
        '/video_praise' => 'admin/Live/Index',

        '/' => 'admin/Live/Index',
    ],

    //产品管理
    '[product]' => [
        '/parge' => 'admin/Product/Edit',
        '/edit' => 'admin/Product/Edit',
        '/update' => 'admin/Product/Update',
        '/del' => 'admin/Product/Delete',

        /* 产品-培训章节 */
        '/section_edit' => 'admin/Product/Edit',
        '/section_update' => 'admin/Product/Update',
        '/section_del' => 'admin/Product/Delete',
        '/section'=>'admin/Product/Index',

        /* 产品收藏 */
        '/collect_edit' => 'admin/Product/Edit',
        '/collect_update' => 'admin/Product/Update',
        '/collect_del' => 'admin/Product/Delete',
        '/collect'=>'admin/Product/Index',

        /* 产品购买记录 */
        '/order_edit' => 'admin/Product/Edit',
        '/order_update' => 'admin/Product/Update',
        '/order_del' => 'admin/Product/Delete',
        '/order'=>'admin/Product/Index',

        '/'=>'admin/Product/Index'
    ],

    //推荐管理
    '[banner]' => [  
        //轮播图
        '/edit' => 'admin/Banner/Edit',
        '/update' => 'admin/Banner/Update',
        '/del' => 'admin/Banner/Delete', 

        //广告位
        '/adsense_edit' => 'admin/Banner/Edit',
        '/adsense_update' => 'admin/Banner/Update',
        '/adsense_del' => 'admin/Banner/Delete',
        '/adsense'=>'admin/Banner/Index',

        '/' => 'admin/Banner/index',
    ],

    //考试管理
    '[exam]' => [  
        //考试
        '/edit' => 'admin/Exam/Edit',
        '/update' => 'admin/Exam/Update',
        '/del' => 'admin/Exam/Delete', 

        //考试题目
        '/subject_edit' => 'admin/Exam/Edit',
        '/subject_update' => 'admin/Exam/Update',
        '/subject_del' => 'admin/Exam/Delete',
        '/subject'=>'admin/Exam/Index',

        //成绩单
        '/result_edit' => 'admin/Exam/Edit',
        '/result_update' => 'admin/Exam/Update',
        '/result_del' => 'admin/Exam/Delete',
        '/result'=>'admin/Exam/Index',

        //答题记录

        '/record_del' => 'admin/Exam/Delete',
        '/record'=>'admin/Exam/Index',


        '/' => 'admin/Exam/index',
    ],

    //现场签到
    '[SignIn]'=>[
        'Sign'=>'web/Authorization/Sign',
        'SignWechat'=>'web/Authorization/SignWechat',
        'Authorization'=>'web/Authorization/Wechat',
        'GatherTnvoiceWechat'=>'web/Authorization/gatherTnvoiceWechat',
        'QuestionAuthorization'=>'web/Authorization/QuestionWechat',
        'QuestionSign'=>'web/Authorization/QuestionSign',
    ]

];