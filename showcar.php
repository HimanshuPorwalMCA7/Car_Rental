<?php
// Database connection
$con = new mysqli("localhost", "root", "", "carrental");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Query to fetch all car details
$sql = "SELECT * FROM cardetails";
$result = $con->query($sql);

// Close the database connection
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <li class="nav-item">
            <a href="agenciesdashboard.html" class="btn btn-success">Back</a>
        </li>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
               
                <li class="nav-item">
                    <form action="logout.php" method="post" class="nav-link">
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4">Car Details</h2>
        <div class="row">
            <?php
            // Check if there are any car details fetched
            if ($result->num_rows > 0) {
                // Loop through each row of car details
                while ($row = $result->fetch_assoc()) {
            ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['vehicle_model']; ?></h5>
                        <p class="card-text">Vehicle Number: <?php echo $row['vehicle_number']; ?></p>
                        <p class="card-text">Seating Capacity: <?php echo $row['seating_capacity']; ?></p>
                        <p class="card-text">Rent Per Day: <?php echo $row['rent_per_day']; ?></p>
                        <div class="btn-group" role="group" aria-label="Car Actions">
                        <a href="caredit.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
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
