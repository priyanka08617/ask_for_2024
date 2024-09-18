<?php  
include '../includes/check.php';
?>




<!DOCTYPE html>
<html>
<head>
  <title></title>
  <?php include '../includes/header.php';
  include '../includes/navbar.php'; 
  include '../includes/functions.php'; 
  ?>

<style type="text/css">

tfoot {
display: table-header-group;
}
tfoot input{
/*border:none;*/
width:100%;
}


	.center{
     position: fixed; /* or absolute */
  top: 40%;
  left: 35%;
}

</style>
</head>
<body style="color : #484848">
<div class="container-fluid" style="">
	<center><div class='center'>
<h1 >Production Version - 1.0.6</h1><h4>STEWARD - Super Admin </h4>
<h3><b><?php echo $comp_name;?></b></h3>
<?php
// $location=singleRowFromTable($conn, "SELECT * FROM `location` WHERE id='$store_id'", "location");
// echo  "<h4><b>".$location."</b></h4>";
echo  "<h5>".$name."</h5>";
?>
</div></center>
<?php  

// echo "form_action_link ".$_SESSION['form_action_link']; 

?>


</div> 
  </body>
<script>

  $("#dashboard").active();
</script>


</html>