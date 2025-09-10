<?php

// Check if form data is sent via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Sanitize and validate input
    $time_val = isset($_POST['time']) ? intval($_POST['time']) : 0;
    $ngqty = isset($_POST['ngqty']) ? $conn->real_escape_string($_POST['ngqty']) : '';
    $id = 1;
    // Ensure $time_val is within the expected range
    if ($time_val < 1 || $time_val > 14) {
        die("Invalid time value.");
    }

    // Define the mapping of time_val to ngsArr
    $ngsArr = [
        1 => "ng1",
        2 => "ng2",
        3 => "ng3",
        4 => "ng4",
        5 => "ng5",
        6 => "ng6",
        7 => "ng7",
        8 => "ng8",
        9 => "ng9",
        10 => "ng10",
        11 => "ng11",
        12 => "ng12",
        13 => "ng13",
        14 => "ng14"
    ];

    // Get the correct column name based on $time_val
    $ng_column = $ngsArr[$time_val];

    // Prepare the SQL statement to avoid SQL injection
    $stmt = $conn->prepare("UPDATE ngs_qty SET $ng_column = ? WHERE id = ?");
    $stmt->bind_param('si', $ngqty, $id);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Data updated successfully";
    } else {
        echo "Error updating data: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

