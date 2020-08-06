<?php

namespace app\index\controller;
use think\Controller;
use think\Url;
use Omnipay\Omnipay;
use think\Loader;
use think\Config;


Loader::import('phpqrcode.phpqrcode',EXTEND_PATH,'.php');
class Opay extends Controller
{
   
    public function h5pay()
    {
        $alipayConfig=Config::get("alipay");
        
        $gateway = Omnipay::create('Alipay_AopWap');
        $gateway->setSignType('RSA2'); //RSA/RSA2
        $gateway->setAppId($alipayConfig['app_id']);
        $gateway->setPrivateKey($alipayConfig['private_key']);
        $gateway->setAlipayPublicKey($alipayConfig['ali_public_key']);
        $gateway->setNotifyUrl("http://fast.xtzhjp.com/index/opay/notifyx");
        $gateway->setReturnUrl("http://fast.xtzhjp.com/index/opay/returnx");
        $request = $gateway->purchase();
        $request->setBizContent([
            'subject'      => 'o扫码测试',
            'out_trade_no' => time().rand(999,9999),
            'total_amount' => "0.01",
            'product_code' => 'QUICK_WAP_PAY',
        ]);
		$response = $request->send();
	
		//$redirectUrl = $response->getRedirectUrl();
		
		$response->redirect();
        

       
    }
    public function qrcodePay()	//扫码支付
    {
        $alipayConfig=Config::get("alipay");
        
        $gateway = Omnipay::create('Alipay_AopF2F');
        $gateway->setSignType('RSA2'); //RSA/RSA2
        $gateway->setAppId($alipayConfig['app_id']);
        $gateway->setPrivateKey($alipayConfig['private_key']);
        $gateway->setAlipayPublicKey($alipayConfig['ali_public_key']);
        $gateway->setNotifyUrl("http://fast.xtzhjp.com/index/opay/notifyx");
       // $gateway->setReturnUrl("http://fast.xtzhjp.com/index/opay/returnx");
        $request = $gateway->purchase();
        $request->setBizContent([
            'subject'      => 'o扫码测试',
            'out_trade_no' => time().rand(999,9999),
            'total_amount' => "0.01",
        ]);

        $response = $request->send();

        // 获取收款二维码内容
        $qrCodeContent = $response->getQrCode();
        
        //die();
        Vendor('phpqrcode.phpqrcode');
        ob_start();
        \QRcode::png($qrCodeContent,false,'L', 6, 2);
        $imageString = base64_encode(ob_get_contents());
       
        ob_end_clean();
        $resQrcode='data:image/png;base64,'.$imageString; 
       
    	
        return $this->fetch("",[
                "code"=>$resQrcode,
        ]);
    }
  
    
    /**
     * 支付成功，仅供开发测试
     */
    public function notifyx()
    {
       
    $res='succeess'.date("Y-m-d H:i:s").print_r($_REQUEST, true);
    file_put_contents("paycg.txt", $res);
    }

    /**
     * 支付返回，仅供开发测试
     */
    public function returnx()
    {
        echo "return";
        
    }

    

    

}
