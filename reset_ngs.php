<?php
include './src/config/connection_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from POST request
    $ng1 = isset($_POST['ng1']) ? $_POST['ng1'] : '';
    $ng2 = isset($_POST['ng2']) ? $_POST['ng2'] : '';
    $ng3 = isset($_POST['ng3']) ? $_POST['ng3'] : '';
    $ng4 = isset($_POST['ng4']) ? $_POST['ng4'] : '';
    $ng5 = isset($_POST['ng5']) ? $_POST['ng5'] : '';
    $ng6 = isset($_POST['ng6']) ? $_POST['ng6'] : '';
    $ng7 = isset($_POST['ng7']) ? $_POST['ng7'] : '';
    $ng8 = isset($_POST['ng8']) ? $_POST['ng8'] : '';
    $ng9 = isset($_POST['ng9']) ? $_POST['ng9'] : '';
    $ng10 = isset($_POST['ng10']) ? $_POST['ng10'] : '';
    $ng11 = isset($_POST['ng11']) ? $_POST['ng11'] : '';
    $ng12 = isset($_POST['ng12']) ? $_POST['ng12'] : '';
    $ng13 = isset($_POST['ng13']) ? $_POST['ng13'] : '';
    $ng14 = isset($_POST['ng14']) ? $_POST['ng14'] : '';
    
    // Set the ID for the update (this should be retrieved from your form or context)
    $id = 1; // Replace this with the appropriate value from your request if necessary

    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE ngs_qty 
        SET ng1=?, ng2=?, ng3=?, ng4=?, ng5=?, ng6=?, ng7=?, ng8=?, ng9=?, ng10=?, ng11=?, ng12=?, ng13=?, ng14=? 
        WHERE id=?");

    // Check for preparation errors
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssssssssssssi", $ng1, $ng2, $ng3, $ng4, $ng5, $ng6, $ng7, $ng8, $ng9, $ng10, $ng11, $ng12, $ng13, $ng14, $id);

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


