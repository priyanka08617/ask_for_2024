<?php
 include '../includes/check.php';
 include '../includes/functions.php';
 header('Content-Type: application/json');  // Make sure you're sending JSON

//  ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$searchTerm = $requestData['search']['value']; // Search term from DataTables input
// $searchTerm ="";
// 1. Get total number of records (without any filter)
$totalDataSQL = "SELECT COUNT(*) AS totalData FROM `enquiry_management_new` WHERE `status`='1'";
$totalData_query = mysqli_query($conn, $totalDataSQL);
$row_totalData = mysqli_fetch_assoc($totalData_query);
$totalData = $row_totalData['totalData'];

// // 2. Get total number of records with filtering applied (totalFiltered)
$sql_totalFiltered = "
    SELECT COUNT(*) AS totalFiltered
    FROM enquiry_management_new e
    JOIN dp ON e.enquiry_product LIKE CONCAT('%', dp.mtm, '%')    
    JOIN customer_details c ON e.customer_id = c.id
    LEFT JOIN branch b ON e.source = b.id AND e.source_type = 'walking'
    JOIN users u ON u.id = e.created_by 
    JOIN dp_category dpc ON dpc.id = e.enquiry_category
    WHERE e.status='1'
";

// Apply search filter if $searchTerm is provided
if (!empty($searchTerm)) {
    $sql_totalFiltered .= " AND (e.enquiry_for LIKE '%".$searchTerm."%' ";
    $sql_totalFiltered .= " OR e.source_type LIKE '%".$searchTerm."%' ";
    $sql_totalFiltered .= " OR e.source LIKE '%".$searchTerm."%' ";
    $sql_totalFiltered .= " OR c.name LIKE '%".$searchTerm."%' ";
    $sql_totalFiltered .= " OR c.mobile LIKE '%".$searchTerm."%' ";
    // $sql_totalFiltered .= " OR dpc.category_name LIKE '%".$searchTerm."%' ";
    $sql_totalFiltered .= " OR e.enquiry_product REGEXP  '%".$searchTerm."%' ";
    $sql_totalFiltered .= " OR e.enquiry_detail LIKE '%".$searchTerm."%' ";
    $sql_totalFiltered .= " OR CONCAT(u.first_name, ' ', u.last_name) LIKE '%".$searchTerm."%' ";
    $sql_totalFiltered .= " OR CASE 
                               WHEN e.enquiry_status = 1 THEN 'Open' 
                               WHEN e.enquiry_status = 0 THEN 'Closed' 
                               ELSE 'open' 
                             END LIKE '%".$searchTerm."%' ";
    $sql_totalFiltered .= " OR e.row_created_by LIKE '%".$searchTerm."%' )";
}

$result_totalFiltered = mysqli_query($conn, $sql_totalFiltered);
$row_totalFiltered = mysqli_fetch_assoc($result_totalFiltered);
$totalFiltered = $row_totalFiltered['totalFiltered'];


// 3. Main query to fetch the actual data (with pagination and filters)
$sql = "
    SELECT e.id, e.enquiry_for as enquiry_for_data, e.source_type as source_type_data, e.row_created_by,
           c.id as customer_id, c.name as customer_name, c.mobile as mobile, 
           e.enquiry_date, dpc.category_name, e.enquiry_product, 
           e.enquiry_detail, e.store_id, e.user_category_id, 
           CONCAT(u.first_name, ' ', u.last_name) AS created_by, 
           CASE 
               WHEN e.enquiry_status = 1 THEN 'Open' 
               WHEN e.enquiry_status = 0 THEN 'Closed' 
               ELSE 'open' 
           END AS enquiry_status,
           CASE 
               WHEN e.source_type = 'referral' THEN c.display_name 
               WHEN e.source_type = 'walking' THEN b.name 
               ELSE e.source 
           END AS source
    FROM enquiry_management_new e

    JOIN customer_details c ON e.customer_id = c.id
    LEFT JOIN branch b ON e.source = b.id AND e.source_type = 'walking'
    JOIN users u ON u.id = e.created_by 
    JOIN dp_category dpc ON dpc.id = e.enquiry_category
    WHERE e.status='1'
";
// JOIN dp ON e.enquiry_product LIKE CONCAT('%', dp.mtm, '%')    
// Apply search filter if $searchTerm is provided
if (!empty($searchTerm)) {
    $sql .= " AND (e.enquiry_for LIKE '%".$searchTerm."%' ";
    $sql .= " OR e.source_type LIKE '%".$searchTerm."%' ";
    $sql .= " OR e.source LIKE '%".$searchTerm."%' ";
    $sql .= " OR c.name LIKE '%".$searchTerm."%' ";
    $sql .= " OR c.mobile LIKE '%".$searchTerm."%' ";
    $sql .= " OR dpc.category_name LIKE '%".$searchTerm."%' ";
    $sql .= " OR e.enquiry_product REGEXP  '%".$searchTerm."%' ";
    $sql .= " OR e.enquiry_detail LIKE '%".$searchTerm."%' ";
    $sql .= " OR CONCAT(u.first_name, ' ', u.last_name) LIKE '%".$searchTerm."%' ";
    $sql .= " OR CASE 
                   WHEN e.enquiry_status = 1 THEN 'Open' 
                   WHEN e.enquiry_status = 0 THEN 'Closed' 
                   ELSE 'open' 
                 END LIKE '%".$searchTerm."%' ";
    $sql .= " OR e.row_created_by LIKE '%".$searchTerm."%' )";
}

// Fetch pagination parameters from DataTables (with defaults)
// $start = isset($_POST['start']) ? intval($_POST['start']) : 0;
// $length = isset($_POST['length']) ? intval($_POST['length']) : 10;

// // Add LIMIT and OFFSET for pagination
// $sql .= " LIMIT $length OFFSET $start";

$query = mysqli_query($conn, $sql);

// 4. Fetch data and prepare response for DataTables
$data = array();
while ($row = mysqli_fetch_array($query)) {
    $enquiryProduct = unserialize($row['enquiry_product']);  // Unserialize product array
    $customer_mobile = $row['mobile'];
    $action = '<a href="../controllers/enquiry_management_delete.php"><img src="../img/delete.png" width="20px"></a>';
    $view = '<a href="../views/enquiry_timeline_new.php?mobile_no='.$customer_mobile.'" target= "_blank"><button type="button" class="btn btn-primary btn-sm btn-block">view</button></a>';

    $nestedData = array();
    $nestedData['id'] = $row['id'];
    $nestedData['enquiry_for'] = $row['enquiry_for_data'];
    $nestedData['source_type'] = $row['source_type_data']."||".$row['source'];
    // $nestedData['customer_details'] = $row['customer_name'];  
    // $nestedData['enquiry_date'] = $row['enquiry_date'];
    // $nestedData['enquiry_category'] = $row['category_name'];
    // $nestedData['enquiry_product'] = $enquiryProduct;
    // $nestedData['enquiry_detail'] = $row['enquiry_detail'];
    // $nestedData['view'] = $view;
    // $nestedData['enquiry_status'] = $row['enquiry_status'];
    // $nestedData['created_by'] = $row['created_by'];
    // $nestedData['row_created_on'] = $row['row_created_by'];
    // $nestedData['action'] = $action;

    $data[] = $nestedData;
}

// 5. Return the data as JSON for DataTables
$json_data = array(
    "draw"            => intval( 0 ),   // For DataTables draw counter
    "recordsTotal"    => intval( $totalData ),  // Total records (without filtering)
    "recordsFiltered" => intval( $totalFiltered ), // Total records (with filtering)
    "data"            => $data   // The actual data for the current page
);


// $json_data = array(
//     "draw"            => intval( 0 ),   // For DataTables draw counter
//     "recordsTotal"    => intval( 10 ),  // Total records (without filtering)
//     "recordsFiltered" => intval( 10 ), // Total records (with filtering)
//     "data"            => $data   // The actual data for the current page
// );

echo json_encode($json_data);
// exit;
// echo "<pre>";
// print_r($json_data);
// echo "</pre>";
?>
