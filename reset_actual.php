<?php
include './src/config/connection_db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve posted data
    $id = 1;
    $data_hr = isset($_POST['data_hr']) ? $_POST['data_hr'] : '';
    $totalData_hr = isset($_POST['totalData_hr']) ? $_POST['totalData_hr'] : '';
    $achieve_data = isset($_POST['achieve_data']) ? $_POST['achieve_data'] : '';


    // Prepare an SQL statement for safe insertion
    $stmt = $conn->prepare("UPDATE actualCountData 
    SET countPerHr = ?, countTol = ?, achieved = ?");
    // Bind parameters
    $stmt->bind_param("sss"
    ,$data_hr,$totalData_hr,$achieve_data);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method";
}

?>
