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

if (!function_exists('to_date')) {
    /**
     * 统一的日期转换
     * @param $imgArr
     * @return string
     */
    function to_date($time = null)
    {
        if (!$time) $time = time();
        return date('Y-m-d H:i:s', $time);
    }
}

if (!function_exists('m_config')) {
    /**
     * 获取全局配置
     * @return mixed
     */
    function m_config()
    {
        return \App\Models\Config::pluck('value', 'column_name');
    }
}

if (!function_exists('img_to_str')) {
    /**
     * 统一的图片转字符
     * @param $imgArr
     * @return string
     */
    function img_to_str($imgArr)
    {
        return implode(',', $imgArr);
    }
}

if (!function_exists('day_to_day')) {
    /**
     * 计算两个日期间的天数
     * @param $times
     * @return false|float
     */
    function day_to_day($times)
    {
        $now = time();
        $sub = $now;
        $min = $times;
        if ($times > $now) {
            $sub = $times;
            $min = $now;
        }
        return floor(($sub - $min) / DAY_SECOND);
    }
}


if (!function_exists('m_success')) {
    function m_success($msg = null, $data = [])
    {
        if (!$msg) $msg = '成功!';
        return response()->json([
            'code' => 200,
            'msg'  => $msg,
            'data' => $data
        ]);
    }
}


if (!function_exists('m_error')) {
    function m_error($msg = null, $data = [])
    {
        if (!$msg) $msg = '错误!';
        return response()->json([
            'code' => 500,
            'msg'  => $msg,
            'data' => $data
        ]);
    }
}

if ( !function_exists('check_phone') ){
    function check_phone($phone)
    {
        if(!$phone)return false;
        $reg = "/^1[345789]\d{9}$/";
        if(preg_match($reg,$phone)) {
            return true;
        }
        return false;
    }

}



