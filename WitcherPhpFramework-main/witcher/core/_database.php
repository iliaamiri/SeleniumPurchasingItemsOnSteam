<?php

namespace Core;

class database extends configs
{
    private $db_kind;
    private $db_username;
    private $db_password;
    private $db_name;
    private $db_host;
    private $db_charset;

    public static $cconn;
    public static $mconn;

    function __construct()
    {
        if (self::$cconn == null){
            parent::set_config("database.php");
            parent::set_exceptionsMessages_config("db_connection.php");
            $this->auto_setter();
            self::$cconn = $this->cdb_conn();
            self::$mconn = $this->mdb_conn();
        }
    }

    private function auto_setter($config_type = "default")
    {
        $config = parent::$configs;
        $config = $config[$config_type];
        $this->db_kind = $config['db_driver'];
        $this->db_host = $config['db_host'];
        $this->db_name = $config['db_name'];
        $this->db_username = $config['db_login'];
        $this->db_password = $config['db_pass'];
        $this->db_charset = $config['db_charset'];
    }

    public function cdb_conn()
    {
        try {
            $conn = new \PDO("mysql:host=$this->db_host;dbname=$this->db_name;charset=$this->db_charset", $this->db_username, $this->db_password);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (\PDOException $e) {
            echo "<p style='text-align: center;margin-top: 10%;font-size: 19px;cursor: none;'>" . parent::$exceptionsMessages['connection_failed'] . "</p>";
            die();
        }
    }

    public function mdb_conn()
    {
        parent::set_config("configDb_tables.php");
        $table = parent::$configs['main_db'];
        $sql = $this->cdb_query("SELECT * FROM $table WHERE active_status = 1", 1);
        $row = $sql->fetch(\PDO::FETCH_ASSOC);
        $this->db_host = $row['host'];
        $this->db_name = $row['db_name'];
        $this->db_charset = $row['db_charset'];
        $this->db_username = $row['db_user'];
        $this->db_password = $row['db_pass'];
        try {
            $conn = new \PDO("mysql:host=$this->db_host;dbname=$this->db_name;charset=$this->db_charset", $this->db_username, $this->db_password);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (\PDOException $e) {
            echo "<p style='text-align: center;margin-top: 10%;font-size: 19px;cursor: none;'>" . parent::$exceptionsMessages['connection_failed'] . "</p>";
            die();
        }
    }

    public function cdb_query($query, $execute = 0)
    {
        try {
            $sql = self::$cconn->prepare($query);
            if ($execute == 1) {
                $sql->execute();
            }
            return $sql;
        } catch (\PDOException $e) {
            die($e);
        }
    }

    public function mdb_query($query, $execute = 0)
    {
        try {
            $sql = self::$mconn->prepare($query);
            if ($execute == 1) {
                $sql->execute();
            }
            return $sql;
        } catch (\PDOException $e) {
            die($e);
        }
    }

    public function db_conn_custom($array)
    {
        try {
            $conn_custom = new \PDO("mysql:host=$array[hostname];dbname=$array[dbname]", $array['user'], $array['pass']);
            $conn_custom->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$cconn = $conn_custom;
        } catch (\PDOException $e) {
            die(parent::$exceptionsMessages['custom_db_not_found']);
        }
    }

    public function db_charset($charset)
    {
        self::$cconn->exec("SET NAMES " . $charset);
    }

    public function getColumnsName($table)
    {
        try {
            $sql = $this->cdb_query("SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`= $this->db_name AND `TABLE_NAME`= $table ", 1);
            if ($sql->rowCount() > 0) {
                $row = $sql->fetchAll(\PDO::FETCH_ASSOC);
                return $row;
            } else {
                throw new \PDOException(parent::$exceptionsMessages['unknown_table']);
            }
        } catch (\PDOException $e) {
            die($e);
        }
    }

    public function mdb_select($table_name, $columns = '*', $query = "")
    {
        try {
            $sql = $this->mdb_query("SELECT " . $columns . " FROM $table_name $query", 1);
            return $sql;
        } catch (\PDOException $e) {
            die(parent::$exceptionsMessages['select_fail']);
        }
    }

    public function mdb_update($table_name = "", $updating_columns = [], $updating_values = [], $query = "")
    {
        try {
            if (count($updating_columns) != count($updating_values)) {
                throw new \Exception("");
            }
            $update_statements = "";
            $last_key = count($updating_columns) - 1;
            foreach ($updating_columns as $column_key => $column_name) {
                $update_statements .= $column_name . "=" . ":" . $column_name . "";
                if ($last_key != $column_key)
                    $update_statements .= ",";
            }
            $sql = $this->mdb_query("UPDATE $table_name SET " . $update_statements . " $query", 0);
            foreach ($updating_columns as $updating_column_key => $updating_column_value) {
                $sql->bindValue(":" . $updating_columns[$updating_column_key], $updating_values[$updating_column_key]);
            }
            $sql->execute();
            return true;
        } catch (\PDOException $e) {
            die(parent::$exceptionsMessages['update_fail']);
        }
    }

    public function mdb_insert($table_name = "", $inserting_columns = [], $inserting_values = [], $query = "")
    {
        try {
            if (count($inserting_columns) != count($inserting_values)) {
                throw new \Exception("INSERTING_TO_DATABASE_EXCEPTIONS: inserting_columns[] and inserting_values[] 's counting has to be equal!");
            }
            $inserting_columns_statements = "";
            $last_key = count($inserting_columns) - 1;
            foreach ($inserting_columns as $column_key => $column_name) {
                $inserting_columns_statements .= $column_name;
                if ($last_key != $column_key)
                    $inserting_columns_statements .= ",";
            }
            $inserting_values_statements = "";
            foreach ($inserting_values as $insert_key => $insert_values) {
                $inserting_values_statements .= ":" . $inserting_columns[$insert_key];
                if ($last_key != $insert_key)
                    $inserting_values_statements .= ",";
            }
            $sql = $this->mdb_query("INSERT INTO $table_name (" . $inserting_columns_statements . ") VALUES (" . $inserting_values_statements . ") $query", 0);
            foreach ($inserting_values as $insert_key => $insert_values) {
                $sql->bindValue(":" . $inserting_columns[$insert_key], $insert_values);
            }
            $sql->execute();
            return true;
        } catch (\PDOException $e) {
            die(parent::$exceptionsMessages['insert_fail']);
        }
    }

    public function mdb_delete($table_name = "", $delete_statements = "", $iamsure = false)
    {
        try {
            if ($iamsure) {
                $this->mdb_query("DELETE FROM $table_name $delete_statements", 1);
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            die(parent::$exceptionsMessages['delete_fail']);
        }
    }

    public function cdb_update($table_name = "", $updating_columns = [], $updating_values = [], $query = "", $execute = 1)
    {
        try {
            if (count($updating_columns) != count($updating_values)) {
                throw new \Exception("");
            }
            $update_statements = "";
            $last_key = count($updating_columns) - 1;
            foreach ($updating_columns as $column_key => $column_name) {
                $update_statements .= $column_name . "=" . "'" . $updating_values[$column_key] . "'";
                if ($last_key != $column_key)
                    $update_statements .= ",";
            }
            return $this->cdb_query("UPDATE $table_name SET " . $update_statements . " $query", $execute);

        } catch (\PDOException $e) {
            die(parent::$exceptionsMessages['update_fail']);
        }
    }
}