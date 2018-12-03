<?php
include('includes/config.php');
include('includes/checklogin.php');
?>
<html>
<head>
  <link rel = "stylesheet" type = "text/css" href = "css/dashboard.css">
  <title>PROFILE</title>
  </head>
<body>
  <div class="topnav" id="myTopnav">
  <a href="dashboard.php" class="tn-small" title = "See your sites here"><img src = "images/nav-home.png" height = "26px"/></a>
  <a href="reader.php" class="tn-small" title = "Sites that you follow"><img src = "images/nav-reader.png" height = "26px"/></a>
    <a href="#" class="tn-small" style="float:right; margin-right:25px;" title = "See your notifications here"><img src = "images/nav-bell.png" height = "26px"/></a>
    <a href="update.php" class = "tn-small" style="float:right;" title = "Edit your profile here"><img src = "images/nav-user.png" height = "26px"/></a>
  <a href="add_post.php" class="tn-small" style="float:right;"><img src = "images/nav-add.png" height = "26px"/></a>


  </div>
<div style="margin:0.5% 0 0 40%;">
  <div id="p_profile_pic" >
    <img src="" alt="image" style="width:100px;height:100px;margin:2px;float:left">


    <div id="p_no_followers" style="float:left;max-height:40px;margin:20px;">
      no of followers
    </div>
    <div id='p_no_posts' style="float:left;max-height:40px;margin:20px;">
      no of posts
    </div>

    <div id="p_follow" style="float:left;max-height:40px;margin:20px;">
    Follow
    </div>
</div>
<br>
<div id="p_name" style="clear:both;">
  name
</div>
<div>
  About writer
</div>
</div>
<div>
All the Posts go here


</div>
</body>
</html>
