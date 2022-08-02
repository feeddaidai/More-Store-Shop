<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
#用户足迹
class UserFootprint extends Model
{
    protected $table = "user_footprint";
    //解决  .000000Z 时间问题
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
