<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Sanitize and validate input
    $part_no = filter_input(INPUT_POST, 'part_no', FILTER_SANITIZE_STRING);
    $model = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_STRING);
    $line = filter_input(INPUT_POST, 'line', FILTER_SANITIZE_STRING);
    $del_date = filter_input(INPUT_POST, 'del_date', FILTER_SANITIZE_STRING);
    $balance = filter_input(INPUT_POST, 'balance', FILTER_VALIDATE_INT);
    $man_power = filter_input(INPUT_POST, 'man_power', FILTER_SANITIZE_STRING);
    $ct_as_of = filter_input(INPUT_POST, 'ct_as_of', FILTER_SANITIZE_STRING);
    $exp_date = filter_input(INPUT_POST, 'exp_date', FILTER_SANITIZE_STRING);
    $plans = [];
    for ($i = 1; $i <= 17; $i++) {
        $plans[] = filter_input(INPUT_POST, "plan$i", FILTER_SANITIZE_STRING);
    }

    try {
        require_once "connection_db.php";
        
        $query = "INSERT INTO details_product(part_no, model, line, del_date, balance, man_power, ct_as_of, exp_date, plan_1, plan_2, plan_3, plan_4, plan_5, plan_6, plan_7, plan_8, plan_9, plan_10, plan_11, plan_12, plan_13, plan_14, plan_15, plan_16, plan_17) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

        $stmt = $pdo->prepare($query);
        $stmt->execute(array_merge([$part_no, $model, $line, $del_date, $balance, $man_power, $ct_as_of, $exp_date], $plans));

        echo "Successfully inserted!";
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    } finally {
        $pdo = null; // Close connection
    }
}


