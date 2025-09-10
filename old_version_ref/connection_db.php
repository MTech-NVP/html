<?php
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "lcd_dbs";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
//echo "connected!"

?>
