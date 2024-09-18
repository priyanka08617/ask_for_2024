<?php
include '../includes/connection.php';
include '../includes/functions.php';

	$id=sanitize_input($conn,$_POST['id_edit']);
    $name_edit=sanitize_input($conn,$_POST['name_edit']);

        $sql="UPDATE terms_and_condition SET name='$name_edit' WHERE id='$id'";
        // echo $sql;
        if (!mysqli_query($conn,$sql)){
        echo("Error description: " . mysqli_error($conn));
        }

        header ("location: ../views/terms_and_condition.php");
      

?>