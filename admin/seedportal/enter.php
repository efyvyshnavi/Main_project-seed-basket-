<?php
session_start();
if($_SESSION['email']){
    $email = $_SESSION['email'];
}
else{
    echo '<script> alert ("Error!");</script>';
    echo'<script>window.location.href="forgotpass.php";</script>';
}
include 'config.php';
if(isset($_POST['submit_otp'])){
    $otp = $_POST['otp-enter'];
    $otp_check = "SELECT `otp_code` FROM `login` WHERE `email`= '$email'";
    $otp_run = mysqli_query($conn,$otp_check);
    $row = mysqli_fetch_array($otp_run);
    if($row>0)
    {
        echo "SUCCESSFULLY FETCHED";
    }
    else{
        echo "Failed to Fetch";

    }
    // echo $row['otp_code'];
    if($row['otp_code'] === $otp){
        $upotp = "UPDATE `login` SET `otp_code`='0' WHERE `email`= '$email'";
        mysqli_query($conn,$upotp);
        echo '<script> alert ("OTP verified");</script>';
        echo'<script>window.location.href="updatePass.php";</script>';
    }else{
        echo '<script> alert ("Invalid OTP");</script>';
        echo'<script>window.location.href="enter-otp.html";</script>';
    }
}
?>