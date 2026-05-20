<?php
// Database configuration
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'jumpman23_db';

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die(json_encode([
        'success' => false, 
        'message' => 'Database connection failed: ' . $conn->connect_error
    ]));
}

$conn->set_charset("utf8mb4");

function sendResponse($success, $message, $data = null) {
    $response = ['success' => $success, 'message' => $message];
    if ($data !== null) {
        $response['data'] = $data;
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>