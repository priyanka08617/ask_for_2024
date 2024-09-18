
<?php
// Example PHP Backend (datatable.php)
include '../includes/check.php';
include '../includes/functions.php';


// $limit = 10; // Number of records per page
// $start = 01; // Start index for pagination
// $search = "Priyanka"; // Search value


$limit = $_GET['length']; // Number of records per page
$start = $_GET['start']; // Start index for pagination
$search = $_GET['search']['value']; // Search value


// Fetch total records without filtering
$totalQuery = "SELECT COUNT(*) as total FROM `enquiry_management_new` WHERE `status`='1' AND `store_id`='$store_id'";
$totalResult = $conn->query($totalQuery);
$totalRecords = $totalResult->fetch_assoc()['total'];

// Query to fetch filtered data if a search value is provided
$where = "";
if (!empty($search)) {
    // $where = " WHERE store_id ='$store_id' AND `status`='1' LIKE '%$search%'"; // Modify this to suit your needs
    $where = " WHERE `store_id` ='$store_id' AND `status`='1' AND `source_type` LIKE '%$search%'";
}



// Fetch total records with filtering

$filteredQuery = "SELECT COUNT(*) as total FROM `enquiry_management_new` $where ";
$filteredResult = $conn->query($filteredQuery);
$totalFiltered = $filteredResult->fetch_assoc()['total'];

// Fetch paginated data
// $query = "SELECT * FROM your_table $where LIMIT $limit OFFSET $start";

$query = "SELECT 
    enq.id as enquiry_id, 
    enq.enquiry_for, 
    enq.source_type, 
    enq.source, 
    enq.customer_id, 
    enq.enquiry_date, 
    enq.enquiry_category, 
    enq.enquiry_product, 
    enq.enquiry_detail, 
    enq.store_id, 
    enq.user_category_id, 
    enq.created_by, 
    enq.enquiry_status, 
    enq.row_created_by, 
    enq.status as enquiry_status,
    branch.name as branch_name, 
    branch.address as branch_address, 
    branch.gst as branch_gst, 
    branch.contact_no as branch_contact_no, 
    branch.city as branch_city, 
    branch.state as branch_state, 
    branch.row_created_on as branch_created_on, 
    branch.status as branch_status,
    cust.display_name as customer_name, 
    cust.mobile as customer_mobile, 
    cust.email as customer_email,
    user_cat.first_name as user_category_first_name,
    user_cat.middle_name as user_category_middle_name,
    user_cat.last_name as user_category_last_name
FROM 
    enquiry_management_new enq
JOIN 
    branch ON branch.id = enq.store_id
JOIN 
    customer_details cust ON cust.id = enq.customer_id
JOIN 
    dp_category dpc ON dpc.id = enq.enquiry_category
JOIN 
    enquiry_management_status enq_status ON enq_status.id= enq.enquiry_status
JOIN 
    users user_cat ON user_cat.id = enq.created_by
WHERE 
    enq.status = '1'
  LIMIT $limit OFFSET $start";
$dataResult = $conn->query($query);

$data = [];
while ($row = $dataResult->fetch_assoc()) {
    $data[] = $row;
}

// Return JSON response
$response = [
    "draw" => intval($_GET['draw']),
    "recordsTotal" => intval($totalRecords),
    "recordsFiltered" => intval($totalFiltered),
    "data" => $data
];

echo json_encode($response);
// echo "<pre>";
// print_r($response);
// echo "</pre>";
?>
