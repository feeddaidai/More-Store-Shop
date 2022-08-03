<?php


namespace App\Models;


class Car extends BaseModel
{
    protected $table = 'car';
    protected const  MAX_NUM = 20;
    protected static $error;
    protected $appends = ['add_time_text'];


    public function addGoods($goodsId, $user, $sum = 1)
    {
        $goods  = GoodsSku::find($goodsId);
        $buySum = 0;
        if (!$goods || !$goods->putaway_status) {
            self::$error = '商品已下架';
            return false;
        }

        if (!Car::checkSum($user)) {
            self::$error = '商品已达上限，请删减';
            return false;
        }
        $model = self::where(['sku_id' => $goodsId, 'user_id' => $user])->first();
        if (!$model) {
            $model  = new self();
            $buySum = $sum;
        } else {
            $buySum = $sum + $model->buy_num;
        }

        if ($buySum > $goods->once_max) {
            self::$error = "单次最大购买数量为" . $goods->once_max;
            return false;
        }

        if ($buySum > $goods->goods_storage) {
            self::$error = "库存不足,目前仅" . $goods->goods_storage . "件";
            return false;
        }

        $model->buy_num  = $buySum;
        $model->add_time = time();
        $model->sku_name = $goods->sku_name;
        $model->sku_id   = $goodsId;
        $model->sku_name = $goods->sku_name;
        $model->user_id  = $user;
        $model->add_time = time();
        $model->save();
        if ($model->getKey()) {
            return true;
        }
        self::$error = '异常错误';
        return false;
    }

    public function remove($id)
    {
        self::where('id',$id)->delete();
    }

    public function error()
    {
        return self::$error;
    }

    protected function checkSum($user)
    {
        if (static::where('user_id', $user)->count() >= static::MAX_NUM) {
            return false;
        }
        return true;
    }

    public function getAddTimeTextAttribute()
    {
        return to_date($this->add_time);
    }

    public function getNewPriceAttribute()
    {

    }

    public function skuInfo()
    {
        return $this->belongsTo(GoodsSku::class,'sku_id','id');
    }

}
