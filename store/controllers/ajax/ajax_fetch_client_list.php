<?php
 include 'connection.php';
 include '../../includes/functions.php';

if(!isset($_POST['searchTerm'])){ 
  $fetchData = mysqli_query($conn,"SELECT * FROM customer_details WHERE status='1' ORDER BY id DESC");


}else{ 
  $search = $_POST['searchTerm']; 

  $fetchData = mysqli_query($conn,"SELECT * FROM customer_details WHERE status='1' AND `print_name` like ('%".$search."%') OR  `name` like ('%".$search."%')");
  // 
} 


$data = array();
while ($row = mysqli_fetch_array($fetchData)) {    

  $display_name=$row["display_name"];
  $customer_id=$row["id"];




  $data[] = array("id"=>$customer_id, "text"=>$display_name);
}
echo json_encode($data);
?>