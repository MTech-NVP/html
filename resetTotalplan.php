<?php
include './src/config/connection_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from POST request
    $tol1 = isset($_POST['tol1']) ? $_POST['tol1'] : '';
    $tol2 = isset($_POST['tol2']) ? $_POST['tol2'] : '';
    $tol3 = isset($_POST['tol3']) ? $_POST['tol3'] : '';
    $tol4 = isset($_POST['tol4']) ? $_POST['tol4'] : '';
    $tol5 = isset($_POST['ng5']) ? $_POST['tol5'] : '';
    $tol6 = isset($_POST['ng6']) ? $_POST['tol6'] : '';
    $tol7 = isset($_POST['tol7']) ? $_POST['tol7'] : '';
    $tol8 = isset($_POST['tol8']) ? $_POST['tol8'] : '';
    $tol9 = isset($_POST['tol9']) ? $_POST['tol9'] : '';
    $tol10 = isset($_POST['tol10']) ? $_POST['tol10'] : '';
    $tol11 = isset($_POST['tol11']) ? $_POST['tol11'] : '';
    $tol12 = isset($_POST['tol12']) ? $_POST['tol12'] : '';
    $tol13 = isset($_POST['tol13']) ? $_POST['tol13'] : '';
    $tol14 = isset($_POST['tol14']) ? $_POST['tol14'] : '';
    
    // Set the ID for the update (this should be retrieved from your form or context)
    $id = 1; // Replace this with the appropriate value from your request if necessary

    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE SetTotalplan SET PLANT1=?, PLANT2=?, PLANT3=?, PLANT4=?, PLANT5=?, PLANT6=?, PLANT7=?, PLANT8=?, PLANT9=?, PLANT10=?, PLANT11=?, PLANT12=?, PLANT13=?, PLANT14=? ");

    // Check for preparation errors
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssssssssssss", $tol1, $tol2, $tol3, $tol4, $tol5, $tol6, $tol7, $tol8, $tol9, $tol10, $tol11, $tol12, $tol13, $tol14);

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
