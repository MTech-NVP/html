<?php
header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');
//header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

ini_set('log_errors', 1);
ini_set('error_log', '/path/to/php-error.log');

$host = "localhost";
$user = "root";
$pass = "123";
$dbname = "lcd_dbs";

try {
    $conn = new mysqli($host, $user, $pass, $dbname);
    
    if ($conn->connect_error) {
        throw new Exception('Database connection failed: ' . $conn->connect_error);
    }
    
    $conn->set_charset("utf8");
    
    $sql = "SELECT id, process,details,time_Elapse,Act,Pics,remark,time_num FROM downtime_data ORDER BY id ASC";
    $result = $conn->query($sql);
    
    if (!$result) {
        throw new Exception('Query failed: ' . $conn->error);
    }
    
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = [
            'id'         => (int) $row['id'],
            'process'     => (string) $row['process'],
            'details'      => (string) $row['details'],
            'time_Elapse'   => (string) $row['time_Elapse'],
            'Action'   => (string) $row['Act'],
            'Pics'   => (string) $row['Pics'],
            'remark'   => (string) $row['remark'],
            
        ];
    }
    
    $response = [
        'success' => true,
        'message' => 'Data updated and processed',
        'lines'   => $rows
    ];
    
    echo json_encode($response);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage(),
        'lines'   => []
    ]);
} finally {
    if (isset($conn)) {
        $conn->close();
    }
}
?>
