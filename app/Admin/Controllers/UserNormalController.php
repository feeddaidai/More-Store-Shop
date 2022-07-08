<?php

namespace App\Admin\Controllers;

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
            $grid->column('avatar','头像');
            $grid->column('add_time','注册时间')->display(function ($v){
                $res = day_to_day($v);
                return "已注册{$res}天";
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
            $form->text('name');
        });
    }
}
