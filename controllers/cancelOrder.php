<?php
require_once('classes/db.php');
if (isset($_POST)) { //check if form was submitted
    $order_id = $_POST['orderNo']; //get input text
    $db = new DbManager();
    $db->cancelOrder($order_id);
}