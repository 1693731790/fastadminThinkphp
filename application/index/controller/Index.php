<?php

namespace app\index\controller;

use think\cache\driver\Redis;
use think\Controller;
use think\Url;

class Index extends Controller
{

   public function index()
   {
   	  //测试是否自动显示拉取
	   $title="fastthinkphp123111456789666999";

	   $message="devPull测试1";
	   return $this->fetch("",[
        
        ]);
   }
  
    public function getBug()
   {

	   $title="获取当前bug";
	   echo "master分支";

		$title="获取当前bug";
		echo "bug分支";

	   
   }
    /**
     * 支付成功，仅供开发测试
     */
    public function notifyx()
    {
        $paytype = $this->request->param('paytype');
        $pay = \addons\epay\library\Service::checkNotify($paytype);
        if (!$pay) {
            echo '签名错误';
            return;
        }
        $data = $pay->verify();
        try {
            $payamount = $paytype == 'alipay' ? $data['total_amount'] : $data['total_fee'] / 100;
            $out_trade_no = $data['out_trade_no'];

            //你可以在此编写订单逻辑
        } catch (Exception $e) {
        }
        echo $pay->success();
    }

    /**
     * 支付返回，仅供开发测试
     */
    public function returnx()
    {
        $paytype = $this->request->param('paytype');
        $out_trade_no = $this->request->param('out_trade_no');
        $pay = \addons\epay\library\Service::checkReturn($paytype);
        if (!$pay) {
            $this->error('签名错误');
        }

        //你可以在这里通过out_trade_no去验证订单状态
        //但是不可以在此编写订单逻辑！！！

        $this->success("请返回网站查看支付结果", addon_url("epay/index/index"));
    }

    
	public function redis()
    {
    	$redis = new \Redis();
        $redis->connect('39.97.173.63',6379);
        $redis->auth('123456'); //redis密码
        
      	$lock=$redis->set("order:1","redislock",["nx","ex"=>10]);  //加锁
        dump($lock);
        die();
        return $this->fetch();
    }

    

}
