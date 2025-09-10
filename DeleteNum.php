<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$pass = "123";
$dbname = "lcd_dbs";

// Create connection
$conn = new mysqli($servername, $username, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]);
    exit;
}

// Sanitize and validate input
$person_delete = isset($_POST['person_delete']) ? intval($_POST['person_delete']) : 0;

// Prepare the DELETE statement
$sql = "DELETE FROM person_dbs WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode(["success" => false, "message" => "Prepare failed: " . $conn->error]);
    exit;
}

// Bind parameter
$stmt->bind_param("i", $person_delete);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Deleted successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Error deleting: " . $stmt->error]);
}

// Close resources
$stmt->close();
$conn->close();
?>
