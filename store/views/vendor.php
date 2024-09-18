<?php ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Supplier Details</title>
    <?php
include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/check.php';
include '../includes/functions.php';
?>



<style>
    tfoot {
        display: table-header-group;
    }

    tfoot input {
        width: 100%;
        /* background: #868E85; */
        border: none;
        border: 1px solid #868E85;
        padding: 0px 5px;
    }

    table #example tr td {
        padding: 9px;
        font-weight: bold;
    }

    /* thead{
    background: #2A4747;
  } */

    thead tr td {
        text-align: center;
    }
    </style>


</head>

<body>


    <div class="container-fluid" style="">
     
        <h3>Supplier Details</h3>
        <small class="text-muted">Fill in the given below tab to create Supplier and manage existing
                Supplier</small>
       
        <hr></hr>

        <ul class='nav nav-tabs nav-justified'>
            <li class='nav-item'><a class='nav-link' data-toggle='tab' href='#home'>Supplier Creation</a></li>
            <li class='nav-item'><a class='nav-link active' data-toggle='tab' href='#menu1'>Existing Supplier</a></li>
        </ul>

        <br>
        <div class="tab-content">
            <div id="home" class="tab-pane fade ">
                <form class="form-horizontal" action="../controllers/add_vendor.php" method="post">




<div class="form-group row">
<label class="col-md-2 control-label" for="Department"></label>
    <label class="col-md-2 control-label" for="Department">Name</label>
    <div class="col-md-4">
        <input class="form-control" id="name" name="name" type="text" placeholder="Enter Name"
            required />
    </div>
</div>




<div class="form-group row">
    <label class="col-md-2 control-label" for="Department"></label>
    <label class="col-md-2 control-label" for="Department">Email</label>
    <div class="col-md-4">
        <input class="form-control" id="email" name="email" type="email" placeholder="Enter Email"
            required />
    </div>
</div>


<div class="form-group row">
    <label class="col-md-2 control-label" for="Department"></label>
    <label class="col-md-2 control-label" for="Department">Phone</label>
    <div class="col-md-4">
        <input class="form-control" id="phone_no" name="phone_no" type="number"
            placeholder="Enter Phone No." required />
    </div>
</div>

<div class="form-group row">
    <label class="col-md-2 control-label" for="Department"></label>
    <label class="col-md-2 control-label" for="Department">Address</label>
    <div class="col-md-4">
        <textarea class="form-control" id="address" name="address" type="text"
            placeholder="Enter Address" required ></textarea>
    </div>
</div>





<!-- onchange="state(this.value)" -->
<div class="form-group row">
    <label class="col-md-2 control-label" for="Department"></label>
    <label class="col-md-2 control-label" for="Department">State</label>
    <div class="col-md-4">
        <select id="state_id" name="state_id"  class="form-control"
            required style="width:100%">
            <option value="">---Select---</option>
            <?php
$sql="SELECT * FROM states WHERE country_id='1' AND status='1'";                                  
$result=mysqli_query($conn,$sql);                               
while($row=mysqli_fetch_array($result)){
$id=$row["id"];
$name=$row["name"];
echo "<option value='".$id."'>".$name."</option>";

}
?>
        </select>
    </div>
</div>


<div class="form-group row">
    <label class="col-md-2 control-label" for="Department"></label>
    <label class="col-md-2 control-label" for="Department">Pin Code</label>
    <div class="col-md-4">
        <input class="form-control" id="pin_code" name="pin_code" type="number"
            placeholder="Enter Pin Code" required />
    </div>
</div>

<div class="form-group row">
    <label class="col-md-2 control-label" for="Department"></label>
    <label class="col-md-2 control-label" for="Department">Remarks</label>
    <div class="col-md-4">
        <textarea class="form-control" id="remarks" name="remarks" type="text"
            placeholder="Enter Remarks" required></textarea>
    </div>
</div>


<div class="form-group row">
    <label class="col-md-2 control-label" for="Department"></label>
    <label class="col-md-2 control-label" for="Department">Gst in</label>
    <div class="col-md-4">
        <input class="form-control" id="gstin" name="gstin" type="text" placeholder="Enter Gst In"
            required />
    </div>
</div>







<div class="form-group row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <button type="submit" class="btn btn-primary form-control" id="submit" name="submit" onclick="return confirm('Are you sure ?')">+ Add
        Supplier</button>
    </div>
</div>

</form>
                </div>

            <div class="tab-pane active in" id="menu1">
               
<table class="table table-sm" id="example">
<thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>State</th>
                            <th>Pin Code</th>
                            <th>Remarks</th>
                            <th>Gst in</th>
                            <th>Entry Date</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Edit</th>
                            <th>Action</th>
                    </thead>
                    <tfoot>
                            <th>#</th>
                            <th> Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>State</th>
                            <th>Pin Code</th>
                            <th>Remarks</th>
                            <th>Gst in</th>
                            <th>Entry Date</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Edit</th>
                            <th>Action</th>
                            
                    </tfoot>
                    <tbody>

                        <?php
$c=0;
$sql="SELECT * FROM vendor WHERE status='1' order by id desc";
// echo $sql;
$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_array($result)){
$c++;

$id=$row['id'];
$name=$row['name'];
$address=$row['address'];
$email=$row['email'];
$phone_no=$row['phone_no'];
$pin_code =$row['pin_code'];
$country_id=$row['country_id'];
$country = singleRowFromTable($conn, "SELECT * FROM countries WHERE id='$country_id' AND status='1'", "name");

$state_id=$row['state_id'];
$state = singleRowFromTable($conn, "SELECT * FROM states WHERE id='$state_id' AND  status='1'", "name");


$pin_code=$row['pin_code'];
$remarks =$row['remarks'];
$gstin =$row['gstin']; 

$entry_date =$row['entry_date'];                                                



echo "<tr>";
echo "<td>".$c."</td>";
echo "<td>".$name."</td>";

echo "<td>".$email."</td>";
echo "<td>".$phone_no."</td>";
echo "<td>".$address."</td>";
echo "<td>".$state."(".$country.")</td>";
// echo "<td>".$city."</td>";
echo "<td>".$pin_code."</td>";

echo "<td>".$remarks."</td>";
echo "<td>".$gstin."</td>";
echo "<td>".dateForm1($entry_date)."</td>";

echo "<td>".$phone_no."</td>";
echo "<td>".$row['password']."</td>";
$edit_modal_params_string="'$id','$name','$email','$phone_no','$address','$state_id','$pin_code','$remarks','$gstin'";

$edit_modal_params="openModel(".$edit_modal_params_string.")";

echo '<td><img  src="../img/edit.png" width="30px" data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'"></td>';

echo   "<td>"."<a href='../controllers/delete_vendor.php?id=".$id."' onclick='return confirm(\"Are you sure you want to delete\")'><img  src='../img/delete.png' width='30px'></a>"."</td>";

echo "</tr>";
}
?>

                    </tbody>
                </table>

           
<!-- table end  -->                        
</div>
</div> 
<!-- ---------------------------------------------------------------------------     -->


</div>
</body>


        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Update Vendor Details </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                       
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="../controllers/update_vendor.php" method="post">


                            <input class="form-control" id="id" name="id" type="hidden" />



                            <div class="form-group row">
                                <label class="col-md-3 control-label" for="Department">Name</label>
                                <div class="col-md-7">
                                    <input class="form-control" id="name_edit" name="name_edit" type="text"
                                        placeholder="Edit Name" required />
                                </div>
                            </div>




                            <div class="form-group row">
                                <label class="col-md-3 control-label" for="Department">Email</label>
                                <div class="col-md-7">
                                    <input class="form-control" id="email_edit" name="email_edit" type="email"
                                        placeholder="Edit Email" required />
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-3 control-label" for="Department">Phone</label>
                                <div class="col-md-7">
                                    <input class="form-control" id="phone_no_edit" name="phone_no_edit" type="text"
                                        placeholder="Edit Phone" required />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 control-label" for="Department">Address</label>
                                <div class="col-md-7">
                                    <textarea class="form-control" id="address_edit" name="address_edit" type="text"
                                        placeholder="Edit Address"></textarea>
                                </div>
                            </div>


                            

                            <div class="form-group row">
                                <label class="col-md-3 control-label" for="Indentor">State</label>
                                <div class="col-md-7">
                                        <select id="state_id_edit" name="state_id_edit" onchange="state_edit(this.value);"
                                        class="form-control" style="width:100%">
                                        <option value="0">---Select---</option>
                                        <?php
                                            $sql="SELECT * FROM states";      

                                            $result=mysqli_query($conn,$sql);                               
                                            while($row=mysqli_fetch_array($result)){
                                            $id=$row["id"];
                                            $name=$row["name"];

                                            echo "<option value='".$id."'>".$name."</option>";

                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-3 control-label" for="Department">Pin Code</label>
                                <div class="col-md-7">
                                    <input class="form-control" id="pin_code_edit" name="pin_code_edit" type="text"
                                        placeholder="Enter Pin Code" required />
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-md-3 control-label" for="Department">Remarks</label>
                                <div class="col-md-7">
                                    <input class="form-control" id="remarks_edit" name="remarks_edit" type="text"
                                        placeholder="Enter Remarks" required />
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-3 control-label" for="Department">Gst in</label>
                                <div class="col-md-7">
                                    <input class="form-control" id="gstin_edit" name="gstin_edit" type="text"
                                        placeholder="Enter Gst In" required />
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

        <!-- my code end  -->
    </div>






<script>

function openModel(id, a, b, c, d, f, h, i, j) {
    $("#id").val(id);
    $("#name_edit").val(a);
    $("#email_edit").val(b);
    $("#phone_no_edit").val(c);
    $("#address_edit").val(d);
    $("#state_id_edit").val(f);
    $("#pin_code_edit").val(h);
    $("#remarks_edit").val(i);
    $("#gstin_edit").val(j);
    $("#state_id_edit").select2();


}

function country_edit(val) {
    // alert(val);
    $.ajax({
        type: 'post',
        data: {
            country_id: val
        },
        url: "../controllers/ajax/ajax_fetch_state.php",

        success: function(result) {
            // $("#state_id_edit").empty();
            $("#state_id_edit").html(result);
            //    $("#city_id_edit").empty();
            //    alert(result);

        }
    });
}


$( document ).ready(function() {
$("#box").hide();
$("#vendor_id").select2();
$("#credentials_set_id").select2();
$("#state_id").select2();


        $('#example tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" class="" placeholder="Search" />');
        });
        // DataTable
        var table = $('#example').DataTable({
            dom: 'Bfrtip',
            lengthMenu: [
                [25, 50, -1],
                ['25 rows', '50 rows', 'Show all']
            ],
            buttons: [
                'pageLength'
            ]
        });
        // Apply the search
        table.columns().every(function() {
            var that = this;

            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });






    });
</script>

</html>