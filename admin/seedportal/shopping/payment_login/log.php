<?php
session_start();
include('config.php');

if(isset($_POST['subm']))
{
  $email=$_POST["email"];
  $password=($_POST["password_2"]);
 

  $sqlquery="SELECT email,password,role,status,logid from login where (email='$email' and password='$password')and status!=-1";
  $result = mysqli_query($conn, $sqlquery);
  if (mysqli_num_rows($result) >0){
	foreach($result as $data)
	{
	  $email=$data['email'];
	  $role=$data['role'];
          $password=$data['password'];
	  $user_stat=$data['status'];
	
	}
	if($user_stat==0){
		echo "<script type='text/javascript'>alert('Approval is pending');
	window.location='login.php';
	</script>";
	}
  
  else{
	$_SESSION['role']="$role";
	$_SESSION['email']="$email";
	$_SESSION['login_id']="$logid";
	$_SESSION['auth_user']=[
	  'email'=>$email,
      'password'=>$password
	  ];

	if($_SESSION['role']=='seller')
	{
	  $_SESSION['email']= $email;
	  header("location:product.php");
	  exit(0);
	 
	}

	else if($_SESSION['role']=='user')
	{
 $_SESSION['email']= $email;
	 header("Location: shopping/index.php");
	  
	  exit(0);
	}

	
}
  }
	else{
		echo "<script type='text/javascript'>alert('Admin rejected your request');
		window.location='login.php';
		</script>";
		}
  }
?>