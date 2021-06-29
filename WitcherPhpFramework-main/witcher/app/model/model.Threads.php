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

    public function newThread($thread_id, $link, $account_name, $password, $float_min, $float_max, $paint_seed, $maximum_purchases_of_founded_items, $refresh_in)
    {
        $preg = new preg();
        if (!$preg->push($account_name,'username') OR !$preg->push($password,'password') OR !$preg->push_url($link) OR !$preg->push($maximum_purchases_of_founded_items, 'number') OR !$preg->push($paint_seed, 'number') OR !$preg->push($refresh_in, 'number') OR !$preg->push($float_min, 'double') OR !$preg->push($float_max, 'double')){
            return false;
        }
        $sql = parent::$db->mdb_query("INSERT INTO witcher_threads (thread_id, link, account_name,password,float_min,float_max,paint_seed,maximum_attempts_to_purchase,refresh_in) VALUES (".$thread_id.",'".$link."', '".$account_name."','".$password."',".$maximum_purchases_of_founded_items.",".floatval($float_min).",".floatval($float_max).",".$paint_seed.", ".$refresh_in.")", 0);
        $sql->execute();
        return true;
    }

    public function findRowById($id){
        $sql = parent::$db->mdb_query("SELECT * FROM witcher_threads WHERE thread_id = :id", 0);
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
        $sql = parent::$db->mdb_query("DELETE FROM witcher_threads WHERE thread_id = :id", 0);
        $sql = parent::$db->mdb_query("DELETE FROM witcher_threads WHERE thread_id = :id", 0);
        $sql->execute(array(':id' => $id));
        return true;
    }
}