<?php
class Order{
  public $id;
  public $products;
  public function __construct($id,$products){
    $this->id = $id;
    $this->products= $products;
  }
}