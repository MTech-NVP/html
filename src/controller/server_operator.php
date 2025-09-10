<?php
// Database connection
$host = 'localhost';
$dbname = 'lcd_dbs';
$username = 'root';
$password = '123';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Fetch images (assuming you have id, name, and image stored as LONGBLOB)
$query = "SELECT id, name, image_path FROM operator_image_dbs";  // Assuming `image_path` is the LONGBLOB column
$stmt = $conn->prepare($query);
$stmt->execute();
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);

$imageData = [];

foreach ($images as $image) {
    // Convert the blob to base64
    $base64Image = base64_encode($image['image_path']);
    $imageData[] = [
        'id' => $image['id'],
        'name' => $image['name'],
        'image_data' => 'data:image/jpeg;base64,' . $base64Image // Assuming JPEG, adjust if needed
    ];
}

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($imageData);
?>
