<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCollect extends Model
{
    #收藏
    protected $table = "user_collect";
    //解决  .000000Z 时间问题
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
