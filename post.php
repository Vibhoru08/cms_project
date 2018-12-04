<?php
include('includes/config.php');
include('includes/checklogin.php');
include('includes/validator.php');
include('includes/db.php');
include('functions/time_ago.php');
date_default_timezone_set('Asia/Kolkata');
$val = new validator;
$MID = $_SESSION['ID'];
$ID = $val->Xss_safe($_GET['id']);
$conn = connect();
if(!empty($_POST)){
  $comment = $val->Xss_safe($_POST['com']);
  $date = date("Y-m-d H:i:s");
  $stmt = $conn->prepare("INSERT INTO comment (post_id,member_id,comment,date) VALUES (?,?,?,?)");
  $stmt->bind_param("iiss",$ID,$MID,$comment,$date);
  $stmt->execute();
  $stmt->close();

}

$stmt = $conn->prepare("SELECT * FROM post WHERE id=?");

$stmt->bind_param("i", $ID);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$user_id = $row['user_id'];
$title = $row['title'];
$description = $row['description'];
$category = $row['category'];
$stmt->close();
$stmt = $conn->prepare("SELECT display_name FROM user WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name);
$stmt->fetch();
$stmt->close();

?>
<html>
<head>
<!--  <link rel = "stylesheet" type = "text/css" href = "css/post.css">-->
  <title></title>
  <style>
  body, html{

  padding: 0px;
  margin: 0px;
  }
  .topnav {
      background-color: #556B2F;
      overflow: hidden;
      z-index: 1;
      position: relative;
  }

  /* Style the links inside the navigation bar */
  .topnav a {
      float: left;
      display: block;
      color: #f2f2f2;
      text-align: center;
      padding: 13px 25px 13px 25px;
      text-decoration: none;
      font-size: 15px;
      font-family:cursive;
  }

  /* Change the color of links on hover */
  .topnav a:hover {
      background-color:  #ddd;
      color: black;
      height: 26px;
  }
  a.tn-small{
      font-size: 15px;
      margin-top: ;
  }
  a.tn-big{
    font-weight: 550px;
  }

  /* Add an active class to highlight the current page */


  /* Hide the link that should open and close the topnav on small screens */

  /* When the screen is less than 600 pixels wide, hide all links, except for the first one ("Home"). Show the link that contains should open and close the topnav (.icon) */
  @media screen and (max-width: 600px) {
    .topnav a:not(:first-child) {display: none;}
    .topnav a.icon {
      float: right;
      display: block;
    }
  }

  /* The "responsive" class is added to the topnav with JavaScript when the user clicks on the icon. This class makes the topnav look good on small screens (display the links vertically instead of horizontally) */
  @media screen and (max-width: 600px) {
    .topnav.responsive {position: relative;}
    .topnav.responsive a.icon {
      position: absolute;
      right: 0;
      top: 0;
    }
    .topnav.responsive a {
      float: none;
      display: block;
      text-align: center;
    }
  }
  .sidenav {
    height: 100%;
    width: 520px;
    z-index: 0;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #ffffff;
    overflow-x: hidden;
    padding-top: 20px;
}


@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}
#back{
  margin-top : 50px;
  margin-left: 15px;
}
#profile_info{
  margin-top : 80px;
  margin-left: 260px;
  font-family: Arial;
  font-size: 20px;
  font-weight: bold;
  color : #014bc1;
  line-height: 150%;
}
#profile_image{
  height: 130px;
  border-radius: 50%;
}
#follower{
  top: 10px;
  right: 15px;
  position: relative;
  font-size: 16px;
  font-family: Arial;
  font-weight: lighter;
}
#follow{
  text-decoration: none;
  font-size: 16px;
  color : green;
  font-family: Arial;
  font-weight: link;
  position: relative;
  top: 15px;
  left: 33px;
}
#main{
  width: calc(100% - 800px);
  float:right;
  right: 220px;
  position: relative;
  background-color: #F4FAFB;
  padding-left: 80px;
  padding-right: 30px;
  padding-bottom: 30px;
}
#title{
  font-size : 35px;
  margin-top: 50px;
  font-family: century gothic;
  color: #001538;
}
#description{
  font-size: 18px;
  margin-top: 40px;
  font-family: Arial;
  line-height: 130%;
  color: #138401;
}
#tag{
  margin-top: 10px;
  font-size: 20px;
  font-family: Times New roman;
  color: #72a1ea;
}
#tag_img{
  height: 17px;
  position: relative;
  top: 2.5px;
  margin-right: 5px;
}
.back_arrow{
  height: 50px;
}
#comments{
  width: calc(100% - 800px);
  float:right;
  right: 220px;
  position: relative;
  background-color: #FFFFFF;
  padding-left: 80px;
  padding-right: 30px;
  padding-bottom: 30px;
}
#comment{
  width: 97.5%;
  background-color: #FFEBCD;
  margin-top: 16px;
  padding-top: 10px;
  padding-bottom: 10px;
  padding-left: 10px;
  padding-right: 10px;

}
#comment_field{
  margin-top: 35px;
  background-color: #95f993;
  padding-left:14px;
  padding-top: 14px;
  padding-bottom:0.08px;
  padding-right: 8px;

}
#comment_img{
  height : 40px;
  border-radius: 50%;
  float: left;
  margin-top: 3px;
  margin-right: 15px;
  }
#comment_t{
  font-size: 17px;
  float:left;
  font-family: cursive;

}
hr{
  margin-top: 8px;
  margin-bottom: 8px;
  }
#comment_c{
  font-family: Arial;
  font-size:16px;
  text-align: justify;
  color: #800000;
}
#comment_time{
  font-family: Arial;
  float:right;
  font-size: 14px;
  color: #4286f4;
  position: relative;
  top: 6px;
}
input[type = text]{
  width: 510px;
  padding: 12px 20px;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;

}
.submit{
  width: 100px;
  height: 41px;
  font-family: Arial;
  background-color: #3aaf38; /* Green */
  border: none;
  color: white;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 20px;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
  cursor: pointer;
  margin-left: 15px;
  top:2px;
  position:relative;
  border-radius: 5%;
}
.submit:hover{
background-color: #5cd15c;
color: white;
}
h1{
  font-family: century gothic;
  margin-bottom: 30px;
}
#edit{
  margin-right: 20px;
  font-size: 16px;
  color: #014bc1
}
#delete{
  font-size: 16px;
  color: #014bc1;
}
#reply{
  font-size: 16px;
  color: #014bc1;
}
  </style>
  </head>
<body>
  <div class="topnav" id="myTopnav">
  <a href="dashboard.php" class="tn-small" title = "See your sites here"><img src = "images/nav-home.png" height = "26px"/></a>
  <a href="reader.php" class="tn-small" title = "Sites that you follow"><img src = "images/nav-reader.png" height = "26px"/></a>
    <a href="#" class="tn-small" style="float:right; margin-right:25px;" title = "See your notifications here"><img src = "images/nav-bell.png" height = "26px"/></a>
    <a href="update.php" class = "tn-small" style="float:right;" title = "Edit your profile here"><img src = "images/nav-user.png" height = "26px"/></a>
  <a href="add_post.php" class="tn-small" style="float:right;"><img src = "images/nav-add.png" height = "26px"/></a>
  </div>
  <div class="sidenav">
    <div id = "back">
    <a href = "reader.php#<?php echo $ID;?>"><img src = "images/back.png" class = "back_arrow"></a>
    </div>
   <div id = "profile_info">
     <img src = "images/profile<?php echo $user_id; ?>.jpg" alt = "avatar" id = "profile_image"><br/>
<a style="text-decoration:none;" href = "profile.php?id=<?php echo $user_id; ?>"><?php
echo '<br/>'.$name.'</a><br/><span id ="follower">X number of followers</span>';
?>
<br/>
<a id = "follow" href = "#">Follow</a>
   </div>
</div>
<div id = "main">
<div id = "title">
<?php
echo $title.'<br/>';
?>
</div>
<div id = "tag">
<img src = "images/tag.png" id = "tag_img"><?php
echo $category;
?>
</div>
<div id = "description">
<?php
echo $description.'<br/>';
?>
</div>
</div>
<div id = "comments">

<?php
$stmt = $conn->prepare("SELECT * FROM comment WHERE post_id=? ORDER BY id desc");

$stmt->bind_param("i", $ID);
$stmt->execute();
$result = $stmt->get_result();
$noc = $result->num_rows;
?>
<h1> Comments (<?php echo $noc; ?>)</h1>
<?php
if ($result->num_rows == 0){
  echo '<span style= "font-family:Arial;">Be the first to leave a comment.</span>';
}
else{
  while ($row = $result->fetch_assoc()){
    $comment = $row['comment'];
    $mem_id = $row['member_id'];
    $date_comment = $row['date'];
    $stmt2 = $conn->prepare("SELECT * FROM user WHERE id =?");
    $stmt2->bind_param("i", $mem_id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $row2 = $result2->fetch_assoc();
    $dname = $row2['display_name'];
    $fname = $row2['first_name'];
    $lname = $row2['last_name'];
    $stmt2->close();
 ?>
<div id = "comment">
<span id = "comment_t"><?php
if (!empty($dname)){
  echo '<a href = "profile.php?id='.$mem_id.'" style = "text-decoration:none;">'.$dname.'</a>';
}
else{
  $fullname = $fname." ".$lname;
echo '<a href = "profile.php?id=$mem_id" style = "text-decoration:none;">'.ucwords("$fullname").'</a>';
}
?></span>
<span id = "comment_time"><?php
$date_comment_ago = timeago($date_comment);
echo $date_comment_ago;
?></span>

<br/><hr color = "white"/>
<?php
echo '<span id = "comment_c">'.$comment.'</span>';
?>
<br/><hr color = "white"/>
<?php
if($MID == $mem_id){
  echo "<span id = 'edit'>Edit</span>";
  echo "<span id = 'delete'>Delete</span>";
  }
else{
  echo "<span id = 'reply'>Reply";
}
?>
</div>
   <?php
  }
}
$stmt->close();
$conn->close();
?>
<br/>
<div id = "comment_field">
<image src = "images/profile<?php echo $MID;?>.jpg" id = "comment_img">
<form action = "" method = "post">
  <input type = "text" name = "com" required>
  <input type = "submit" class = "submit" value = "Comment">
</form>
</div>
</div>

</body>
</html>
