<?php

require("dbConfig.php");
$servername = $config["servername"];
$username = $config["username"];
$password = $config["password"];
$db= $config["db"];

try {
    $this->conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    // set the PDO error mode to exception
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    "Connection failed: " . $e->getMessage();
}
?>