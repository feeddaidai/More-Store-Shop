<?php


namespace App\Service;

use App\Models\User;

class JwtService
{
    //头部
    protected  $header = [
        'alg' => 'HS256', //生成signature的算法
        'typ' => 'JWT'  //类型
    ];
    //使用HMAC生成信息摘要时所使用的密钥
    protected  $key = 'KEY';

    protected static $self = null;

    protected $user;

    private function __construct(){}

    public function __clone()
    {
        return self::$self;
        // TODO: Implement __clone() method.
    }

    public static function getInstance()
    {
        if (!self::$self) {
            self::$self = new self();
        }
        return self::$self;
    }

    /**
     * 获取jwt token
     * @param array $payload jwt载荷  格式如下非必须
     * @return bool|string
     */
    public function getToken(array $payload)
    {
        $t       = time();
        $exp     = config('admin.loginExp');
        $arr     = [
            'iss' => 'yamecent', //该JWT的签发者
            'iat' => $t, //签发时间
            'exp' => $t + $exp, //过期时间
            'nbf' => $t, //该时间之前不接收处理该Token
            'sub' => '', //面向的用户
            'jti' => md5(uniqid('JWT') . $t) //该Token唯一标识
        ];
        $payload = array_merge($arr, $payload);
        if (is_array($payload)) {
            $base64header  = $this->base64UrlEncode(json_encode($this->header, JSON_UNESCAPED_UNICODE));
            $base64payload = $this->base64UrlEncode(json_encode($payload, JSON_UNESCAPED_UNICODE));
            $token         = $base64header . '.' . $base64payload . '.' . $this->signature($base64header . '.' . $base64payload, $this->key, $this->header['alg']);
            return $token;
        } else {
            return false;
        }
    }

    /**
     * 验证token是否有效,默认验证exp,nbf,iat时间
     * @param string $Token 需要验证的token
     * @return bool|string
     */
    public function verifyToken(string $Token)
    {
        $tokens = explode('.', $Token);
        if (count($tokens) != 3)
            return false;

        list($base64header, $base64payload, $sign) = $tokens;

        //获取jwt算法
        $base64decodeheader = json_decode($this->base64UrlDecode($base64header), JSON_OBJECT_AS_ARRAY);
        if (empty($base64decodeheader['alg']))
            return false;

        //签名验证
        if ($this->signature($base64header . '.' . $base64payload, $this->key, $base64decodeheader['alg']) !== $sign)
            return false;

        $payload = json_decode($this->base64UrlDecode($base64payload), JSON_OBJECT_AS_ARRAY);

        //签发时间大于当前服务器时间验证失败
        if (isset($payload['iat']) && $payload['iat'] > time())
            return false;

        //过期时间小宇当前服务器时间验证失败
        if (isset($payload['exp']) && $payload['exp'] < time())
            return false;

        //该nbf时间之前不接收处理该Token
        if (isset($payload['nbf']) && $payload['nbf'] > time())
            return false;

        if ( !$user = User::find($payload['sub']) ){
            return false;
        }
        $this->user = $user;
        return true;
    }

    public function getUser()
    {

        return $this->user;
    }

    /**
     * base64UrlEncode  https://jwt.io/ 中base64UrlEncode编码实现
     * @param string $input 需要编码的字符串
     * @return string
     */
    protected function base64UrlEncode(string $input)
    {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }

    /**
     * base64UrlEncode https://jwt.io/ 中base64UrlEncode解码实现
     * @param string $input 需要解码的字符串
     * @return bool|string
     */
    protected function base64UrlDecode(string $input)
    {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $addlen = 4 - $remainder;
            $input  .= str_repeat('=', $addlen);
        }
        return base64_decode(strtr($input, '-_', '+/'));
    }

    /**
     * HMACSHA256签名  https://jwt.io/ 中HMACSHA256签名实现
     * @param string $input 为base64UrlEncode(header).".".base64UrlEncode(payload)
     * @param string $key
     * @param string $alg 算法方式
     * @return mixed
     */
    protected function signature(string $input, string $key, string $alg = 'HS256')
    {
        $alg_config = array(
            'HS256' => 'sha256'
        );
        return $this->base64UrlEncode(hash_hmac($alg_config[$alg], $input, $key, true));
    }
}
