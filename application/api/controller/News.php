<?php
namespace app\api\controller;

use think\Db;
use think\Model;
use think\Request;
use app\api\common\Base;
use app\api\model\VNews;
use app\api\model\VBanner;
use app\api\model\VVideo;
use app\api\model\VConference;

class News extends Base
{
    
    public function Firstpage()
    {
         try{
            /*,'FModule'=>4*/
            $data = VBanner::where(['FIsUse'=>1])->select()->toArray();

            foreach ($data as $key => &$value) {
                $main_id = $value['FMainID'];
                if ($value['FTypeID']==1300) {
                    //直播
                    $video = VVideo::get(['FID'=>$main_id]);
                    $video['FImageUrl'] = URL.$video['FImageUrl'];
                    $value['data']=$video;
                }else if ($value['FTypeID']==1301){
                    //大会
                    $conference = VConference::get(['FID'=>$main_id]);
                    $conference['FImageUrl'] = URL.$conference['FImageUrl'];
                    $value['data']=$conference;
                }else if ($value['FTypeID']==1302){
                    //api
                    $news = VNews::get(['FID'=>$main_id]);
                    $news['FImageUrl'] = URL.$news['FImageUrl'];
                    $value['data']=$news;
                }
            }


            $video_list = Db::query("select * from v_video where FStatus<2 and FDelete=0 order by FID desc limit 0,3");           

            $conference = Db::query("select * from v_conference order by FID desc limit 0,3");

            $news = Db::query("select * from v_news order by FID desc limit 0,3");

            $adsense = Db::query("select * from t_adsense where FModule=4 and FIsUse=1 limit 1");  

            $video_list = Handleurl($video_list,'FImageUrl');
            $conference = Handleurl($conference,'FImageUrl');
            $news = Handleurl($news,'FImageUrl');
            $adsense = Handleurl($adsense,'FImageUrl');
            //var_dump($data);die;
            $arr = [
                    'code'=>'200',
                    'msg'=>'请求成功',
                    'data'=>[
                        'slide'=>$data,
                        'video'=>$video_list,
                        'conference'=>$conference,
                        'news'=>$news,
                        'adsense'=>$adsense,
                    ],
                ];
            exit(json_encode($arr));
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }

    }
}