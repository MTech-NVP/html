<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = "123"; // Your MySQL password
$dbname = "lcd_dbs"; // Your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if time data is sent via POST
if (isset($_POST['time'])) {
    $time = intval($_POST['time']);

    // Insert time into database
    $sql = "INSERT INTO times (elapsed_times) VALUES ($time)";
    if ($conn->query($sql) === TRUE) {
        echo "Time saved successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "No time data received";
}

$conn->close();
?>
