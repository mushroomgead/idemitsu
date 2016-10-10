<?php
$host_name  = "localhost";
$user_name  = "idemitsu";
$password   = "idemitsu";
$db_name   	= "db_idemitsu";

$con = mysqli_connect($host_name,$user_name,$password,$db_name);

if(!$con) {
  echo '<h1>Database is not connected</h1>';
  exit;
}
 mysqli_set_charset($con,"utf8");
?>