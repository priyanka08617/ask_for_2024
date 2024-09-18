<?php
 include '../includes/check.php';
 include '../includes/functions.php';


// Debugging - Check POST data
error_log("POST data: " . json_encode($_POST));


// Read DataTable parameters
$draw = $_POST['draw'];
$start = $_POST['start'];
$length = $_POST['length'];
$searchValue = $_POST['search']['value']; // Search value


// $searchValue = "aa";
// $start=10;
// $length=10;

$totalRecords_sql='SELECT * FROM `enquiry_management` WHERE `status`="1"  AND `store_id`="'.$store_id.'" AND  `source_type`="Lead" OR `created_by`="'.$user_id.'"';
$totalRecords_query=mysqli_query($conn,$totalRecords_sql);
$totalRecords=mysqli_num_rows($totalRecords_query);




// Define the columns that are searchable
$columns = ['enquiry_management.enquiry_date', 'enquiry_management.customer_mobile', 'enquiry_management.customer_name','enquiry_management.source_type'];
 // Update with actual column names








$whereClause = "";
if (!empty($searchValue)) {
    $whereParts = [];
    foreach ($columns as $column) {
        $whereParts[] = "$column LIKE '%$searchValue%'";
    }
    $whereClause =" AND ". implode(" OR ", $whereParts);
}else{
    $whereClause =""; 
}


$data=array();
$c=0;

// $columns = ['enquiry_management.source_type', 'enquiry_management.source','enquiry_management.status','enquiry_management.source','enquiry_management.customer_name', 'enquiry_management.customer_mobile', 'enquiry_management.customer_mail', 'enquiry_management.enquiry_date', 'enquiry_management.enquiry','enquiry_management.created_by','enquiry_management.row_created_on','users.id AS user_id','users.first_name AS first_name','users.last_name AS last_name'];



// enquiry_management.id AS id, enquiry_management.source_type AS source_type, enquiry_management.source AS source,enquiry_management.status AS status,enquiry_management.source AS source,enquiry_management.customer_name AS customer_name, enquiry_management.customer_mobile AS customer_mobile, enquiry_management.customer_mail AS customer_mail, enquiry_management.enquiry_date AS enquiry_date, enquiry_management.enquiry AS enquiry,enquiry_management.created_by AS created_by,enquiry_management.row_created_on AS row_created_on, users.id AS user_id ,users.first_name AS first_name, users.last_name AS last_name



$sql="SELECT * FROM `enquiry_management` JOIN users ON users.id = enquiry_management.created_by WHERE enquiry_management.status='1' AND enquiry_management.store_id='$store_id'  AND enquiry_management.source_type='Lead' ".$whereClause;
$sql.=" ORDER BY enquiry_management.id DESC LIMIT $start , $length";  

    $query=mysqli_query($conn,$sql);
    echo mysqli_error($conn);
    while($row=mysqli_fetch_array($query)){

    $c++;


     // Columns to fetch from the database



    $id=$row['id'];
    $status=$row['status'];
    $source_type=$row['source_type'];
    $source_id=$row['source'];
    $customer_name=$row['customer_name'];
    $customer_mobile=$row['customer_mobile'];
    $customer_mail=$row['customer_mail'];
    $enquiry_date=date('d-m-Y',strtotime($row['enquiry_date']));
    $enquiry=$row['enquiry'];
    $created_by_id=$row['created_by'];
    $poa=singleRowFromTable($conn,"SELECT * FROM `enquiry_management_timeline` WHERE `enquiry_management_id`='$id' ORDER BY `id` DESC", "poa");
    $enquiry_status_id=singleRowFromTable($conn,"SELECT * FROM `enquiry_management_timeline` WHERE `enquiry_management_id`='$id'  ORDER BY `id` DESC", "enquiry_status");
    
    $enquiry_status=singleRowFromTable($conn,"SELECT * FROM `enquiry_management_status` WHERE `id`='$enquiry_status_id'", "enquiry_status");
    
    
    $status=$row['status'];
    
    
    $last_name=singleRowFromTable($conn,"SELECT * FROM `users` WHERE `id`='$created_by_id'", "last_name");
    
    $first_name=singleRowFromTable($conn,"SELECT * FROM `users` WHERE `id`='$created_by_id'", "first_name");
    
    $created_by=$first_name." ".$last_name;
    
    if($source_type=="referral"){
        
        $source=singleRowFromTable($conn,"SELECT * FROM `customer_details` WHERE `id`='$source_id'", "display_name");
    
    }elseif($source_type=="walking"){
        $source=singleRowFromTable($conn,"SELECT * FROM `branch` WHERE `id`='$source_id'", "name");
    }else{
        $source=$source_id;
    }




$source_var=$source_type ." || ".$source;




$view='<a href="../views/enquiry_timeline.php?enquiry_id='.$id.'" target= "_blank"><button type="button" class="btn btn-primary btn-sm btn-block">view</button></a>';

 if($enquiry_status=='Open'){
    $enquiry_status_variable= "<p class='text-success'><b>".$enquiry_status."</b></p>";
}elseif($enquiry_status=='Closed'){
    $enquiry_status_variable="<p  class='text-red-600'>".$enquiry_status."</p>";
}else{
    $enquiry_status_variable="<p  class='text-blue-600'>".$enquiry_status."</p>";
}


$edit_modal_params_string="'$id','$source','$customer_name','$customer_mobile','$customer_mail','$enquiry','$status'";
$edit_modal_params='openModel('.$edit_modal_params_string.')';

$action='<img src="../img/edit.png" style="width:30px"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'"><a href="../controllers/enquiry_management_del.php?id='.$id.'"><img src="../img/delete.png" style="width:30px" ></a>';


$customer_details="";
if(empty($customer_name)){
    $customer_details.="";
}else{
    $customer_details.=$customer_name."<br>";
}

if(empty($customer_mobile)){
    $customer_details.="";
}else{
    $customer_details.=$customer_mobile;

}


if(empty($customer_mail)){
    $customer_details.="";
}else{
    $customer_details.="".$customer_mail;

}


$data[] = array("id"=>$c,
                "enquiry_date"=>$enquiry_date,
                "source_type"=>$source_var,
                "customer_details"=>$customer_details,
                "enquiry"=>$row['enquiry'],
                "poa"=>$poa,
                "view"=>$view,
                "enquiry_status"=>$enquiry_status_variable,
                "created_by"=>$created_by,
                "row_created_on"=>date('d-m-Y H:i',strtotime($row['row_created_on'])),
                "action"=>$action
            );



// $data[] = array("id"=>$c,
//                 "enquiry_date"=>$enquiry_date,
//                 "source_type"=>$source_var,
//                 "customer_details"=>$customer_details,
//                 "enquiry"=>$row['enquiry'],
//                 "poa"=>$poa,
//                 "view"=>$view,
//                 "enquiry_status"=>$enquiry_status_variable,
//                 "created_by"=>$created_by,
//                 "row_created_on"=>date('d-m-Y H:i',strtotime($row['row_created_on'])),
//                 "action"=>$action
//             );


}




    // $response = [
    //     // "draw" => intval($draw),
    //     "recordsTotal" => $totalRecords,
    //     "recordsFiltered" =>$totalRecords,
    //     "data" => $data
    // ];

    

// Send JSON response back to DataTable

// header('Content-Type: application/json');
echo json_encode($sql);


// echo "<pre>";
// print_r($data);
// echo "</pre>";
    ?>