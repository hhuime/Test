<?php
namespace Home\Widget;
use Think\Controller;

class OrderWidget extends Controller{

	function order(){
    	Vendor('Hprose.HproseHttpClient');
    	$url = "http://openrpc.zuimeimami.com/mamimallweb/";
    	$uid = "b719083891941671578dc3652f6ea";
		$client = new \HproseHttpClient($url . "order/");
		$result = json_decode($client->appmalluserorderdata($uid, '', 1), true);
		$this->assign('data', $result['data']);
		$this->display('order/order');
	}
}