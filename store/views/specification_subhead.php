<?php
ob_start();
include '../includes/connection.php';
include '../includes/functions.php';   

$specificationId=sanitize_input($conn,$_GET["specification_head_id"]);

$specificationName=fetch_data($conn, "specification_head","id",$specificationId);


$table_create='';
if (isset($_POST['add'])){
$specification_head_id_onpage_submit = $_POST["specification_head_id_onpage_submit"];
$specification_subhead_onpage_submit = $_POST["specification_subhead_onpage_submit"];

for($i=0;$i<count($specification_subhead_onpage_submit);$i++){
$headId = sanitize_input($conn,$specification_head_id_onpage_submit[$i]); 
$subheadName = sanitize_input($conn,$specification_subhead_onpage_submit[$i]); 
$column_array[]=$subheadName;
$sql="INSERT INTO `specification_subhead`(`specification_head_id`,`subhead_name`,`status`) VALUES ('$headId','$subheadName','1')";
$query=mysqli_query($conn,$sql);

}
header("location:../views/specification_subhead.php?specification_head_id=".$specification_head_id_onpage_submit);
}





if(isset($_POST["btnUpdate"])){
    $field_id_E=$_POST["field_id_E"];
    $field_name_E=$_POST["field_name_E"];
    $field_data_E=$_POST["field_data_E"];


  $sql_update="UPDATE `specification_subhead_data` SET `subhead_data`='$field_data_E' WHERE `id`='$field_id_E'";
 mysqli_query($conn,$sql_update);
echo mysqli_error($conn);
header("location:../views/specification_subhead.php?specification_head_id=".$specificationId);
}





?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include '../includes/header.php'; ?>
    <title></title>
    <style>
    /* #box{
            border: 1px solid gray;
            margin: 100px 100px 100px 100px;
            padding: 70px 70px 70px 70px;
        } */

    /* #p_format{
            font-size: 20px;
        }

        .footer{
            display: disabled;
        }

        h4{
            color:#606060;
        } */

    /* hr{
    background-color: lightgray;
    /* border: none; */
    /* color: blue; */
    /* height: 1px; */
    /* } */




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




    <style>.box {
        style: border:none;
        margin-bottom: 15px;
        background: #f6d78b;
        min-height: 70px;
        color: #4d4d4d;
        padding: 15px;
        cursor: pointer;
        border-radius: 15px;

    }
    </style>

    </style>
</head>

<body>

    <?php include '../includes/navbar.php'; ?>
    <div class="container-fluid">

        <h3 style="font-family: Sans-serif;"><b> SUBHEAD MASTER OF --- " <?php echo $specificationName["head_name"];?>
                "</b></h3>
        <p style="font-family: Sans-serif;color: #808080;">Import and Showing all existing customer details</p>
        <hr>
        </hr>



        <div id="accordion">
            <div class="card">
                <div class="card-header">
                    <a class="card-link" data-toggle="collapse" href="#collapseTwo">
                        <h5 align="center" style="font-style:italic;color:cadetblue"><b>BRAND MODEL SPECIFICATION
                                SUBHEAD CREATION FORM</b></h5>
                    </a>
                </div>
                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <!-- <h4> <b>Customer Details</b></h4> -->
                        <br>
                        <center>
                            <form method="post" action="">

                                <input type="text" class="form-control" placeholder=" "
                                    id="specification_head_id_onpage_submit" name="specification_head_id_onpage_submit"
                                    value="<?php echo $specificationId;?>">


                                <div class="input-group mb-3" style="width:600px">
                                    <span class="input-group-text"> Head</span>
                                    <input type="text" class="form-control" placeholder=" " id="" name=""
                                        value="<?php echo $specificationName["head_name"];?>" readonly>
                                </div>

                                <div class="input-group mb-3" style="width:600px">
                                    <span class="input-group-text">Subhead 1</span>

                                    <input type="text" class="form-control" placeholder=" "
                                        id="specification_subhead_onpage_submit"
                                        name="specification_subhead_onpage_submit[]">


                                </div>



                                <div id="dynamicSubhead"></div>

                                <div class="row" style="margin-left:430px">
                                    <div class="input-group mb-3 d-grid" style="width:600px">
                                        <!-- <span class="input-group-text"></span> -->
                                        <button type="submit" class="btn btn-outline-primary btn-block" id="add"
                                            name="add">Submit</button>
                                    </div>

                                    <div class="input-group mb-3" style="width:80px">
                                        <button type="button" class="btn btn-outline-primary" id="add_more"
                                            name="add_more">add</button>
                                    </div>
                                </div>

                            </form>
                        </center>
                    </div>
                </div>
            </div>
            <!-- // card -->

        </div>
        <!-- // accordin -->





        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified">
            <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#home">Create Subhead Data Of
                    <?php echo $specificationName["head_name"];?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#menu1">Existing Subhead Data Of
                    <?php echo $specificationName["head_name"];?></a>
            </li>
        </ul>


        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane in fade" id="home">
                <br><br>







                <form method="post" action="../controllers/specification_subhead_update.php">
                    <center>
                        <?php
$c=0;
$sql1="SELECT * FROM specification_subhead WHERE specification_head_id='$specificationId'";
$query1=mysqli_query($conn,$sql1);
while($row1=mysqli_fetch_array($query1)){
    $c++;
  $subhead_id=$row1["id"];
    $subhead=$row1["subhead_name"];
    

    ?>

                        <input type="hidden" class="form-control" placeholder="" id="specification_head_id"
                            name="specification_head_id" value="<?php echo $specificationId;?>">

                        <input type="hidden" class="form-control" placeholder="" id="subhead_id" name="subhead_id[]"
                            value="<?php echo $subhead_id;?>">
                        <div class="input-group mb-3" style="width:600px">
                            <span class="input-group-text"> <?php echo $c; ?></span>
                            <input type="text" class="form-control" placeholder="" id="subhead_data"
                                name="subhead_data[]" value="<?php echo $subhead; ?>">
                        </div>






                        <?php

}
?>

                        <div class="input-group mb-3" style="width:600px">
                            <button type="submit" class="btn btn-outline-primary btn-block">Update Data</button>
                        </div>
                    </center>
                </form>


            </div>
            <div class="tab-pane in active" id="menu1">






                <br>
                <div class="row">

                    <?php
$sql = "SELECT * FROM specification_subhead WHERE specification_head_id='$specificationId' AND status='1'";
$result = mysqli_query($conn,$sql);
while($row_subhead = mysqli_fetch_array($result)){

$subhead_id=$row_subhead['id'];
$subhead_name=$row_subhead["subhead_name"];

$edit_modal_params_string="'$subhead_id','$subhead_name'";
$edit_modal_params="openModel_data(".$edit_modal_params_string.")";
   ?>


                    <div class='col-md-6 col-sm-6 col-xs-6'>
<!-- //// -->

                    <div id="accordion">

  <div class="card">
  <a class="card-link" data-toggle="collapse" href="#collapseOne_<?php echo $subhead_id;?>">
    <div class="card-header">
      
    <h5 align="center"><b><?php echo $subhead_name;?></b></h5>  
      </div>
      </a>
      <div id="collapseOne_<?php echo $subhead_id;?>" class="collapse show" data-parent="#accordion">
      <div class="card-body">
      <!-- // -->
<button type="button" class="btn btn-block btn-sm btn-info" data-toggle="modal" data-target="#myModal_for_add_subhead_data"  height="30px" onclick="<?php echo $edit_modal_params;?>"> + Add <?php echo $subhead_name;?> Data</button>
                        <table class="table table-striped table-sm">
                            <thead>
                                <?php 
  echo  "<th>#</th>";
  echo   "<th>".$subhead_name."</th>"; 
  echo '<th> Action</th>';
      ?>
                            </thead>
                            <tbody>

                                <?php
      $c=0;
      $num="";
       $sql="SELECT * FROM specification_subhead_data WHERE   status='1' AND specification_subhead_id='$subhead_id'";
       $query=mysqli_query($conn,$sql);
       $num=mysqli_num_rows($query);
       if($num>0){
       $sub=0;
      while($row=mysqli_fetch_array($query)){
        $sub++; 
        $id=$row["id"];
        $subhead_data=$row["subhead_data"];
        $specification_subhead_id=$row["specification_subhead_id"];
        $specification_subhead_name=$hsn_code=singleRowFromTable($conn, "SELECT * FROM specification_subhead WHERE id='$specification_subhead_id'", "subhead_name");


        echo "<tr>";
        echo "<td>".$sub."</td>"; 
        echo "<td><input type='hidden' id=''>".$subhead_data."</td>"; 


        $edit_modal_params_string="'$id','$specification_subhead_name','$subhead_data','1'";
        $edit_modal_params='openModel('.$edit_modal_params_string.')';
        echo '<td><img src="../img/edit.png" width="30px"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'"> || <img src="../img/delete.png" width="30px" onclick="delete_func('.$id.')"></td>';
        echo '<td></td>';
    
        // echo "<td><button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#myModal' onclick='".$edit_modal_params."'>edit</button></td>";
        // echo '<td><a href="../controllers/specification_subhead_del.php?id='.$id.'" onclick="return confirm(\'Are you sure\')"><img src="../img/delete.png" height="30px"></a></td>'; 
        
        echo "</tr>";
        
          
         
        }
    }else{
        echo "<td colspan='0'></td><td>No data Found</td>";
    }

       

        // $edit_modal_params_string="$id,$value";
      ?>

                            </tbody>
                        </table>
                        </div></div></div></div>
                        <!-- // end accordin -->
                    </div>
                    <?php
}
    ?>

                </div>


            </div>
        </div>



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
        <div class='modal' id='myModal_for_add_subhead_data'>
            <div class='modal-dialog modal-lg'>
                <div class='modal-content'>
                    <!-- Modal Header -->
                    <div class='modal-header'>
                        <h4 class='modal-title'>Add Specification Subhead Data</h4>
                        <button type='button' class='btn-close' data-dismiss='modal'></button>
                    </div>
                    <!-- Modal body -->
                    <div class='modal-body'>
                        <form class='form' action='../controllers/item_update.php' method='POST'>


                            <input type='hidden' class='form-control' name='subhead_id_E' id='subhead_id_E'>



                            <!-- //  content  2 -->
                            <div class='form-group row'>
                                <div class='col-md-2'></div>
                                <div class='col-md-3'>
                                    <label for='comment'>Subhead Name</label>
                                </div>
                                <div class='col-md-5'>
                                    <input type='text' class='form-control' placeholder='Enter subhead name'
                                        name='subhead_name_add' id='subhead_name_add' readonly>
                                </div>
                            </div>

                            <div class='form-group row'>
                                <div class='col-md-2'></div>
                                <div class='col-md-3'>
                                    <label for='comment'>Subhead Data Name</label>
                                </div>
                                <div class='col-md-5'>
                                    <input type='text' class='form-control' placeholder='Enter subhead name'
                                        name='subhead_data_name' id='subhead_data_name'>
                                </div>
                            </div>





                            <div class='row'>
                                <div class='col-md-5'></div>
                                <div class='col-md-5'>
                                    <button type='button' class='btn btn-primary btn-block btn-sm'
                                        onclick='specification_head_add();'>Submit</button>

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




</body>
<script>
function openModel_data(subhead_id, subhead_name) {
    $('#subhead_id_E').val(subhead_id);
    $('#subhead_name_add').val(subhead_name);
    // $('#subhead_data_name').val(subhead_data_name);
}




function openModel(id, category, data, status) {
        $('#field_id_E').val(id);
        $('#field_name_E').val(category);
        $('#field_data_E').val(data);
        $("#field_span_category").html(category);
       
    }



function getProduct_id(product_id) {
    $.ajax({
        type: "POST",
        data: {
            product_id: product_id
        },
        url: "../controllers/ajax/getBrand.php",
        success: function(result) {
            alert(result);
            $("#brand_id").empty();
            $("#brand_id").append(result);
        }
    });
}

var c = 1;
$("#add_more").click(function() {
    c++;
    // alert("hi");
    $("#dynamicSubhead").append(
        '<div class="input-group mb-3" style="width:600px"><span class="input-group-text">Subhead ' + c +
        '</span><input type="text" class="form-control" placeholder=" " id="subhead' + c +
        '" name="subhead[]"></div>');
});





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




function specification_head_add() {
    swal({
            title: "Are you sure , you want to submit?",
            text: "You are adding this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Add it!",
            closeOnConfirm: false
        },
        function() {

            var subhead_id_E = $("#subhead_id_E").val();
            var subhead_data_name = $("#subhead_data_name").val();
            $.ajax({
                data: {
                    specification_subheadId: subhead_id_E,
                    subhead_data_name: subhead_data_name
                },
                url: "../controllers/specification_subhead_add.php",
                type: "POST",
                cache: false,
                success: function(data) {
                    // alert(data);
                    if (data == 1) {


                        swal({
                                type: "success",
                                title: "Added!",
                                text: "Your imaginary file has been Added!",
                                icon: "success",
                                button: "ok!"
                            },
                            function(ok) {
                                if (ok) {
                                    location.reload();
                                }
                            });



                    } else {
                        swal("Not Added!", "Your imaginary file has been not  Added.", "error");
                    }

                }
            })
        });


}
</script>

</html>