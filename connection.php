<?php
$user = 'root';
$pass = '';
$db = 'osmps';
$host = 'localhost';
$charset = 'utf8mb4';

$con = mysqli_connect($host, $user, $pass, $db) or
    die("Connection failed: " . mysqli_connect_error());
?>
