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

  
*{
        padding: 0;
        margin:0;
        box-sizing:border-box;
    }



body{
        /* background-color:#3d2a46 ; */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        /* font-family: 'Droid Sans', arial, serif;  */
    }


    .center {
      text-align: center;
  margin: auto;
  width: 50%;
  padding: 220px 10px 10px 10px;
}

</style>
</head>
<body style="color : #484848" >








<div class="container" style="">
<bR><br>
 <center>
    <!-- <div class='center'> -->
<h2 >Production Version - 1.0.6</h2>
<h4>STEWARD - Employee Login </h4>
<h3 ><b><?php echo $comp_name;?></b></h3>
<?php

echo  "<h5>".$name."</h5>";
?>
<!-- </div> -->

</center> 


<?php  // echo "form_action_link ".$_SESSION['form_action_link']; ?>


</div> 
  </body>

<script> $("#dashboard").active();</script>


</html>