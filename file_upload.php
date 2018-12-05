<?php
include('includes/config.php');
include('includes/db.php');
//include('checklogin.php');
require_once('includes/validator.php');
include('includes/checklogin.php');
$val = new validator;
$conn = connect();
$ID = $_SESSION['ID'];
foreach ($_FILES["images"]["error"] as $key => $error) {
  if ($error == UPLOAD_ERR_OK) {
    $name = $_FILES["images"]["name"][$key];
    move_uploaded_file( $_FILES["images"]["tmp_name"][$key], "uploads/$name");
    echo "uploads/$name?";
    $stmt1=$conn->prepare("UPDATE user SET profile_pic=? WHERE id =?");
    $stmt1->bind_param("si", $name, $ID);
    $stmt1->execute();
    $stmt1->close();

  }
}
$conn->close();
 ?>
 
