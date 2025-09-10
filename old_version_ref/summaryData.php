<?php
include 'connection_db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = 1;
    $total_output_data= isset($_POST['total_output_data']) ? $_POST['total_output_data'] : '';
    $total_ng_data= isset($_POST['total_ng_data']) ? $_POST['total_ng_data'] : '';
    $goodQty_data= isset($_POST['goodQty_data']) ? $_POST['goodQty_data'] : '';
    $totalProdhr_data= isset($_POST['totalProdhr_data']) ? $_POST['totalProdhr_data'] : '';
    $totalDowntime_data= isset($_POST['totalDowntime_data']) ? $_POST['totalDowntime_data'] : '';
    $actualProdhr_data= isset($_POST['actualProdhr_data']) ? $_POST['actualProdhr_data'] : '';
    $actualManpower_data= isset($_POST['actualManpower_data']) ? $_POST['actualManpower_data'] : '';
    $breakTime_data= isset($_POST['breakTime_data']) ? $_POST['breakTime_data'] : '';
    $achieveToday_data= isset($_POST['achieveToday_data']) ? $_POST['achieveToday_data'] : '';
    $stmt = $conn->prepare("UPDATE  summary_print
    SET total_data = ?,total_ng = ?, good_data = ?, totalProd_data = ?,totalDowntime_data = ?, 
        actualProdhr_data =?, actualManpower_data = ?,breaktime_data=?, achieve_data=?
     WHERE id = ?");
    $stmt->bind_param("sssssssssi"
    ,$total_output_data,
    $total_ng_data,
    $goodQty_data,
    $totalProdhr_data,
    $totalDowntime_data,
    $actualProdhr_data,
    $actualManpower_data,
    $breakTime_data,
    $achieveToday_data,
    $id);
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
 	 }
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method";
}

?>
