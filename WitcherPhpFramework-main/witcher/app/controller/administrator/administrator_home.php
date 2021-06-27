<?php

namespace Controller;

use Core\controller;
use Core\pager;
use Model\Message;
use modelObjects\user;
use Module\loginModule;
use Module\Panel\partSetup;

class administrator_home extends controller
{
    private static $request_data;

    public function start()
    {
        $witcher = new \witcher();
        $witcher->requireModules('/panel/');

        $login_module = new \Module\loginModule();
        if (!$login_module->is_login()) {
            pager::go_page('login');
        }

        $user_model = new \Model\user();

        $user_info = $user_model->user_get_certificate();
        $user_info = json_decode(json_encode(new user($user_info['Email'])),true);

        self::$request_data = $_POST;

        $partSetup_module = new partSetup();
        $partSetup_module->setup();

        controller::$page_title = "Witcher v. ".WITCHER_VERSION;
        $views_array = [$partSetup_module->getBase_view_path() . "/dashboard.php"];
        $data = ['user_info' => $user_info,'admin_root_path' => 'hello/administrator'];

        parent::setData($data);
        parent::setViews($views_array);
        parent::Show();
    }

    public function reportSpecial(){
        $witcher = new \witcher();
        $witcher->requireModules('/panel/');

        $login_module = new \Module\loginModule();
        $login_module->use_api_key_for_login = true;

        if (!$login_module->is_login()) {
            pager::go_page('reportLogin');
        }

        $user_model = new \Model\user();

        $user_info = $user_model->user_get_certificate();
        $user_info = json_decode(json_encode(new user($user_info['Email'])),true);

        self::$request_data = $_POST;

        $partSetup_module = new partSetup();
        $partSetup_module->setup();

        controller::$page_title = "Witcher v. ".WITCHER_VERSION;
        $views_array = [$partSetup_module->getBase_view_path() . "/dashboard.php"];
        $data = ['user_info' => $user_info,'admin_root_path' => 'report'];

        parent::setData($data);
        parent::setViews($views_array);
        parent::Show();
    }

    public function home(){
        controller::$page_title = "Witcher";
        $data_array = array();
        $login_module = new loginModule();
        $login_module->use_api_key_for_login = true;

        $views_array = array("layouts/500.php");
        if ($login_module->is_login()){
            if (isset($_GET['logout'])){
                $login_module->logout();
            }
            pager::go_page('report');
        }else{
            $data_array = array(
                'auth_method' => $login_module->getAuth_method()
            );
            $views_array =  array("home.php");
            $req_method = $_SERVER['REQUEST_METHOD'];
            if ($req_method == "POST") {
                loginModule::$as = "member";
                $login_stat = $login_module->login();
                if (!$login_stat['status']){
                    Message::msg_box_session_prepare($login_stat['message'],"danger");
                    pager::refresh();
                    exit();
                }
                $login_module->after_login_changes();
                pager::go_page('report');
                exit();
            }
        }
        parent::setData($data_array);
        parent::setViews($views_array);
        parent::Show();
    }
}