<?php
session_start(); // Starting the session

$email = $_POST['email'];
$password = $_POST['password'];
$con = new mysqli("localhost", "root", "", "carrental");

if ($con->connect_error) {
    die("Failed to connect : " . $con->connect_error);
} else {
    $stmt = $con->prepare("SELECT * FROM customerregistration WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if ($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();
        if ($data['password'] === $password) {
            // Valid credentials, set session variables
            $_SESSION['customer_id'] = $data['id'];
            $_SESSION['customer_email'] = $data['email'];
            $_SESSION['customer_logged_in'] = true;
            header('location: customerdashboard.php');
            exit; // Always exit after redirect
        } else {
            echo "<h2>Invalid Email or password</h2>";
        }
    } else {
        echo "<h2>Invalid Email or password</h2>";
    }
}
?>
