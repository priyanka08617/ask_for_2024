<?php
if ((isset($_SESSION['username']) != '')) 
{
  header("location: views/dashboard.php");

}
else{
    header("location:../index.php");
}

?>