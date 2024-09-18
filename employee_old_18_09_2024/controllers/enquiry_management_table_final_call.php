<?php
 include '../includes/check.php';
 include '../includes/functions.php';


// Debugging - Check POST data
// error_log("POST data: " . json_encode($_POST));


// Read DataTable parameters

// $draw = $_POST['draw'];
// $start = $_POST['start'];
// $length = $_POST['length'];
// $search_term = $_POST['search']['value']; // Search value

$search_term ="";


$draw = 0;
$start =0;
$length = 10;
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



// JOIN dp ON FIND_IN_SET(dp.id, REPLACE(REPLACE(e.enquiry_product, 'a:', ''), ';', ','))

$sql = "SELECT enq.*, c.*
FROM enquiry_management_new enq
JOIN customer_details c ON enq.customer_id = c.id
JOIN dp_category dpc ON dpc.id = enq.enquiry_category
-- JOIN dp ON dp.mtm = enq.enquiry_product
JOIN branch ON branch.id = enq.store_id
WHERE enq.status = '1'
  AND (branch.name LIKE '%search_term%' 
    --    OR dp.mtm LIKE '%search_term%' 
    OR  enq.enquiry_product REGEXP '%search_term%'
       OR dpc.category_name LIKE '%search_term%' 
       OR c.display_name LIKE '%search_term%' 
       OR c.mobile LIKE '%search_term%' 
       OR c.email LIKE '%search_term%' 
       OR enq.enquiry_for LIKE '%search_term%' 
       OR enq.source_type LIKE '%search_term%' 
       OR enq.enquiry_detail LIKE '%search_term%'
";



// $sql="SELECT enquiry_management_new.*
//         FROM enquiry_management_new
//         JOIN dp ON FIND_IN_SET(dp.id, REPLACE(REPLACE(enquiry_management_new.enquiry_product, 'a:',''), ';', ',')) 
//         WHERE dp.id LIKE '%$searchTerm%'
//         LIMIT 10";


    $query=mysqli_query($conn,$sql);
    echo mysqli_error($conn);
    while($row=mysqli_fetch_array($query)){

    $c++;


     // Columns to fetch from the database

     

    $id=$row['enq.id'];

    // echo $id;


    $for=$row['enq.enquiry_for'];
    

    // echo $for."<br>";
    // $enquiry_product=$row['product_id'];
    $id=$row['enq.id'];
    $status=$row['enq.status'];
    $source_type=$row['enq.source_type'];
    $source_id=$row['enq.source'];
    $customer_name=$row['c.display_name'];
    $customer_mobile=$row['c.mobile'];
    $customer_mail=$row['c.email'];
    // $enquiry_date= date('d-m-Y', strtotime($row['enq.enquiry_date']));
    $enquiry_date=$row['enq.enquiry_date'];
    $product_category= $row['dp_category.category_name'];
    $enquiry_product=$row['enq.enquiry_product'];
    $enquiry_detail=$row['enq.enquiry_detail'];
    $store=$row['branch.name'];
    $created_by_id=$row['created_by'];

    

    // echo $enquiry_product."<br>";
//     echo $for;


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


// $edit_modal_params_string="'$id','$source','$customer_name','$customer_mobile','$customer_mail','$enquiry','$status'";
// $edit_modal_params='openModel('.$edit_modal_params_string.')';

// $action='<img src="../img/edit.png" style="width:30px"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'"><a href="../controllers/enquiry_management_del.php?id='.$id.'"><img src="../img/delete.png" style="width:30px" ></a>';


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
                "product_category"=>$product_category,
                "enquiry_product"=>$enquiry_product,
                "enquiry_detail"=>$enquiry_detail,
                "poa"=>$poa,
                "view"=>$view,
                "enquiry_status"=>$enquiry_status_variable,
                "created_by"=>$created_by,
                "row_created_on"=>date('d-m-Y H:i',strtotime($row['row_created_on']))
                // "action"=>$action
              
            );



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