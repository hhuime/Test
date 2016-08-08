<?php

namespace Home\Controller;
use Think\Controller;

class IndexController extends CommonController {

    public function index(){
        //widget
		$this->assign('active', 1);
		$this->display();
    }

    public function test(){
    	//$data = M('mytest')->where("id=1")->find();
    	$data = M('mytest')->select();
    	var_dump($data);

    }

    public function auth(){
    	$id = 1;
    	$rule_name = MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;

    	$auth = new \Think\Auth();
    	$result = $auth->check($rule_name, $id); //验证权限
    	if(!$result){
    		echo "没有权限";
    	}

    	$users = $auth->getGroups($id); //获取用户所在用户组
    	$user = $users[0];
    	$user['rules'] = explode(',', $user['rules']);

    	$data = M('auth_rule')->select(); //获取所有权限
    	foreach($data as $key => $value){
    		if(in_array($value['id'], $user['rules'])){
    			$data[$key]['checked'] = 1;
    		}
    	}

    	if(IS_POST){
    		$post_rules = I('post.rules');
    		$rules = implode(',', $post_rules);
    		$update = M('auth_group')->where('id='.$id)->setField('rules', $rules);
    		if($update)
    			redirect(U('Home/index/auth'));
    	}

    	$this->assign('user', $user);
    	$this->assign('data', $data);
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

        //$val = array('a','b','c','d','e','f',1,2,3,4,5);
        //$result = $redis->addHashval('Hash', abc, $val); //添加Hash数据

        $result = $redis->getoneHashval('Hash', abc); //获取某个Hash数据
/*
        $redis->init(eval(C('REDIS')));
        $redis->select(0);
        $result = json_decode($redis->getoneHashval('Order', 'D120682657845575'), true);
*/
        var_dump($result);
    }

    public function cash(){
    	S('a', 2333);
    	//S('a', null);
    	$cash = S('a');
    	var_dump($cash);
    }

    public function cookie(){
    	//cookie('abc', 233);
    	//cookie('123', 'aaaaa');
    	//$cookie = cookie('abc');
    	$cookie = $_COOKIE;
    	var_dump($cookie);
    }

    public function session(){
    	session('233', 'abcd');
    	session('abb', '1111');
    	//$session = session('233');
    	$session = $_SESSION;
    	var_dump($session);
    }

}