<?php

class witcher{
    public $environment = "development"; // serving , development
    public function Run(){
        $this->preRun();
        date_default_timezone_set('Asia/Tehran');
    }
    private function preRun(){
        switch ($this->environment){
            case "development":
                error_reporting(E_ALL);
                ini_set('display_startup_errors', 1);
                ini_set('display_errors', 1);
                break;
            case "serving":
                ini_set('display_errors', 0);
                break;
            default:
                echo 'The application environment is not set correctly.';
                exit();
                break;
        }
        $this->requireCoreClasses();
    }
    public function Stop(){
        session_destroy();
        echo "server has stopped serving this ip.";
        die();
    }
    public function unsetSession($custom = array()){
        if (count($custom) > 0){
            foreach ($custom as $index){
                if (isset($_SESSION[$index]))
                    unset($_SESSION[$index]);
            }
        }
    }
    public function requireclass($pathh){
        $path = $pathh;
        include_once($path);
    }
    private function requireModel(){
        $dirs = scandir(DIR_MODELS);
        foreach ($dirs as $classes) {
            $a= explode('.', $classes);
            $end = end($a);
            if ($end === "php") {
                require_once (DIR_MODELS.$classes);
            }
        }
    }
    private function requireCoreClasses(){
        $dirs = scandir(DIR_CORE);
        foreach ($dirs as $classes) {
            $a= explode('.', $classes);
            $end = end($a);
            if ($end === "php") {
                require_once (DIR_CORE.$classes);
            }
        }
    }
    public function getCoreConfigs($config_path){
        return include DIR_CORE."config/".$config_path;
    }
    public function getExceptionsMessages($config_path){
        return include DIR_CORE."config/ExceptionsMessages/".$config_path;
    }
    public function requireModelObjects(){
        $p = DIR_MODELS."modelObject/";
        $files = scandir($p);
        foreach ($files as $file ){
            $exp = explode(".",$file);
            $end = end($exp);
            if ($end === "php"){
                require_once $p.$file;
            }
        }
    }
    public function requireController($class,$dir=""){
        $path = $this->root()."witcher/app/controller/".$dir.$class.".php";
        require_once($path);
    }
    public function requireModules($path = "/"){
        $p = $this->root()."witcher/app/module".$path;
        if (!file_exists($p))
            return false;

        $files = scandir($p);
        $i = 0;
        foreach ($files as $file ){
            $exp = explode(".",$file);
            $end = end($exp);
            if ($end === "php"){
                $i++;
                require_once $p.$file;
            }
        }
        if ($i > 0)
            return true;
        else
            return false;
    }
    public function requireModule($path){
        $p = $this->root()."witcher/app/module".$path;
        if (file_exists($p)){
            require_once $p;
            return true;
        }else{
            return false;
        }
    }
    public function startController($class,$method,$parameters,$dir = ""){
        // $details is an array , First index say that if start() function has any arguman or not.
        // Second index is filled by value of the start() function's arguman.
        $controller_path = $this->root()."witcher/app/controller/".$dir.$class.".php";
        if (file_exists($controller_path)){
            $name = "\Controller\ ".$class;
            $name = str_replace(" ","",$name);
            $object = new $name;
            call_user_func_array(array($object, $method),$parameters);
        }
    }
    public function requireView($dir){
        $path = DIR_ROOT."witcher/view/".$dir;
        require_once($path);
    }

    private function requirePlugins(){
        $files = scandir(DIR_APPLICATION."plugin");
        foreach ($files as $classes) {
            $a= explode('.', $classes);
            $end = end($a);
            if ($end === "php") {
                require_once $this->root()."witcher/app/plugin/".$classes;
            }
        }
    }
    public static function requirePlugin($path){
        require_once DIR_ROOT."witcher/app/plugin/".$path;
    }
    public function DownWithCookie($cookie,$cookies = array()){
        if (!empty($cookie)){
            setcookie($cookie,null,time() - 3600,'/');
        }
        elseif (count($cookies) > 0 AND empty($cookie)){
            foreach ($cookies as $cookie_name)
                setcookie($cookie_name,null,time() - 3600,'/');
        }
    }
    public function root(){
        return DIR_ROOT;
    }
    public function load(){
        $this->requireModel();
        $this->requireModelObjects();
        $this->requirePlugins();
        \witcher::requirePlugin("phpwebdriver/WebDriver.php");
        $this->requireModules();
        new \Core\session();
        $_GET = array_unique($_GET);
        $route = new \Core\route();

        $route->route_classic();
        if (!\Core\route::$checker){
            \Core\pager::go_page("404"); // 404 location which should be written based on routes.php
        }
    }
}