<?php
include "header.php";
?>
<?php
if($userdata["aadhar_kyc"] == 1){
    echo "<script> location.replace('dashboard?aadhar_kyc=0') </script>";
}  
 ?>

<?php

// Custom function to validate URLs
function isValidUrl($url) {
    $parsed_url = parse_url($url);
    return isset($parsed_url['host']) && preg_match("/\.\w+$/", $parsed_url['host']);
}

if(isset($_POST['update_webhook'])){
    
    
    $bytecallbackurl=mysqli_real_escape_string($conn,$_POST['webhook_url']);
    
    // Validate the webhook URL
    // Check if the URL has a valid TLD
    if (!isValidUrl($bytecallbackurl)) {
        
        // Show SweetAlert2 error message
                           echo '<script src="js/jquery-3.2.1.min.js"></script>';
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
        echo '<script>
        $("#loading_ajax").hide();
    Swal.fire({
        icon: "error",
        title: "Invalid webhook url!!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "developers"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';

        exit(); // Stop processing the request
    }

    
    
    // Assuming $mobile is already defined in header.php
    $sanitizedMobile = mysqli_real_escape_string($conn, $mobile);


    $key = md5($uniqueNumber);
    $keyquery = "UPDATE `users` SET  callback_url='$bytecallbackurl' WHERE mobile = '$sanitizedMobile'";
    $queryres = mysqli_query($conn, $keyquery);
    if($queryres){
        
        
        
        // Show SweetAlert2 success message
                          echo '<script src="js/jquery-3.2.1.min.js"></script>';
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
        echo '<script>
        $("#loading_ajax").hide();
    Swal.fire({
        icon: "success",
        title: "Webhook Updated Successfully",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "developers"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';

    exit;
    
    } else {
        
        
        
        
          // Show SweetAlert2 error message
                       echo '<script src="js/jquery-3.2.1.min.js"></script>';
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
        echo '<script>
        $("#loading_ajax").hide();
    Swal.fire({
        icon: "error",
        title: "Error Updating Webhook Try again Later!!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "developers"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';
exit;
    }
}
?>

<style>
    .apidiconbox {
    width: 60px;
    height: 60px;
    border: 2px solid #14183f;
    color: #14183f;
    font-size: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

 .modal-content {
            text-align: center;
        }
        .modal-body img {
            max-width: 100%;
            height: auto;
        }
</style>

<main class="app-content">
      <div class="app-title">
       
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

						<!-- <h4 class="page-title">Api Documentation</h4>	 -->
	

					<div class="row row-card-no-pd">
	<div class="col-md-12">
					    <div class="d-flex mb-4">
					        <div class="d-flex flex-wrap justify-content-between flex-1">
					            <div class="mb-lg-0 mb-2 me-8">
					                <h1 class="pg-title">API Credentials</h1>
					                <p>Generate and manage API credentials for secure and seamless integration with our platform</p>
					                  </div>
					                </div>
        					    </div>							
        					   </div>							
	<div class="col-md-2" style="display: flex;align-items: center;justify-content: center;border-right: 1px solid #cfcfcf;">
	    <div class="apidiconbox">
	       <i class="bi bi-key-fill"></i>
	    </div>
	</div>
	<div class="col-md-10">
		<form class="row mb-4" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
			<div class="col-md-8 mb-2">
				<label>Api Token</label>
				<div class="input-group">
					<input type="text" id="apiToken" placeholder="Click Generate Button for API Token" value="<?php echo htmlspecialchars($userdata['user_token'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control" readonly>
					<div class="input-group-append">
						<button type="button" class="btn btn-primary" onclick="copyToken()">
							<i class="fa fa-copy"></i> <!-- Copy Icon -->
						</button>
					</div>
				</div>
				<!-- Small message for copying feedback -->
				<small id="copyMessage" style="color: green; display: none;">Copied!</small>
			</div>
			<div class="col-md-4 mb-2">
				<label>&nbsp;</label>
				<button type="button" data-toggle="modal" data-target="#apikeygenrateModal" class="btn btn-primary btn-block">Generate Api Token</button>
			</div>
		</form>
	</div>	
	
	<div class="col-md-12 mb-4">
		<hr>
	</div>
		
		<div class="col-md-2" style="display: flex;align-items: center;justify-content: center;border-right: 1px solid #cfcfcf;">
	    <div class="apidiconbox">
        <i class="bi bi-link-45deg"></i>
	    </div>
	</div>	
	<div class="col-md-10">
		<form class="row mb-4" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
			<div class="col-md-8 mb-2">
				<label>Webhook URL</label>
				<input type="url" name="webhook_url" placeholder="Enter Your Webhook URL" value="<?php echo htmlspecialchars($userdata['callback_url'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control" required pattern="https?://[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/?[a-zA-Z0-9.-]*\??[a-zA-Z0-9.-]*" title="Enter a valid URL">
				<!--<small style="color:red">Note: URL must include protocol (http / https)</small>-->
			</div>
			<div class="col-md-4 mb-2">
				<label>&nbsp;</label>
				<button type="submit" name="update_webhook" class="btn btn-primary btn-block">Update URL</button>
			</div>
		</form>
	</div>

	<div class="col-md-12 mb-4">
		<hr>
	</div>

<div class="col-md-12 mb-4"><hr></div>

							<div class="col-md-12">
								<h6 class="mb-3"><b>Create Order API</b></h6>
								<form class="row mb-4" method="POST" action="">
								<div class="col-md-12 mb-2">
									<label>URL</label>
									<input type="text" placeholder="URL" value="https://<?php echo htmlspecialchars($server, ENT_QUOTES, 'UTF-8'); ?>/api/create-order" class="form-control" readonly>
									<b style="color:red">Order Timeout 30 Minutes. Order Will Be Automatically Failed After 30 Minutes.</b>
								</div>
								<div class="col-md-12 mb-2">
									<label>Form-Encoded Payload (application/x-www-form-urlencoded)</label>
									<textarea type="text" placeholder="Form-Encoded Payload (Parameter)" class="form-control" style="height: 190px;" readonly>{
  "customer_mobile": "8145344963",
  "user_token": "<?php echo htmlspecialchars($userdata['user_token'], ENT_QUOTES, 'UTF-8'); ?>",
  "amount": "1",
  "order_id": "8787772321800",
  "redirect_url": "your website url",
  "remark1" : "testremark",
  "remark2 : "testremark2,
}</textarea>

								</div>
								<div class="col-md-6 mb-2">
									<label>Success Response</label>
									<textarea type="text" placeholder="Success Response" class="form-control" style="height: 230px;" readonly>
    {
    "status": true,
    "message": "Order Created Successfully",
    "result": {
        "orderId": "1234561705047510",
        "payment_url": "https://yourwebsite.com/payment/pay.php?data=MTIzNDU2MTcwNTA0NzUxMkyNTIy"
    }
}
</textarea>

								</div>
								<div class="col-md-6 mb-2">
									<label>Failed Response</label>
									<textarea type="text" placeholder="Failed Response" class="form-control" style="height: 140px;" readonly>{
    "status": "false",
    "message": "Order_id Already Exist"
}</textarea> 
								</div>
							  </form>
							</div>

							<div class="col-md-12 mb-4"><hr></div>

							<div class="col-md-12">
								<h6 class="mb-3"><b>Check Order Status API</b></h6>
								<form class="row mb-4" method="POST" action="">
								<div class="col-md-12 mb-2">
									<label>URL</label>
									<input type="text" placeholder="URL" value="https://<?php echo htmlspecialchars($server, ENT_QUOTES, 'UTF-8'); ?>/api/check-order-status" class="form-control" readonly>
								</div>
								<div class="col-md-12 mb-2">
									<label>Form-Encoded Payload (application/x-www-form-urlencoded)</label>
									<textarea type="text" placeholder="Post Data into Form Header into Form Header (Parameter)" class="form-control" style="height: 120px;" readonly>{
    "user_token": "2048f66bef68633fa3262d7a398ab577",
    "order_id": "8052313697"
}</textarea> 
								</div>
								<div class="col-md-6 mb-2">
									<label>Success Response</label>
									
								<textarea type="text" placeholder="Success Response" class="form-control" style="height: 190px;" readonly>
{
    "status": "COMPLETED",
    "message": "Transaction Successfully",
    "result": {
        "txnStatus": "COMPLETED",
        "resultInfo": "Transaction Success",
        "orderId": "784525sdD",
        "status": "SUCCESS",
        "amount": "1",
        "date": "2024-01-12 13:22:08",
        "utr": "454525454245"
    }
}
</textarea>

								</div>
								<div class="col-md-6 mb-2">
									<label>Failed Response</label>
									<textarea type="text" placeholder="Failed Response" class="form-control" style="height: 140px;" readonly>{
    "status": ERROR,
    "message": "Error Massege",
    
}</textarea> 
								</div>
							  </form>
							</div>      
							<script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
							<script src="./assets/js/scripts/dashboard_1_demo.js" type="text/javascript"></script>
							 <script src="assets/js/app.min.js" type="text/javascript"></script>
							

<style>
	/* Button Styles */
	.custom-button {
		background-color: #4CAF50; /* Green background */
		border: none; /* Remove borders */
		color: white; /* White text */
		padding: 15px 32px; /* Some padding */
		text-align: center; /* Centered text */
		text-decoration: none; /* Remove underline */
		display: inline-block; /* Make the container inline */
		font-size: 16px; /* Increase font size */
		margin: 10px 2px; /* Some margin */
		cursor: pointer; /* Pointer cursor on hover */
		border-radius: 8px; /* Rounded corners */
		transition-duration: 0.4s; /* Animation on hover */
	}

	.custom-button:hover {
		background-color: #45a049; /* Darker green on hover */
	}

	/* Copy icon button */
	.btn-outline-secondary {
		display: flex;
		align-items: center;
	}

	/* Small message styling */
	#copyMessage {
		margin-top: 10px;
		font-size: 12px;
	}
</style>


<!-- The Modal -->
<div class="modal fade" id="apikeygenrateModal" tabindex="-1" role="dialog" aria-labelledby="apikeygenrateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="apikeygenrateModalLabel">Do You Want to Proceed?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="firstPage">
                <h1 class="qtexth1 text-primary">?</h1>
                <p>Do you want to change your API Token ? If yes we have send 6 digit OTP to your email for verification.</p>
                <button id="yesButton" class="btn btn-success">Yes</button>
                <button class="btn btn-danger" data-dismiss="modal">No</button>
            </div>
            <div class="modal-body d-none" id="secondPage">
                <h5>Verify OTP</h5>
                <form id="otpForm">
                    <input type="text" class="form-control" id="otp" maxlength="6" placeholder="Enter 6-digit OTP" required>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
	// Function to copy the API Token silently and show "Copied!" message
	function copyToken() {
		var token = document.getElementById("apiToken");
		token.select();
		token.setSelectionRange(0, 99999); /* For mobile devices */
		document.execCommand("copy");

		// Show the "Copied!" message
		var copyMessage = document.getElementById("copyMessage");
		copyMessage.style.display = "inline";

		// Hide the message after 2 seconds
		setTimeout(function() {
			copyMessage.style.display = "none";
		}, 2000);
	}
</script>

                            
                            
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
   
<script>
    $(document).ready(function() {
        $('#yesButton').click(function() {
             $("#loading_ajax").show();
            $.ajax({
                url: 'backend/MerchantAuthController',
                type: 'POST',
                data: { 'sendotp': true, 'page' : 'Generating New API Token'},
                success: function(response) {
                    
                     $("#loading_ajax").hide();
                     
                    let rslt = JSON.parse(response);
                   
                    if(rslt.rescode == 200){
                      
            $('#firstPage').addClass('d-none');
            $('#secondPage').removeClass('d-none');
                    }else{
                        
                        Swal.fire({
        icon: "error",
        title: rslt.msg,
        showConfirmButton: true,
        confirmButtonText: "Ok!",
        allowOutsideClick: false,
        allowEscapeKey: false
    });
                      
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error submitting OTP: ' + error);
                }
            });
        });
       
       
        $('#otpForm').submit(function(e) {
            e.preventDefault();
             $("#loading_ajax").show();
             
            var otp = $('#otp').val();
            
            $.ajax({
                url: 'backend/user_settings',
                type: 'POST',
                data: { otp: otp, 'get_api_token' : true},
                success: function(response) {
                     $("#loading_ajax").hide();
                     
                    let rslt = JSON.parse(response);
                    $('#apikeygenrateModal').modal('hide');
                    
                    if(rslt.rescode == 200){
                        
                        Swal.fire({
        icon: "success",
        title: "API Key Generated Successfully",
        showConfirmButton: true,
        confirmButtonText: "Ok!",
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "developers";
        }
    });
                    }else{
                        
                        Swal.fire({
        icon: "error",
        title: rslt.msg,
        showConfirmButton: true,
        confirmButtonText: "Ok!",
        allowOutsideClick: false,
        allowEscapeKey: false
    });
                      
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error submitting OTP: ' + error);
                }
            });
        });
    });
</script>
   
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>
  </body>
</html>