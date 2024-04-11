<?php

$con = new mysqli("localhost", "root", "", "carrental");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "SELECT * FROM cardetails WHERE id = $id";
    $result = $con->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Car not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <li class="nav-item">
            <a href="showcar.php" class="btn btn-success">Back</a>
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
        <h2 class="mb-4">Edit Car Details</h2>
        <form action="edit_process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="vehicle_model">Vehicle Model</label>
                <input type="text" class="form-control" id="vehicle_model" name="vehicle_model" value="<?php echo $row['vehicle_model']; ?>">
            </div>
            <div class="form-group">
                <label for="vehicle_number">Vehicle Number</label>
                <input type="text" class="form-control" id="vehicle_number" name="vehicle_number" value="<?php echo $row['vehicle_number']; ?>">
            </div>
            <div class="form-group">
                <label for="seating_capacity">Seating Capacity</label>
                <input type="number" class="form-control" id="seating_capacity" name="seating_capacity" value="<?php echo $row['seating_capacity']; ?>">
            </div>
            <div class="form-group">
                <label for="rent_per_day">Rent Per Day</label>
                <input type="number" class="form-control" id="rent_per_day" name="rent_per_day" value="<?php echo $row['rent_per_day']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php

$con->close();
?>
