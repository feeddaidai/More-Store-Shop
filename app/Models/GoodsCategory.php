<?php


namespace App\Models;


class GoodsCategory extends BaseModel
{
    protected $table         = 'goods_category';
    protected $prepositionSy = '——';

    public function selectTree()
    {
        $list = self::orderBy('order', 'asc')->get()->toArray();
        return self::buildSelectOptions($list);
    }

    protected function buildSelectOptions(array $nodes = [], $parentId = 0, $prefix = '', $space = '&nbsp;')
    {
        $d      = '├─';
        $prefix = $prefix ?: $d . $space;

        $options = [];

        foreach ($nodes as $index => $node) {
            if ($node['parent_id'] == $parentId) {
                $currentPrefix = self::hasNextSibling($nodes, $node['parent_id'], $index) ? $prefix : str_replace($d, '└─', $prefix);

                $node['name'] = $currentPrefix . $space . $node['name'];

                $childrenPrefix = str_replace($d, str_repeat($space, 6), $prefix) . $d . str_replace([$d, $space], '', $prefix);

                $children = self::buildSelectOptions($nodes, $node['id'], $childrenPrefix);

                $options[$node['id']] = $node['name'];

                if ($children) {
                    $options += $children;
                }
            }
        }

        return $options;
    }

    protected function hasNextSibling($nodes, $parentId, $index)
    {
        foreach ($nodes as $i => $node) {
            if ($node['parent_id'] == $parentId && $i > $index) {
                return true;
            }
        }
    }

}
