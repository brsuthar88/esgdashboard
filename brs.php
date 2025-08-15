<?php  // Setup the Zoho OAuth URL for token refresh
      

// Zoho OAuth Token Endpoint
$url = "https://accounts.zoho.com/oauth/v2/token";

// Zoho Credentials
$refresh_token = "1000.d5c0e5549447d6d98434e70de5f6d539.756ce8c30162a22f1801db3776e75776";
$client_id     = "1000.DJ6XD92RNF06EG7B4VPUUXWSRT7HOH";
$client_secret = "0a10a36fe3221ea5a022e1c04225cbabb5e7163311";

// Setup POST fields
$data = http_build_query([
    'refresh_token' => $refresh_token,
    'client_id'     => $client_id,
    'client_secret' => $client_secret,
    'grant_type'    => 'refresh_token',
]);

// Initialize cURL
$ch = curl_init($url);

// cURL Options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// Execute the request
$response = curl_exec($ch);

// Error handling
if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
    exit;
}

// Close cURL
curl_close($ch);

// Parse response
$responseData = json_decode($response, true);

// Output access token
if (isset($responseData['access_token'])) {
   $accessToken=$responseData['access_token'];
    
    $custometype=5475320000000236877; //pricebook_id
    $organization_id=859918730;
    $finaldata = [];

    // Zoho API URL
    $url = "https://www.zohoapis.com/books/v3/pricebooks/{$custometype}?organization_id={$organization_id}";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Zoho-oauthtoken {$accessToken}",
    "Content-Type: application/json"
]);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);


    //print_r($data);
    
   $url = "https://books.zoho.com/api/v3/warehouses?organization_id={$organization_id}";

$headers = [
    "Authorization: Zoho-oauthtoken {$access_token}"
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

if (isset($data['warehouses'])) {
    foreach ($data['warehouses'] as $warehouse) {
        echo "Warehouse: " . $warehouse['warehouse_name'] . " | ID: " . $warehouse['warehouse_id'] . "\n";
    }
} else {
    print_r($data); // print error if any
} 
    
} else {
    echo "Error getting access token:\n";
    print_r($responseData);
}

    ?>
    