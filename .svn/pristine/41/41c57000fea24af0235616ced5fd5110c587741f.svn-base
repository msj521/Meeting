<?php
namespace app\api\Controller;

use app\admin\common\Base;
use think\Db;
use think\Request;

class Banner extends Base {

     function Index(Request $request) {
        $param=$this->request->param();
        $param=array_filter($param);
        if(is_null($param)){
            return [];
        }
        $where=["FModule"=>4];
        $list = $this->sific_list($where);
        return json_encode($list);  
    }
}
