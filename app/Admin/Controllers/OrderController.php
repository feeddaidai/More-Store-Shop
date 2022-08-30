<?php

namespace App\Admin\Controllers;

use App\Admin\Renderable\Expand\ExpandOrderAddress;
use App\Admin\Renderable\Expand\ExpandOrderGoods;
use App\Admin\Repositories\Oredr;
use App\Models\Store;
use App\Models\User;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class OrderController extends AdminController
{
    protected $title = "订单管理";

    protected function grid()
    {
        return Grid::make(new Oredr(),function (Grid $grid){
            $grid->withBorder();
            $grid->model()->orderByDesc("created_at");
            $grid->export();
            $grid->column("order_code","订单号");
            $grid->column("trade_no","第三方订单号");
            $grid->column("user_id","用户")->display(function ($v){
                return User::query()->where("id",$v)->value("name");
            });
            $grid->column("store_name","店铺名");
            $grid->column("goods_amount","商品总价")->label();
            $grid->column("order_amount","订单总价(实际支付)")->label();
            $grid->column("order_status","订单状态")->using([0=>"待付款",1=>'已付款',2=>'已发货',3=>'已收货',4=>'已完成',5=>'订单取消'])->badge([
                 0 => "red",
                 1 => "blue",
                 2 => "blue",
                 3 => "blue",
                 4 => "blue",
                 5 => "red",
            ]);
            $grid->column("payment_type","支付方式");
            $grid->column("payment_time","支付时间");
            $grid->column("refund_status","是否退款")
                ->using([0=>'无退款',1=>'部分退款',2=>'全部退款'])
                ->badge([
                    0 => "blue",
                    1 => "red",
                    2 => "red",
                ]);
            $grid->column("refund_amount",'退款金额')->label();
            $grid->column("goods_info","商品详情")->display("商品详情")->expand(ExpandOrderGoods::make());
            $grid->column("shipping_type","收货地址")->display("收货地址")->expand(function (){
               $data = [
                   'shipping_type' => $this->shipping_type,
                   "shipping_code"=>$this->shipping_code,
                   "shipping_fee"=>$this->shipping_fee,
               ];
                return ExpandOrderAddress::make($data);
            });
            $grid->filter(function (Grid\Filter $filter){
                $filter->panel();
                $filter->where('name', function ($query) {
                    $query->whereHas('user', function ($query) {
                        $query->where('name', 'like', "%{$this->input}%");
                    });
                }, '用户名')->width(2);
                $filter->equal('user_id',"用户ID")->width(2);
                $filter->where('reciver_phone', function ($query) {
                    $query->whereHas('order_detail', function ($query) {
                        $query->where('reciver_phone', 'like', "%{$this->input}%");
                    });
                }, '收货号码')->width(2);
                $filter->where('reciver_name', function ($query) {
                    $query->whereHas('order_detail', function ($query) {
                        $query->where('reciver_name', 'like', "%{$this->input}%");
                    });
                }, '收货姓名')->width(2);
                $filter->equal('order_status',"状态")->select([0=>"待付款",1=>'已付款',2=>'已发货',3=>'已收货',4=>'已完成',5=>'订单取消'])->width(2);
                $filter->equal("refund_status","是否退款")->select([0=>'无退款',1=>'部分退款',2=>'全部退款'])->width(2);
                $filter->like("order_code","订单号")->width(3);
                $filter->like("trade_no","第三方订单号")->width(3);
                $filter->equal("store_id","店铺")->select(function (){
                    return Store::query()->pluck("store_name","id");
                })->width(2);
            });
            $grid->disableCreateButton();
        });
    }
}
