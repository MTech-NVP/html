<?php
include './src/config/connection_db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve posted data
    
    $process = isset($_POST['process']) ? $_POST['process'] : '';
    $details = isset($_POST['details']) ? $_POST['details'] : '';
    $time_elapse = isset($_POST['time_elapse']) ? $_POST['time_elapse'] : '';
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    $pics = isset($_POST['pics']) ? $_POST['pics'] : '';
    $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : '';
    $timeCount = isset($_POST['timeCount']) ? $_POST['timeCount'] : '';

    // Prepare an SQL statement for safe insertion
    $stmt = $conn->prepare("UPDATE downtime_data 
    SET process = ?, details=?,time_Elapse=?, Act =?, Pics = ?, remark = ?,time_num=?");
    // Bind parameters
    $stmt->bind_param("sssssss"
    ,$process,$details,$time_elapse,$action,$pics,$remarks,$timeCount);

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
