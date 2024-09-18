<?php
 include '../includes/check.php';
 include '../includes/functions.php';


$json_array=array();


$task_no=sanitize_input($conn,$_POST['task_no']);
// $task_no=1;
if($task_no==1){
    $data=array();


$c=0;
$sql='SELECT * FROM `enquiry_management` WHERE `status`="1" AND `source_type`="Lead" OR `created_by`="'.$user_id.'" ORDER BY `id` DESC';

    $query=mysqli_query($conn,$sql);
    $totalRecords=mysqli_num_rows($query);
    if($totalRecords>0){
    while($row=mysqli_fetch_array($query)){

    $c++;

    $id=$row['id'];
    $status=$row['status'];
    $source_type=$row['source_type'];
    $source_id=$row['source'];
    $customer_name=$row['customer_name'];
    $customer_mobile=$row['customer_mobile'];
    $customer_mail=$row['customer_mail'];
    $enquiry_date=dateForm1($row['enquiry_date']);
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



$data[]='<tr>';
$data[]='<td>'.$c.'</td>';
$data[]='<td>'. $enquiry_date.'</td>';
$data[]='<td>'. $source_type ." || ".$source.'</td>';
$data[]='<td>'. $customer_name.'</td>';
$data[]='<td>'. $customer_mobile.'</td>';
$data[]= '<td>'. $customer_mail.'</td>';
 
$data[]='<td>'. $row['enquiry'].'</td>';
$data[]='<td>'.$poa.'</td>';
$data[]= '<td><a href="../views/enquiry_timeline.php?enquiry_id='.$id.'" target= "_blank"><button type="button" class="btn btn-primary btn-sm btn-block">view</button></a></td>';

 if($enquiry_status=='Open'){
    $data[]= "<td><button type='button' class='btn btn-info btn-sm'>".$enquiry_status."</button></td>";
}elseif($enquiry_status=='Closed'){
    $data[]="<td><button type='button' class='btn btn-success btn-sm'>".$enquiry_status."</button></td>";
}else{
    $data[]="<td><button type='button' class='btn btn-warning btn-sm'>".$enquiry_status."</button></td>";
}



//  echo '<td><a href="../views/enquiry_timeline.php?enquiry_id='.$id.'"><button type="button" class="btn btn-warning btn-sm btn-block">'.$poa.'</button></a></td>';
 
$data[]='<td>'. $created_by.'</td>';
$data[]='<td>'. dateForm($row['row_created_on']).'</td>';
$edit_modal_params_string="'$id','$source','$customer_name','$customer_mobile','$customer_mail','$enquiry','$status'";
$edit_modal_params='openModel('.$edit_modal_params_string.')';
$data[]='<td><img src="../img/edit.png" style="width:30px"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'">';
$data[]='<a href="../controllers/enquiry_management_del.php?id='.$id.'"><img src="../img/delete.png" style="width:30px" ></a></td>';
$data[]='</tr>';






    }


 
    }
$json_array=array("data"=>$data);

}


echo json_encode($json_array);

// echo "<pre>"; 
// print_r($data);
// echo "</pre>";
?>