<?php
    /* 定时执行数据库备份 */
    date_default_timezone_set ('Asia/Shanghai');
    ini_set("max_execution_time", "0");//代码运行时间不限制  防止备份失败
    ini_set('memory_limit', '128M');//设置内存 根据需求可以修改
    date_default_timezone_set("PRC");
    $str=date("Y-m-d H:i:s");
    echo '开始时间-----'.$str."\n";
    // 获取当前页面文件路径，SQL文件就导出到此文件夹内 
    $dir = '/home/wwwroot/default/SIFIC/backup/';
    // 设置保存文件名 
    $time=date("Y-m-d");
    $time5=date("Y-m-d",strtotime('-3 days'));
    $filename=date("H-i")."-"."live.sql";
        
    // 删除 5 天前的文件
    $tmpFile5=$dir.$time5;
    if(is_dir($tmpFile5)){
        exec("rm -rf ".$tmpFile5); 
    }
    /* 判断存储路径是否存在 */
    $tmpFile=$dir.$time;
    if (!is_dir($tmpFile)) {
        mkdir($tmpFile, 0777, true);
    }
    $tmpFile =$tmpFile.'/'.$filename;
    // 用mysqldump命令导出数据库 
    exec("mysqldump -uroot -p123456 --default-character-set=utf8 live > ".$tmpFile); 
    $file = fopen($tmpFile, "r"); // 打开文件 
    fread($file,filesize($tmpFile)); 
    fclose($file);
    echo '结束时间-----'.$str."\n\n";
    
?>