<?php

namespace app\admin\model;

use think\Model;


class OrderModel extends Model
{

    

    

    // 表名
    protected $name = 'order';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'create_time_text',
       
    ];
    

    public function getCate()
    {
       $data=[
            ["id"=>"1","name"=>"zhangsan"],
            ["id"=>"2","name"=>"lisi"],
            ["id"=>"3","name"=>"wangwu"],
        ];
        return $data;
    }
    public function getStatusList()
    {
        $data=["0"=>"未支付","1"=>"已支付","2"=>"2未支付"];
        return $data;
    }


    public function getCreateTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['create_time']) ? $data['create_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setCreateTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


}
