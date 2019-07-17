<?php
/**
 * Created by PhpStorm.
 * User: liumeng
 * Date: 2018/5/15
 * Time: 14:42
 */
namespace app\admin\model;

use think\Model;
use think\Validate;

// class TNews extends Model {

//     protected $table = "news";

//     public function check() {
//         $rule = [
//             'FTitle' => 'require',
//             'FSubTitle' => 'require',
//             'FTypeName' => 'require',
//         ];
//         $msg = [
//             'FTitle.require' => '名称必须',
//             'FSubTitle.require' => '简介名称必须',
//             'FTypeName.require' => '分类名称必须',
//         ];
//         $data = [
//             'FTitle' => '555',
//             'FSubTitle' => 121,
//             'FTypeName' => "555"
//         ];
//         $validate = new Validate($rule, $msg);
//         $result = $validate->check($data);
//         if (!$result) {
//             echo $validate->getError();
//         }
//     }
// }

class TNews extends Model {
    protected $table = "t_news";
    protected $fields = array('FID', 'FTitle', 'FSubTitle', 'FTypeID');
    protected $pk     = 'FID';
}