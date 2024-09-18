<?php ob_start(); include '../includes/check.php';?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Enquiry Management Details</title>
 
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
    </style>
</head>

<body>


<!-- HTML table structure -->
<table id="enquiryTable" class="display" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Enquiry For</th>
            <th>Source Type</th>
                <!-- <th>Customer Details</th>
                <th>Enquiry Date</th>
                <th>Enquiry Category</th>
                <th>Enquiry Product</th>
                <th>Enquiry Detail</th>
                <th>Status</th>
                <th>Created By</th>
                <th>Created On</th>
                <th>Action</th> -->
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>



</body>
<script type="text/javascript">
$(document).ready(function() {
    $('#enquiryTable').DataTable({
        "processing": true,  // Show a processing indicator during data loading
        "serverSide": true,  // Enable server-side processing
        "ajax": {
            "url": "../controllers/enquiry_management_view_table_call.php",  // The path to your PHP script
            "type": "POST",  // Send data using POST method
            "datatype": 'json',
            "data": function(d) {}
        },
        "columns": [
            { "data": "id" },  // Match the key names returned by your PHP data
            { "data": "enquiry_for" },
            { "data": "source_type" },
            // { "data": "customer_details" },
            // { "data": "enquiry_date" },
            // { "data": "enquiry_category" },
            // { "data": "enquiry_product" },
            // { "data": "enquiry_detail" },
            // { "data": "view" },
            // { "data": "enquiry_status" },
            // { "data": "created_by" },
            // { "data": "row_created_on" },
            // { "data": "action" }  // For buttons or actions like view/delete
        ],



        "order": [[0, 'asc']],  // Default sort by the first column
        "lengthMenu": [10, 25, 50],  // Control how many entries per page are displayed
        "pageLength": 10,  // Default number of entries per page
        "searching": true  // Enable search box
    });
});
</script>
