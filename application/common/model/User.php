<?php
namespace app\common\model;
use think\Model;

class User extends Model
{
	protected $name = 'user';//数据表名称
	protected $resultSetType = 'collection';//可以使用toArray()

	protected $autoWriteTimestamp = true;     //开启自动写入时间戳
	//protected $createTime = false;  数据添加的时候不自动写入时间戳
    protected $createTime = "created_at";     //数据添加的时候，created_at 这个字段自动写入时间戳
    protected $updateTime = "updated_at";	  //修改添加的时候，updated_at 这个字段不自动写入时间戳

	public function userLog()
	{

		return $this->hasOne("UserLog","user_id","id");
	}
	public function userLogs()
	{

		return $this->hasMany("UserLog","user_id","id");
	}
	protected $auto = [];
	
    protected $insert = ['status'=>"200"];  //insert时自动填充
   // protected $update = ['updated_at' => time()];
	
	

    /*protected $update =[    //修改信息自动填充数据
        "updated_at"=>time(),  
    ];*/

}
