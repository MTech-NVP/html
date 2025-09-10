<?php
include'connection_db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve posted data
    $id = 1;
    $CopyLine = isset($_POST['CopyLine']) ? $_POST['CopyLine'] : '';
    $CopyModel = isset($_POST['CopyModel']) ? $_POST['CopyModel'] : '';
    $CopyDate = isset($_POST['CopyDate']) ? $_POST['CopyDate'] : '';
    $CopyDel_date = isset($_POST['CopyDel_date']) ? $_POST['CopyDel_date'] : '';
    $CopyBalance = isset($_POST['CopyBalance']) ? $_POST['CopyBalance'] : '';
    $CopyManpower = isset($_POST['CopyManpower']) ? $_POST['CopyManpower'] : '';
    $CopyctAsof = isset($_POST['CopyctAsof']) ? $_POST['CopyctAsof'] : '';
    $CopyExpdate = isset($_POST['CopyExpdate']) ? $_POST['CopyExpdate'] : '';
    $CopyPartno = isset($_POST['CopyPartno']) ? $_POST['CopyPartno'] : '';

    // Validate part_no
    if (!empty($CopyPartno)) {
        // Prepare an SQL statement for safe retrieval
        $stmt = $conn->prepare("SELECT part_no FROM details_product WHERE id = ?");
        $stmt->bind_param("s", $CopyPartno);  // "s" indicates the parameter type is a string
        $stmt->execute();
        $resultSet = $stmt->get_result();

        // Fetch data
        $temp = '';
        if ($data_pro = $resultSet->fetch_assoc()) {
            $temp = $data_pro['part_no'];
        }
        $stmt->close();
    } else {
        $temp = 'N/A';  // Default value if part_no is not provided
    }

    // Prepare an SQL statement for safe insertion
   $stmt = $conn->prepare("UPDATE copy_prod_details SET LINENO = ?, model_product = ?, del_date = ?, BALANCE = ?, manpower_line = ?, CT_AS_OF = ?, EXP_DATE = ?, CREATEDATE = ?, PART_NO = ? WHERE id = ?");
// Bind parameters
$stmt->bind_param("sssssssssi", $CopyLine, $CopyModel, $CopyDel_date, $CopyBalance, $CopyManpower, $CopyctAsof, $CopyExpdate, $CopyDate, $temp, $id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method";
}

?>
