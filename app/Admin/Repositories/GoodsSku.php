<?php

namespace App\Admin\Repositories;

use App\Models\GoodsImage;
use App\Models\GoodsSku as Model;

use App\Models\SkuSpecValue;
use App\Service\LogService;
use Dcat\Admin\Form;
use App\Models\Goods as Goods;
use Dcat\Admin\Repositories\EloquentRepository;
use Illuminate\Support\Facades\DB;

class GoodsSku extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    public function store(Form $form)
    {
        // 获取待新增的数据
        $attributes = $form->updates();
        if (isset($attributes['goods_id'])) {

            // 执行你的新增逻辑
            $goodsModel = Goods::find($attributes['goods_id']);
            $goodsName  = $goodsModel->goods_name;
            #生成名字
            $specArr = $attributes['extra'];
            $specArr = td_sort($specArr, 'spec_sort');
            foreach ($specArr as $item) {
                $goodsName .= " {$item['spec_value']}";
            }
            if ($attributes['id']) {
                $model = Model::find($attributes['id']);
            } else {
                $model = new Model();
            }

            // 返回新增记录id或bool值
            DB::beginTransaction();
            try {
                $model->goods_id       = $attributes['goods_id'];
                $model->sku_name       = $goodsName;
                $model->main_image     = $attributes['main_image'];
                $model->images         = img_to_str($attributes['images']);
                $model->goods_storage  = $attributes['goods_storage'];
                $model->price          = (float)$attributes['price'];
                $model->putaway_status = $attributes['putaway_status'] ?? 0;
                $model->save();
                $skuId = $model->getKey();
                #存储规格
                SkuSpecValue::storageMany($skuId, $specArr);
                DB::commit();
                return true;
            } catch (\Exception $e) {
                DB::rollBack();
                $log = LogService::getInstance();
                $log->mysql($e);
                return false;
            }
        }
        return true;
    }

    public function update(Form $form)
    {
        return $this->store($form);
    }

    public function edit(Form $form)
    {
        // 获取数据主键值
        $id    = $form->getKey();
        $model = Model::find($id);
        $data  = [
            'id'            => $model->id,
            'goods_id'      => $model->goods_id,
            'goods_storage' => $model->goods_storage,
            'price'         => $model->price,
        ];
        #获取主图和图片集
        $data['main_image'] = ltrim(GoodsImage::getOne($model->main_image)[config('admin.big')], '/uploads');
        $images             = GoodsImage::getManyByStr($model->images);
        $imgs               = [];
        foreach ($images as $mg) {
            $imgs[] = ltrim($mg[config('admin.big')], '/uploads');
        }
        $data['images'] = $imgs;
        $data['extra']  = SkuSpecValue::getOne($id);
        return $data;
    }


    public function delete(Form $form, array $originalData)
    {
        $ids = explode(',', $form->getKey());
        #规格关联表和sku表同时假删除
        DB::beginTransaction();
        $skuModel  = new Model();
        $specModel = new SkuSpecValue();
        try {
            foreach ($ids as $id) {
                $skuModel->where('id', $id)->delete();
                $specModel->where('sku_id', $id)->delete();
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            $log = LogService::getInstance();
            $log->mysql($exception);
            return false;
        }
    }


}
