<?php


namespace App\Http\Middleware;


use App\Service\JwtService;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;


class FrontendAuth
{
    /**
     * 验证登陆状态
     * @param Request $request
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->input('token', '');
        $jwt   = JwtService::getInstance();
        if (!$jwt->verifyToken($token)) {
            return m_error('缺少必要参数');
        }
        Auth::setUser($jwt->getUser());
        return $next($request);
    }
}
