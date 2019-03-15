<?php

require_once 'classes/db.php';
class Category
{
    // database connection and table name
    private $table_name = 'categories';
    private $db;
    // object properties
    public $id;
    public $name;

    public function __construct()
    {
        $this->db = new DbManager();
    }

    // used by select drop-down list
    public function read()
    {
        //select all data
        return $this->db->readCategory();
    }

    // used to read category name by its ID
    public function readName($id)
    {
        return $this->db->readName($this->id);
    }
}
?>
