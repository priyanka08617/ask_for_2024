<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Location Timeline</title>
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

    .grText{
        color: green;
    }

    
    .redText{
        color: red;
    }

    .blueText{
        color: blueviolet;
    }
    </style>
</head>

<body>
    <div class='container-fluid' style=''>
        <!-- Form Name -->
        <h3> Items movement In Location </h3><small class='text-muted'>Start typing the location details, the timeline will be shown accordingly.</small>
   
        <hr>


        <div class='form-group row'>
<div class='col-md-1'></div>
<div class='col-md-2'><label class='control-label' for='uom'>Location Details</label></div>
<div class='col-md-8'>
<select class='form-control' placeholder='Start Typing Location Name...' onchange="fetch_location_item_details(this.value);" name='location_id' id='location_id'>
<option value=''>--Select--</option>
<?php

$sql="SELECT * FROM location WHERE status='1' AND id='$store_id'";
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
               $id=$row['id'];

               $location_category_id=$row['location_cat_id'];
               $location_category=singleRowFromTable($conn, "SELECT * FROM  location_category  WHERE id='$location_category_id'", "category");
             $locations_name=$row['location'];

echo "<option value='".$id."'>".$locations_name." (".$location_category.")</option>";

               }
?>
</select>
</div>
</div>


<br>
<br>
<!-- Showing item details for item id - 1003 -->
<div id="summary"></div>

 

<script>

$(document).ready( function () {







    });
</script>

<script>
        $("#location_id").select2();
   function fetch_location_item_details(location_id){
    // $("#summary").html("");


    // var d=$("#location_id").val();
    // alert(location_id);
          $.ajax({
            type:"get",
            data:{
                location_id:location_id
            },
            url:"../controllers/ajax/ajax_find_location_timeline.php",
              success:function(rvalue){
                // alert(rvalue);

                $("#summary").empty();
            $("#summary").append(rvalue);



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











              }
          });
   }
    </script>