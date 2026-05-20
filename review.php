<?php
require_once 'config.php';

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    sendResponse(false, 'Invalid review data');
}

$required_fields = ['review_id', 'user_id', 'username', 'product_id', 'product_name', 'rating', 'review_title', 'review_text'];
foreach ($required_fields as $field) {
    if (empty($input[$field])) {
        sendResponse(false, "Field '$field' is required");
    }
}

$review_id = $conn->real_escape_string($input['review_id']);
$user_id = $conn->real_escape_string($input['user_id']);
$username = $conn->real_escape_string($input['username']);
$product_id = $conn->real_escape_string($input['product_id']);
$product_name = $conn->real_escape_string($input['product_name']);
$rating = intval($input['rating']);
$review_title = $conn->real_escape_string($input['review_title']);
$review_text = $conn->real_escape_string($input['review_text']);

if ($rating < 1 || $rating > 5) {
    sendResponse(false, 'Rating must be between 1 and 5');
}

// Check for duplicate review ID
$check_sql = "SELECT id FROM reviews WHERE review_id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("s", $review_id);
$check_stmt->execute();
if ($check_stmt->get_result()->num_rows > 0) {
    sendResponse(false, 'Review ID already exists');
}
$check_stmt->close();

$sql = "INSERT INTO reviews (
    review_id, user_id, username, product_id, product_name, 
    rating, review_title, review_text, review_date, status
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), 'approved')";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssisss", $review_id, $user_id, $username, $product_id, $product_name, $rating, $review_title, $review_text);

if ($stmt->execute()) {
    sendResponse(true, 'Review submitted successfully!', ['review_id' => $review_id]);
} else {
    sendResponse(false, 'Failed to save review: ' . $stmt->error);
}
$stmt->close();
$conn->close();
?>