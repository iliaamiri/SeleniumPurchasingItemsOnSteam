<?php

namespace Model;

use Core\model;
use Core\preg;

class Threads extends model
{
    function __construct()
    {
        parent::__construct();
    }

    public function newThread($link, $account_name, $password, $float_min, $float_max, $paint_seed, $maximum_purchases_of_founded_items, $refresh_in)
    {
        $preg = new preg();
        if (!$preg->push($account_name,'username') OR !$preg->push($password,'password') OR !$preg->push_url($link) OR !$preg->push($maximum_purchases_of_founded_items, 'number')){
            return false;
        }
        $sql = parent::$db->mdb_query("INSERT INTO witcher_threads (link, account_name,password,float_min,float_max,paint_seed,maximum_purchases_of_founded_items,refresh_in) VALUES ('".$account_name."','".$password."','".$maximum_purchases_of_founded_items."',:float_min,:float_max,:paint_seed, :refresh_in)", 0);
        $sql->execute(array(':float_min' => $float_min,':float_max' => $float_max,':paint_seed' => $paint_seed, ':refresh_in' => $refresh_in));
        return true;
    }

    public function findRowById($id){
        $sql = parent::$db->mdb_query("SELECT * FROM witcher_threads WHERE id = :id", 0);
        $sql->execute(array(':id' => $id));
        $response = $sql->fetchAll(\PDO::FETCH_ASSOC);
        if (count($response) == 0) {
            return false;
        }
        return $response[0];
    }

    public function All(){
        $sql = parent::$db->mdb_query("SELECT * FROM witcher_threads", 1);
        $response = $sql->fetchAll(\PDO::FETCH_ASSOC);
        if (count($response) == 0) {
            return false;
        }
        return $response;
    }

    public function updateRow($column, $value, $query)
    {
        $sql = parent::$db->mdb_query("UPDATE witcher_threads SET " . $column . " = ? " . $query, 0);
        $sql->execute([$value]);
    }

    public function deleteById($id)
    {
        $sql = parent::$db->mdb_query("DELETE FROM witcher_threads WHERE id = :id", 0);
        $sql->execute(array(':id' => $id));
        return true;
    }
}