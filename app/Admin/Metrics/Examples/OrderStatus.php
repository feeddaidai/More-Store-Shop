<?php

namespace App\Admin\Metrics\Examples;

use Dcat\Admin\Widgets\ApexCharts\Chart;
class OrderStatus extends Chart
{
    public function __construct($containerSelector = null, $options = [])
    {
        parent::__construct($containerSelector, $options);

        $this->setUpOptions();
    }

    /**
     * 初始化图表配置
     */
    protected function setUpOptions()
    {
//        $color = \Admin::color();
//
//        $colors = [$color->primary(), $color->primaryDarker()];
        $this->options([
//            'colors' => $colors,
            "series"=>[

            ],
            'chart' => [
                'type' => 'bar',
                'height' => 430
            ],
            'plotOptions' => [
                'bar' => [
                    'horizontal' => true,
                    'dataLabels' => [
                        'position' => 'top',
                    ],
                ]
            ],
            'dataLabels' => [
                'enabled' => true,
                'offsetX' => -6,
                'style' => [
                    'fontSize' => '12px',
                    'colors' => ['#fff']
                ]
            ],
            'stroke' => [
                'show' => true,
                'width' => 1,
                'colors' => ['#fff']
            ],
            "tooltip"=>[
                "shared"=>true,
                "intersect"=>false
            ],
            'xaxis' => [
                'categories' => [],
            ],

        ]);

    }

    /**
     * 处理图表数据
     */
    protected function buildData()
    {
        // 执行你的数据查询逻辑
        $data = [
            [
                "name" => 1,
                'data' => [44, 55, 41, 64, 22, 43, 21]
            ],
            [
                "name" => 2,
                'data' => [53, 32, 33, 52, 13, 44, 32]
            ]
        ];
        $categories = [1, 2, 3, 4, 5, 6, 7];

        $this->withData($data);
        $this->withCategories($categories);
    }

    /**
     * 设置图表数据
     *
     * @param array $data
     *
     * @return $this
     */
    public function withData(array $data)
    {
        return $this->option('series', $data);
    }

    /**
     * 设置图表类别.
     *
     * @param array $data
     *
     * @return $this
     */
    public function withCategories(array $data)
    {
        return $this->option('xaxis.categories', $data);
    }

    /**
     * 渲染图表
     *
     * @return string
     */
    public function render()
    {
        $this->buildData();
        return parent::render();
    }
}
