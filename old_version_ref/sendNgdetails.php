<?php
include 'connection_db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve posted data
    $id = 1;
    $time_txt = isset($_POST['time']) ? $_POST['time'] : '';
    $time_val = isset($_POST['time_val']) ? $_POST['time_val'] : '';
    $ngqty = isset($_POST['ngqtys']) ? $_POST['ngqtys'] : '';
    $ngtype1 = isset($_POST['ngtype1']) ? $_POST['ngtype1'] : '';
    $ngtype2 = isset($_POST['ngtype2']) ? $_POST['ngtype2'] : '';
    $ngtype3 = isset($_POST['ngtype3']) ? $_POST['ngtype3'] : '';
    // Prepare an SQL statement for safe insertion
    $stmt = $conn->prepare("UPDATE  ng_details
    SET time_txt = ?, time_val = ?,ngqtys=?,ngtype1 =?,ngtype2=?,ngtype3=?  WHERE id = ?");
    // Bind parameters
    $stmt->bind_param("ssssssi"
    ,$time_txt,$time_val,$ngqty,$ngtype1,$ngtype2,$ngtype3,$time_val);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method";
}

?>
