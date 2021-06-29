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
        $preg = new preg();
        var_dump($preg->push("0.0005",'double'));
    }
}