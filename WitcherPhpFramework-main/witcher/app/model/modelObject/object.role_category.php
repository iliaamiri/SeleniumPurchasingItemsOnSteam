<?php
namespace modelObjects;

use Model\Roles;

class role_category extends Roles {
    public $valid = false;

    public $id;
    public $role_rank;
    public $role_name;
    public $children_role;
    public $using_status;

    function __construct($role_rank = "")
    {
        parent::__construct();

        $row = $this->getRoleInfo("WHERE role_rank = '".$role_rank."'")[0];

        if (!$row){
            $this->valid = false;
        }else{
            $this->id = $row['id'];
            $this->role_rank = $row['role_rank'];
            $this->role_name = $row['role_name'];
            $this->children_role = $row['children_role'];
            $this->using_status = $row['using_status'];

            $this->valid = true;
        }
    }

}