<?php
$dsn = "mysql:host=localhost;dbname=lcd_dbs";
$dbusername = "root";
$dbpassword = "123";

try{
    $pdo = new PDO($dsn,$dbusername,$dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //echo "Successfully connected!";

}
catch(PDOException $e)
{
    echo "Connection failed !".$e->getMessage();
}
