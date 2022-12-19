<?php

namespace App\Models;

class Order extends BaseModel
{
    protected $table = "order";

    public function user()
    {
        return $this->hasOne(User::class,"id","user_id");
    }

    public function order_detail()
    {
        return $this->hasOne(OrderDetail::class,"order_id","id");
    }

}

