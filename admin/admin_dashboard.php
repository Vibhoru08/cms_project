<?php
include('../includes/config.php');
include('../includes/db.php');
include('../includes/achecklogin.php');
$conn = connect();
$status1 = 'created';
$stmt = $conn->prepare("SELECT * FROM post WHERE status=?");

 // Bind a variable to the parameter as a string.
 $stmt->bind_param("s", $status1);

 // Execute the statement.
 $stmt->execute();
 $result = $stmt->get_result();
$nopc = $result->num_rows;
$stmt->close();

$status2 = 'approved';
$stmt = $conn->prepare("SELECT * FROM post WHERE status=?");

 // Bind a variable to the parameter as a string.
 $stmt->bind_param("s", $status2);

 // Execute the statement.
 $stmt->execute();
 $result = $stmt->get_result();
$nopa = $result->num_rows;
$stmt->close();

$status3 = 'rejected';
$stmt = $conn->prepare("SELECT * FROM post WHERE status=?");

 // Bind a variable to the parameter as a string.
 $stmt->bind_param("s", $status3);

 // Execute the statement.
 $stmt->execute();
 $result = $stmt->get_result();
$nopr = $result->num_rows;
$stmt->close();
$conn->close();
?>
<html>
<head>
  <link rel = "stylesheet" type = "text/css" href = "../css/admin_dashboard.css">
  <title>Dashboard | Manage posts</title>
  </head>
<body>
  <div class="topnav" id="myTopnav">


    <a href="#" class="tn-small" style="float:right;">Notification</a>
    <a href="update.php" class = "tn-small" style="float:right;">Update</a>



  </div>
  <div id = "main1">
    <p class = "content"> Number of tasks waiting to be approved - <a href = "created.php"><?php
    echo $nopc;
    ?></a></p>
  </div>
</div>
<div id = "main2">
  <p class = "content">Number of approved tasks - <a href = "approved.php"><?php
  echo $nopa;
  ?></a></p>
</div>
</div>
<div id = "main3">
  <p class = "content">Number of rejected tasks - <a href = "rejected.php"><?php
  echo $nopr;
  ?></a></p>
</div>
</body>
</html>
