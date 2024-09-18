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



// if($user_id==8){
//     // $sql="SELECT * FROM `enquiry_management` WHERE ".$whereClause."  `source_type`='Lead' AND `status`='1' AND  `store_id`='$store_id' " ;

//     $totalRecords_sql="SELECT * 
// FROM `enquiry_management` 
// WHERE `source_type` = 'Lead' 
//   AND `status` = '1' 
//   AND `store_id` = '$store_id' 
//   AND (
//     enquiry_date LIKE '%$searchValue%' 
//     OR customer_mobile LIKE '%$searchValue%' 
//     OR customer_name LIKE '%$searchValue%' 
//     OR source_type LIKE '%$searchValue%'
//   ) OR `created_by`='8'
// ORDER BY `id` DESC";



// }else{

//     $totalRecords_sql="SELECT * 
//     FROM `enquiry_management` 
//     WHERE 
//            `created_by`='$user_id'
//      AND   `source_type` = 'Lead' 
//       AND `status` = '1' 
//       AND `store_id` = '$store_id' 
//       AND (
//         enquiry_date LIKE '%$searchValue%' 
//         OR customer_mobile LIKE '%$searchValue%' 
//         OR customer_name LIKE '%$searchValue%' 
//         OR source_type LIKE '%$searchValue%'
//       ) 
//     ORDER BY `id` DESC";


// }

// $totalRecords_query=mysqli_query($conn,$totalRecords_sql);
// $totalRecords=mysqli_num_rows($totalRecords_query);

// if($user_id==8){
//     $sql="SELECT * FROM `enquiry_management` WHERE `source_type`='Lead' AND `status`='1' AND  `store_id`='$store_id' ".$whereClause;

// }else{
//     $sql="SELECT * FROM `enquiry_management` WHERE  `created_by`='$user_id'  AND  `store_id`='$store_id' AND `status`='1'   ".$whereClause;
// }
// 

// $totalRecords_sql="SELECT * FROM `enquiry_management` WHERE `status`='1'  AND `store_id`='$store_id' AND (`source_type`='Lead'  OR`created_by`='8')";

$totalRecords_sql="SELECT * FROM `enquiry_management`
WHERE `status`='1'
AND `store_id`='$store_id'
AND (`source_type`='Lead' OR `created_by`='8')";
$totalRecords_query=mysqli_query($conn,$totalRecords_sql);
$totalRecords=mysqli_num_rows($totalRecords_query);




// Define the columns that are searchable

// $columns = ['enquiry_date', 'customer_mobile', 'customer_name','source_type'];









// $whereClause = "";
// if (!empty($searchValue)) {
//     $whereParts = [];
//     foreach ($columns as $column) {
//         $whereParts[] = "$column LIKE '%$searchValue%'";
//     }
//     $whereClause = implode(" OR ", $whereParts);
//     // " AND ".
// }else{
//     $whereClause =""; 
// }


$data=array();
$c=0;

if($user_id==8){
    // $sql="SELECT * FROM `enquiry_management` WHERE ".$whereClause."  `source_type`='Lead' AND `status`='1' AND  `store_id`='$store_id' " ;

    $sql="SELECT * 
FROM `enquiry_management` 
WHERE `status` = '1' 
  AND `store_id` = '$store_id' 
  AND (`source_type`='Lead' OR `created_by`='8')
  AND (
       enquiry_date LIKE '%$searchValue%' 
    OR customer_mobile LIKE '%$searchValue%' 
    OR customer_name LIKE '%$searchValue%' 
    OR source_type LIKE '%$searchValue%'
    OR enquiry LIKE '%$searchValue%'
  ) 
ORDER BY `id` DESC 
LIMIT $start, $length";



}else{

    $sql="SELECT * 
    FROM `enquiry_management` 
    WHERE 
           `created_by`='$user_id'
      AND `status` = '1'
      AND (
        enquiry_date LIKE '%$searchValue%' 
        OR customer_mobile LIKE '%$searchValue%' 
        OR customer_name LIKE '%$searchValue%' 
        OR source_type LIKE '%$searchValue%'
        OR enquiry LIKE '%$searchValue%'
      ) 
    ORDER BY `id` DESC 
    LIMIT $start, $length";


}

    $query=mysqli_query($conn,$sql);
    // echo mysqli_error($conn);
    while($row=mysqli_fetch_array($query)){

    $c++;


     // Columns to fetch from the database



    $id=$row['id'];
    $for_id=$row['for'];
    if($for_id==1){$for="Sale";}else{$for="Service";}
    $status=$row['status'];
    $source_type=$row['source_type'];
    $source_id=$row['source'];
    $customer_name=$row['customer_name'];
    $customer_mobile=$row['customer_mobile'];
    $customer_mail=$row['customer_mail'];
    $enquiry_date=$row['enquiry_date'];
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




$view='<a href="../views/enquiry_timeline_new.php?mobile_no='.$customer_mobile.'" target= "_blank"><button type="button" class="btn btn-primary btn-sm btn-block">view</button></a>';

 if($enquiry_status=='Open'){
    $enquiry_status_variable= "<p class='text-success'><b>".$enquiry_status."</b></p>";
}elseif($enquiry_status=='Closed'){
    $enquiry_status_variable="<p  class='text-danger'><b>".$enquiry_status."</b></p>";
}else{
    $enquiry_status_variable="<p  class='text-success'><b>Open</b></p>";
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


$data[] = array(
    "id"=>$c,"for"=>$for,
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





}




    $response = [
        "draw" => intval($draw),
        "recordsTotal" => $totalRecords,
        "recordsFiltered" =>$totalRecords,
        "data" => $data
    ];


header('Content-Type: application/json');
echo json_encode($response);

    ?>