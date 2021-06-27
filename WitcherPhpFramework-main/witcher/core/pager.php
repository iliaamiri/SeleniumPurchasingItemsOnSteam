<?php
namespace Core;

class pager{
    private static $pages;
    function __construct()
    {
        $witcher = new \witcher();
        self::$pages = $witcher->getCoreConfigs("pages.php");
    }

    public static function go_page($page,$custom_page = null){
        if ($custom_page != null){
            header("location:".$custom_page);
            exit();
        }
        $witcher = new \witcher();
        self::$pages = $witcher->getCoreConfigs("pages.php");
        //header_remove("location:".$page);
        if (array_key_exists($page,self::$pages))
            header("location:".self::$pages[$page]);
        else
            header("location:".self::$pages['404']);
    }
    public static function redirect_page($time,$page,$custom_page = null){
        if ($custom_page != null) {
            header("refresh:" . $time . ";" . "url=" . $page);
            exit;
        }
        $witcher = new \witcher();
        self::$pages = $witcher->getCoreConfigs("pages.php");
        if (array_key_exists($page,self::$pages))
            header("refresh:".$time .";url=".self::$pages[$page]);
        else
            header("refresh:".$time.";url=" . self::$pages['404']);

    }
    public function include_page($page){
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= $page;
        include_once($path);
    }
    public static function refresh(){
        header("refresh:0;");
    }
}