<?php

namespace Model;

use Core\model;
use Core\preg;

class SteamAuthCreds extends model
{
    function __construct()
    {
        parent::__construct();
    }

    public function newCreds($account_name, $password)
    {
        $preg = new preg();
        if (!$preg->push($account_name,'username') OR !$preg->push($password,'password')){
            return false;
        }
        parent::$db->mdb_query("INSERT INTO witcher_steam_auth_credentials (account_name,password) VALUES ('".$account_name."','".$password."')", 1);
        return true;
    }

    public function findRowById($id){
        $sql = parent::$db->mdb_query("SELECT * FROM witcher_steam_auth_credentials WHERE id = :id", 0);
        $sql->execute(array(':id' => $id));
        $response = $sql->fetchAll(\PDO::FETCH_ASSOC);
        if (count($response) == 0) {
            return false;
        }
        return $response[0];
    }

    public function findRowByDefault()
    {
        $sql = parent::$db->mdb_query("SELECT * FROM witcher_steam_auth_credentials WHERE 	default_status = 1", 1);
        $response = $sql->fetchAll(\PDO::FETCH_ASSOC);
        return $response[0];
    }

    public function All(){
        $sql = parent::$db->mdb_query("SELECT * FROM witcher_steam_auth_credentials", 1);
        $response = $sql->fetchAll(\PDO::FETCH_ASSOC);
        if (count($response) == 0) {
            return false;
        }
        return $response;
    }

    public function makeDefault($id){
        parent::$db->mdb_query("UPDATE witcher_steam_auth_credentials SET default_status = 0", 1);
        $sql = parent::$db->mdb_query("UPDATE witcher_steam_auth_credentials SET default_status = 1 WHERE id = :id", 0);
        $sql->execute(array(':id' => $id));
        return true;
    }

    public function updateById($id, $account_name, $password)
    {
        $preg = new preg();
        if (!$preg->push($account_name,'username') OR !$preg->push($password,'password')){
            return false;
        }
        $sql = parent::$db->mdb_query("UPDATE witcher_steam_auth_credentials SET account_name = :account_name, password = :password WHERE id = :id", 0);
        $sql->execute(array(':id' => $id, ':account_name' => $account_name, ':password' => $password));
        return true;
    }

    public function deleteById($id)
    {
        $sql = parent::$db->mdb_query("DELETE FROM witcher_steam_auth_credentials WHERE id = :id", 0);
        $sql->execute(array(':id' => $id));
        return true;
    }
}