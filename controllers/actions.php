<?php
// session_start() ; 
require_once 'classes/db.php';
/**
 * 
 * form action for order
 */
if(isset($_POST["ajax_type"])){
    $id =$_POST["id"];
    $status = $_POST["status"];
    $db = new DbManager();
    return $db->changeOrderStatus($id, $status);
    
}
if(isset($_POST["type"]))
{
    $url = '';
    if($_POST["type"] == "add_order")
    {
        $url = "../home?";
        add_order($url);
    }
    if($_POST["type"] == "admin_add_order")
    {
        $url = "admin-manual?";
        add_order($url);
    }
}
function add_order($url){
    $errors=1;
    $value = array();
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
        if(isset($_POST["user_id"])) {
            $value["user_id"]=$_POST["user_id"];
        }else{
            $value["user_id"] = $_SESSION["user_id"];
        }
        $add = new DbManager();
        $addRetrun = $add->addOrder($value);
        if($addRetrun === true){
         header("location:/");
         // $_SESSION["confirm"] = "your order has been added successfully";
        }
        else{
            header("location:/");
        }
    }
}
 
}