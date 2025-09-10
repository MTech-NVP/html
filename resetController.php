<?php
include './src/config/connection_db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve posted data
    $id = 1;
    $currentTime = isset($_POST['currentTime']) ? $_POST['currentTime'] : '';
    $currentCount = isset($_POST['currentCount']) ? $_POST['currentCount'] : '';
    $currentPlan = isset($_POST['currentPlan']) ? $_POST['currentPlan'] : '';
    $previousPlan = isset($_POST['previousPlan']) ? $_POST['previousPlan'] : '';
    $totalCount = isset($_POST['totalCount']) ? $_POST['totalCount'] : '';


    // Prepare an SQL statement for safe insertion
    $stmt = $conn->prepare("UPDATE editCtrlData SET currentCount = ?, currentPlan = ?, currentTime = ?,previousPlan= ?,totalCount=? WHERE id=?" );
    // Bind parameters
    $stmt->bind_param("sssssi"
    ,$currentCount,$currentPlan,$currentTime,$previousPlan,$totalCount,$id);

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
