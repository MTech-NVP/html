
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

$sql="SELECT total_output_data,total_ng_data, goodQty_data, totalProdhr_data,totalDowntime_data, totalDowntime_data,
            actualProdhr_data, actualManpower_data, breakTime_data,achieveToday_data
FROM summary_print LIMIT $limit";


$resultSet = mysqli_query($conn, $sql);	
	$data = array();

	while( $data_pro = mysqli_fetch_assoc($resultSet) ) {
    $data =[
      'totalData'=> $data_pro,
      'total_ng_data' => $data_pro,
      'goodData' => $data_pro,
      'totalProd'=> $data_pro,
      'totaldown'=> $data_pro,
      'actualhr'=> $data_pro,
      'actualman'=> $data_pro,
      'breaktime'=> $data_pro,
      'achieveday'=> $data_pro

     ];
	}

echo json_encode($data);
