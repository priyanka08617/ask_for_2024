<?php ob_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Company Details</title>
    <?php
	  include '../includes/header.php';
	  include '../includes/navbar.php';
      include '../includes/check.php';
      include '../includes/functions.php';

	?>

</head>

<body>

    <div class="container" style="">



        <?php
$tot=0;
$c=1;
$sql="SELECT * FROM company_details";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
?>

        <div class="row">
            <div class="col-md-6">
                <h3><b>COMPANY DETAILS</b><br></h3>
                <small class="text-muted">Show the details below details </small>
            </div>
            <div class="col-md-6">
                <img src="../img/company_logo/<?php echo $row['logo']?>" width="250px" style="float:right">
            </div>
        </div>

        <!-- <hr> -->


        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>Sl</th>
                        <th>Comp Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Gst</th>
                        <th>Pan</th>
                        <th>Subtitle</th>
                        <th>Action</th>
                    </tr>

                    <?php

   $company_bank_details_id= $row['company_bank_details_id'];
//    $state_id=$row['state_id'];
//    $state=singleRowFromTable($conn, "SELECT * FROM `states` WHERE id='$state_id'", "name");
echo "<tr>";


    // echo $storeName; 
echo "<td>".$c."</td>"; 
echo "<td>".$row['name']."</td>";
echo "<td>".$row['email']."</td>";
echo "<td>".$row['address']."</td>";
echo "<td>".$row['phon_no']."</td>";
echo "<td>".$row['gst']."</td>";
echo "<td>".$row['pan']."</td>";
echo "<td>".$row['subtitle']."</td>";
echo '<td><img src="../img/edit.png" width="30px" data-toggle="modal" data-target="#myModal"></td>';

echo "</tr>";



?>
                </table>

            </div>
        </div>









        <br><br>

        <div class="card">


            <div class="card-header" data-toggle="modal" data-target="#myModal_for_new_account">
                <h4 align="center"><i>+ Add New Bank Account </i></h4>
            </div>

            <div class="card-body">
                <table class="table table-striped table-sm">
                    <thead>
                        <th>#</th>
                        <th>Bank Name</th>
                        <th>Account No</th>
                        <th>Ifsc Code</th>
                        <th>Branch</th>
                        <th>MICR Code</th>
                        <th>Edit</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
   $c=1; 
 
              $sql2='SELECT * FROM bank_details WHERE status="1"';
              $result2=mysqli_query($conn,$sql2);
               while($row2=mysqli_fetch_array($result2)){

                
               $id=$row2['id'];
               $status=$row2['status'];
$bank_name=$row2['bank_name'];
$account_no=$row2['account_no'];
$ifsc_code=$row2['ifsc_code'];
$branch=$row2['branch'];
// $address=$row2['address'];
$micr_code=$row2['micr_code'];
echo '<tr>';
               echo '<td>'.$c.'</td>';
 echo '<td>'. $bank_name.'</td>';
 echo '<td>'. $account_no.'</td>';
 echo '<td>'. $ifsc_code.'</td>';
 echo '<td>'. $branch.'</td>';
 echo '<td>'. $micr_code.'</td>';
$c++
;$edit_modal_params_string_for_bank="'$id','$bank_name','$account_no','$ifsc_code','$branch','$micr_code','$status'";
$edit_modal_params_for_bank='openModel_for_edit('.$edit_modal_params_string_for_bank.')';
echo '<td><img src="../img/edit.png" width="30px"  data-toggle="modal" data-target="#myModal_for_bank_edit" onclick="'.$edit_modal_params_for_bank.'"></td>';
echo '<td><a href="../controllers/bank_details_del.php?id='.$id.'"><img src="../img/delete.png" width="30px"></a></td>';
 echo '</tr>';
}
 ?>
                    </tbody>
                </table>
            </div>
        </div>



        <div class='modal' id='myModal_for_new_account'>

            <div class='modal-dialog modal-lg'>

                <div class='modal-content'>

                    <!-- Modal Header -->

                    <div class='modal-header'>

                        <h4 class='modal-title'>Bank Details Add</h4>

                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>

                    <!-- Modal body -->

                    <div class='modal-body'>
                        <form class='form-horizontal' action='../controllers/bank_details_add.php' method='post'>

                            <!-- //  content  1 -->
                            <div class='form-group row'>
                                <div class='col-md-1'></div>
                                <div class='col-md-2'><label class='control-label' for='uom'>Bank Name</label></div>
                                <div class='col-md-6'>
                                    <input type='text' class='form-control' placeholder='Enter Bank Name'
                                        name='bank_name' id='bank_name'>
                                </div>
                            </div>

                            <!-- //  content  2 -->
                            <div class='form-group row'>
                                <div class='col-md-1'></div>
                                <div class='col-md-2'><label class='control-label' for='uom'>Account No</label></div>
                                <div class='col-md-6'>
                                    <input type='text' class='form-control' placeholder='Enter Account No'
                                        name='account_no' id='account_no'>
                                </div>
                            </div>

                            <!-- //  content  3 -->
                            <div class='form-group row'>
                                <div class='col-md-1'></div>
                                <div class='col-md-2'><label class='control-label' for='uom'>Ifsc Code</label></div>
                                <div class='col-md-6'>
                                    <input type='text' class='form-control' placeholder='Enter Ifsc Code'
                                        name='ifsc_code' id='ifsc_code'>
                                </div>
                            </div>

                            <!-- //  content  4 -->
                            <div class='form-group row'>
                                <div class='col-md-1'></div>
                                <div class='col-md-2'><label class='control-label' for='uom'>Branch</label></div>
                                <div class='col-md-6'>
                                    <input type='text' class='form-control' placeholder='Enter Branch' name='branch'
                                        id='branch'>
                                </div>
                            </div>

                            <!-- //  content  5 -->
                            <div class='form-group row'>
                                <div class='col-md-1'></div>
                                <div class='col-md-2'><label class='control-label' for='uom'>Address</label></div>
                                <div class='col-md-6'>
                                    <textarea id='address' name='address' rows='4' style='width:100%'></textarea>
                                </div>
                            </div>

                            <!-- //  content  6 -->
                            <div class='form-group row'>
                                <div class='col-md-1'></div>
                                <div class='col-md-2'><label class='control-label' for='uom'>MICR Code</label></div>
                                <div class='col-md-6'>
                                    <input type='text' class='form-control' placeholder='Enter MICR Code'
                                        name='micr_code' id='micr_code'>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-3'></div>
                                <div class='col-md-6'>
                                    <button type='submit' class='btn btn-primary btn-block btn-sm'>Submit</button>

                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- Modal footer -->
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                    </div>

                </div>
            </div>
        </div>







        <div class='modal' id='myModal_for_bank_edit'>

            <div class='modal-dialog modal-lg'>

                <div class='modal-content'>

                    <!-- Modal Header -->

                    <div class='modal-header'>

                        <h4 class='modal-title'>Bank_details Edit</h4>

                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>

                    <!-- Modal body -->

                    <div class='modal-body'>
                        <form class='form' action='../controllers/bank_details_update.php' method='POST'>
                            <input type='hidden' class='form-control' name='id_E' id='id_E'>

                            <!-- //  content  1 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Bank Name</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Enter Bank Name'
                                        name='bank_name_E' id='bank_name_E'>
                                </div>
                            </div>

                            <!-- //  content  2 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Account No</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Enter Account No'
                                        name='account_no_E' id='account_no_E'>
                                </div>
                            </div>

                            <!-- //  content  3 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Ifsc Code</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Enter Ifsc Code'
                                        name='ifsc_code_E' id='ifsc_code_E'>
                                </div>
                            </div>

                            <!-- //  content  4 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Branch</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Enter Branch' name='branch_E'
                                        id='branch_E'>
                                </div>
                            </div>

                            <!-- //  content  5 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Address</label>
                                </div>
                                <div class='col-md-8'>
                                    <textarea id='address_E_for_bank' name='address_E_for_bank' rows='4'
                                        style='width:100%'></textarea>
                                </div>
                            </div>

                            <!-- //  content  6 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>MICR Code</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Enter MICR Code'
                                        name='micr_code_E' id='micr_code_E'>
                                </div>
                            </div>
                            <div class='row mt-3'>
                                <div class='col-md-4'></div>
                                <div class='col-md-8'>
                                    <button type='submit' class='btn btn-primary btn-block btn-sm'>Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- Modal footer -->
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                    </div>

                </div>
            </div>
        </div>















        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Product Category </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">


                            <!-- <input class="form-control" id="idE" name="idE" type="hidden"/> -->


                            <div class="form-group row ">
                                <label class="col-md-3 control-label" for="Department">Company Name</label>
                                <div class="col-md-7">
                                    <textarea class="form-control" id="comp_E" name="comp_E" type="text" placeholder=""
                                        rows="2"><?php echo  $row['name']; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="col-md-3 control-label" for="Department">Email</label>
                                <div class="col-md-7">
                                <input class="form-control"  id="email_E" name="email_E" type="text" placeholder=""
                                        value="<?php echo  $row['email']; ?>">
                                </div>
                            </div>


                            <div class="form-group row ">
                                <label class="col-md-3 control-label" for="Department">Address</label>
                                <div class="col-md-7">
                                    <textarea class="form-control" id="address_E" name="address_E" type="text"
                                        placeholder=""><?php echo  $row['address']; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="col-md-3 control-label" for="Department">Contact No</label>
                                <div class="col-md-7">
                                    <input class="form-control" id="phon_no_E" name="phon_no_E" type="text"
                                        placeholder="" value="<?php echo  $row['phon_no']; ?>" />
                                </div>
                            </div>


                            <div class="form-group row ">
                                <label class="col-md-3 control-label" for="Department">Gst</label>
                                <div class="col-md-7">
                                    <input class="form-control" id="gst_E" name="gst_E" type="text" placeholder=""
                                        value="<?php echo  $row['gst']; ?>" />
                                </div>
                            </div>


                            <div class="form-group row ">
                                <label class="col-md-3 control-label" for="Department">Pan</label>
                                <div class="col-md-7">
                                    <input class="form-control" id="pan_E" name="pan_E" type="text" placeholder=""
                                        value="<?php echo  $row['pan']; ?>" />
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-md-3 control-label" for="Department">State</label>
                                <div class="col-md-7">
                                    <select class="form-control" id="state_E" name="state_E">
                                        <?php 
  $sql1="SELECT * FROM `states`";
  $query1=mysqli_query($conn,$sql1);
  while($row1=mysqli_fetch_array($query1)){
    $id=$row1["id"];
    echo "<option value='".$id."'".($id == $state_id ? "selected" : "").">".$row1["name"]."</option>";
  }
  ?>
                                    </select>
                                </div>
                            </div>




                            <div class="form-group row ">
                                <label class="col-md-3 control-label" for="Department">subtitle</label>
                                <div class="col-md-7">
                                    <textarea class="form-control" id="subtitle_E" name="subtitle_E" placeholder=""
                                        rows="3" cols="30"><?php echo  $row['subtitle']; ?></textarea>
                                </div>
                            </div>



                            <div class="form-group row ">
                                <label class="col-md-3 control-label" for="Department">Logo</label>
                                <div class="col-md-7">
                                    <input type="file" class="form-control" id="logo_E" name="logo_E">
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-7">
                                    <button type="submit" class="btn btn-primary form-control" id="submit"
                                        name="submit">Update</button>
                                </div>
                            </div>

                        </form>

                        <!-- end modal body  -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>






    </div>

    <?php

if(isset($_POST['submit'])){


	
    $comp_E     =$_POST['comp_E'];
    $email_E  =$_POST['email_E'];
    $address_E  =$_POST['address_E'];
    $phon_no_E  =$_POST['phon_no_E'];
    $gst_E      =$_POST['gst_E'];
    $pan_E      =$_POST['pan_E'];
    $state_E      =$_POST['state_E'];
    $subtitle_E =$_POST['subtitle_E'];
    // $file_name=$_POST["logo_E"];

    if($_FILES["logo_E"]["name"]==""){

    }else{
        $target_dir = "../img/company_logo/";
        $img_file_name=$_FILES["logo_E"]["name"];
        $target_file = $target_dir . $_FILES["logo_E"]["name"];
        move_uploaded_file($_FILES["logo_E"]["tmp_name"], $target_file);


        $sql1="UPDATE `company_details` SET `logo`='$img_file_name'";
        mysqli_query($conn,$sql1);
    }



$sql="UPDATE `company_details` SET `name`='$comp_E',`email`='$email_E',`address`='$address_E',`phon_no`='$phon_no_E',`gst`='$gst_E',`pan`='$pan_E',`subtitle`='$subtitle_E' WHERE id='1'";


if (!mysqli_query($conn,$sql)){
  echo("Error description: " . mysqli_error($conn));
}



header ("location: ../views/company.php");
}
else{

}
?>

</body>

<script>
function openModel_for_edit(id, bank_name, Account_No, Ifsc_Code, Branch, MICR_Code, status) {
    $('#id_E').val(id);
    $('#bank_name_E ').val(bank_name);
    $('#account_no_E').val(Account_No);
    $('#ifsc_code_E').val(Ifsc_Code);
    $('#branch_E').val(Branch);
    $('#micr_code_E').val(MICR_Code);
}
</script>

</html>