<?php
if (empty($_SESSION['ID'])){
  header("location:login.php");
  exit();
}

?>
