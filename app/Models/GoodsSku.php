<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsSku extends BaseModel
{
    protected $table = 'goods_sku';
    use SoftDeletes;
    protected $appends = ['main_image_path','image_list_path','spec_list'];


    public function getMainImagePathAttribute($value)
    {
        return GoodsImage::getOne($this->main_image);
    }

    public function getImageListPathAttribute($value)
    {
        return GoodsImage::getManyByStr($this->images);
    }

    public function getSpecListAttribute()
    {
        return SkuSpecValue::getOne($this->id);
    }
}
