<?php

namespace App\Common;
#后台日志方法
use Dcat\Admin\Admin;
use Illuminate\Support\Facades\DB;
class AdminLog
{
    public static function admin_log($content = "",$title="",$type = 1,$menu_id="")
    {
        $menu = substr(url()->current(),26);
        if (empty($menu_id)){
            $menu_id = DB::table("admin_menu")
                ->where("uri",$menu)
                ->value("id");
        }
        $u_id =Admin::user()->id; #当前操作人ID
        #1=查看  2=修改  3=新增 4=删除
        \App\Models\AdminLog::query()->insert(
            [
                "content" =>$content,
                "title"   =>$title,
                "type"    =>$type,
                "menu_id" =>$menu_id,
                "admin_id"=>$u_id,
                "ip"      =>$_SERVER["REMOTE_ADDR"],
                "created_at" => date("Y-m-d H:i:s")
            ]
        );
    }
}

