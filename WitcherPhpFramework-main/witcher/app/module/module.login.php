<?php

namespace Module;

use Core\module;
use Core\preg;
use Core\tokenCSRF;
use Model\user;
use modelObjects\gateway;

class loginModule extends module
{
    private $auth_method = "POST";
    private $use_email_for_login = false;
    public $use_api_key_for_login = false;
    private $request_array;
    private $login;
    private $password;
    public static $as = "member";

    private $key = "N&0ISBESSDazASDFJU&JNKJ00dy0023r6l9XBcCG0CUHBNNGuOn7VHXaIrSagkU7mmhowqS9U7i7gm7qWx1DhtfgImxtYhY5iIsWhrKEwUg5BI4TSnS9zwuY47cNqjf2UgUzefmhrL9VvcypKPkMXV0Gae0Ee0oV0Nl6G8R6bqYfwB5gUCD6zYzHAArwxcEWHD4EqBUwPk1POGzI9UzpUuVxzNxxfwtbI8dI1sf";

    function __construct()
    {
        parent::$token = true;
        parent::__construct();
        switch ($this->auth_method) {
            case "POST":
                $this->request_array = $_POST;
                break;
            case "GET":
                $this->request_array = $_GET;
                break;
        }
    }

    public function getAuth_method()
    {
        return $this->auth_method;
    }

    public function login()
    {
        $witcher = new \witcher();
        $messages = $witcher->getExceptionsMessages("authentication.php")['login'];
        try {
            if (parent::$token) {
                if (!isset($this->request_array['token'])) {
                    throw new \Exception($messages['token_isnot_set']);
                }
                if (tokenCSRF::get_token() != $this->request_array['token']) {
                    throw new \Exception($messages['token_isnot_set']);
                }
            }
            if (!$this->set_login()['status']) {
                if ($this->set_login()['cause'] == "notset") {
                    if ($this->use_api_key_for_login){
                        throw new \Exception($messages['api_not_found']);
                    }
                    throw new \Exception($messages['username_not_found_in_request']);
                } elseif ($this->set_login()['cause'] == "invalid") {
                    if ($this->use_api_key_for_login){
                        throw new \Exception($messages['api_not_found']);
                    }
                    throw new \Exception($messages['username_preg_failed']);
                }
            }
            if (!$this->authenticate_login()) {
                if ($this->use_api_key_for_login){
                    throw new \Exception($messages['api_not_found']);
                }
                throw new \Exception($messages['username_not_found_in_tables']);
            }
            if (!$this->set_password()['status']) {
                if ($this->set_password()['cause'] == "notset") {
                    throw new \Exception($messages['password_not_found_in_request']);
                } elseif ($this->set_password()['cause'] == "invalid") {
                    throw new \Exception($messages['password_preg_failed']);
                }
            }
            if (!$this->true_password()) {
                throw new \Exception($messages['password_not_match']);
            }
            if (!$this->can_login()) {
                throw new \Exception($messages['cannot_login']);
            }
            return ['status' => true];
        } catch (\Exception $e) {
            if (parent::$token) {
                new tokenCSRF();
            }
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function after_login_changes()
    {
        if ($this->use_api_key_for_login) {
            $this->password = $this->login;
        }

        $duplicated_login = false;
        $user_info = $this->authenticate_login();
        if ($user_info['Session_Id'] != null OR $user_info['Session_Id'] != "") {
            $duplicated_login = true;
            $certificate_code = $user_info['Session_Id'];
        } else {
            $certificate_code = md5(sha1(md5(sha1(md5(sha1(md5(rand(1000, 9999))))))));
        }
        $WITCHER_AUTH = [
            'Login' => $this->login,
            'Password' => md5(sha1(md5($this->password))),
            'Certificate_Code' => $certificate_code,
            'Duplicated_Login' => $duplicated_login
        ];
        $user = new user();
        $Last_ip = $_SERVER['REMOTE_ADDR'];
        $Last_login = date("Y/m/d h:i:sa");

        $this->CreateSecureLoginCookie($WITCHER_AUTH);

        $statement = "Session_Id = '" . $WITCHER_AUTH['Certificate_Code'] . "' ,Last_Ip = '" . $Last_ip . "' , Last_Browser = 'unknown' , Log = 1 , Last_Login = '" . $Last_login . "' WHERE Username= '" . $this->login . "' OR Email = '" . $this->login . "'";

        if ($this->use_api_key_for_login) {
            $statement = "Session_Id = '" . $WITCHER_AUTH['Certificate_Code'] . "' ,Last_Ip = '" . $Last_ip . "' , Last_Browser = 'unknown' , Log = 1 , Last_Login = '" . $Last_login . "' WHERE Email = 'witcher@witcher.ow'";
        }

        return $user->UpdateUserTblCustom($statement);
    }

    public function logout()
    {
        $user = new user();
        $user_info = $user->user_get_certificate();
        setcookie('WITCHER_AUTH', null, time() - 3600 * 24, '/');
        $where = " Session_Id = NULL , Log = 0 WHERE Email = '" . $user_info['Email'] . "'";
        if ($user_info['Email'] != "witcher@witcher.com") {
            return ($user->UpdateUserTblCustom($where)) ? true : false;
        }
        return true;
    }

    public function set_login()
    {
        $preg = new preg();
        $max_len = 250;
        $min_len = 1;
        $login = $this->request_array['login'];
        if (isset($login) and strlen($login) < $max_len and strlen($login) > $min_len) {
            if ($this->use_email_for_login) {
                if ($preg->push_email($login) or $preg->push($login, 'username')) {
                    $this->login = $login;
                    return ['status' => true];
                } else {
                    return ['status' => false, 'cause' => 'invalid'];
                }
            } elseif ($this->use_api_key_for_login) {
                if ($preg->push($login, 'api_key')) {
                    $this->login = $login;
                    return ['status' => true];
                } else {
                    return ['status' => false, 'cause' => 'invalid'];
                }
            } else {
                if ($preg->push($login, 'username')) {
                    $this->login = $login;
                    return ['status' => true];
                } else {
                    return ['status' => false, 'cause' => 'invalid'];
                }
            }
        } else {
            return ['status' => false, 'cause' => 'notset'];
        }
    }

    public function can_login()
    {
        if ($this->use_api_key_for_login) {
            return true;
        }
        $user = new user();
        $id = $this->authenticate_login()['id'];
        $permission = $user->get_permissions_custom("WHERE user_Id = " . $id . "")[0];
        if ($permission['Role_Id'] > -1 and $permission['Login'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function set_password()
    {
        if ($this->use_api_key_for_login) {
            return ['status' => true];
        }
        $preg = new preg();
        $max_len = 300;
        $min_len = 1;
        $password = $this->request_array['password'];
        if (isset($password) and strlen($password) < $max_len and strlen($password) > $min_len) {
            if ($preg->push($password, 'password')) {
                $this->password = $password;
                return ['status' => true];
            } else {
                return ['status' => false, 'cause' => 'invalid'];
            }
        } elseif (!isset($password) or strlen($password) > $max_len or strlen($password) < $min_len) {
            return ['status' => false, 'cause' => 'notset'];
        }
        return ['status' => false, 'cause' => 'notset'];
    }

    public function authenticate_login()
    {
        if ($this->login != null) {
            $users = new user();
            if ($users->user_exist($this->login)) {
                return $users->getUserInfoBy('Username', $this->login)[0];
            } elseif ($this->use_email_for_login and count($users->getUserInfoBy('Email', $this->login)) > 0) {
                return $users->getUserInfoBy('Email', $this->login)[0];
            } elseif ($this->use_api_key_for_login) {
                $gateway = new gateway($this->login);
                if ($gateway->valid) {
                    return $users->getUserInfoBy('id', '14')[0];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_user_info()
    {
        $this->login = $this->Witcher_Auth('Login');
        return $this->authenticate_login();
    }

    public function true_password()
    {
        if ($this->use_api_key_for_login) {
            return true;
        }
        if ($this->login != null and $this->password != null) {
            if (!$this->authenticate_login()) {
                return false;
            }
            $password = md5(sha1(md5($this->password)));
            $loginer = $this->authenticate_login();
            if ($loginer['Password'] != $password) {
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    public function is_login()
    {
        $preg = new preg();
        $user = new user();
        if ($this->Witcher_Auth('Certificate_Code') AND $this->Witcher_Auth('Login') AND $this->Witcher_Auth('Password')) {
            $username = $this->Witcher_Auth('Login');
            $password = $this->Witcher_Auth('Password');
            $preg_username = $preg->push($username, 'username');
            $preg_email = $preg->push_email($username);
            $preg_password = $preg->push($password, 'password');

            if ($preg_password AND ($preg_username OR $preg_email)) {
                $statement = "WHERE (Username = '" . $username . "' OR Email = '" . $username . "') AND Password = '" . $password . "' AND Session_Id = '" . $this->Witcher_Auth('Certificate_Code') . "'";

                if ($this->use_api_key_for_login) {
                    $email = "witcher@witcher.ow";
                    $statement = "WHERE ( Email = '" . $email . "') AND Session_Id = '" . $this->Witcher_Auth('Certificate_Code') . "'";
                }

                $check = $user->users_custom_select($statement);
                if ($check->rowCount() == 1) {
                    return true;
                } else {
                    $email = "witcher@witcher.ow";
                    $statement = "WHERE ( Email = '" . $email . "') AND Session_Id = '" . $this->Witcher_Auth('Certificate_Code') . "'";

                    $check = $user->users_custom_select($statement);
                    if ($check->rowCount() == 1){
                        return true;
                    }else{
                        return false;
                    }
                }
            } else {
            return false;
        }
    } else
{
return false;
}
}

private
function CreateSecureLoginCookie($WITCHER_AUTH)
{

    $login_JSON_Data = json_encode($WITCHER_AUTH);

    $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext_raw = openssl_encrypt($login_JSON_Data, $cipher, $this->key, $options = OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $ciphertext_raw, $this->key, $as_binary = true);
    $ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);
    setcookie('WITCHER_AUTH', $ciphertext, time() - 3600 * 24, '/');
    setcookie('WITCHER_AUTH', $ciphertext, time() + 3600 * 24, '/');
}

private
function getSecuredLoginCookieRawData()
{
    if (!isset($_COOKIE['WITCHER_AUTH'])) {
        return false;
    }
    $c = base64_decode($_COOKIE['WITCHER_AUTH']);
    $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
    $iv = substr($c, 0, $ivlen);
    $hmac = substr($c, $ivlen, $sha2len = 32);
    $ciphertext_raw = substr($c, $ivlen + $sha2len);
    $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $this->key, $options = OPENSSL_RAW_DATA, $iv);
    $calcmac = hash_hmac('sha256', $ciphertext_raw, $this->key, $as_binary = true);
    if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
    {
        return $original_plaintext;
    } else {
        return false;
    }
}

public
function Witcher_Auth($key = "")
{
    $raw_json = $this->getSecuredLoginCookieRawData();
    if (!$raw_json) {
        return false;
    }
    $witcher_auth = json_decode($raw_json, true);
    if (isset($witcher_auth[$key])) {
        return $witcher_auth[$key];
    } elseif (!isset($witcher_auth[$key])) {
        return false;
    }
    return false;
}
}