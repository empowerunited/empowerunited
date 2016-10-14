<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require 'vendor/autoload.php';

$sendgrid = new SendGrid('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');
$email    = new SendGrid\Email();


$name = $_POST['name'];
$email_from = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// $name = "ivo";
// $email_from = "ivo@empowerunited.com";
// $message = "message is ncie";

if (empty($name) || empty($email_from) || empty($message) || !filter_var($email_from, FILTER_VALIDATE_EMAIL)) {
  echo 'No arguments provided!';
  return;
}

$to = 'office@empowerunited.com';
$email_subject = 'Website Contact Form: ' . $name;

$email_body = "You have received a new message from your website contact form.\n\n".
              "Here are the details:\n\n".
              "Name: $name\n\n".
              "Email: $email_from\n\n".
              "Phone: $phone\n\n".
              "Message:\n$message";

$headers = "From: noreply@empowerunited.com\n";


$email
    ->addTo($to)
    ->setFrom('rado@club50plus.bg')
    ->setSubject($email_subject)
    ->setText($email_body)
    ->setHtml($email_body);

$sendgrid->send($email);


return true;

?>
