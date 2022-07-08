<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsSku extends BaseModel
{
    protected $table = 'goods_sku';
    use SoftDeletes;

    public function getOne()
    {
        return 1;
    }





}
