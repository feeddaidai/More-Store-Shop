<?php

namespace App\Admin\Controllers\platform;

use App\Admin\Repositories\WebsiteAgreement;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class WebsiteAgreementController extends AdminController
{
    protected $title = "网站协议";

    protected function grid()
    {
        return Grid::make(WebsiteAgreement::make(),function (Grid $grid){
            $grid->model()->orderByDesc("created_at");
            $grid->column("title","标题");
            $grid->column("created_at","创建时间");
            $grid->column("updated_at","修改时间");
            $grid->disableViewButton();
        });
    }

    protected function form()
    {
        return Form::make(WebsiteAgreement::make(),function (Form $form){
            $form->text("title","标题");
            $form->editor("content","内容");
        });
    }
}
