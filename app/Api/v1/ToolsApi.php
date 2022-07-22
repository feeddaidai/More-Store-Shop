<?php


namespace App\Api\v1;


use App\Http\Controllers\BaseController;
use App\Models\SmsCode;
use App\Service\VerifyCodeService;
use Illuminate\Http\Request;

class ToolsApi extends BaseController
{

    public function getCode(Request $request)
    {
        return VerifyCodeService::getCode($request->post('mobile'));
    }

}
