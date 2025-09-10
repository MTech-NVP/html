<?php
include 'connection_db.php';  // Include the database connection script

header('Content-Type: application/json');  // Set header for JSON output

// Query to fetch data from the database
$sql = "SELECT time_txt,ngqtys,ngtype1,ngtype2,ngtype3 FROM ng_details";
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
