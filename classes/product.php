<?php
require_once('classes/db.php');
class Product{
    // database connection and table name
    private $db;
    // object properties
    public $id;
    public $name;
    public $price;
    public $description;
    public $category_id;
    public $timestamp;

    public function __construct(){
        $this->db = new DbManager();
    }
    // create product
    public function create(){
        //write query
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');
        return $this->db->createProduct($this->name,$this->price,$this->description,$this->category_id,$this->timestamp);

    }
}
