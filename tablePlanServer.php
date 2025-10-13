<?php
// Show all errors for debugging
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = "localhost";
$user = "root";
$pass = "123";
$db   = "lcd_dbs";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die(json_encode(["error" => $conn->connect_error]));
}

// Get action
$action = $_POST['action'] ?? '';

    function reorderIds($conn) {
        // Check existing IDs
        $result = $conn->query("SELECT id FROM details_product ORDER BY id ASC");
        $existing = [];
        while ($row = $result->fetch_assoc()) {
            $existing[] = (int)$row['id'];
        }

        // Find missing numbers and insert placeholder rows
        if (!empty($existing)) {
            $max = max($existing);
            for ($i = 1; $i <= $max; $i++) {
                if (!in_array($i, $existing)) {
                    $conn->query("INSERT INTO details_product (part_no, model, line) VALUES ('Missing $i', '', '')");
                }
            }
        }

        // Reorder the IDs
        $conn->query("SET @count = 0");
        $conn->query("UPDATE details_product SET id = @count := @count + 1 ORDER BY id");
        $conn->query("ALTER TABLE details_product AUTO_INCREMENT = 1");
    }


    if ($action === 'read') {
        // Ensure IDs start from 1 (auto fix)
        reorderIds($conn);

        $result = $conn->query("SELECT * FROM details_product ORDER BY id ASC");
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        echo json_encode($rows);
        exit;
    }

    if ($action === 'get_countPerHr') {
        $result = $conn->query("SELECT countPerHr FROM actualCountData");
        
        if (!$result) {
            die(json_encode(["error" => $conn->error]));
        }

        $values = [];
        while ($row = $result->fetch_assoc()) {
            $values[] = $row['countPerHr'];
        }

        echo json_encode($values);
        exit;
    }

    if ($action === 'get_by_plan_id_value') {
        // Get the latest plan_id from plan_id_value
        $stmt = $conn->prepare("SELECT id_value FROM plan_id_value WHERE id = 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            die(json_encode(["error" => "No plan found"]));
        }

        $id_value = $row['id_value'];

        // Fetch the corresponding row from details_product
        $stmt2 = $conn->prepare("SELECT * FROM details_product WHERE id = ?");
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



if ($action === 'update') {
    // Make sure id exists
    $id = $_POST['planId'] ?? null;
    if (!$id) {
        die(json_encode(["error" => "ID missing"]));
    }

    // Collect form data
    $part_no  = $_POST['part_no'] ?? '';
    $model    = $_POST['model'] ?? '';
    $line     = $_POST['line'] ?? '';
    $del_date = $_POST['delDate'];
    $ctasof   = $_POST['ctasof'] ;
    $expdate  = $_POST['expdate'];
    $manpower = $_POST['manpower'];
    $prodhrs  = $_POST['prodhrs'] ;
    $plan1    = $_POST['plan1'] ?? '';
    $plan2    = $_POST['plan2'] ?? '';
    $plan3    = $_POST['plan3'] ?? '';
    $plan4    = $_POST['plan4'] ?? '';
    $plan5    = $_POST['plan5'] ?? '';
    $plan6    = $_POST['plan6'] ?? '';
    $plan7    = $_POST['plan7'] ?? '';
    $plan8    = $_POST['plan8'] ?? '';
    $plan9    = $_POST['plan9'] ?? '';
    $plan10   = $_POST['plan10'] ?? '';
    $plan11   = $_POST['plan11'] ?? '';
    $plan12   = $_POST['plan12'] ?? '';
    $plan13   = $_POST['plan13'] ?? '';
    $plan14   = $_POST['plan14'] ?? '';

    // Prepare statement
    $stmt = $conn->prepare("UPDATE details_product
        SET part_no=?, model=?, line=?, del_date=?, ct_as_of=?, exp_date=?, man_power=?, prod_hrs=?,
            plan_1=?, plan_2=?, plan_3=?, plan_4=?, plan_5=?, plan_6=?, plan_7=?, plan_8=?, plan_9=?, plan_10=?, plan_11=?, plan_12=?, plan_13=?, plan_14=?
        WHERE id=?");

    // Bind parameters (22 strings + 1 integer)
    $stmt->bind_param(
        "ssssssssssssssssssssssi",
        $part_no, $model, $line, $del_date, $ctasof, $expdate, $manpower, $prodhrs,
        $plan1, $plan2, $plan3, $plan4, $plan5, $plan6, $plan7, $plan8, $plan9, $plan10,
        $plan11, $plan12, $plan13, $plan14, $id
    );

    if (!$stmt->execute()) {
        die(json_encode(["error" => $stmt->error]));
    }
    $stmt->execute();
    echo json_encode(["status" => "success"]);
    exit;
}

// ------------------ DELETE ------------------
if ($action === 'delete') {
    $id = $_POST['id'] ?? null;
    if (!$id) {
        die(json_encode(["error" => "ID missing"]));
    }

    $stmt = $conn->prepare("DELETE FROM details_product WHERE id=?");
    $stmt->bind_param("i", $id);

    if (!$stmt->execute()) {
        die(json_encode(["error" => $stmt->error]));
    }

    // Reorder the IDs
    $conn->query("SET @count = 0");
    $conn->query("UPDATE details_product SET id = @count:=@count+1 ORDER BY id");

    // Reset auto increment to match new max id
    $conn->query("ALTER TABLE details_product AUTO_INCREMENT = 1");

    echo json_encode(["status" => "deleted and reordered"]);
    exit;
}

if ($action === 'get_downtime_data') {
    $result = $conn->query("SELECT id, time_num FROM downtime_data ORDER BY id ASC");

    if (!$result) {
        die(json_encode(["error" => $conn->error]));
    }

    $rows = [];
    while ($row = $result->fetch_assoc()) {
        // Make sure time_num is an integer in the JSON output
        $row['time_num'] = (int)$row['time_num'];
        $row['id'] = (int)$row['id'];
        $rows[] = $row;
    }

    echo json_encode($rows);
    exit;
}


?>
