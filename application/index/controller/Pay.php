<?php

namespace app\index\controller;

use think\cache\driver\Redis;
use think\Controller;
use think\Url;

use addons\epay\library\Service;
use fast\Random;
//use think\addons\Controller;
//use Yansongda\Pay\Log;
//use Yansongda\Pay\Pay;
use Exception;
use think\Loader;


Loader::import('phpqrcode.phpqrcode',EXTEND_PATH,'.php');
class Pay extends Controller
{
    public function h5Pay()//web支付
    {
        $out_trade_no=time().rand(999,9999);
        $type="alipay";
        $params = [
		    'amount'=>"0.01",
		    'orderid'=>time().rand(999,9999),
		    'type'=>$type, //wechat微信  alipay支付宝
		    'title'=>"测试扫码支付",
		    'notifyurl'=>"http://47.94.214.211/index/pay/notifyx/paytype/$type",
		    'returnurl'=>"http://47.94.214.211/index/pay/notifyx/returnx/$type/out_trade_no/$out_trade_no",
		    'method'=>"wap", //webPC网页支付  wapH5手机网页支付  appAPP支付 scan扫码支付 mp公众号支付 miniapp小程序支付
		    'openid'=>"",
		    'auth_code'=>""
		];
		$res=Service::submitOrder($params);
	    
        dump($res);
         
      
        
       
       // dump($jsonres);
        die();
    	
        return $this->fetch("",[
                //"code"=>$resQrcode,
        ]);
    }
    public function qrcodePay()//扫码支付
    {
        $out_trade_no=time().rand(999,9999);
        $type="wechat";
        $params = [
		    'amount'=>"0.01",
		    'orderid'=>time().rand(999,9999),
		    'type'=>$type, //wechat微信  alipay支付宝
		    'title'=>"测试扫码支付",
		    'notifyurl'=>"http://47.94.214.211/index/pay/notifyx/paytype/$type",
		    'returnurl'=>"http://47.94.214.211/index/pay/notifyx/returnx/$type/out_trade_no/$out_trade_no",
		    'method'=>"scan", //webPC网页支付  wapH5手机网页支付  appAPP支付 scan扫码支付 mp公众号支付 miniapp小程序支付
		    'openid'=>"",
		    'auth_code'=>""
		];
		$res=Service::submitOrder($params);
      //  dump($res);die();
        //微信扫码
        Vendor('phpqrcode.phpqrcode');
        ob_start();
        \QRcode::png($res,false,'L', 6, 2);
        $imageString = base64_encode(ob_get_contents());
       
        ob_end_clean();
        $resQrcode='data:image/png;base64,'.$imageString; 
        
        /*支付宝扫码
            $jsonres=json_decode($res);
             // dump($jsonres);
            Vendor('phpqrcode.phpqrcode');
            ob_start();
            \QRcode::png($jsonres->qr_code,false,'L', 6, 2);
            $imageString = base64_encode(ob_get_contents());
            $resQrcode='data:image/png;base64,'.$imageString; 
            ob_end_clean();
       */
    	
        return $this->fetch("",[
                "code"=>$resQrcode,
        ]);
    }
  
    
    /**
     * 支付成功，仅供开发测试
     */
    public function notifyx()
    {
        $paytype = $this->request->param('paytype');
        $pay = Service::checkNotify($paytype);
        
        if (!$pay) {
            echo '签名错误';
            return;
        }
        $data = $pay->verify();
        
        $res='succeess'.date("Y-m-d H:i:s").print_r($data, true);
        file_put_contents("wechat.txt", $res);

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
        $pay = Service::checkReturn($paytype);
        if (!$pay) {
            $this->error('签名错误');
        }
        $data = $pay->verify();
        //你可以在这里通过out_trade_no去验证订单状态
        //但是不可以在此编写订单逻辑！！！
        dump($data);
        
    }

    

    

}
