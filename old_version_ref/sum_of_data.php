
<?php
include_once("connection_db.php");
header('Content-type:application/json');

$limit = 1;

$sql="SELECT * FROM sum_count LIMIT $limit";


$resultSet = mysqli_query($conn, $sql);	
	$data = array();
	while( $data_pro = mysqli_fetch_assoc($resultSet) ) {
    $data =[
      'total_output'=> $data_pro,
      'good_qty'=> $data_pro,
      'achieve_today'=> $data_pro,
      'totalngs' =>$data_pro
     ];
	}

echo json_encode($data);
