<?php
session_start();
function sendEmail($email, $subject, $message) {
    $to = $email;
    $subject = $subject;
    $message = $message;
    $from = 'support@mjtech.com.ng';
    $headers = "From: " . strip_tags($from) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    mail($to, $subject, $message, $headers);
}

function sendWelcomeEmail($email, $name, $password) {
    $subject = 'Welcome to Our Platform!';

    $message = 'Dear '.$name.',

    Welcome to our platform! We\'re thrilled to have you on board. Your account has been successfully created, and we are excited to see you explore all the features and benefits our platform has to offer.

    Please find your login details below:
    Password: '.$password.'

    Remember to keep this information confidential. If you have any questions or need assistance, feel free to reach out. We\'re here to help!

    Best regards,
    BelongingGuard Team';
    sendEmail($email, $subject, $message);
}

function sendItemRegistrationEmail($email, $name, $trackingId) {
    $subject = 'Item Registration Successful!';

    $message = 'Dear '.$name.',

    Congratulations! Your item has been successfully registered on our platform. Thank you for choosing our services. Here are the details:

    Item Tracking ID: '.$trackingId.'

    You can use this ID to keep track of your item\'s status. If you have any questions or concerns, don\'t hesitate to contact us. We\'re here to assist you.

    Best regards,
    BelongingGuard Team';
    sendEmail($email, $subject, $message);
}

function sendItemApprovalEmail($email, $name, $trackingId) {
    $subject = 'Item Approval Notification';

    $message = 'Dear '.$name.',

    We\'re pleased to inform you that your recently registered item with Tracking ID: '.$trackingId.' has been approved by our administrators. Your item is now safe and secure with us.

    If you have any further questions or if there\'s anything else we can assist you with, feel free to reach out. Thank you for choosing our platform.

    Best regards,
    BelongingGuard Team';
    sendEmail($email, $subject, $message);
}

function sendItemRejectionEmail($email, $name, $trackingId) {
    $subject = 'Item Rejection Notification';

    $message = 'Dear '.$name.',

    We regret to inform you that your recently registered item with Tracking ID: '.$trackingId.' has been rejected by our administrators. If you have any questions regarding the rejection or need further assistance, please don\'t hesitate to contact us.

    We appreciate your understanding, and we\'re here to help with any concerns you may have.

    Best regards,
    BelongingGuard Team';
    sendEmail($email, $subject, $message);
}

function sendIetmCheckOutEmail($email, $name, $trackingId) {
    $subject = 'Item Check-Out Confirmation';

    $message = 'Dear '.$name.',

    Your item with Tracking ID: '.$trackingId.' has been successfully checked out from our facility. If you were the one who picked it up, thank you for choosing our services. If you believe there is an error or if you did not pick up the item, please contact us immediately.

    We\'re here to assist you with any questions or concerns you may have.

    Best regards,
    BelongingGuard Team';
    sendEmail($email, $subject, $message);
}
?>