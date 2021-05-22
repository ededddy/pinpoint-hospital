<?php 

$server = "localhost";
$user = "root";
$pass = "";
$db_name = "login_register";

$conn = mysqli_connect($server, $user, $pass, $db_name);

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}


?>