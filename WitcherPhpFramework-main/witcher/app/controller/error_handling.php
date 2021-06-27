<?php
namespace Controller;

use Core\controller;

class error_handling extends controller {

    public function index($code){
        controller::$page_title = "WITCHER - ".$code;
        $views_array = ["layouts/errors/".$code.".php"];
        parent::setViews($views_array);
        parent::Show();
    }

    public function selenium(){
        controller::$page_title = "-";
        $data = [];
        if (isset($_GET['bank_error']) and isset($_GET['code']) and isset($_GET['u'])){
            $witcher = new \witcher();
            $messages = $witcher->getExceptionsMessages("selenium.php");
            $data['bg-color'] = "#d42a2a";
            switch($_GET['code']){
                case "001":
                    $data['msg'] = $messages['invoice_key_not_exists'];  
                    break;
                case "002":
                    $data['msg'] = $messages['transaction_failed'];   
                    break;
                case "003":
                    $data['msg'] = $messages['transaction_canceled_by_user']; 
                    break;
                case "004":
                    $data['bg-color'] = "#2ECC40";
                    $data['msg'] = $messages['transaction_fullySuccessed'];     
                    break;
                case "005":
                    $data['msg'] = $messages['payment_expired_message'];     
                    break;
                case "006":
                    $data['msg'] = $messages['payment_token_expired'];     
                    break;
                case "007":
                    $data['msg'] = $messages['transaction_totally_failed_try_again_later'];     
                    break;
                default:
                    $data['msg'] = "خطا در انجام پرداخت";         
                    break;    
            }
            $trans_info = new \modelObjects\transaction($_GET['u']);
            if (!$trans_info->exists()){
                header("location:".HTTPS_SERVER."/404");
                exit();
            }
            header("refresh:4;url=".$trans_info->return_url);
            parent::setData($data);
            parent::setViews(["bank_error.php"]);
            parent::Show();
            exit();
        }
    }
}