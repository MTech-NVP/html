<?php
include '../html/src/config/connection_db.php';  // Include the database connection script

header('Content-Type: application/json');  // Set header for JSON output

// Query to fetch data from the database
$sql = "SELECT Partno,line_no,total_output,total_ng,goodqty,total_prod_hrs,total_downtime,actual_prod_hrs,achieve_per_day,breaktime,manpower,day_created FROM history_data";
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
