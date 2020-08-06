<?php

namespace app\admin\validate;

use think\Validate;

class OrderModel extends Validate
{
    /**
     * 验证规则
     */
    protected $rule = [
        'order_sn'  => 'require',
        'image' => 'require',
        'total_fee' => 'require',

    ];
    /**
     * 提示消息
     */
    protected $message = [
        "order_sn.require"=>"订单号必须",
        "image.require"=>"图片必须",
        "total_fee.require"=>"订单金额必须",
        
    ];
    /**
     * 验证场景
     */
    protected $scene = [
        'add'  => [],
        'edit' => ["total_fee"],
    ];
    
}
