<?php

namespace Controller;

use Core\controller;
use Core\log;
use Core\pager;
use Core\route;
use Core\preg;
use Model\transaction;
use Model\transaction_form;
use Model\user;
use Module\bridgeValidation;
use Module\seleniumPayment\seleniumPaymentPanelModule;

class lab extends controller
{
    public function start()
    {
        $result =  "[{\"float\":\"0.31792801618576\",\"paint_seed\":\"493\",\"price\":\"\\n\\t\\t\\t\\t\\t\\t₹ 1,297.54\\t\\t\\t\\t\\t\"}]";
        var_dump( json_decode($result, true));

        die();

        $webdriver = new \WebDriver(SELENIUM_SERVER, SELENIUM_SERVER_PORT);
        $webdriver->connect("chrome");

        if (!\WebDriver::$server_connection) {
            die("Connection failed with servers");
        }

        $webdriver->get("http://steamsurferbot.ow/");


        $webdriver->windowMaximize();

        var_dump($webdriver->executeScript("
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

        return $webdriver;

    }
}