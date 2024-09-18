<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Process Details</title>
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


    .disabled_tr {
        opacity: 0.4;
    }
    </style>
</head>

<body>
    <!-- -fluid -->
    <div class="container-fluid">

        <h3> Process Action </h3>
        <small class='text-muted'>Manage Process Action data </small>
        <hr></hr>

        <ul class='nav nav-tabs nav-justified'>
            <li class='nav-item'><a class='nav-link ' data-toggle='tab' href='#home'>Process Action</a></li>
            <li class='nav-item'>
                <a class='nav-link active' data-toggle='tab' href='#menu1'>Existing Process Action </a>
            </li>
        </ul>
        <br>


        <div class='tab-content'>
            <div id='home' class='tab-pane in fade'>
                <form action="../controllers/add_process_action.php" method="post">


                    <div class="form-group row">
                        <label for="transfer_reason" class="col-2 col-form-label">Process Name</label>
                        <div class="col-9">
                            <select id="process_name" name="process_id" class="form-control" style="width:100%">
                                <option value=" ">select</option>
                                     <?php
                                    $sql="SELECT * FROM process_master WHERE status='1' ORDER BY id DESC";
                                    $query=mysqli_query($conn,$sql);
                                    while($row=mysqli_fetch_array($query)){
                                        echo "<option value='".$row["id"]."'>".$row["process_name"]."</option>";
                                    }
                                    
                                    ?>
                            </select>

                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="transfer_reason" class="col-2 col-form-label">Processing Reason</label>
                        <div class="col-9">
                            <select id="process_reason" name="process_reason_id" class="form-control" required
                                onchange="check_process(this.value)">
                                <option value=" ">select</option>
                                <!-- <option value="1">Tender / Client</option> -->
                                <option value="0">General Preparation</option>
                            </select>

                        </div>
                    </div>



                    <div id="tender_client">

                        <div class="form-group row">
                            <label for="transfer_reason" class="col-2 col-form-label">Client Name</label>
                            <div class="col-9">
                                <select id="client_name" name="client_id" class="form-control" style="width:100%"
                                    required>
                                    <option value=" ">select</option>
                                    <?php
                                            $sql="SELECT * FROM railway WHERE status='1' ORDER BY id DESC";
                                            $query=mysqli_query($conn,$sql);
                                            while($row=mysqli_fetch_array($query)){
                                                $rail_zone_id=$row["rail_zone_id"];
                                                $railway_zone     = fetch_data($conn,"railway_zone","id",$rail_zone_id);
                                                echo "<option value='".$row["id"]."'>".$row["railway"]." (".$railway_zone["rail_zone"].")"."</option>";
                                            }
                                            
                                            ?>
                                </select>

                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="transfer_reason" class="col-2 col-form-label">Tender / PO Specification</label>
                            <div class="col-9">
                                <select id="tender_po_specification" name="tender_po_specification_id"
                                    class="form-control" onchange="po_specification(this.value)" required>
                                    <option value=" ">select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>

                            </div>
                        </div>

                        <div id="yes">

                            <div class="form-group row">
                                <label for="transfer_reason" class="col-2 col-form-label">Selct PO/Tender</label>
                                <div class="col-9">
                                    <select id="po_tender_id" name="po_tender_id" class="form-control" style="width:100%" required>
                                        <option value=" ">select</option>
                                        <?php
                                                $sql="SELECT * FROM client_po WHERE status='1' ORDER BY id DESC";   
                                                $query=mysqli_query($conn,$sql);
                                                while($row=mysqli_fetch_array($query)){

                                                    echo "<option value='".$row["id"]."'>".$row["po_no"]."</option>";
                                                }
                                        ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>





                    <div class="form-group row">
                        <label for="transfer_reason" class="col-2 col-form-label"></label>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
            <div id='menu1' class='tab-pane in active'>

                <table class='table table-sm table-hover' id='example'>
                    <thead>
                        <th>#</th>
                        <th>Process Name</th>
                        <th>Processing Reason</th>
                        <th>Client Name</th>
                        <!-- <th>Tender / PO Specification</th> -->
                        <th>Step Description</th>
                        <th>Created On</th>
                        <!-- <th>Status</th> -->
                        <th>Progress</th>
                    </thead>

                    <tfoot>
                        <th>#</th>
                        <th>Process Name</th>
                        <th>Processing Reason</th>
                        <th>Client Name</th>
                        <!-- <th>Tender / PO Specification</th> -->
                        <th>Step Description</th>
                        <th>Created On</th>
                        <!-- <th>Status</th> -->
                        <th>Progress</th>

                    </tfoot>
                    <tbody>
                        <!-- // ************************************************************  -->
                        <?php
   $c=0; 
 
              $sql='SELECT * FROM process_action WHERE status="1" ORDER BY id DESC';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
                $c++;
               
                $id = $row['id']; 
                $process_id    = $row['process_id'];
                $client_id     = $row['client_id'];
                $po_tender_id  = $row['po_tender_id'];
                $row_created_on= $row['row_created_on'];  
                $process_reason_id = $row['process_reason'];   
                $tender_po_specification_id = $row['tender_po_specification_id'];  
               

                $process_name=fetch_data($conn,"process_master","id",$process_id);
                $client_data=fetch_data($conn,"railway","id",$client_id);
                $client_po=fetch_data($conn,"client_po","id",$po_tender_id);

                if($process_reason_id==1){
                    $process_reason="Tender / Client";
                    $client_name=$client_data["railway"];
                }elseif($process_reason_id==0){
                    $process_reason="General Preparation";
                    $client_name="N.A";
                }

                if($tender_po_specification_id==1){
                    $po_no=$client_po["po_no"];
                }elseif($tender_po_specification_id==0){
                    $po_no="N.A";
                }


                echo '<tr>';
                echo '<td>'. $c.'</td>';
                echo '<td>'. $process_name["process_name"].'</td>';
                echo '<td>'. $process_reason.'</td>';
                echo '<td>'. $client_name.'</td>';
                // echo '<td>'. $po_no.'</td>';
                echo '<td> <button type="button" class="btn btn-warning btn-block" onclick="get_process_master('.$id.')">Expand</button></td>';
                echo '<td>'.dateForm($row_created_on).'</td>';
                 echo '<td>'.progress_bar($conn,$id).' % done</td>';
                

                // echo '<td><a href="../controllers/stock_locations_del.php?id='.$id.'"><button type="button" class="btn btn-danger" >Remove</button></a></td>';
                // echo '<td>'. $po_no.'</td>';
                // echo '<td>'. $po_no.'</td>';

                echo '</tr>';
}
 ?>
                    </tbody>
                </table>






                <!-- The Modal -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Process Action Step Details</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <div id="box"> </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>






            </div>
        </div>
        <script>
        $(document).ready(function() {
            $("#tender_client").hide();
            $("#yes").hide();
            $("#client_name").select2();
            $("#process_name").select2();
            $("#po_tender_id").select2();
            
        });

        function get_process_master(process_action_id) {
            $("#box").empty();
            $.ajax({
                type: "POST",
                data: {
                    process_id: process_action_id
                },
                url: "../controllers/ajax/ajax_fetch_process_step_master_for_process_action.php",
                success: function(data) {
                    // alert(data);

                    $('#myModal').modal("show");
                    $("#box").append(data);
                    
                }
            });
        }

        function check_process(manufacturing_for) {
            if (manufacturing_for == 1) {
                $("#tender_client").show();
            }

            if (manufacturing_for == 0) {
                $("#tender_client").hide();

            }
        }

        function po_specification(yes_or_no) {
            // alert(yes_or_no);
            if (yes_or_no == 1) {
                $("#yes").show();
            }
            if (yes_or_no == 2) {
                $("#yes").hide();

            }
        }


        function step_change(step_change_id, process_action_id) {
            var check = confirm('Are you confirm ?');
            if (check) {
                $.ajax({
                    type: "POST",
                    data: {
                        step_change_id: step_change_id
                    },
                    url: "../controllers/process_step_update.php",
                    success: function(data) {
                        // alert(data);
                        $('#myModal').modal("show");
                        get_process_master(process_action_id);

                        location.reload(); 
                    }
                });
            } else {
                $('#myModal').modal("show");
                get_process_master(process_action_id);
            }

        }



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
        </script>


</body>

</html>