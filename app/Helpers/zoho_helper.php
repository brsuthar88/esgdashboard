<?php
use CodeIgniter\HTTP\CURLRequest;
if (!function_exists('zoho_authenticate')) {
    function zoho_authenticate($clientId, $clientSecret, $refreshToken)
    {
        // Setup the Zoho OAuth URL for token refresh
        $url = "https://accounts.zoho.com/oauth/v2/token";
        $client = \Config\Services::curlrequest();

        // Refresh token parameters
        $response = $client->request('POST', $url, [
            'form_params' => [
                'refresh_token' => $refreshToken,
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'grant_type' => 'refresh_token'
            ]
        ]);


        $responseData = json_decode($response->getBody(), true);
        return $responseData['access_token'] ?? null;
    }
}

/*if (!function_exists('zoho_get_records_old')) {
    function zoho_get_records_old($accessToken, $organization_id,$custometype,$clientId, $clientSecret, $refreshTokenbook)
    {
$urlitem=array();
            // Set up the Zoho API URL for retrieving records
            $url = "https://www.zohoapis.com/inventory/v1/pricebooks?organization_id={$organization_id}";
            $client = \Config\Services::curlrequest();

            // API call to get records
             $responseq = $client->request('GET', $url, [
                'headers' => [
                'Authorization' => "Zoho-oauthtoken {$accessToken}"
                ]
            ]);

            $response = json_decode($responseq->getBody(), true);
            if($response['message'] == "success")
            {
                foreach($response['pricebooks'] as $datacat)
                {
                    if($datacat['name'] == $custometype)
                    {
                            $urln = "https://www.zohoapis.com/inventory/v1/pricebooks/".$datacat['pricebook_id']."?organization_id={$organization_id}";
                            $clientn = \Config\Services::curlrequest();
                
                            // API call to get records
                             $responsen = $clientn->request('GET', $urln, [
                                'headers' => [
                                'Authorization' => "Zoho-oauthtoken {$accessToken}"
                                ]
                            ]);
                
                            $responsen1 = json_decode($responsen->getBody(), true);
                            if($responsen1['message'] == "success")
                            {
                                $priceunit= $responsen1['pricebook']['currency_code'];
                                
                                $i=0;
                                foreach($responsen1['pricebook']['pricebook_items'] as $data)
                                {
                                    echo '<pre>';
                                   print_r($data);
                                   echo $i;
                                     // Setup the Zoho OAuth URL for token refresh
                                    $url2 = "https://accounts.zoho.com/oauth/v2/token";
                                    $client2 = \Config\Services::curlrequest();
                            
                                    // Refresh token parameters
                                    $response2 = $client2->request('POST', $url2, [
                                        'form_params' => [
                                            'refresh_token' => $refreshTokenbook,
                                            'client_id' => $clientId,
                                            'client_secret' => $clientSecret,
                                            'grant_type' => 'refresh_token'
                                        ]
                                    ]);
                            
                            
                                    $responseData2 = json_decode($response2->getBody(), true);
                                    if($responseData2['access_token'])
                                    {
                                        // $urlitem[] = "https://www.zohoapis.com/books/v3/items/".$data['item_id']."?organization_id=".$organization_id;
                                        /*$clientitem = \Config\Services::curlrequest();
                        
                                        // API call to get records
                                         $responseitem = $clientitem->request('GET', $urlitem, [
                                            'headers' => [
                                            'Authorization' => "Zoho-oauthtoken ".$responseData2['access_token']
                                            ]
                                        ]);
                        
                                             $responsenitem[] = json_decode($responseitem->getBody(), true);*/
                                          
                                          
                                   /* }
                                    else
                                    {
                                      return "Authorise faild";  
                                    }
                                     
                                      $i++;
                                }
                            
                            }
                            else
                            {
                                return "Customer Categories Related Items Not Available.";
                            }
                    }
                    else
                    {
                         return "Customer Categories Not Available";
                    }
                    
                }
               
            }
            else
            {
                return "Customer Categories Not Available";
            }
          
    }
        
}*/

if (!function_exists('zoho_get_inventory_price_type')) {
    function zoho_get_inventory_price_type($accessToken, $organization_id, $custometype)
    {  
        $finaldata = [];

        // API URL
        //$urln = "https://www.zohoapis.com/inventory/v1/pricebooks/{$custometype}?organization_id={$organization_id}";
        $urln = "https://www.zohoapis.com/books/v3/pricebooks/{$custometype}?organization_id={$organization_id}";


        // Initialize CodeIgniter's cURL service
        $clientn = \Config\Services::curlrequest();

        try {
            // API request
            $responsen = $clientn->request('GET', $urln, [
                'headers' => [
                    'Authorization' => "Zoho-oauthtoken {$accessToken}",
                    'Content-Type'  => 'application/json'
                ],
                'http_errors' => false // Prevents throwing exceptions on HTTP errors
            ]);

            // Decode response
            $responsen1 = json_decode($responsen->getBody(), true);

            // Check if the response contains the expected structure
            if (isset($responsen1['message']) && $responsen1['message'] == "success" && isset($responsen1['pricebook']['pricebook_items'])) {  
                foreach ($responsen1['pricebook']['pricebook_items'] as $dataitemprice) {
                    $finaldata[$dataitemprice['item_id']] = $dataitemprice['pricebook_rate'];
                }
            }

        } catch (\Exception $e) {
            return ['error' => $e->getMessage()]; // Return error message in an array
        }

        return $finaldata; // Return data or empty array if no items found
    }
}


if (!function_exists('zoho_get_inventory_price_seller')) {
    function zoho_get_inventory_price_seller($accessToken, $organization_id)
    {  
        $finaldata = [];
        //$url = "https://www.zohoapis.com/inventory/v1/pricebooks?organization_id={$organization_id}";
        $url = "https://www.zohoapis.com/books/v3/pricebooks?organization_id={$organization_id}";
        $client = \Config\Services::curlrequest();

        try {
            // Fetch all pricebooks
            $responseq = $client->request('GET', $url, [
                'headers' => [
                    'Authorization' => "Zoho-oauthtoken {$accessToken}",
                    'Content-Type'  => 'application/json'
                ],
                'http_errors' => false
            ]);

            $response = json_decode($responseq->getBody(), true);

            // Check if API response is valid
            if (isset($response['message']) && $response['message'] == "success" && isset($response['pricebooks'])) {  
                foreach ($response['pricebooks'] as $datacat) {
                    
                    if (!isset($datacat['pricebook_id'])) {
                        continue; // Skip invalid entries
                    }

                    $pricebook_id = $datacat['pricebook_id'];
                    $pricebook_name = $datacat['name'] ?? 'Unknown';

                    // Fetch pricebook details
                    //$urln = "https://www.zohoapis.com/inventory/v1/pricebooks/{$pricebook_id}?organization_id={$organization_id}";
                    $urln = "https://www.zohoapis.com/books/v3/pricebooks/{$pricebook_id}?organization_id={$organization_id}";
                    $responsen = $client->request('GET', $urln, [
                        'headers' => [
                            'Authorization' => "Zoho-oauthtoken {$accessToken}",
                            'Content-Type'  => 'application/json'
                        ],
                        'http_errors' => false
                    ]);

                    $responsen1 = json_decode($responsen->getBody(), true);

                    // Ensure pricebook data is valid
                    if (isset($responsen1['message']) && $responsen1['message'] == "success" && isset($responsen1['pricebook']['pricebook_items'])) {  
                        foreach ($responsen1['pricebook']['pricebook_items'] as $dataitemprice) {
                            $item_id = $dataitemprice['item_id'] ?? null;
                            $pricebook_rate = $dataitemprice['pricebook_rate'] ?? 0;
                            if ($item_id) {
                                $finaldata[$item_id][$pricebook_id] = $pricebook_rate;
                            }
                        }
                    }
                }
            }

        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }

        return $finaldata; // Return data or an empty array if no items found
    }
}



if (!function_exists('zoho_book_get_records')) {
    function zoho_book_get_records($accessToken, $organization_id)
    {
        
        $allItems = [];
        $page = 1;
        $perPage = 200; // Number of items per page (max 200 as per Zoho API documentation)

        while (true) {
            
            // Set up the Zoho API URL for retrieving records
            $url = "https://www.zohoapis.com/books/v3/items?organization_id={$organization_id}&filter_by=Status.Active&page={$page}";
            $client = \Config\Services::curlrequest();

            // API call to get records
            $responseq = $client->request('GET', $url, [
                'headers' => [
                'Authorization' => "Zoho-oauthtoken {$accessToken}"
                ]
            ]);

            $response = json_decode($responseq->getBody(), true);
            
            // Append items from the current page to allItems array
            if (isset($response['items']) && !empty($response['items'])) {
                $allItems = array_merge($allItems, $response['items']);
                
                // If less than requested perPage, last page reached
                if (count($response['items']) < $perPage) {
                    break;
                }
                
                $page++; // Increment page number for the next request
            } else {
                break; // No more items to fetch, exit the loop
            }
        }

        return $allItems;
    }
        
      
}


if (!function_exists('zoho_get_records_inventory')) {
    function zoho_get_records_inventory($accessToken,$organization_id,$categoriestype)
    {
        $allItems = [];
        $page = 1;
        $perPage = 200; // Number of items per page (max 200 as per Zoho API documentation)

        while (true) {
            
            // Set up the Zoho API URL for retrieving records
           // $url = "https://www.zohoapis.com/inventory/v1/items?organization_id={$organization_id}&filter_by=Status.Active&page={$page}";
            $url = "https://www.zohoapis.com/books/v3/items?organization_id={$organization_id}&filter_by=Status.Active&page={$page}";
            $client = \Config\Services::curlrequest();

            // API call to get records
            $responseq = $client->request('GET', $url, [
                'headers' => [
                'Authorization' => "Zoho-oauthtoken {$accessToken}"
                ]
            ]);

            $response = json_decode($responseq->getBody(), true);
            
            
            // Append items from the current page to allItems array
            if (isset($response['items']) && !empty($response['items'])) {
                $allItems = array_merge($allItems, $response['items']);
                
                // If less than requested perPage, last page reached
                if (count($response['items']) < $perPage) {
                    break;
                }
                
                $page++; // Increment page number for the next request
            } else {
                break; // No more items to fetch, exit the loop
            }
        }

        return $allItems;
    }
}

if (!function_exists('zoho_get_records_inventory_seller')) {
    function zoho_get_records_inventory_seller($accessToken,$organization_id)
    {
        $allItems = [];
        $page = 1;
        $perPage = 200; // Number of items per page (max 200 as per Zoho API documentation)

        while (true) {
            
            // Set up the Zoho API URL for retrieving records
           // $url = "https://www.zohoapis.com/inventory/v1/items?organization_id={$organization_id}&filter_by=Status.Active&page={$page}";
            $url = "https://www.zohoapis.com/books/v3/items?organization_id={$organization_id}&filter_by=Status.Active&page={$page}";

            $client = \Config\Services::curlrequest();

            // API call to get records
            $responseq = $client->request('GET', $url, [
                'headers' => [
                'Authorization' => "Zoho-oauthtoken {$accessToken}"
                ]
            ]);

            $response = json_decode($responseq->getBody(), true);
            
            
            // Append items from the current page to allItems array
            if (isset($response['items']) && !empty($response['items'])) {
                $allItems = array_merge($allItems, $response['items']);
                
                // If less than requested perPage, last page reached
                if (count($response['items']) < $perPage) {
                    break;
                }
                
                $page++; // Increment page number for the next request
            } else {
                break; // No more items to fetch, exit the loop
            }
        }

        return $allItems;
    }
}

if (!function_exists('zoho_get_records_inventory_byid')) {
    function zoho_get_records_inventory_byid($accessToken,$organization_id,$categoriestype,$ids)
    {
        // Set up the Zoho API URL for retrieving records
        //$url = "https://www.zohoapis.com/inventory/v1/items/{$ids}?organization_id={$organization_id}";
        $url = "https://www.zohoapis.com/books/v3/items/{$ids}?organization_id={$organization_id}";
        $client = \Config\Services::curlrequest();
        // API call to get records
        $responseq = $client->request('GET', $url, [
            'headers' => [
            'Authorization' => "Zoho-oauthtoken {$accessToken}"
            ]
        ]);

        $response = json_decode($responseq->getBody(), true);
        // Append items from the current page to allItems array
        $allItems="";
        if (isset($response['item']) && !empty($response['item'])) {
            $allItems =$response['item'];
        }

        return $allItems;
    }
}

if (!function_exists('zoho_get_pricebooks')) {
    function zoho_get_pricebooks($accessToken, $organization_id)
    {
        $allpricebooks = [];



        // Set up the Zoho API URL
        //$url = "https://www.zohoapis.com/inventory/v1/pricebooks?organization_id={$organization_id}";
        $url = "https://www.zohoapis.com/books/v3/pricebooks?organization_id={$organization_id}";
        $client = \Config\Services::curlrequest();

        try {
            // API call to get records
            $responseq = $client->request('GET', $url, [
                'headers' => [
                    'Authorization' => "Zoho-oauthtoken {$accessToken}",
                    'Content-Type'  => 'application/json'
                ],
                'http_errors' => false // Prevents CodeIgniter from throwing an exception on error
            ]);

            $response = json_decode($responseq->getBody(), true);

           // Debugging: Print response if needed
        //print_r($response); exit;

            if (isset($response['message']) && $response['message'] == "success" && isset($response['pricebooks'])) {
                foreach ($response['pricebooks'] as $datacat) {
                    if ($datacat['pricebook_type'] == "per_item") {
                        $allpricebooks[] = [
                            'pricebook_id' => $datacat['pricebook_id'],
                            'name' => $datacat['name']
                        ];
                    }
                }
            } else {
                // Handle API errors
                return ['error' => $response['message'] ?? 'Unknown error'];
            }
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }

        return $allpricebooks;
    }
}

if (!function_exists('zoho_get_warehouses')) {
function zoho_get_warehouses($accessToken, $organization_id) {
  
    $url = "https://www.zohoapis.com/inventory/v1/warehouses?organization_id={$organization_id}";

    $headers = [
        "Authorization: Zoho-oauthtoken {$accessToken}"
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

}

