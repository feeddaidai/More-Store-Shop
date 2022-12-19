<?php

namespace App\Admin\Controllers\platform;

use App\Admin\Renderable\Form\WebsiteConfig;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Widgets\Card;

class WebsiteSetController extends AdminController
{
    protected $title = "网站设置";

    public function index(Content $content)
    {
      return  $content->body(new Card(new WebsiteConfig()));
    }
}
