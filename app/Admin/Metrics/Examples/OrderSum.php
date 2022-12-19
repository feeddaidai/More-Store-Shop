<?php

namespace App\Admin\Metrics\Examples;

use App\Models\User;
use Dcat\Admin\Admin;
use Dcat\Admin\Widgets\Metrics\Card;
use Dcat\Admin\Widgets\Metrics\Donut;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class OrderSum extends Card
{
    /**
     * 卡片底部内容.
     *
     * @var string|Renderable|\Closure
     */
    protected $footer;

    /**
     * 初始化卡片.
     */
    protected function init()
    {
        parent::init();

        $this->title('订单总金额');
        $this->dropdown([
            'today' => '当天',
            'month' => '当月',
            'year' => '当年',
        ]);
    }

    /**
     * 处理请求.
     *
     * @param Request $request
     *
     * @return void
     */
    public function handle(Request $request)
    {
        $user = User::query();
        switch ($request->get('option')) {
            case 'today':
                $data = $user->whereDate("created_at", date("Y-m-d"))->count();
                $this->content($data);
                break;
            case 'month':
                $data = $user->whereMonth("created_at", date("Y-m"))->count();
                $this->content($data);
                break;
            case 'year':
                $data = $user->whereYear("created_at", date("Y"))->count();
                $this->content($data);
                break;
            default:
                $data = $user->whereDate("created_at", date("Y-m-d"))->count();
                $this->content($data);
//                $this->up(15);
        }
    }

    /**
     * @param int $percent
     *
     * @return $this
     */
    public function up($percent)
    {
        return $this->footer(
            "<i class=\"feather icon-trending-up text-success\"></i> {$percent}% Increase"
        );
    }

    /**
     * @param int $percent
     *
     * @return $this
     */
    public function down($percent)
    {
        return $this->footer(
            "<i class=\"feather icon-trending-down text-danger\"></i> {$percent}% Decrease"
        );
    }

    /**
     * 设置卡片底部内容.
     *
     * @param string|Renderable|\Closure $footer
     *
     * @return $this
     */
    public function footer($footer)
    {
        $this->footer = $footer;

        return $this;
    }

    /**
     * 渲染卡片内容.
     *
     * @return string
     */
    public function renderContent()
    {
        $content = parent::renderContent();
        return <<<HTML
<div  class="d-flex justify-content-between align-items-center mt-1" style="margin-bottom: 2px">
    <h2 class="ml-1 font-lg-1">{$content}</h2>
</div>

HTML;
    }

    /**
     * 渲染卡片底部内容.
     *
     * @return string
     */
    public function renderFooter()
    {
        return $this->toString($this->footer);
    }
}
