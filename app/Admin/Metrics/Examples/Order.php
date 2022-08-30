<?php

namespace App\Admin\Metrics\Examples;

use Dcat\Admin\Admin;
use Dcat\Admin\Widgets\Metrics\Donut;
use Illuminate\Support\Facades\Redis;

class Order extends Donut
{
    protected $labels = ['今天', '昨天'];

    /**
     * 初始化卡片内容
     */
    protected function init()
    {
        parent::init();

        $color = Admin::color();
        $colors = [$color->primary(), $color->alpha('blue2', 0.5)];

        $this->title('今天和昨天订单');
        $this->subTitle('订单');
        $this->chartLabels($this->labels);
        // 设置图表颜色
        $this->chartColors($colors);
    }

    /**
     * 渲染模板
     *
     * @return string
     */
    public function render()
    {
        $this->fill();

        return parent::render();
    }

    /**
     * 写入数据.
     *
     * @return void
     */
    public function fill()
    {
        $today = \App\Models\Order::query()->whereDate("created_at",date("Y-m-d"))->count();
        if (empty(Redis::get("yesterday"))){
            $yesterday = \App\Models\Order::query()->whereDate("created_at",date("Y-m-d", strtotime("-1 day")))->count();
            Redis::set("yesterday",$yesterday);
        }else{
          $yesterday = Redis::get("yesterday");
        }
        $this->withContent($today, $yesterday);
        // 图表数据
        $this->withChart([$today,$yesterday]);
    }

    /**
     * 设置图表数据.
     *
     * @param array $data
     *
     * @return $this
     */
    public function withChart(array $data)
    {
        return $this->chart([
            'series' => $data
        ]);
    }

    /**
     * 设置卡片头部内容.
     *
     * @param mixed $desktop
     * @param mixed $mobile
     *
     * @return $this
     */
    protected function withContent($desktop, $mobile)
    {
        $blue = Admin::color()->alpha('blue2', 0.5);

        $style = 'margin-bottom: 8px';
        $labelWidth = 120;

        return $this->content(
            <<<HTML
<div class="d-flex pl-1 pr-1 pt-1" style="{$style}">
    <div style="width: {$labelWidth}px">
        <i class="fa fa-circle text-primary"></i> {$this->labels[0]}
    </div>
    <div>{$desktop}</div>
</div>
<div class="d-flex pl-1 pr-1" style="{$style}">
    <div style="width: {$labelWidth}px">
        <i class="fa fa-circle" style="color: $blue"></i> {$this->labels[1]}
    </div>
    <div>{$mobile}</div>
</div>

HTML
        );
    }
}
