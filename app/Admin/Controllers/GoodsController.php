<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Goods;
use App\Models\GoodsCategory;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class GoodsController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Goods(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('goods_name');
            $grid->column('store_id')->display(function () {
                return '暂无';
            });
            $grid->column('brand_id')->display(function () {
                return '暂无';
            });
            $grid->column('category_id')->display(function ($v) {
                $res = GoodsCategory::find($v);
                return $res ? $res->name : '暂无';
            });
            $grid->column('view_num');
            $grid->column('sale_num');
            $grid->column('collect_num');
            $grid->column('add_time');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

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
        return Show::make($id, new Goods(), function (Show $show) {
            $show->field('id');
            $show->field('goods_name');
            $show->field('description');
            $show->field('store_id');
            $show->field('brand_id');
            $show->field('category_id');
            $show->field('goods_body');
            $show->field('body_images');
            $show->field('view_num');
            $show->field('sale_num');
            $show->field('collect_num');
            $show->field('goods_attr');
            $show->field('add_time');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * 添加和修改商品
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Goods(), function (Form $form) {
            $form->text('goods_name', '商品名称')->required();
            $form->select('category_id', '分类')->options(function () {
                $m = new GoodsCategory();
                return $m->selectTree();
            })->required();
            $form->textarea('description', '商品描述')->required();
            $form->select('brand_id', '品牌')->options([1 => '宝莱',2 => '小狗'])->required();
            $form->editor('goods_body', '详情介绍');
            $form->display('store_id');
            $form->display('add_time');
            $form->saving(function (Form $form){
                #通过这个后台发布的，统一为自营商品
                $form->store_id = config('admin.storeId');
                $form->add_time = time();
            });

        });

    }
}
