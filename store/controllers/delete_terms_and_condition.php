<?php
include '../includes/connection.php';
include '../includes/functions.php';

	$id=sanitize_input($conn,$_GET['id']);


    $sql="UPDATE terms_and_condition SET status='0' WHERE id='$id'";
     if (!mysqli_query($conn,$sql)){
           echo("Error description: " . mysqli_error($conn));
       }

header ("location: ../views/terms_and_condition.php");
      

?>