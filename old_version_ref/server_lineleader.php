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
$sql = "SELECT id, name_leader AS name_leader, img_leader FROM leader_dbs";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            "id" => $row["id"],
            "name_leader" => $row["name_leader"],
            "img_leader" => base64_encode($row["img_leader"]),
         
        );
    }
}

echo json_encode($data);
$conn->close();
?>
