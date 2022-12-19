<?php

namespace App\Admin\Controllers;

use App\Admin\Metrics\Examples;
use App\Http\Controllers;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Http\Controllers\Dashboard;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Card;

class HomeController extends AdminController
{
    public function index(Content $content)
    {
        return $content
            ->header('数据统计')
            ->description('数据统计')
            ->body(function (Row $row) {
                $row->column(3, function (Column $column) {
                    $column->row(new Examples\TotalUsers());

                });
                $row->column(6, function (Column $column) {
                    $column->row(function (Row $row) {
                        $row->column(6, new Examples\OrderSum());
                        $row->column(6, new Examples\Order());
                    });
//                    $column->row(new Examples\Sessions());
//                    $column->row(new Examples\ProductOrders());
                });
                $row->column(9, function (Column $column) {
                    $column->row( Card::make('我的图表', Examples\OrderStatus::make()));
                });
            });
    }
}
