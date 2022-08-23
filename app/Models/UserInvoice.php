<?php

namespace App\Models;

#发票模型
class UserInvoice extends BaseModel
{
    protected $table = "user_invoice";

    public function user()
    {
        return $this->hasOne(User::class,"id","u_id");
    }
}
