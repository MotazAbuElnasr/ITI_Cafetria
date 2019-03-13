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
    // $url= "forms/user/signup.php?";
   
    if(isset($_POST['price'])&& !empty($_POST['price'])){
        $price = $_POST['price'];
        $value["price"] = $_POST['price'];
        // $url=$url."price_value=$price&";
    }
    else{
        $errors=2;
        // $url=$url."price=price is required&";
    }
    if(isset($_POST['notes'])){
        $value["notes"] = $_POST['notes'];
        // $url=$url."notes_value=$notes&";
    }
    else{
        $errors=2;
        $url=$url."notes= notes is required&";
    }
    if(isset($_POST['room'])){
        $value["room"] = $_POST['room'];
        $email = $_POST['room'];
        // $url=$url."room_value=$room&";
    }
    else{
        $errors=2;
        // $url=$url."room=room is required&";
    }
   
    
    if($errors == 2 ){
        // header("Location: $url");
        exit();
    }
    else{
        $value["status"] = "pending";
        $value["time"] = now();
        // $value["user_id"] = $_SESSION["user_id"];
        $value["user_id"]=1;
        $add = new DbManager();
        $addRetrun = $add->addOrder($value);
        if($addRetrun === true){
            echo "done";
        // header("Location:forms/user/login.php");
        }
        else{
            echo" lets cry then solve the error :)";
        }
    }
 
}