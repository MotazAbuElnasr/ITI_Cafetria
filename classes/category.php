<?php
require_once('classes/db.php');
class Category{
    // database connection and table name
    private $table_name = "categories";
    private $db;
    // object properties
    public $id;
    public $name;

    public function __construct(){
        $this->db = new DbManager();
    }

    // used by select drop-down list
    function read(){
        //select all data
        return $this->db->readCategory();
    }



    //it has no usage???
    // used to read category name by its ID
    function readName(){

        $query = "SELECT name FROM " . $this->table_name . " WHERE id = ? limit 0,1";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
    }

}
?>