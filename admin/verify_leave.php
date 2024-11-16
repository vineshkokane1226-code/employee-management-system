<?php
// database connection
$connection = new mysqli("localhost", "root", "", "db_employeemanagement");

session_start();

$get_id = $_GET['id'];
$action = $_GET['action'];
$leave_query = "UPDATE tbl_leaves SET  status='$action' WHERE id = $get_id";
$connection->query($leave_query);
header("location: requested_leave.php");
