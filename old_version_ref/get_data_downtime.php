
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

$sql="SELECT process,details,time_Elapse,Act,Pics,remark FROM downtime_data LIMIT $limit";


$resultSet = mysqli_query($conn, $sql);	
	$data = array();
	while( $data_pro = mysqli_fetch_assoc($resultSet) ) {
    $data =[
      'process_1'=> $data_pro,
      'details_1'=> $data_pro,
      'action1'=> $data_pro,
      'downtime1'=> $data_pro,
      'pic_1'=> $data_pro,
      'remark_1'=> $data_pro,
     ];
	}
echo json_encode($data);
