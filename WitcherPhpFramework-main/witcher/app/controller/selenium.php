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
            $link = $_POST['link'];
            $account_name = $_POST['account_name'];
            $password = $_POST['password'];
            $maximum_purchases_of_founded_items = $_POST['maximum_purchases_of_founded_items'];
            $float_min = $_POST['float_min'];
            $float_max = $_POST['float_max'];
            $paint_seed = $_POST['paint_seed'];

        }catch (\Exception $exception){

        }
    }

    public function run($id){

    }

    public function cancel($id){

    }
}