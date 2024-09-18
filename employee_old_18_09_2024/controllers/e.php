<?php
 include '../includes/check.php';
 include '../includes/functions.php';


$searchTerm = $requestData['search']['value']; // This should be the dp.id you want to search for
// $searchTerm="";


// total QUERY SELECT COUNT(*) AS totalData

$totalDataSQL="SELECT COUNT(*) AS totalData  FROM `enquiry_management_new` WHERE `status`='1'";
$totalData_query = mysqli_query($conn, $totalDataSQL);
$row_totalData = mysqli_fetch_assoc($totalData_query);
$totalData = $row_totalData['totalData'];



         $sql_totalFiltered="SELECT e.id, e.enquiry_for, e.source_type, c.id as customer_id,c.name as customer_name, c.mobile as mobile,e.enquiry_date, 
             dpc.category_name,e.enquiry_product, e.enquiry_detail, e.store_id, 
               e.user_category_id,  CONCAT(u.first_name, ' ', u.last_name) AS created_by,e.enquiry_status, e.row_created_by,
               CASE 
           WHEN e.enquiry_status = 1 THEN 'Open' 
           WHEN e.enquiry_status = 0 THEN 'Closed' 
           ELSE 'open'  -- This will catch any unexpected statuses
           END AS enquiry_status,

         CASE 
           WHEN e.source_type = 'referral' THEN c.display_name  -- Use the already joined customer_details table
           WHEN e.source_type = 'walking' THEN b.name  -- Use branch name for walking type
           ELSE e.source  -- Fallback to source_id if it's neither referral nor walking
       END AS source,COUNT(*) AS totalFiltered
        FROM enquiry_management_new e
        JOIN dp ON e.enquiry_product LIKE CONCAT('%', dp.mtm, '%')    
        JOIN customer_details c ON e.customer_id = c.id  -- Already joined for customer details
        LEFT JOIN branch b ON e.source = b.id AND e.source_type = 'walking'
        JOIN users u ON u.id = e.created_by 
        JOIN dp_category dpc ON dpc.id = e.enquiry_category
        WHERE e.status='1'";
    $sql_totalFiltered .= " AND (e.enquiry_for LIKE '%".$searchTerm."%' ";
    $sql_totalFiltered .= " OR e.source_type LIKE '%".$searchTerm."%' ";
    $sql_totalFiltered .= " OR e.source LIKE '%".$searchTerm."%' ";
    $sql_totalFiltered .= " OR c.name LIKE '%".$searchTerm."%' ";
    $sql_totalFiltered .= " OR c.mobile LIKE '%".$searchTerm."%' ";
    $sql_totalFiltered .= " OR dpc.category_name LIKE '%".$searchTerm."%' ";
    $sql_totalFiltered .= "OR e.enquiry_product REGEXP  '%".$searchTerm."%'";
    $sql_totalFiltered .= " OR e.enquiry_detail LIKE '%".$searchTerm."%' ";
    $sql_totalFiltered .= " OR created_by LIKE '%".$searchTerm."%' ";
    $sql_totalFiltered .= " OR enquiry_status LIKE '%".$searchTerm."%' ";
    $sql_totalFiltered .= " OR e.row_created_by LIKE '%".$searchTerm."%' ) ";


$result_totalFiltered = mysqli_query($conn, $sql_totalFiltered);
$row_totalFiltered = mysqli_fetch_assoc($result_totalFiltered);
$totalFiltered = $row_totalFiltered['totalFiltered'];


$data = array();
// Basic SQL query to retrieve potential matches
$sql = "SELECT e.id, e.enquiry_for, e.source_type, c.id as customer_id,c.name as customer_name, c.mobile as mobile,e.enquiry_date, 
             dpc.category_name,e.enquiry_product, e.enquiry_detail, e.store_id, 
               e.user_category_id,  CONCAT(u.first_name, ' ', u.last_name) AS created_by,e.enquiry_status, e.row_created_by,
               CASE 
           WHEN e.enquiry_status = 1 THEN 'Open' 
           WHEN e.enquiry_status = 0 THEN 'Closed' 
           ELSE 'open'  -- This will catch any unexpected statuses
           END AS enquiry_status,

         CASE 
           WHEN e.source_type = 'referral' THEN c.display_name  -- Use the already joined customer_details table
           WHEN e.source_type = 'walking' THEN b.name  -- Use branch name for walking type
           ELSE e.source  -- Fallback to source_id if it's neither referral nor walking
       END AS source


        FROM enquiry_management_new e
        JOIN dp ON e.enquiry_product LIKE CONCAT('%', dp.mtm, '%')    
        JOIN customer_details c ON e.customer_id = c.id  -- Already joined for customer details
        LEFT JOIN branch b ON e.source = b.id AND e.source_type = 'walking'
        JOIN users u ON u.id = e.created_by 
        JOIN dp_category dpc ON dpc.id = e.enquiry_category
        WHERE e.status='1'";
        if(!empty($searchTerm)) {
    $sql .= " AND (e.enquiry_for LIKE '%".$searchTerm."%' ";
    $sql .= " OR e.source_type LIKE '%".$searchTerm."%' ";
    $sql .= " OR e.source LIKE '%".$searchTerm."%' ";
    $sql .= " OR c.name LIKE '%".$searchTerm."%' ";
    $sql .= " OR c.mobile LIKE '%".$searchTerm."%' ";
    $sql .= " OR dpc.category_name LIKE '%".$searchTerm."%' ";
    $sql .= "OR e.enquiry_product REGEXP  '%".$searchTerm."%'";
    $sql .= " OR e.enquiry_detail LIKE '%".$searchTerm."%' ";
    // $sql .= " OR store_id LIKE '%".$searchTerm."%' ";
    // $sql .= " OR user_category_id LIKE '%".$searchTerm."%' ";
    $sql .= " OR created_by LIKE '%".$searchTerm."%' ";
    $sql .= " OR enquiry_status LIKE '%".$searchTerm."%' ";
    $sql .= " OR e.row_created_by LIKE '%".$searchTerm."%' ) ";
    // $sql .= " OR e.status LIKE '%".$searchTerm."%'";
}

$query = mysqli_query($conn, $sql);

$data=array();
while( $row = mysqli_fetch_array($query) ) {

    $enquiryProduct = unserialize($row['enquiry_product']);  // Unserialize the array
    $customer_mobile=$row['mobile'];
    $action='<a href="../controllers/enquiry_management_delete.php"><img src="../img/delete.png" width="20px"></a>';
    $view='<a href="../views/enquiry_timeline_new.php?mobile_no='.$customer_mobile.'" target= "_blank"><button type="button" class="btn btn-primary btn-sm btn-block">view</button></a>';

        $nestedData = array();
        $nestedData['id'] = $row['id'];
        $nestedData['enquiry_for'] = $row['enquiry_for'];
        $nestedData['source_type'] = $row['source_type']."||".$row['source'];
        $nestedData['customer_details'] = $row['customer_name'];  
        $nestedData['enquiry_date'] = $row['enquiry_date'];
        $nestedData['enquiry_category'] = $row['category_name'];
        $nestedData['enquiry_product'] = $enquiryProduct;  // You can leave it serialized or display it in a more readable format
        $nestedData['enquiry_detail'] = $row['enquiry_detail'];
        $nestedData['view'] = $view;
        $nestedData['enquiry_status'] = $row['enquiry_status'];
        $nestedData['created_by'] = $row['created_by'];
        $nestedData['row_created_on'] = $row['row_created_by'];
        $nestedData['action'] = $action;
        $data[] = $nestedData;
        
    }


    $json_data = array(
        "draw"            => intval( $requestData['draw'] ),   
        "recordsTotal"    => intval( $totalData ),  
        "recordsFiltered" => intval( $totalFiltered ), 
        "data"            => $data   
    );
    
echo json_encode($json_data);


// echo "<pre>";
// print_r($data);
// echo "</pre>";
?>
