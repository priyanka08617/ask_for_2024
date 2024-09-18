

<?php
include '../includes/check.php';
include '../includes/functions.php';

// Capture POST request from DataTables
$requestData = $_POST;
// $searchTerm = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';  // Get the search term
$searchTerm = isset($requestData['search']['value']) ? $requestData['search']['value'] : '';

// $requestData['draw']=0;
// $searchTerm ="lenovo";
// $search_date = '';

// Check if the search value looks like a date in d-m-Y format
if (preg_match("/\d{2}-\d{2}-\d{4}/", $searchTerm)) {
    $search_date = DateTime::createFromFormat('d-m-Y', $searchTerm)->format('Y-m-d');
}



// Columns for DataTables (used for ordering and searching)
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
    13 => 'row_created_on',
    14 => 'status'
);

// Total records without any search filter
$sql = "SELECT COUNT(id) as total FROM enquiry_management_new WHERE `status` = '1' AND `store_id` = '$store_id'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);
$totalData = $row['total'];

// SQL Query for retrieving data
$sql = "
    SELECT DISTINCT  e.id, e.enquiry_for as enquiry_for_data, e.source_type as source_type_data, e.row_created_on,
           c.id as customer_id, c.name as customer_name, c.mobile as mobile, 
         DATE_FORMAT(e.enquiry_date, '%d-%m-%Y') AS enquiry_date, dpc.category_name, e.enquiry_product, 
           e.enquiry_detail, e.store_id, e.user_category_id, DATE_FORMAT(e.row_created_on, '%d-%m-%Y %h:%i %p') AS row_created_on,
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
     JOIN dp ON e.enquiry_product LIKE CONCAT('%', dp.mtm, '%')    
    JOIN users u ON u.id = e.created_by 
    JOIN dp_category dpc ON dpc.id = e.enquiry_category
    WHERE e.status='1' AND `store_id` = '$store_id'";

if (!empty($searchTerm)) {
    $sql .= " AND (e.enquiry_for LIKE '%".$searchTerm."%' ";
    $sql .= " OR e.source_type LIKE '%".$searchTerm."%' ";
    $sql .= " OR e.source LIKE '%".$searchTerm."%' ";
    $sql .= " OR c.name LIKE '%".$searchTerm."%' ";
    $sql .= " OR c.mobile LIKE '%".$searchTerm."%' ";
    $sql .= " OR dpc.category_name LIKE '%".$searchTerm."%' ";
    $sql .= " OR e.enquiry_product LIKE  '%".$searchTerm."%' ";
    $sql .= " OR e.enquiry_detail LIKE '%".$searchTerm."%' ";
    $sql .= " OR CONCAT(u.first_name, ' ', u.last_name) LIKE '%".$searchTerm."%' ";

    if (!empty($search_date)) {
        $sql .= " OR DATE(e.enquiry_date) = '$search_date'";
    } else {
        $sql .= " OR DATE_FORMAT(e.enquiry_date, '%d-%m-%Y') LIKE '%$searchTerm%'";
    }


    if (!empty($search_date)) {
        $sql .= " OR DATE(e.row_created_on) = '$search_date'";
    } else {
        $sql .= " OR DATE_FORMAT(e.row_created_on, '%d-%m-%Y') LIKE '%$searchTerm%'";
    }

    // $sql .= " OR e.enquiry_status = ".($searchTerm == 'Open' ? 1 : ($searchTerm == 'Closed' ? 0 : "e.enquiry_status"))." ";
    $sql .= ")";
}
// Ordering
           // ASC or DESC
$sql .= " ORDER BY e.enquiry_date DESC ";

// Pagination
$start = $requestData['start'];
$length = $requestData['length'];
$sql .= " LIMIT $start, $length";
$query = mysqli_query($conn, $sql);




$sqlFiltered = "SELECT COUNT(DISTINCT e.id) as totalFiltered
FROM enquiry_management_new e
JOIN customer_details c ON e.customer_id = c.id
LEFT JOIN branch b ON e.source = b.id AND e.source_type = 'walking'
JOIN users u ON u.id = e.created_by
JOIN dp ON e.enquiry_product LIKE CONCAT('%', dp.mtm, '%')  
JOIN dp_category dpc ON dpc.id = e.enquiry_category
WHERE e.status = '1' AND `store_id` = '$store_id'";

// Apply search filter to the totalFiltered query
if (!empty($searchTerm)) {
    $sqlFiltered .= " AND (e.enquiry_for LIKE '%".$searchTerm."%' ";
    $sqlFiltered .= " OR e.source_type LIKE '%".$searchTerm."%' ";
    $sqlFiltered .= " OR c.name LIKE '%".$searchTerm."%' ";
    $sqlFiltered .= " OR c.mobile LIKE '%".$searchTerm."%' ";
    $sqlFiltered .= " OR dpc.category_name LIKE '%".$searchTerm."%' ";
    $sqlFiltered .= " OR e.enquiry_product LIKE '%".$searchTerm."%' ";
    $sqlFiltered .= " OR e.enquiry_detail LIKE '%".$searchTerm."%' ";
    $sqlFiltered .= " OR CONCAT(u.first_name, ' ', u.last_name) LIKE '%".$searchTerm."%' ";

    // Add the date-based filters (if search term is a valid date)
    if (!empty($search_date)) {
        $sqlFiltered .= " OR DATE(e.enquiry_date) = '$search_date'";
    } else {
        $sqlFiltered .= " OR DATE_FORMAT(e.enquiry_date, '%d-%m-%Y') LIKE '%$searchTerm%'";
    }

    if (!empty($search_date)) {
        $sqlFiltered .= " OR DATE(e.row_created_on) = '$search_date'";
    } else {
        $sqlFiltered .= " OR DATE_FORMAT(e.row_created_on, '%d-%m-%Y') LIKE '%$searchTerm%'";
    }

    $sqlFiltered .= ")";
}


$queryFiltered = mysqli_query($conn, $sqlFiltered);
$rowFiltered = mysqli_fetch_assoc($queryFiltered);
$totalFiltered = $rowFiltered['totalFiltered'];


// Fetch data for display
$data = array();
$current_index = 0;
while( $row = mysqli_fetch_assoc($query) ) {
    $custom_id = $totalData - $start - $current_index;
    $enquiryProduct = unserialize($row['enquiry_product']); 
 // Perform the search in PHP

    $customer_mobile = $row['mobile'];
    $action = '<a href="../controllers/enquiry_management_delete.php"><img src="../img/edit.png" width="20px"></a>';
    $view = '<a href="../views/enquiry_timeline_new.php?mobile_no='.$customer_mobile.'" target= "_blank"><span class="text-primary"><strong>view</strong></span></a>';

$customer_detail=$row['mobile']."<br><small class='text-muted'>".$row['customer_name']."</small>";
    $nestedData = array();
    $nestedData['id'] = $custom_id;
    $nestedData['enquiry_for'] = $row['enquiry_for_data'];
    $nestedData['source_type'] = $row['source_type_data']." || ".$row["source"];
    $nestedData['customer_detail'] = $customer_detail;  
    $nestedData['enquiry_date'] = $row['enquiry_date'];
    $nestedData['enquiry_category'] = $row['category_name'];
    $nestedData['enquiry_product'] =$enquiryProduct;
    $nestedData['enquiry_detail'] = $row['enquiry_detail'];
    $nestedData['view'] = $view;
    $nestedData['enquiry_status'] = $row['enquiry_status'];
    $nestedData['created_by'] = $row['created_by'];
    $nestedData['row_created_on'] = $row['row_created_on'];
    $nestedData['action'] = $action;
    $current_index++;

    $data[] = $nestedData;
}   
// }
// Prepare JSON data for DataTables
$json_data = array(
    "draw" => intval($requestData['draw']),     // Draw counter (from DataTables)
    "recordsTotal" => intval($totalData),       // Total number of records (before filtering)
    "recordsFiltered" => intval($totalFiltered),// Total number of records (after filtering)
    "data" => $data                             // Data to be displayed
);

echo json_encode($json_data);  // Output JSON for DataTables

// echo "<pre>";
// print_r($json_data);
// echo "</pre>";
?>
