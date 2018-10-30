<?php
if (empty($_SESSION['AID'])){
  header("location:admin_login.php");
  exit();
}

?>
