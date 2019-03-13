<?php
<<<<<<< HEAD
require_once('classes/db.php');
class Category{
    // database connection and table name
    private $table_name = "categories";
=======

require_once 'classes/db.php';
class Category
{
    // database connection and table name
    private $table_name = 'categories';
>>>>>>> bcca0ff16856f2196d8a1c89d0dd57426861af38
    private $db;
    // object properties
    public $id;
    public $name;

<<<<<<< HEAD
    public function __construct(){
=======
    public function __construct()
    {
>>>>>>> bcca0ff16856f2196d8a1c89d0dd57426861af38
        $this->db = new DbManager();
    }

    // used by select drop-down list
<<<<<<< HEAD
    function read(){
=======
    public function read()
    {
>>>>>>> bcca0ff16856f2196d8a1c89d0dd57426861af38
        //select all data
        return $this->db->readCategory();
    }

<<<<<<< HEAD


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
=======
    // used to read category name by its ID
    public function readName($id)
    {
        return $this->db->readName($this->id);
    }
}
>>>>>>> bcca0ff16856f2196d8a1c89d0dd57426861af38
