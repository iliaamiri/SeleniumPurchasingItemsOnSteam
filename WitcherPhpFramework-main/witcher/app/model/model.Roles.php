<?php

namespace Model;

use Core\model;

class Roles extends model
{

    public function getRoles($columns = "*")
    {
        $sql = self::$db->mdb_query("SELECT $columns FROM witcher_roles", 1);
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getCustomRoles($columns = "*", $statement)
    { // select * form table $statement
        $sql = self::$db->mdb_query("SELECT $columns FROM witcher_roles $statement", 1);
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getRoleInfo($query)
    {
        $sql = parent::$db->mdb_select('witcher_roles', "*", $query);
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function newRole($id, $name, $children_array)
    {
        // NOTE : children array yani majmooe naghsh haayi (roles) ke naghshe jadid (newRole) mitoone access dashte bashe beheshoon ( read or write ) 
    }

    public function deactiveRolesA($array_id)
    {
        foreach ($array_id as $role_id) {
            self::$db->mdb_query("UPDATE witcher_roles SET using_status = 0 WHERE role_rank = '" . $role_id . "'", 1);
        }
        return true;
    }

    public function removeRolesA($array_id)
    {
        foreach ($array_id as $role_id) {
            self::$db->mdb_query("DELETE FROM witcher_roles WHERE role_rank = '" . $role_id . "'", 1);
        }
        return true;
    }

    public function getChildrenArray($parent_role_id)
    {
        $sql = self::$db->mdb_query("SELECT children_roles FROM witcher_roles WHERE role_rank = '" . $parent_role_id . "'", 1);
        return $sql->fetch(\PDO::FETCH_COLUMN);
    }

    public function isThisItsChild($parent_role_id, $child_role_id)
    {
        $children_of_parent = $this->getChildrenArray($parent_role_id);
        $i = 0;
        foreach ($children_of_parent as $child_id) {
            if ($child_id == $child_role_id)
                $i++;
        }
        return $i == 1 ? true : false;
    }

    public function isThisRoleExisted($role_id)
    {
        $sql = self::$db->mdb_query("SELECT * FROM children_roles WHERE role_rank = '" . $role_id . "'", 1);
        return ($sql->rowCount() > 0) ? true : false;
    }
}