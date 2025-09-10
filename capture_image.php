<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "lcd_dbs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    $image = $_POST['image'];
    // Extract Base64 data
    $image = str_replace('data:image/png;base64,', '', $image);
    $image = str_replace(' ', '+', $image);
    $imageData = base64_decode($image);

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO production_pdf_records (image_data, DateCreated) VALUES (?, NOW())");
    $stmt->bind_param("b", $imageData);
    
    // Use MySQL BLOB data type
    $stmt->send_long_data(0, $imageData);

    if ($stmt->execute()) {
        echo "Image saved successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}


?>
