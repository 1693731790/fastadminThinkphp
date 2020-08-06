<?php

namespace app\index\controller;

use think\Controller;
use think\Session;
use think\captcha\Captcha;
use app\common\model\User;
use app\common\validate\User as UserValidata;

class Site extends controller
{
   
    public function login()
    {
    	
    	if(Session::get("user"))
    	{
    		$this->success("您已登陆过","user/index");
    		die();
    	}
    	if($data=$this->request->get())
    	{
    		$captcha = new Captcha();	//判断验证码
    		if(!$captcha->check($data["captcha"]))
    		{
    			$res=[
	    			"success"=>false,
	    			"message"=>"验证码错误",
	    		];	
	    		return json($res);
    		}
    		$model=User::get(["username"=>$data["username"],"password"=>md5($data["password"])])->toArray();
    		if($model)
    		{
    			Session::set("user",$model);
    			$res=[
	    			"success"=>true,
	    			"message"=>"登陆成功",
	    		];	
    		}else{
    			$res=[
	    			"success"=>false,
	    			"message"=>"登陆失败",
	    		];
    		}
    		
    		return json($res);
    	}else{
    		return $this->fetch();	
    	}
    	
        
    }
    
    public function captcha()
    {
    	$captcha = new Captcha();
    	 
    	return $captcha->entry();
    }
    public function register()//注册
    {

    	
        if($data=$this->request->get())
        {
            $model=User::get(["username"=>$data["username"]]);
            if($model)
            {
                $res=[
                    "success"=>false,
                    "message"=>"该用户已注册",
                ];  
                return json($res);
            }
            $captcha = new Captcha();   //判断验证码
            if(!$captcha->check($data["captcha"]))
            {
                $res=[
                    "success"=>false,
                    "message"=>"验证码错误",
                ];  
                return json($res);
            }

            //验证是否符合验证器规则
            $userValidata=new UserValidata();

            if(!$userValidata->check($data))
            {
                $res=[
                    "success"=>false,
                    "message"=>$userValidata->getError(),
                ];
                
                return json($res);
            }
            
            $userModel=new User();
            
            $userModel->username=$data["username"];
            $userModel->password=md5($data["password"]);
            //

            if($userModel->allowField(true)->save())
            {
                $res=[
                    "success"=>true,
                    "message"=>"注册成功",
                ];  
            }else{
                $res=[
                    "success"=>false,
                    "message"=>"注册失败",
                ];
            }
            
            return json($res);
        }else{
            return $this->fetch();  
        }
    	
        
    }
    
    public function logout()
    {
		Session::delete("user");
    	$this->success("退出成功");
       
    }

}
