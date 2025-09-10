
<?php
include_once("connection_db.php");
header('Content-type:application/json');

$limit = 1;

$sql="SELECT balance FROM details_product LIMIT $limit";


$resultSet = mysqli_query($conn, $sql);	
	$data = array();
	while( $data_pro = mysqli_fetch_assoc($resultSet) ) {
    $data =[
      'balance_data'=> $data_pro,
     
     ];
	}
//	echo json_encode($empData);

/*
$result = $mysqli->query($sql);


  if($result->num_rows>0){
    while($row = $result->fetch_assoc()){
       $data =[
        'viewcount'=> $row[1]
       ];
       
    }

  }else{
    echo"No value".$mysqli->error;
  }



$mysqli->close();
*/
echo json_encode($data);
