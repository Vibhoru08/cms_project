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
  $fname = $row['first_name'];
  $lname = $row['last_name'];
  $email = $row['email'];
  $about_me = $row['about'];
  $dname = $row['display_name'];
    $stmt->close();

    if (!empty($_POST)){
      $first_name = $val->Xss_safe($_POST['fname']);
      $last_name = $val->Xss_safe($_POST['lname']);
      $display_name = $val->Xss_safe($_POST['dname']);
      $about = $val->Xss_safe($_POST['description']);
      $stmt = $conn->prepare("UPDATE user SET first_name = ?,last_name = ?,display_name = ?,about = ? WHERE id = ?");

    // Bind the variables to the parameter as strings.
      $stmt->bind_param("ssssi", $first_name, $last_name, $display_name, $about, $ID);

    // Execute the statement.
      $stmt->execute();

    // Close the prepared statement.
      $stmt->close();
      header('location:update.php?msg=success');

    }
$conn->close();
?>
<html>
<head>
  <link rel = "stylesheet" type = "text/css" href = "css/update.css">
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
  $stmt = $conn->prepare("SELECT status FROM profile_image WHERE user_id=?");
  $stmt->bind_param("i", $ID);
  $stmt->execute();
  $stmt->bind_result($status);
  $stmt->fetch();
  if ($status == '0'){
    echo "uploads/default.png";
  }
  else{
    echo "uploads/profile".$ID.".jpg";
  }
  $conn->close();
  ?>" alt="Avatar" class="avatar">
<div class = "avatar_name">
  <?php
echo '<br/>'.$fname.' '.$lname.'<br/><br/>';
?>
<a href = "logout.php"><button style="margin-left:29px; margin-top:7px; padding:3px 5px 3px 5px; border-radius :5%;">Sign out</button></a>

</div><br/><br/><hr/><br/>
<p id="sidebar_heading">Profile</p>
<div class = "sidenav_link">
  <a href = "update.php" id = "active" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-user.png" height ="24px"> &nbsp;My Profile</a>
  <a href = "account.php" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-setting.png" height ="24px"> &nbsp;Account Settings</a>
  <a href = "security.php" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-lock.png" height ="24px"> &nbsp;Security</a>
  <a href = "notif_set.php" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-bell.png" height ="24px"> &nbsp;Notification Settings</a>
</div>
</div>
</div>
<div id = "main">
  <p id= "main_heading">My Profile</p><hr color="white"/><br/>
<div class ="first_half">
  <form action = "upload.php" method = "post" enctype="multipart/form-data" class="image-upload">
  <span id="text_over_profile" style="position:absolute;float:left;left:820px;font-weight:bold;font-size:18px;top:300px;display:none;" >Click to change </span>
  <label for="file-input">
       <img height="230px" width="230px" id = "profile_pic" src='<?php
       echo "uploads/profile".$ID.".jpg";
       ?>'>

   </label>
   <input id = "file-input" name = "file_input" type="file" >
   <span id="err" > </span>

</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function (e) {
//$('#blah').hide();
$('#text_over_profile').hide();

$('#profile_pic').hover(function(){
  $('#text_over_profile').show();
  $('#profile_pic').css('opacity', '0.5');
},
function(){
  $('#text_over_profile').hide();
  $('#profile_pic').css('opacity', '1');
});



$('input[type="file"]').change(function(e) {


var data = new FormData();
data.append("file-input",$('input[type="file"]').val());

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#blah").show();
            $('#blah').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
        data.append("images[]", input.files[0]);
        $.ajax({
               url: "file_upload.php",
         type: "POST",
         data: data ,
         contentType: false,
               cache: false,
         processData:false,
         beforeSend : function()
         {
          //$("#preview").fadeOut();
          $("#err").fadeOut();
         },
         success: function(data)
            {
          if(data=='invalid')
          {
           // invalid file format.
           $("#err").html("Invalid File !").fadeIn();
          }
          else
          {
           // view uploaded file.
          // $("#image-list").html(data).fadeIn();

          }
            },
           error: function(e)
            {
          $("#err").html(e).fadeIn();
            }
          });
    }
}

readURL(this);

});
});
</script>
<div id="response"></div>
  <img id="blah" src="#" style="display:none;" type="hidden"  />
</div>
<hr color="white"/>
<div class = "second_half">
<form action = "" method="post" class ="first_half_form">
<label for = "fname">First Name</label><br/>
<input type="text" name = "fname" value = "<?php
echo $fname;
?>" required/><br/>
<label for = "lname">Last Name</label><br/>
<input type="text" name = "lname" value = "<?php
echo $lname;
?>" required/><br/>
  <label for = "dname">Public display name</label><br/>
  <input type="text" name = "dname" value = "<?php
  if(empty($dname)){
  echo $fname." ".$lname;
}
  else {
    echo $dname;
  }
  ?>" required/><br/>
  <label for="description">About Me</label><br/>
  <textarea rows = "10" column "10" name = "description"><?php
echo $about_me;
  ?></textarea><br/>
  <input type = "submit" name = "submit" class = "submit" value= "Save Details">
  </form>

</div>

</div>
</body>
</html>
