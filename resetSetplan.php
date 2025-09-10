<?php
include './src/config/connection_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from POST request
    $p1 = isset($_POST['p1']) ? $_POST['p1'] : '';
    $p2 = isset($_POST['p2']) ? $_POST['p2'] : '';
    $p3 = isset($_POST['p3']) ? $_POST['p3'] : '';
    $p4 = isset($_POST['p4']) ? $_POST['p4'] : '';
    $p5 = isset($_POST['p5']) ? $_POST['p5'] : '';
    $p6 = isset($_POST['p6']) ? $_POST['p6'] : '';
    $p7 = isset($_POST['p7']) ? $_POST['p7'] : '';
    $p8 = isset($_POST['p8']) ? $_POST['p8'] : '';
    $p9 = isset($_POST['p9']) ? $_POST['p9'] : '';
    $p10 = isset($_POST['p10']) ? $_POST['p10'] : '';
    $p11 = isset($_POST['p11']) ? $_POST['p11'] : '';
    $p12 = isset($_POST['p12']) ? $_POST['p12'] : '';
    $p13 = isset($_POST['p13']) ? $_POST['p13'] : '';
    $p14 = isset($_POST['p14']) ? $_POST['p14'] : '';
    
    // Set the ID for the update (this should be retrieved from your form or context)
    $id = 1; // Replace this with the appropriate value from your request if necessary

    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE Setplan SET plan1=?, plan2=?, plan3=?, plan4=?, plan5=?, plan6=?, plan7=?, plan8=?, plan9=?, plan10=?, plan11=?, plan12=?, plan13=?, plan14=? ");

    // Check for preparation errors
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssssssssssss", $p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9, $p10, $p11, $p12, $p13, $p14);

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
