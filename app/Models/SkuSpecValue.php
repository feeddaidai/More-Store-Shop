<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class SkuSpecValue extends BaseModel
{
    protected $table = 'sku_spec_value';
    use SoftDeletes;

    public function storageOne($params)
    {
        $specModel = Spec::find($params['spec_id']);
        if ($params['id']) {
            $model = self::find($params['id']);
        } else {
            $model = new self();
        }
        $model->sku_id     = $params['sku_id'];
        $model->spec_id    = $params['spec_id'];
        $model->spec_name  = $specModel->spec_name;
        $model->spec_value = $params['spec_value'];
        $model->spec_sort  = $params['spec_sort'];
        $model->save();
        return $model->getKey();
    }

    public function storageMany($skuId, $specs)
    {
        foreach ($specs as $spec) {
            $spec['sku_id'] = $skuId;
            self::storageOne($spec);
        }
    }

    public function getOne($sku)
    {
        $data  = [];
        $specs = self::with('spec')->where('sku_id', $sku)->get();
        foreach ($specs as $spec) {
            $data[] = [
                'id'          => $spec->id,
                'spec_id'     => $spec->spec_id,
                'category_id' => $spec->spec->category_id,
                'spec_name'   => $spec->spec_name,
                'spec_value'  => $spec->spec_value,
                'spec_sort'   => $spec->spec_sort,
            ];
        }
        $data = td_sort($data, 'spec_sort');
        return $data;
    }

    public function spec()
    {
        return $this->hasOne(Spec::class, 'id', 'spec_id');
    }
}
