<?php
include 'connection_db.php';  // Include the database connection script

header('Content-Type: application/json');  // Set header for JSON output

// Query to fetch data from the database
$sql = "SELECT time_prod,cycle_time,min,plan_out_hr,total_out_hr,countPerHr,countTol,achieved,NG_count FROM actualCountData";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    // Fetch data and store it in an array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Encode the data array to JSON format
echo json_encode($data);

// Close the connection
$conn->close();
?>
