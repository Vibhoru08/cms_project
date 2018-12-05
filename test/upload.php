<?php
include('functions/image_resize.php');
$ID = $_SESSION['ID'];
if(isset($_POST["submit"])){
$filename = $_FILES['upload']['name'];
$filetmpname = $_FILES['upload']['tmp_name'];
$filesize = $_FILES['upload']['size'];
$filerror = $_FILES['upload']['error'];
$filext = explode('.', $filename);
$fileactualext = strtolower(end($filext));
$filepath = "uploads/$filename";
$allowed = array('jpg','jpeg','png');
if (in_array($fileactualext, $allowed)){
  
  if ($filerror === 0){
    if($filesize < 5000000){

    move_uploaded_file($filetmpname, $filepath);
//    $src = imagecreatefrompng($filepath);
  //  list($width, $height) = getimagesize($filepath);
    //$nwidth = 500;
    //$nheight = ($height / $width) * $nwidth;
    //$tmp = imagecreatetruecolor($nwidth, $nheight);
    //imagecopyresampled($tmp, $src,0,0,0,0,$nwidth,$nheight,$width,$height);
    $sfilepath = 'uploads/small'.$filename;
    resize(200, $sfilepath, $filepath);
    //imagepng($tmp, $sfilepath,7);

    }
    else{
      echo "File size is too big.";
    }
  }
  else{
    echo "File could not be uploaded.";
  }
}
else{
  echo "Not a valid extension.";
}
}
?>
