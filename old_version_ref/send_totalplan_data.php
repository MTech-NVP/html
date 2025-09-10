<?php
include 'connection_db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve posted data
    $id = 1;
    $totalhr1 = isset($_POST['totalhr1']) ? $_POST['totalhr1'] : '';
    $totalhr2 = isset($_POST['totalhr2']) ? $_POST['totalhr2'] : '';
    $totalhr3 = isset($_POST['totalhr3']) ? $_POST['totalhr3'] : '';
    $totalhr4 = isset($_POST['totalhr4']) ? $_POST['totalhr4'] : '';
    $totalhr5 = isset($_POST['totalhr5']) ? $_POST['totalhr5'] : '';
    $totalhr6 = isset($_POST['totalhr6']) ? $_POST['totalhr6'] : '';
    $totalhr7 = isset($_POST['totalhr7']) ? $_POST['totalhr7'] : '';
    $totalhr8 = isset($_POST['totalhr8']) ? $_POST['totalhr8'] : '';
    $totalhr9 = isset($_POST['totalhr9']) ? $_POST['totalhr9'] : '';
    $totalhr10 = isset($_POST['totalhr10']) ? $_POST['totalhr10'] : '';
    $totalhr11 = isset($_POST['totalhr11']) ? $_POST['totalhr11'] : '';
    $totalhr12 = isset($_POST['totalhr12']) ? $_POST['totalhr12'] : '';
    $totalhr13 = isset($_POST['totalhr13']) ? $_POST['totalhr13'] : '';
    $totalhr14 = isset($_POST['totalhr14']) ? $_POST['totalhr14'] : '';

    // Prepare an SQL statement for safe insertion
    $stmt = $conn->prepare("UPDATE SetTotalplan 
    SET PLANT1 = ?, PLANT2 = ?, PLANT3 = ?, PLANT4 = ?,PLANT5 = ?,
        PLANT6 = ?, PLANT7 = ?, PLANT8 = ?, PlANT9 = ?,PLANT10 = ?,
        PLANT11 =?,PLANT12 = ?, PLANT13 = ?, PLANT14 = ?   
     WHERE id = ?");
    // Bind parameters
    $stmt->bind_param("ssssssssssssssi"
    ,$totalhr1,$totalhr2,$totalhr3,$totalhr4,$totalhr5,$totalhr6,$totalhr7,$totalhr8,$totalhr9,
    $totalhr10,$totalhr11,$totalhr12,$totalhr13,$totalhr14,$id);

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
