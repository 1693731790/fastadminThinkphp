<?php

namespace app\admin\controller;
use app\common\controller\Backend;

/**
 * 
 *
 * @icon fa fa-circle-o
 */
class Upload extends Backend
{
    
    
    
    public function upload($dirpath="")
    {
       // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file("up");
       /* dump($file);
        die();*/
        if(empty($file))
        {
            return false;
        }
        
        // 移动到框架应用根目录/public/uploads/ 目录下
       // $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads' . DS .$dirpath);
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'. DS . $dirpath . DS . date('Ymd'),md5(microtime(true)));
        //dump($info);
        if($info){
            echo '/uploads/'.$dirpath."/".date('Ymd')."/".$info->getSaveName();
            die();
            // 成功上传后 获取上传信息
            // 输出 jpg
            //echo $info->getExtension();
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
           // echo $info->getSaveName();
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
            //echo $info->getFilename(); 
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
            die();
        }
    }


   
 

    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    

}
