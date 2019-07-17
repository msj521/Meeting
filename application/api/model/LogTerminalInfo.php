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

class LogTerminalInfo extends Model {
    protected $table = "log_terminal_info";
    protected $createTime = '';  
    protected $updateTime = '';  
}