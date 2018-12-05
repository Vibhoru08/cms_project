<?php
include('includes/config.php');
include('includes/db.php');
//include('checklogin.php');
require_once('includes/validator.php');
include('includes/checklogin.php');
$ID = $_SESSION['ID'];
$password_error = '';
$val = new validator;
$conn = connect();
$stmt = $conn->prepare("SELECT * FROM user WHERE id=?");

  // Bind a variable to the parameter as a string.
  $stmt->bind_param("i", $ID);

  // Execute the statement.
  $stmt->execute();

  // Get the variables from the query.
  $result = $stmt->get_result();


  $row = $result->fetch_assoc();
  $fname = $row['first_name'];
  $lname = $row['last_name'];
  $email = $row['email'];
  $password = $row['password'];
  $pic = $row['profile_pic'];
    $stmt->close();
    if(!empty($_POST)){
     $opass = $val->Xss_safe($_POST['opass']);
     $npass = $val->Xss_safe($_POST['npass']);
     if ($opass != $password){
       $password_error = 'Invalid Password';
       }
      if(empty($password_error)){
        $stmt = $conn->prepare("UPDATE user SET password = ? WHERE id = ?");

      // Bind the variables to the parameter as strings.
        $stmt->bind_param("si", $npass, $ID);

      // Execute the statement.
        $stmt->execute();

      // Close the prepared statement.
        $stmt->close();
        header("location:security.php?msg=success");
      }
    }

$conn->close();
?>
<html>
<head>
  <link rel = "stylesheet" type = "text/css" href = "css/security.css">
  <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
  <script type="text/javascript" language="javascript" src="js/pass_validation.js"></script>
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
echo '<br/>'.$fname.' '.$lname.'<br/><br/>';
?>
<a href = "logout.php"><button style="margin-left:29px; margin-top:7px; padding:3px 5px 3px 5px;border-radius:5%;">Sign out</button></a>
</div><br/><br/><hr/><br/>
<p id = "sidebar_heading">Profile</p>
<div class = "sidenav_link">
  <a href = "update.php" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-user.png" height ="24px"> &nbsp;My Profile</a>
  <a href = "account.php" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-setting.png" height ="24px"> &nbsp;Account Settings</a>
  <a href = "security.php" id = "active" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-lock.png" height ="24px"> &nbsp;Security</a>
  <a href = "notif_set.php" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-bell.png" height ="24px"> &nbsp;Notification Settings</a>
</div>
</div>

</div>
<div id = "main">
  <p id = "main_heading">Manage Account Security</p><hr color = "white"/>
  <div id = "content">
<form action = "" method = "post" id = "signup_form">
  <label for = "opass">Enter your current Password</label><br/>
  <input type = "password" name = "opass" required>
  <?php
  if(!empty($password_error)){
    ?>
    <span class = "error">
    <?php
    echo $password_error;
    ?>
    </span>
    <?php
  }
  ?>
  <br/><br/>
  <label for = "npass">Enter New Password</label><br/>
  <input type = "password" name = "npass" id = "form_password" required><br/>
  <span id = "password_error" class= "error_form"></span><br/>
  <label for = "cnpass">Confirm new Password</label><br/>
  <input type = "password" name = "cnpass" id = "form_cpass" required><br/>
  <span id = "cpass_error" class= "error_form"></span>
  <input type = "submit" name = "submit" class = "submit" value = "Update Password" required>
</form>
</div>
</div>
</body>
</html>
