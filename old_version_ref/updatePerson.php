<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Database configuration
$host = 'localhost';
$dbname = 'lcd_dbs';
$username = 'root';
$password = '123';

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    // Validate required fields
    if (!isset($input['name_person']) || empty(trim($input['name_person']))) {
        throw new Exception('Name is required');
    }
    
    $name_person = trim($input['name_person']);
    $process_role = isset($input['process_role']) ? trim($input['process_role']) : '';
    $cert = isset($input['cert']) ? json_encode($input['cert']) : '[]';
    $recert_date = isset($input['recert_date']) ? $input['recert_date'] : null;
    $latest_date = isset($input['latest_date']) ? $input['latest_date'] : null;
    
    // Check if operator exists
    $checkStmt = $pdo->prepare("SELECT id FROM person_dbs WHERE name_person = :name_person");
    $checkStmt->bindParam(':name_person', $name_person);
    $checkStmt->execute();
    
    if ($checkStmt->rowCount() === 0) {
        throw new Exception('Operator not found with name: ' . $name_person);
    }
    
    // Update operator certification
    $sql = "UPDATE person_dbs SET 
                process_role = :process_role,
                cert = :cert,
                recert_date = :recert_date,
                latest_date = :latest_date
            WHERE name_person = :name_person";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name_person', $name_person);
    $stmt->bindParam(':process_role', $process_role);
    $stmt->bindParam(':cert', $cert);
    $stmt->bindParam(':recert_date', $recert_date);
    $stmt->bindParam(':latest_date', $latest_date);
    
    if ($stmt->execute()) {
        $response = [
            'success' => true,
            'message' => 'Operator certification updated successfully',
            'data' => [
                'name_person' => $name,
                'process_role' => $role,
                'cert' => json_decode($certifications),
                'recert_date' => $lastCertDate,
                'latest_date' => $reCertDate
            ]
        ];
    } else {
        throw new Exception('Failed to update operator certification');
    }
    
} catch (PDOException $e) {
    $response = [
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ];
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];
}

echo json_encode($response);

// Log the operation (optional)
//error_log(date('Y-m-d H:i:s') . ' - Update Operator: ' . json_encode($response) . PHP_EOL, 3, 'operator_updates.log');
?>
