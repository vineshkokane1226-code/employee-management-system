<?php
session_start();
session_destroy();
$login = "../login.php";
header("location: $login");
