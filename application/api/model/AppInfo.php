<?php
/**
 * Created by PhpStorm.
 * User: liumeng
 * Date: 2018/5/15
 * Time: 14:42
 */
namespace app\api\model;

use think\Model;
use think\Validate;

class AppInfo extends Model {
    protected $table = "app_info";
    protected $createTime = '';  
    protected $updateTime = '';  
}