<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/var/log/php_errors.log');

// -----------------------------
// Database connection
// -----------------------------
$host = "localhost";
$user = "root";
$pass = "123";
$db   = "monitoring";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo json_encode(["success" => false, "error" => "DB connection failed"]);
    exit;
}

// -----------------------------
// Get action from GET or POST
// -----------------------------
$action = $_GET['action'] ?? $_POST['action'] ?? null;

/* ====================================
   GET ALL LINE LEADERS
==================================== */
if ($action === 'get_leaders') {
    $sql = "SELECT id, fn, mn, ln, title FROM line_leader_list WHERE id >= 1 ORDER BY id ASC";
    $result = $conn->query($sql);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
    exit;
}

/* ====================================
   GET SINGLE LEADER BY ID
==================================== */

if ($action === 'get_leader_by_id') {
    header('Content-Type: application/json; charset=utf-8');

    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($id <= 0) {
        echo json_encode(["success" => false, "error" => "Invalid ID"]);
        exit;
    }

    $stmt = $conn->prepare("
        SELECT id, fn, mn, ln, title
        FROM line_leader_list
        WHERE id = ?
        LIMIT 1
    ");

    if (!$stmt) {
        echo json_encode(["success" => false, "error" => "Prepare failed: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("i", $id);

    if (!$stmt->execute()) {
        echo json_encode(["success" => false, "error" => "Execute failed: " . $stmt->error]);
        exit;
    }

    $result = $stmt->get_result();

    if ($result === false) {
        echo json_encode(["success" => false, "error" => "Get result failed: " . $stmt->error]);
        exit;
    }

    $row = $result->fetch_assoc();

    if ($row) {
        echo json_encode(["success" => true, "data" => $row]);
    } else {
        echo json_encode(["success" => false, "error" => "Leader not found"]);
    }

    exit;
}

if ($action === 'get_leader_picture') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id <= 0) {
        http_response_code(400);
        exit("Invalid ID");
    }

    $stmt = $conn->prepare("SELECT picture FROM line_leader_list WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($picture);
    $stmt->fetch();

    if ($picture) {
        // Serve as raw BLOB
        header("Content-Type: image/jpeg"); // or image/png if PNG
        echo $picture;
    } else {
        http_response_code(404);
        exit("No image found");
    }
}
/* ====================================
   UPDATE LEADER (INCLUDING IMAGE)
==================================== */
if ($action === 'update_leader') {
    $id    = intval($_POST['id'] ?? 0);
    $fn    = $_POST['fn'] ?? '';
    $mn    = $_POST['mn'] ?? '';
    $ln    = $_POST['ln'] ?? '';
    $title = $_POST['title'] ?? '';

    if ($id <= 0) {
        echo json_encode(["success" => false, "error" => "Invalid ID"]);
        exit;
    }

    // -----------------------------
    // 1️⃣ Update only the text fields
    // -----------------------------
    $stmt = $conn->prepare("
        UPDATE line_leader_list
        SET fn=?, mn=?, ln=?, title=?
        WHERE id=?
    ");
    $stmt->bind_param("ssssi", $fn, $mn, $ln, $title, $id);
    $stmt->execute();
    $stmt->close();

    // -----------------------------
    // 2️⃣ Handle picture separately
    // -----------------------------
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === 0) {
        $imgDir  = "/var/www/html/DOM/media/img/staffs/leader/";
        $imgName = "leader_{$id}.jpg";
        $imgPath = $imgDir . $imgName;

        if (!file_exists($imgDir)) mkdir($imgDir, 0777, true);

        if (!move_uploaded_file($_FILES['picture']['tmp_name'], $imgPath)) {
            echo json_encode(["success" => false, "error" => "Failed to save uploaded file. Check permissions."]);
            exit;
        }

        // Update the picture column using LOAD_FILE
        $stmt2 = $conn->prepare("
            UPDATE line_leader_list
            SET picture = LOAD_FILE(?)
            WHERE id = ?
        ");
        $stmt2->bind_param("si", $imgPath, $id);
        $stmt2->execute();
        $stmt2->close();
    }

    echo json_encode(["success" => true]);
    exit;
}


if ($action === 'get_prod_staffs') {
    $sql = "
        SELECT id, fn, mn, ln, title, lcdate, rcdate
        FROM prod_staff_list
        WHERE id >= 1
        ORDER BY id ASC
    ";

    $result = $conn->query($sql);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
    exit;
}

if ($action === 'get_prod_staff_by_id') {
    header('Content-Type: application/json; charset=utf-8');

    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($id <= 0) {
        echo json_encode(["success" => false, "error" => "Invalid ID"]);
        exit;
    }

    $stmt = $conn->prepare("
        SELECT id, fn, mn, ln, title, lcdate, rcdate
        FROM prod_staff_list
        WHERE id = ?
        LIMIT 1
    ");

    if (!$stmt) {
        echo json_encode(["success" => false, "error" => "Prepare failed: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("i", $id);

    if (!$stmt->execute()) {
        echo json_encode(["success" => false, "error" => "Execute failed: " . $stmt->error]);
        exit;
    }

    $result = $stmt->get_result();

    if ($result === false) {
        echo json_encode(["success" => false, "error" => "Get result failed: " . $stmt->error]);
        exit;
    }

    $row = $result->fetch_assoc();

    if ($row) {
        echo json_encode(["success" => true, "data" => $row]);
    } else {
        echo json_encode(["success" => false, "error" => "Production staff not found"]);
    }

    exit;
}

if ($action === 'get_prod_staff_picture') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($id <= 0) {
        http_response_code(400);
        exit("Invalid ID");
    }

    $stmt = $conn->prepare("
        SELECT picture
        FROM prod_staff_list
        WHERE id = ?
        LIMIT 1
    ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($picture);
    $stmt->fetch();

    if ($picture) {
        header("Content-Type: image/jpeg");
        echo $picture;
    } else {
        http_response_code(404);
        exit("No image found");
    }

    exit;
}
/* ====================================
   UPDATE PROD STAFF (INCLUDING IMAGE)
==================================== */
if ($action === 'update_prod_staff') {
    $id     = intval($_POST['id'] ?? 0);
    $fn     = $_POST['fn'] ?? '';
    $mn     = $_POST['mn'] ?? '';
    $ln     = $_POST['ln'] ?? '';
    $lcdate = $_POST['lcdate'] ?? null;
    $rcdate = $_POST['rcdate'] ?? null;

    if ($id <= 0) {
        echo json_encode(["success" => false, "error" => "Invalid ID"]);
        exit;
    }

    // -----------------------------
    // 1️⃣ Update text fields
    // -----------------------------
    $stmt = $conn->prepare("
        UPDATE prod_staff_list
        SET fn=?, mn=?, ln=?, lcdate=?, rcdate=?
        WHERE id=?
    ");
    $stmt->bind_param("sssssi", $fn, $mn, $ln, $lcdate, $rcdate, $id);
    $stmt->execute();
    $stmt->close();

    // -----------------------------
    // 2️⃣ Handle picture upload
    // -----------------------------
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === 0) {
        $imgDir  = "/var/www/html/DOM/media/img/staffs/prod/";
        $imgName = "staff_{$id}.jpg";
        $imgPath = $imgDir . $imgName;

        if (!file_exists($imgDir)) {
            mkdir($imgDir, 0777, true);
        }

        if (!move_uploaded_file($_FILES['picture']['tmp_name'], $imgPath)) {
            echo json_encode([
                "success" => false,
                "error" => "Failed to save uploaded file. Check permissions."
            ]);
            exit;
        }

        // Store image into BLOB column
        $stmt2 = $conn->prepare("
            UPDATE prod_staff_list
            SET picture = LOAD_FILE(?)
            WHERE id = ?
        ");
        $stmt2->bind_param("si", $imgPath, $id);
        $stmt2->execute();
        $stmt2->close();
    }

    echo json_encode(["success" => true]);
    exit;
}

if ($action === 'get_prod_staff_picture') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($id <= 0) {
        http_response_code(400);
        exit("Invalid ID");
    }

    $stmt = $conn->prepare("
        SELECT picture
        FROM prod_staff_list
        WHERE id = ?
        LIMIT 1
    ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($picture);
    $stmt->fetch();

    if ($picture) {
        header("Content-Type: image/jpeg");
        echo $picture;
    } else {
        http_response_code(404);
        exit("No image found");
    }

    exit;
}
/* ====================================
   UPDATE PROD STAFF (INCLUDING IMAGE)
==================================== */
/* ====================================
   UPDATE PROD STAFF (INCLUDING IMAGE)
==================================== */
if ($action === 'update_prod_staff') {
    $id     = intval($_POST['id'] ?? 0);
    $fn     = $_POST['fn'] ?? '';
    $mn     = $_POST['mn'] ?? '';
    $ln     = $_POST['ln'] ?? '';
    $title  = $_POST['title'] ?? '';
    $lcdate = $_POST['lcdate'] ?? null;
    $rcdate = $_POST['rcdate'] ?? null;

    if ($id <= 0) {
        echo json_encode(["success" => false, "error" => "Invalid ID"]);
        exit;
    }

    // -----------------------------
    // 1️⃣ Update text fields
    // -----------------------------
    $stmt = $conn->prepare("
        UPDATE prod_staff_list
        SET fn=?, mn=?, ln=?, title=?, lcdate=?, rcdate=?
        WHERE id=?
    ");
    $stmt->bind_param("ssssssi", $fn, $mn, $ln, $title, $lcdate, $rcdate, $id);
    $stmt->execute();
    $stmt->close();

    // -----------------------------
    // 2️⃣ Handle picture upload
    // -----------------------------
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === 0) {
        $imgDir  = "/var/www/html/DOM/media/img/staffs/prod/";
        $imgName = "staff_{$id}.jpg";
        $imgPath = $imgDir . $imgName;

        if (!file_exists($imgDir)) {
            mkdir($imgDir, 0777, true);
        }

        if (!move_uploaded_file($_FILES['picture']['tmp_name'], $imgPath)) {
            echo json_encode([
                "success" => false,
                "error" => "Failed to save uploaded file. Check permissions."
            ]);
            exit;
        }

        // Store image into BLOB column
        $stmt2 = $conn->prepare("
            UPDATE prod_staff_list
            SET picture = LOAD_FILE(?)
            WHERE id = ?
        ");
        $stmt2->bind_param("si", $imgPath, $id);
        $stmt2->execute();
        $stmt2->close();
    }

    echo json_encode(["success" => true]);
    exit;
}

/* ====================================
   UNKNOWN ACTION
==================================== */
echo json_encode(["success" => false, "error" => "Unknown action"]);
exit;

$conn->close();
?>
