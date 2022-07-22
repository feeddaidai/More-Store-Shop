<?php


namespace App\Models;


class Goods extends BaseModel
{
    protected $table = 'goods';
    const PAGE_SIZE = 20;
    const SKU_ORDER = 'view_num';
    protected $hidden  = ['goods_body'];
    protected $appends = ['add_date', 'store_name', 'cate_name'];
    const BASE_MAP = ['putaway_status' => 1];

    public function getAddDateAttribute()
    {
        return to_date($this->add_time);
    }

    public function getStoreNameAttribute()
    {
        return '自营';
    }

    public function getCateNameAttribute()
    {
        $cateModel = GoodsCategory::find($this->category_id);
        return $cateModel->name;
    }

    #根据skuID获取商品信息
    public function getGoodsBySku($skuId)
    {
        $data = [];
        $sku = GoodsSku::where(static::BASE_MAP)
            ->where('id',$skuId)
            ->first();
        if( !$sku )return $data;
        $goods = Goods::where(static::BASE_MAP)
            ->where('id',$sku->goods_id)
            ->first();
        if( !$goods )return [];
        #封装规格
        $skuList = [];
        $specItems = [];
        $skuBroList = GoodsSku::where(static::BASE_MAP)
            ->where('goods_id',$sku->goods_id)
            //->where('id','<>',$skuId)
            ->get();
        foreach ($skuBroList as $key => $item) {
            $difference = '';
            foreach ($item->spec_list as $v) {
                $difference .= "{$v['spec_value']};";
                if( isset($specItems[$v['spec_id']]) ){
                    if( !in_array(['name' => $v['spec_value']],$specItems[$v['spec_id']]['items']) ){
                        $specItems[$v['spec_id']]['items'][] = [
                          'name' => $v['spec_value']
                        ];
                    }
                }else{
                    $specItems[$v['spec_id']] = [
                        'name' => $v['spec_name'],
                        'items' => [
                            [
                                'name' => $v['spec_value']
                            ]
                        ]
                    ];
                }
            }
            $difference = rtrim($difference,';');
            $skuList[] = [
                'sku_id' => $item->id,
                'difference' => $difference,
                'stock' => $item->goods_storage
            ];
        }

        //默认选中效果
        $skuSpecList = $sku->spec_list;
        $default = [];
        for ($i = 0; $i < count($skuSpecList); $i ++){
            $default[] = 0;
        }
        foreach ($skuSpecList as $sindex => $sitem) {
            foreach ($specItems[$sindex + 1]['items'] as $itemKey => $si) {
                if( $sitem['spec_value'] == $si['name'] ){
                    $default[$sindex] = $itemKey;
                    break;
                }else{
                    $default[$sindex] = -1;
                }
            }
        }



        $data = [
            'goods' => $goods,
            'sku' => $sku,
            'skuList' => $skuList,
            'specs' => $specItems,
            'default' => $default
        ];
        return $data;
    }

    /**
     * 商品列表
     * @param $cateId 分类id
     * @param $page  页码
     * @param int $size
     * @return array
     */
    public function getGoodsList($cateId, $page, $size = self::PAGE_SIZE)
    {
        $start     = ($page - 1) * $size;
        $cateIds   = GoodsCategory::getSonsId($cateId);
        $goodsList = self::with(['defaultSku'])
            ->where(self::BASE_MAP)
            ->whereIn('category_id', $cateIds)
            ->offset($start)
            ->limit($size)
            ->get()
            ->toArray();
        return $goodsList;
    }


    public function defaultSku()
    {
        $order = (m_config())['sku_order'] ?? self::SKU_ORDER;
        return $this->hasOne(GoodsSku::class, 'goods_id', 'id')->orderBy($order, 'desc');
    }


}
