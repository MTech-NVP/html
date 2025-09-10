<?php
$host = "localhost";
$user = "root";
$pass = "123";
$dbname = "lcd_dbs";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'DB connection failed']));
}

// Get incoming data
$data = json_decode(file_get_contents('php://input'), true);
$counts = $data['counts'] ?? [];

// Debug: Log the incoming data
error_log("Incoming data: " . print_r($data, true));

// Update countPerHr if new values are passed
if (is_array($counts) && !empty($counts)) {
    $stmt = $conn->prepare("UPDATE actualCountData SET countPerHr = ? WHERE id = ?");
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
        exit;
    }

    $updateCount = 0;

    // Option 1: If counts is an associative array with explicit IDs
    // Send data like: {"counts": {"1": 10, "2": 15, "3": 20}}
    // foreach ($counts as $id => $countValue) {
    //     $id = intval($id);
    //     $count = intval($countValue);

    //     $stmt->bind_param("ii", $count, $id);
    //     if ($stmt->execute()) {
    //         $updateCount++;
    //         error_log("Updated ID $id with count $count, affected rows: " . $stmt->affected_rows);
    //     } else {
    //         error_log("Failed to update ID $id: " . $stmt->error);
    //     }
    // }

    //Option 2: If counts is a sequential array (uncomment if needed)
    foreach ($counts as $index => $countValue) {
        $id = $index + 1;
        $count = intval($countValue);

        // Verify the ID exists before updating
        $checkStmt = $conn->prepare("SELECT id FROM actualCountData WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            $stmt->bind_param("ii", $count, $id);
            if ($stmt->execute()) {
                $updateCount++;
                error_log("Updated ID $id with count $count, affected rows: " . $stmt->affected_rows);
            }
        } else {
            error_log("ID $id does not exist in database");
        }
        $checkStmt->close();
    }


    $stmt->close();
    error_log("Total updates attempted: " . count($counts) . ", successful: " . $updateCount);
}

// Fetch updated data
$sql = "SELECT id, plan_out_hr, total_out_hr, countPerHr FROM actualCountData ORDER BY id ASC";
$result = $conn->query($sql);

// Prepare update for achieve and cumulative
$updateStmt = $conn->prepare("UPDATE actualCountData SET achieved = ?, countTol = ? WHERE id = ?");
if (!$updateStmt) {
    echo json_encode(['success' => false, 'message' => 'Prepare update failed: ' . $conn->error]);
    exit;
}

$totalPlan = [];
$countPerHr = [];
$achieve = [];
$cumulative = [];
$planperhr = []; // Fixed: was undefined in original code

$runningTotal = 0;
$temp = 0;
$pauseMode = false;

while ($row = $result->fetch_assoc()) {
    $id = intval($row['id']);
    $plan = intval($row['total_out_hr']);
    $count = intval($row['countPerHr']);
    $planOutputHr = intval($row['plan_out_hr']);

    $totalPlan[] = $plan;
    $countPerHr[] = $count;
    $planperhr[] = $planOutputHr;

    // Pause condition: both zero
    if ($planOutputHr == 0 && $count == 0) {
        $temp = $runningTotal;
        $runningTotal = 0;
        $pauseMode = true;
    }
    // Resume condition: pauseMode true and count > 0
    elseif ($pauseMode && $count > 0) {
        $runningTotal = $temp + $count;
        $pauseMode = false;
    }
    // Reset condition: active plan but zero count
    elseif (!$pauseMode && $count == 0 && $planOutputHr > 0) {
        $runningTotal = 0;
        $temp = 0;
    }
    // Normal accumulation
    elseif (!$pauseMode) {
        $runningTotal += $count;
    }

    $cumulative[] = $runningTotal;
    $ach = $plan > 0 ? round(($runningTotal / $plan) * 100, 2) : 0;
    $achieve[] = $ach;

    $updateStmt->bind_param("dii", $ach, $runningTotal, $id);
    $updateStmt->execute();
}

$updateStmt->close();
$conn->close();

echo json_encode([
    'success' => true,
    'message' => 'Data updated and processed',
    'total_out_hr' => $totalPlan,
    'countPerHr' => $countPerHr,
    'achieved' => $achieve,
    'countTol' => $cumulative,
    'plan_out_hr' => $planperhr
]);
