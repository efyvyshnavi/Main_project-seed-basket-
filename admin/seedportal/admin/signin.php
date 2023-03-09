<?php
include('config.php');
session_start();

if(isset($_POST['login']))
{
  $email=$_POST["email"];
  $password=$_POST["password"];
  $sql="select * from login where email='".$email."' AND password='".$password."'";
  $res=$conn->query($sql);
  if(mysqli_num_rows($res)>0)
  {
	foreach($res as $data)
	{
	  $email=$data['email'];
	  $password=$data['password'];
	  $role=$data['role'];
	}
	$_SESSION['role']="$role";
	$_SESSION['email']="$email";
	$_SESSION['auth_user']=[
	  'email'=>$email,
	  'password'=>$password
	];

	if($_SESSION['role']== "user")
	{
	  $_SESSION['message']="Welcome";
	  header("location:user.php");
	  exit(0);
	}
	elseif($_SESSION['role']=='seller')
	{
	  $_SESSION['message']="Welcome";
	   header("location:admin/page.html");
	  exit(0);
	}
  }
  else
  {

	echo "<script> alert('Incorrect email ID or password'); </script>";

  }
}
?>

<!DOCTYPE html>
<head>
<link rel="stylesheet" href="signin.css">
</head>
<body>
   <form method="POST"action="signin.php"onsubmit="return valid();">
<div id="login-box">
  <div class="left">
    <h1>Sign in</h1>
    
    <input type="text" name="email" placeholder="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                  oninvalid="setCustomValidity(' Provide valid email ID')" 
                        oninput="setCustomValidity('')">
                        
    <input type="password" name="password" id="pass"placeholder="password"required pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$" 
                         oninvalid="setCustomValidity('Enter valid password')" 
                        oninput="setCustomValidity('')"
                        maxlength="20">
                        
	
     <center> <input type="submit" name="login" value="login"></center>
   <center><a href="register.php">Create an account</a></center><br>
	 <center><a href="url">Forgot password?</a></center>
	 
   </div>
  
  <div class="right">
    <span class="loginwith">Sign in with<br />social network</span>
    <button class="social-signin google">Log in with Google+</button>
  </div>
  <div class="or">OR</div>
</div>
<script src="logscript.js"></script>
</body>
</html>
