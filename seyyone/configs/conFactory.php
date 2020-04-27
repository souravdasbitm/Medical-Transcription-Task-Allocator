<?php
include '../class/dbconn.php';

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'taskseyyone';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
} 
?>