<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\UserInvoice;
use App\Models\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class InvoiceController extends AdminController
{
    protected $title = "发票管理";

    protected function grid()
    {
        return Grid::make(new UserInvoice(),function (Grid $grid){
                if (isset($_GET["id"])){
                    $grid->model()->where("u_id",$_GET["id"]);
                }
                $grid->column("order_code","订单号");
                $grid->column("u_id","用户名")->display(function ($v){
                    return User::query()->where("id",$v)->value("name");
                });
                $grid->column("invoice_img","发票图片")->image();
                $grid->column('status','状态')->using([2 => '通过', 0 => '不通过',1=>'审核中'])->badge([
                    2 => 'success',
                    0 => 'danger',
                    1 => 'primary',
                ]);
                $grid->column("created_at","提交时间");
                $grid->column("updated_at","修改时间");
                $grid->column("approval_date","审核时间");
                $grid->withBorder();
                $grid->disableCreateButton();
                $grid->filter(function (Grid\Filter $filter){
                    $filter->like("order_on","订单号");
                    if (!isset($_GET["id"])){
                        $filter->where('name', function ($query) {
                            $query->whereHas('user', function ($query) {
                                $query->where('name', 'like', "%{$this->input}%");
                            });
                        }, '用户名');
                    }
                    $filter->equal('status',"状态")->select([0 => '不通过',1=>'审核中',2=>"通过"]);
                });
                $grid->actions(function ($actions) {
                    #判定状态是否可以编辑
                    if ($this->status == 2 || $this->status == 0){
                        $actions->disableEdit();
                    }
                    // 去掉查看
                    $actions->disableView();
                });
        });
    }

    protected function form()
    {
        return Form::make(new UserInvoice(),function (Form $form){
            $form->radio('status', '状态')->options([0 => '不通过',1=>'审核中',2=>"通过"]);
            $form->image("invoice_img","发票图片")->autoUpload();
            $form->text("invoice_comment","审核备注");
        });
    }
}
