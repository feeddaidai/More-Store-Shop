<?php


namespace App\Exceptions\Goods;


use App\Models\GoodsSku;
use Dcat\Admin\Grid\RowAction;
use Illuminate\Http\Request;


class SkuAction extends RowAction
{
    public function title()
    {
        return '上架/下架';
    }

    public function confirm()
    {
        $status = $this->row->putaway_status;
        $text   = $status ? "下架" : "上架";
        return [
            "确定{$text}该商品吗？",
            "确认后即可切换",
        ];
    }

    public function parameters()
    {
        return [
            'putaway_status' => $this->row->putaway_status,
        ];
    }

    public function handle(Request $request)
    {
        $id = $this->getKey();
        $status = $request->get('putaway_status');
        GoodsSku::where('id',$id)->update([
            'putaway_status' => (int)!$status
        ]);
        // 返回响应结果并刷新页面
        return $this->response()->success("操作成功")->refresh();
    }


}
