<?php
// Check if audio file exists
if (!isset($_FILES['audio']) || $_FILES['audio']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo "No valid audio file uploaded.";
    exit;
}

// Set upload directory
$uploadDir = __DIR__ . '/uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Sanitize and move file
$filename = basename($_FILES['audio']['name']);
$targetPath = $uploadDir . time() . '-' . preg_replace("/[^a-zA-Z0-9._-]/", "_", $filename);
move_uploaded_file($_FILES['audio']['tmp_name'], $targetPath);

// Log name/email if available
$name = isset($_POST['name']) ? strip_tags($_POST['name']) : 'anonymous';
$email = isset($_POST['email']) ? strip_tags($_POST['email']) : 'anonymous';
file_put_contents($uploadDir . 'log.txt', date('Y-m-d H:i:s') . " - $name <$email>\nFile: $targetPath\n\n", FILE_APPEND);

http_response_code(200);
echo "Upload successful.";
