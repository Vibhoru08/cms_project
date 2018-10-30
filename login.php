<?php
include('includes/config.php');
include('includes/db.php');

require_once('includes/validator.php');
if(!empty($_SESSION['ID'])){

header("location:dashboard.php");
exit();
}
$username_error = '';
$password_error = '';
$val = new validator();
if (!empty($_POST)){
$uname = $val->Xss_safe($_POST['uname']);
$psw = $val->Xss_safe($_POST['psw']);
$conn = connect();
 $stmt = $conn->prepare("SELECT * FROM user WHERE username=?");

  // Bind a variable to the parameter as a string.
  $stmt->bind_param("s", $uname);

  // Execute the statement.
  $stmt->execute();
  $result = $stmt->get_result();






/*$sql = "SELECT * FROM admin where email ='".$Email."'";
$result = $conn->query($sql);*/
if ($result->num_rows == 0) {
  $username_error = "Username not found";
  $conn->close();
}
else {
  $row = $result->fetch_assoc();
  $npass = $row['password'];
  if ($npass == $psw){
    $conn->close();
  }
  else{
    $password_error = "Invalid Password";
    $conn->close();
    }
    $stmt->close();

}




if(empty($username_error) && empty($password_error)){
  $_SESSION['ID'] = $row['id'];
  $_SESSION['username'] = $row['username'];
  header("location:dashboard.php");
  exit();
}

}

?>
<!DOCTYPE html>
<html>
<head>
  <link rel = "stylesheet" type = "text/css" href = "css/login.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <div class="topnav" id="myTopnav">
  <a href="welcome.php" class="tn-big">EasyWeb.com</a>
  <a href="signup.php" class = "tn-small" style="float:right;">Sign Up</a>
</div>

<h2>LOGIN</h2>

<div class = "super_container">
<form action="" method="post">
  <div class="imgcontainer">
    <img src="images/img_avatar.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" Value = "<?php
  echo $uname;
  ?>" required>

    <?php
    if(!empty($username_error)){
      ?>
      <span class = "error">
      <?php
      echo $username_error.'<br/><br/>';
      ?>
      </span>
      <?php
    }
    ?>
          <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
    <?php
    if(!empty($password_error)){
      ?>
      <span class = "error">
      <?php
      echo $password_error.'<br/><br/>';
      ?>
      </span>
      <?php
    }
    ?>
    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
  <a href="welcome.php"><button type="button" class="cancelbtn">Cancel</button></a>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>
</div>

</body>
</html>
