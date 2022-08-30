<?php


namespace App\Admin\Renderable\Form;

use Dcat\Admin\Widgets\Form;
use Symfony\Component\HttpFoundation\Response;

class WebsiteConfig extends Form
{
    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return Response
     */
    public function handle(array $input)
    {
       $res = \App\Models\WebsiteSet::query()->where("id",1)->update([
              "website_name" => $input['website_name'],
              "keyword" => $input['keyword'],
              "website_describe" => $input['website_describe'],
              "website_status" => $input['website_status'],
              "phone_text" =>  $input['phone_text'],
              "icon" =>  $input['icon'],
              "logo" =>  $input['logo'],
        ]);
       if ($res){
           return $this->response()->success('修改成功')->location();
       }
        return $this->response()->error("修改失败");
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $value = \App\Models\WebsiteSet::query()->where("id",1)->first()->toArray();
        $this->column(6,function ()use($value){
            $this->text("website_name","网站名称")->default($value["website_name"]);
            $this->text("keyword","网站关键词")->default($value["keyword"]);
            $this->textarea("website_describe","网站描述")->default($value["website_describe"]);
            $this->switch("website_status","网站状态")->default($value["website_status"]);
            $this->table('phone_text',"客服联系方式", function ($table) {
                $table->text('QQ');
                $table->text('WX');
                $table->text('phone');
            })->saving(function ($v) {
                return json_encode($v);
            })->default($value["phone_text"]);
        });
        $this->column(6,function ()use($value){
            $this->image("icon","网站icon")->autoUpload()->default($value["icon"]);
            $this->image("logo","网站logo")->autoUpload()->default($value["logo"]);
        });
    }
}
