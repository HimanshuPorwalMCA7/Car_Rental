<?php
// Start the session
session_start();

// Destroy all session data
session_destroy();

// Redirect to the login page
header('location: customerlogin.html');
exit();
?>