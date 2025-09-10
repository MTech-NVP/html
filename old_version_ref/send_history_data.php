<?php
include 'connection_db.php'; // Ensure this file correctly initializes $conn

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from POST request
    $partno = isset($_POST['part_no']) ? $_POST['part_no'] : '';
    $line = isset($_POST['lines']) ? $_POST['lines'] : '';
    $total_output = isset($_POST['total_output']) ? $_POST['total_output'] : '';
    $totalngs = isset($_POST['totalngs']) ? $_POST['totalngs'] : '';
    $totalprod = isset($_POST['totalprod']) ? $_POST['totalprod'] : '';
    $goodqty = isset($_POST['goodqty']) ? $_POST['goodqty'] : '';
    $totaldowntime = isset($_POST['totaldowntime']) ? $_POST['totaldowntime'] : '';
    $actualprod = isset($_POST['actualprod']) ? $_POST['actualprod'] : '';
    $manpower = isset($_POST['manpower']) ? $_POST['manpower'] : '';
    $breaktime = isset($_POST['breaktime']) ? $_POST['breaktime'] : '';
    $achieved = isset($_POST['achieved']) ? $_POST['achieved'] : '';

    // Prepare an SQL statement for safe insertion
    $stmt = $conn->prepare("INSERT INTO history_data(Partno, line_no, total_output, total_ng, goodqty, total_prod_hrs, total_downtime, actual_prod_hrs, achieve_per_day, breaktime, manpower) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sssssssssss", $partno, $line, $total_output, $totalngs, $goodqty, $totalprod, $totaldowntime, $actualprod, $achieved, $breaktime, $manpower);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record inserted successfully";
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


