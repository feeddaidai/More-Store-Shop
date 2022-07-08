<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Spec;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpecController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Spec(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('spec_name');
            $grid->column('spec_type');
            $grid->column('icon');
            $grid->column('value_select');
            $grid->column('status');
            $grid->column('category_id');
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
        return Show::make($id, new Spec(), function (Show $show) {
            $show->field('id');
            $show->field('spec_name');
            $show->field('spec_type');
            $show->field('icon');
            $show->field('value_select');
            $show->field('status');
            $show->field('category_id');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Spec(), function (Form $form) {
            $form->display('id');
            $form->text('spec_name');
            $form->text('spec_type');
            $form->text('icon');
            $form->text('value_select');
            $form->text('status');
            $form->text('category_id');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }

    public function getName(Request $request)
    {
        $cateId = $request->get('q');
        return \App\Models\Spec::where('category_id', $cateId)->get(['id', DB::raw('spec_name as text')]);
    }

    public function getValue(Request $request)
    {
        $cateId = $request->get('q');
        $spec = \App\Models\Spec::where('category_id', $cateId)->first();
        $valueArr = explode(',',$spec->value_select);
        $return = [];
        foreach ($valueArr as $index => $item) {
            $return[] = [
                'id' => $item,
                'text' => $item
            ];
        }
        return $return;
    }
}
