<?php
include('includes/config.php');
include('includes/db.php');
include('includes/validator.php');

if(!empty($_SESSION['ID'])){

header("location:dashboard.php");
exit();
}
$val = new validator;
$username_error = '';
$email_error= '';
$cap_error= '';

if (!empty($_POST)){
    $username = $val->Xss_safe($_POST['username']);
    $email = $val->Xss_safe($_POST['email']);
    $password = $val->Xss_safe($_POST['psw']);
    $cpassword =$val->Xss_safe($_POST['cpsw']);
    $fname = $val->Xss_safe($_POST['fname']);
    $lname = $val->Xss_safe($_POST['lname']);
    $cap = $val->Xss_safe($_POST['captcha']);
    $conn = connect();
     $stmt = $conn->prepare("SELECT * FROM user WHERE username=?");

      // Bind a variable to the parameter as a string.
      $stmt->bind_param("s", $username);

      // Execute the statement.
      $stmt->execute();
      $result = $stmt->get_result();






    /*$sql = "SELECT * FROM admin where email ='".$Email."'";
    $result = $conn->query($sql);*/
    if ($result->num_rows >= 1) {
      $username_error = "Username already taken";
      $conn->close();
    }
    $conn = connect();
     $stmt = $conn->prepare("SELECT * FROM user WHERE email=?");

      // Bind a variable to the parameter as a string.
      $stmt->bind_param("s", $email);

      // Execute the statement.
      $stmt->execute();
      $result = $stmt->get_result();






    /*$sql = "SELECT * FROM admin where email ='".$Email."'";
    $result = $conn->query($sql);*/
    if ($result->num_rows >= 1) {
      $email_error = "Email already registered";
      $conn->close();
    }
    if (!empty($cap)){
      if( $cap == $_SESSION['cap']){

      }
      else {
        $cap_error = 'Captcha does not match';
      }

    }


      if (empty($username_error) && empty($email_error) && empty($cap_error)){


        $conn= connect();
        $stmt = $conn->prepare("INSERT INTO user (first_name,last_name,username,email,password) VALUES (?,?,?, ?, ?)");

        // Bind the variables to the parameter as strings.
        $stmt->bind_param("sssss",$fname,$lname,$username,$email,$password);

        // Execute the statement.
       $stmt->execute();

       // Close the prepared statement.
       $last_id = $conn->insert_id;
       $stmt->close();
       $_SESSION['ID'] = $last_id;
       $_SESSION['username'] = $username;
       header("location:dashboard.php?");

       $stmt = $conn->prepare("INSERT INTO profile_image (user_id) VALUES (?)");

       // Bind the variables to the parameter as strings.
       $stmt->bind_param("i",$last_id);

       // Execute the statement.
      $stmt->execute();

      // Close the prepared statement.
      $stmt->close();


       $conn->close();
       exit();


        }

      }



?>
<html>
<head>
  <link rel = "stylesheet" type = "text/css" href = "css/signup.css">
  <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
  <script type="text/javascript" language="javascript" src="js/form_validation.js"></script>
  <title>Create account | Get started to make your own website.</title>
</head>
<body>
<div class="bg-img">
  <div class="topnav" id="myTopnav">
  <a href="welcome.php" class="tn-big">EasyWeb.com</a>
  <a href="support.php" class="tn-big" >Support</a>
  <a href="signup.php" class = "tn-big" style="float:right;">Get started</a>
  <a href="login.php" class="tn-big" style="float:right;">Login</a>
</div>
  <form action="" method = "post" id = "signup_form">
    <div class="container">
      <label for="fname"><b>First Name</b></label>
      <input type="text" placeholder="Enter your first name" name="fname" Value = "<?php
    echo $fname;
    ?>" required><br/><br/>
      <label for="lname"><b>Last Name</b></label>
      <input type="text" placeholder="Enter your last name" name="lname" Value = "<?php
    echo $lname;
    ?>" required><br/><br/>

      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="Enter desired username" name="username" id = "form_username" Value = "<?php
    echo $username;
    ?>" required>
      <span id = "username_error" class= "error_form"></span>
      <?php
      if(!empty($username_error)){
        ?>
        <span class = "error">
        <?php
        echo $username_error;
        ?>
        </span>
        <?php
      }
      ?>
      <br/><br/>
      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter your Email" name="email" id = "form_email" Value = "<?php
    echo $email;
    ?>" required>
      <span id = "email_error" class= "error_form"></span>
      <?php
      if(!empty($email_error)){
        ?>
        <span class = "error">
        <?php
        echo $email_error;
        ?>
        </span>
        <?php
      }
      ?>
      <br/><br/>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter desired password" name="psw" id = "form_password" required>
      <span id = "password_error" class= "error_form"></span><br/><br/>
      <label for="cpsw"><b>Confirm Password</b></label>
      <input type="password" placeholder="Confirm your password" name="cpsw" id = "form_cpass" required>
      <span id = "cpass_error" class= "error_form"></span><br/><br/>
      <img src="cap.php"/ style="margin: 0px 0px 0px 0px;" height="38px;"><input type = "text" placeholder = "Enter captcha here" name = "captcha" style="width: 67%;padding: 10px;
      margin: 0px 0px 0px 0px; position :relative; left: 16px; bottom :14px;" required>
      <?php
      if(!empty($cap_error)){
        ?>
        <span class = "error">
        <?php
        echo $cap_error;
        ?>
        </span>
        <?php
      }
      ?>


      <input type="submit" class="btn" value = "Register">
    </div>
  </form>
</div>
</body>
</html>
