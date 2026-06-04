<?php
session_start();
require_once('../config.php');
require_once('config.php');

$orderid = $_COOKIE['order_id_cookie'];

// API endpoint URL
$url = "https://" . $_SERVER["SERVER_NAME"] . "/api/check-order-status";

// POST data
$postData = array(
    "user_token" => $token,
    "order_id" => $orderid
);

// Initialize cURL session
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

// Execute cURL session and get the response
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
    exit;
}

// Close cURL session
curl_close($ch);

// Decode the JSON response
$responseData = json_decode($response, true);

// Check if the API call was successful
if ($responseData["status"] === "COMPLETED") {
    $planid = $_COOKIE['planid_cookie'];
    $email = $_SESSION['username'];

    // Define the number of days to add based on the plan ID
    switch ($planid) {
        case 1:
            $daysToAdd = 28;
            break;
        case 2:
            $daysToAdd = 28;
            break;
        case 3:
            $daysToAdd = 28;
            break;
        case 4:
            $daysToAdd = 28;
            break;
        case 5:
            $daysToAdd = 84;
            break;
        case 6:
            $daysToAdd = 84;
            break;
        case 7:
            $daysToAdd = 84;
            break;
        case 8:
            $daysToAdd = 84;
            break;
        default:
            $daysToAdd = 0; // Default case if planid doesn't match
            break;
    }

    // Fetch current expiry date from the database
    $query = "SELECT expiry FROM users WHERE mobile = '$email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $currentExpiry = $row['expiry'];
    $sponser_id = $row['sponser_by'];
    
    // Fetch current expiry date from the database
    $sponserquery = "SELECT expiry FROM users WHERE sponser_id = '$sponser_id'";
    $sponserresult = mysqli_query($conn, $sponserquery);
    $sponserdata = mysqli_fetch_assoc($sponserresult);
    $sponserExpiry = $sponserdata['expiry'];
    
    // Convert expiry date and current date to timestamps
    $currentExpiryTimestamp = strtotime($currentExpiry);
    $currentDateTimestamp = strtotime(date('Y-m-d'));

    // Calculate new expiry date
    if ($currentExpiryTimestamp < $currentDateTimestamp) {
        // If expiry date is in the past, add days from current date
        $newExpiry = date('Y-m-d', strtotime("+$daysToAdd days", $currentDateTimestamp));
    } else {
        // If expiry date is in the future, add days to existing expiry date
        $newExpiry = date('Y-m-d', strtotime("+$daysToAdd days", $currentExpiryTimestamp));
    }

    // Update the expiry date in the database
    $sql = "UPDATE users SET expiry = '$newExpiry', plan_id='$planid' WHERE mobile = '$email'";
    $updateResult = mysqli_query($conn, $sql);

    if ($updateResult) {
        
        if(mysqli_num_rows($sponserresult) > 0){
            
             $sponserDateadd = floor($daysToAdd / 3);
            // Convert expiry date and current date to timestamps
    $currentExpirySponser = strtotime($sponserExpiry);
   
    // Calculate new expiry date
    if ($currentExpirySponser < $currentDateTimestamp) {
        // If expiry date is in the past, add days from current date
        $newsponserExpiry = date('Y-m-d', strtotime("+$sponserDateadd days", $currentDateTimestamp));
    } else {
        // If expiry date is in the future, add days to existing expiry date
        $newsponserExpiry = date('Y-m-d', strtotime("+$sponserDateadd days", $currentExpirySponser));
    }

    // Update the expiry date in the database
    $conn->query("UPDATE users SET expiry = '$newsponserExpiry' WHERE sponser_id = '$sponser_id'");
    
        }
        
        header("Location: https://" . $_SERVER["SERVER_NAME"] . "/merchant/dashboard");
        exit;
    } else {
        // Redirect to subscription page on error
        header("Location: https://" . $_SERVER["SERVER_NAME"] . "/merchant/subscription");
        exit;
    }
} else {
    // API call failed
    $errorMessage = $responseData["message"];
    echo "API Error: $errorMessage";
}
?>
