<?php


namespace App\Api\v1;


use App\Connector\OrderAmount;
use App\Http\Controllers\BaseController;
use App\Models\GoodsSku;
use Illuminate\Http\Request;

class OrderApi extends BaseController implements OrderAmount
{



    public function createOrder(Request $request)
    {
        $user     = auth()->id();
        $address  = $request->post('address');
        $remark   = $request->post('msg');
        $goodsIds = $request->post('goods');

    }


    /**
     * 订单确认页(前置页)
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirm(Request $request)
    {
        $ids = $request->post('ids');
        if (!$ids) return m_error();
        #查找指定商品并返回
        $res = [];
        foreach ($ids as $index => $item) {
            $data         = GoodsSku::find($item['id']);
            $amount       = $item['num'] * (float)$data->price;
            $data->num    = $item['num'];
            $data->amount = $amount;
            $res[]        = $data;
        }
        return m_success('成功', $res);
    }

    public function setAmount()
    {
        // TODO: Implement setAmount() method.
    }

    public function getAmount()
    {
        // TODO: Implement getAmount() method.
    }

}
