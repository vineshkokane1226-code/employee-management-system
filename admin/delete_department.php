<?php
// database connection
$connection = new mysqli("localhost", "root", "", "db_employeemanagement");
$get_id = $_GET['id'];
$delete_query = "DELETE FROM tbl_departments where id=$get_id";
$connection->query($delete_query);
header("location: list_department.php");
