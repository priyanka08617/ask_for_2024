<?php
 include 'connection.php';
 include '../../includes/functions.php';



$json_array=array();
$data=array();

$task_no=sanitize_input($conn,$_POST['enquiry_managment_task_no']);
// $task_no=4;

$data=array();

if($task_no==1){

    $sql="SELECT * FROM `dp_category`  WHERE `status`='1'";
    $query=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($query)){

       $dp_category_id= $row["id"];
       $category_name= $row["category_name"];

        $dp_category[]="<option value='".$dp_category_id."'>".$category_name."</option>";
    }


    $sql1="SELECT * FROM `dp`  WHERE `status`='1' AND `cat_id`='1'";
    $query1=mysqli_query($conn,$sql1);
    while($row1=mysqli_fetch_array($query1)){

       $dp_id= $row1["id"];
       $mtm= $row1["mtm"];
        $dp[]="<option value='".$dp_id."'>".$mtm."</option>";
    }



    $data=array("category"=>$dp_category,"dp_roduct"=>$dp);

}

elseif($task_no==2){

    // `category_id`='2' - Service Problem
$service_problem=array();


    $sql_service="SELECT * FROM `form_subcategory`  WHERE `category_id`='2' AND `status`='1'";
    $query_service =mysqli_query($conn,$sql_service);
    while($row_service=mysqli_fetch_array($query_service)){

       $service_problem_id= $row_service["id"];
       $service_problem_data= $row_service["data"];

        $service_problem[]="<option value='".$service_problem_id."'>".$service_problem_data."</option>";
    }




    $data=array("service_problem"=>$service_problem);


}elseif($task_no==3){

    // `category_id`='2' - Service Problem
$service_problem=array();

$co=date('Y-m-d H:i:s');
//  $co_date=$co;
$enquiry_managment_task_no  = sanitize_input($conn,$_POST['enquiry_managment_task_no']);
$issue_x = sanitize_input($conn,$_POST['issue_x']);
$form_subcategory_id_for_service_problem_x = sanitize_input($conn,$_POST['form_subcategory_id_for_service_problem_x']);


$sql_check=mysqli_query($conn,"SELECT `data` FROM form_subcategory WHERE `data`='$issue_x'");

if(mysqli_num_rows($sql_check)<1){

            $service_issue_add_sql="INSERT INTO `form_subcategory`(`category_id`, `data`, `status`) VALUES ('$issue_x','$form_subcategory_id_for_service_problem_x','1')";
            $service_issue_add_query=mysqli_query($conn,$service_issue_add_sql);
            $service_issue_add_last_id = mysqli_insert_id($conn);
            $data=array("service_issue_add_last_id"=>$service_issue_add_last_id,"name"=>$issue_x,"status"=>1);
}else{
    $data=array("service_issue_add_last_id"=>"","name"=>$issue_x,"status"=>0);
}



    

}
elseif($task_no==4){


    $co=date('Y-m-d H:i:s');


    $cat_id_x = sanitize_input($conn,$_POST['cat_id']);
    $sub_cat_id_x = sanitize_input($conn,$_POST['sub_cat_id']);
    $item_x = sanitize_input($conn,$_POST['item']);
    $name=sanitize_input($conn,$_POST['name']);
    $sku=sanitize_input($conn,$_POST['sku']);
    $uom_id_x = sanitize_input($conn,$_POST['uom_id']);
    $short_code_x=sanitize_input($conn,$_POST['short_code']);
    $hsn_table_id_x=sanitize_input($conn,$_POST['hsn_table_id']);
    $barcode_x=sanitize_input($conn,$_POST['barcode']);
    $alias_x=sanitize_input($conn,$_POST['alias']);
    
    
    $hsn_rate_x=singleRowFromTable($conn, "SELECT * FROM hsn_table WHERE id='$hsn_table_id_x'", "rate");
    
    
    
   

$sql_check=mysqli_query($conn,"SELECT `mtm` FROM `dp` WHERE `mtm`='$item_x'");

if(mysqli_num_rows($sql_check)<1){

    $sql="INSERT INTO  dp (`cat_id`,`sub_cat_id`, `item_type`, `name`, `mtm`,`short_code`,`sku`, `uom_id`,`barcode`,
    `alias`,  `hsn_table_id`, `hsn_rate_id`,`table_name`,`status`, `row_created_on`,location_id)VALUES('$cat_id_x','$sub_cat_id_x','1', '$name', '$item_x','$short_code_x','$sku','$uom_id_x','$barcode_x', '$alias_x',  '$hsn_table_id_x', '$hsn_rate_x','1','1','$co','1')";
    $query=mysqli_query($conn,$sql);

            $dp_add_last_id = mysqli_insert_id($conn);
            $data=array("enquiry_management_dp_add_last_id"=>$dp_add_last_id,"name"=>$item_x,"status"=>1);
}else{
    $data=array("enquiry_management_dp_add_last_id"=>"","name"=>$item_x,"status"=>0);
}




}

echo json_encode($data);
?>