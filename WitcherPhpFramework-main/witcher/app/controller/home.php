<?php
namespace Controller;

use Core\controller;

class home extends controller {
    public function index(){
        parent::setViews(['home.php']);
        parent::Show();
    }
}
/**
 * nothing to show lately :)
 *
 */