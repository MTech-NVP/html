<?php
// Show all errors for debugging
ob_clean();
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = "localhost";
$user = "root";
$pass = "123";
$db   = "monitoring";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die(json_encode(["error" => $conn->connect_error]));
}


// Get action
$action = $_REQUEST['action'] ?? '';

    function updateAllPlanOutputFromCT($conn) {
        $sqlGet = "SELECT ctime, ctao, ed FROM ct ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sqlGet);

        if (!$result || $result->num_rows === 0) {
            return ["error" => "No data found in ct table"];
        }

        $row = $result->fetch_assoc();
        $ctime = (float)$row['ctime'];
        $asof  = $row['ctao'];
        $ed    = $row['ed'];

        $sqlUpdate = "UPDATE PlanOutput SET cycletime = ?, cycletimeasof = ?, expirationdate = ?";
        $stmt = $conn->prepare($sqlUpdate);
        if (!$stmt) return ["error" => "Prepare failed: " . $conn->error];

        $stmt->bind_param("dss", $ctime, $asof, $ed);

        if ($stmt->execute()) {
            return [
                "success" => true,
                "cycletime" => $ctime,
                "cycletimeasof" => $asof,
                "expirationdate" => $ed,
                "message" => "All rows updated"
            ];
        } else {
            return ["error" => "Update failed: " . $stmt->error];
        }
    }

    if ($action === 'updatePlanOutputLive') {
        echo json_encode(updateAllPlanOutputFromCT($conn));
        exit;
    }
    function reorderIds($conn) {
        // Check existing IDs
        $result = $conn->query("SELECT id FROM PlanOutput ORDER BY id ASC");
        $existing = [];
        while ($row = $result->fetch_assoc()) {
            $existing[] = (int)$row['id'];
        }

        // Find missing numbers and insert placeholder rows
        if (!empty($existing)) {
            $max = max($existing);
            for ($i = 1; $i <= $max; $i++) {
                if (!in_array($i, $existing)) {
                    $conn->query("INSERT INTO PlanOutput (partnumber, model, cycletime) VALUES ('Missing $i', '', '')");
                }
            }
        }

        // Reorder the IDs
        $conn->query("SET @count = 0");
        $conn->query("UPDATE PlanOutput SET id = @count := @count + 1 ORDER BY id");
        $conn->query("ALTER TABLE PlanOutput AUTO_INCREMENT = 1");
    }


    if ($action === 'read') {
        // Ensure IDs start from 1 (auto fix)
        reorderIds($conn);

        $result = $conn->query("SELECT * FROM PlanOutput ORDER BY id ASC");
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        echo json_encode($rows);
        exit;
    }

    if ($action === 'get_countPerHr') {
        $result = $conn->query("SELECT actual_output FROM OutputTable");
        
        if (!$result) {
            die(json_encode(["error" => $conn->error]));
        }

        $values = [];
        while ($row = $result->fetch_assoc()) {
            $values[] = $row['actual_output'];
        }

        echo json_encode($values);
        exit;
    }

    if ($action === 'get_by_plan_id_value') {
        // Get the latest plan_id from plan_id_value
        $stmt = $conn->prepare("SELECT plan FROM PlanSelection LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            die(json_encode(["error" => "No plan found"]));
        }

        $id_value = $row['plan'];

        // Fetch the corresponding row from details_product
        $stmt2 = $conn->prepare("SELECT partnumber, model, balance, manpower, prodhrs, deliverydate, cycletime, cycletimeasof, expirationdate FROM PlanOutput WHERE id = ?");
        $stmt2->bind_param("i", $id_value);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $product_row = $result2->fetch_assoc();

        if (!$product_row) {
            die(json_encode(["error" => "No details_product found for id_value $id_value"]));
        }

        echo json_encode($product_row);
        exit;
    }

    if ($action === 'fetchPlanOutput') {
        header('Content-Type: application/json');

        // Fetch first 14 rows from plan_output column
        $stmt = $conn->prepare("SELECT plan_output FROM OutputTable ORDER BY id ASC LIMIT 14");
        $stmt->execute();
        $result = $stmt->get_result();

        $outputs = [];
        while ($row = $result->fetch_assoc()) {
            $outputs[] = $row['plan_output'];
        }

        echo json_encode($outputs);
        exit;
    }

    if ($action === 'update') {
        // Make sure id exists
        $id = $_POST['planId'] ?? null;
        if (!$id) {
            die(json_encode(["error" => "ID missing"]));
        }

        // Collect form data
        $part_no  = $_POST['partnumber'] ?? '';
        $model    = $_POST['model'] ?? '';
        $del_date = date('Y-m-d', strtotime($_POST['deliverydate']));
        $manpower = $_POST['manpower'];
        $prodhrs  = $_POST['prodhrs'] ;
        $plan1    = $_POST['mins1'] ?? '';
        $plan2    = $_POST['mins2'] ?? '';
        $plan3    = $_POST['mins3'] ?? '';
        $plan4    = $_POST['mins4'] ?? '';
        $plan5    = $_POST['mins5'] ?? '';
        $plan6    = $_POST['mins6'] ?? '';
        $plan7    = $_POST['mins7'] ?? '';
        $plan8    = $_POST['mins8'] ?? '';
        $plan9    = $_POST['mins9'] ?? '';
        $plan10   = $_POST['mins10'] ?? '';
        $plan11   = $_POST['mins11'] ?? '';
        $plan12   = $_POST['mins12'] ?? '';
        $plan13   = $_POST['mins13'] ?? '';
        $plan14   = $_POST['mins14'] ?? '';
 
        // Prepare statement
        $stmt = $conn->prepare("UPDATE PlanOutput
            SET partnumber=?, model=?, deliverydate=?, manpower=?, prodhrs=?,
                mins1=?, mins2=?, mins3=?, mins4=?, mins5=?, mins6=?, mins7=?, mins8=?, mins9=?, mins10=?, mins11=?, mins12=?, mins13=?, mins14=?
            WHERE id=?");

        // Bind parameters (22 strings + 1 integer)
        $stmt->bind_param(
            "sssidiiiiiiiiiiiiiii",
            $part_no, $model, $del_date, $manpower, $prodhrs,
            $plan1, $plan2, $plan3, $plan4, $plan5, $plan6, $plan7, $plan8, $plan9, $plan10,
            $plan11, $plan12, $plan13, $plan14, $id
        );
        if (!$del_date) {
            die(json_encode(["error" => "Invalid date format"]));
        }
        if (!$stmt->execute()) {
            die(json_encode(["error" => $stmt->error]));
        }

        echo json_encode(["status" => "success"]);
        exit;

    }

    // ------------------ DELETE ------------------
    if ($action === 'delete') {
        
        $id = $_POST['id'] ?? null;
        if (!$id) {
            die(json_encode(["error" => "ID missing"]));
        }

        $stmt = $conn->prepare("DELETE FROM PlanOutput WHERE id=?");
        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            die(json_encode(["error" => $stmt->error]));
        }

        // Reorder the IDs
        $conn->query("SET @count = 0");
        $conn->query("UPDATE PlanOutput SET id = @count:=@count+1 ORDER BY id");

        // Reset auto increment to match new max id
        $conn->query("ALTER TABLE PlanOutput AUTO_INCREMENT = 1");

        echo json_encode(["status" => "deleted and reordered"]);
        exit;
    }

    if ($action === 'get_downtime_data') {

        $rows = [];

        for ($i = 1; $i <= 14; $i++) {

            $stmt = $conn->prepare("SELECT COALESCE(COUNT(*), 0) AS total_count
                FROM dt_details
                WHERE dt_id = ? AND DATE(time_occurred) = CURDATE()
            ");
            $stmt->bind_param("i", $i);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();

            $rows[] = [
                "dt_id" => $i,
                "time_num" => (int)$result['total_count'] // number of records per dt_id
            ];
        }

        echo json_encode($rows);
        exit;
    }



    if ($action === 'get_downtime_total') {

        $stmt = $conn->prepare("
            SELECT COUNT(dt_id) AS total_count
            FROM dt_details
            WHERE dt_id BETWEEN 1 AND 14
            AND DATE(time_occurred) = CURDATE()
        ");

        $stmt->execute();
        $stmt->bind_result($total_count);
        $stmt->fetch();

        echo json_encode([
            "success" => true,
            "total_time" => (int)$total_count
        ]);
        exit;
    }


    if ($action === 'get_downtime_duration') {
        $rows = [];

        for ($i = 1; $i <= 14; $i++) {

            $stmt = $conn->prepare("
                SELECT 
                    COALESCE(SEC_TO_TIME(SUM(TIME_TO_SEC(duration))), '00:00:00') AS total_duration
                FROM dt_details
                WHERE dt_id = ? AND DATE(time_occurred) = CURDATE()
            ");
            $stmt->bind_param("i", $i);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();

            $rows[] = [
                "time_Elapse" => $result['total_duration']  // <-- use a descriptive key
            ];
        }

        echo json_encode($rows);
        exit;
    }

    $action = $_POST['action'] ?? $_GET['action'] ?? '';

    if ($action === 'ctfetch') {
        // Fetch the latest row
        $sql = "SELECT ctime, ctao, ed FROM ct ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            echo json_encode($result->fetch_assoc());
        } else {
            echo json_encode(["ctime" => "", "ctao" => "", "ed" => ""]);
        }

    } elseif ($action === 'ctupdate') {
        // Update the latest row or insert if none exists
        $ctime = $_POST['ctime'] ?? null;
        $ctao  = $_POST['ctao'] ?? null;
        $ed    = $_POST['ed'] ?? null;

        $check = $conn->query("SELECT id FROM ct ORDER BY id DESC LIMIT 1");
        if ($check && $check->num_rows > 0) {
            $row = $check->fetch_assoc();
            $stmt = $conn->prepare("UPDATE ct SET ctime=?, ctao=?, ed=? WHERE id=?");
            $stmt->bind_param("sssi", $ctime, $ctao, $ed, $row['id']);
        } else {
            $stmt = $conn->prepare("INSERT INTO ct (ctime, ctao, ed) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $ctime, $ctao, $ed);
        }

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["error" => $stmt->error]);
        }

    } else {
        echo json_encode(["error" => "Invalid action"]);
    }

?>
