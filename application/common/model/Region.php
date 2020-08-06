<?php

namespace app\common\model;

use think\Model;


class Region extends Model
{
    

    // 表名
    protected $name = 'Region';

    static public function getRegion($region_id)
    {
        $res=self::where(["parent_id"=>$region_id])->field(["id","region_id","region_name","parent_id"])->select();
        return $res;
    }


}
