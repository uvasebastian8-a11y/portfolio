<?php
require_once 'config.php';

$tables = ['customers', 'purchases', 'reviews', 'admins'];
$results = [];

foreach ($tables as $table) {
    $check_sql = "SHOW TABLES LIKE '$table'";
    $result = $conn->query($check_sql);
    $results[$table] = $result->num_rows > 0;
}

sendResponse(true, 'Database connection successful!', [
    'tables' => $results,
    'message' => 'All systems ready!'
]);
?>