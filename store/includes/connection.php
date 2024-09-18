<?php

include '../../config/config.php';



  date_default_timezone_set("Asia/Kolkata");

  $servername=$config_string['servername'];
  $username=$config_string['username'];
  $password=$config_string['password'];
  $dbname=$config_string['dbname'];


  $conn=mysqli_connect($servername,$username,$password,$dbname);
?>
