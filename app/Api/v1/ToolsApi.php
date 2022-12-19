<?php


namespace App\Api\v1;


use App\Http\Controllers\BaseController;
use App\Models\Areas;
use App\Models\City;
use App\Models\Province;
use App\Models\SmsCode;
use App\Service\VerifyCodeService;
use Illuminate\Http\Request;

class ToolsApi extends BaseController
{

    public function getCode(Request $request)
    {
        return VerifyCodeService::getCode($request->post('mobile'));
    }

    public function checkToken(Request $request)
    {
        return m_success();
    }

    public function getProvince()
    {
        return m_success('',Province::all());
    }

    public function getCity(Request $request)
    {
        $id = $request->post('id');
        return m_success('',City::where('provinceid',$id)->get());
    }

    public function getArea(Request $request)
    {
        $id = $request->post('id');
        return m_success('',Areas::where('cityid',$id)->get());
    }

}
