<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class BaseModel extends Model
{
    protected function serializeDate(\DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }

    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }
}
