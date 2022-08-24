<?php

namespace App\Admin\Repositories;

use App\Models\GoodsCategory as Model;
use Dcat\Admin\Form;
use Dcat\Admin\Repositories\EloquentRepository;
#商品分类
class GoodsCategory extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    /**
     * 删除
     * @param Form $form
     * @param array $originalData
     * @return bool
     */
    public function delete(Form $form, array $originalData)
    {
        $data = \App\Models\GoodsCategory::query()->where("parent_id",$form->getKey())->value("id");
        if (!$data){
           $res = \App\Models\GoodsCategory::query()->where("id",$form->getKey())->delete();
           if ($res) return true;
            return false;
        }
        return $form->response()->error("存在下级，无法删除");
    }
}

