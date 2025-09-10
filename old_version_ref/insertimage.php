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
if (isset($_FILES['signatures']) && $_FILES['signatures']['error'] == UPLOAD_ERR_OK) {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO person_incharge (name_incharge, picture_incharge) VALUES (?, ?)");
    $stmt->bind_param("sb", $nameSign, $imgData);

    $image = $_FILES['signatures']['tmp_name'];
    $nameSign = $_POST['sign'];
    $imgData = file_get_contents($image);
    
    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Image uploaded successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error uploading file.";
}

$conn->close();
?>

<form method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="text" name="sign" placeholder="Type name" required>
    <input type="file" name="signatures" id="signatures" required>
    <input type="submit" value="Upload Image" name="submit">
</form>
