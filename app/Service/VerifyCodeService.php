<?php


namespace App\Service;


use App\Models\SmsCode;

class VerifyCodeService
{
    protected const CODE_NUM = 4;
    protected const CODE_STR = false;
    protected const SLEEP    = 60;
    protected const CODE_ERR = 3;
    protected const EXPIRE   = 180;
    protected const STR      = 'a,b,c,d,e,f,g,h,i,j,k,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,J,K,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z';
    protected const NUM      = '0,1,2,3,4,5,6,7,8,9';
    protected const KEY      = "";
    protected static $di    = 0;
    protected static $error = '';

    public static function getCode($mobile)
    {
        if (!static::checkPhone($mobile)) {
            return m_error('手机号格式错误');
        }
        if ($model = static::find($mobile)) {
            #如果获取时间小于间隔
            if (!static::sleep($model->add_time)) {
                return m_error("请" . self::$di . "秒后重试");
            }
        }
        #获取码并保存
        $code = static::uniqueStr();
        static::sendCode($mobile, $code);
        static::storageCode($mobile, $code);
        return m_success('获取成功');
    }


    public static function checkCode($mobile, $code)
    {
        #验证格式
        if (!static::checkPhone($mobile)) {
            static::$error = '手机号格式错误';
            return false;
        }
        #获取数据
        if (!$model = static::find($mobile)) {
            static::$error = '请获取验证码';
            return false;
        }

        if ($model->expire < time()) {
            static::$error = '请获取验证码';
            return false;
        }

        if ($model->failed > static::CODE_ERR) {
            static::$error = '已超过最大错误次数,请重新获取';
            return false;
        }

        #数据比对
        if ($code != $model->code) {
            #记录错误
            $model->failed += 1;
            $model->save();
            static::$error = '验证码错误';
            return false;
        }
        return true;
    }

    public static function error()
    {
        return static::$error;
    }

    protected static function checkPhone($mobile)
    {
        return check_phone($mobile);
    }

    protected static function sleep($time)
    {
        $now      = time();
        $di       = $now - $time;
        self::$di = $di;
        if ($di < static::SLEEP) {
            return false;
        }
        return true;
    }

    protected static function find($mobile)
    {
        return SmsCode::where('mobile', $mobile)->orderBy('created_at', 'desc')->first();
    }

    protected static function storageCode($mobile, $code)
    {
        $model          = new SmsCode();
        $model->mobile  = $mobile;
        $model->code    = $code;
        $model->failed  = 0;
        $model->last_ip = '';
        $model->expire  = time() + static::EXPIRE;
        $model->save();
    }

    protected static function sendCode($mobile, $code)
    {
        $name  = config('admin.name');
        $route = "https://api.smsbao.com/sms?u=archangel&p=f5a95ca6e4aa43a482bac9026279334f&m={$mobile}&c=【{$name}】您的验证码是{$code},5分钟内有效";
        @file_get_contents($route);
        #这里需补充异常日志
    }

    protected static function uniqueStr()
    {
        $cob = '';
        $str = static::NUM;
        if (static::CODE_STR) {
            $str = static::STR;
        }
        $arr = explode(',', $str);
        for ($i = 0; $i < static::CODE_NUM; $i++) {
            $cob .= $arr[array_rand($arr)];
        }
        return $cob;
    }
}
