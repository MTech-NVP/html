<?php
$host = "localhost";
$user = "root";
$pass = "123";
$db = "lcd_dbs";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all 'name' values from your table
$sql = "SELECT total_out_hr FROM actualCountData";
$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row['total_out_hr']; // just store the name in array
}

$conn->close();

// Return as JSON
header('Content-Type: application/json');
echo json_encode($data);
