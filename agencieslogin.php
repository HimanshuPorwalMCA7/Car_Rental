<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $con = new mysqli("localhost", "root", "", "carrental");
    if ($con->connect_error) {
        die("Failed to connect: " . $con->connect_error);
    }
    $stmt = $con->prepare("SELECT * FROM agencyregistration WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Password is correct, set session variable and redirect
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['user_email'] = $email; // Optionally store the email in session
        header('Location: agenciesdashboard.html');
        exit;
    } else {
        $error_message = "Invalid email or password combination";
    }
    
    // Close database connection
    $stmt->close();
    $con->close();
}
?>
