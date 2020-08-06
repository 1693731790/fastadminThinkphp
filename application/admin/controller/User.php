<?php

namespace app\admin\controller;
use think\Controller;
use app\common\model\User as UserModel;
use app\common\model\UserLog;

/**
 * 
 *
 * @icon fa fa-circle-o
 */
class User extends Controller
{
    
    public function index()
    {
        //$userLog=UserLog::select();
       $list = UserModel::where(['status'=>200])->order(["id"=>"desc"])->paginate(10);
       
       
       //关联查询
      // $userModel=new UserModel();
       //$res=$userModel->alias("user")->join('user_log user_log','user.id=user_log.user_id',"RIGHT")->field(["user.*","user_log.id as logid","user_log.user_id","user_log.title"])->order("user.id desc")->select()->toArray();
       //dump($res);die();
       //一对一查询
     //  $list = UserModel::with(["userLog"])->order(["id"=>"desc"])->paginate(10);
       //dump($res);die();
       /*foreach($res as $key=>$val)
       {
            dump($val->user_log);die();
       }*/
        //一对多查询
      //  $res = UserModel::with(["userLogs"])->order(["id"=>"desc"])->select()->toArray();
      // dump($res);die();
       /*foreach($res as $key=>$val)
       {
          dump($val);die();
       }*/
      // $model=UserModel::get(65)->toArray();
     
       
        return $this->fetch("index",[
           "list"=>$list,
        ]);
    }
    

}
