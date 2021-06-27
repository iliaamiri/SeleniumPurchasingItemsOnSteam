<?php

namespace Controller;

use Core\controller;
use Module\seleniumPayment\seleniumPaymentPanelModule;

class invoiceFormRequest extends controller
{
    private $module;
    private $response;
    function __construct()
    {
        $witcher = new \witcher();
        $witcher->requireModules();
        $witcher->requireModules('/seleniumPayment/');
        $witcher->requireModules('/bank_gateway/');
        if (!isset($_POST['invoice_key'])){
            return false;
        }
        $this->module = new seleniumPaymentPanelModule($_POST['invoice_key']);
        $this->module->connection();

        $this->response = ['status' => 0];
        $this->response['WitcherMessage'] = "";
        $this->response['WitcherMessage_Green'] = false;
    }

    public function response_the_result(){
        if (controller::$WitcherMessage != null) {
            $this->response['WitcherMessage'] = controller::$WitcherMessage;
        }
        echo json_encode($this->response);
    }

    public function submit()
    {
        $this->response = $this->module->submitPayButton();
        $this->response_the_result();
    }

    public function resetCaptcha(){
        $this->response = $this->module->resetCaptcha();
        $this->response_the_result();
    }

    public function otp_request(){
        $this->response = $this->module->otpRequest();
        $this->response_the_result();
    }
}