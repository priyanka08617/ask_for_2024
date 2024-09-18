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
                <img src="../img/<?php echo $row['logo']?>" width="250px" style="float:right">
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
                        <!--<th>Action</th>-->
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
// echo '<td><img src="../img/edit.png" width="30px" data-toggle="modal" data-target="#myModal"></td>';

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
                        <!--<th>Edit</th>-->
                        <!--<th>Action</th>-->
                    </thead>
                    <tbody>
                        <?php
   $c=1; 
 
              $sql2='SELECT * FROM `bank_details` WHERE `status`="1"';
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
$c++;
 echo '</tr>';
}
 ?>
                    </tbody>
                </table>
            </div>
        </div>



</script>

</html>