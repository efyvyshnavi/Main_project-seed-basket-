<?php
session_start();
error_reporting(0);
include("include/config.php");
if(isset($_POST['submit']))
{
	$username=$_POST['username'];
	$password=$_POST['password'];
    $email=$_POST['email'];
    $images=$_FILES["images"]["name"];
    $phone=$_POST['phoneno'];
    $targetFilePath = $targetDir. $images;
    move_uploaded_file($_FILES["images"]["tmp_name"],$targetFilePath);
    $sql="select * from login  where (email='$email');";

    

    $res=mysqli_query($conn,$sql);

    if (mysqli_num_rows($res) > 0) {
      
      $row = mysqli_fetch_assoc($res);
      if($email==isset($row['email']))
      {
        $_SESSION['seller'] = "This Seller account already exists. Login to continue";
      }
  
      }
  else{
    
    $sql3 = "INSERT INTO login (email,password,role,status) VALUES ('$email','$password','seller',0) ";
    $result = $conn->query($sql3);
   if($result)
   {
     $logid = $conn->insert_id;
     $sql4 = "INSERT INTO sellerreg (fname,phoneno,file_name,logid,status) VALUES ('$fname','$phone','$images','$logid',1) ";
     $result = $conn->query($sql4);
     echo "<script type='text/javascript'>alert('Wait for admin approval.Try again after a while and login to continue');
	window.location='sellerreg.php';
	</script>";
   }
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Shopping Portal | Admin login</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
					<i class="icon-reorder shaded"></i>
				</a>

			  	<a class="brand" href="index.html">
			  		Shopping Portal | Admin
			  	</a>

				<div class="nav-collapse collapse navbar-inverse-collapse">
				
					<ul class="nav pull-right">

						<li><a href="http://localhost/shopping/">
						Back to Portal
						
						</a></li>

						

						
					</ul>
				</div><!-- /.nav-collapse -->
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->



	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="module module-login span4 offset4">
					<form class="form-vertical" method="post">
						<div class="module-head">
							<h3>Sign Up</h3>
						</div>
						<span style="color:red;" ><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
						<div class="module-body">
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" type="text" id="inputEmail" name="username" placeholder="Username">
								</div>
							</div>
							<div class="control-group">
								<div class="controls row-fluid">
						<input class="span12" type="password" id="inputPassword" name="password" placeholder="Password">
								</div>
							</div>

                            <div class="control-group">
								<div class="controls row-fluid">
						<input class="span12" type="password" id="inputPassword" name="cpassword" placeholder="Confirm Password">
								</div>
							</div>

                            <div class="control-group">
								<div class="controls row-fluid">
						<input class="span12" type="email" id="inputPassword" name="email" placeholder="Email">
								</div>
							</div>
                            <div class="control-group">
								<div class="controls row-fluid">
						<input class="span12" type="text" id="inputPassword" name="phoneno" placeholder="Phone no">
								</div>
							</div>
                            <div class="control-group">
								<div class="controls row-fluid">
						<input class="span12" type="file" id="inputPassword" name="images" placeholder="Proof">
								</div>
							</div>
						</div>
						<div class="module-foot">
							<div class="control-group">
								<div class="controls clearfix">
									<button type="submit" class="btn btn-primary pull-right" name="submit">Login</button>
									
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--/.wrapper-->

	<div class="footer">
		<div class="container">
			 

			<b class="copyright">&copy; 2017 Shopping Portal </b> All rights reserved.
		</div>
	</div>
	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>