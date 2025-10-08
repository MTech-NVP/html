<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Database connection
$host = "localhost";
$user = "root";
$pass = "123";
$db   = "lcd_dbs";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sum of countPerHr and plan_out_hr across all rows
$sql = "SELECT SUM(plan_out_hr) AS totalPlan, SUM(countPerHr) AS totalCount FROM actualCountData";

$result = $conn->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    $totalPlan = $row['totalPlan'];
    $totalCount = $row['totalCount'];
    echo $totalPlan. " " . $totalCount;
} else {
    echo "0"; // fallback if query fails
}

$conn->close();
?>
