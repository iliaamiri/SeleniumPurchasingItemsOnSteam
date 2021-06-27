<?php
namespace Controller;

use Core\controller;
use Module\seleniumPayment\seleniumPaymentPanelModule;

class invoice extends controller {
    function __construct()
    {
        $witcher = new \witcher();
        $witcher->requireModules('/seleniumPayment/');
    }

    public function start(){}

    public function request(){
        try{
            $seleniumPaymentPanelModule = new seleniumPaymentPanelModule("",false);
            $msg = $seleniumPaymentPanelModule->makeRequest();
            parent::setData($msg);
        }catch(\Exception $e){
            parent::setData(json_decode($e->getMessage()));
        }
        parent::setViews(['invoice.php']);
        parent::Show();
    }

    public function check($invoice_key = ""){
        try{
            $seleniumPaymentPanelModule = new seleniumPaymentPanelModule("",false);
            $msg = $seleniumPaymentPanelModule->invoiceCheck($invoice_key);
            parent::setData($msg);
        }catch(\Exception $e){
            parent::setData(json_decode($e->getMessage()));
        }
        parent::setViews(['invoice.php']);
        parent::Show();
    }
}