<?php
 include '../includes/check.php';
 include '../includes/functions.php';

//  $limit = $_GET['length'];
// $offset = $_GET['start'];
// $searchValue = $_GET['search']['value'];



$limit = 5;
$offset = 0;
// $searchValue = $_GET['search']['value'];


// Debugging - Check POST data
// error_log("POST data: " . json_encode($_POST));


// Read DataTable parameters

// $draw = $_POST['draw'];
// $start = $_POST['start'];
// $length = $_POST['length'];
// $search_term = $_POST['search']['value']; // Search value

$searchValue ="21C1S03200";


// $draw = 0;
// $start =0;
// $length = 10;
// // $search_term = $_POST['search']['value']; // Search value


$totalRecords_sql="SELECT * FROM `enquiry_management_new`
WHERE `status`='1'
AND `store_id`='$store_id'";
// AND `created_by`='$user_id'
$totalRecords_query=mysqli_query($conn,$totalRecords_sql);
$totalRecords=mysqli_num_rows($totalRecords_query);






$data=array();
$c=0;
$enquiry_status_variable="";




$sql="";

// -- JOIN dp ON FIND_IN_SET(dp.id, REPLACE(REPLACE(enq.enquiry_product, 'a:',''), ';', ','))  LIMIT 10



$sql.="SELECT enq.*,c.*,enq.id as enq_id,enq.enquiry_for as enquiry_for,enq.status as `status`,enq.enquiry_date as enquiry_date,enq.enquiry_detail as enquiry_detail,enq.enquiry_product as enquiry_product  FROM enquiry_management_new enq JOIN customer_details c ON enq.customer_id = c.id
";

// Filter based on the search value
if (!empty($searchValue)) {
    $sql .= " WHERE EXISTS (
                  SELECT * 
                  FROM dp 
                  WHERE dp.id = enq.enquiry_product
                  AND FIND_IN_SET(dp.id, REPLACE(REPLACE(enq.enquiry_product, 'a:', ''), ';', ',')) 
                  AND dp.mtm LIKE '%$searchValue%'
              )";
}
        
$sql .= " LIMIT $offset, $limit";
    $query=mysqli_query($conn,$sql);
    echo mysqli_error($conn);
    echo $sql;
    while($row=mysqli_fetch_array($query)){

    $c++;



    $id=$row['enq_id'];
    $for=$row['enquiry_for'];
    $status=$row['status'];

    $enquiry_date= date('d-m-Y', strtotime($row['enquiry_date']));
    // $enquiry_date=$row['enquiry_date'];
    // $product_category= $row['dp_category.category_name'];
    // $mtm= $row['dp.mtm'];
    
    $enquiry_product_array=unserialize($row['enquiry_product']);
    $enquiry_product="";
    foreach ($enquiry_product_array as $productId) {
 
    $enquiry_product_name=singleRowFromTable($conn,"SELECT * FROM `dp` WHERE `id`='$productId'", "mtm");
    $enquiry_product.=$enquiry_product_name.",";
    }

    $enquiry_status_id=singleRowFromTable($conn,"SELECT * FROM `enquiry_management_timeline` WHERE `enquiry_management_id`='$id'  ORDER BY `id` DESC", "enquiry_status");
    

    $enquiry_detail=$row['enquiry_detail'];


  



    $data[] = array(
        "id"=>$c,"for"=>$for,
                    "enquiry_date"=>$enquiry_date,
                    // "source_type"=>$source_var,
                    // "customer_details"=>$customer_details,
                    // "product_category"=>$product_category,
                    "enquiry_product"=>$enquiry_product,
                    "enquiry_detail"=>$enquiry_detail,
                    // "poa"=>$poa,
                    // "view"=>$view,
                    // "enquiry_status"=>$enquiry_status_variable,
                    // "created_by"=>$created_by,
                    // "row_created_on"=>date('d-m-Y H:i',strtotime($row['row_created_on']))
                    // "action"=>$action
                    "status"=>$status
                  
                );


// $data[] = array(
//     "id"=>$c,"for"=>$for,
//                 "enquiry_date"=>$enquiry_date,
//                 "source_type"=>$source_var,
//                 "customer_details"=>$customer_details,
//                 "product_category"=>$product_category,
//                 "enquiry_product"=>$enquiry_product,
//                 "enquiry_detail"=>$enquiry_detail,
               
//                 // "action"=>$action
              
//             );



            // print_r($data);


}




    // $response = [
    //     "draw" => intval($draw),
    //     "recordsTotal" => $totalRecords,
    //     "recordsFiltered" =>$totalRecords,
    //     "data" => $data
    // ];

// echo json_encode($response);
echo "<pre>";
print_r($data);
echo "</pre>";

    ?>