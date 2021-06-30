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

class seleniumSteamSurferPanelModule extends module
{

    public static $thread;

    public static $witcher;

    public static $webdriver;


    private static $once_called = false;

    public static $messages;

    function __construct($id = "", $initialize = true)
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

    /**
     * function connection() :
     *
     *      vasl shodan be selenium ta residan be dargahe shaparak ( witcher.com/invoice/check )
     * @return self::$webdriver (OBJECT)
     * @throws \Exception
     * */
    public function connection()
    {

        // agar be shaparak reside bashe  :
        if (self::$thread->webdriver_session != null) {
            self::$webdriver = unserialize(self::$thread->webdriver_session);
            if (property_exists(self::$webdriver->dismissAlert(), "error") AND self::$webdriver->dismissAlert()->error == "invalid session id"){
                $this->makeNewThread();
            }else{
                return self::$webdriver;
            }
        }
        elseif (self::$thread->webdriver_session == null){
            $this->makeNewThread();
        }

        return null;
    }

    public function makeNewThread()
    {
        self::$webdriver = new \WebDriver(SELENIUM_SERVER, SELENIUM_SERVER_PORT);
        self::$webdriver->connect("chrome");

        if (!\WebDriver::$server_connection) {
            die("Connection failed with servers");
        }

        self::$webdriver->get(self::$thread->link);

        self::$thread->update('status', '0');

        self::$webdriver->windowMaximize();
        self::$thread->update('webdriver_session', serialize(self::$webdriver));

        return self::$webdriver;
    }

    public function loginSteamAccount()
    {
        self::$webdriver->executeScript('document.getElementsByTagName("a")[0].click();', array());
        sleep(2);
        self::$webdriver->executeScript("document.getElementById('input_username').value = '" . self::$thread->account_name . "';", array());
        self::$webdriver->executeScript("document.getElementById('input_password').value = '" . self::$thread->password . "';", array());
        self::$webdriver->executeScript("document.getElementById('login_btn_signin').getElementsByTagName('Button')[0].click();", array());
    }

    public function submitSteamGuard(){
        try {

            $response = ['status' => 0, 'msg' => NULL];

            if (!isset($_POST['AuthCode'])){
                throw new \Exception('Auth Code is invalid');
            }

            $steamGuard = self::$webdriver->findElementBy(\LocatorStrategy::xpath, "//input[@id='authcode']");
var_dump($_POST);
            var_dump($steamGuard);
            die();
            if ($steamGuard != null) {
                self::$webdriver->executeScript("document.getElementById('authcode').value='". $_POST['AuthCode'] ."'", array());
                self::$webdriver->executeScript("
            var aTags = document.getElementsByTagName('div');
            var searchText = 'Submit';
            var found;

            for (var i = 0; i < aTags.length; i++) {
              if (aTags[i].textContent == searchText) {
                found = aTags[i];
                break;
              }
            }
            
            found.click();
            ", array());
            }

            $response['status'] = 1;
        }catch (\Exception $exception){
            $response['msg'] = $exception->getMessage();
        }
        return $response;
    }

    public function process(){

        var_dump(self::$webdriver->executeScript("
       function wait(ms) 
       {
            var d = new Date();
            var d2 = null;
            do {
                d2 = new Date();
            }
            while (d2 - d < ms);
        }
    
    
        const Witcher_Results = document.createElement(\"p\");

        const Paint_Seed = 0;

        const Float_Min = 0;
        const Float_Max = 0;

        const Witcher_Result_Collection = [];
   
    
        function CollectResults(float, paint_seed, price) {
            Witcher_Result_Collection.push( {\"float\": float, \"paint_seed\": paint_seed, \"price\": price} );
        }

        function RunIt_Witcher_TEST() {
            var elements = document.getElementById('searchResultsRows').children;
    
            for (var i = 0; i < elements.length; i++) {
                if (typeof elements[i].getElementsByClassName('csgofloat-itemfloat')[0] !== 'undefined') {
                    var floatText = elements[i].getElementsByClassName('csgofloat-itemfloat')[0].innerHTML;
                    var floatNumber = floatText.replace(/[^\d.-]/g, '');
                    console.log(floatNumber);
    
                    var paintSeedText = elements[i].getElementsByClassName('csgofloat-itemseed')[0].innerHTML;
                    var paintSeedNumber = paintSeedText.replace(/[^\d.-]/g, '');
                    console.log(paintSeedNumber);
    
                    var priceNumber = elements[i].getElementsByClassName('market_listing_price market_listing_price_with_fee')[0].innerHTML;
    
                    if (floatNumber > Float_Min && floatNumber < Float_Max) {
                        if (Paint_Seed != 0) {
                            if (paintSeedNumber == Paint_Seed) {
                                CollectResults(floatNumber, paintSeedNumber, priceNumber);
                                console.log(\"-----------------------------FOUND--------------------------------\");
                            }
                        } else {
                            CollectResults(floatNumber, paintSeedNumber, priceNumber);
                            console.log(\"-----------------------------FOUND--------------------------------\");
                        }
                    }
                }
    
                var instantButton = elements[i].getElementsByClassName('instantBuy');
            }
            document.getElementById('searchResults_btn_next').click();
            console.clear();
        }
    
        function SaveResultsInAnElement() {
            const Witcher_Node = document.createTextNode(JSON.stringify(Witcher_Result_Collection));
            Witcher_Results.appendChild(Witcher_Node);
            const element = document.getElementById(\"searchResultsRows\");
            element.appendChild(Witcher_Results);
    
            Witcher_Results.id = \"Witcher_Saved_Results\";
        }
        
        wait(4000);
        
        RunIt_Witcher_TEST();
        SaveResultsInAnElement();
        ", array()));
    }

}