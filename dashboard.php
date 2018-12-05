<?php
include('includes/word_limiter.php');
include('includes/config.php');
include('includes/checklogin.php');
include('includes/db.php');
include('includes/validator.php');
$ID = $_SESSION['ID'];
$val = new validator;
$conn = connect();
if ($_GET['per'] == 'ap'){
  $status = 'approved';
  $stmt1 = $conn->prepare("SELECT * FROM post WHERE status=? && user_id =?");
  // Bind a variable to the parameter as a string.
  $stmt1->bind_param("si", $status, $ID);
  // Execute the statement.
  $stmt1->execute();
  $result = $stmt1->get_result();
}
elseif ($_GET['per'] == 'pe'){
  $status = "created";
  $stmt1 = $conn->prepare("SELECT * FROM post WHERE status=? && user_id = ?");
  // Bind a variable to the parameter as a string.
  $stmt1->bind_param("si", $status, $ID);
  // Execute the statement.
  $stmt1->execute();
  $result = $stmt1->get_result();
}
elseif ($_GET['per'] == 're'){
  $status = "rejected";
  $stmt1 = $conn->prepare("SELECT * FROM post WHERE status=? && user_id = ?");
  // Bind a variable to the parameter as a string.
  $stmt1->bind_param("si", $status, $ID);
  // Execute the statement.
  $stmt1->execute();
  $result = $stmt1->get_result();
}
else {
  $stmt1 = $conn->prepare("SELECT * FROM post WHERE user_id = ?");
  // Bind a variable to the parameter as a string.
  $stmt1->bind_param("i", $ID);
  // Execute the statement.
  $stmt1->execute();
  $result = $stmt1->get_result();
}

?>
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel = "stylesheet" type = "text/css" href = "css/dashboard.css">
  <title>Dashboard | Start writing</title>
  </head>
<body>
  <div class="topnav" id="myTopnav">
  <a href="#" class="tn-small" title = "See your sites here"><img src = "images/nav-home.png" height = "26px"/></a>
  <a href="reader.php" class="tn-small" title = "Sites that you follow"><img src = "images/nav-reader.png" height = "26px"/></a>
    <a href="#" class="tn-small" style="float:right; margin-right:25px;" title = "See your notifications here"><img src = "images/nav-bell.png" height = "26px"/></a>
    <a href="update.php" class = "tn-small" style="float:right;" title = "Edit your profile here"><img src = "images/nav-user.png" height = "26px"/></a>
  <a href="add_post.php" class="tn-small" style="float:right;"><img src = "images/nav-add.png" height = "26px"/></a>


  </div>
  <div class="sidenav">
    <p id = "sidenav_heading">My Posts</p>
  <div class = "sidenav_link">
    <a href = "dashboard.php?per=ap" class = "sidenav_link"><img class = "sidenav_icon" src = "images/approve.png" height ="18px"> &nbsp;Approved</a>
    <a href = "dashboard.php?per=pe" class = "sidenav_link"><img class = "sidenav_icon" src = "images/pending.png" height ="18px"> &nbsp;Pending</a>
    <a href = "dashboard.php?per=re" class = "sidenav_link"><img class = "sidenav_icon" src = "images/reject.png" height ="18px"> &nbsp;Rejected</a>
    
  </div>
  </div>
  <div id = "main">
    <div id = "content2">
    <form>
     <input type="text" placeholder="Search from EasyWeb posts..." name="search">
    <button type="submit"><i class="fa fa-search"></i></button>
   </form>
  </div>
  <?php if($result->num_rows == 0){
    ?>
    <div id = "no_post_message">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There are no posts under this category.
    </div>
  <?php
   }else{
   ?>
    <hr color = "#aff7f0" id = "searchr"/>
    <?php
    while ($row = $result->fetch_assoc()){
     $post_id = $row['id'];
    ?>
  <div id = "content3">
        <img src = "<?php 
        $user_id = $row['user_id'];
        $stmt = $conn->prepare("SELECT * FROM user WHERE id=?");

      $stmt->bind_param("i", $user_id);
      $stmt->execute();
      $result1 = $stmt->get_result();
      $row1 = $result1->fetch_assoc();
      $pic = $row1["profile_pic"];
      $name = $row1["display_name"];

        if($pic == ""){
         echo "images/img_avatar.png";
       }
       else{
         echo "uploads/$pic";
       }?>" id = "profile_pic">
      <span id ="profile_name"><a style= "text-decoration:none;" href = "profile.php?id=<?php echo $row['user_id']; ?>"><?php
      echo $name;
       ?></a><br/><img src= "images/tag.png" id = "tag"><span id = "tags"><?php echo $row['category']; ?></span></span>
    </div>
    <div id = "content4">
    <img src = '<?php 
    $ppic = $row['post_pic'];
    if ($ppic == ""){
      echo "images/signup-image2.jpg";
    }
    else{
      echo "uploads/small".$ppic;
    }   
    ?>' id = "post_pic"/>
    <div id = "post_info"><span id = "post_title">
      <?php
      echo $row['title'];
       ?></span><a href = "#" id = "<?php echo $post_id; ?>"></a><br/>
<?php
$description = $row['description'];
$linkl = 'post.php?id='.$post_id;
$rdes = limit_text($description,40,$linkl);
echo $rdes;
?>
      <br/>
        <a style="text-decoration:none;" href = "post.php?id=<?php
echo $post_id;
        ?>"><img src = "images/visit.png" id = "visit"><span style= "font-size:13px;margin-left:3px;color:#C36CEE">Visit</span></a>
        <img src = "images/chat.png" id = "comment">
        <img src = "images/star.png" id = "star">
    </div>
    </div>
    <hr id = "post" color = "#aff7f0"/>
    <?php
}
$stmt1->close();
$conn->close();
    ?>
  </div>
<?php
   }
?>
</body>
</html>
