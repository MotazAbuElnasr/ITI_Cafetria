<?php
$localhost='localhost';
$server='root';
$password='password';
$db='iti_cafe';
$con=mysqli_connect($localhost,$server,$password,$db);
if(!$con)die(mysqli_connect_error());
// else echo "connect . <br>";
?>