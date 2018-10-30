<?php



function connect(){
$host = "localhost";
$username = "root";
$password = "";
$dbname = "cms";

$conn = new mysqli($host,$username,$password,$dbname);
if(mysqli_connect_error()){
  echo "Cant connect to the database";
  die();
}
return $conn;


}

?>
