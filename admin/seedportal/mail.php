<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
// Create a new PHPMailer instance
$mail = new PHPMailer;

// Print a message to indicate that the script is working
echo "PHPMailerAutoload.php is working!";
?>
