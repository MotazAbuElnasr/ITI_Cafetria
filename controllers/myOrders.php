<?php
require_once ('../classes/db.php');
$db= new dbManger();
$userId = 3;
$start  = '2019-02-13 00:00:00';
$end  = '2019-02-15 00:00:00';
$orders = $db->userOrders($userId,$start,$end);
var_dump($orders)
?>