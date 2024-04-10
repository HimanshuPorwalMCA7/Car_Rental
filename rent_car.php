<?php
session_start(); // Starting the session to check if the user is logged in

// Check if the user is logged in
if (!isset($_SESSION['customer_logged_in']) || $_SESSION['customer_logged_in'] !== true) {
    header("Location: customerlogin.html");
    exit; // Stop further execution
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $con = new mysqli("localhost", "root", "", "carrental");
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Retrieve data from the form
    $user_id = $_SESSION['customer_id']; // Assuming 'customer_id' is the column name for user id in your database
    
    // Loop through each submitted car's data
    foreach ($_POST as $key => $value) {
        // Check if the key starts with 'car_id_'
        if (strpos($key, 'car_id_') === 0) {
            // Extract car id from the key
            $car_id = substr($key, 7); // Remove 'car_id_' prefix
            
            // Retrieve days and start_date for this car
            $days_key = 'days_' . $car_id;
            $start_date_key = 'start_date_' . $car_id;
            
            $days = $_POST[$days_key];
            $start_date = $_POST[$start_date_key];

            // Prepare and execute the SQL query to insert rental details
            $stmt = $con->prepare("INSERT INTO rentedcar (user_id, car_id, days, start_date) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiis", $user_id, $car_id, $days, $start_date);
            if ($stmt->execute()) {
                // Rental details inserted successfully
                // You can redirect the user to a confirmation page or perform any other actions here
                header("Location: customerdashboard.php");
                exit;
            } else {
                // Error handling if the insertion fails
                echo "Error: " . $stmt->error;
            }
        }
    }

    // Close the database connection
    $con->close();
}
?>
