<?php

use App\Models\Customer_mdl;
use Config\Services;


/**
 * Log any user action dynamically.
 *
 * @param string $byUser   User type (e.g., "customer", "admin", "vendor").
 * @param int    $byUserId User ID.
 * @param string $event    The event name (e.g., "login", "logout", "update_profile").
 * @param string $status   (Optional) Status of the event (e.g., "success", "failed").
 * @param array  $details  (Optional) Additional data to store.
 */
function logAction($byUser, $byUserId, $status = 'success', $log_type,$details = [])
{
    $userLogModel = new Customer_mdl();

    $logData = [
        'by_user'     => $byUser,
        'by_user_id'  => $byUserId,
        'ip_address'  => Services::request()->getIPAddress(),
        'status'      =>$status,
        'log_type'    =>$log_type,
        'log_json'    => json_encode($details)
        
    ];

    return $userLogModel->putLogData($logData);
}
