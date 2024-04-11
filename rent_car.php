<?php
session_start(); 


if (!isset($_SESSION['customer_logged_in']) || $_SESSION['customer_logged_in'] !== true) {
    header("Location: customerlogin.html");
    exit; 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $con = new mysqli("localhost", "root", "", "carrental");
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }


    $user_id = $_SESSION['customer_id']; 
    
   
    foreach ($_POST as $key => $value) {
        
        if (strpos($key, 'car_id_') === 0) {
            
            $car_id = substr($key, 7); 
            
            
            $days_key = 'days_' . $car_id;
            $start_date_key = 'start_date_' . $car_id;
            
            $days = $_POST[$days_key];
            $start_date = $_POST[$start_date_key];

           
            $stmt = $con->prepare("INSERT INTO rentedcar (user_id, car_id, days, start_date) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiis", $user_id, $car_id, $days, $start_date);
            if ($stmt->execute()) {
                
                header("Location: customerdashboard.php");
                exit;
            } else {
                
                echo "Error: " . $stmt->error;
            }
        }
    }

    $con->close();
}
?>
