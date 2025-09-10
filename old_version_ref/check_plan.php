<?php
// Database connection settings
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

if (isset($_POST['dropdownValue'])) {
    $selectedValue = $conn->real_escape_string($_POST['dropdownValue']);
    $id = 1;
    // SQL query to insert the value into the database
    $sql = "UPDATE plan_id_value SET id_value = '$selectedValue' WHERE id = '$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Success: " . $selectedValue;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
