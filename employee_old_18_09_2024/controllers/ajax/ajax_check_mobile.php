<?php 
 include 'connection.php';
 include '../../includes/functions.php';

// Get the mobile number from the AJAX request
$mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';

 
// $sql="SELECT * FROM `customer_details` WHERE 'mobile'='$name'";




if ($mobile) {
    // Query to check if the mobile number exists
    $stmt = mysqli_query($conn,"SELECT name, email FROM `customer_details` WHERE mobile ='$mobile'");
    $result = mysqli_fetch_assoc($stmt);

    if ($result) {
        // If the mobile number exists, return the name and email
        echo json_encode([
            'exists' => true,
            'name' => $result['name'],
            'email' => $result['email']
        ]);
    } else {
        // If the mobile number doesn't exist
        echo json_encode([
            'exists' => false
        ]);
    }
} else {
    echo json_encode(['error' => 'No mobile number provided']);
}
?>