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
header('Content-type:application/json');

$limit = 1;

// Corrected SQL statement
$sql = "SELECT PLANT1, PLANT2, PLANT3, PLANT4, PLANT5, PLANT6, PLANT7, PLANT8, PLANT9, PLANT10, PLANT11, PLANT12, PLANT13, PLANT14 FROM SetTotalplan LIMIT $limit";

$resultSet = mysqli_query($conn, $sql);	
$data = array();

if ($resultSet) {
    while ($data_pro = mysqli_fetch_assoc($resultSet)) {
        $data = [
            'planpt1' => $data_pro,
            'planpt2' => $data_pro,
            'planpt3' => $data_pro,
            'planpt4' => $data_pro,
            'planpt5' => $data_pro,
            'planpt6' => $data_pro,
            'planpt7' => $data_pro,
            'planpt8' => $data_pro,
            'planpt9' => $data_pro,
            'planpt10' => $data_pro,
            'planpt11' => $data_pro,
            'planpt12' => $data_pro,
            'planpt13' => $data_pro,
            'planpt14' => $data_pro
        ];
    }
}

echo json_encode($data);
$conn->close();
?>

