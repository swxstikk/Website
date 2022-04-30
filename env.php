<?php
//Session_start();
$servername = "localhost";
$username = "root";
$password = "";
$db="health_management";
date_default_timezone_set('Asia/Kolkata');
$conn = mysqli_connect($servername, $username, $password,$db);
//mysql_select_db($db);
if (!$conn) {
    die("Connection failed: " . mysql_connect_error());
}
//echo "Connected successfully";
?>