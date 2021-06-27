<?php
namespace Controller;

use Core\controller;
use Core\pager;
use Model\SteamAuthCreds;

class authCreds extends controller {
    public function index(){
        $steamAuthCredsModel = new \Model\SteamAuthCreds();
        $AllAuthCreds = $steamAuthCredsModel->All();

        parent::setData([
            'AuthCreds' => $AllAuthCreds
        ]);
        parent::setViews(['authCreds.php']);
        parent::Show();
    }

    public function add(){
        $account_name = $_POST['account_name'];
        $password = $_POST['password'];
        $steamAuthCredsModel = new \Model\SteamAuthCreds();
        echo json_encode(['status' => $steamAuthCredsModel->newCreds($account_name, $password)]);
    }

    public function makeDefault($id){
        $steamAuthCredsModel = new SteamAuthCreds();
        $steamAuthCredsModel->makeDefault($id);
        pager::go_page('','/auth_credentials/manage#done');
    }

    public function update(){
        $id = $_POST['id'];
        $account_name = $_POST['account_name'];
        $password = $_POST['password'];
        $steamAuthCredsModel = new SteamAuthCreds();
        echo json_encode(['status' => $steamAuthCredsModel->updateById($id, $account_name, $password)]);
    }

    public function delete($id){
        $steamAuthCredsModel = new \Model\SteamAuthCreds();
        $steamAuthCredsModel->deleteById($id);
        pager::go_page('','/auth_credentials/manage#done');
    }
}
/**
 * nothing to show lately :)
 *
 */