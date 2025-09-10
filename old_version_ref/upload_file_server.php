<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "lcd_dbs";

$conn = new mysqli($servername, $username, $password, $dbname);
$id = 1; // Define the ID you want to update

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if file was uploaded
if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $fileData = file_get_contents($_FILES['file']['tmp_name']);

    // Prepare SQL statement to update existing file based on ID
    $stmt = $conn->prepare("UPDATE files SET file_data = ? WHERE id = ?");
    $stmt->bind_param("bi", $fileData, $id);
    $stmt->send_long_data(0, $fileData); // Send the binary data

    // Execute query
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "<script>alert('File updated successfully!'); window.location.href='planner.php';</script>";
        } else {
            echo "File not found or no changes made.";
        }
    } else {
        echo "Failed to update file: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No file uploaded or there was an error uploading the file.";
}

$conn->close();
?>
