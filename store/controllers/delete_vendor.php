<?php
 include '../includes/check.php';

 include '../includes/functions.php';
	$id=$_GET['id'];


    $sql="UPDATE vendor SET status='0' WHERE id='$id'";
     if (!mysqli_query($conn,$sql)){
           echo("Error description: " . mysqli_error($conn));
       }

header ("location: ../views/vendor.php");
      

?>