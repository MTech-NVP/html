<?php
header('Content-Type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', '256M'); // optional increase

$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "lcd_dbs";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the latest 10 records
$sql = "SELECT id, image_data, DateCreated FROM production_pdf_records ORDER BY DateCreated DESC LIMIT 10";
$result = $conn->query($sql);

$images = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $imageData = base64_encode($row['image_data']);
        $images[] = [
            'date' => $row['DateCreated'],
            'image_data' => $imageData,
        ];
    }
}

echo json_encode($images);

$conn->close();
