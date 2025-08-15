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

// Get raw POST data
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

// Validate JSON
if (!is_array($data)) {
    echo json_encode(["status" => "error", "message" => "Invalid JSON"]);
    exit;
}

// Fetch existing columns in lowercase
$existing_columns = [];
$result = $conn->query("SHOW COLUMNS FROM reportdata");
while ($row = $result->fetch_assoc()) {
    $existing_columns[] = strtolower($row['Field']);
}

// Auto-create missing columns based on JSON keys
foreach ($data as $key => $value) {
    $normalized = strtolower(str_replace(' ', '_', $key));
    if (!in_array($normalized, $existing_columns)) {
        $colType = "TEXT"; // Default column type, adjust if needed
        $alterSQL = "ALTER TABLE reportdata ADD COLUMN `$normalized` $colType";
        $conn->query($alterSQL);
        $existing_columns[] = $normalized; // Add to existing columns list
    }
}

// Filter valid columns from JSON
$columns = [];
$values = [];
$types = "";

foreach ($data as $key => $value) {
    $normalized = strtolower(str_replace(' ', '_', $key));
    if (in_array($normalized, $existing_columns)) {
        $columns[] = "`$normalized`";

        // Handle null and arrays/objects
        if ($value === '' || is_null($value)) {
            $values[] = null;
        } elseif (is_array($value) || is_object($value)) {
            $values[] = json_encode($value);
        } else {
            $values[] = $value;
        }

        $types .= 's';
    }
}

// If no valid columns found
if (empty($columns)) {
    echo json_encode(["status" => "error", "message" => "No valid columns to insert"]);
    exit;
}

// Build INSERT query
$placeholders = implode(',', array_fill(0, count($columns), '?'));
$sql = "INSERT INTO reportdata (" . implode(',', $columns) . ") VALUES ($placeholders)";

// Prepare and execute
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    echo json_encode(["status" => "error", "message" => "Prepare failed: " . $conn->error]);
    exit;
}

$stmt->bind_param($types, ...$values);
if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Record inserted successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Execute failed: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>