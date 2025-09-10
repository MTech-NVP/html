<?php
include_once("./src/config/connection_db.php");

// Set the content type to JSON
header('Content-type:application/json');

// Limit for the query
$limit = 1;

// SQL query to fetch data
$sql = "SELECT PART_NO, LINENO, model_product, del_date, BALANCE, manpower_line, CT_AS_OF, EXP_DATE, CREATEDATE FROM copy_prod_details LIMIT $limit";

// Execute the query
$resultSet = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$resultSet) {
    // Return an error message as JSON
    echo json_encode(['error' => mysqli_error($conn)]);
    exit;
}

// Fetch data and prepare it for JSON encoding
$data = array();
while ($data_pro = mysqli_fetch_assoc($resultSet)) {
    $data = [
        'partno' => $data_pro,
        'LINE_NO' => $data_pro,        
        'model' => $data_pro,
        'delDate' => $data_pro,
        'balance' => $data_pro,
        'dates' => $data_pro,
        'manpower' => $data_pro,
        'ctasof' => $data_pro,
        'expdate' => $data_pro
    ];
}

// Output the data as JSON
echo json_encode($data);

// Close the database connection
mysqli_close($conn);
?>
