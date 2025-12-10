<?php
header('Content-Type: application/json');

$host = "localhost";
$user = "root";
$pass = "123";
$db   = "monitoring";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo json_encode([]);
    exit;
}
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

function isPlan
($conn) {
    $check = $conn->query("SELECT plan FROM PlanSelection LIMIT 1");

    if (!$check || $check->num_rows === 0) {
        return true; // Treat as inactive if no record
    }

    $row = $check->fetch_assoc();
    return ((int)$row['plan'] === 0);
}

// Check if action is set
    $action = $_POST['action'] ?? '';

    if ($action === 'fetch') {

        if (isPlan($conn)) {
            echo json_encode([]);
            exit;
        }
        
        // Check plan value first
        $planCheck = $conn->query("SELECT plan FROM PlanSelection LIMIT 1");
        $planRow = $planCheck->fetch_assoc();

        // If plan is NOT 0, continue fetching data
        $sql = "SELECT * FROM OutputTable ORDER BY id ASC LIMIT 14";
        $result = $conn->query($sql);

        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        echo json_encode($data);
    }


    if ($action === 'fetchPlanOutput') {

        // 1️⃣ Get the selected plan ID
        $sqlPlan = "SELECT plan FROM PlanSelection LIMIT 1";
        $resultPlan = $conn->query($sqlPlan);

        
        $planId = 0;
        if ($resultPlan && $resultPlan->num_rows > 0) {
            $rowPlan = $resultPlan->fetch_assoc();
            $planId = intval($rowPlan['plan']);
        }

        // Default data
        $data = [
            "partnumber"     => "-",
            "model"          => "-",
            "balance"        => "-",
            "manpower"       => "-",
            "prodhrs"        => "-",
            "deliverydate"   => "-",
            "cycletime"      => "-",
            "cycletimeasof"  => "-",
            "expirationdate" => "-"
        ];

        // 2️⃣ If we have a plan ID, fetch PlanOutput
        if ($planId > 0) {
            $sql = "SELECT partnumber, model, balance, manpower, prodhrs, deliverydate, cycletime, cycletimeasof, expirationdate 
                    FROM PlanOutput 
                    WHERE id = $planId
                    LIMIT 1";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $data = [
                    "partnumber"     => $row['partnumber'] ?: "-",
                    "model"          => $row['model'] ?: "-",
                    "balance"        => $row['balance'] ?: "0",
                    "manpower"       => $row['manpower'] ?: "-",
                    "prodhrs"        => $row['prodhrs'] ?: "-",
                    "deliverydate"   => $row['deliverydate'] ?: "-",
                    "cycletime"      => $row['cycletime'] ?: "-",
                    "cycletimeasof"  => $row['cycletimeasof'] ?: "-",
                    "expirationdate" => $row['expirationdate'] ?: "-"
                ];
            }
        }

        echo json_encode($data);
    }

    if ($action === 'updateSummary') {
        header('Content-Type: application/json');

        // 1️⃣ Get the selected plan ID
        $sqlPlan = "SELECT plan FROM PlanSelection LIMIT 1";
        $resultPlan = $conn->query($sqlPlan);
        $planId = 0;
        if ($resultPlan && $resultPlan->num_rows > 0) {
            $rowPlan = $resultPlan->fetch_assoc();
            $planId = intval($rowPlan['plan']);
        }

        // Default values
        $planProdHrs = 0;
        $planManpower = 0;
        $planOutput = 0;

        // 2️⃣ Fetch plan values and calculate total_plan_output if plan exists
        if ($planId > 0) {
            $sql = "SELECT prodhrs, manpower, cycletime, mins1, mins2, mins3, mins4, mins5, mins6, mins7, mins8, mins9, mins10, mins11, mins12, mins13, mins14
                    FROM PlanOutput
                    WHERE id = $planId
                    LIMIT 1";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $planProdHrs = intval($row['prodhrs']); // convert to integer
                $planManpower = intval($row['manpower']);

                $cycletime = floatval($row['cycletime']) ?: 1; // prevent division by zero
                $planOutput = 0;
                for ($i = 1; $i <= 14; $i++) {
                    $mins = intval($row["mins$i"]); // treat NULL as 0
                    $planOutput += intval(($mins * 60) / $cycletime); // integer division
                }
            }
        }

        // 3️⃣ Ensure a row with id = 1 exists
        $conn->query("
            INSERT INTO summary (id) 
            VALUES (1) 
            ON DUPLICATE KEY UPDATE id=id
        ");

        // 4️⃣ Update summary table: actual = plan for prodhrs & manpower only
        $updateSummary = $conn->prepare("
            UPDATE summary
            SET plan_prodhrs = ?, plan_manpower = ?, plan_output = ?, 
                actual_prodhrs = ?, actual_manpower = ?
            WHERE id = 1
        ");
        $updateSummary->bind_param(
            "diiii",
            $planProdHrs, $planManpower, $planOutput,
            $planProdHrs, $planManpower
        );
        $success = $updateSummary->execute();

        echo json_encode([
            "success" => $success,
            "plan_prodhrs" => $planProdHrs,
            "plan_manpower" => $planManpower,
            "plan_output" => $planOutput,
            "actual_prodhrs" => $planProdHrs,
            "actual_manpower" => $planManpower
        ]);
        exit;
    }

    if ($action === 'update_output_durations') {
        header('Content-Type: application/json');

        // Step 1: Reorder dt_details.id to remove gaps
        $conn->query("SET @seq := 0;");
        $conn->query("
            UPDATE dt_details
            SET id = (@seq := @seq + 1)
            ORDER BY id ASC
        ");

        // Step 2: Update OutputTable.dt_mins based on sum of durations from dt_details
        $sql = "
            UPDATE OutputTable o
            LEFT JOIN (
                SELECT dt_id, SEC_TO_TIME(SUM(TIME_TO_SEC(duration))) AS total_duration
                FROM dt_details
                WHERE DATE(time_occurred) = CURDATE()
                GROUP BY dt_id
            ) d ON o.id = d.dt_id
            SET o.dt_mins = IFNULL(d.total_duration, '00:00:00')
        ";

        if (!$conn->query($sql)) {
            echo json_encode([
                "success" => false,
                "error" => $conn->error
            ]);
            exit;
        }

        // Fetch the updated data
        $result = $conn->query("SELECT id, dt_mins FROM OutputTable ORDER BY id ASC");
        $updatedData = [];
        while ($row = $result->fetch_assoc()) {
            $updatedData[] = $row;
        }

        echo json_encode([
            "success" => true,
            "message" => "dt_details IDs compacted and OutputTable.dt_mins updated successfully.",
            "data" => $updatedData
        ]);
        exit;
    }

    if ($action === 'get_downtime_count') {
        $dt_id = $_POST['dt_id'] ?? null;
        if (!$dt_id) {
            echo json_encode(["count" => 0]);
            exit;
        }

        $stmt = $conn->prepare("SELECT COUNT(*) AS cnt FROM dt_details WHERE dt_id = ? AND DATE(time_occurred) = CURDATE()");
        $stmt->bind_param("i", $dt_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        echo json_encode(["count" => $result['cnt'] ?? 0]);
        exit;
    }

    if ($action === 'fetchPlanSummary') {

        if (isPlan($conn)) {
            echo json_encode([
                "prodhrs" => 0,
                "total_plan_output" => 0,
                "manpower" => 0
            ]);
            exit;
        }
        
        // 1️⃣ Get selected plan ID
        $sqlPlan = "SELECT plan FROM PlanSelection LIMIT 1";
        $resultPlan = $conn->query($sqlPlan);

        $planId = 0;
        if ($resultPlan && $resultPlan->num_rows > 0) {
            $rowPlan = $resultPlan->fetch_assoc();
            $planId = intval($rowPlan['plan']);
        }

        // Default values
        $manpower = "-";
        $prodhrs  = "-";
        $total_plan_output = "-";

        // 2️⃣ If we have a valid plan ID, fetch details from PlanOutput
        if ($planId > 0) {
            $sql = "SELECT manpower, prodhrs, cycletime, mins1, mins2, mins3, mins4, mins5, mins6, mins7, mins8, mins9, mins10, mins11, mins12, mins13, mins14
                    FROM PlanOutput
                    WHERE id = $planId
                    LIMIT 1";
            $result = $conn->query($sql);

            if ($result && $row = $result->fetch_assoc()) {
                $manpower = $row['manpower'] ?: "-";
                $prodhrs  = $row['prodhrs']  ?: "-";
                $cycletime = floatval($row['cycletime']) ?: 1; // prevent division by zero

                // 3️⃣ Calculate total_plan_output from mins1 to mins14
                $total_plan_output = 0;
                for ($i = 1; $i <= 14; $i++) {
                    $mins = intval($row["mins$i"]); // treat NULL as 0 automatically
                    $total_plan_output += intval(($mins * 60) / $cycletime); // integer division
                }
            }
        }

        // 4️⃣ Return JSON
        echo json_encode([
            "prodhrs"           => $prodhrs,
            "total_plan_output" => $total_plan_output,
            "manpower"          => $manpower
        ]);
    }
    
    if ($action === 'totalng') {
        $activeRows = isset($_POST['activeRows']) ? intval($_POST['activeRows']) : 14;

        if (isPlan($conn)) {
            echo json_encode([
                "breaktime" => "00:00",
                "totaldowntime" => "00:00:00",
                "good_qty" => 0,
                "total_ng" => 0
            ]);
            exit;
        }
        
        // 1️⃣ Get selected plan
        $sqlPlan = "SELECT plan FROM PlanSelection LIMIT 1";
        $planId = 0;
        $resultPlan = $conn->query($sqlPlan);
        if ($resultPlan && $rowPlan = $resultPlan->fetch_assoc()) {
            $planId = intval($rowPlan['plan']);
        }

        $breaktime = 0;
        $total_ng = 0;
        $good_qty = 0;

        if ($planId > 0) {
            $columns = [];
            for ($i = 1; $i < $activeRows; $i++) { // exclude last column
                $columns[] = "mins$i";
            }
            $colsStr = implode(",", $columns);

            $sqlMins = "SELECT $colsStr FROM PlanOutput WHERE id = $planId LIMIT 1";
            $resultMins = $conn->query($sqlMins);

            if ($resultMins && $rowMins = $resultMins->fetch_assoc()) {
                foreach ($columns as $col) {
                    $mins = intval($rowMins[$col]);
                    $breaktime += (60 - $mins); // remaining minutes per row
                }
            }

            $breakHours = floor($breaktime / 60);
            $breakMins  = $breaktime % 60;
            $breaktimeStr = sprintf("%02d:%02d", $breakHours, $breakMins);

            // 2️⃣ Get totals from OutputTable
            $sqlTotals = "SELECT 
                            SUM(ng_quantity) AS total_ng, 
                            SUM(actual_output) AS total_actual 
                        FROM OutputTable";
            $resultTotals = $conn->query($sqlTotals);

            if ($resultTotals && $rowTotals = $resultTotals->fetch_assoc()) {
                $total_ng     = intval($rowTotals['total_ng'] ?? 0);
                $total_actual = intval($rowTotals['total_actual'] ?? 0);
                $good_qty     = $total_actual - $total_ng;
            }
        } else {
            $breaktimeStr = "00:00";
        }

        // 3️⃣ Ensure summary row exists
        $conn->query("INSERT INTO summary (id) VALUES (1) ON DUPLICATE KEY UPDATE id=id");

        // 4️⃣ Update summary table
        $stmt = $conn->prepare("
            UPDATE summary
            SET breaktime = ?, 
                totaldowntime = SEC_TO_TIME((SELECT SUM(TIME_TO_SEC(dt_mins)) FROM OutputTable)),
                good_qty = ?, 
                total_ng = ?
            WHERE id = 1
        ");
        $stmt->bind_param("sii", $breaktimeStr, $good_qty, $total_ng);
        $stmt->execute();

        // 5️⃣ Fetch from summary and return
        $resultSummary = $conn->query("
            SELECT breaktime, totaldowntime, good_qty, total_ng 
            FROM summary 
            WHERE id = 1
        ");
        $rowSummary = $resultSummary->fetch_assoc();

        echo json_encode([
            "breaktime"     => $rowSummary['breaktime'],
            "totaldowntime" => $rowSummary['totaldowntime'],
            "good_qty"      => $rowSummary['good_qty'],
            "total_ng"      => $rowSummary['total_ng']
        ]);
        exit;
    }

    
    if ($action === 'fetchActualSummary') {
        header('Content-Type: application/json');

        if (isPlan($conn)) {
            echo json_encode([
                "actual_prodhrs" => 0,
                "total_actual_output" => 0,
                "actual_manpower" => 0
            ]);
            exit;
        }

        // 1️⃣ SUM of actual_output from OutputTable
        $sqlOutput = "SELECT SUM(actual_output) AS total_actual_output FROM OutputTable";
        $resultOutput = $conn->query($sqlOutput);

        $totalActualOutput = 0;
        if ($resultOutput && $rowOutput = $resultOutput->fetch_assoc()) {
            $totalActualOutput = intval($rowOutput['total_actual_output']); // integer
        }

        // 2️⃣ Update summary table with actual_output
        $updateSummary = $conn->prepare("
            UPDATE summary
            SET actual_output = ?
            WHERE id = 1
        ");
        $updateSummary->bind_param("i", $totalActualOutput);
        $updateSummary->execute();

        // 3️⃣ Fetch actual_prodhrs, actual_manpower, and actual_output from summary
        $sqlSummary = "SELECT actual_prodhrs, actual_manpower, actual_output 
                    FROM summary 
                    WHERE id = 1 
                    LIMIT 1";
        $resultSummary = $conn->query($sqlSummary);

        $actualProdHrs = 0;
        $actualManpower = 0;
        $actualOutput = 0;

        if ($resultSummary && $rowSummary = $resultSummary->fetch_assoc()) {
            $actualProdHrs = intval($rowSummary['actual_prodhrs']);
            $actualManpower = intval($rowSummary['actual_manpower']);
            $actualOutput = intval($rowSummary['actual_output']);
        }

        // 4️⃣ Return JSON
        echo json_encode([
            "actual_prodhrs"      => $actualProdHrs,
            "total_actual_output" => $actualOutput,
            "actual_manpower"     => $actualManpower
        ]);
    }

    if ($action === 'copyPlanMinutesToOutputTable') {

        if (isPlan($conn)) {
            echo json_encode(["status" => "no_plan_selected"]);
            exit;
        }
        
        // 1️⃣ Get selected plan ID
        $sqlPlan = "SELECT plan FROM PlanSelection LIMIT 1";
        $resultPlan = $conn->query($sqlPlan);

        $planId = 0;
        if ($resultPlan && $resultPlan->num_rows > 0) {
            $rowPlan = $resultPlan->fetch_assoc();
            $planId = intval($rowPlan['plan']);
        }

        // If no valid plan found, return
        if ($planId <= 0) {
            echo json_encode(["status" => "no_plan_selected"]);
            return;
        }

        // 2️⃣ Fetch mins1..mins14 + cycletime from selected PlanOutput row
        $sql = "SELECT mins1, mins2, mins3, mins4, mins5, mins6, mins7,
                    mins8, mins9, mins10, mins11, mins12, mins13, mins14,
                    cycletime
                FROM PlanOutput
                WHERE id = $planId
                LIMIT 1";

        $result = $conn->query($sql);

        if ($result && $row = $result->fetch_assoc()) {

            $ctValue = $row['cycletime'];

            // ------------------------------------
            // Loop through 14 rows and update data
            // ------------------------------------
            for ($i = 1; $i <= 14; $i++) {

                $col = "mins" . $i;
                $minsValue = $row[$col];

                // Update mins
                $update = $conn->prepare("UPDATE OutputTable SET mins = ? WHERE id = ?");
                $update->bind_param("si", $minsValue, $i);
                $update->execute();
                $update->close();

                // Compute plan_output = mins * 60 / cycletime
                $planOutput = ($ctValue > 0) ? ($minsValue * 60) / $ctValue : 0;

                // Update plan_output
                $updatePlan = $conn->prepare("UPDATE OutputTable SET plan_output = ? WHERE id = ?");
                $updatePlan->bind_param("di", $planOutput, $i);
                $updatePlan->execute();
                $updatePlan->close();
            }

            // ------------------------------------
            // Update CT field for all 14 rows
            // ------------------------------------
            $updateCT = $conn->prepare("UPDATE OutputTable SET ct = ?");
            $updateCT->bind_param("s", $ctValue);
            $updateCT->execute();
            $updateCT->close();

            echo json_encode(["status" => "success"]);

        } else {
            echo json_encode(["status" => "no_data"]);
        }
    }

    if ($action === 'fetchTotals') {

        if (isPlan($conn)) {
            echo json_encode(["percentage" => 0]);
            exit;
        }

        // 1️⃣ Get totals
        $sql = "SELECT 
                    SUM(plan_output) AS total_plan, 
                    SUM(actual_output) AS total_actual 
                FROM OutputTable";
        
        $result = $conn->query($sql);

        $totalPlan = 0;
        $totalActual = 0;

        if ($result && $row = $result->fetch_assoc()) {
            $totalPlan   = intval($row['total_plan'] ?? 0);
            $totalActual = intval($row['total_actual'] ?? 0);
        }

        // 2️⃣ Compute percentage (INT)
        $percentage = 0;
        if ($totalPlan > 0) {
            $percentage = round(($totalActual / $totalPlan) * 100);
        }

        // 3️⃣ Store to summary table
        $stmt = $conn->prepare("
            UPDATE summary 
            SET percentage = ? 
            WHERE id = 1
        ");
        $stmt->bind_param("i", $percentage);
        $stmt->execute();
        $stmt->close();

        // 4️⃣ Return only what JS needs
        echo json_encode([
            "percentage" => $percentage
        ]);
        exit;
    }


    if (isset($_POST['id']) && isset($_POST['percentage'])) {

        $id = (int)$_POST['id'];
        $percent = (float)$_POST['percentage'];

        if ($id > 0) {
            $stmt = $conn->prepare("UPDATE OutputTable SET percentage = ? WHERE id = ?");
            $stmt->bind_param("di", $percent, $id);

            if ($stmt->execute()) {
         /*       echo json_encode([
                    "status" => "success",
                    "id" => $id,
                    "percent" => $percent
                ]);*/
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => $stmt->error
                ]);
            }

            $stmt->close();
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Invalid ID"
            ]);
        }

    }

    if ($action === 'updateTotal') {
        $id = intval($_POST['id'] ?? 0);
        $total = floatval($_POST['total'] ?? 0);

        if ($id > 0) {
            $stmt = $conn->prepare("UPDATE OutputTable SET total = ? WHERE id = ?");
            $stmt->bind_param("di", $total, $id);
            $success = $stmt->execute();
            $stmt->close();

            echo json_encode(['success' => $success]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid ID']);
        }
    }

    if ($action === 'updateRemarksRow') {
        $id = intval($_POST['id'] ?? 0);
        $remarks = $_POST['remarks'] ?? '';

        if ($id > 0) {
            $stmt = $conn->prepare("UPDATE OutputTable SET remarks = ? WHERE id = ?");
            $stmt->bind_param("si", $remarks, $id);
            $stmt->execute();
            $stmt->close();

            echo json_encode([
                "status" => "success",
                "id" => $id,
                "remarks" => $remarks
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Invalid ID"
            ]);
        }

        exit;
    }

    $action = $_POST['action'] ?? $_GET['action'] ?? '';


    if ($action === 'fetchLineLeader') {

        $planId = 0;
        $leaderId = 0;

        // 1️⃣ Get selected plan ID
        $sqlPlan = "SELECT plan FROM PlanSelection LIMIT 1";
        $resultPlan = $conn->query($sqlPlan);
        if ($resultPlan && $resultPlan->num_rows > 0) {
            $rowPlan = $resultPlan->fetch_assoc();
            $planId = intval($rowPlan['plan']);
        }

        // 2️⃣ Get lineleader ID from PlanOutput
        if ($planId > 0) {
            $sqlOutput = "SELECT lineleader FROM PlanOutput WHERE id = $planId LIMIT 1";
            $resultOutput = $conn->query($sqlOutput);
            if ($resultOutput && $resultOutput->num_rows > 0) {
                $rowOutput = $resultOutput->fetch_assoc();
                $leaderId = intval($rowOutput['lineleader']);
            }
        }

        // 3️⃣ Fetch main leader data (names & title)
        $finalData = null;
        if ($leaderId > 0) {
            $sql = "SELECT fn, mn, ln, title, picture FROM line_leader_list WHERE id = $leaderId LIMIT 1";
            $result = $conn->query($sql);
            if ($result && $row = $result->fetch_assoc()) {
                $finalData = $row;
            }
        }

        if (!$finalData) {
            echo json_encode(["error" => "LEADER NOT FOUND"]);
            exit;
        }

        // 4️⃣ Picture with fallback to ID 1
        $finalPicture = $finalData['picture'] ?? null;

        if (empty($finalPicture)) {
            $sqlFallback = "SELECT picture FROM line_leader_list WHERE id = 1 LIMIT 1";
            $resultFallback = $conn->query($sqlFallback);
            if ($resultFallback && $rowFallback = $resultFallback->fetch_assoc() && !empty($rowFallback['picture'])) {
                $finalPicture = $rowFallback['picture'];
            }
        }

        // 5️⃣ Return JSON for names and title
        $response = [
            "fn" => $finalData['fn'],
            "mn" => $finalData['mn'],
            "ln" => $finalData['ln'],
            "title" => $finalData['title']
        ];

        header("Content-Type: application/json");
        echo json_encode($response);
        exit;
    }

    if ($action === 'fetchLineLeaderPicture') {

        $planId = 0;
        $leaderId = 0;

        // Get selected plan ID
        $sqlPlan = "SELECT plan FROM PlanSelection LIMIT 1";
        $resultPlan = $conn->query($sqlPlan);
        if ($resultPlan && $resultPlan->num_rows > 0) {
            $rowPlan = $resultPlan->fetch_assoc();
            $planId = intval($rowPlan['plan']);
        }

        // Get lineleader ID from PlanOutput
        if ($planId > 0) {
            $sqlOutput = "SELECT lineleader FROM PlanOutput WHERE id = $planId LIMIT 1";
            $resultOutput = $conn->query($sqlOutput);
            if ($resultOutput && $resultOutput->num_rows > 0) {
                $rowOutput = $resultOutput->fetch_assoc();
                $leaderId = intval($rowOutput['lineleader']);
            }
        }

        // Fetch leader picture
        $finalPicture = null;
        if ($leaderId > 0) {
            $sql = "SELECT picture FROM line_leader_list WHERE id = $leaderId LIMIT 1";
            $result = $conn->query($sql);

            if ($result && $row = $result->fetch_assoc()) {
                if (!empty($row['picture'])) {
                    $finalPicture = $row['picture'];
                }
            }
        }

        // Fallback to ID 1
        if (empty($finalPicture)) {
            $sql2 = "SELECT picture FROM line_leader_list WHERE id = 0 LIMIT 1";
            $result2 = $conn->query($sql2);

            if ($result2 && $row2 = $result2->fetch_assoc()) {
                $finalPicture = $row2['picture'];
            }
        }

        if (empty($finalPicture)) {
            header("Content-Type: text/plain");
            echo "NO IMAGE";
            exit;
        }

        // Output raw image
        header("Content-Type: image/*");
        echo $finalPicture;
        exit;
    }

    if ($action === 'fetchProdStaff') {

        $planId = 0;
        $manpowerCount = 0;

        if (isPlan($conn)) {
            echo json_encode([]);
            exit;
        }
        
        // 1️⃣ Get selected plan ID
        $sqlPlan = "SELECT plan FROM PlanSelection LIMIT 1";
        $resultPlan = $conn->query($sqlPlan);
        if ($resultPlan && $resultPlan->num_rows > 0) {
            $rowPlan = $resultPlan->fetch_assoc();
            $planId = intval($rowPlan['plan']);
        }

        if ($planId <= 0) {
            echo json_encode(["error" => "No plan selected"]);
            exit;
        }

        // 2️⃣ Get manpower count and IDs from PlanOutput
        $sqlOutput = "SELECT manpower, manpower1, manpower2, manpower3 FROM PlanOutput WHERE id = $planId LIMIT 1";
        $resultOutput = $conn->query($sqlOutput);

        if (!$resultOutput || $resultOutput->num_rows == 0) {
            echo json_encode([]);
            exit;
        }

        $rowOutput = $resultOutput->fetch_assoc();
        $manpowerCount = intval($rowOutput['manpower']);
        if ($manpowerCount < 1) {
            echo json_encode([]);
            exit;
        }

        // Build staff IDs array based on manpowerCount
        $staffIds = [];
        for ($i = 1; $i <= $manpowerCount; $i++) {
            $col = "manpower$i";
            if (!empty($rowOutput[$col])) {
                $staffIds[] = intval($rowOutput[$col]);
            }
        }

        $staffList = [];

        foreach ($staffIds as $id) {
            $sqlStaff = "SELECT id, fn, mn, ln, title FROM prod_staff_list WHERE id = $id LIMIT 1";
            $resultStaff = $conn->query($sqlStaff);
            if ($resultStaff && $rowStaff = $resultStaff->fetch_assoc()) {
                $staffList[] = [
                    "id" => $rowStaff['id'],   // for picture URL
                    "fn" => $rowStaff['fn'],
                    "mn" => $rowStaff['mn'],
                    "ln" => $rowStaff['ln'],
                    "title" => $rowStaff['title']
                ];
            }
        }

        header("Content-Type: application/json");
        echo json_encode($staffList);
        exit;
    }

    if ($action === 'fetchProdStaffPicture') {

        // Get staff ID from query param or POST
        $staffId = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($staffId <= 0) {
            header("Content-Type: text/plain");
            echo "NO IMAGE";
            exit;
        }

        $finalPicture = null;

        // 1️⃣ Try to get the staff picture
        $sql = "SELECT picture FROM prod_staff_list WHERE id = $staffId LIMIT 1";
        $result = $conn->query($sql);
        if ($result && $row = $result->fetch_assoc()) {
            if (!empty($row['picture'])) {
                $finalPicture = $row['picture'];
            }
        }

        // 2️⃣ Fallback to ID 1 picture
        if (empty($finalPicture)) {
            $sqlFallback = "SELECT picture FROM prod_staff_list WHERE id = 0 LIMIT 1";
            $resultFallback = $conn->query($sqlFallback);
            if ($resultFallback && $rowFallback = $resultFallback->fetch_assoc()) {
                $finalPicture = $rowFallback['picture'];
            }
        }

        // 3️⃣ Output
        if (empty($finalPicture)) {
            header("Content-Type: text/plain");
            echo "NO IMAGE";
            exit;
        }

        header("Content-Type: image/*");
        echo $finalPicture;
        exit;
    }

    if ($action === 'fetchManpowerCount') {

        // 1️⃣ Get selected plan ID (same method as fetchPlanSummary)
        $sqlPlan = "SELECT plan FROM PlanSelection LIMIT 1";
        $resultPlan = $conn->query($sqlPlan);

        $planId = 0;
        if ($resultPlan && $resultPlan->num_rows > 0) {
            $rowPlan = $resultPlan->fetch_assoc();
            $planId = intval($rowPlan['plan']);
        }

        $manpower = 0;

        // 2️⃣ Fetch manpower from selected PlanOutput
        if ($planId > 0) {
            $sql = "SELECT manpower FROM PlanOutput WHERE id = $planId LIMIT 1";
            $result = $conn->query($sql);

            if ($result && $row = $result->fetch_assoc()) {
                $manpower = intval($row['manpower']);
            }
        }

        echo json_encode(["manpower" => $manpower]);
        exit;
    }

    if ($action === 'fetch_outputs') {

        if (!isset($_POST['activeRows'])) {
            echo json_encode([]);
            exit;
        }

        $activeRows = intval($_POST['activeRows']);

        // Safety cap to max 14 (6:00–20:00)
        if ($activeRows > 14) {
            $activeRows = 14;
        }

        $stmt = $conn->prepare("
            SELECT actual_output 
            FROM OutputTable
            LIMIT ?
        ");

        $stmt->bind_param("i", $activeRows);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode($data);
        exit;
    }

    if ($action === 'update_outputs') {
        $data = json_decode($_POST['data'] ?? '{}', true);

        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'No data received']);
            exit;
        }

        // --- Fetch all rows from OutputTable in order ---
        $stmt = $conn->prepare("SELECT id FROM OutputTable ORDER BY id ASC LIMIT ?");
        $activeRows = count($data);
        $stmt->bind_param("i", $activeRows);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        if (!$rows) {
            echo json_encode(['success' => false, 'message' => 'No rows found']);
            exit;
        }

        // --- Loop through rows and update actual_output ---
        foreach ($rows as $index => $row) {
            $inputId = $index + 1; // map 1 → activeRows
            $value = isset($data[$inputId]) ? $data[$inputId] : null;
            if ($value !== null) {
                $stmtUpdate = $conn->prepare("UPDATE OutputTable SET actual_output = ? WHERE id = ?");
                $stmtUpdate->bind_param("ii", $value, $row['id']);
                $stmtUpdate->execute();
            }
        }

        echo json_encode(['success' => true]);
    }

$conn->close();
?>
