<?php
// database connection
include_once("connection_db.php");

// Fetch the PDF data from the database
$sql = "SELECT file_name, file_data FROM files WHERE file_name = 'REVISION  4 (YDB SWP 2024)' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fileData = $row['file_data'];

    // Send headers
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . $row['file_name'] . '"');
    echo $fileData;
} else {
    echo "PDF not found in the database.";
}

$conn->close();
?>


