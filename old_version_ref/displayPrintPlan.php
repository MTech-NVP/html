
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

$sql="SELECT plan1, plan2, plan3, plan4, plan5, plan5, plan5, plan6, 
            plan7, plan8, plan9, plan10, plan11, plan12, plan13, plan14

FROM Setplan LIMIT $limit";


$resultSet = mysqli_query($conn, $sql);	
	$data = array();

	while( $data_pro = mysqli_fetch_assoc($resultSet) ) {
    $data =[
      'planp1'=> $data_pro,
      'planp2'=> $data_pro,
      'planp3'=> $data_pro,
      'planp4'=> $data_pro,
      'planp5'=> $data_pro,
      'planp6'=> $data_pro,
      'planp7'=> $data_pro,
      'planp8'=> $data_pro,
      'planp9'=> $data_pro,
      'planp10'=> $data_pro,
      'planp11'=> $data_pro,
      'planp12'=> $data_pro,
      'planp13'=> $data_pro,
      'planp14'=> $data_pro
     ];
	}

echo json_encode($data);
