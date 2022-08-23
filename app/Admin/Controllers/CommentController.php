<?php

namespace App\Admin\Controllers;


use App\Admin\Repositories\UserComment;
use App\Common\AdminLog;
use App\Models\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class CommentController extends AdminController
{
    protected $title = "用户评论";
    protected function grid()
    {
        AdminLog::admin_log("查看用户ID:{$_GET['id']}","评论模块",1,12);
        return Grid::make(new UserComment(),function (Grid $grid){
               $grid->model()->where("u_id",$_GET["id"]);
               $grid->model()->orderByDesc("id");
               $grid->column("u_id","用户名")->display(function ($v){
                   return User::query()->where("id",$v)->value("name");
               });
               $grid->column("sku_name","商品名");
               $grid->column("user_comment","用户评论")->limit(15);
               $grid->column("merchant_comment","商家回复")->limit(15);
               $grid->column("status",'显示？')->switch();
               $grid->disableCreateButton();
        });
    }

    protected function form()
    {
        return Form::make(new UserComment(),function (Form $form){
            AdminLog::admin_log("修改用户ID:{$form->getKey()}评论状态","评论模块",2,12);
            $form->switch("status","状态");
        });
    }
}
