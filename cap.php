<?php
include("includes/config.php");

$img = imagecreatetruecolor(150,50);
$white = imagecolorallocate($img,255,255,255);

$black = imagecolorallocate($img,0,0,0);
$red = imagecolorallocate($img,255,0,0);
function random($len){
  $chars = "abcdefghijklmnopqrstuvwxyz";
  srand((double)microtime()*1000000);
  $str = "";
  $i = 0;
   while($i <= $len) {
     $num = rand() % 33;
     $tmp = substr($chars, $num, 1);
     $str = $str . $tmp;
     $i++;
   }
   return $str;
}

imagefill($img, 0, 0, $red);
$string = random(8);
$_SESSION['cap'] = $string;
imagettftext($img, 22, 0, 10, 33, $white, "absender1.ttf", $string);



header("Content-type: image/png");
imagepng($img);
imagedestroy($img);
?>
