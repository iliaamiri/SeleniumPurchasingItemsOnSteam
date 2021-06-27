<?php

namespace Controller;

use Core\controller;
use Core\preg;
use Module\Panel\partSetup;

class administrator_moduleAccess extends controller
{
    private static $request_data;

    private $request_method = "POST";

    function __construct()
    {
        if ($this->request_method == "POST") {
            self::$request_data = $_POST;
        } else {
            self::$request_data = $_GET;
        }
    }

    public function start()
    {
        $result = array(
            'PartName' => 'not given',
            'Subset_Action' => 'not given',
            'Agent' => 'unknown',
            'Json_data' => 'not given',
            'Status' => '0',
            'Acted_At' => time(),
            'Message' => ''
        );

        $preg = new preg();

        controller::$page_title = "Witcher v. " . WITCHER_VERSION;
        $views_array = ["invoice.php"];

        try {
            $login_module = new \Module\loginModule();
            if (!$login_module->is_login()) {
                throw new \Exception("auth failed");
            }

            self::$request_data = $_POST;

            $user_model = new \Model\user();
            $user_info = $user_model->user_get_certificate();
            $result['Agent'] = $user_info['Email'];

            if (!isset(self::$request_data['PartName'])) {
                throw new \Exception("PartName not given");
            }
            if (!isset(self::$request_data['Subset_Action'])) {
                throw new \Exception("Subset_Action not given");
            }
            if (!isset(self::$request_data['Agent'])) {
                throw new \Exception("Agent not given");
            }
            if (!isset(self::$request_data['Json_data'])) {
                throw new \Exception("Json_data not given");
            }

            $PartName = self::$request_data['PartName'];
            $Agent = self::$request_data['Agent'];
            $Subset_Action = self::$request_data['Subset_Action'];
            $Json_data = self::$request_data['Json_data'];

            $this->clearRequest_data();

            if (strlen($Subset_Action) > 50 OR !$preg->push($Subset_Action,'function_name')){
                throw new \Exception("Subset_Action is Invalid");
            }

            $this->initiate_basic_modules();

            $partSetup = new partSetup();
            $partSetup->public_part = $PartName;
            $partSetup->setup();

            $modules_initiation = $partSetup->initiate_modules();

            if ($partSetup->valid == false OR $modules_initiation == false) {
                throw new \Exception("PartName is invalid");
            }
            if ($result['Agent'] != $Agent) {
                throw new \Exception("Agent is invalid");
            }

            $result['PartName'] = $PartName;
            $result['Subset_Action'] = $Subset_Action;
            $result['Json_data'] = $Json_data;

            $result = array_merge($result,self::$request_data);

            $name = "\Module\Panel\Administrator\ " . $partSetup->public_part . "\ModuleControl";
            $name = str_replace(" ", "", $name);
            $ModuleControl = new $name;
            $ModuleControl->start($result);
            $result = $ModuleControl->get_result();
        } catch (\Exception $exception) {
            $result['Message'] = $exception->getMessage();
        }
        parent::setData($result);
        parent::setViews($views_array);
        parent::Show();
    }

    private function clearRequest_data(){
        unset(self::$request_data['PartName']);
        unset(self::$request_data['Subset_Action']);
        unset(self::$request_data['Agent']);
        unset(self::$request_data['Json_data']);
    }

    private function initiate_basic_modules(){
        $witcher = new \witcher();
        $witcher->requireModules('/panel/');
    }
}