<?php
namespace Model;


use Core\model;

class Message extends model
{
    public static function msg_alert($msg){
        $preg_msg = parent::$preg->push($msg,'text');
        if ($preg_msg){
            echo '<script charset="utf-8">alert("'.$msg.'");</script>';
        }else{
            die("bad value for message->msg_alert().");
        }
    }
    public function msg_show($msg){
        echo $msg;
    }
    public function msg_session_prepare($msg){
        $_SESSION['msg'] = $msg;
    }
    public static function msg_box_session_prepare($msg,$theme){
        $_SESSION['msg_box'] = $msg;
        $_SESSION['msg_box_theme'] = $theme;
    }
    public static function msg_box_session_show($expire = 1){
        if (isset($_SESSION['msg_box']) AND isset($_SESSION['msg_box_theme'])){
            $theme = $_SESSION['msg_box_theme'];
            echo '<div class="alert '.$theme.'">
  <span class="closebtn" onclick="this.parentElement.style.display=none;">&times;</span> 
   '.$_SESSION['msg_box'].'
</div>
';
            if ($expire == 1){
                unset($_SESSION['msg_box']);
            }
        }
    }
    public function msg_session_show($expire = 1){
        if (isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            if ($expire == 1){
                unset($_SESSION['msg']);
            }
        }
    }
}