<?php
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role']; 

$con = new mysqli('localhost', 'root', '', 'carrental');

if ($con->connect_error) {
    die('Connection Failed: ' . $con->connect_error);
} else {
    $check_stmt = $con->prepare('SELECT email FROM customerregistration WHERE email = ?');
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
        $stmt = $con->prepare('INSERT INTO customerregistration (name, email, password,role) VALUES (?, ?, ?,?)');
        $stmt->bind_param('ssss', $name, $email, $password,$role);
        $stmt->execute();
        $stmt->close();
        $con->close();
        header('Location: customerlogin.html');
        exit();
    }
}
?>
