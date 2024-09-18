<?php
ob_start();
 include '../includes/check.php';
session_start();
  if(session_destroy())
  {
    header("location:../../index.php");
  }

?>