<?php ob_start();
include '../includes/check.php';
include '../includes/functions.php';

if(isset($_POST["submit"])){
    $enquiry_category=$_POST["enquiry_category"];
  $sql_insert=  "INSERT INTO `form_category`(`form_table`, `category`, `status`) VALUES ('1','$enquiry_category','1')";
  $query=mysqli_query($conn,$sql_insert);
  header("location:form_category.php");


}

if(isset($_POST["add_subcategory_form"])){
    $category_id_for_add=sanitize_input($conn,$_POST["category_id_for_add"]);
    $data=sanitize_input($conn,$_POST["data"]);
  $sql_insert=  "INSERT INTO `form_subcategory`(`category_id`, `data`, `status`) VALUES ('$category_id_for_add','$data','1')";
  $query=mysqli_query($conn,$sql_insert);
  header("location:form_category.php");
}



if(isset($_POST["btnUpdate"])){
    $field_id_E=sanitize_input($conn,$_POST["field_id_E"]);
    $field_name_E=sanitize_input($conn,$_POST["field_name_E"]);
    $field_data_E=sanitize_input($conn,$_POST["field_data_E"]);


    // $field_id_E=$_POST["field_id_E"];
    // $field_name_E=$_POST["field_name_E"];
    // $field_data_E=$_POST["field_data_E"];

    

  $sql_update="UPDATE `form_subcategory` SET `data`='$field_data_E' WHERE `id`='$field_id_E'";
 mysqli_query($conn,$sql_update);
echo mysqli_error($conn);
 header("location:form_category.php");
}





?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Quotation Data Creation</title>
    <?php 
 
include '../includes/header.php'; 
include '../includes/navbar.php'; 

             
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


    <script>
    $(document).ready(function() {


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
</head>

<body>
    <div class='container-fluid' style=''>
        <!-- Form Name -->
        <h3> Quotation Data Creation </h3><small class='text-muted'>Fill in the given below tab to create Job Work and manage existing
            data</small>
        <hr></hr>
        <!-- my code start  -->
        <ul class='nav nav-tabs nav-justified'>
            <li class='nav-item'>
                <a class='nav-link' data-toggle='tab' href='#home'>Quotation Category  Creation</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link active' data-toggle='tab' href='#menu1'>Existing Quotation Category With Data</a>
            </li>
        </ul>




        <br>
        <!-- <br> -->


        <div class='tab-content'>
            <div id='home' class='tab-pane in fade'>
                <form class='form-horizontal' action='' method='post'>

               

                    <!-- //  content  3 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Category</label></div>
                        <div class='col-md-6'>
                            <input type='text' class='form-control' placeholder='Enter Category' name='enquiry_category'
                                id='enquiry_category'>
                        </div>
                    </div>

                  

                    <div class='row'>
                        <div class='col-md-3'></div>
                        <div class='col-md-6'>
                                <button type='submit' id="item_btn"
                                    class='btn btn-primary btn-block btn-sm' name='submit'>Submit</button>
                          
                        </div>
                    </div>
                </form>
            </div>
            <!-- <br> -->
            <div id='menu1' class='tab-pane in active'>
                <br><br>
            <div class="row">
            <?php
   $c=1; 
 
              $sql_cat='SELECT * FROM form_category WHERE status="1" order by id desc';
              $query_cat=mysqli_query($conn,$sql_cat);
               while($row_cat=mysqli_fetch_array($query_cat)){
               $category_id=$row_cat['id'];
               $status=$row_cat['status'];
               $category=$row_cat['category'];
               $edit_modal_params_string="'$category_id','$category'";
               $edit_modal_params='openModel_add('.$edit_modal_params_string.')';
               ?>

<div class="col-md-6">
<div id="accordion">

  <div class="card">
  <a class="card-link" data-toggle="collapse" href="#collapseOne_<?php echo $category_id;?>">
    <div class="card-header">
      
    <h5 align="center"><b><?php echo $category;?></b></h5>  
      </div>
      </a>
  
    <div id="collapseOne_<?php echo $category_id;?>" class="collapse show" data-parent="#accordion">
      <div class="card-body">
       <button type="button" class="btn btn-info btn-block btn-sm" id="btn_add" data-toggle="modal" data-target="#myModal_add_data" onclick="<?php echo $edit_modal_params;?>" >+Add Data For <?php echo $category;?></button>  &nbsp
       <table class='table table-sm table-hover table-striped'>
       <thead>
           <th>#</th>
           <th>Category</th>
           <th>Edit</th>
           <th>Action</th>
       </thead>
       <tbody>
           <!-- // ************************************************************ -->
       <?php
$c=1; 

 $sql='SELECT * FROM form_subcategory WHERE status="1" AND category_id="'.$category_id.'" order by id desc';
 $result=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_array($result)){
  $id=$row['id'];
  $status=$row['status'];
  $data=$row['data'];


echo '<tr>';
echo '<td>'.$c.'</td>';
echo '<td>'. $data.'</td>';

$c++;
$edit_modal_params_string="'$id','$category','$data','$status'";
$edit_modal_params='openModel('.$edit_modal_params_string.')';
echo '<td><img src="../img/edit.png" width="30px"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'"></td>';
echo '<td><img src="../img/delete.png" width="30px" onclick="delete_func('.$id.')"></td>';
echo '</tr>'; 
}
       ?>
       </tbody>
       </table>
      </div>
    </div>
  </div>
  </div>
  </div>



<?php
               }
?>

</div>
</div>
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
                        <h4 class='modal-title'>Update <span id="field_span_category"></span></h4>

                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>

                    <!-- Modal body -->

                    <div class='modal-body'>
                        <form class='form' action='' method='POST'>
                            <input type='hidden' class='form-control' name='field_id_E' id='field_id_E'>

                           

                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Field name</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Enter Field' name='field_name_E'
                                        id='field_name_E' readonly>
                                </div>
                            </div>


                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Field Data</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Enter data' name='field_data_E'
                                        id='field_data_E'>
                                </div>
                            </div>




                            <div class='row mt-3'>
                                <div class='col-md-4'></div>
                                <div class='col-md-8'>
                                    <button type='submit' class='btn btn-primary btn-block btn-sm' name='btnUpdate'>Submit</button>
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
    </div>


    
        <!-- The Modal -->
        <div class='modal' id='myModal_add_data'>

            <div class='modal-dialog modal-lg'>

                <div class='modal-content'>

                    <!-- Modal Header -->

                    <div class='modal-header'>

                        <h4 class='modal-title'>ADD Data</h4>

                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>

                    <!-- Modal body -->

                    <div class='modal-body'>
                        <form class='form' action='form_category.php' method='POST'>
                            <input type='hidden' class='form-control' name='category_id_for_add' id='category_id_for_add'>

                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Category</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Category' id='for_show_Category' readonly >
                                </div>
                            </div>

                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Data</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Enter data' name='data'
                                        id='data'>
                                </div>
                            </div>


                            <div class='row mt-3'>
                                <div class='col-md-4'></div>
                                <div class='col-md-8'>
                                    <button type='submit' class='btn btn-primary btn-block btn-sm' id='add_subcategory_form' name='add_subcategory_form'>Submit</button>
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
    </div>



    <script>
    function openModel(id, category, data, status) {
        $('#field_id_E').val(id);
        $('#field_name_E').val(category);
        $('#field_data_E').val(data);
        $("#field_span_category").html(category);
       
    }

    function openModel_add(id,category) {
        $('#category_id_for_add').val(id);
        $('#for_show_Category').val(category);
    }

    







    function delete_func(id){
        swal({
  title: "Are you sure?",
  text: "You will not be able to recover this imaginary Data!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, delete it!",
  closeOnConfirm: false
 },
 function(){

    $.ajax({
                data: {
                    id: id
                },
                url: "../controllers/form_category_del.php",
                type: "GET",
                cache: false,
                success: function(data) {
                    if (data == 1) {


  swal({
                               type: "success",
                                title: "Deleted!",
                                text: "Your imaginary Data has been deleted!",
                                icon: "success",
                                button: "ok!"
                            },
                            function(ok) {
                                if (ok) {
                                    location.reload(); 
                                }
                            });



                    }else{
                        swal("Deleted!", "Your imaginary Data has been not  deleted.", "error"); 
                    }

                }
            })
 });
}

    </script>