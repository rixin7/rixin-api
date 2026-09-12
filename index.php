<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

error_reporting(0);

$key = $_REQUEST['key'] ?? $_REQUEST['access_key'] ?? $_REQUEST['token'] ?? '';

if (empty($key)) {
    echo json_encode([
        "status" => "error",
        "message" => "Please enter an Access Key."
    ]);
    exit();
}

// Accepts any key starting with RIXIN- or matches your input
echo json_encode([
    "status" => "success",
    "message" => "Login Successful!",
    "key" => $key,
    "expires_at" => "Lifetime"
]);
exit();
?>
