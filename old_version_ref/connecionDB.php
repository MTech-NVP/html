<?php

$servername =  "localhost";
$username = "root";
$password = "123";
$dbname = "lcd_dbs";

$con = mysqli_connect($servername,$username,$password,$dbname) or die("Connection failed:".mysqli_connect_errro());

if(mysqli_connection_errno()){
	print("Connect failed : %s\n",mysqli_connect_error());
	exit();
}

echo "connected!";

