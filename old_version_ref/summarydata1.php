<?php
include 'connection_db.php'; // Ensure this file correctly initializes $conn

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = 1; // ID is hardcoded; you might want to get it from POST data or other sources

    // Retrieve POST data with default empty values
    $total_output_data = isset($_POST['total_output_data']) ? $_POST['total_output_data'] : '';
    $total_ng_data = isset($_POST['total_ng_data']) ? $_POST['total_ng_data'] : '';
    $goodQty_data = isset($_POST['goodQty_data']) ? $_POST['goodQty_data'] : '';
    $totalProdhr_data = isset($_POST['totalProdhr_data']) ? $_POST['totalProdhr_data'] : '';
    $totalDowntime_data = isset($_POST['totalDowntime_data']) ? $_POST['totalDowntime_data'] : '';
    $actualProdhr_data = isset($_POST['actualProdhr_data']) ? $_POST['actualProdhr_data'] : '';
    $actualManpower_data = isset($_POST['actualManpower_data']) ? $_POST['actualManpower_data'] : '';
    $breakTime_data = isset($_POST['breakTime_data']) ? $_POST['breakTime_data'] : '';
    $achieveToday_data = isset($_POST['achieveToday_data']) ? $_POST['achieveToday_data'] : '';

    // Prepare an SQL statement for safe insertion
    $stmt = $conn->prepare("UPDATE summary_print
        SET total_data = ?, total_ng = ?, good_data = ?, totalProd_data = ?, totalDowntime_data = ?, 
            actualProdhr_data = ?, actualManpower_data = ?, breaktime_data = ?, achieve_data = ?
        WHERE id = ?");
    
    // Check if statement preparation was successful
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param(
        "sssssssssi",
        $total_output_data,
        $total_ng_data,
        $goodQty_data,
        $totalProdhr_data,
        $totalDowntime_data,
        $actualProdhr_data,
        $actualManpower_data,
        $breakTime_data,
        $achieveToday_data,
        $id
    );

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
