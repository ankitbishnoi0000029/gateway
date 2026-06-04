<?php
session_start();
require_once '../config.php';

if(isset($_POST["srno"]) && $_POST["srno"] != ''){
    $userid = $_POST["srno"];
}else{
    $userid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
}

if (isset($_POST["loginuser"])) {
    
    $username = filter_var($_POST['mobileno'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM users WHERE mobile = '$username'";
    $run = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($run);

    if (mysqli_num_rows($run) > 0) {
       
        $byteuserid= $row['id'];
        $pgmode= $row['pg_mode'];
       
        // Generate a random CSRF token
        $csrf_token = bin2hex(random_bytes(32)); // Generate a 32-byte random token
        
        // Store the CSRF token in the session
        $_SESSION['csrf_token'] = $csrf_token;
        $_SESSION['username'] = $username; // Set the username in the session
        $_SESSION['user_id'] = $byteuserid;
        $_SESSION['login_time'] = time();
        
        if($pgmode == 2){
            echo '<script> location.replace("../../imbpro/dashboard");</script>';
        }else{
            echo '<script> location.replace("../dashboard");</script>';
        }
        
    }
}

// getmerchant txn report deatils code here
if(isset($_POST["type"]) && $_POST["type"] == 'txnrdetails'){
        
    $fromdate = $_POST["fromdate"];
    $todate = $_POST["todate"];
   
    $gettotaltxn = $conn->query("SELECT SUM(amount) as amount,COUNT(id) as count FROM orders WHERE user_id = '$userid' AND (DATE(create_date) BETWEEN '$fromdate' AND '$todate')")->fetch_assoc();
    
    $getsuccesstxn = $conn->query("SELECT SUM(amount) as amount,COUNT(id) as count FROM orders WHERE user_id = '$userid' AND status = 'SUCCESS' AND (DATE(create_date) BETWEEN '$fromdate' AND '$todate')")->fetch_assoc();
   
    $getfailedtxn = $conn->query("SELECT SUM(amount) as amount,COUNT(id) as count FROM orders WHERE user_id = '$userid' AND status = 'FAILURE' AND (DATE(create_date) BETWEEN '$fromdate' AND '$todate')")->fetch_assoc();
    
    $txndata = 
    [
        "totaltxn" => '₹ '.number_format((float)$gettotaltxn["amount"],2),
        "totaltxnc" => number_format((int)$gettotaltxn["count"]),
        "totalstxn" => '+₹ '.number_format((float)$getsuccesstxn["amount"],2),
        "totalstxnc" => number_format((int)$getsuccesstxn["count"]),
        "totalftxn" => '₹ '.number_format((float)$getfailedtxn["amount"],2),
        "totalftxnc" => number_format((int)$getfailedtxn["count"]),
    ];
    if($gettotaltxn){
        
        echo json_encode(["res_code" => 200,"msg"=>"Your Transactions Details from $fromdate to $todate.","txndata" => $txndata]);
        exit;
    }else{
        echo json_encode(["res_code" => 404,"msg"=>"Failed to get transaction details"]);
        exit;
    }
   
}

if (isset($_POST["type"]) && $_POST["type"] == 'two_factor_change') {
    // Get the 2FA status from the AJAX request
    $enable_2fa = $_POST['status'];
    
    if($enable_2fa == 1){
        $st = "Enabled";
    }else{
        $st = "Disabled";
    }
    
    $success = $conn->query("UPDATE users SET two_factor = '$enable_2fa' WHERE id = '$userid'");

    // Prepare the response
    if ($success) {
        echo json_encode(["status"=> 1,"msg"=>"Two Factor Security is $st"]);
        die;
    } else {
        echo json_encode(["status"=> 3,"msg"=>"Failed to $st Two Factor Security"]);
        die;
    }

}

if(isset($_POST['get_api_token'])){
   
    // ensure session user id exists
    if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){
        echo json_encode(['rescode' => 401,'status' => false,'msg' => 'User not logged in']);
        exit;
    }

    $bbbyteuserid = (int)$_SESSION['user_id'];
    $otp = isset($_POST['otp']) ? $_POST['otp'] : '';

    // fetch stored otp (and optionally mobile if needed)
    $userfetch_res = $conn->query("SELECT otp FROM users WHERE id = '$bbbyteuserid'");
    if(!$userfetch_res){
        echo json_encode(['rescode' => 500,'status' => false,'msg' => 'DB error']);
        exit;
    }
    $userfetch = $userfetch_res->fetch_assoc();

    if(!$userfetch || !isset($userfetch["otp"]) || $userfetch["otp"] != $otp){
        echo json_encode(['rescode' => 404,'status' => false,'msg' => 'Invalid OTP !']);
        exit;
    }

    // generate random 10-digit number then md5
    $uniqueNumber = mt_rand(1000000000, 9999999999);
    $uniqueNumber = str_pad($uniqueNumber, 10, '0', STR_PAD_LEFT); 

    $key = md5($uniqueNumber);
    
    // IMPORTANT FIX: update users table using user id (not undefined $sanitizedMobile)
    $keyquery = "UPDATE `users` SET user_token='$key' WHERE id = '$bbbyteuserid'";
    $queryres = mysqli_query($conn, $keyquery);
    
    //update token in orders table
    $keyqueryorders = "UPDATE `orders` SET user_token='$key' WHERE user_id = $bbbyteuserid";
    $queryorders = mysqli_query($conn, $keyqueryorders);
    
    //update token in reports table
    $keyqueryordersreports = "UPDATE `reports` SET user_token='$key' WHERE user_id = $bbbyteuserid";
    $queryordersreports = mysqli_query($conn, $keyqueryordersreports);
    
    //hdfc token update 
    $keyqueryhdfc = "UPDATE `hdfc` SET user_token='$key' WHERE user_id = $bbbyteuserid";
    $queryreshdfc = mysqli_query($conn, $keyqueryhdfc);
    
    // Updating user_token in bharatpe_tokens table
    $keyquerybharatpe = "UPDATE `bharatpe_tokens` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    $queryresbharatpe = mysqli_query($conn, $keyquerybharatpe);
    
    // Updating user_token in merchant table
    $keyquerymerchant = "UPDATE `merchant` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    $queryresmerchant = mysqli_query($conn, $keyquerymerchant);
    
    // Updating user_token in mobikwik_token table
    $keyquerybmobikwik_token = "UPDATE `mobikwik_token` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    $queryresbmobikwik_token = mysqli_query($conn, $keyquerybmobikwik_token);
    
    // Updating user_token in freecharge table
    $keyqueryfreecharge = "UPDATE `freecharge` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    $queryresfreecharge = mysqli_query($conn, $keyqueryfreecharge);
    
    // Updating user_token in amazon_pay table
    $keyqueryamazon_pay = "UPDATE `amazon_pay` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    $queryresamazon_pay = mysqli_query($conn, $keyqueryamazon_pay);
    
    
    //update for phonepe  Updating user_token in phonepe_tokens  table and store_id table
    $keyqueryphonepetoken = "UPDATE `phonepe_tokens` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    $queryresphonepetoken = mysqli_query($conn, $keyqueryphonepetoken);
    
    //now to update user_token in table store_id
    $keyqueryphonepetoken2 = "UPDATE `store_id` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    $queryresphonepetoken2 = mysqli_query($conn, $keyqueryphonepetoken2);
    
    //now to update user_token in table paytm_tokens
    $keyquerypaytm2 = "UPDATE `paytm_tokens` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    $queryrespaytm = mysqli_query($conn, $keyquerypaytm2);
    
    //now to update user_token in table googlepay_transactionszz (commented out)
    // $keyquerygooglepay = "UPDATE `googlepay_transactions` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    // $queryresgooglepay = mysqli_query($conn, $keyquerygooglepay);
    
    //now to update user_token in table googlepay_tokens (commented out)
    // $keyquerygooglepay1 = "UPDATE `googlepay_tokens` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    // $queryresgooglepay1 = mysqli_query($conn, $keyquerygooglepay1);
    
    
    if($queryres && $queryreshdfc){
        echo json_encode(['rescode' => 200,'status' => true]);
    } else {
        // if you want debugging info, you can temporarily uncomment lines below
        // echo json_encode(['rescode' => 403,'status' => false,'msg' => 'Failed to generate API Token !', 'mysql_error' => mysqli_error($conn)]);
        echo json_encode(['rescode' => 403,'status' => false,'msg' => 'Failed to generate API Token !']);
    }
}

?>
