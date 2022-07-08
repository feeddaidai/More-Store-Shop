<?php


if (!function_exists('td_sort')) {
    /**
     * 二维数组根据字段排序
     * @param $data
     * @param $field
     * @param int $type
     * @return mixed
     */
    function td_sort($data, $field, $type = SORT_DESC)
    {
        //根据字段对数组$data进行降序排列
        $last_names = array_column($data, $field);
        array_multisort($last_names, $type, $data);
        return $data;
    }
}

if ( !function_exists('img_to_str') ){
    /**
     * 统一的图片转字符
     * @param $imgArr
     * @return string
     */
    function img_to_str($imgArr)
    {
        return implode(',',$imgArr);
    }
}

if ( !function_exists('day_to_day') ){
    function  day_to_day($times){
        $now = time();
        return floor( ($now - $times) / DAY_SECOND);
    }
}


