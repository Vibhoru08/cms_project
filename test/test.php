<?php
include('upload.php');
?>
<html>
<head>
  <title>TEST</title>
</head>
<body>
 <form action = "" method = "post" enctype="multipart/form-data">
   <input type = "file" name = "upload">
   <input type = "submit" name = "submit" value = "upload">
</form>
<?php
if(isset($_POST['submit'])){
  ?>
<img src = "<?php
echo $sfilepath;
?>">
<?php
}
?>
</body>
</html>
