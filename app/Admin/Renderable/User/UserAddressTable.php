<?php

namespace App\Admin\Renderable\User;

use App\Models\Consignee;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;
#收货地址
class UserAddressTable extends LazyRenderable
{
    public function grid():Grid
    {
        #id
        $kay = $this->payload;
        return Grid::make(new Consignee(), function (Grid $grid)use($kay) {
            $grid->model()->where("user_id",$kay["key"]);
            $grid->column('cnee_name',"收货人");
            $grid->column('mobile',"电话");
            $grid->column('area_province',"省");
            $grid->column('area_city','市');
            $grid->column('area_district','区');
            $grid->column('address_text','详情地址')->limit(10);
            $grid->column('weight','权重');
            $grid->paginate(10);
            $grid->disableActions();
            $grid->disableRowSelector();
        });
    }
}
