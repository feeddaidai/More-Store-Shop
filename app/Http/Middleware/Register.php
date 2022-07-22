<?php


namespace App\Http\Middleware;


use App\Models\User;
use App\Service\JwtService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Closure;

class Register
{
    public function handle(Request $request, Closure $next)
    {
        if ( User::isHasReg($request->post('mobile')) ){
            return m_error('账号已存在,请直接登录');
        }
        return $next($request);
    }
}
