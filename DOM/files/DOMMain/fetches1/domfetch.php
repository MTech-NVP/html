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

// Check if action is set
    $action = $_POST['action'] ?? '';
    if ($action === 'fetch') {
        $sql = "SELECT * FROM OutputTable ORDER BY id ASC LIMIT 14";
        $result = $conn->query($sql);

        $data = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
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
                    "balance"        => $row['balance'] ?: "-",
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


    if ($action === 'fetchPlanSummary') {

        // 1️⃣ Get selected plan ID
        $sqlPlan = "SELECT plan FROM PlanSelection LIMIT 1";
        $resultPlan = $conn->query($sqlPlan);

        $planId = 0;
        if ($resultPlan && $resultPlan->num_rows > 0) {
            $rowPlan = $resultPlan->fetch_assoc();
            $planId = intval($rowPlan['plan']);
        }

        // 2️⃣ SUM of plan_output from OutputTable
        $sql1 = "SELECT SUM(plan_output) AS total_plan_output FROM OutputTable";
        $result1 = $conn->query($sql1);
        $sumOutput = "-";

        if ($result1 && $row1 = $result1->fetch_assoc()) {
            $sumOutput = $row1['total_plan_output'] ?: "-";
        }

        // Default values
        $manpower = "-";
        $prodhrs  = "-";

        // 3️⃣ If we have a valid plan ID, fetch details from PlanOutput
        if ($planId > 0) {
            $sql2 = "SELECT manpower, prodhrs 
                    FROM PlanOutput 
                    WHERE id = $planId
                    LIMIT 1";
            $result2 = $conn->query($sql2);

            if ($result2 && $row2 = $result2->fetch_assoc()) {
                $manpower = $row2['manpower'] ?: "-";
                $prodhrs  = $row2['prodhrs']  ?: "-";
            }
        }

        // 4️⃣ Return JSON
        echo json_encode([
            "prodhrs"            => $prodhrs,
            "total_plan_output"  => $sumOutput,
            "manpower"           => $manpower
        ]);
    }

    
    if ($action === 'totalng') {

        // 1️⃣ TOTAL NG
        $sql1 = "SELECT SUM(ng_quantity) AS total_ng FROM OutputTable";
        $result1 = $conn->query($sql1);
        $total_ng = $result1->fetch_assoc()['total_ng'] ?? 0;

        // 2️⃣ GOOD QUANTITY (sum of actual_output)
        $sql2 = "SELECT SUM(actual_output) AS total_good FROM OutputTable";
        $result2 = $conn->query($sql2);
        $total_good = $result2->fetch_assoc()['total_good'] ?? 0;

        // 3️⃣ TOTAL DOWNTIME (sum of dt_mins – in `HH:MM` format)
        $sql3 = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(dt_mins))) AS total_downtime FROM OutputTable";
        $result3 = $conn->query($sql3);
        $total_downtime = $result3->fetch_assoc()['total_downtime'] ?? "00:00";

        // Return as JSON
        echo json_encode([
            "total_ng"       => $total_ng,
            "total_good"     => $total_good,
            "total_downtime" => $total_downtime
        ]);
        exit;
    }

    
    if ($action === 'fetchActualSummary') {

        // 1️⃣ Get selected plan ID from PlanSelection
        $sqlPlan = "SELECT plan FROM PlanSelection LIMIT 1";
        $resultPlan = $conn->query($sqlPlan);

        $planId = 0;
        if ($resultPlan && $resultPlan->num_rows > 0) {
            $rowPlan = $resultPlan->fetch_assoc();
            $planId = intval($rowPlan['plan']);
        }

        // 2️⃣ SUM of actual_output from OutputTable
        $sql1 = "SELECT SUM(actual_output) AS total_actual_output FROM OutputTable";
        $result1 = $conn->query($sql1);
        $sumOutput = "-";

        if ($result1 && $row1 = $result1->fetch_assoc()) {
            $sumOutput = $row1['total_actual_output'] ?: "-";
        }

        // Default values
        $manpower = "-";
        $prodhrs  = "-";

        // 3️⃣ If valid plan ID, load manpower & prodhrs from PlanOutput
        if ($planId > 0) {
            $sql2 = "SELECT manpower, prodhrs
                    FROM PlanOutput
                    WHERE id = $planId
                    LIMIT 1";
            $result2 = $conn->query($sql2);

            if ($result2 && $row2 = $result2->fetch_assoc()) {
                $manpower = $row2['manpower'] ?: "-";
                $prodhrs  = $row2['prodhrs']  ?: "-";
            }
        }

        // 4️⃣ Return JSON
        echo json_encode([
            "actual_prodhrs"       => $prodhrs,
            "total_actual_output"  => $sumOutput,
            "actual_manpower"      => $manpower
        ]);
    }

    if ($action === 'copyPlanMinutesToOutputTable') {

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
        $sql = "SELECT plan_output, actual_output FROM OutputTable";
        $result = $conn->query($sql);

        $totals = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $totals[] = $row;
            }
        }

        echo json_encode($totals);
    }

    if (isset($_POST['id']) && isset($_POST['percentage'])) {

        $id = (int)$_POST['id'];
        $percent = (float)$_POST['percentage'];

        if ($id > 0) {
            $stmt = $conn->prepare("UPDATE OutputTable SET percentage = ? WHERE id = ?");
            $stmt->bind_param("di", $percent, $id);

            if ($stmt->execute()) {
                echo json_encode([
                    "status" => "success",
                    "id" => $id,
                    "percent" => $percent
                ]);
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
            $sql2 = "SELECT picture FROM line_leader_list WHERE id = 1 LIMIT 1";
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
            $sqlFallback = "SELECT picture FROM prod_staff_list WHERE id = 1 LIMIT 1";
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




$conn->close();
?>
