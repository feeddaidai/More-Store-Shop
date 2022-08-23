<?php

namespace App\Admin\Repositories;

use Dcat\Admin\Form;
use Dcat\Admin\Repositories\EloquentRepository;
use App\Models\AdminLog as Model;
class AdminLog extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;


//    public function delete(Form $form, array $originalData)
//    {
//        dd(11);
//        \App\Common\AdminLog::admin_log(json_encode($_GET),"删除用户操作日志",4,21);
//        return true;
//    }
}
