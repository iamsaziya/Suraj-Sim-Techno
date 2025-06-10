<?php
require("../../PHPMailer/PHPMailerAutoload.php"); // adjust path if needed

$recipientEmail = 'saziyaaansari.30@gmail.com';
$recipientName  = 'Saziya Ansari';

// Collect form data
$senderName    = $_POST['contact-name'];
$senderEmail   = $_POST['contact-email'];
$senderPhone   = $_POST['contact-phone'];
$senderCompany = $_POST['contact-company'];
$senderMessage = $_POST['contact-message'];
$senderSubject = 'New Message From ' . $senderName;

// Basic email validation
if (!filter_var($senderEmail, FILTER_VALIDATE_EMAIL)) {
    echo '<div style="color:red;">Invalid email address.</div>';
    exit;
}

// Create PHPMailer instance
$mail = new PHPMailer();

$mail->setFrom($senderEmail, $senderName);
$mail->addReplyTo($senderEmail, $senderName);
$mail->addAddress($recipientEmail, $recipientName);
$mail->Subject = $senderSubject;

// Compose message
$message = '<html><body>';
$message .= '<table rules="all" style="border:1px solid #666;width:100%;" cellpadding="10">';
$message .= "<tr style='background: #eee;'><td><strong>Name:</strong></td><td>" . htmlspecialchars($senderName) . "</td></tr>";
$message .= "<tr><td><strong>Email:</strong></td><td>" . htmlspecialchars($senderEmail) . "</td></tr>";
$message .= "<tr><td><strong>Phone:</strong></td><td>" . htmlspecialchars($senderPhone) . "</td></tr>";
$message .= "<tr><td><strong>Company:</strong></td><td>" . htmlspecialchars($senderCompany) . "</td></tr>";
$message .= "<tr><td><strong>Message:</strong></td><td>" . nl2br(htmlspecialchars($senderMessage)) . "</td></tr>";
$message .= "</table>";
$message .= "</body></html>";

$mail->isHTML(true);
$mail->Body = $message;

if (!$mail->Send()) {
    echo '<div style="color:red;">Error: '. $mail->ErrorInfo .'</div>';
} else {
    echo '<div style="color:green;">Thank you. We will contact you shortly.</div>';
}
?>
