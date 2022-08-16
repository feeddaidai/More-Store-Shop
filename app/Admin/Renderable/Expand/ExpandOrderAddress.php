<?php

namespace App\Admin\Renderable\Expand;

use App\Models\Expressage;
use App\Models\OrderDetail;
use Dcat\Admin\Grid;
use Dcat\Admin\Support\LazyRenderable;

class ExpandOrderAddress extends LazyRenderable
{
    public function render()
    {
      return  $this->grid();
    }

    public function grid():Grid
    {
        #id
        $data = $this->payload;
        return Grid::make(new OrderDetail(), function (Grid $grid)use($data){
            $grid->model()->where("order_id",$data["key"]);
            $grid->column("shipping_type",'快递公司')->display(function ()use($data){
                return  Expressage::query()->where("id",$data["shipping_type"])->value("expressage_name");
            });
            $grid->column("shipping_code",'快递单号')->display(function ()use($data){
                return $data["shipping_code"];
            });
            $grid->column("shipping_fee",'运费')->display(function ()use($data){
                return $data["shipping_fee"];
            });
            $grid->column("reciver_name","收货人姓名");
            $grid->column("reciver_phone","收货人电话");
            $grid->column("address_text","收货地址");
            $grid->paginate(10);
            $grid->disableActions();
            $grid->disableRowSelector();
            $grid->disableCreateButton();
            $grid->disableRefreshButton();
        });
    }
}
