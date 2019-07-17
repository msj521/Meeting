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

class LogLogin extends Model {
    protected $table = "log_login";
    protected $createTime = '';  
    protected $updateTime = '';  
}