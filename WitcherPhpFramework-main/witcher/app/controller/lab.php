<?php
namespace Controller;

use Core\controller;
use Core\log;
use Core\pager;
use Core\route;
use Core\preg;
use Model\transaction;
use Model\transaction_form;
use Model\user;
use Module\bridgeValidation;
use Module\seleniumPayment\seleniumPaymentPanelModule;

class lab extends controller {
    public function start(){
        $a = '/a/a/{@9}';
        $url = '/a/a/{@dd}/{@asdfsd}';
        var_dump($this->get_string_between($url,"{@","}"));
        // peida kardane moteghayer :
        preg_match('/{@(.*?)}/i',$a,$matches);
        var_dump($matches);
       // $url_array = explode("/",$url);

        echo "<br>";

        //peida kardane mogheiiate moteghayer dar string
        var_dump(strpos($a,'{@'));
        echo "<Br>";
        var_dump(print_r($matches));
    }

    private function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
}