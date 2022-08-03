<?php


namespace App\Api\v1;


use App\Http\Controllers\BaseController;
use App\Models\Car;
use App\Models\GoodsSku;
use Illuminate\Http\Request;

class CarApi extends BaseController
{
    /**
     * 添加商品到购物车
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addGoods(Request $request)
    {
        $goodsId = $request->post('goods_id');
        $sum     = $request->post('sum', 1);
        $userId  = auth()->id();
        #检查商品状态
        if (Car::addGoods($goodsId, $userId, $sum)) {
            return m_success('添加成功');
        }
        return m_error(Car::error());
    }

    /**
     * 数量减一
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function subCount(Request $request)
    {
        $carId      = $request->post('id');
        $goodsModel = Car::with('skuInfo')->find($carId);
        if (($goodsModel->buy_num - 1) <= 0) {
            //直接移除
            Car::remove($carId);
            return m_error('移除成功');
        }
        $goodsModel->buy_num -= 1;
        $goodsModel->save();
        return m_success('操作成功');
    }

    /**
     * 数量加一
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCount(Request $request)
    {
        $carId      = $request->post('id');
        $goodsModel = Car::with('skuInfo')->find($carId);
        if (($goodsModel->buy_num + 1) > $goodsModel->skuInfo->once_max) {
            return m_error('超过单次最大购买数量');
        }
        if (($goodsModel->buy_num + 1) > $goodsModel->skuInfo->goods_storage) {
            return m_error('库存不足');
        }
        $goodsModel->buy_num += 1;
        $goodsModel->save();
        return m_success('成功');
    }

    /**
     * 购物车列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function carList(Request $request)
    {
        $msg    = '';
        $userId = auth()->id();
        $amount = 0;
        $data   = Car::with(['skuInfo'])
            ->where('user_id', $userId)
            ->orderBy('add_time', 'desc')
            ->get();
        foreach ($data as $index => $datum) {
            if (!$datum->skuInfo) {
                $msg .= "{$datum->sku_name}，";
                //移除该商品
                Car::remove($datum->id);
                unset($data[$index]);
                continue;
            }
            $amount += $datum->skuInfo->price;
        }
        if ($msg) {
            $msg .= '已删除,请重新选择';
        } else {
            $msg = "获取成功";
        }
        return m_success($msg, [
            'list' => $data,
            'amount' => $amount
        ]);
    }
}
