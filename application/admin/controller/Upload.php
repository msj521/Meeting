<?php
namespace app\admin\controller;

use app\admin\common\Base;
use think\Db;
use think\Model;
use think\Request;
use think\log;
use \think\File;

define('ROOT',dirname(__FILE__).'/');  

class Upload extends Base {

    /**
     * @return string|void
     * 咨询列表
     */

    public function index(){
        if($this->request->isPost()){
            $data=$this->request->param(true);
            $file = request()->file('file');
            if(empty($file)){
                $this->error($file->getError());
            }
            //上传的时候的原文件名
            $dir =ROOT_PATH. 'public' . DS . 'uploads'; // 自定义文件上传路径
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }

            $map=[
                'ext'=>'pdf,bmp,jpg,jpeg,png,tif,gif,pcx,tga,exif,fpx,svg,psd,cdr,pcd,dxf,ufo,eps,ai,raw,WMF,webp,doc,docx,mp4,xlsx,xls,mp4,rm,rmvb,mpeg1-4,mov,mtv,dat,wmv,avi,3gp,amv,dmv,flv,zip,rar',
            ];

            $info = $file->validate($map)->move($dir); // 将文件上传指定目录

            if(empty($info)){
                $this->error($file->getError());
            }

            //获取文件的路径
            $filepatch = str_replace('\\', '/', $info->getSaveName());
            $path ="/uploads/".$filepatch;

            $file_path=[];
            $image_id=0;
            $source_type=1;

            if(isset($data['fid'])){
                $image_id=$data['fid'];
            }

            if(isset($data['web_image_id'])){
                $image_id=$data['web_image_id'];
            }

            if(isset($data['app_image_id'])){
                $image_id=$data['app_image_id'];
            }

            if(isset($data['licence_id'])){
                $image_id=$data['licence_id'];
            }

            if(isset($data['source_id'])){
                $image_id=$data['source_id'];
            }

            if(isset($data['source_type'])){
                $source_type=$data['source_type'];
            }

            $image_ids=0;
            if($file){
                //获取文件的路径
                $file_path['file_name'] = $file->getInfo()['name'];
                $file_path['file_path'] = $path;
                $file_path['file_size'] =round($file->getInfo()['size']/1024,1);
                $file_path['image_id'] =$image_id;
                $file_path['source_type']=$source_type;
                $image_ids=UploadSourceInfo($file_path);
            }

            if($image_ids>0){
                if(isset($data['fid']) && $data['fid']>0 && $info->getExtension()=="pdf"){
                    $result = [
                        'code'=>'200',
                        'msg'=>'上传成功',
                        'data'=> $image_id,
                    ];
                }elseif(isset($data['fid']) && $data['fid']>0){
                    $result = [
                        'code'=>'200',
                        'msg'=>'上传成功',
                        'data'=>$info->getExtension()=="pdf"?$image_ids:$path,
                    ];
                }else{
                    $result = [
                        'code'=>'200',
                        'msg'=>'上传成功',
                        'data'=>$image_id>0?$image_id:$image_ids,
                    ];
                }
            }else{
                $result = [
                    'code'=>'410',
                    'msg'=>'上传失败~未获取到'
                ];
            }
        }else{
            $result = [
                'code'=>'410',
                'msg'=>'上传失败！~数据问题',
            ];
        }

        die(json_encode($result,true));
     }

/**
* PDF2PNG   
* @param $pdf  待处理的PDF文件
* @param $path 待保存的图片路径
* @param $page 待导出的页面 -1为全部 0为第一页 1为第二页
* @return      保存好的图片路径和文件名
*/
 function pdf2png($pdf,$path,$page=0)
{  
   if(!is_dir($path))
   {
       mkdir($path,true);
   }
   if(!extension_loaded('imagick'))
   {  
     echo '没有找到imagick！' ;
     return false;
   }  
   if(!file_exists($pdf))
   {  
      echo '没有找到pdf' ;
       return false;  
   }  
   $im = new Imagick();  
   $im->setResolution(120,120);   //设置图像分辨率
   $im->setCompressionQuality(80); //压缩比

   $im->readImage($pdf."[".$page."]"); //设置读取pdf的第一页
   //$im->thumbnailImage(200, 100, true); // 改变图像的大小
   $im->scaleImage(200,100,true); //缩放大小图像
   $filename = $path."/". time().'.png';

   if($im->writeImage($filename) == true)
   {  
      $Return  = $filename;  
   }
   return $Return;  
}
}
