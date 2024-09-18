<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html  lang='en'>
<head>
<title> Stock Locations Details</title>
<?php 
 
include '../includes/header.php'; 
include '../includes/navbar.php'; 
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
<div class='container-fluid' style=''>
<!-- Form Name -->
<h3> Stock Locations </h3><p class='text-muted'>Fill in the given below tab to create Stock Locations</p><hr></hr>
<!-- my code start  --> 
<ul class='nav nav-tabs nav-justified'>
<li   class="nav-item">
            <a class='nav-link' data-toggle='tab' href='#home'>Stock Locations Creation</a></li>
<li class="nav-item ">
            <a class='nav-link active'  data-toggle='tab' href='#menu1'>Existing Stock Locations</a></li>
            </ul>






<br><br>


<div class='tab-content'>
<div id='home' class='tab-pane in fade'>
<form class='form-horizontal' action='../controllers/stock_locations_add.php' method='post'>

 <!-- //  content  1 -->
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Locations Category</label></div>
<div class='col-md-6'>

            <select class='form-control' name='locations_category_id' id='locations_category_id'>
            <option value=''>select</option>
            <?php
 
                      $sql='SELECT * FROM stock_locations_category WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];
                        echo '<option value="'.$id.'">'.$row['locations_category'].'</option>';
                      }
            ?>
            </select>
            </div></div>

 <!-- //  content  2 -->
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Location Name</label></div>
<div class='col-md-6'>
<input type='text'  class='form-control' placeholder='Enter location_name' name='location_name' id='location_name'>
</div>
</div>

 <!-- //  content  3 -->
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Location Address</label></div>
<div class='col-md-6'>
<input type='text'  class='form-control' placeholder='Enter location_address' name='location_address' id='location_address'>
</div>
</div>

 <!-- //  content  4 -->
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Phone No</label></div>
<div class='col-md-6'>
<input type='text'  class='form-control' placeholder='Enter phone_no' name='phone_no' id='phone_no'>
</div>
</div>
<div class='row'>
<div class='col-md-3'></div>
<div class='col-md-6'>
<div class='d-grid'>
<button type='submit' class='btn btn-primary btn-block btn-sm'>Submit</button>
</div>
</div>
</div>
</form>
</div>
<div id='menu1' class='tab-pane in active'>
<table class='table table-sm table-hover' id='example'>
<thead>
<th>#</th>
<th>Locations Category</th>
<th>Location Name</th>
<th>Location Address</th>
<th>Phone No</th>
<th>Edit</th>
<th>Action</th>
</thead>
<tfoot>
<th>#</th>
<th>Locations Category</th>
<th>Location Name</th>
<th>Location Address</th>
<th>Phone No</th>
<th>Edit</th>
<th>Action</th>
</tfoot>
<tbody>
<!--- // ************************************************************ --> 
<?php
   $c=1; 
 
              $sql='SELECT * FROM stock_locations WHERE status="1"';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
               $id=$row['id'];
               $status=$row['status'];
$locations_category_id=$row['locations_category_id'];
$locations_category= singleRowFromTable($conn, "SELECT * FROM stock_locations_category WHERE id='$locations_category_id' ", "locations_category");
$location_name=$row['location_name'];
$location_address=$row['location_address'];
$phone_no=$row['phone_no'];
echo '<tr>';
               echo '<td>'.$c.'</td>';
 echo '<td>'. $locations_category.'</td>';
 echo '<td>'. $row['location_name'].'</td>';
 echo '<td>'. $row['location_address'].'</td>';
 echo '<td>'. $row['phone_no'].'</td>';
$c++
;$edit_modal_params_string="'$id','$locations_category_id','$location_name','$location_address','$phone_no','$status'";
$edit_modal_params='openModel('.$edit_modal_params_string.')';
echo '<td><button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'">Edit</button></td>';
echo '<td><a href="../controllers/stock_locations_del.php?id='.$id.'" onclick="return confirm(\'Are you sure ?\');"><button type="button" class="btn btn-danger" >Remove</button></a></td>';
 echo '</tr>';
}
 ?>
</tbody>
 </table>
</div>
<!--// for tab-content  -->
</div>
<!--// container-fluid -->

 <!-- The Modal -->
 <div class='modal' id='myModal'>
 
<div class='modal-dialog modal-lg'>
 
<div class='modal-content'>
 
<!-- Modal Header -->
 
<div class='modal-header'> 

<h4 class='modal-title'>Stock Locations Edit</h4>

 <button type='button' class='close' data-dismiss='modal'>&times;</button>
</div>

<!-- Modal body -->

<div class='modal-body'>
<form class='form' action='../controllers/stock_locations_update.php'  method='POST'>
<input type='hidden'  class='form-control'  name='id_E' id='id_E'>

 <!-- //  content  1 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Locations Category</label>
</div>
<div class='col-md-8'>


            <select class='form-control' name='locations_category_id_E' id='locations_category_id_E'>
            <option value=''>select</option>
            <?php
 
                      $sql='SELECT * FROM stock_locations_category WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];
                        echo '<option value="'.$id.'">'.$row['locations_category'].'</option>';
                      }
            ?>
            </select>
          </div>
</div>

 <!-- //  content  2 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Location Name</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter location_name' name='location_name_E' id='location_name_E'>
</div>
</div>

 <!-- //  content  3 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Location Address</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter location_address' name='location_address_E' id='location_address_E'>
</div>
</div>

 <!-- //  content  4 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Phone No</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter phone_no' name='phone_no_E' id='phone_no_E'>
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
</div></div><script>
function openModel(id,locations_category_id,location_name,location_address,phone_no,status){
$('#id_E').val(id);$('#locations_category_id_E').val(locations_category_id);
$('#location_name_E').val(location_name);
$('#location_address_E').val(location_address);
$('#phone_no_E').val(phone_no);
}

$(document).ready( function () {




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
        //[ -1 ],
        //['Showing all' ]
        //],
        buttons: [
            'pageLength', 'copy', 'excel', 'pdf', 'print'
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