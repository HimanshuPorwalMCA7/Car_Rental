<?php
session_start(); 


if (!isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] !== true) {
    header("Location: agenciesloginht.php");
    exit; 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agency Registration</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <a class="navbar-brand" href="agenciesdashboard.html">Car Rental Services</a>
    
  
    
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
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="text-center">Agency Registration</h3>
          </div>
          <div class="card-body">
            <form action="agenciesregistration.php" method="post">
              <div class="form-group">
                <label for="agency_name">Agency Name</label>
                <input type="text" class="form-control" name="agency_name" id="agency_name" placeholder="Enter agency name">
              </div>
              <div class="form-group">
                <label for="contact_person">Contact Person</label>
                <input type="text" class="form-control" name="contact_person" id="contact_person" placeholder="Enter contact person name">
              </div>
              <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email address">
              </div>
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter phone number">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
              </div>   
              <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" name="role" id="role" required>
                  <option value="admin">Admin</option>
                </select>
              </div>          
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
