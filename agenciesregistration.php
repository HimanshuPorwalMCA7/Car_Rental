<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $agency_name = $_POST['agency_name'];
    $contact_person = $_POST['contact_person'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Database connection
    $con = new mysqli('localhost', 'root', '', 'carrental');
    if ($con->connect_error) {
        die('Connection Failed: ' . $con->connect_error);
    } else {
        $check_stmt = $con->prepare('SELECT email FROM agencyregistration WHERE email = ?');
        $check_stmt->bind_param('s', $email);
        $check_stmt->execute();
        $check_stmt->store_result();
        if ($check_stmt->num_rows > 0) {
            $check_stmt->close();
            $con->close();
            echo "Email already exists. Please use a different email address.";
            exit();
        } else {
            $check_stmt->close();            
            $stmt = $con->prepare('INSERT INTO agencyregistration (agency_name, contact_person, email, phone, password,role) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->bind_param('ssssss', $agency_name, $contact_person, $email, $phone, $hashed_password,$role);
            $stmt->execute();
            $stmt->close();
            $con->close();
            header('Location: agencieslogin.html');
            exit();
        }
    }
} else {
    // Redirect if accessed directly
    header('Location: agencyregistration.html');
    exit();
}
?>
