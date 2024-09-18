<?php 
ob_start(); 
include 'config/config.php';
date_default_timezone_set("Asia/Kolkata");

  $servername=$config_string['servername'];
  $username=$config_string['username'];
  $password=$config_string['password'];
  $dbname=$config_string['dbname'];

  $conn=mysqli_connect($servername,$username,$password,$dbname);

function FetchCompany($conn){
  $sql = "SELECT * FROM company_details";
  $query = mysqli_query($conn,$sql);
  $row55 = mysqli_fetch_array($query);
  return $row55["name"];

}
?>


<!DOCTYPE html>
<html>

<head>
    <title><?php echo FetchCompany($conn);?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../resources/favicon.svg">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.1/af-2.3.7/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/cr-1.5.4/date-1.1.1/fc-3.3.3/fh-3.1.9/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.0/sp-1.4.0/sl-1.3.3/datatables.min.css" />

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.1/af-2.3.7/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/cr-1.5.4/date-1.1.1/fc-3.3.3/fh-3.1.9/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.0/sp-1.4.0/sl-1.3.3/datatables.min.js">
    </script>
    <style type="text/css">
    .btn-primary,
    .btn-primary:hover,
    .btn-primary:active,
    .btn-primary:visited {
        background-color: #4e73df !important;
        /*border-radius: 0;*/
        border: none;
    }

   *{
        padding: 0;
        margin:0;
        box-sizing:border-box;
    }

  


    body{
        background-color:#3d2a46 ;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
   
    }

    .row{
        background-color:white;
        border-radius:30px;
    }

    img{
        border-top-left-radius:30px;
        border-bottom-left-radius:30px;
    }

    #singlebutton{
        background-color:#3d2a46;
       color:white;
    }
    </style>





</head>

<body>




    <?php








session_start();


function singleRowFromTable($conn, $sql, $col_required){

  $q=mysqli_query($conn,$sql);
  if(mysqli_num_rows($q)>0){
    $row=mysqli_fetch_array($q);
    return $row[$col_required];
  }
  else{
    return "N.A.";
  }
  
}



if ((isset($_SESSION['username']) != '')) 
{
  header("location:".$_SESSION['user_folder_path']."/views/dashboard.php");

}





$error="";


if(isset($_POST["login"]))
{
if(empty($_POST["username"]) || empty($_POST["password"]))
{
$error = "Both fields are required.";
}
else
{
$xusername=$_POST["username"];
$xpassword=$_POST["password"];

$xusername = stripslashes($xusername);
$xpassword = stripslashes($xpassword);
// echo $xusername.$xpassword;
$xusername = mysqli_real_escape_string($conn, $xusername);
$xpassword = mysqli_real_escape_string($conn, $xpassword);
$starttime=time();


$sql="select * from user_login where username='$xusername' and password='$xpassword' AND status='1'";
// echo $sql;
$result=mysqli_query($conn,$sql);



if(mysqli_num_rows($result)==1)
{

  $row=mysqli_fetch_array($result);

  $user_category_id=$row['user_category_id'];

  $user_folder_path=singleRowFromTable($conn, "SELECT * FROM user_category WHERE id='$user_category_id' AND status='1'","user_login_folder_path");
 
$_SESSION['user_id']=$row['user_id'];
$_SESSION['username']=$xusername;
$_SESSION['user_category_id']=$user_category_id;
$_SESSION['user_folder_path']=$user_folder_path;
$_SESSION['form_action_link']="http://steward1204001.in/index.php";



header("location:".$user_folder_path."/views/dashboard.php");
}
else
{
$error="Incorrect Username or Password";
// $error=$sql;
}



}
}



?>


<section class="form  my-4 mx-5" >
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-5">
            <img src="store/img/ask_for_logo.jpg" class="img-fluid" alt="Responsive image" width="100%" height="auto" style="  display: block;">
            </div>
            <div class="col-lg-7">
<center>
            <form class="form-horizontal" action="" method="post">

<!-- <center> -->
    <br><br><br><br><br><br>
    <h1 ><b><?php echo FetchCompany($conn);?></b></h1>
<h5 class="py-3 px-5"><b>Sign Into Your Account</b></h5>

    <br>
    <div class="form-group">

        <div class="col-md-10 mb-0">
            <input id="textinput" name="username" placeholder="Username"
                class="form-control input-sm me-2" type="text">

        </div>

    </div>


    <div class="form-group">
        <div class="col-md-10 ">
            <input id="passwordinput" name="password" placeholder="Password"
                class="form-control input-md" type="password">

        </div>
    </div>


    <div class="form-group">

        <div class="col-md-10 mt-4 pt-2">
            <button id="singlebutton" type="submit" name="login" value="submit"
                class="btn btn-block">Login</button>
        </div>
    </div>


        <div class="col-md-12"><i class="text-danger"><b><?php echo $error; ?></b></i></div>
 

</form>





            </div>
        </div>
    </div>
</section>
















</body>

</html>