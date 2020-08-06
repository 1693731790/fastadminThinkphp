<?php

namespace app\index\controller;

use think\Controller;
use think\Session;
use think\Db;
use think\Log;

use app\common\model\User as UserModel;
use app\common\model\Recharge;



/**
 * 会员中心
 */
class User extends Common
{
    protected $isCheckLogin=["index","info","lock"];
    public function index()
    {
    	$user=session::get("user");
    	$newUser=UserModel::get($user["id"]);
    	
        return $this->fetch("",[
        	"money"=>$newUser["money"],
        ]);
    }
    
    public function lock()
    {
    
    	Db::startTrans();
		try{
			$user=session::get("user");
			$newUser=UserModel::where(["id"=>$user["id"]])->lock(true)->find();
			$res='succeess'.date("Y-m-d H:i:s").print_r($newUser->money, true);
			file_put_contents("paycg".time().".txt", $res);
    		sleep(5);
    		if($newUser->money>500)
    		{
	    		$newUser->money=$newUser->money-100;
	    		
	    		if(!$newUser->save())
	    		{
	    			throw new \think\Exception('添加失败', 100006);
	    		}
    		}else{
    				echo "false";
    		}
    		
		    // 提交事务
		    Db::commit();    
		    
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();
		   
		    Log::write($e->getMessage());
		   // dump($e->getMessage());
		}
		
    }
    
    //使用事务
    public function recharge($money)
    {
        Db::startTrans();
		try{
			$user=session::get("user");
    		$newUser=UserModel::get($user["id"]);
    		$newUser->money=$newUser->money+$money;
    		if(!$newUser->save())
    		{
    			throw new \think\Exception('添加失败', 100006);
    		}
    		$recharge=new Recharge();
    		$recharge->user_id=$user["id"];
    		$recharge->money=$money;
    		$recharge->create_time=time();
    		if(!$recharge->save())
    		{
    			throw new \think\Exception('添加失败', 100006);
    		}
    		//	throw new \think\Exception('添加失败2', 100006);
		    // 提交事务
		    Db::commit();    
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();
		   
		    Log::write($e->getMessage());
		    dump($e->getMessage());
		}
    }
    public function info()
    {
        
        echo "info";
    }

}
