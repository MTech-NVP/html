<?php
header('Content-Type: application/json');

// Database connection
$host = "localhost";
$user = "root";
$password = "123";
$database = "lcd_dbs";
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT id, name_person AS name_person, img_data, cert FROM person_dbs";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            "id" => $row["id"],
            "name_person" => $row["name_person"],
            "img_data" => base64_encode($row["img_data"]),
            "cert" => json_decode($row["cert"]) // Decode JSON
        );
    }
}

echo json_encode($data);
$conn->close();
?>
