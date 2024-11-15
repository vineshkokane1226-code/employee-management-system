<?php
$get_id = $_GET['id'];
$delete_query = "DELETE FROM tbl_departments where id=$get_id";
$connection->query($delete_query);
header("location: list_department.php");
