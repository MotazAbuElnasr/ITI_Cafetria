<?php
require_once('classes/db.php');
if (isset($_GET)) { //check if form was submitted
    $order_id = $_GET['id']; //get input text
    $db = new DbManager();
    $db->cancelOrder($order_id);
}