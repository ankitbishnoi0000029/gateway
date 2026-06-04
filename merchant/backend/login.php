<?php
ob_start();

require_once '../config.php';
include('../smtp/PHPMailerAutoload.php');

function json_response($payload) {
    while (ob_get_level() > 0) {
        ob_end_clean();
    }
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($payload);
    exit;
}

function sendEmail($to, $subject, $message) {  
    
    $mail = new PHPMailer(); 
    	$mail->IsSMTP(); 
    	$mail->SMTPAuth = true; 
    	$mail->SMTPSecure = 'tls'; 
    	$mail->Host = "smtp.hostinger.com";
    	$mail->Port = 587; 
    	$mail->IsHTML(true);
    	$mail->CharSet = 'UTF-8';
    	//$mail->SMTPDebug = 2; 
    	$mail->Username = "support@garudhub.in";
    	$mail->Password = "A1ejankari@123";
    	$mail->SetFrom("support@garudhub.in","Greenpay");
    	$mail->Subject = $subject;
    	$mail->Body =$message;
    	$mail->AddAddress($to);
    	$mail->SMTPOptions=array('ssl'=>array(
    		'verify_peer'=>false,
    		'verify_peer_name'=>false,
    		'allow_self_signed'=>false
    	));
    	if(!$mail->Send()){
    		return $mail->ErrorInfo;
    	}else{
    	    return true;
    	}
}


// reCAPTCHA
$secret_key = '6Lc9tU0sAAAAAIpns-AP-4BPK7cFJbWtLSep6Qbo';
$recaptcha_response = $_POST['g-recaptcha-response'] ?? '';
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = [
    'secret' => $secret_key,
    'response' => $recaptcha_response,
    'remoteip' => $_SERVER['REMOTE_ADDR']
];
$options = [
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($data),
    CURLOPT_RETURNTRANSFER => true
];
$ch = curl_init();
curl_setopt_array($ch, $options);
$response = curl_exec($ch);
curl_close($ch);
$response_data = json_decode($response);

// Check if reCAPTCHA verification passed
// if ($response_data->success) {

    $username = preg_replace('/\D+/', '', (string) ($_POST['mobile'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    $query = "SELECT * FROM users WHERE mobile = '$username'";
    $run = mysqli_query($conn, $query);

    if (!$run) {
        json_response(["status" => 6, "msg" => 'Login failed. Please try again.']);
    }

    if (mysqli_num_rows($run) > 0) {
        $row = mysqli_fetch_array($run);
        $hashFromDatabase = $row['password'];
        $acc_lock = $row['acc_lock'];
        $acc_ban = $row['acc_ban'];
        $userId = $row['id'];
        $pgmode = $row['pg_mode'];
        $two_factor = $row['two_factor'];

        if ($acc_ban == 'on') {
            json_response(["status" => 5, "msg" => 'Your account is locked. Please email us at info@upigateways.com to unlock it.']);
        }

        if (password_verify($password, $hashFromDatabase)) {
            session_start();
            $query = "UPDATE users SET acc_lock = 0 WHERE mobile = '$username'";
            mysqli_query($conn, $query);
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

            if ($two_factor == 0 && $pgmode == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $userId;
                $_SESSION['login_time'] = time();
                json_response(["status" => 11, "msg" => 'login success', "userid" => $userId]);
            }

            $otp = rand(100000, 999999);
            $sql = "UPDATE users SET otp = $otp WHERE mobile = '$username'";
            if (mysqli_query($conn, $sql)) {
                $toemail = $row["email"];
                $strmail = substr($toemail, -15);
                $strmobile = substr($username, -4);
                $msg = "Login OTP is sent to your Mobile No - XXXXXX$strmobile And Email XXXXXX$strmail";

                $mailmsg = '<html>
<head>
  <title>Login OTP - UPIGateways</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #007BFF;
      margin: 0;
      padding: 0;
      color: #ffffff;
    }
    .container {
      max-width: 600px;
      margin: 20px auto;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      color: #333333;
    }
    .header {
      text-align: center;
      padding: 10px;
      border-bottom: 1px solid #dddddd;
    }
    .header img {
      max-width: 150px;
    }
    .content {
      padding: 20px;
    }
    .otp-info {
      background-color: #f9f9f9;
      border: 1px solid #dddddd;
      padding: 10px;
      border-radius: 5px;
      margin-top: 10px;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      color: #007BFF;
    }
    .footer {
      text-align: center;
      font-size: 12px;
      color: #777777;
      margin-top: 20px;
    }
    a {
      color: #007BFF;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <img src="https://pay.a1ejankari.com/newassets/images/Logo.png" alt="imb Pay Logo">
    </div>
    <div class="content">
      <p>Dear User,</p>
      <p>To complete your login to the UPIGateways, please use the following One-Time Password (OTP):</p>
      <div class="otp-info">' . htmlspecialchars($otp) . '</div>
      <p>This OTP is valid for 10 minutes. If you did not request an OTP, please ignore this email or contact our support team.</p>
      <p>You can log in to your account using the following link: <a href="https://upigateways.com/merchant/index">Login</a></p>
      <p>If you have any questions or need further assistance, feel free to contact our support team.</p>
      <p>Best regards,<br>The UPIGateways Team</p>
    </div>
    <div class="footer">
      <p>&copy; ' . date("Y") . ' UPIGateways. All rights reserved.</p>
    </div>
  </div>
</body>
</html>';

                sendEmail($toemail, "Login OTP Verification", $mailmsg);
                json_response(["status" => 1, "msg" => $msg, "userid" => $userId]);
            }

            json_response(["status" => 6, "msg" => 'OTP generation failed. Please try again.']);
        } else {
            $acc_lock = (int) $acc_lock + 1;
            $query = "UPDATE users SET acc_lock = $acc_lock WHERE mobile = '$username'";
            mysqli_query($conn, $query);
            json_response(["status" => 2, "msg" => 'Invalid password']);
        }
    } else {
        json_response(["status" => 4, "msg" => 'Username Does not Exist!']);
    }

// } else {
//     echo json_encode(["status" => 5, "msg" => 'Please complete the CAPTCHA to log in.!']);
//     exit;
// }
?>
