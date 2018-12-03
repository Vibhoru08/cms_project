<?php
include('includes/config.php');
include('includes/checklogin.php');
?>
<html>
<head>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel = "stylesheet" type = "text/css" href = "css/dashboard.css">
  <title>PROFILE</title>
  </head>
<body style="background-color:grey;">
  <div class="topnav" id="myTopnav">
  <a href="dashboard.php" class="tn-small" title = "See your sites here"><img src = "images/nav-home.png" height = "26px"/></a>
  <a href="reader.php" class="tn-small" title = "Sites that you follow"><img src = "images/nav-reader.png" height = "26px"/></a>
    <a href="#" class="tn-small" style="float:right; margin-right:25px;" title = "See your notifications here"><img src = "images/nav-bell.png" height = "26px"/></a>
    <a href="update.php" class = "tn-small" style="float:right;" title = "Edit your profile here"><img src = "images/nav-user.png" height = "26px"/></a>
  <a href="add_post.php" class="tn-small" style="float:right;"><img src = "images/nav-add.png" height = "26px"/></a>


  </div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div style="background-color:white;padding:20px;">
        <img class="rounded-circle mx-auto d-block" src="images/img_avatar.png" style="height:300px;width:300px;">
      </div>
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-md-4 " >
      <div  style="background-color:white;padding:20px;height:100%;">
        <button type="button" class="btn btn-primary float-right" style="margin-right:20px;"> FOLLOW </button>
         <div style="margin-left:15px;" >Intro</div>
         <br>
         <table class="table table-hover" style="padding:10px;">
           <tbody>
             <tr>
               <td>Name </td>
               <td> php </td>
             </tr>
             <tr>
               <td>Followers</td>
               <td>php </td>
             </tr>
             <tr>
               <td> Total Posts</td>
               <td>php </td>
             </tr>
           </tbody>
         </table>
         </div>
    </div>
    <div class="col-md-8" >
      <div class="ml-0" style="background-color:white;padding:20px;min-height:100%;">
      All the posts go here.
      Php for posts here.
      </div>
    </div>
  </div>
</div>



</body>
</html>
