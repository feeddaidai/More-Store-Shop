<?php


namespace App\Api\v1;


use App\Http\Controllers\BaseController;
use App\Models\Consignee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsigneeApi extends BaseController
{
    public function find(Request $request)
    {
        $userId = \auth()->id();
        $data = Consignee::getAll($userId);
        return m_success('成功',$data);
    }
}
