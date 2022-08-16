<?php

namespace App\Admin\Controllers\platform;

use App\Models\Expressage;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
#快递平台
class ExpressageController extends AdminController
{
    protected $title = "快递平台";

    protected function grid()
    {
       return Grid::make(new Expressage(),function (Grid $grid){
            $grid->column("id","ID");
            $grid->column("expressage_name","快递公司");
            $grid->column("expressage_code","快递公司编码");
            $grid->column("status","状态")->using([0=>"禁用",1=>"正常"])->badge([
                1 => 'success',
                0 => 'danger',
            ]);
            $grid->column("created_at","创建时间");
            $grid->column("updated_at","修改时间");
            $grid->disableViewButton();
            $grid->disableDeleteButton();
       });
    }

    protected function form()
    {
        return Form::make(new Expressage(),function (Form $form){
            $form->text("expressage_name","快递公司");
            $form->text("expressage_code","快递公司编码");
            $form->radio('status', '状态')->options([0=>"禁用",1=>"正常"])->default(1);
        });
    }
}
