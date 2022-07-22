<?php


namespace App\Http\Middleware;


use App\Service\VerifyCodeService;
use Illuminate\Http\Request;
use Closure;

class CheckVerifyCode
{
    public function handle(Request $request, Closure $next)
    {
        #检验验证码
        /*if ( !VerifyCodeService::checkCode($request->post('mobile'),$request->post('code')) ){
            return m_error(VerifyCodeService::error());
        }*/
        return $next($request);
    }
}
