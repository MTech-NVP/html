<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Database connection
$host = "localhost";
$user = "root";
$pass = "123";
$db   = "monitoring";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($action === 'get_plan_value') {
    header('Content-Type: application/json; charset=utf-8');

    $stmt = $conn->prepare("SELECT plan FROM PlanSelection WHERE id = 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if (!$row) {
        echo json_encode(0);
        exit;
    }



    $stmt2 = $conn->prepare("SELECT model FROM PlanOutput WHERE id = ?");
    $stmt2->bind_param("i", $id_value);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $product_row = $result2->fetch_assoc();

    if (!$product_row) {
        echo json_encode(0);
        exit;
    }

    echo json_encode($product_row);
    exit;
}


/* ===============================
   FALLBACK — ONLY IF NO ACTION
================================ */
if (!$action) {

    // 🔑 Check plan first
    $stmt = $conn->prepare("SELECT plan FROM PlanSelection WHERE id = 1");
    $stmt->execute();
    $resPlan = $stmt->get_result();
    $planRow = $resPlan->fetch_assoc();

    // If no plan or plan = 0 → return 0 0
    if (!$planRow || (int)$planRow['plan'] === 0) {
        echo "0 0";
        exit;
    }

    $sql = "SELECT 
                COALESCE(SUM(plan_output),0) AS totalPlan, 
                COALESCE(SUM(actual_output),0) AS totalCount 
            FROM OutputTable";
    $result = $conn->query($sql);

    if ($result && $row = $result->fetch_assoc()) {
        $totalPlan  = $row['totalPlan'];
        $totalCount = $row['totalCount'];
        echo $totalPlan . " " . $totalCount;
    } else {
        echo "0 0";
    }

    exit; // 🔑 important: stop script so no extra output
}



$conn->close();
?>
