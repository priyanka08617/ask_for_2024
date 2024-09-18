<?php
ob_start();
include '../includes/check.php';
include '../includes/functions.php';
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include '../includes/header.php'; ?>
    <title><?php echo $comp_name; ?> | Emp Profile</title>
    <style>
       #box{
           width:600px;
           height:490px;
           margin-left:350px;
           border-radius:20px;
          
       }
       .box_head{
           height:240px;
           background-color:#d3d3d3;
       }
       .box_body{
           height:370px;
           background-color:#ffffff;
       }
       .bt{
        background-color:#d3d3d3;
        height:65px;
        padding-top:18px;

       }

       #change_password{
           font-style: italic;
           font-weight: bold;
       }
    </style>
</head>

<body style="color : #484848;background-color:#3e424b">

<?php include '../includes/navbar.php'; ?>
 
<br>
             <div id="box">
            
             <div class="box_head">
                 <br>
                 <center>  <img src="../img/icon/man.png" height="190px" ></center>
                 <br>
             </div>
             <div class="box_body">
             <!-- <div class="container"> -->
             <br>
                <form id="adminEditUserProfile" action="../controllers/edit_vendor_details.php" method="POST">
                
                <input class="form-control" type="hidden" name="user_id" value="<?php echo $user_id;?>">
                     


  <div class="container">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="user_name" class="col-form-label"> First Name</label>
                        </div>
                        <div class="col-md-3"> 
                             <input class="form-control" type="text" id="fst_name" placeholder="Enter Name" name="fst_name" required="" value="<?php echo $sql_query_row["first_name"];?>">
                        </div>

                        <div class="col-md-3"> 
                             <input class="form-control" type="text" id="lst_name" placeholder="Enter Name" name="lst_name" required="" value="<?php echo $sql_query_row["last_name"];?>">
                        </div>


                    </div>

                   

                    <div class="form-group row">
                   
                                    <div class="col-md-4">
                                    <label for="user_email">Email address</label>
                                    </div>
                                <div class="col-md-6"> 
                                     <input type="email" class="form-control" id="user_email" placeholder="Enter email" name="user_email"  value="<?php echo $sql_query_row["email"];?>">
                                  
                               </div>
                    </div>


                    <div class="form-group row">
                                <div class="col-md-4">
                                     <label for="password">Address</label>
                                </div>

                                <div class="col-md-6"> 
                                <input class="form-control" type="text" placeholder="address" id="address" name="address" value="<?php echo $sql_query_row["address"];?>">
                                </div>
                    </div>

                    

                    <div class="form-group row">
                                <div class="col-md-4">
                                     <label for="password">Mobile No</label>
                                </div>

                                <div class="col-md-6"> 
                                   <input class="form-control" type="text" placeholder="phone_no" id="phone_no" name="phone_no"  value="<?php echo $sql_query_row["phone"];?>">
                                </div>
                    </div>

<a id="change_password" class="float-right" data-toggle="modal" data-target="#myModal">Change username & password</a>
                   

<br><br>

                    <div class="form-group row bt"> 
                          <div class="col-md-12 ">  
                            <button type="submit" class="btn btn-default btn-block">Edit Profile</button>
                         </div>
                    </div>
                    </div>
                </form>
               
              
           </div>
        </div>


<!-- /////////////// model////////////////////// -->




<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Username & Password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <!-- // my form  -->


<form id="adminEditUserIdPassword" action="../controllers/edit_username_password.php" method="POST">

                    <div class="form-group row">
                          <div class="col-md-3">
                               <label for="password" >Username</label>
                          </div>

                          <div class="col-md-9">           
                              <input type="text" id="username" name="username" class="form-control input-md" placeholder ="Enter username" required="" value="<?php echo $username;?>" readonly>
                          </div>
                    </div>

                    <div class="form-group row">
                                <div class="col-md-3">
                                     <label for="password" >Password</label>
                                </div>
                                <div class="col-md-9">           
                                    <input type="password" id="password" name="password" class="form-control input-md" placeholder ="Enter Password" required="" value="<?php echo $password;?>">
                                </div>
                    </div> 

                  <div class="form-group row">
                          
                          <div class="col-md-3"></div>
                          <div class="col-md-9">           
                          <input type="checkbox" onclick="myFunction()">&nbspShow Password 
                          </div>
                 </div>


                 <div class="form-group row">
                          <div class="col-md-3"></div>
                          <div class="col-md-9">    
                               <button type="submit" class="btn btn-secondary btn-block" name="save" id="save">Edit Profile</button>
                          </div>
                 </div>
    </form>



      <!-- my form  -->
      </div>

      <!-- Modal footer -->  
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>






<!-- //////////////////////////////////// -->

</body>
<script>
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
} </script>

</html>

