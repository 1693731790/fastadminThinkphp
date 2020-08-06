<?php
namespace app\common\model;
use think\Model;

class Recharge extends Model
{
	protected $name = 'recharge';//数据表名称
	protected $resultSetType = 'collection';//可以使用toArray()

	//protected $autoWriteTimestamp = false;     //开启自动写入时间戳
	//protected $createTime = false;  数据添加的时候不自动写入时间戳
    //protected $createTime = "create_time";     //数据添加的时候，created_at 这个字段自动写入时间戳


	

    /*protected $update =[    //修改信息自动填充数据
        "updated_at"=>time(),  
    ];*/

}
