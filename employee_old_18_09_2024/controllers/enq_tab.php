<?php
 include '../includes/check.php';
 include '../includes/functions.php';
$columns = array( 
    0 => 'id', 
    1 => 'enquiry_for',
    2 => 'source_type',
    3 => 'source',
    4 => 'customer_id',
    5 => 'enquiry_date',
    6 => 'enquiry_category',
    7 => 'enquiry_product',
    8 => 'enquiry_detail',
    9 => 'store_id',
    10 => 'user_category_id',
    11 => 'created_by',
    12 => 'enquiry_status',
    13 => 'row_created_by',
    14 => 'status'
);

$requestData = $_POST;

// $searchTerm = $requestData['search']['value'];
$searchTerm ="";

// $sql = "SELECT id, enquiry_for, source_type, source, customer_id, enquiry_date, enquiry_category, enquiry_product, enquiry_detail, store_id, user_category_id, created_by, enquiry_status, row_created_by, status FROM enquiry_management_new WHERE 1=1";



$sql= "SELECT e.id, e.enquiry_for, e.source_type, e.source, c.id as customer_id, e.enquiry_date, 
               e.enquiry_category, e.enquiry_product, e.enquiry_detail, e.store_id, 
               e.user_category_id, e.created_by, e.enquiry_status, e.row_created_by, e.status 
        FROM enquiry_management_new e 
        JOIN customer_details c ON e.customer_id = c.id ";

// if(!empty($searchTerm)) {
//     $sql .= " AND (enquiry_for LIKE '%".$searchTerm."%' ";
//     $sql .= " OR source_type LIKE '%".$searchTerm."%' ";
//     $sql .= " OR source LIKE '%".$searchTerm."%' ";
//     $sql .= " OR customer_id LIKE '%".$searchTerm."%' ";
//     $sql .= " OR enquiry_date LIKE '%".$searchTerm."%' ";
//     $sql .= " OR enquiry_category LIKE '%".$searchTerm."%' ";
//     $sql .= " OR enquiry_product LIKE '%".$searchTerm."%' ";
//     $sql .= " OR enquiry_detail LIKE '%".$searchTerm."%' ";
//     $sql .= " OR store_id LIKE '%".$searchTerm."%' ";
//     $sql .= " OR user_category_id LIKE '%".$searchTerm."%' ";
//     $sql .= " OR created_by LIKE '%".$searchTerm."%' ";
//     $sql .= " OR enquiry_status LIKE '%".$searchTerm."%' ";
//     $sql .= " OR row_created_by LIKE '%".$searchTerm."%' ";
//     $sql .= " OR status LIKE '%".$searchTerm."%' )";
// }

// " ORDER BY ".$columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."
// ORDER BY ".$columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']." 
// $sql.=   "LIMIT ".$requestData['start']." ,".$requestData['length']."   ";



$query = mysqli_query($conn, $sql);

$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;

// $sql .= "  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
// $query = mysqli_query($conn, $sql);

$data = array();
while( $row = mysqli_fetch_assoc($query) ) {
    $nestedData = array();
    $nestedData['id'] = $row['e.id'];
    $nestedData['enquiry_for'] = $row['e.enquiry_for'];
    // $nestedData['source_type'] = $row['source_type'];
    // $nestedData['source'] = $row['source'];
    // $nestedData['customer_id'] = $row['customer_id'];
    // $nestedData['enquiry_date'] = $row['enquiry_date'];
    // $nestedData['enquiry_category'] = $row['enquiry_category'];
    // $nestedData['enquiry_product'] = unserialize($row['enquiry_product']);  // Unserialize the array
    // $nestedData['enquiry_detail'] = $row['enquiry_detail'];
    // $nestedData['store_id'] = $row['store_id'];
    // $nestedData['user_category_id'] = $row['user_category_id'];
    // $nestedData['created_by'] = $row['created_by'];
    // $nestedData['enquiry_status'] = $row['enquiry_status'];
    // $nestedData['row_created_by'] = $row['row_created_by'];
    // $nestedData['status'] = $row['status'];

    $data[] = $nestedData;
}

$json_data = array(
    // "draw"            => intval( $requestData['draw'] ),   
    "recordsTotal"    => intval( $totalData ),  
    "recordsFiltered" => intval( $totalFiltered ), 
    "data"            => $data   
);

echo json_encode($json_data);

print_r($data);

?>
