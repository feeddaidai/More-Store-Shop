<?php


namespace App\Models;


class Consignee extends BaseModel
{
    protected $table = 'consignee';
    protected $appends = ['province_text','city_text','area_text'];

    public function getAll($userId)
    {
        #后期需补充省市区三级关联
        $data = self::where('user_id',$userId)->OrderBy('weight','desc')->get();
        return $data;
    }

    public function getProvinceTextAttribute()
    {
        $m = Province::where('provinceid',$this->area_province)->first();
        return $m->province;
    }

    public function getCityTextAttribute()
    {
        $m = City::where('cityid',$this->area_city)->first();
        return $m->city;
    }

    public function getAreaTextAttribute()
    {
        $m = Areas::where('areaid',$this->area_district)->first();
        return $m->area;
    }


}
