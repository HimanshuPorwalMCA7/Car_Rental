    <?php
    
    $message = "";

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $vehicle_model = $_POST['vehicle_model'];
        $vehicle_number = $_POST['vehicle_number'];
        $seating_capacity = $_POST['seating_capacity'];
        $rent_per_day = $_POST['rent_per_day'];

       
        $con = new mysqli("localhost", "root", "", "carrental");
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        
        $check_stmt = $con->prepare("SELECT * FROM cardetails WHERE vehicle_number = ?");
        $check_stmt->bind_param("s", $vehicle_number);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            
            $message = "Vehicle number already exists.";
            header('location:agenciesdashboard.php');
        } else {
           
            $stmt = $con->prepare("INSERT INTO cardetails (vehicle_model, vehicle_number, seating_capacity, rent_per_day) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssii", $vehicle_model, $vehicle_number, $seating_capacity, $rent_per_day);

         
            if ($stmt->execute()) {
                
                $message = "Car details added successfully.";
                
                header('location:agenciesdashboard.php');
            } else {
                
                $message = "Error: " . $stmt->error;
            }

          
            $stmt->close();
        }

        
        $con->close();
    }
    ?>
