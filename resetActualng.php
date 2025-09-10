<?php
include './src/config/connection_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from POST request
    $ng = isset($_POST['ng']) ? $_POST['ng'] : '';
    
    // Set the ID for the update (this should be retrieved from your form or context)
    $id = 1; // Replace this with the appropriate value from your request if necessary

    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE actualCountData SET NG_count=?");

    // Check for preparation errors
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("s", $ng);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method";
}
?>


