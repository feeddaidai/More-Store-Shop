<?php

namespace App\Admin\Renderable\User;


use App\Models\GoodsImage;
use App\Models\GoodsSku;
use App\Models\UserCollect;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;
#用户收藏
class UserCollectTable extends LazyRenderable
{
    public function grid():Grid
    {
        #id
        $kay = $this->payload;
        return Grid::make(new UserCollect(), function (Grid $grid)use($kay) {
            $grid->model()->where("u_id",$kay["key"]);
            $grid->column('sku_id',"商品图")->display(function ($v){
                $id = GoodsSku::query()->where("id",$v)->value("main_image");
                return GoodsImage::query()->where("id",$id)->value("thumb_image");
            })->image("/");
            $grid->column('sku_name',"商品名");
            $grid->column('created_at',"添加时间");
            $grid->paginate(10);
            $grid->disableActions();
            $grid->disableRowSelector();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('sku_name',"商品名")->width(4);
            });
        });
    }
}
