<?php

$servername = "localhost";
$username = "root";
$pass = "123";
$dbname = "lcd_dbs";

// Create connection
$conn = new mysqli($servername, $username, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize and validate inputs
//$time_id = isset($_POST['time_id']) ? intval($_POST['time_id']) : 0;
$balance = isset($_POST['balance']) ? intval($_POST['balance']) : 0;
$partno = isset($_POST['partno']) ? intval($_POST['partno']) : 0;
//$pic_startup = isset($_POST['pic_startup']) ? intval($_POST['pic_startup']) : 0;

// Prepare the UPDATE statement to avoid SQL injection
$sql = "UPDATE details_product SET balance = ? WHERE id = ?";

$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("ii", $balance, $partno);

// Execute the statement
if ($stmt->execute()) {
    echo "Updated successfully";
} else {
    echo "Error updating: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?> 

