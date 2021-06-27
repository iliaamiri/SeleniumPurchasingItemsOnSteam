<?php
namespace Core;


class model {
    public static $db;
    protected static $preg;
    function __construct()
    {
        self::$db = new database();
        self::$preg = new preg();
    }
}