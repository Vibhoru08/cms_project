<?php
include('includes/config.php');
include('includes/db.php');
//include('checklogin.php');
require_once('includes/validator.php');
include('includes/checklogin.php');
$val = new validator;
$ID = $_SESSION['ID'];
$conn = connect();
$stmt = $conn->prepare("SELECT * FROM user WHERE id=?");

  // Bind a variable to the parameter as a string.
  $stmt->bind_param("i", $ID);

  // Execute the statement.
  $stmt->execute();

  // Get the variables from the query.
  $result = $stmt->get_result();


  $row = $result->fetch_assoc();
  $email = $row['email'];
  $username = $row['username'];
  $first_name = $row['first_name'];
  $last_name = $row['last_name'];
  $pic = $row['profile_pic'];
    $stmt->close();

  if(!empty($_POST)){
    $uname = $val->Xss_safe($_POST['username']);
    $email_id = $val->Xss_safe($_POST['email']);
    $stmt = $conn->prepare("UPDATE user SET username = ? , email = ? WHERE id = ?");

  // Bind the variables to the parameter as strings.
    $stmt->bind_param("ssi", $uname, $email_id, $ID);

  // Execute the statement.
    $stmt->execute();

  // Close the prepared statement.
    $stmt->close();
    header('location:account.php?msg=success');
  }
$conn->close();
?>
<html>
<head>
  <link rel = "stylesheet" type = "text/css" href = "css/account.css">
  <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
  <script type="text/javascript" language="javascript" src="js/account_validation.js"></script>
  <title>Update Profile | Alter profile details</title>
  </head>
<body>
  <div class="topnav" id="myTopnav">
  <a href="dashboard.php" class="tn-small" title = "See your sites here"><img src = "images/nav-home.png" height = "26px"/></a>
  <a href="#" class="tn-small" title = "Sites that you follow"><img src = "images/nav-reader.png" height = "26px"/></a>
    <a href="#" class="tn-small" style="float:right; margin-right:25px;" title = "See your notifications here"><img src = "images/nav-bell.png" height = "26px"/></a>
    <a href="update.php" class = "tn-small" style="float:right;" title = "Edit your profile here"><img src = "images/nav-user.png" height = "26px"/></a>
  <a href="add_post.php" class="tn-small" style="float:right;" title = "Write a new post"><img src = "images/nav-add.png" height = "26px"/></a>


  </div>

<div class="sidenav">
  <div class= "container">
  <img src="<?php
  $conn = connect();
  if($pic == ""){
    echo "images/img_avatar.png";
  }
  else{
    echo "uploads/$pic";
  }
  $conn->close();
  ?>" alt="Avatar" class="avatar">
<div class = "avatar_name">
  <?php
echo '<br/>'.$first_name.' '.$last_name.'<br/><br/>';
?>
<a href = "logout.php"><button style="margin-left:29px; margin-top:7px; padding:3px 5px 3px 5px;border-radius:5%;">Sign out</button></a>
</div><br/><br/><hr/><br/>
<p id="sidebar_heading">Profile</p>
<div class = "sidenav_link">
  <a href = "update.php" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-user.png" height ="24px"> &nbsp;My Profile</a>
  <a href = "account.php" id = "active" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-setting.png" height ="24px"> &nbsp;Account Settings</a>
  <a href = "security.php" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-lock.png" height ="24px"> &nbsp;Security</a>
  <a href = "notif_set.php" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-bell.png" height ="24px"> &nbsp;Notification Settings</a>
</div>
</div>

</div>
<div id = "main">
  <p id = "main_heading">Manage Your Account Settings</p><hr color="white"/><br/><br/><br/><br/><br/><br/><br/>
<form action = "" method = "post" id = "signup_form">
  <label for = "username">Username</label><br/>
  <input type = "text" name = "username" id = "form_username" value = "<?php
echo $username;
  ?>" required><br/>
  <span id = "username_error" class= "error_form"></span><br/>
  <label for = "email">Email address</label><br/>
  <input type = "text" name = "email" id = "form_email" value = "<?php
echo $email;
  ?>" required><br/>
  <span id = "email_error" class= "error_form"></span>
<input type = "submit" name = "submit" class = "submit" value = "Update Details">
</form>
</div>
</body>
</html>
