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

$limit = 5;

$sql="SELECT process,details,time_Elapse,Act,Pics,remark FROM downtime_data LIMIT $limit";


$resultSet = mysqli_query($conn, $sql); 
        $data = array();
        while( $data_pro = mysqli_fetch_assoc($resultSet) ) {
    $data =[
      'process'=> $data_pro,
      'details'=> $data_pro,
      'action'=> $data_pro,
      'downtime'=> $data_pro,
      'pic'=> $data_pro,
      'remark'=> $data_pro,
     ];
        }
echo json_encode($data);
