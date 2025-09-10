<?php
// Enable error reporting (only for development; remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set response content type
header('Content-Type: application/json');

// Database connection
$host = "localhost";
$user = "root";
$pass = "123";
$dbname = "lcd_dbs";
$conn = new mysqli($host, $user, $pass, $dbname);

// Connection check
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'DB connection failed: ' . $conn->connect_error]);
    exit;
}

// Get incoming JSON data
$data = json_decode(file_get_contents('php://input'), true);
$edit_controller = $data['editController'] ?? [];

// Validate input
if (!is_array($edit_controller) || empty($edit_controller)) {
    echo json_encode(['success' => false, 'message' => 'Invalid or empty input']);
    exit;
}

// Prepare statement
$stmt = $conn->prepare("UPDATE editCtrlData SET currentCount = ?, currentTime = ?, currentPlan = ?, previousPlan = ?, totalCount = ?, signal_edit=? WHERE id = ?");
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
    exit;
}

// Loop and bind values (assumes 1 row with id=1)
foreach ($edit_controller as $controllerEditData) {
    $currentCount   = intval($controllerEditData['currentCount'] ?? 0);
    $currentTime    = intval($controllerEditData['currentTime'] ?? 0);
    $currentPlan    = intval($controllerEditData['currentPlan'] ?? 0);
    $previousPlan   = intval($controllerEditData['previousPlan'] ?? 0);
    $totalCount     = intval($controllerEditData['totalCount'] ?? 0);
    $signalEdit =1;
    $id = 1; // Update only the row with id = 1

    $stmt->bind_param("iiiiiii", $currentCount, $currentTime, $currentPlan, $previousPlan, $totalCount,$signalEdit, $id);
    
    if (!$stmt->execute()) {
        echo json_encode(['success' => false, 'message' => 'Execute failed: ' . $stmt->error]);
        $stmt->close();
        $conn->close();
        exit;
    }
}

$stmt->close();
$conn->close();

// Success
echo json_encode(['success' => true, 'message' => 'Edit controller data updated']);
?>
