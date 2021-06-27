<?php

namespace Model;

use Core\model;
use Core\preg;
use Module\loginModule;

class user extends model
{

    private static $permission;
    public $Image_src_target = "panel/src/img";

    public function getActiveUsers()
    {
        $table = array('witcher_user', 'witcher_witcher_user_permissions');
        $sql = parent::$db->mdb_query("SELECT $table[0].*,$table[1].*, $table[0].id as id FROM $table[0] LEFT JOIN $table[1] ON $table[0].id = $table[1].user_Id WHERE $table[1].Role_Id != -1", 1);
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getUserInfoBy($column, $value)
    {
        $table = ['witcher_user', 'witcher_user_permissions'];
        $sql = parent::$db->mdb_query("SELECT $table[0].*, $table[1].* , $table[0].id as id FROM $table[0] INNER JOIN $table[1] ON $table[0].id = $table[1].user_Id WHERE $table[0].$column = '$value'", 1);
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        $table = ['witcher_user', 'witcher_user_permissions'];
        $sql = parent::$db->mdb_query("SELECT $table[0].*, $table[1].*, $table[0].id as id FROM $table[0] INNER JOIN $table[1] ON $table[0].id = $table[1].user_Id", 1);
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function countAll(){
        $sql = parent::$db->mdb_query("SELECT COUNT(*) FROM witcher_user",1);
        return $sql->fetchAll(\PDO::FETCH_COLUMN)[0];
    }

    public function get_permissions_custom($statements = "")
    {
        $table = 'witcher_user_permissions';
        $sql = parent::$db->mdb_query("SELECT * FROM $table $statements", 1);
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getPasswordEncoded($raw_password)
    {
        return md5(sha1(md5($raw_password)));
    }

    public function user_get_certificate()
    {
        $preg = new preg();
        $loginModule = new loginModule();
        if ($loginModule->Witcher_Auth('Certificate_Code')) {
            $preg_code = $preg->push_custom('/^[a-z0-9]*$/i', $loginModule->Witcher_Auth('Certificate_Code'));
            if ($preg_code) {
                $table = 'witcher_user';
                $sql = parent::$db->mdb_query("SELECT * FROM $table WHERE Session_Id = '".$loginModule->Witcher_Auth('Certificate_Code')."'", 1);
                if ($sql->rowCount() > 0) {
                    $row = $sql->fetch(\PDO::FETCH_ASSOC);
                    return $row;
                }
            }
        } elseif (!$loginModule->Witcher_Auth('Certificate_Code')) {
            return false;
        }
        return false;
    }

    public function users_custom_select($statements = "")
    {
        $sql = parent::$db->mdb_query("SELECT * FROM witcher_user $statements", 1);
        return $sql;
    }

    public function user_get_permission($check_certificate = 1, $by_email = "", $by_custom = "")
    {
        if ($check_certificate == 1) {
            $user = $this->user_get_certificate();
            $where = "witcher_user.Session_Id='" . $user['Session_Id'] . "'";
        } elseif ($by_email != "" AND $check_certificate != 1) {
            $user = $by_email;
            $where = "witcher_user.Email = '" . $user . "'";
        } elseif (empty($by_username) AND is_array($by_custom)) {
            $where = "witcher_user." . $by_custom[0] . " = '" . $by_custom[1] . "'";
        }
        $sql = parent::$db->mdb_query("SELECT witcher_user_permissions.* FROM witcher_user RIGHT JOIN witcher_user_permissions ON witcher_user.id = witcher_user_permissions.user_Id WHERE $where", 1);
        if ($sql->rowCount() > 0) {
            self::$permission = $sql->fetch(\PDO::FETCH_ASSOC);
            return self::$permission;
        }
        return false;
    }


    public function user_exist($user_name)
    {
        $preg = new preg();
        $preg_user = $preg->push($user_name, 'username');
        if ($preg_user) {
            $sql = parent::$db->mdb_query("SELECT * FROM witcher_user WHERE Username = '$user_name'", 1);
            if ($sql->rowCount() > 0) {
                return true;
            }
        }
        return false;
    }

    public function user_second_id_exist($user_second_id)
    {
        $sql = parent::$db->mdb_select('witcher_user', '*', "WHERE user_second_id = '" . $user_second_id . "'");
        if (count($sql->fetchAll(\PDO::FETCH_ASSOC)) > 0) {
            return true;
        }
        return false;
    }

    public function email_exist($email)
    {
        $preg = new preg();
        $preg_user = $preg->push_email($email);
        if ($preg_user) {
            $sql = parent::$db->mdb_query("SELECT * FROM witcher_user WHERE Email = '$email'", 1);
            if ($sql->rowCount() > 0) {
                return true;
            }
        }
        return false;
    }

    public function AddUser($data, $guest = false)
    {
        $data['Password'] = md5(sha1(md5($data['Password'])));
        try {
            $user_second_id = md5(sha1(md5($data['Password'] . $data['Username'] . rand(1000, 9999))));
            parent::$db->mdb_query("INSERT INTO witcher_user (Username,Email,Password,user_second_id) VALUE ('$data[Username]','$data[Email]','$data[Password]','$user_second_id')", 1);
            $user = new \modelObjects\user($data['Email']);
            parent::$db->mdb_query("INSERT INTO witcher_user_permissions (user_Id,Role_Id) VALUE ('".$user->user_Id."','$data[Role_Id]')", 1);
            return true;
        } catch (\PDOException $e) {
            return $e;
        }
    }

    public function CountUsers()
    {
        $sql = parent::$db->mdb_query("SELECT * FROM witcher_user", 1);
        return $sql->rowCount();
    }

    public function CountUsersBy($column, $value)
    {
        $sql = parent::$db->mdb_query("SELECT * FROM witcher_user WHERE $column = '$value'", 1);
        return $sql->rowCount();
    }

    public function CountUsersBy_Permission($permission, $value)
    {
        $sql = parent::$db->mdb_query("SELECT * FROM witcher_user_permissions WHERE $permission = '$value'", 1);
        $row = $sql->fetchAll(\PDO::FETCH_ASSOC);
        return count($row);
    }

    public function SwitchPermission($permission, $statement, $email)
    {
        $value = parent::$db->mdb_query("SELECT * FROM witcher_user_permissions WHERE Email = '$email'", 1)->fetch(\PDO::FETCH_ASSOC)[$permission];
        if ($value == 0) {
            $newvalue = 1;
        } else {
            $newvalue = 0;
        }
        parent::$db->mdb_query("UPDATE witcher_user_permissions SET $permission = '$newvalue' $statement", 1);
    }

    public function UpdateRolePermission($email, $new)
    {
        parent::$db->mdb_query("UPDATE witcher_user_permissions SET Role_Id = '$new' WHERE Email = '$email'", 1);
    }

    public function UpdateUserTbl($password, $image, $Email, $newEmail = "", $newFull = "", $newusername = "")
    {
        $custom = "";
        $custom2 = "";
        $custom3 = "";
        if ($newEmail != "") {
            $custom = ", Email = '" . $newEmail . "'";
        }
        if ($newFull != "") {
            $custom2 = " , Full_Name = '" . $newFull . "'";
        }
        if ($newusername != "") {
            $custom3 = " , Username = '" . $newusername . "'";
        }
        parent::$db->mdb_query("UPDATE witcher_user SET Password = '$password', Profile_Image = '$image' $custom $custom2 $custom3 WHERE Email = '$Email'", 1);
    }

    public function UpdateUserTblCustom($statements)
    {
        parent::$db->mdb_query("UPDATE witcher_user SET $statements", 1);
        return true;
    }

    public function UpdateColumn($column, $value, $statement)
    {
        parent::$db->mdb_query("UPDATE witcher_user SET $column = '$value' $statement", 1);
        return true;
    }

    public function UpdatePermission($column, $value, $email)
    {
        parent::$db->mdb_query("UPDATE witcher_user_permissions SET $column = '$value' WHERE Email = '$email'", 1);
        return true;
    }

    public function PercentageOfBrowsers($browsers_list)
    {
        $result = [];
        $sql_users = parent::$db->mdb_query("SELECT * FROM witcher_user", 1);
        foreach ($browsers_list as $browser) {
            $sql = parent::$db->mdb_query("SELECT * FROM witcher_user WHERE Last_Browser = '$browser'", 1);
            $result[$browser] = $sql->rowCount();
        }
        $last_result = [];
        foreach ($result as $key => $cal) {
            $last_result[$key] = 100 * $cal / $sql_users->rowCount();

        }
        return $last_result;
    }

    public function getRoles()
    {
        $sql = parent::$db->mdb_query("SELECT * FROM role_category", 1);
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function exist_role($id)
    {
        $sql = parent::$db->mdb_query("SELECT * FROM role_category WHERE Role_Id = '$id'", 1);
        if ($sql->rowCount() > 0)
            return true;
        else
            return false;
    }

    public function delete($email)
    {
        parent::$db->mdb_query("DELETE FROM witcher_user WHERE Email = '$email'", 1);
        return true;
    }
}