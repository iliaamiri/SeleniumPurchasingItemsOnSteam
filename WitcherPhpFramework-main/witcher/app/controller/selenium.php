<?php
namespace Controller;

use Core\controller;

class selenium extends controller {
    public function initiate(){
        try {
            if (!isset($_POST['link'])){
                throw new \Exception(['status' => false, 'msg' => 'link is Invalid']);
            }
            if (!isset($_POST['account_name'])){
                throw new \Exception(['status' => false, 'msg' => 'account name is Invalid']);
            }
            if (!isset($_POST['password'])){
                throw new \Exception(['status' => false, 'msg' => 'password is Invalid']);
            }
            if (!isset($_POST['maximum_purchases_of_founded_items'])){
                throw new \Exception(['status' => false, 'msg' => 'maximum purchases of founded items is Invalid']);
            }
            if (!isset($_POST['float_min'])){
                throw new \Exception(['status' => false, 'msg' => 'float min is Invalid']);
            }
            if (!isset($_POST['float_max'])){
                throw new \Exception(['status' => false, 'msg' => 'float max is Invalid']);
            }
            if (!isset($_POST['paint_seed'])){
                throw new \Exception(['status' => false, 'msg' => 'paint seed is Invalid']);
            }
            if (!isset($_POST['refresh_in'])){
                throw new \Exception(['status' => false, 'msg' => 'refresh in is Invalid']);
            }
            $link = $_POST['link'];
            $account_name = $_POST['account_name'];
            $password = $_POST['password'];
            $maximum_purchases_of_founded_items = $_POST['maximum_purchases_of_founded_items'];
            $float_min = $_POST['float_min'];
            $float_max = $_POST['float_max'];
            $paint_seed = $_POST['paint_seed'];
            $refresh_in = $_POST['refresh_in'];

            $threadsModel= new \Model\Threads();
            $status = $threadsModel->newThread($link, $account_name, $password, $float_min, $float_max, $paint_seed, $maximum_purchases_of_founded_items, $refresh_in);



            parent::setData(['status' => $status]);
        }catch (\Exception $exception){
            parent::setData(json_decode($exception->getMessage()));
        }
        parent::setViews(['initiate.php']);
        parent::Show();
    }

    public function run($id){

    }

    public function cancel($id){

    }
}