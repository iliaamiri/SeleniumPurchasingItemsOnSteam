<?php
namespace Core;

class controller{
    public static $views;
    public static $data;
    public static $page_title = "WITCHER V".WITCHER_VERSION;

    public static $WitcherMessage; // AJAX

    private $static404 = "layouts/errors/404.php";

    public static function setViews($array)
    {
        return self::$views = $array;
    }

    public static function setData($array)
    {
        return self::$data = $array;
    }

    public function Show()
    {
        $stat = array();
        $witcher = new \witcher();
        if (is_array(self::$views)) {
            foreach (self::$views as $views) {
                $full_path = $witcher->root() . "witcher/view/" . $views;
                if (!file_exists($full_path)) {
                    $views = $this->static404;
                }
                $witcher->requireView($views);
            }
        }
        return $stat;
    }

    public static function WitcherMessage($msg)
    {
        self::$WitcherMessage = $msg;
    }
}