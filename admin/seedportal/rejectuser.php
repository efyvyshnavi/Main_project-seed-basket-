<?php
session_start();
include('config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
$id = $_GET['id'];
$status = $_GET['status'];
$email = $_GET['email'];

$sqlq=mysqli_query($conn,"UPDATE userreg SET status='$status' WHERE userid='$id'");

if($sqlq)
 {
 echo "<script> alert ('Account Deleted and Email Send Successfully !!! '); window.location='manageuser.php'</script>";

 $mail = new PHPMailer(true);
        
 $mail->isSMTP();
 $mail->Host = 'smtp.gmail.com';
 $mail->Port = 465;
 $mail->SMTPAuth = true;
 $mail->SMTPSecure = 'ssl';

 // h-hotel account
 $mail->Username = 'vyshnavibabus2023b@mca.ajce.in';
 $mail->Password = 'vyshnavi@123';

 // send by h-hotel email
 $mail->setFrom('vyshnavibabus2023b@mca.ajce.in', 'Account Deleted');
 // get email from input
 $mail->addAddress($email);
 //$mail->addReplyTo('lamkaizhe16@gmail.com');

 // HTML body
 $mail->isHTML(true);
 $mail->Subject = "Your account in Online Seed Basket is Deleted ";
 $mail->Body = "
       <h3>Dear user, your account in Online Seed Basket is removed</h3>
        You can start a new account to continue purchasing seeds from Online Seed Basket
       <br><br>
       <p>With regrads,</p>
       <b>Admin , Online Seed Basket</b>";
 if (!$mail->send()) {
    
   echo "<script> alert ('Email Send UnSuccessfull !!! '); window.location='#'</script>";

 } 
 
}
