<?php
// Database connection
$con = new mysqli("localhost", "root", "", "carrental");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $id = $con->real_escape_string($_POST['id']);
    $vehicle_model = $con->real_escape_string($_POST['vehicle_model']);
    $vehicle_number = $con->real_escape_string($_POST['vehicle_number']);
    $seating_capacity = $con->real_escape_string($_POST['seating_capacity']);
    $rent_per_day = $con->real_escape_string($_POST['rent_per_day']);

    // Update car details in database
    $sql = "UPDATE cardetails SET vehicle_model='$vehicle_model', vehicle_number='$vehicle_number', seating_capacity='$seating_capacity', rent_per_day='$rent_per_day' WHERE id=$id";

    if ($con->query($sql) === TRUE) {
        // Redirect to carlist.php after successful update
        header("Location: showcar.php");
        exit();
    } else {
        echo "Error updating record: " . $con->error;
    }
}

// Close the database connection
$con->close();
?>
