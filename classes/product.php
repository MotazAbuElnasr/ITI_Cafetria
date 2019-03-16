<?php

require_once 'classes/db.php';
class Product
{
    // database connection and table name
    private $db;
    // object properties
    public $pid;
    public $name;
    public $price;
    public $cat_id;
    public $image;
    public $timestamp;

    public function __construct()
    {
        $this->db = new DbManager();
    }

    // create product
    public function create()
    {
        // insert query
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->image = './products/' . $this->image;

        return $this->db->createProduct($this->name, $this->price, $this->image, $this->category_id, $this->timestamp);
    }

    // used for paging products
    public function update()
    {
        $imgSet = '';
        if (!empty($this->image))
            $imgSet = ' ,img = :image ';
        $query = "UPDATE
                    products
                SET
                    name = :name,
                    price = :price,
                    cat_id  = :category_id" .
            $imgSet
            . " WHERE p_id = :id";

        $stmt = $this->db->pdo->prepare($query);

        // posted values
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind parameters
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        if (!empty($this->image))
            $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

    //public function update($id)
    // {
    // insert query
    //     $this->image = htmlspecialchars(strip_tags($this->image));
    //     $this->image = './products/'.$this->image;

    //    return $this->db->updateProduct($this->name, $this->price, $this->image, $this->category_id, $this->timestamp);
    //}

    // delete the product
