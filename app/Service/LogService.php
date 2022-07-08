<?php


namespace App\Service;


use App\Models\MysqlLog;

class LogService
{
    protected static $self = null;
    protected $mysqlModel = '';

    private function __construct()
    {
        $this->mysqlModel = new MysqlLog();
    }

    public static function getInstance()
    {
        if ( !self::$self ){
            self::$self = new self();
        }
        return self::$self;
    }

    public function mysql($ex)
    {
        $this->mysqlModel->msg = substr($ex->getMessage(),0,100) ;
        $this->mysqlModel->content = "数据库操作错误：{$ex->getFile()}文件第{$ex->getLine()}行出错，CODE：{$ex->getCode()},详情{$ex->getMessage()}||";
        $this->mysqlModel->save();
    }

    public  function __clone()
    {
        return self::$self;
        // TODO: Implement __clone() method.
    }


}
