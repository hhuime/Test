<?php

namespace Home\Controller;
use Think\Controller;

class IndexController extends CommonController {

    public function index(){
        //widget
		$this->assign('active', 1);
		$this->display();
    }

    public function rpc(){
    	vendor('Hprose.HproseHttpClient');
    	$client = new \HproseHttpClient('http://localhost/test/index.php/home/rpc');
    	$result = $client->index();
    	var_dump($result);
    }

    public function redis(){
/*
		//原始操作
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);
        $redis->set('test', 'Hello world!');
        $redis->select(0);
        $result = $redis->get('test');
*/
        //引入redis类库
        vendor('RCache.RedisCache');
        $redis = new \RedisCache();

        $config = array("server"=>"127.0.0.1", "port"=>"6379");
        $redis->init($config);
        $redis->select(0);
        //$data = $redis->redis();
        //$result = $data->get('test');
        //$result = $redis->editval('test', '2333'); //修改key
        $val = array('a','b','c','d','e','f',1,2,3,4,5);
        $result = $redis->addHashval('Hash', abc, $val);
/*
        $redis->init(eval(C('REDIS')));
        $redis->select(0);
        $result = json_decode($redis->getoneHashval('Order', 'D120682657845575'), true);
*/
        dump($result);
    }

}