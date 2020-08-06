<?php

namespace app\admin\controller;
use app\common\controller\Backend;
use app\admin\model\OrderModel;
use app\common\model\Region;

/**
 * 
 *
 * @icon fa fa-circle-o
 */
class Order extends Backend
{
    
    /**
     * OrderModel模型对象
     * @var \app\admin\model\OrderModel
     */
    protected $model = null;

    protected $modelValidate=true;
    protected $modelSceneValidate = true;
    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\OrderModel;
        
        $this->assign("statusList",$this->model->getStatusList());
        $this->assign("getCate",$this->model->getCate());

    }
    
    
    /**
     * 编辑
     */
    public function edit($ids = null)
    {
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            if (!in_array($row[$this->dataLimitField], $adminIds)) {
                $this->error(__('You have no permission'));
            }
        }
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.edit' : $name) : $this->modelValidate;
                        $row->validateFailException(true)->validate($validate);
                    }
                    $result = $row->allowField(true)->save($params);
                    Db::commit();
                } catch (ValidateException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (PDOException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (Exception $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                }
                if ($result !== false) {
                    $this->success();
                } else {
                    $this->error(__('No rows were updated'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $region=Region::getRegion(0);
       // dump($row);die();
       // $this->assignconfig("region", $region);//js文件中使用数据
        $this->view->assign("row", $row);
        $this->assign("region", $region);
        
        return $this->view->fetch();
    }

    public function getRegion($region_id="0")
    {
        $region=Region::getRegion($region_id);
        /*echo "<pre>";
        dump($region);
        die();*/
        
        return json($region);
    }
    public function status()
    {
        //dump($this->request->Get());
        //$res=$this->request->param();
        $data=input();
        $orderModel=OrderModel::get($data["ids"]);
        if($orderModel->status=="1")
        {
            $newstatus=0;
        }else{
            $newstatus=1;
        }
        $res=$orderModel->save(["status"=>$newstatus]);
        if($res)
        {
            $this->success("操作成功");
        }else{
            $this->error("操作失败");        
        }
       
    }


   
    public function view()
    {
        $get=$this->request->param();
        $data=OrderModel::get($get["ids"]);
        return $this->fetch("",[
            "data"=>$data,
        ]);
    }
     public function statusType()
    {
        $data=["0"=>"未支付","1"=>"已支付","2"=>"未知"];
        return json($data);
        return $this->fetch("",[
            "data"=>$data,
        ]);
    }
     public function member()
    {
        $data=["未支付","已支付","未知"];
        return json($data);
        
    }
    /**
     * 联动搜索
     */
    public function cxselect($region_id="0")
    {
         
      

        
        $region=Region::where(["parent_id"=>$region_id])->field('region_id as value,region_name as name')->select();
       
        $this->success('', null, $region);
    }
 

    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    

}
