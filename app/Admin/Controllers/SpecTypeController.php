<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\SpecType;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class SpecTypeController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new SpecType(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('type_name');
        
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
        return Show::make($id, new SpecType(), function (Show $show) {
            $show->field('id');
            $show->field('type_name');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new SpecType(), function (Form $form) {
            $form->display('id');
            $form->text('type_name');
        });
    }
}
