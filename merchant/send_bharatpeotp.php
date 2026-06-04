<?php
include "header.php";

// ini_set("display_errors",true);
// error_reporting(E_ALL);

function bharatpe_trans($merchantId, $token, $cookie) {
    // Calculate the date range
    $fromDate = date('Y-m-d', strtotime('-2 days'));
    $toDate = date('Y-m-d');

    // Initialize cURL
    $curl = curl_init();

    // Set up cURL options
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://payments-tesseract.bharatpe.in/api/v1/merchant/transactions?module=PAYMENT_QR&merchantId=' . $merchantId . '&sDate=' . $fromDate . '&eDate=' . $toDate,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 120,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'token: ' . $token,
            'user-agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36',
            'Cookie: ' . $cookie
        ),
    ));

    // Execute cURL request
    $response = curl_exec($curl);
    curl_close($curl);

    // Decode the JSON response
    $decodedResponse = json_decode($response, true);

    // Return the decoded JSON response
    return $decodedResponse;
}






if(isset($_POST['verifyotp'])) {
    
    $bbbyteuserid=$_SESSION['user_id'];
    
  $bbytebharatpeuserid=  $userdata['user_token'];
  $bbytebharatpeusermid = $_POST["MID"];
  $bbytebharatpeusertoken= $_POST["token"];
  $bbytebharatpeusercookie= $_POST["cookie"];
  $upi_id = $_POST["upi_id"];
  
     $sqlUpdateUser = "UPDATE users SET bharatpe_connected='Yes' WHERE user_token='$bbytebharatpeuserid'";
    $resultUpdateUser = mysqli_query($conn, $sqlUpdateUser);
    

// Call the function and store the response in a variable
// Call the function and store the response in a variable
$response = bharatpe_trans($bbytebharatpeusermid, $bbytebharatpeusertoken, $bbytebharatpeusercookie);

// Check if the response is an array or an object, then encode to JSON for readability
if (is_array($response) || is_object($response)) {
   // echo json_encode($response, JSON_PRETTY_PRINT);

    // Check if the response has 'message' as 'SUCCESS' and 'status' as true
    if (isset($response['message']) && $response['message'] === 'SUCCESS' &&
        isset($response['status']) && $response['status'] === true) {
        // Add your specific code here that should run when the condition is met
        // For example: echo "Condition met. Message is SUCCESS and status is true.";
        
        $bbytebharatpestatus=true;
    }

} else {
    // If it's not an array or an object, just echo the raw response
    $bbytebharatpestatus=false;
    echo $response;
}


if($bbytebharatpestatus) {   
    
    
$sqlw = "UPDATE bharatpe_tokens SET merchantId='$bbytebharatpeusermid', token='$bbytebharatpeusertoken', status='Active', Upiid = '$upi_id', user_id='$bbbyteuserid', cookie='$bbytebharatpeusercookie' WHERE user_token='$bbytebharatpeuserid'";
$result = mysqli_query($conn, $sqlw);



   if ($result) {
       
$fetchuser = $conn->query("SELECT route FROM `users` WHERE user_token='$bbytebharatpeuserid'")->fetch_assoc();

if($fetchuser["route"] == 0){       
  // inactive other merchant
$tablesarr = ["hdfc","freecharge","googlepay_tokens","merchant","paytm_tokens","phonepe_tokens"];
$connected_merarr = ["sbi_connected","phonepe_connected","paytm_connected","freecharge_connected","hdfc_connected","googlepay_connected"];

foreach($tablesarr as $tables){
    $fetchmerchant = $conn->query("SELECT user_token FROM `$tables` WHERE user_token = '$bbytebharatpeuserid' AND status = 'Active'");
    if($fetchmerchant->num_rows > 0){
        $conn->query("UPDATE $tables SET status = 'Deactive' WHERE user_token = '$bbytebharatpeuserid'");
    }
}

foreach($connected_merarr as $connected){
   $conn->query("UPDATE users SET $connected = 'No' WHERE user_token = '$bbytebharatpeuserid'");
}

}
    
     
    // Show SweetAlert2 success message
                             echo '<script src="js/jquery-3.2.1.min.js"></script>';
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
$("#loading_ajax").hide();
    Swal.fire({
        icon: "success",
        title: "Congratulations! Your Bharatpe Hasbeen Connected Successfully!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "upisettings"; // Redirect to "upisettings" when the user clicks the confirm button
        }
    });
</script>';

    //exit;
    
    
} else {
    // Query failed
  //  echo "Error: " . mysqli_error($conn);
  
   // Show SweetAlert2 error message
                             echo '<script src="js/jquery-3.2.1.min.js"></script>';
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
$("#loading_ajax").hide();
    Swal.fire({
        icon: "error",
        title: "Please Try Again Later!!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "upisettings"; // Redirect to "upisettings" when the user clicks the confirm button
        }
    });
</script>';
exit;

  
}

}

elseif (!$bbytebharatpestatus){
    
    
     // Show SweetAlert2 error message
                             echo '<script src="js/jquery-3.2.1.min.js"></script>';
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
$("#loading_ajax").hide();
    Swal.fire({
        icon: "error",
        title: "Invaild BharatPe Details!!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "upisettings"; // Redirect to "upisettings" when the user clicks the confirm button
        }
    });
</script>';
exit;
    
    
}
    
}

// bharatpe end verify


//form start

if(isset($_POST['Verify'])) {


    if ($userdata['bharatpe_connected']=="Yes"){
        
         
        // Show SweetAlert2 error message
      echo '<script src="js/jquery-3.2.1.min.js"></script>';
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
$("#loading_ajax").hide();
Swal.fire({
icon: "error",
title: "Merchant Already Connected !!",
showConfirmButton: true, // Show the confirm button
confirmButtonText: "Ok!", // Set text for the confirm button
allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
}).then((result) => {
if (result.isConfirmed) {
window.location.href = "upisettings"; // Redirect to "upisettings" when the user clicks the confirm button
}
});
</script>';
exit;
}
    
    $bharatpe_mobile = $_POST["bharatpe_mobile"];

    // Now, you can use the $bharatpe_mobile variable as needed
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-user"></i> Bharatpe UPI Settings</h1>
          <!-- <p>Start a beautiful journey here</p> -->
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
        </ul>
      </div>
      </div>
      <div class="tile mb-4">
        <div class="page-header">
          <div class="row">
            <div class="col-lg-12">
						<!-- <h4 class="page-title">UPI Settings</h4> -->
						<div class="row row-card-no-pd">
							<div class="col-md-12">
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Bharatpe UPI Settings</h4>
                <div class="row row-card-no-pd">
                    <div class="col-md-12">
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mb-2">
                            <div class="row" id="merchant">
                                <div class="col-md-4 mb-2"> 
                                    <label>Enter Merchant ID</label> 
                                    <input type="text" name="MID" placeholder="Enter Merchant ID" class="form-control" required=""> 
                                </div>
                                <div class="col-md-4 mb-2"> 
                                    <label>Enter BharatPe Cookie</label> 
                                    <input type="text" name="cookie" placeholder="Enter Bharatpe Cookie"  class="form-control" required=""> 
                                </div>
                                <div class="col-md-4 mb-2"> 
                                    <label>Enter BharatPe Token</label> 
                                    <input type="text" name="token" placeholder="Enter BharatPe Token" class="form-control" required="">
                                </div>
                                <div class="col-md-6 mb-2"> 
                                    <label>Enter BharatPe UPI Id</label> 
                                    <input type="text" name="upi_id" placeholder="Enter BharatPe UPI Id" class="form-control" required="">
                                </div>
                                <div class="col-md-4 mb-2"> 
                                    <label>&nbsp;</label> 
                                    <button type="submit" name="verifyotp" class="btn btn-primary btn-block">Verify BharatPe</button> 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script>
$("#loading_ajax").hide();
</script>
    </body>
    </html>
<?php
} // End of if(isset($_POST['Verify']))

?>
