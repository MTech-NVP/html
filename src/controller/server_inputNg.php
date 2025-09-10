<?php
// Database connection
$host = "localhost";  // Change if needed
$user = "root";       // Change to your database username
$pass = "123";           // Change to your database password
$dbname = "lcd_dbs";  // Change to your database name

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and validate data from AJAX request
$time = isset($_POST['time']) ? intval($_POST['time']) : 0;
$ng_qty = isset($_POST['ng_qty']) ? intval($_POST['ng_qty']) : 0;
$ng1 = isset($_POST['ng1']) ? intval($_POST['ng1']) : 0;
$ng2 = isset($_POST['ng2']) ? intval($_POST['ng2']) : 0;
$ng3 = isset($_POST['ng3']) ? intval($_POST['ng3']) : 0;

if ($time <= 0) {
    die("Invalid time value.");
}

// Query to fetch data using prepared statement
$sql = "SELECT  total_out_hr, countPerHr, countTol FROM actualCountData WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $time);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the first row of results
    $row = $result->fetch_assoc();

    // Store in separate variables
    $var1 = $row['countPerHr'];
    $var2 = $row['countTol'];
    $var3 = $row['total_out_hr'];

    // Perform calculations
    $temp1 = $var1 - $ng_qty;
    $temp2 = $var2 - $ng_qty;

    $cnt_per_hr = $temp1;
    $cnt_tol_hr = $temp2;

    // Avoid division by zero
    if ($temp2 != 0) {
        $temp3 = ($temp2 / $var3) * 100;
    } else {
        $temp3 = 0; // Default to 0 if division by zero occurs
    }
    
    // Debugging: Print values before updating
    echo "Debug - temp1: $temp1, temp2: $temp2, temp3: $temp3 <br>";

    // Update query using prepared statement
    $sql = "UPDATE actualCountData SET countPerHr=?, countTol=?, achieved=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dddi", $temp1, $temp2, $temp3, $time);

    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No results found.";
}

// Close connection
$conn->close();
?>
