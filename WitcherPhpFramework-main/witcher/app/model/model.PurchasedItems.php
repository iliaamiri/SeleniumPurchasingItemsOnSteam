<?php

namespace Model;

use Core\model;
use Core\preg;

class PurchasedItems extends model
{
    function __construct()
    {
        parent::__construct();
    }

    public function newItem($thread_id, $float_number, $paint_seed, $price)
    {
        parent::$db->mdb_query("INSERT INTO witcher_purchased_items (thread_id, float_number, paint_seed,price) VALUES (".$thread_id.",'".$float_number."', '".$paint_seed."','".$price."')", 1);
        return true;
    }

    public function findRowsById($thread_id){
        $sql = parent::$db->mdb_query("SELECT * FROM witcher_purchased_items WHERE thread_id = :id", 0);
        $sql->execute(array(':id' => $thread_id));
        $response = $sql->fetchAll(\PDO::FETCH_ASSOC);
        if (count($response) == 0) {
            return false;
        }
        return $response;
    }

    public function findRowById($thread_id){
        $sql = parent::$db->mdb_query("SELECT * FROM witcher_purchased_items WHERE thread_id = :id", 0);
        $sql->execute(array(':id' => $thread_id));
        $response = $sql->fetchAll(\PDO::FETCH_ASSOC);
        if (count($response) == 0) {
            return false;
        }
        return $response[0];
    }

    public function All(){
        $sql = parent::$db->mdb_query("SELECT * FROM witcher_purchased_items", 1);
        $response = $sql->fetchAll(\PDO::FETCH_ASSOC);
        if (count($response) == 0) {
            return false;
        }
        return $response;
    }

    public function updateRow($column, $value, $query)
    {
        $sql = parent::$db->mdb_query("UPDATE witcher_purchased_items SET " . $column . " = ? " . $query, 0);
        $sql->execute([$value]);
    }

    public function deleteById($id)
    {
        $sql = parent::$db->mdb_query("DELETE FROM witcher_purchased_items WHERE thread_id = :id", 0);
        $sql->execute(array(':id' => $id));
        return true;
    }
}