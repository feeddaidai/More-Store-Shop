<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
#发票模型
class UserInvoice extends Model
{
    protected $table = "user_invoice";
    //解决  .000000Z 时间问题
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->hasOne(User::class,"id","u_id");
    }
}
