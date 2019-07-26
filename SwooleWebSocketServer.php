<?php
require_once('./RedisInstance.php');

function getRedis(){
    return  RedisInstance::getInstance();
}
class Websocket {

    public $server;

    public function __construct() {
		
        $this->server = new swoole_websocket_server("0.0.0.0", 9501);
        //设置 websocket 进程名称
        swoole_set_process_name("sific");
        $this->server->set(
            [   
				'worker_num' => 2, //worker进程数
				'task_worker_num' => 2 //task进程数
            ]
        );
        $this->server->on('open', [$this,'onOpen']);
        $this->server->on('message', [$this,'onMessage']);
        $this->server->on('close', [$this,'onClose']);
        $this->server->on("task", [$this, 'onTask']);
        $this->server->on("finish", [$this, 'onFinish']);
        $this->server->start();
    }

    //监听WebSocket连接打开事件
    public function onOpen($server, $req){
		//建立连接给所有在线用户推送 在线数量
		$this->online($server);
		echo "{$req->fd}建立了连接".PHP_EOL;
    }

    //监听WebSocket 消息事件
    public function onMessage($server, $frame){
		echo "{$frame->fd}服务器发送消息".PHP_EOL;
        $params = json_decode($frame->data,true);
		$user_id =isset($params['uid'])?$params['uid']:0;
		$live_id =isset($params['live_id'])?$params['live_id']:0;
		$content =isset($params['content'])?$params['content']:'';
		$user_online_info = $server->connection_info($frame->fd);
        $db_conf = array(
            'host' => '47.100.226.80',
            'user' => 'root',
            'password' => 'msj586',
            'database' => 'live',
        );
        $mysqlObj = new Swoole\MySQL;
        $save_add_time = date('Y-m-d H:i:s',time());
        if($params){
            $sql = 'INSERT INTO live_chat(
                    creator_id,
                    live_id,
                    message,
                    user_ip,
					create_time
                    )
                VALUES ('
                .$user_id.','
                .$live_id.','
				."'".$content."'".','
				."'".$user_online_info['remote_ip']."'".','
                ."'".$save_add_time."'".');';
            $mysqlObj->connect($db_conf,function($db, $result) use ($sql){
                $db->query($sql, function (Swoole\MySQL $db, $result) {
                    if ($result === false) {
                        //var_dump($db->error, $db->errno);
                    } elseif ($result === true) {
                        ///var_dump($db->affected_rows, $db->insert_id);
                    }
                    $db->close();
                });
            });
			
			//显示自己记录 $server->push(); 向websocket客户端连接推送数据，长度最大不得超过2M。
			//$server->push($frame->fd,json_encode(array('message' => $content,'online'=>$online), JSON_UNESCAPED_UNICODE));
			//显示所有记录
            $this->online($server);
        }
		
		//worker进程异步投递任务到task_worker进程中
		//$server->task($request_data);
    }

    public function onTask($server, $task_id, $worker_id, $data){
		var_dump($data);

		//模拟慢速任务
		sleep(5);

		//返回字符串给worker进程——>触发onFinish
		return "success";
    }

    public function onFinish($server,$task_id, $data){
		//task_worker进程将任务处理结果发送给worker进程
		echo "异步完成任务".PHP_EOL;
    }


    public function onClose($server, $fd){
		$this->online($server, $fd);
		echo "$fd-服务断开".PHP_EOL;
    }
	
	
	public function online($server, $fds=0){
		$online=$fds>0 ? count($server->connections)-1:count($server->connections);
		foreach ($server->connections as $fd) {
			if($fds!=$fd){
				$server->push($fd, json_encode(
				 array(
						'online'=>$online
				),JSON_UNESCAPED_UNICODE));
			}
		}
	}

}
new Websocket();