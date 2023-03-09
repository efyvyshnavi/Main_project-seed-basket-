<?php
include('connection.php');
if(isset($_POST['submit']))
{
$full_name=$_POST['full_name'];
$email=$_POST['email'];
$phone_no=$_POST['phone_no'];
$dob=$_POST['dob'];
$address=$_POST['address'];
$username=$_POST['username'];
$password=$_POST['password'];
$cpassword=$_POST['cpassword'];
$gender=$_POST['gender'];


$sql3 = "INSERT INTO tbl_reg (full_name,email,phone_no,dob,gender,cpassword,status) VALUES ('$full_name','email','$phone_no','$dob','$gender','$cpassword','1') ";
$result = $conn->query($sql3);

  }
?>