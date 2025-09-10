<?php
header('Content-Type:application/json');

// Database connection details
$host = 'localhost';
$dbname = 'lcd_dbs';
$username = 'root';
$password = '123';

// Create a new MySQLi instance
$mysqli = new mysqli($host, $username, $password, $dbname);

// Check for connection errors
if ($mysqli->connect_error) {
    echo json_encode(['error' => $mysqli->connect_error]);
    exit();
}

// Query to fetch data from the database
$query = 'SELECT total_downtime,day_created  FROM history_data';
$result = $mysqli->query($query);


// Initialize an array to store the data
$data = [
    'dates' =>[],
    'datas'=>[]
];

// Fetch data and store it in the array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
 // Add label, modify if needed
        $data['dates'][] = $row['day_created'];
        $data['datas'][] = $row['total_downtime'];
    }
} else {
    $data['date'][] = '';
    $data['datas'][] = 0; // Default value if no data is found
}
echo json_encode($data);
// Free the result set
$result->free();

// Close the connection
$mysqli->close();

// Return the data array as JSON

?>
