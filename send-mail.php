<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $supportType = htmlspecialchars(trim($_POST["supportType"]));

    $mail = new PHPMailer(true);

    try {
        // SMTP Settings
        $mail->isSMTP();
        $mail->Host = 'mail.pay.a1ejankari.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'no-reply@pay.a1ejankari.com';
        $mail->Password = 'P5&XExDcm';       
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender & Recipient
        $mail->setFrom('no-reply@pay.a1ejankari.com', 'imb Pay Contact Form');
        $mail->addAddress('youremail@gmail.com'); // ✅ Admin email jaha receive hoga

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = 'New Consultation Request';
        $mail->Body = "
            <strong>Name:</strong> $name<br>
            <strong>Email:</strong> $email<br>
            <strong>Phone:</strong> $phone<br>
            <strong>Support Type:</strong> $supportType
        ";

        $mail->send();
        echo "Your request has been sent successfully.";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
