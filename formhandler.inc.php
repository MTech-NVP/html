<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect inputs
    $id = $_POST['id']; 
    $part_no = $_POST['part_no'];
    $model = $_POST['model'];
    $line = $_POST['line'];
    $del_date = $_POST['del_date'];
    $balance = $_POST['balance'];
    $man_power = $_POST['man_power'];
    $ct_as_of = $_POST['ct_as_of'];
    $exp_date = $_POST['exp_date'];
    $prod_hrs = $_POST['prod_hrs'];
    
    $plans = [];
    for ($i = 1; $i <= 14; $i++) {
        $plans[] = $_POST["plan$i"] ?? null;
    }

    // Generate current timestamp
    $date_created = date("Y-m-d H:i:s");

    try {
        require_once "connection_db2.php";

        $query = "INSERT INTO details_product 
            (id, part_no, model, line, del_date, balance, man_power, ct_as_of, exp_date, prod_hrs, 
             plan_1, plan_2, plan_3, plan_4, plan_5, plan_6, plan_7, plan_8, plan_9, plan_10, plan_11, plan_12, plan_13, plan_14, date_created)
            VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($query);
        $stmt->execute(array_merge(
            [$id, $part_no, $model, $line, $del_date, $balance, $man_power, $ct_as_of, $exp_date, $prod_hrs], 
            $plans,
            [$date_created]
        ));

        echo "Successfully inserted!";
        header("Location: planner.php");
        exit;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    } finally {
        $pdo = null;
    }
}
?>
