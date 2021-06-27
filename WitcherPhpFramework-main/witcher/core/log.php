<?php

namespace Core;

class log extends configs {
    private static $log_file;

    public static function create_log($log_message,$log_file){
        parent::set_config("log.php");
        self::$log_file = DIR_ROOT."witcher/storage/logs/".$log_file;
        $file = fopen(self::$log_file,"a");
        $configs = parent::$configs;
        $date_log = "";
        if ($configs['dates']['status']){
            $date_log .= date("Y-m-d");
            if ($configs['dates']['log_day']){
                $date_log .= " ".date("D");
            }
            if ($configs['dates']['log_at_least_second']){
                $date_log .= " ".date("H:i:s");
            }
        }
        if ($configs['log_http_response_code']){
            $date_log .= " |HTTP_RESPONSE: ".http_response_code();
        }
        if ($configs['log_get']){
            $date_log .= " ".json_encode($_GET);
        }
        if ($configs['log_post']){
            $date_log .= " ".json_encode($_POST);
        }
        if ($configs['log_witcher_version']){
            $date_log .= " |WITCHER VERSION:".WITCHER_VERSION;
        }
        fwrite($file,$date_log." | ".$log_message."\r\n");
        fclose($file);
    }
}