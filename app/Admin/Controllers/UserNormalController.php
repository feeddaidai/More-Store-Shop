<?php

namespace App\Admin\Controllers;

use App\Admin\Renderable\User\UserAddressTable;
use App\Admin\Renderable\User\UserCollectTable;
use App\Admin\Renderable\User\UserFootprintTable;
use App\Admin\Repositories\UserNormal;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class UserNormalController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new UserNormal(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->disableCreateButton();
            $grid->column('account','账号');
            $grid->column('name','用户名');
            $grid->column('avatar','头像')->image("/");
            $grid->column('mobile','手机号码');
            $grid->column('email','邮箱');
            $grid->column('address','收货地址')->display('点击查看')->modal('用户收货地址',UserAddressTable::make());
            $grid->column('collect','用户收藏')->display('点击查看')->modal('用户收藏',UserCollectTable::make());
            $grid->column('footprint','用户足迹')->display('点击查看')->modal('用户足迹',UserFootprintTable::make());
            $grid->column('comment','用户评论')->link()->display(function (){
                return "<a target='_blank' href='user_comment/?id={$this->id}'>点击查看</a><br>";
            });
            $grid->column('invoice','用户发票')->link()->display(function (){
                return "<a target='_blank' href='invoice/?id={$this->id}'>点击查看</a><br>";
            });
            $grid->column('add_time','注册时间')->display(function ($v){
                $res = day_to_day($v);
                return "已注册{$res}天";
            });
            $grid->withBorder();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('account',"账号");
                $filter->like('name',"用户名");
                $filter->like('email',"邮箱");
                $filter->equal('mobile',"手机号码");
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new UserNormal(), function (Show $show) {
            $show->field('id');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new UserNormal(), function (Form $form) {
            $form->display('id');
            $form->text('name',"用户名");
            $form->mobile('mobile',"手机号码");
        });
    }
}
