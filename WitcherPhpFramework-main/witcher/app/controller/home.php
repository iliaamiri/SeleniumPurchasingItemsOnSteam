<?php
namespace Controller;

use Core\controller;
use modelObjects\steamAuthCreds;

class home extends controller {
    public function index(){
        $streamAuthCreds = new \Model\SteamAuthCreds();
        $defaultAuthCreds = $streamAuthCreds->findRowByDefault();

        $data = [
            'DefaultAuthCreds' => $defaultAuthCreds,
        ];

        parent::setData($data);
        parent::setViews(['home.php']);
        parent::Show();
    }
}