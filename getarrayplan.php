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
$query = 'SELECT plan1, plan2, plan3, plan4, plan5, plan6, plan7, plan8, plan9, plan10, plan11, plan12, plan13, plan14 FROM Setplan';
$result = $mysqli->query($query);

// Initialize an array to store the data
$data = [
    'datas' => []
];

// Fetch data and store it in the array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Add each plan data to the 'datas' array
        foreach ($row as $value) {
            $data['datas'][] = $value;
        }
    }
} else {
    $data['datas'][] = 0; // Default value if no data is found
}

echo json_encode($data);

// Free the result set
$result->free();

// Close the connection
$mysqli->close();
?>
