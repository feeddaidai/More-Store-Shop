<?php


namespace App\Models;


class SmsCode extends BaseModel
{
    protected $table='sms_log';
    protected $appends = ['add_time'];

    public function getAddTimeAttribute()
    {
        return strtotime($this->created_at);
    }
}
