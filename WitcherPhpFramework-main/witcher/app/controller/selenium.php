<?php
namespace Controller;

use Core\controller;
use Module\seleniumPayment\seleniumSteamSurferPanelModule;

class selenium extends controller {
    public function initiate(){
        try {
            if (!isset($_POST['link'])){
                throw new \Exception(json_encode(['status' => false, 'msg' => 'link is Invalid']));
            }
            if (!isset($_POST['account_name'])){
                throw new \Exception(json_encode(['status' => false, 'msg' => 'account name is Invalid']));
            }
            if (!isset($_POST['password'])){
                throw new \Exception(json_encode(['status' => false, 'msg' => 'password is Invalid']));
            }
            if (!isset($_POST['maximum_purchases_of_founded_items'])){
                throw new \Exception(json_encode(['status' => false, 'msg' => 'maximum purchases of founded items is Invalid']));
            }
            if (!isset($_POST['float_min'])){
                throw new \Exception(json_encode(['status' => false, 'msg' => 'float min is Invalid']));
            }
            if (!isset($_POST['float_max'])){
                throw new \Exception(json_encode(['status' => false, 'msg' => 'float max is Invalid']));
            }
            if (!isset($_POST['paint_seed'])){
                throw new \Exception(json_encode(['status' => false, 'msg' => 'paint seed is Invalid']));
            }
            if (!isset($_POST['refresh_in'])){
                throw new \Exception(json_encode(['status' => false, 'msg' => 'refresh in is Invalid']));
            }
            $link = $_POST['link'];
            $account_name = $_POST['account_name'];
            $password = $_POST['password'];
            $maximum_purchases_of_founded_items = $_POST['maximum_purchases_of_founded_items'];
            $float_min = $_POST['float_min'];
            $float_max = $_POST['float_max'];
            $paint_seed = ($_POST['paint_seed'] == '') ? 0 : $_POST['paint_seed'];
            $refresh_in = ($_POST['refresh_in'] == '') ? 0 : $_POST['refresh_in'];

            $thread_id = rand(100000,999999);

            $threadsModel= new \Model\Threads();
            $status = $threadsModel->newThread($thread_id, $link, $account_name, $password, $float_min, $float_max, $paint_seed, $maximum_purchases_of_founded_items, $refresh_in);
            if (!$status){
                throw new \Exception(['status' => false, 'msg' => 'could not add to the database']);
            }

            $seleniumSteamSurferPanelModule = new seleniumSteamSurferPanelModule($thread_id);
            $seleniumSteamSurferPanelModule->connection();

            echo "Initiation was successful<br> Redirecting...";
            header("refresh:2;url=" . HTTP_SERVER . "/selenium/run/" . $thread_id);
            exit();
        }catch (\Exception $exception){
            parent::setData(json_decode($exception->getMessage(), true));
        }
        parent::setViews(['initiate.php']);
        parent::Show();
    }

    public function run($thread_id){
        $data = [];

        $seleniumSteamSurferPanelModule = new seleniumSteamSurferPanelModule($thread_id);
        $seleniumSteamSurferPanelModule->connection();

        $seleniumSteamSurferPanelModule->loginSteamAccount();

        $steamGuard = seleniumSteamSurferPanelModule::$webdriver->findElementBy(\LocatorStrategy::xpath, "//div[@class='login_modal loginAuthCodeModal']");

        $data['SteamGuardCheck'] = false;
        if ($steamGuard){

            $steamGuardInputDisplay = $steamGuard->getAttribute('style');

            if ($steamGuardInputDisplay != "display: none;"){
                $data['SteamGuardCheck'] = true;
            }
        }

        sleep(2);

        $data['LoginFailedCheck'] = false;
        $data['LoginFailedError'] = "";
        $login_error = seleniumSteamSurferPanelModule::$webdriver->findElementBy(\LocatorStrategy::xpath, "//div[@id='error_display']");
        if ($login_error){
            $login_errorDisplay = $login_error->getAttribute('style');

            if ($login_errorDisplay != "display: none;"){
                $data['LoginFailedCheck'] = true;
                $data['LoginFailedError'] = "Login Failed. Steam's Error Message: " . $login_error->getText();
            }
        }

        $data['ThreadInfo'] = seleniumSteamSurferPanelModule::$thread;

        parent::setData($data);
        parent::setViews(['run.php']);
        parent::Show();
    }

    public function cancel($id){

    }
}