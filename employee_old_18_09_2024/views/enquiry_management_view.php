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
    <div class='container-fluid' style=''>

                <table class='table table-striped table-sm' id='example' width='100%'>
                    <thead>
                        <th>#</th>
                        <th>For</th>
                        <th>Enquiry Date</th>
                        <th>Source</th>
                        <th>Customer</th>
                        <th>Enquiry Category</th>
                        <th>Enquiry Product</th>
                        <th>Enquiry Detail</th>
                        <th>Timeline</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Created On</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="t_body"></tbody>
                </table>
            </div>
            <!--// for tab-content  -->
        </div>
        <!--// container-fluid -->












    <script>
    function openModel(id, source, customer_name, customer_mobile, customer_mail, enquiry, status) {
        $('#id_E').val(id);
        $('#source_E').val(source);
        $('#customer_name_E').val(customer_name);
        $('#customer_mobile_E').val(customer_mobile);
        $('#customer_mail_E').val(customer_mail);
        $('#Enquiry_E').val(enquiry);
     
    }



    $(document).ready(function() {

  
// $('#submit_button_of_new_customer').attr('disabled', true);



        $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                // "url": "../controllers/enquiry_management_call_tableNew.php",
                // "url": "../controllers/enquiry_management_table_final_call.php",
                // "url": "../controllers/enq_tab.php",
                  "url": "../controllers/e.php",
                "type": "POST"
            },
            "columns": [{
                    "title": "#",
                    "render": function(data, type, row, meta) {
                        // Correct calculation for row number in server-side processing
                        return meta.row + 1 + meta.settings._iDisplayStart;
                    }
                },
                {
                    "data": "for"
                },
                {
                    "data": "enquiry_date"
                },
                {
                    "data": "source_type"
                },
                {
                    "data": "customer_details"
                },
                {
                    "data": "product_category"
                },
                {
                    "data": "enquiry_product"
                },
                {
                    "data": "enquiry_detail"
                },
              
                {
                    "data": "view"
                },
                {
                    "data": "enquiry_status"
                },
                {
                    "data": "created_by"
                },
                {
                    "data": "row_created_on"
                },
                {
                    "data": "action"
                }
            ]
        });
     

        // $("#enquiry_status").select2();
        // $("#disable_button").hide();

    });








    // function change_source(source_id, store_id) {
    // var sale_or_service = $('input[name="sale_or_service"]:checked').val();
    // //  alert(sale_or_service);
    //     $.ajax({
    //         url: "../controllers/ajax/ajax_source_for_enquiry_management.php",
    //         type: "POST",
    //         data: {
    //             source_id: source_id,
    //             store_id: store_id,
    //             sale_or_service:sale_or_service
    //         },
    //         success: function(res) {

    //             $("#source_div").empty();
    //             $("#source_div").append(res);


    //             console.log(res);
    //         }
    //     });
    // }












    



////////////////////////////////////// NEW /////////////////////////////////////////

    </script>
</html>


