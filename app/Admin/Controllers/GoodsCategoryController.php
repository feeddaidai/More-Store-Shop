<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\GoodsCategory;
use App\Common\AdminLog;
use Dcat\Admin\Form;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Tree;

class GoodsCategoryController extends AdminController
{
    protected $title = "商品分类";

    public function index(Content $content)
    {
        AdminLog::admin_log(json_encode($_GET),"商品分类模块",1,18);
        return $content->header('商品分类')
            ->body(function (Row $row) {
                $tree = new Tree(new GoodsCategory());
                $tree->disableCreateButton();
                $tree->disableEditButton();
                $tree->branch(function ($branch) {
                    return "{$branch['id']} - {$branch['name']}&nbsp;&nbsp;[<span class='text-primary'>{$branch['title']}</span>]";
                });
                $row->column(12, $tree);
            });
    }


    protected function form()
    {
        return Form::make(new GoodsCategory(),function (Form $form){
            $form->select('parent_id', '上级')->options(function () {
                $m = new \App\Models\GoodsCategory();
                return $m->selectTree();
            });
            $form->text("name","分类名称");
            $form->text("title","分类名称");
            $form->number("order","排序");
            $form->saving(function (Form $form){
                if ($form->parent_id == null){
                    $form->parent_id = 0;
                }
            });
        });
    }
}
