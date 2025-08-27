<?php
$hostname = "127.0.0.1";  // use IP instead of localhost
$username = "root";
$password = "";
$database = "db_employeemanagement";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

