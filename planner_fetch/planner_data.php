<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Database connection
$host = "localhost";
$user = "root";
$pass = "123";
$db   = "lcd_dbs";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if action is provided
$action = $_POST['action'] ?? null;

if ($action === 'get_plan_value') {
    $stmt = $conn->prepare("SELECT id_value FROM plan_id_value WHERE id = 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        die(json_encode(["error" => "No plan found"]));
    }

    $id_value = $row['id_value'];

    $stmt2 = $conn->prepare("SELECT model FROM details_product WHERE id = ?");
    $stmt2->bind_param("i", $id_value);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $product_row = $result2->fetch_assoc();

    if (!$product_row) {
        die(json_encode(["error" => "No model found for id_value $id_value"]));
    }

    echo json_encode($product_row);
    exit;
}

$sql = "SELECT SUM(plan_out_hr) AS totalPlan, SUM(countPerHr) AS totalCount FROM actualCountData";
$result = $conn->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    $totalPlan = $row['totalPlan'];
    $totalCount = $row['totalCount'];
    echo $totalPlan . " " . $totalCount;
} else {
    echo "0"; // fallback if query fails
}

$conn->close();
?>
