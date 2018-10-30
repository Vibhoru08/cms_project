<?php
function resize($nwidth, $targetfile, $originalfile){
  $info = getimagesize($originalfile);
  $mime = $info['mime'];
  switch($mime){
    case 'image/jpeg':
            $image_create_func = 'imagecreatefromjpeg';
            $image_save_func = 'imagejpeg';
            break;
   case 'image/png':
            $image_create_func = 'imagecreatefrompng';
            $image_save_func = 'imagepng';
            break;
   case 'image/gif':
            $image_create_func = 'imagecreatefromgif';
            $image_save_func = 'imagegif';
            break;
  default:
            throw new Exception('unknown image type');

  }
  $img = $image_create_func($originalfile);
  list($width, $height) = getimagesize($originalfile);
  $nheight = ($height / $width) * $nwidth;
  $tmp = imagecreatetruecolor($nwidth, $nheight);
  imagecopyresampled($tmp, $img, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);
  if (file_exists($targetfile)){
    unlink($targetfile);
  }
  $image_save_func($tmp, $targetfile);
  imagedestroy($img);
  imagedestroy($tmp);
}
?>
