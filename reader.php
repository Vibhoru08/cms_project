<?php
include('includes/word_limiter.php');
include('includes/config.php');
include('includes/checklogin.php');
include('includes/db.php');
include('includes/validator.php');
$ID = $_SESSION['ID'];
$val = new validator;
$conn = connect();
$status = "approved";
$stmt1 = $conn->prepare("SELECT * FROM post WHERE status=? && user_id != ?");

 // Bind a variable to the parameter as a string.
 $stmt1->bind_param("si", $status, $ID);

 // Execute the statement.
 $stmt1->execute();
 $result = $stmt1->get_result();


?>
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel = "stylesheet" type = "text/css" href = "css/reader.css">
  <title>Dashboard | Start writing</title>
  </head>
<body>
  <div class="topnav" id="myTopnav">
  <a href="dashboard.php" class="tn-small" title = "See your sites here"><img src = "images/nav-home.png" height = "26px"/></a>
  <a href="#" class="tn-small" title = "Sites that you follow"><img src = "images/nav-reader.png" height = "26px"/></a>
    <a href="#" class="tn-small" style="float:right; margin-right:25px;" title = "See your notifications here"><img src = "images/nav-bell.png" height = "26px"/></a>
    <a href="update.php" class = "tn-small" style="float:right;" title = "Edit your profile here"><img src = "images/nav-user.png" height = "26px"/></a>
  <a href="add_post.php" class="tn-small" style="float:right;"><img src = "images/nav-add.png" height = "26px"/></a>


  </div>
  <div class="sidenav">
    <p id = "sidenav_heading">Categories</p>
  <div class = "sidenav_link">
    <a href = "update.php" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-user.png" height ="24px"> &nbsp;Sports</a>
    <a href = "account.php" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-setting.png" height ="24px"> &nbsp;Entertainment</a>
    <a href = "security.php" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-lock.png" height ="24px"> &nbsp;Politics</a>

<p id = "sidenav_heading2">Following</p>
<div class = "sidenav_link">
  <a href = "update.php" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-user.png" height ="24px"> &nbsp;XXX</a>
  <a href = "account.php" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-setting.png" height ="24px"> &nbsp;YYY</a>
  <a href = "security.php" class = "sidenav_link"><img class = "sidenav_icon" src = "images/side-lock.png" height ="24px"> &nbsp;ZZZ</a>
</div>
  </div>
  </div>
  <div id = "main">
    <div id = "content1">
      <h4> Sort By </h4>
      <hr color = "white" id = "sort"/>
    <div id = "content1_a">
    <span id = "upvotes" class= "content1_b">Upvotes</span><span id = "division">|</span><span id = "recent" class= "content1_a">Recent</span><span id = "division">|</span><span id = "oldest" class= "content1_c">Oldest</span>
  </div>
    </div>
    <div id = "content2">
      <form>
    <input type="text" placeholder="Search from EasyWeb posts..." name="search">
      <button type="submit"><i class="fa fa-search"></i></button>

    </form>

  </div>

    <hr color = "#aff7f0" id = "searchr"/>
    <?php
    while ($row = $result->fetch_assoc()){
     $post_id = $row['id'];
    ?>
  <div id = "content3">
        <img src = "uploads/default.png" id = "profile_pic">
      <span id ="profile_name"><?php
      $user_id = $row['user_id'];


      $stmt = $conn->prepare("SELECT display_name FROM user WHERE id=?");

      $stmt->bind_param("i", $user_id);
      $stmt->execute();
      $stmt->bind_result($name);
      $stmt->fetch();
      $stmt->close();


       echo $name;
       ?><br/><img src= "images/tag.png" id = "tag"><span id = "tags"><?php echo $row['category']; ?></span></span>
    </div>
    <div id = "content4">
    <img src = "images/signup-image2.jpg" id = "post_pic"/>
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




</body>
</html>