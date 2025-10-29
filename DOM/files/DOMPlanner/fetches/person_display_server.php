<?php
header('Content-Type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', '256M'); // Optional increase

$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "lcd_dbs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Get all records (no LIMIT)
$sql = "SELECT id, name_person,latest_date,recert_date FROM person_dbs ORDER BY id DESC";
$result = $conn->query($sql);

$persons = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $persons[] = [
            'id' => $row['id'],
            'person' => $row['name_person'],
            'latest_date' =>$row['latest_date'],
            'recert_date' =>$row['recert_date']
        ];
    }
}

echo json_encode($persons);
$conn->close();
?>
