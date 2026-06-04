<?php
/**
 * Auto Payment Fetch - CRON Based
 * Lanchhattar Special Edition (10 API Version)
 */

date_default_timezone_set("Asia/Kolkata");

include "../pages/dbFunctions.php";
include "../pages/dbInfo.php";

echo "-------- Auto Payment Fetch Started --------\n";

// 1. Fetch all pending orders
$sql = "SELECT * FROM orders WHERE status='PENDING'";
$orders = getXbyY($sql);

if(count($orders) == 0){
    echo "No pending orders found.\n";
    exit;
}

// 10 API URLs
$apiList = [
    "https://pay.a1ejankari.com/order1/payment-status",
    "https://pay.a1ejankari.com/order2/payment-status",
    "https://pay.a1ejankari.com/order3/payment-status",
    "https://pay.a1ejankari.com/order4/payment-status",
    "https://pay.a1ejankari.com/order5/payment-status",
    "https://pay.a1ejankari.com/order6/payment-status",
    "https://pay.a1ejankari.com/order7/payment-status",
    "https://pay.a1ejankari.com/order8/payment-status",
    "https://pay.a1ejankari.com/order9/payment-status",
    "https://pay.a1ejankari.com/order10/payment-status"
];

foreach($orders as $order){

    $order_id   = $order['order_id'];
    $txnid      = $order['paytm_txn_ref'];
    $redirect   = $order['redirect_url'];

    if($redirect == ""){
        $redirect = "https://pay.a1ejankari.com/";    
    }

    echo "\nChecking Order ID: $order_id | TXN: $txnid\n";

    $finalStatus = "PENDING"; // default state

    // Loop through all APIs
    foreach($apiList as $apiUrl){

        echo "  -> Checking API: $apiUrl\n";

        // cURL request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "txnid=".$txnid);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = trim(curl_exec($ch));
        curl_close($ch);

        echo "     API Response: $result\n";

        // Process Response
        if($result == "success"){

            $finalStatus = "SUCCESS";

            $update = "UPDATE orders SET status='SUCCESS' WHERE order_id='$order_id'";
            setXbyY($update);

            echo "     ✔ SUCCESS Found! Order updated.\n";

            break; // Stop checking further APIs

        }elseif($result == "FAILURE" || $result == "FAILED"){

            $finalStatus = "FAILED";

            $update = "UPDATE orders SET status='FAILED' WHERE order_id='$order_id'";
            setXbyY($update);

            echo "     ✘ FAILED Found! Order updated.\n";

            break; // Stop checking further APIs
        }

        // If response is something else → keep checking next API
    }

    if($finalStatus == "PENDING"){
        echo "     Still Pending After Checking All APIs...\n";
    }

    echo "------------------------------------\n";
}

echo "-------- Auto Payment Fetch Finished --------\n";
?>
