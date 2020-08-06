<?php

namespace app\common\validate;

use think\Validate;

class User extends Validate
{
    /**
     * 验证规则
     */
    protected $rule = [
        "username"=>"require|min:6",
        "password"=>"require|min:6|confirm:repassword",
        
    ];
    /**
     * 提示消息
     */
    protected $message = [
        "username.require"=>"用户名不能为空",
        "username.min"=>"用户名不能小于6位",
        "password.require"=>"密码不能为空",
        "password.min"=>"密码不能小于6位",
        "password.confirm"=>"两次密码不一致",
    ];
    
    
        
 
    


    
}
