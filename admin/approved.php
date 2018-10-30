<?php
include('../includes/config.php');
include('../includes/db.php');
include('../includes/achecklogin.php');
include('../includes/validator.php');
$val = new validator;
$conn = connect();
if(!empty($_POST)){
  $decision = $val->Xss_safe($_POST['decision']);
  $ID = $val->Xss_safe($_POST['id']);
  $stmt = $conn->prepare("UPDATE post SET status = ? WHERE id = ?");

// Bind the variables to the parameter as strings.
  $stmt->bind_param("si", $decision, $ID);

// Execute the statement.
  $stmt->execute();

// Close the prepared statement.
  $stmt->close();
  header('location:approved.php?msg=success');
}

$status1 = 'approved';
$stmt = $conn->prepare("SELECT * FROM post WHERE status=?");

 // Bind a variable to the parameter as a string.
 $stmt->bind_param("s", $status1);

 // Execute the statement.
 $stmt->execute();
 $result = $stmt->get_result();


?>
<html>
<head>
  <link rel = "stylesheet" type = "text/css" href = "../css/approved.css">
  <title>Dashboard | Manage posts</title>
  <style>

  </style>
</head>
<body>
  <div class="topnav" id="myTopnav">

    <a href = "admin_dashboard.php" class="tn-small">Home</a>
    <a href="#" class="tn-small" style="float:right;">Notification</a>
    <a href="update.php" class = "tn-small" style="float:right;">Update</a>



  </div>
  <?php
  while ($row = $result->fetch_assoc()){

  ?>
  <div id = "main">
  <div id= "title">
   <?php
   echo $row['title'];
   ?>
 </div><hr color = "white"/>
  <div id = "description">
    <?php
  echo $row['description'];
    ?>
  </div><hr color = "white"/>
  <div id = "category">
    <?php
echo $row['category'];
    ?>
  </div>
</div>
<br/>
<div id = "decision">
<form action = "" method = "post">
<input type = "hidden" name = "id" value = "<?php echo $row['id']; ?>">
<input type = "radio" name = "decision" value = "created"> HIDE &nbsp;
<input type = "radio" name = "decision" value = "rejected"> REJECT<br/>
<input type = "submit" value = "submit" name = "submit" class= "submit">
</form>
</div>
<br/>
<hr width = "90%">
  <?php

}

$stmt->close();

$conn->close();
  ?>

</body>
</html>
