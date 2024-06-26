<?php
session_start(); 

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: agenciesloginht.php");
    exit; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Cars</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <a class="navbar-brand" href="#">Car Rental Services</a>
        <span class="navbar-text">
        </span>
        
            <a href="showcar.php" class="btn btn-success">Show Cars</a>
        
       &nbsp;&nbsp;&nbsp;&nbsp; 
            <a href="rentedcaradmin.php" class="btn btn-success">Rented Cars</a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="agenciesregistrationht.php" class="btn btn-success">Add Member</a>
      
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
              
                <li class="nav-item">
                    <form action="logout.php" method="post" class="nav-link">
                        <button type="submit" class="btn btn-danger btn-block">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    
    
    <!-- Add New Car Form -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Add New Car</h3>
                    </div>
                    <div class="card-body">
                        <form action="cardetails.php" method="post">
                            <div class="form-group">
                                <label for="vehicle_model">Vehicle Model</label>
                                <input type="text" class="form-control" name="vehicle_model" id="vehicle_model" required>
                            </div>
                            <div class="form-group">
                                <label for="vehicle_number">Vehicle Number</label>
                                <input type="text" class="form-control" name="vehicle_number" id="vehicle_number" required>
                            </div>
                            <div class="form-group">
                                <label for="seating_capacity">Seating Capacity</label>
                                <input type="text" class="form-control" name="seating_capacity" id="seating_capacity" required>
                            </div>
                            <div class="form-group">
                                <label for="rent_per_day">Rent Per Day</label>
                                <input type="text" class="form-control" name="rent_per_day" id="rent_per_day" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Add Car</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
