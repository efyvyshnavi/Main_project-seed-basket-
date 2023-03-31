<?php
session_start();
include('config.php');
$id=$_REQUEST['id'];
$email = $_GET['email'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
$sqlq=mysqli_query($conn,"UPDATE sellerreg,login SET sellerreg.status='-1',login.status='-1' where login.logid=sellerreg.logid AND sellerreg.sellerid='$id'");
if($sqlq)
{
    echo "<script> alert ('Rejected and Email send successfully'); window.location='approve.php'</script>";
    
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
     $mail->setFrom('vyshnavibabus2023b@mca.ajce.in', 'Account request deactivated');
     // get email from input
     $mail->addAddress($email);
     //$mail->addReplyTo('lamkaizhe16@gmail.com');
    
     // HTML body
     $mail->isHTML(true);
     $mail->Subject = "Rejecetd Your Account activation ";
     $mail->Body = "
           <h3>Dear seller, your account activation request in Online Seed Basket is Rejecetd</h3>
            Try after a while or try with a new account
           <br><br>
           <p>With regrads,</p>
           <b>Admin , Online Seed Basket</b>";
     if (!$mail->send()) {
        
       echo "<script> alert ('Email Send UnSuccessfull !!! '); window.location='#'</script>";
    
     } 
    }?> 
    