<?php
namespace modelObjects;

class purchasedItem extends \Model\PurchasedItems {
    private $exist = true;

    public $id;
    public $thread_id;
    public $float_number;
    public $pain_seed;
    public $price;
    public $bought_at;


    function __construct($thread_id)
    {
        parent::__construct();

        $row = $this->findRowById($thread_id);
        if (!$row){
            $this->exist = false;
        }else{
            $this->id = $row['id'];
            $this->thread_id = $row['thread_id'];
            $this->float_number = $row['float_number'];
            $this->pain_seed = $row['pain_seed'];
            $this->price = $row['price'];
            $this->bought_at = $row['bought_at'];
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