<?php
session_start();

$get_id = $_GET['id'];
$action = $_GET['action'];
$approved_by = $_SESSION['id'];

$leave_query = "UPDATE tbl_leaves SET approved_by=$approved_by,  status='$action' WHERE id = $get_id";
$connection->query($leave_query);
header("location: requested_leave.php");
