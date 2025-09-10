<?php
include 'connection_db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve posted data
    $id = 1;
    $plan1 = isset($_POST['plan1']) ? $_POST['plan1'] : '';
    $plan2 = isset($_POST['plan2']) ? $_POST['plan2'] : '';
    $plan3 = isset($_POST['plan3']) ? $_POST['plan3'] : '';
    $plan4 = isset($_POST['plan4']) ? $_POST['plan4'] : '';
    $plan5 = isset($_POST['plan5']) ? $_POST['plan5'] : '';
    $plan6 = isset($_POST['plan6']) ? $_POST['plan6'] : '';
    $plan7 = isset($_POST['plan7']) ? $_POST['plan7'] : '';
    $plan8 = isset($_POST['plan8']) ? $_POST['plan8'] : '';
    $plan9 = isset($_POST['plan9']) ? $_POST['plan9'] : '';
    $plan10 = isset($_POST['plan10']) ? $_POST['plan10'] : '';
    $plan11 = isset($_POST['plan11']) ? $_POST['plan11'] : '';
    $plan12 = isset($_POST['plan12']) ? $_POST['plan12'] : '';
    $plan13 = isset($_POST['plan13']) ? $_POST['plan13'] : '';
    $plan14 = isset($_POST['plan4']) ? $_POST['plan14'] : '';

    // Prepare an SQL statement for safe insertion
    $stmt = $conn->prepare("UPDATE Setplan 
    SET plan1 = ?, plan2 = ?, plan3 = ?, plan4 = ?,plan5 = ?,
        plan6 = ?, plan7 = ?, plan8 = ?, plan9 = ?,plan10 = ?,
        plan11 =?,plan12 = ?, plan13 = ?, plan14 = ?   
     WHERE id = ?");
    // Bind parameters
    $stmt->bind_param("ssssssssssssssi"
    ,$plan1,$plan2,$plan3,$plan4,$plan5,$plan6,$plan7,$plan8,$plan9,
    $plan10,$plan11,$plan12,$plan13,$plan14,$id);

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
