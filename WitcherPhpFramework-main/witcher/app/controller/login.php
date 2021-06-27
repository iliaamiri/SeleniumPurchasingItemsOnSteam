<?php
namespace Controller;

use Core\controller;
use Core\pager;
use Model\Message;
use Module\loginModule;

class login extends controller{

    public function start(){
        controller::$page_title = "sign in";
        $data_array = array();
        $login_module = new loginModule();

        $views_array = array("layouts/500.php");
        if ($login_module->is_login()){
            if (isset($_GET['logout'])){
                $login_module->logout();
                //pager::go_page('admin');
            }
            pager::go_page('admin');
        }else{
            $data_array = array(
                'auth_method' => $login_module->getAuth_method()
            );
            $views_array =  array("login-forms/login1.php");
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
                pager::go_page('admin');
                exit();
            }
        }
        parent::setData($data_array);
        parent::setViews($views_array);
        parent::Show();
    }
}