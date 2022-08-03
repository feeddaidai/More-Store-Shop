<?php


namespace App\Api\v1;


use App\Http\Controllers\BaseController;
use App\Models\GoodsSku;
use Illuminate\Http\Request;

class OrderApi extends BaseController
{

    public function confirm(Request $request)
    {
        $ids = $request->post('ids');
        if( !$ids )return m_error();
        #查找指定商品并返回
        $res = [];
        foreach ($ids as $index => $item) {
            $data = GoodsSku::find($item['id']);
            $amount = $item['num'] * (float)$data->price;
            $data->num = $item['num'];
            $data->amount = $amount;
            $res[] = $data;
        }
        //return m_success('成功',$skuObj);
        return m_success('成功',$res);
    }
}
