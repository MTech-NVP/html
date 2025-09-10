<?php
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "lcd_dbs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle file upload
if (isset($_FILES['picture'])) {
    $image = $_FILES['picture']['tmp_name'];
    $imageName = $_POST['ope-pic'];
    $imgData = addslashes(file_get_contents($image));
    
    // INSERT query
    $sql = "INSERT INTO person_dbs (name_person, img_data) VALUES ('$imageName', '$imgData')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Image inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

?>


