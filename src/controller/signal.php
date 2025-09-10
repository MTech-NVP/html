<?php
include '../config/connection_db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve posted data
    $id = 1;
    $submit_sig = isset($_POST['submit_sig']) ? $_POST['submit_sig'] : '';

    // Prepare an SQL statement for safe insertion
    $stmt = $conn->prepare("UPDATE  submit_signal
    SET signal_val=?  WHERE id = ?");
    // Bind parameters
    $stmt->bind_param("si"
    ,$submit_sig,$id);

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
