<?php
include('includes/config.php');
include('includes/db.php');
unset($_SESSION['ID']);
unset($_SESSION['username']);
session_destroy();
header("location:login.php");
exit();

?>
