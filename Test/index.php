<?php

$redis = new Redis();
$redis->connect("127.0.0.1","6379");  //php客户端设置的ip及端口

$connect = mysqli_connect("localhost", "root", "", "test");
//mysqli_query($connect, "set names utf8");
$sql = "select * from mytest";
$query = mysqli_query($connect, $sql);


//var_dump($redis->flushdb());exit;

for($i=1; $i<=8; $i++){
	$val = $redis->get($i);
	if($val){
		echo $i . " : " . $val . "<br/>";
	}else{
		while ($row = mysqli_fetch_assoc($query)) {
			$result[] = $row;
			$redis->set($row['id'], $row['name']);
		}
		echo 233;
		break;
	}
}

