<?php

namespace App\Admin\Renderable\Expand;

use App\Models\OrderGoods;
use Dcat\Admin\Grid;
use Dcat\Admin\Support\LazyRenderable;

class ExpandOrder extends LazyRenderable
{
    public function render()
    {
      return  $this->grid();
//        // 获取ID
//        $id = $this->key;
//
//        // 获取其他自定义参数
//        $type = $this->post_type;
//        $data = [];
//
//        $titles = [
//            'User ID',
//            'Title',
//            'Body',
//            'Created At',
//        ];
//
//        return Table::make($titles, $data);
    }

    public function grid():Grid
    {
        #id
        $data = $this->payload;
        return Grid::make(new OrderGoods(), function (Grid $grid)use($data){
            $grid->model()->where("order_id",$data["key"]);
            $grid->column("goods_image","图片")->image("/");
            $grid->column("goods_name","商品名");
            $grid->column("store_name","店铺名");
            $grid->column("goods_price","商品价格");
            $grid->column("goods_num","商品数量");
            $grid->column("goods_pay_price","商品成交价");
            $grid->paginate(10);
            $grid->disableActions();
            $grid->disableRowSelector();
            $grid->disableCreateButton();
            $grid->disableRefreshButton();
        });
    }
}
