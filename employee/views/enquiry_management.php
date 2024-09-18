
<?php ob_start();
    include '../includes/check.php';
   
    ?>
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <title> Pre Tender Tracker</title>
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


        table #example2 tr td {
            padding: 9px;
            font-weight: bold;
        }

        thead tr td {
            text-align: center;
        }
  

#hover_color_table2:hover, #hover_color_table1:hover{
    background-color: #9BD770;
    color:#ffffff;
} 

 .close{
    background-color:#ffffff;
}


.status-1 {
    background-color: #ffcccc; /* Light red */
}

.status-2 {
    background-color: #ccffcc; /* Light green */
}

.status-3 {
    background-color: #ffffcc; /* Light yellow */
}

.status-5 {
    background-color: #ccccff; /* Light blue */
}

        </style>


    </head>

    <body>

    
        <div class='container-fluid' style=''>
            <!-- Form Name -->
            <h3><span id="display_text"></span> Enquiry Management </h3>
            <small class='text-muted'>Fill in the given below tab to create Pre Tender Tracker and manage existing Pre  Tender Tracker </small><span style="float: right;"><a href="enquiry_management_creation.php"><button type="button" class="btn btn-outline-primary">+ Enquiry Creation </button></a></span>
            <hr></hr>


<table id="example" class='table table-sm table-hover display' style="width:100%">
    <thead>
            <th>#</th>
            <th>Enq For</th>
            <th>Source</th>
            <th>Customer</th>
            <th>Enq Date</th>
            <th>Product Cat</th>
            <th>Product</th>
            <th>Enq Detail</th>
            <th>Timeline</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Created On</th>
                        <th>Action</th>

    </thead>
</table>


</body>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "../controllers/enquiry_management_view_table_call.php",  // The PHP file you created
            "type": "POST"
        },
        "columns": [
            { "data": "id" },               // Data key must match the PHP output
            { "data": "enquiry_for" },      // Data key must match the PHP output
            { "data": "source_type" },
            { "data": "customer_detail"},
            { "data": "enquiry_date"},
            { "data": "enquiry_category" },
            { "data": "enquiry_product" },
            { "data": "enquiry_detail"},
            {"data": "view" },
            {"data": "enquiry_status"},
            {"data": "created_by"},
            {"data": "row_created_on"},
            { "data": "action" }       // Data key must match the PHP output
        ],
        "order": [[0, 'asc']],  // Default sort by the first column
        "lengthMenu": [10, 25, 50],  // Control how many entries per page are displayed
        "pageLength": 10,  // Default number of entries per page
        "searching": true  // Enable search box
    });
    });
// });
// var c = 1;

// $(document).ready(function() {


//     // Initialize DataTable
//     var table = $('#enquiryTable').DataTable({
//         "processing": true,
//         "serverSide": true,
//         "ajax": {
//             "url": "../controllers/p_cont.php",
//             "type": "POST",
//             "datatype": 'json',
//             "error": function(xhr, error, code) {
//                 console.log("Error details: ", xhr, error, code);
//             }
//         },
//         "columns": [
//             { "data": 0 }, // ID
//             { "data": 1 }, // Created By
//             { "data": 2 } // Railway
          
//         ],
        
//     });

// })
</script>
</html>