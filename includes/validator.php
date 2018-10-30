<?php
class validator
{
  public function Xss_safe($data){
    $data = trim($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);

    return $data;
  }

  public function Name_validator($Name){
    if (preg_match("/^[a-zA-Z ]*$/",$Name)){
      return true;
    }
    else {
      return false;
    }

  }

  public function Email_validator($Email){
    if (filter_var($Email,FILTER_VALIDATE_EMAIL)){
      return false;
    }
    else{
      return true;
    }
  }
  public function Mobile_validator($Mobile){
    if(is_numeric($Mobile)){
      return false;
      }
    else {
      return true;
    }
  }
}
?>
