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
$query = 'SELECT time_num FROM downtime_data';
$result = $mysqli->query($query);

// Initialize an array to store the data
$data_downt = [
    'labels' =>['6AM','7AM','8AM','9AM','10AM','11AM','12NN','1PM','2PM',
                '3PM','4PM','5PM','6PM','7PM','8PM'
],
    'time_datas'=>[]
];

// Fetch data and store it in the array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

 // Add label, modify if needed
    $data_downt['time_datas'][] = $row['time_num'];
    }
} else {
    $data['time_datas'][] = 0; // Default value if no data is found
}
echo json_encode($data_downt);
// Free the result set
$result->free();

// Close the connection
$mysqli->close();

// Return the data array as JSON

?>
