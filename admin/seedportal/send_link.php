<?php
include('config.php');
use vs\seedportal\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['submit_email']) && $_POST['email'])
{
    $email=$_POST["email"];
    $sql="select * from login where email='$email'";
     $res=$conn->query($sql);
  
  if(mysqli_num_rows($res)==1)
  {
    while($row=mysqli_fetch_array($res))
    {
      $email=md5($row['email']);
      $pass=md5($row['password']);
    }
    $link="<a href='www.samplewebsite.com/reset.php?key=".$email."&reset=".$pass."'>Click To Reset password</a>";
    $mail = new PHPMailer();
    try{
    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    // enable SMTP authentication
    $mail->SMTPAuth = true;                  
    // GMAIL username
    $mail->Username = "your_email_id@gmail.com";
    // GMAIL password
    $mail->Password = "your_gmail_password";
    $mail->SMTPSecure = "ssl";  
    // sets GMAIL as the SMTP server
    $mail->Host = "smtp.gmail.com";
    // set the SMTP port for the GMAIL server
    $mail->Port = "465";
    $mail->From='your_gmail_id@gmail.com';
    $mail->FromName='your_name';
    $mail->AddAddress('reciever_email_id', 'reciever_name');
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->Body    = 'Click On This Link to Reset Password '.$pass.'';
    $mail->Send();
      echo "Check Your Email and Click on the link sent to your email";

 }catch(Exception $e){
    {
      echo "Mail Error - >".$mail->ErrorInfo;
    }
  }	
}}
?>
