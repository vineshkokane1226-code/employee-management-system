<?php
$get_id = $_GET['id'];
$delete_query = "DELETE FROM tbl_attendences where id=$get_id";
$connection->query($delete_query);
header("location: list_attendence.php");
