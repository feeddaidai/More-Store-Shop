<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\GoodsSku;
use App\Exceptions\Goods\SkuAction;
use App\Models\Goods;
use App\Models\GoodsCategory;
use App\Models\GoodsImage;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class GoodsSkuController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new GoodsSku(), function (Grid $grid) {
            $grid->column('sku_name','商品名称');
            $grid->column('main_image')->display(function ($v){
                return  GoodsImage::adminGetOne($v)[config('admin.thumb')];
            })->image();
            $grid->column('goods_storage','库存');
            $grid->column('view_num','浏览量');
            $grid->column('sale_num','销量');
            $grid->column('collect_num','收藏量');
            $grid->column('putaway_status','状态')->using([1 => '在售', 0 => '下架'])->badge([
                0 => 'danger',
                1 => 'success',
            ]);
            $grid->column('price','价格');
            $grid->column('created_at');
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                // append一个操作
                $actions->append(new SkuAction());
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
        return Show::make($id, new GoodsSku(), function (Show $show) {
            $show->field('id');
            $show->field('goods_id');

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new GoodsSku(), function (Form $form) {
            $form->hidden('id');
            $form->hidden('putaway_status')
                ->customFormat(function ($v) {
                    return $v == '上架' ? 1 : 0;
                });
            $form->select('goods_id','商品')->options(function (){
                $storeId = config('admin.storeId');
                return Goods::where('store_id',$storeId)->pluck('goods_name','id');
            });
            $form->image('main_image','商品主图')->thumbnail([
                config('admin.thumb') => [100, 100],
                config('admin.medium') => [400, 400],
            ]);
            $form->multipleImage('images','商品图片集')->thumbnail([
                config('admin.thumb') => [100, 100],
                config('admin.medium') => [400, 400],
            ]);;
            $form->number('goods_storage','商品库存');
            $form->text('price','商品价格');
            $form->table('extra', function (Form\NestedForm $table) {
                $table->hidden('id');
                $table->select('category_id','分类')->options(GoodsCategory::selectTree())->loads(['spec_id','spec_value'],['/api/spec','/api/spec/value']);
                $table->select('spec_id','规格名称');
                $table->select('spec_value','规格值');
                $table->number('spec_sort','权重')->help('数字越大越靠前');
            })->label('规格');

            $form->saving(function (Form $form){
                $form->main_image = GoodsImage::storage($form->main_image);
                $form->images = GoodsImage::storageMany($form->images);
            });
        });
    }
}
