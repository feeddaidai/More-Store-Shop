<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Store;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class StoreController extends AdminController
{
    protected $title = "店铺列表";

    protected function grid()
    {
        return Grid::make(new Store(),function (Grid $grid){
            $grid->withBorder();
            $grid->column("id","ID");
            $grid->column("store_name","店铺名")->label();
            $grid->column("store_logo","logo图片")->image();
            $grid->column("store_phone","联系方式");
            $grid->column('store_state','状态')->using([0 => '关闭',1=>'开启',2 => '审核中'])->badge([
                2 => 'danger',
                0 => 'primary',
                1 => 'success',
            ]);
            $grid->column("store_address","店铺地址");
            $grid->column("store_introduction","店铺介绍")->limit(15);
            $grid->filter(function (Grid\Filter $filter){
                $filter->like("store_name","店铺名");
                $filter->equal('store_status',"状态")->select([0 => '关闭',1=>'开启',2 => '审核中']);
            });
            $grid->actions(function ($actions) {
                // 去掉查看
                $actions->disableView();
                $actions->disableDelete();
            });
            //去掉复选框
            $grid->disableRowSelector();
        });
    }

    protected function form()
    {
        return Form::make(new Store(),function (Form $form){

            // 第一列占据1/2的页面宽度
            $form->column(6, function (Form $form) {
                $form->text("store_name","店铺名");
                $form->text("store_phone","联系方式");
                $form->text("store_address","店铺地址");
                $form->textarea("store_introduction","店铺介绍");
                $form->radio('store_status', '状态')->options([0 => '关闭',1=>'开启',2 => '审核中']);
                $form->radio('store_recommend', '是否推荐')->options([0 => '否',1=>'是']);
            });
            // 第二列占据1/2的页面宽度
            $form->column(6, function (Form $form) {
                $form->image("store_logo","logo图片");
                $form->image("store_banner","店铺Banner图");
                $form->image("identity_card_front","身份证正面");
                $form->image("identity_card_reverse","身份证反面");
            });

            //表单右上角
            $form->tools(function (Form\Tools $tools) {
                $tools->disableDelete();
                $tools->disableView();
            });
            //表单右下角
            $form->disableEditingCheck();
            $form->disableViewCheck();
        });
    }
}
