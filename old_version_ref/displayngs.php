<?php
include_once("connection_db.php");

// Set the content type to JSON
header('Content-type:application/json');


// SQL query to fetch data
$sql = "SELECT * FROM ngs_qty";

// Execute the query
$resultSet = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$resultSet) {
    // Return an error message as JSON
    echo json_encode(['error' => mysqli_error($conn)]);
    exit;
}

// Fetch data and prepare it for JSON encoding
$data = array();
while ($data_pro = mysqli_fetch_assoc($resultSet)) {
    $data = [
        'ng1' => $data_pro,
        'ng2' => $data_pro,        
        'ng3' => $data_pro,
        'ng4' => $data_pro,
        'ng5' => $data_pro,
        'ng6' => $data_pro,
        'ng7' => $data_pro,
        'ng8' => $data_pro,
        'ng9' => $data_pro,
        'ng10' => $data_pro,
        'ng11' => $data_pro,
        'ng12' => $data_pro,
        'ng13' => $data_pro,
        'ng14' => $data_pro

    ];
}

// Output the data as JSON
echo json_encode($data);

// Close the database connection
mysqli_close($conn);
?>
