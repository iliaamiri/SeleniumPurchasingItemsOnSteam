<?php
namespace modelObjects;

class threads extends \Model\Threads {
    private $exist = true;

    public $id;
    public $thread_id;
    public $webdriver_session;
    public $link;
    public $account_name;
    public $password;
    public $float_min;
    public $float_max;
    public $paint_seed;
    public $maximum_attempts_to_purchase;
    public $refresh_in;
    public $created_at;
    public $updated_at;
    public $status;


    function __construct($id)
    {
        parent::__construct();

        $row = $this->findRowById($id);
        if (!$row){
            $this->exist = false;
        }else{
            $this->id = $row['id'];
            $this->thread_id = $row['thread_id'];
            $this->webdriver_session = $row['webdriver_session'];
            $this->link = $row['link'];
            $this->account_name= $row['account_name'];
            $this->password = $row['password'];
            $this->float_min = $row['float_min'];
            $this->float_max = $row['float_max'];
            $this->paint_seed = $row['paint_seed'];
            $this->maximum_attempts_to_purchase = $row['maximum_attempts_to_purchase'];
            $this->refresh_in = $row['refresh_in'];
            $this->created_at = $row['created_at'];
            $this->updated_at = $row['created_at'];
            $this->status = $row['status'];
        }
    }

    public function exists(){
        return $this->exist;
    }

    public function update($var_to_update, $new_value)
    {
        $this->updateRow($var_to_update, $new_value, " WHERE thread_id = '" . $this->thread_id . "'");
    }
}