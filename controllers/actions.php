<?php
// session_start() ; 
require_once '../classes/db.php';
/**
 * 
 * form action for order
 */
if(isset($_POST["type"]))
{
    if($_POST["type"] == "add_order")
    {
        add_order();
    }
}
function add_order(){
    $errors=1;
    $value = array();
     $url= "../home?";
    if(isset($_POST['submit']) ){
    
    if(isset($_POST['order_note'])){
        $value["notes"] = $_POST['order_note'];
    }
    else{
        $errors=2;
         $url=$url."notes= notes is required&";
    }
    if(isset($_POST['order_room_number']) && !empty($_POST['order_room_number']) ){
        $value["room"] = $_POST['order_room_number'];
    }
    else{
        $errors=2;
         $url=$url."room=room is required&";
    }
    if(isset($_POST['product_id']))
    {
        $value["product_id"] = $_POST['product_id'];
    }
    else{
        $errors=2;
         $url=$url."product_id=product  is required&";
    }
    if(isset($_POST['price']) && $_POST['price'] != 0)
    {
        $value["price"] = $_POST['price'];
    }
    else{
        $errors=2;
         $url=$url."price=price is required&";
    }
    if(isset($_POST['quantity']) && $_POST['quantity'] != 0)
    {
        $value["quantity"] = $_POST['quantity'];
    }
    else{
        $errors=2;
         $url=$url."quantity=quantity is required&";
    }
   
    
    if($errors == 2 ){
         header("Location: $url");
        exit();
    }
    else{
        $value["status"] = "Processing";
        $value["time"] =date("Y-m-d H:i:s");
        // $value["user_id"] = $_SESSION["user_id"];
        $value["user_id"]=1;
        $add = new DbManager();
        $addRetrun = $add->addOrder($value);
        if($addRetrun === true){
         header("Location:/home");
         // $_SESSION["confirm"] = "your order has been added successfully";
        }
        else{
        }
    }
}
 
}