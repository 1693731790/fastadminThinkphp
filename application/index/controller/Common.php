<?php
namespace app\index\controller;
use think\Controller;
use think\Request;

class Common extends controller
{
	protected $isCheckLogin=[];
    public function _initialize()
	{
	    //判断有无admin_username这个session，如果没有，跳转到登陆界面
	    if(!session('user') && (in_array(Request::instance()->action(),$this->isCheckLogin) || $this->isCheckLogin[0]=="*")){
	      return $this->error('您还没有登陆，请登录',url('site/login'));
	    }
	}
	
}
