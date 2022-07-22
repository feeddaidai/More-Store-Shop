<?php


namespace App\Api\v1;


use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Models\UserDetail;
use App\Service\LogService;
use App\Traits\PasswordRules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserApi extends BaseController
{
    use PasswordRules;

    public function login(Request $request)
    {
        #直接比对
        if (!$user = User::where('mobile', $request->post('mobile'))->first()) {
            return m_error('请先注册');
        }
        if ($user->error_num >= config('admin.loginError')) {
            return m_error('账号已冻结，请联系客服处理');
        }

        if (!User::checkPassword($request->post('password'), $user->password)) {
            $user->error_num += 1;
            $user->save();
            return m_error('账号或密码错误');
        }
        return m_success('登录成功', [
            'token' => User::execute($user->id),
            'user'  => [
                'nick'   => $user->name,
                'id'     => $user->id,
                'mobile' => $user->mobile,
            ]
        ]);
        #后续补充如果没有注册即自动注册
    }

    /**
     * pc注册
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function pcRegister(Request $request)
    {
        $post      = $request->post();
        $validator = Validator::make(
            [
                'mobile'   => $post['mobile'],
                'password' => $post['password']
            ], [
            'mobile'   => ['required', 'string', 'max:30', 'unique:users', 'bail'],
            'password' => $this->passwordRules(),
        ]);
        if ($validator->fails()) {
            return m_error($validator->errors()->first());
        }
        #执行注册
        DB::beginTransaction();
        try {
            $user           = new User();
            $user->account  = $post['mobile'];
            $user->name     = $user->defaultName();
            $user->mobile   = $post['mobile'];
            $user->password = $user->password($post['password']);
            $user->add_time = time();
            $user->save();
            $id              = $user->getKey();
            $detail          = new UserDetail();
            $detail->user_id = $id;
            $detail->phone   = $post['mobile'];
            $detail->save();
            DB::commit();
            #执行登录
            return m_success('注册成功', [
                'token' => User::execute($user->id),
                'user'  => [
                    'nick'   => $user->name,
                    'id'     => $id,
                    'mobile' => $user->mobile,
                ]
            ]);
        } catch (\Exception $exception) {
            $log = LogService::getInstance();
            $log->mysql($exception);
            DB::rollBack();
            return m_error('注册失败');
        }


    }
}
