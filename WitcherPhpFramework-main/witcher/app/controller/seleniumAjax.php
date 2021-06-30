<?php
namespace Controller;

use Core\controller;
use Module\seleniumPayment\seleniumSteamSurferPanelModule;

class seleniumAjax extends controller {

    private $module;
    private $response;

    function __construct()
    {
        if (!isset($_POST['thread_id'])){
            return false;
        }
        $this->module = new seleniumSteamSurferPanelModule($_POST['thread_id']);
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

    public function submitSteamGuard()
    {
        $this->response = $this->module->submitSteamGuard();
        $this->response_the_result();
    }

    public function process(){
        $this->response = $this->module->process();
        $this->response_the_result();
    }
}