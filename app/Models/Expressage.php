<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
#快递平台
class Expressage extends Model
{
    protected $table = "expressage";
    //解决  .000000Z 时间问题
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
