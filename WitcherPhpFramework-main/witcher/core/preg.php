<?php
namespace Core;

class preg extends configs {

    private $preg_types;
    public $return_after = true;
    public static $preg_status = true;
    function __construct()
    {
        parent::set_config("preg_types.php");
        $this->preg_types = parent::$configs;
    }

    public function push($value,$preg_type){
        if (!isset($this->preg_types[$preg_type])){
            self::$preg_status = false;
            if ($this->return_after){
                return false;
            }
        }
        if (preg_match($this->preg_types[$preg_type],$value)){
            self::$preg_status = true;
            if ($this->return_after) {
                return true;
            }
        }else{
            self::$preg_status = false;
            if ($this->return_after) {
                return false;
            }
        }
    }
    public function push_email($value){
        if (filter_var($value, FILTER_VALIDATE_EMAIL)){
            if (preg_match('/^[a-zA-Z0-9_.-@+,]*$/i',$value)){
                self::$preg_status = true;
                if ($this->return_after) {
                    return true;
                }
            }else{
                self::$preg_status = false;
                if ($this->return_after) {
                    return false;
                }
            }
        }else{
            self::$preg_status = false;
            if ($this->return_after) {
                return false;
            }
        }
    }
    public function push_custom($pattern,$value){
        if (preg_match($pattern,$value)){
            self::$preg_status = true;
            if ($this->return_after) {
                return true;
            }
        }else{
            self::$preg_status = false;
            if ($this->return_after) {
                return false;
            }
        }
    }
    public function push_url($value){
        if (preg_match('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i',strtolower($value))){
            self::$preg_status = true;
            if ($this->return_after) {
                return true;
            }
        }else{
            self::$preg_status = false;
            if ($this->return_after) {
                return false;
            }
        }
    }
}