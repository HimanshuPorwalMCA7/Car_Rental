<?php
session_start(); // Starting the session to check if the user is logged in as admin

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: agencieslogin.html");
    exit; // Stop further execution
}

// Database connection
$con = new mysqli("localhost", "root", "", "carrental");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Query to fetch all rented car details for all users
// $sql = "SELECT * FROM rentedcar";
// $sql = "SELECT rentedcar.*, customerregistration.*
//         FROM rentedcar 
//         INNER JOIN customerregistration ON rentedcar.user_id = customerregistration.id";
$sql = "SELECT rentedcar.*, customerregistration.*, cardetails.*
        FROM ((rentedcar
        INNER JOIN customerregistration ON rentedcar.user_id = customerregistration.id)
        INNER JOIN cardetails ON rentedcar.car_id = cardetails.id)";

// Execute the query
$result = $con->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - All Rented Cars</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>All Rented Cars</h1>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    
                    <th scope="col">S.No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Vehicle_Model</th>
                    <th scope="col">Vehicle_Number</th>
                    <th scope="col">Setting Capacity</th>
                    <th scope="col">Rent Per Da</th>
                    <th scope="col">Days</th>
                    <th scope="col">Start Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i=1;
                // Check if there are any rented cars found
                if ($result->num_rows > 0) {
                    // Loop through each rented car
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $i . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['vehicle_model'] . "</td>";
                        echo "<td>" . $row['vehicle_number'] . "</td>";
                        echo "<td>" . $row['seating_capacity'] . "</td>";
                        echo "<td>" . $row['rent_per_day'] . "</td>";
                        echo "<td>" . $row['days'] . "</td>";
                        echo "<td>" . $row['start_date'] . "</td>";
                        echo "</tr>";
                        $i=$i+1;
                    }
                } else {
                    echo "<tr><td colspan='4'>No rented cars found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
