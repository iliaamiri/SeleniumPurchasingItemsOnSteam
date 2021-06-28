<?php

namespace Module;

use Core\module;
use modelObjects\transaction;
use modelObjects\transaction_form;
use Module\Bank\bankController;
use Module\seleniumPayment\seleniumPaymentPanelModule;

class seleniumStandardGateway extends module {

    private static $webdriver;
    private static $messages;

    private static $trans_info;
    private static $trans_form;

    public $data;
    public $view;

    function __construct()
    {
        parent::$token = false;
        parent::__construct();
    }

    public function Run($invoice_key){


        // gereftane etelaAte gateway az tarighe api_key va gharar dadanesh dar $gateway
        $seleniumPaymentPanelModule = new seleniumPaymentPanelModule($invoice_key);
        $gateway = seleniumPaymentPanelModule::$gateway;

        // gereftane yek class az etelaAte transaction va gharar dadanesh dar moteghayere $trans_info
        self::$trans_info = seleniumPaymentPanelModule::$trans_info;
        self::$trans_form = seleniumPaymentPanelModule::$trans_form;

        // bar gozaari etelaate mohemi az ghabile api_key, amount, return_url dar session ke witcher betone dar file haye dige ham beheshooon dastresi dashte bashe
        $_SESSION['api_key'] = self::$trans_info->api_key;
        $_SESSION['amount'] = self::$trans_info->amount;
        $_SESSION['return_url'] = self::$trans_info->return_url;

        // update kardane ip e user dar database
        self::$trans_info->update('last_user_ip',$_SERVER['REMOTE_ADDR']);

        // check kardane status e live mahze etela az vaziate pardakht ke age movafagh bood redirect kone
        // be return_url va age hanooz ham movafagh nabood be edame kar mipardaze ( kari nemikone )
        self::$webdriver = $seleniumPaymentPanelModule->connection();
        $seleniumPaymentPanelModule->statusAssess();

        // check kardane tedaad talash haye user baraye submit kardane forme pardakht
        if (self::$trans_form->attempt_num_submit > $gateway->submit_attempt_limit){
            session_destroy();
            self::$trans_form->update('last_error_user_saw',self::$messages['transaction_failed']." at line".__LINE__." at module-seleniumStandardGateway");
            self::$webdriver = unserialize(self::$trans_info->WAITASEC);
            self::$webdriver->close();
            header("location:".HTTPS_SERVER."/TransactionFailed?u=".self::$trans_info->invoice_key);
            exit();
        }

        // esme bank e morede nazar ke az database khoonde shode
        $bank_ = $gateway->bank_name;

        $time_remaining = 0;

        // meghdar expire time baraye har bank
        if (!isset($_SESSION['time_remaining'])){

            /*
            switch ($bank_){
                case "Mellat":
                    $time_remaining = 900;
                    break;
                case "Parsian":
                    $time_remaining = 15 * 60;
                    break;
                case "Saderat":
                    $time_remaining = 600;
                    break;
                case "Pasargad":
                    $time_remaining = 600;
                    break;
                case "Irankish":
                    $time_remaining = 480;
                    break;
                case "Saman":
                    $time_remaining = 480;
                    break;
                default:
                    $time_remaining = 33 * 60;
                    break;
            }
            */

            // statically setting time_remaining
            $time_remaining = 600;

            $_SESSION['time_remaining'] = $time_remaining;
        }elseif (isset($_SESSION['time_remaining'])){
            $time_remaining = $_SESSION['time_remaining'];
        }

        $bank_module = new bankController($bank_);
        $bank_module->form_run();

        // etelaate morede niaz ke hamishe sabet and
        $this->data = ['invoice_key' => $invoice_key,'time_remaining' => ($time_remaining + self::$trans_info->creation_time) - time() ,'return_url' => self::$trans_info->return_url,'trans_form_object' => json_decode(json_encode(self::$trans_form,true),true),'trans_info_object' => json_decode(json_encode(self::$trans_info,true),true),'pazirande' => $gateway->descriptions];

        // viewi ke hamishe sabete
        $this->view = ['payment_with_selenium.php'];
    }
}