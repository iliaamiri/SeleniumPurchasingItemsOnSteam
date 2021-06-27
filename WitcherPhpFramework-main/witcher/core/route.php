<?php

namespace Core;

class route extends configs
{
    private $redirect_url;
    private $controller = "welcome";
    public static $checker = false;

    function __construct()
    {
        new model();
        parent::set_config("routes.php");
        if (isset($_SERVER['REDIRECT_URL'])) {
            $this->redirect_url = $_SERVER['REDIRECT_URL'];
        } elseif (!isset($_SERVER['REDIRECT_URL'])) {
            $this->redirect_url = "/";
        }
    }

    private function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    public function route_classic()
    {
        $routes = parent::$configs; // gets routes form config file

        // finds the routes :
        foreach ($routes as $route_path => $controller) {
            // declares the name of controller
            $controller_name = (isset($controller[0])) ? $controller[0] : die("Set a Controller for your route");
            $method_name = (isset($controller[1])) ? $controller[1] : die("Set a Method for your route");
            // checks the match

            /*
             * Filtering number 1 :
             *       comparing slash differences between route and redirect url.
             * */
            $slashes_in_redirect_url = substr_count($this->redirect_url, '/');
            $slashes_in_route_url = substr_count($route_path, '/');
            $difference = abs($slashes_in_redirect_url - $slashes_in_route_url);

            if ($difference <= 1) {
                $parameters = array();
                if (preg_match('/{@(.*?)}/i',$route_path)){
                    $array_route_path = explode('/',$route_path);
                    foreach ($array_route_path as $array_key => $array_item){
                        if (preg_match('/{@(.*?)}/i',$array_item)){
                            $redirect_url_array = explode('/',$this->redirect_url);
                            if (isset($redirect_url_array[$array_key])){
                                $variable = $redirect_url_array[$array_key];
                                array_push($parameters,$variable);
                                $array_route_path[$array_key] = $variable;
                            }
                        }
                    }
                    $route_path = implode('/',$array_route_path);
                }

                if ($this->redirect_url === $route_path) {
                    $this->controller = $controller_name;
                    $query_string = (isset($controller[2])) ? $controller[2] : array();
                    $witcher = new \witcher();
                    if (!isset($controller[3])) {
                        $controller[3] = "";
                    }
                    $witcher->requireController($this->controller, $controller[3]);
                    if (count($query_string) > 0) {
                        foreach ($query_string as $item => $value) {
                            $_GET[$item] = $value;
                        }
                    }
                    $witcher->startController($this->controller,$method_name,$parameters, $controller[3]);
                    exit();
                }
            }
        }
    }
}