<?php
session_start(); // Starting the session to check if the user is logged in

// Check if the user is logged in
if (!isset($_SESSION['customer_logged_in']) || $_SESSION['customer_logged_in'] !== true) {
    header("Location: customerlogin.html");
    exit; // Stop further execution
}

// Database connection
$con = new mysqli("localhost", "root", "", "carrental");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Query to fetch rented car details along with car details for the current user
$user_id = $_SESSION['customer_id']; // Assuming 'customer_id' is the column name for user id in your database
$sql = "SELECT rentedcar.*, cardetails.* 
        FROM rentedcar 
        INNER JOIN cardetails ON rentedcar.car_id = cardetails.id 
        WHERE rentedcar.user_id = ?";

// Prepare the SQL statement
$stmt = $con->prepare($sql);

// Bind the user ID parameter
$stmt->bind_param("i", $user_id);

// Execute the query
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Rented Car</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="dashboard.html">Car Rental Services</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="availablecars.php">Rent Car Now</a>
                </li>
                <li class="nav-item">
                    <form action="logout.php" method="post" class="nav-link">
                        <button type="submit" class="btn btn-danger btn-block">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <h1>Your Rented Cars</h1>
        <?php
        // Check if there are any rented cars found
        if ($result->num_rows > 0) {
            // Loop through each rented car
            while ($row = $result->fetch_assoc()) {
                // Display rented car details along with corresponding car details
                echo "<div class='card mt-3'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>Rented Car ID: " . $row['car_id'] . "</h5>";
                echo "<p class='card-text'>Rent Days: " . $row['days'] . "</p>";
                echo "<p class='card-text'>Start Date: " . $row['start_date'] . "</p>";
                echo "<p class='card-text'>Vehicle Model: " . $row['vehicle_model'] . "</p>";
                echo "<p class='card-text'>Vehicle Number: " . $row['vehicle_number'] . "</p>";
                echo "<p class='card-text'>Seating Capacity: " . $row['seating_capacity'] . "</p>";
                echo "<p class='card-text'>Rent Per Day: " . $row['rent_per_day'] . "</p>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No rented cars found.</p>";
        }
        ?>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
