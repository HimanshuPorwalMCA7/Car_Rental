<?php

$con = new mysqli("localhost", "root", "", "carrental");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $id = $con->real_escape_string($_POST['id']);
    $vehicle_model = $con->real_escape_string($_POST['vehicle_model']);
    $vehicle_number = $con->real_escape_string($_POST['vehicle_number']);
    $seating_capacity = $con->real_escape_string($_POST['seating_capacity']);
    $rent_per_day = $con->real_escape_string($_POST['rent_per_day']);

   
    $sql = "UPDATE cardetails SET vehicle_model='$vehicle_model', vehicle_number='$vehicle_number', seating_capacity='$seating_capacity', rent_per_day='$rent_per_day' WHERE id=$id";

    if ($con->query($sql) === TRUE) {
        
        header("Location: showcar.php");
        exit();
    } else {
        echo "Error updating record: " . $con->error;
    }
}


$con->close();
?>
