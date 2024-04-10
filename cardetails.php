    <?php
    // Initialize message variable
    $message = "";

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $vehicle_model = $_POST['vehicle_model'];
        $vehicle_number = $_POST['vehicle_number'];
        $seating_capacity = $_POST['seating_capacity'];
        $rent_per_day = $_POST['rent_per_day'];

        // Database connection
        $con = new mysqli("localhost", "root", "", "carrental");
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        // Check if the vehicle number is unique
        $check_stmt = $con->prepare("SELECT * FROM cardetails WHERE vehicle_number = ?");
        $check_stmt->bind_param("s", $vehicle_number);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            // Vehicle number already exists
            $message = "Vehicle number already exists.";
            header('location:agenciesdashboard.html');
        } else {
            // Prepare SQL statement to insert new car details
            $stmt = $con->prepare("INSERT INTO cardetails (vehicle_model, vehicle_number, seating_capacity, rent_per_day) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssii", $vehicle_model, $vehicle_number, $seating_capacity, $rent_per_day);

            // Execute the statement
            if ($stmt->execute()) {
                // Car details inserted successfully
                $message = "Car details added successfully.";
                // Redirect to agenciesdashboard.html
                header('location:agenciesdashboard.html');
            } else {
                // Error in execution
                $message = "Error: " . $stmt->error;
            }

            // Close statement
            $stmt->close();
        }

        // Close connection
        $con->close();
    }
    ?>
