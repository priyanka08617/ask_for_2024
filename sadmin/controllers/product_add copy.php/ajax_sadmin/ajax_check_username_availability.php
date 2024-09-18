<?php 
include 'connection.php';
$user_name=$_POST['usernameToCheck'];

 

$sql="SELECT * FROM user_login WHERE username='$user_name'";
$result=mysqli_query($conn,$sql);
 if(mysqli_num_rows($result)==0){
    echo 1;
    // username available

 }
 else{
    echo 0;
 }
?>