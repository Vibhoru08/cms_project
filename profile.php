<?php
include('includes/config.php');
include('includes/checklogin.php');
include('includes/db.php');
include('includes/validator.php');
include('includes/word_limiter.php');
$val = new validator;
$user_id = $val->Xss_safe($_GET['id']);
$conn = connect();
$stmt1 = $conn->prepare("SELECT * FROM user WHERE id=?");
// Bind a variable to the parameter as a string.
$stmt1->bind_param("i", $user_id);
 // Execute the statement.
$stmt1->execute();
$result = $stmt1->get_result();
$row = $result->fetch_assoc();
$dname = $row['display_name'];
$fname = $row['first_name'];
$lname = $row['last_name'];
$about = $row['about'];
$stmt1->close();
$stmt2 = $conn->prepare("SELECT * FROM post WHERE user_id=?");
$stmt2->bind_param("i", $user_id);
$stmt2->execute();
$result = $stmt2->get_result();
$nop = $result->num_rows;
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
  <title>EazyWeb | View Profile</title>
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
  <div class="row mb-2" >
    <div class="col-md-12" >
      <div style="background-color:white;padding:20px 0px 1px 0px;">
        <img class="rounded-circle mx-auto d-block" src="images/profile<?php echo $user_id;?>.jpg" style="height:200px;">
        <p style="text-align:center;font-size:25px;font-family:Verdana;margin-top:14px;color:blue;"><?php echo $dname; ?></p>
      </div>
    </div>
  </div>

  <div class="row mt-2" >
    <div class="col-md-4 pr-1" >
      <div class="sticky-top">
      <div  style="background-color:white;padding:20px;min-height:100vh;">
        <div style="width:80%;position:relative;left:3%;">
          <button type="button" class="btn btn-primary float-right" style="margin-right:20px;"> FOLLOW </button>
          <button type="button" class="btn btn-primary float-left" style="margin-right:20px;"> INVITE </button>
        </div>
        <br>
        <br>
         <table class="table table-hover" style="padding:10px;">
           <tbody>
             <tr>
               <td>Name </td>
               <td><?php echo $fname.' '.$lname; ?></td>
             </tr>
             <tr>
               <td>About Me</td>
               <td><?php echo $about; ?></td>
             </tr>
             <tr>
               <td>Numbers of Followers</td>
               <td>6</td>
             </tr>
             <tr>
               <td> Total Posts</td>
               <td><?php echo $nop; ?></td>
             </tr>
           </tbody>
         </table>
         </div>
       </div>
    </div>
    <div class="col-md-8 pl-1" >
      <div class="ml-0" style="background-color:white;padding:20px;min-height:100%;">
      <?php
      while($row = $result->fetch_assoc()){
      ?>
        <div>
          <span style = "color:blue;font-family:Courier;font-size:22px;font-weight:bold;"><?php echo $row['title']; ?></span>
        </div>
        <br>
        <div>
        <span style="font-family:arial;color:green;font-size:17px;">
        <?php
        $post_id = $row['id'];
        $description = $row['description'];
        $linkl = 'post.php?id='.$post_id;
        $rdes = limit_text($description,40,$linkl);
        echo $rdes;
        ?>
        </span>
        </div>
        <hr style="color:blue;">
      <?php }
      $stmt2->close();
      $conn->close();
      ?>
      </div>
    </div>
  </div>
</div>



</body>
</html>
