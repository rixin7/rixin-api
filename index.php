<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

error_reporting(0);

// Replace with your actual InfinityFree MySQL Database details
$host = "sqlXXX.infinityfree.com"; // Your InfinityFree MySQL Hostname
$user = "if0_XXXXXXX";             // Your InfinityFree MySQL Username
$pass = "YOUR_DB_PASSWORD";        // Your InfinityFree MySQL Password
$dbname = "if0_XXXXXXX_db";        // Your InfinityFree Database Name

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database Connection Failed"]);
    exit();
}

// Accept key parameter from GET or POST
$key = $_REQUEST['key'] ?? $_REQUEST['access_key'] ?? $_REQUEST['token'] ?? '';

if (empty($key)) {
    echo json_encode(["status" => "error", "message" => "Please enter an Access Key."]);
    exit();
}

// Query Database for Key
$stmt = $conn->prepare("SELECT * FROM generated_keys WHERE key_value = ?");
$stmt->bind_param("s", $key);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["status" => "error", "message" => "Invalid Access Key!"]);
    exit();
}

$keyData = $result->fetch_assoc();

// Expiration Check
if (!empty($keyData['expires_at']) && time() > strtotime($keyData['expires_at'])) {
    echo json_encode(["status" => "error", "message" => "Key has expired!"]);
    exit();
}

// Success Response
echo json_encode([
    "status" => "success",
    "message" => "Login Successful!",
    "key" => $keyData['key_value'],
    "expires_at" => $keyData['expires_at'] ?? "Lifetime"
]);

exit();
?>
