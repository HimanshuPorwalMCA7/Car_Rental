<?php
session_start(); 


if (isset($_SESSION['customer_logged_in']) && $_SESSION['customer_logged_in'] == true) {
    header("Location: customerdashboard.php");
    exit; 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Registration</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Car Rental Services</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="agenciesloginht.php">Admin Login <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </nav>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="text-center">Customer Registration</h3>
          </div>
          <div class="card-body">
            <form action="customerregistration.php" method="post">
              <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter your full name" required>
              </div>
              <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email address" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
              </div>
              <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" name="role" id="role" required>
                  <option value="user">User</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
            <button class="btn btn-secondary btn-block mt-3"><a href="customerlogin.html" style="color: white; text-decoration: none;">Already have an account</a></button>

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
