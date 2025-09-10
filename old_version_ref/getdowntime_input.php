<?php
include_once("connection_db.php");

if (isset($_REQUEST['empid'])) {
    $empid = mysqli_real_escape_string($conn, $_REQUEST['empid']);
    $sql = "SELECT id, process_d, details_d, action_d FROM downtime_inputs WHERE process_d = '$empid'";
    
    $resultSet = mysqli_query($conn, $sql);

    if (!$resultSet) {
        echo json_encode(['error' => mysqli_error($conn)]);
        exit;
    }

    $empData = mysqli_fetch_assoc($resultSet);
    echo json_encode($empData);
} else {
    echo json_encode(['error' => 'No empid provided']);
}
?>

