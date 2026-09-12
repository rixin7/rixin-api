<?php
error_reporting(0);
ini_set('display_errors', '0');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json; charset=UTF-8");

// Capture key from any parameter name
$key = $_REQUEST['key'] 
    ?? $_REQUEST['access_key'] 
    ?? $_REQUEST['user_key'] 
    ?? $_REQUEST['pass'] 
    ?? $_REQUEST['token'] 
    ?? $_REQUEST['license']
    ?? '';

// Output clean JSON only
echo json_encode([
    "status"      => "success",
    "result"      => "success",
    "code"        => 200,
    "success"     => true,
    "valid"       => true,
    "message"     => "Login Successful!",
    "msg"         => "Login Successful!",
    "key"         => $key,
    "access_key"  => $key,
    "expires_at"  => "2030-12-31",
    "expiry"      => "2030-12-31"
]);
exit();
?>
