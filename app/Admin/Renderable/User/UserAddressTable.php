<?php

namespace App\Admin\Renderable\User;

use App\Models\UserAddress;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;
#收货地址
class UserAddressTable extends LazyRenderable
{
    public function grid():Grid
    {
        #id
        $kay = $this->payload;
        return Grid::make(new UserAddress(), function (Grid $grid)use($kay) {
            $grid->model()->where("u_id",$kay["key"]);
            $grid->column('name',"收货人");
            $grid->column('mobile',"电话");
            $grid->column('province',"省");
            $grid->column('city','市');
            $grid->column('district','区');
            $grid->column('address','详情地址')->limit(10);
            $grid->column('is_default','默认地址')->using([1 => '是', 0 => '否'])->badge([
                0 => 'success',
                1 => 'danger',
            ]);
            $grid->paginate(10);
            $grid->disableActions();
            $grid->disableRowSelector();
        });
    }
}
