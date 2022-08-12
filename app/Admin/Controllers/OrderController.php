<?php

namespace App\Admin\Controllers;

use App\Admin\Renderable\Expand\ExpandOrder;
use App\Admin\Repositories\Oredr;
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
            $grid->column("order_code","订单号");
            $grid->column("trade_no","第三方订单号");
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
            $grid->column("goods_info","商品详情")->display("商品详情")->expand(ExpandOrder::make());
            $grid->column("add","商品详情")->display("商品详情")->expand(ExpandOrder::make());
        });
    }
}
