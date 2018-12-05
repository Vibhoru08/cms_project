<?php
include('includes/config.php');
include('includes/db.php');
//include('checklogin.php');
require_once('includes/validator.php');
include('includes/checklogin.php');
include('test/upload.php');
$val = new validator;
$title_error = '';
$description_error = '';
$cat_error = '';
$ID = $_SESSION['ID'];
if (!empty($_POST)){
    $title = $val->Xss_safe($_POST['title']);
    $description = $val->Xss_safe($_POST['description']);
    $cat = $val->Xss_safe($_POST['category']);

    if (empty($title)){
        $title_error = "*Title is required.";
    }
    if (empty($description)){
        $description_error = "*Description is required.";
    }
    if (empty($cat)){
       $cat_error = "*Assign a category.";
    }


      if (empty($title_error) && empty($description_error) && empty($cat_error)){


        //$Aid = $_SESSION['AID'];
        $conn= connect();
        $stmt = $conn->prepare("INSERT INTO post (user_id,title,description,category,post_pic) VALUES (?, ?,?,?,?)");

        // Bind the variables to the parameter as strings.
        $stmt->bind_param("issss",$ID,$title,$description,$cat,$filename);

        // Execute the statement.
       $stmt->execute();

       // Close the prepared statement.
       $stmt->close();
       header("location:add_post.php?msg=add_success");
       exit();
       $conn->close();
        }
        }




?>
<html>
<head>
  <link rel = "stylesheet" type = "text/css" href = "css/add_post.css">
  <title> Create post | Add a post to your website</title>
  <script src = "ckeditor/ckeditor.js"></script>
  </head>
<body>
  <div class="topnav" id="myTopnav">
  <a href="dashboard.php" class="tn-small" title = "See your sites here"><img src = "images/nav-home.png" height = "26px"/></a>
  <a href="reader.php" class="tn-small" title = "Sites that you follow"><img src = "images/nav-reader.png" height = "26px"/></a>
    <a href="#" class="tn-small" style="float:right; margin-right:25px;" title = "See your notifications here"><img src = "images/nav-bell.png" height = "26px"/></a>
    <a href="update.php" class = "tn-small" style="float:right;" title = "Edit your profile here"><img src = "images/nav-user.png" height = "26px"/></a>
  <a href="add_post.php" class="tn-small" style="float:right;" title = "Write a new post"><img src = "images/nav-add.png" height = "26px"/></a>


  </div>
  <div id = "main">
    <h1>Create New Post</h1>
  <div id = "content">
  <form action = "" method = "post" enctype = "multipart/form-data">
  <label for = "title">Title</label><br/>
  <input type = "text" name = "title" placeholder = "Give a title">
    <?php
    if(!empty($title_error)){
      ?>
      <span class = "error">
      <?php
      echo '<br/>'.$title_error.'<br/>';
      ?>
      </span>
      <?php
    }
    ?><br/>
  <label for = "description">Description</label><br/>
  <textarea class = "ckeditor" rows = "15" name = "description" placeholder = "Description for the post"></textarea>
      <?php
      if(!empty($description_error)){
        ?>
        <span class = "error">
        <?php
        echo '<br/>'.$description_error.'<br/>';
        ?>
        </span>
        <?php
      }
      ?>

    <div id = "category">
      <label for = "category">Category &nbsp;&nbsp;&nbsp;&nbsp;-</label>&nbsp;&nbsp;&nbsp;&nbsp;
      <select name = "category">
      <option value = "" selected>----Choose An Option----</option>
      <option value = "sports">Sports</option>
      <option value = "politics">Politics</option>
      <option value = "entertainment">Entertainment</option>
      <option value = "art">Art</option>
      <option value = "literature">Literature</option>
      <option value = "science">Science</option>      
      </select>
      <!--<input type = "radio" name = "category" value = "cat1" class="radio_table"> &nbsp;Category 1
        &nbsp; <input type = "radio" name = "category" value = "cat2" class="radio_table"> &nbsp;Category 2 &nbsp;&nbsp;&nbsp;
        <input type = "radio" name = "category" value = "cat3" class="radio_table"> &nbsp;&nbsp;&nbsp;
        Category 3-->

      </div>
      <?php
      if(!empty($cat_error)){
        ?>
        <span class = "error">
        <?php
        echo '<br/>'.$cat_error.'<br/><br/>';
        ?>
        </span>
        <?php
      }
      ?>
      <div id = "upload">
      <span id = "upload_text">Upload An Image&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp; </span><input type = "file" name = "upload" required>
    </div>
        <div id = "submit_button">
        <input type = "submit" name = "submit" class="submit" value = "Publish">
</div>
</form>
</div>
</div>
</body>
</html>
