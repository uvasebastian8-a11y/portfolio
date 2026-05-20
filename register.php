<?php
require_once 'config.php';

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    sendResponse(false, 'Invalid input data');
}

$required_fields = ['first_name', 'last_name', 'email', 'phone', 'gender', 'username', 'password'];
foreach ($required_fields as $field) {
    if (empty($input[$field])) {
        sendResponse(false, "Field '$field' is required");
    }
}

$first_name = $conn->real_escape_string($input['first_name']);
$last_name = $conn->real_escape_string($input['last_name']);
$email = $conn->real_escape_string($input['email']);
$phone = $conn->real_escape_string($input['phone']);
$gender = $conn->real_escape_string($input['gender']);
$username = $conn->real_escape_string($input['username']);
$hashed_password = password_hash($input['password'], PASSWORD_DEFAULT);

// Check if user exists
$check_sql = "SELECT id FROM customers WHERE username = ? OR email = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("ss", $username, $email);
$check_stmt->execute();
if ($check_stmt->get_result()->num_rows > 0) {
    sendResponse(false, 'Username or email already exists');
}
$check_stmt->close();

// Insert user
$sql = "INSERT INTO customers (first_name, last_name, email, phone, gender, username, password, registration_date) 
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $first_name, $last_name, $email, $phone, $gender, $username, $hashed_password);

if ($stmt->execute()) {
    sendResponse(true, 'Registration successful', ['username' => $username]);
} else {
    sendResponse(false, 'Registration failed: ' . $stmt->error);
}
$stmt->close();
$conn->close();
?>