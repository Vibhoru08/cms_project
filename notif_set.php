<?php
include('includes/config.php');
include('includes/db.php');
//include('checklogin.php');
require_once('includes/validator.php');
include('includes/checklogin.php');
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
  $fname = $row['first_name'];
  $lname = $row['last_name'];
  $email = $row['email'];
  $pic= $row['profile_pic'];
    $stmt->close();
$conn->close();
?>
<html>
<head>
  <link rel = "stylesheet" type = "text/css" href = "css/notif_set.css">
  <title>Update Profile | Alter profile details</title>
  </head>
<body>
  <div class="topnav" id="myTopnav">
  <a href="dashboard.php" class="tn-small" title = "See your sites here"><img src = "images/nav-home.png" height = "26px"/></a>
  <a href="reader.php" class="tn-small" title = "Sites that you follow"><img src = "images/nav-reader.png" height = "26px"/></a>
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
<p id="sidebar_heading">Profile</p>
<div class = "sidenav_link">
  <a href = "update.php" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-user.png" height ="24px"> &nbsp;My Profile</a>
  <a href = "account.php" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-setting.png" height ="24px"> &nbsp;Account Settings</a>
  <a href = "security.php" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-lock.png" height ="24px"> &nbsp;Security</a>
  <a href = "notif_set.php" id = "active" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-bell.png" height ="24px"> &nbsp;Notification Settings</a>
</div>
</div>

</div>
<div id = "main">
<p class= "main_heading" style="margin-left: 215px; font-size : 25px; font-family: century gothic; font-weight : 520;">Control Your Notification Settings</p>
<hr color = "white" width = "90%" />
<div id = "heading"><span id = "heading-text">Notification</span><img class = "main_icon" src = "images/main-bell.png" height ="24px">
</div>
<hr width= "90%" color = "white"/>
<div id = "content">
<form action = "" method = "post">
<div id = "first_line"><span id = "first_line_text">Comments</span><input class = "comment_check" type = "checkbox" name = "notif[]" value = "comments">
</div>
<div id = "second_line"><span id = "second_line_text">Upvotes</span> <input class = "upvote_check" type = "checkbox" name = "notif[]" value = "upvotes">
</div>
<div id = "third_line"><span id = "third_line_text">Downvotes</span> <input class = "downvote_check" type = "checkbox" name = "notif[]" value = "downvotes">
</div>
<div id = "fourth_line">
<input type = "submit" name = "submit" class= "submit" value = "Save Changes">
</div>
</form>
</div>
</div>
</body>
</html>
