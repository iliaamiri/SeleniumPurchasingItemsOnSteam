<?php
namespace modelObjects;

class steamAuthCreds extends \Model\SteamAuthCreds {
    private $exist = true;

    public $id;
    public $account_name;
    public $password;
    public $default_status;


    function __construct($invoice_key)
    {
        parent::__construct();

        $row = $this->findRowById($invoice_key);
        if (!$row){
            $this->exist = false;
        }else{
            $this->id = $row['id'];
            $this->account_name= $row['account_name'];
            $this->password = $row['password'];
            $this->default_status = $row['default_status'];
        }
    }

    public function exists(){
        return $this->exist;
    }
}