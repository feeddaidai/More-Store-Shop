<?php


namespace App\Api\v1;

use App\Http\Controllers\BaseController;
use App\Models\Goods;
use App\Models\GoodsSku;
use App\Models\User;
use App\Service\JwtService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoodsApi extends BaseController
{
    public function goodsList(Request $request)
    {

    }

    public function goodsDetail(Request $request)
    {
        $goodsId = $request->post('goods_id',null);
        $returnData = [];
        #如果参数为空，异常情况下可以获取一个随机商品进行展示
        if( !$goodsId )
            return m_error('缺少必要参数');
        $goodsModel = Goods::getGoodsBySku($goodsId);
        #商品软删或已下架
        if( !$goodsModel )
            return m_error('商品不存在或已下架');
        $returnData['goods'] = $goodsModel;
        return m_success('获取成功',$returnData);
    }

    public function test(Request $request)
    {
        dd(Auth::id());
        #dump($this->request->user_id);
        #dd($this->user);
    }
}
