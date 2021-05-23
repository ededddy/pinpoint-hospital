<?php 

$server = "localhost";
$user = "root";
$pass = "";
$db_name = "cisc3003";

$conn = mysqli_connect($server, $user, $pass, $db_name);

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}


?>