<?php


namespace App\Models;


class Consignee extends BaseModel
{
    protected $table = 'consignee';

    public function getAll($userId)
    {
        #后期需补充省市区三级关联
        $data = self::where('user_id',$userId)->get();
        return $data;
    }
}
