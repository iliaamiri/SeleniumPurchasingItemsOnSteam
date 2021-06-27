<?php
namespace Core;

use Model\user;
use Module\loginModule;

class module{
    protected static $db;
    public static $token = false;

    public static $user_info;

    function __construct()
    {
        self::$db = new database();
        if (self::$token){
            if (!tokenCSRF::is_set()){
                new tokenCSRF();
            }
        }
    }

    public static function auth_init(){
        $user = new \modelObjects\user();
        self::$user_info = $user->user_get_certificate();
    }
}