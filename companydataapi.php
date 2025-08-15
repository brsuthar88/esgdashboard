<?php
// --------------------
// Security Headers
// --------------------
header("Content-Type: application/json; charset=UTF-8");
header("X-Content-Type-Options: nosniff");          // Prevent MIME sniffing
header("X-Frame-Options: DENY");                    // Prevent iframe embedding
header("X-XSS-Protection: 1; mode=block");          // Basic XSS protection
header("Referrer-Policy: no-referrer");             // Hide referrer info
header("Permissions-Policy: geolocation=(), microphone=()"); // Disable unused browser features
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload"); // Force HTTPS

header("Access-Control-Allow-Origin: *"); // Replace with your real Wix site domain
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");


// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// --------------------
// Database connection
// --------------------
$host     = "localhost";
$username = "vyanainf_partner1user";
$password = "H3q^zDE6wUMj";
$dbname   = "vyanainf_partner1"; // Change to your DB name

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit;
}

// --------------------
// Read JSON input
// --------------------
$data = json_decode(file_get_contents("php://input"), true);
$requiredFields = [ 'company_name', 'email','address', 'status', 'created_at', 'updated_at'
];

foreach ($requiredFields as $field) {
    if (!isset($data[$field])) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Missing field: $field"]);
        exit;
    }
}

// --------------------
// Insert Data Securely
// --------------------
$stmt = $conn->prepare("
    INSERT INTO company 
    (company_name, email, address, status, created_at, updated_at) 
    VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "ssssss",
    $data['company_name'],
    $data['email'],
    $data['address'],
    $data['status'],
    $data['created_at'],
    $data['updated_at']
);

if ($stmt->execute()) {
    http_response_code(201);
    echo json_encode(["status" => "success", "message" => "Company inserted successfully"]);
} else {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Insert failed: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>