<?php
include('includes/config.php');
include('includes/db.php');
$ns = '1';
$id = $_SESSION['ID'];

if (isset($_POST['file_input'])){
$file = $_FILES['file'];
$filename = $_FILES['file']['name'];
$filetmpname = $_FILES['file']['tmp_name'];
$filesize = $_FILES['file']['size'];
$filerror = $_FILES['file']['error'];

$filext = explode('.', $filename);
$fileactualext = strtolower(end($filext));
$allowed = array('jpg','jpeg','png');
if(in_array($fileactualext , $allowed)){
  if($filerror === 0){
    if($filesize < 1000000 ){
      $filenamenew = "profile".$id.".".$fileactualext;
      $filedestination = 'uploads/'.$filenamenew;
      if (file_exists($filedestination)){
        unlink($filedestination);
      }
      move_uploaded_file($filetmpname, $filedestination);
      $conn = connect();

      $stmt = $conn->prepare("UPDATE profile_image SET status = ? WHERE user_id = ?");

   // Bind the variables to the parameter as strings.
     $stmt->bind_param("si", $ns, $id);

   // Execute the statement.
     $stmt->execute();

   // Close the prepared statement.
     $stmt->close();

     $conn->close();
    header("location:update.php?msg=success");
    }
    else {
      echo "Your file is too big.";
    }
  }
  else {
    echo "file could not be uploaded.";
  }
}
else {
  echo "File not allowed.";
}


}
?>
