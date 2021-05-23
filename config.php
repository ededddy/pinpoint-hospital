<?php 

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'cisc3003';

$con = mysqli_connect($host,$user,$pass,$db);

if(!$con){
    die("<script>alert('Connection Failed.')</script>");
}

?>