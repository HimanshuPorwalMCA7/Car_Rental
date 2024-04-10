<?php
session_start(); // Starting the session to check if the user is logged in

// Check if the form is submitted and the user is not logged in
if ($_SERVER["REQUEST_METHOD"] == "POST" && (!isset($_SESSION['customer_logged_in']) || $_SESSION['customer_logged_in'] !== true)) {
    header("Location: customerlogin.html");
    exit; // Stop further execution
}

// Database connection
$con = new mysqli("localhost", "root", "", "carrental");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Query to fetch all car details
$sql = "SELECT * FROM cardetails";
$result = $con->query($sql);

// Check if the query executed successfully
if (!$result) {
    die("Query failed: " . $con->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Cars</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Car Rental</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <?php if (isset($_SESSION['customer_logged_in']) && $_SESSION['customer_logged_in'] === true): ?>
                        <a class="nav-link" href="logout.php">Logout</a>
                    <?php else: ?>
                        <a class="nav-link" href="customerlogin.html">Login</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4">Available Cars to Rent</h2>
        <div class="row">
            <?php
            // Check if there are any car details fetched
            if ($result->num_rows > 0) {
                // Loop through each row of car details
                while ($row = $result->fetch_assoc()) {
                    // Assuming 'id' is the column name for the car ID in your database
                    $car_id = $row['id'];
            ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['vehicle_model']; ?></h5>
                        <p class="card-text">Vehicle Number: <?php echo $row['vehicle_number']; ?></p>
                        <p class="card-text">Seating Capacity: <?php echo $row['seating_capacity']; ?></p>
                        <p class="card-text">Rent Per Day: <?php echo $row['rent_per_day']; ?></p>
                        <form method="post" action="rent_car.php">
                            <?php if (isset($_SESSION['customer_logged_in']) && $_SESSION['customer_logged_in'] === true): ?>
                                <div class="form-group">
                                    <label for="days_<?php echo $car_id; ?>">Number of Days:</label>
                                    <select class="form-control" id="days_<?php echo $car_id; ?>" name="days_<?php echo $car_id; ?>">
                                        <?php for ($i = 1; $i <= 10; $i++): ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?> Day<?php echo $i > 1 ? 's' : ''; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="start_date_<?php echo $car_id; ?>">Start Date:</label>
                                    <input type="date" class="form-control" id="start_date_<?php echo $car_id; ?>" name="start_date_<?php echo $car_id; ?>">
                                </div>
                                <input type="hidden" name="car_id_<?php echo $car_id; ?>" value="<?php echo $car_id; ?>">
                                <button type="submit" class="btn btn-success">Rent Car</button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
            <?php
                } // End of while loop for fetching car details
            } else {
                echo "<p>No cars found.</p>";
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
