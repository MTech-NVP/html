<?php
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

// Check if 'id' is set and not empty
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare and execute the SQL query
    $sql = "SELECT checked FROM checked_sign WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        header("Content-type: image/jpeg");
        echo $row['checked'];
    } else {
        header("HTTP/1.0 404 Not Found");
        echo "Image not found.";
    }

    $stmt->close();
} else {
    header("HTTP/1.0 400 Bad Request");
    echo "Invalid or missing 'id' parameter.";
}

$conn->close();
?>
