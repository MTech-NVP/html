
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

$sql="SELECT time_num FROM downtime_data";


$resultSet = mysqli_query($conn, $sql);	
	$count = 0 ;
    $data = array();
	while( $data_downtime = mysqli_fetch_assoc($resultSet) ) {
        
        $data = [
            'downtime'=> $count+=$data_downtime['time_num']
        ];
        
	}
echo json_encode($data);
