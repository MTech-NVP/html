<?php
include './src/config/connection_db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve posted data
    $id = 1;
    $sumOfdata = isset($_POST['sumOfdata']) ? $_POST['sumOfdata'] : '';
    $good_sum = isset($_POST['good_sum']) ? $_POST['good_sum'] : '';
    $achieve_day = isset($_POST['achieve_day']) ? $_POST['achieve_day'] : '';
    $totalngs = 0;

    // Prepare an SQL statement for safe insertion
    $stmt = $conn->prepare("UPDATE  sum_count 
    SET total_output = ?, good_qty = ?, achieve_today = ?, totalngs =?");
    // Bind parameters
    $stmt->bind_param("ssss"
    ,$sumOfdata,$good_sum,$achieve_day,$totalngs);

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
