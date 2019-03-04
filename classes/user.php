<?php
require_once('./order.php');
class User{
    public $id;
    public $name;
    public $order;
    public function __construct($id,$name,$order){
        $this->id = $id;
        $this->name = $name;
        $this->order = $order;
    }

}