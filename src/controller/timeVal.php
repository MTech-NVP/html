<?php
include '../config/connection_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve posted data
    $id = 1; // Assuming this is fixed; consider making it dynamic
    $timeValue = isset($_POST['time_val']) ? $_POST['time_val'] : '';

    // Validate the input
    if (empty($timeValue)) {
        echo "Time value cannot be empty.";
        exit;
    }

    // Prepare an SQL statement for safe insertion
    $stmt = $conn->prepare("UPDATE ngtimeval SET selecttimeval = ? WHERE id = ?");
    
    // Check if the statement was prepared successfully
    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit;
    }

    // Bind parameters
    $stmt->bind_param("si", $timeValue, $id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>

