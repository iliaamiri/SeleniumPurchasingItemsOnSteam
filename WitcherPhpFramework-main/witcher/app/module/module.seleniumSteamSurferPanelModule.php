<?php
namespace Module\seleniumPayment;

use Core\module;
use modelObjects\gateway;
use modelObjects\gatewayTypes;
use modelObjects\threads;
use modelObjects\transaction;
use modelObjects\transaction_form;
use Module\bridgeValidation;
use Module\cardnumberDiagnosis;
use Module\gatewaySuitcaseAssignment;
use Module\getGatewayFromTransaction;

class seleniumSteamSurferPanelModule extends module {

    public static $thread;

    public static $witcher;

    public static $webdriver;


    private static $once_called = false;

    public static $messages;

    function __construct($id = "",$initialize = true)
    {
        parent::$token = false;
        parent::__construct();
        self::$witcher = new \witcher();
        self::$messages = array_merge(self::$witcher->getExceptionsMessages("selenium.php"));
        if (!self::$once_called and $initialize == true) {
            self::$thread = new threads($id);

            self::$once_called = true;
        }
    }

    public function makeNewThread(){
        self::$webdriver = new \WebDriver(SELENIUM_SERVER, SELENIUM_SERVER_PORT);
        self::$webdriver->connect("chrome");

        if (!\WebDriver::$server_connection){
            die("Connection failed with servers");
        }

        self::$webdriver->get(self::$thread->link);

        self::$thread->update('status','0');

        self::$webdriver->windowMaximize();
        self::$thread->update('webdriver_session', serialize(self::$webdriver));

        return self::$webdriver;
    }


    /**
     * function invoiceCheck($invoice_key) :
     *
     * check kardane invoice ( witcher.com/invoice/check )
     *
     * @param $invoice_key
     * @return
     * @throws \Exception
     */
    public function invoiceCheck($invoice_key){
        if (!isset($_POST['api_key'])){
            throw new \Exception(json_encode(['status' => 0,'errorCode' => '101','errorDescription' => self::$messages['ErrorCode_101']]));
        }
        if ($invoice_key == "" or $invoice_key == null){
            throw new \Exception(json_encode(['status' => 0,'errorCode' => '200','errorDescription' => self::$messages['ErrorCode_200']]));
        }
        $api_key = $_POST['api_key'];

        $trans_info = new transaction($invoice_key);
        if (!$trans_info->exists()){
            throw new \Exception(json_encode(['status' => 0,'errorCode' => '200','errorDescription' => self::$messages['ErrorCode_200']]));
        }

        $getGatewayFromTransaction = new getGatewayFromTransaction($trans_info);
        $gateway = $getGatewayFromTransaction->getGateway();

        if(!$gateway->valid){
            throw new \Exception(json_encode(['status' => 0,'errorCode' => '101','errorDescription' => self::$messages['ErrorCode_101']]));
        }


        $bridgeValidation_module = new bridgeValidation($trans_info->bridged_id,$trans_info->selenium_server_id,$gateway,$trans_info->amount);
        $bridgeValidation_module->Validate();
        $gateway = $bridgeValidation_module->getGateway();

        self::$gateway = $gateway;

        $invoiceCheck_module = new invoiceCheck($invoice_key);

        $gatewayType = new gatewayTypes($gateway->type);

        $method_name = $gatewayType->method_invoiceCheck;

        return $invoiceCheck_module->$method_name();
    }

    /**
     * function connection() :
     *
     *      vasl shodan be selenium ta residan be dargahe shaparak ( witcher.com/invoice/check )
     * @return self::$webdriver (OBJECT)
     * @throws \Exception
     * */
    public function connection(){
        // agar be shaparak reside bashe  :
        if (self::$trans_info->WAITASEC != null)
        {
            self::$webdriver = unserialize(self::$trans_info->WAITASEC);
            return self::$webdriver;
        }
        // agar avalin talash baraye residan be shaparak bashe :
        elseif(self::$trans_info->WAITASEC == null)
        {
            // be module e connection vasl mishe :
            $connection_module = new connection(self::$trans_info->invoice_key);

            // esme function ro az $gatewayTypes ( table e gateway_types ) migire :
            $method_name = self::$gatewayTypes->method_connection;

            // connection ro bargharar mikone :
            self::$webdriver = $connection_module->$method_name();
            return self::$webdriver;
        }
        return null;
    }

    /**
     * function submitPayButton() :
     *
     *      submit kardane form e dargah
     * @return
     * @throws
     * */
    public function submitPayButton(){
        if (!isset($_POST['card_number'])) {
            throw new \Exception(self::$messages['didnt_post_card_number']);
        }
        $cardnumberDiagnosisModule = new cardnumberDiagnosis(self::$gateway->transaction_amountLimit_byCardNumber,$_POST['card_number'],self::$trans_info->amount);
        if ($cardnumberDiagnosisModule->is_blocked()){
            throw new \Exception(self::$messages['cardNumber_is_blocked']);
        }
        if ($cardnumberDiagnosisModule->is_limited()){
            throw new \Exception(self::$messages['cardNumber_is_limited']);
        }

        // module e submit ro miare :
        $submit_module = new submitPayButton(self::$trans_info->invoice_key);

        // esme function e submit ro az gateway_types (database) miporse :
        $method_name = self::$gatewayTypes->method_submitPayButton;

        // submit mikone:
        return $submit_module->$method_name();
    }


    /**
     * function statusAssess() :
     *
     *      vaziate pardkahto check mikone va dar soorate movafagh boodan kaarhaye lazem ro mikone va
     *      dar soorate ( hanooz pardakht nashodan ) kaari nemikone va rad mishe
     * @return
     * @throws \Exception
     * */
    public function statusAssess(){
        // module e statusAssess ro miare:
        $statusAssess_module = new statusAssess(self::$trans_info->invoice_key);

        // esme function e statusAssess ro az gateway_type ( database) miporse :
        $method_name = self::$gatewayTypes->method_statusAssess;

        // statusAssess marboot be noE pardakht ro anjam mide
        return $statusAssess_module->$method_name();
    }

    /**
     * function cancelPayment() :
     *
     *      pardakhto cancel mikone
     * @return
     * @throws \Exception
     * */
    public function cancelPayment(){
        // module e cancelPayment ro miare:
        $cancel_module = new cancelPayment(self::$trans_info->invoice_key);

        // esme function e cancelPayment ro az gateway_type ( database) miporse :
        $method_name = self::$gatewayTypes->method_cancelPayment;

        // pardakhto cancel mikone
        return $cancel_module->$method_name();
    }

    /**
     * function otpRequest() :
     *
     *      otp request mide
     *      baraye ezafe kardane dargahe faghat. masalan age Saderato nadarim bayad inja ezafe konim otp request esho.
     * @return
     * @throws \Exception
     * */
    public function otpRequest(){
        $otp_request = new otpRequest(self::$trans_info->invoice_key);

        $method_name = self::$gatewayTypes->method_otpRequest;

        return $otp_request->$method_name();
    }

    /**
     * function resetCaptcha() :
     *
     *      otp request mide
     *      baraye ezafe kardane resetCaptcha faghat. masalan age Saderato nadarim bayad inja ezafe konim resetCaptcha esho.
     * @return
     * @throws \Exception
     * */
    public function resetCaptcha(){
        $reset_captcha = new resetCaptcha(self::$trans_info->invoice_key);

        $method_name = self::$gatewayTypes->method_resetCaptcha;

        return $reset_captcha->$method_name();
    }

}