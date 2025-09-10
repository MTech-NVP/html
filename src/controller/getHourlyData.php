<?php
$host = "localhost";
$user = "root";
$pass = "123";
$dbname = "lcd_dbs";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT countPerHr FROM actualCountData");

$data = array();
while ($row = $result->fetch_assoc()) {
  $data[] = $row['countPerHr']; // only store names
}

echo json_encode($data);

$conn->close();
?>
