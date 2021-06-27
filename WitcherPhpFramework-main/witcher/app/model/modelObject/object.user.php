<?php
namespace modelObjects;

class user extends \Model\user {
    public $valid = false;

    public $id;
    public $user_Id;
    public $username;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $full_name;
    public $session_id;
    public $key_verify;
    public $key_try;
    public $verify_code;
    public $last_login;
    public $last_ip;
    public $last_browser;
    public $profile_image;
    public $log;
    public $user_second_id;

    public $role_id;
    public $login;

    public $read_invoices;
    public $write_invoices;
    public $read_gateway;
    public $write_gateway;
    public $read_gateway_types;
    public $write_gateway_types;
    public $read_bridge;
    public $write_bridge;
    public $read_user_tbl;
    public $write_user_tbl;
    public $read_witcher_routes;
    public $write_witcher_routes;
    public $read_main_database;
    public $write_main_database;
    public $read_witcher_bank;
    public $write_witcher_bank;

    public $ban_estimated_time;

    public $parts;

    function __construct($email = "")
    {
        parent::__construct();

        $row = $this->getUserInfoBy('Email',$email);

        if (!$row){
            $this->valid = false;
        }else{
            $row = $row[0];
            $this->id = $row['id'];
            $this->user_Id = $row['user_Id'];
            $this->username = $row['Username'];
            $this->email = $row['Email'];
            $this->password = $row['Password'];
            $this->first_name = $row['First_Name'];
            $this->last_name = $row['Last_Name'];
            $this->full_name = $row['First_Name'];
            $this->session_id = $row['Session_Id'];
            $this->key_verify = $row['Key_verify'];
            $this->key_try = $row['Key_Try'];
            $this->verify_code = $row['Verify_Code'];
            $this->last_login = $row['Last_Login'];
            $this->last_ip = $row['Last_Ip'];
            $this->last_browser = $row['Last_Browser'];
            $this->profile_image = $row['Profile_Image'];
            $this->log = $row['Log'];
            $this->user_second_id = $row['user_second_id'];

            $this->role_id = $row['Role_Id'];
            $this->login = $row['Login'];

            $this->read_invoices = $row['Read_Invoices'];
            $this->write_invoices = $row['Write_Invoices'];
            $this->read_gateway = $row['Read_Gateway'];
            $this->write_gateway = $row['Write_Gateway'];
            $this->read_gateway_types = $row['Read_Gateway_Types'];
            $this->write_gateway_types = $row['Write_Gateway_Types'];
            $this->read_bridge = $row['Read_Bridge'];
            $this->write_bridge = $row['Write_Bridge'];
            $this->read_user_tbl = $row['Read_user_tbl'];
            $this->write_user_tbl = $row['Write_user_tbl'];
            $this->read_witcher_routes = $row['Read_Witcher_routes'];
            $this->write_witcher_routes = $row['Write_Witcher_routes'];
            $this->read_main_database = $row['Read_main_database'];
            $this->write_main_database = $row['Write_main_database'];
            $this->read_witcher_bank = $row['Read_witcher_bank'];
            $this->write_witcher_bank = $row['Write_witcher_bank'];

            $this->ban_estimated_time = $row['Ban_Estimated_Time'];

            $this->parts = $row['parts'];

            $this->valid = true;
        }
    }

    public function getAll()
    {
        $all = parent::getAll();
        $result = array();
        foreach ($all as $value => $user){
            $result[$value] = new user($user['Email']);
        }
        return $result;
    }

    public function user_get_certificate(){
        $user = parent::user_get_certificate();
        return new user($user['Email']);
    }

    public function user_get_permission($check_certificate = 1, $by_email = "", $by_custom = ""){
        $user = parent::user_get_permission();
        return new user($user['Email']);
    }

}