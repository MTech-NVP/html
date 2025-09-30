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

// Update countPerHr if new values are passed
if (is_array($counts) && !empty($counts)) {
    $stmt = $conn->prepare("UPDATE actualCountData SET countPerHr = ? WHERE id = ?");
    foreach ($counts as $index => $countValue) {
        $id = $index + 1;
        $count = intval($countValue);
        $stmt->bind_param("ii", $count, $id);
        $stmt->execute();
    }
    $stmt->close();
}

// Fetch updated data
$sql = "SELECT id, plan_out_hr, total_out_hr, countPerHr FROM actualCountData ORDER BY id ASC";
$result = $conn->query($sql);

// Prepare update for achieve and cumulative
$updateStmt = $conn->prepare("UPDATE actualCountData SET achieved = ?, countTol = ? WHERE id = ?");

$totalPlan   = [];
$countPerHr  = [];
$achieve     = [];
$cumulative  = [];
$planperhr   = [];

$runningTotal = 0;

while ($row = $result->fetch_assoc()) {
    $id           = intval($row['id']);
    $plan         = intval($row['total_out_hr']);
    $count        = intval($row['countPerHr']);
    $planOutputHr = intval($row['plan_out_hr']);

    $totalPlan[]  = $plan;
    $countPerHr[] = $count;
    $planperhr[]  = $planOutputHr;

    // --- Force reset if count is zero ---
    if ($planOutputHr > 0 && $count == 0) {
        $runningTotal = 0; // reset accumulation
        $ach = 0;
    } else {
        if ($count > 0) {
            $runningTotal += $count;
        }
        $ach = $plan > 0 ? round(($runningTotal / $plan) * 100, 2) : 0;
    }

    $cumulative[] = $runningTotal;
    $achieve[] = $ach;

    $updateStmt->bind_param("dii", $ach, $runningTotal, $id);
    $updateStmt->execute();
}

$updateStmt->close();
$conn->close();

echo json_encode([
    'success'       => true,
    'message'       => 'Data updated and processed',
    'total_out_hr'  => $totalPlan,
    'countPerHr'    => $countPerHr,
    'achieved'      => $achieve,
    'countTol'      => $cumulative,
    'plan_out_hr'   => $planperhr
]);
?>
