<?php  
session_start();
include('config.php');

    if(isset($_POST['sub'])) 
    {  

     $username=$_POST['username'];
     $lastname=$_POST['lastname'];
     $email=$_POST['email'];
     $password_2=$_POST['password_2'];
     
     $sql="select * from login where (email='$email');";

      $res=mysqli_query($con,$sql);

      if (mysqli_num_rows($res) > 0) {
        
        $row = mysqli_fetch_assoc($res);
        if(($email==isset($row['email'])))
        {
            $_SESSION['status'] = "You already have an account.Login to continue";
			echo "<script>
                    alert('You already have an account.Login to continue');
                        window.href=location='login.php';
                    </script>"; 
          
        }
	
		}
    else{
    $sql2 = "INSERT INTO login (email,password,role,status) VALUES ('$email','$password_2','user',1)";
		$result = $con->query($sql2);
		
	if($result)
		{
		$logid= $con->insert_id;
		$sql1 = "INSERT INTO userreg (firstname,contactno,logid) VALUES ('$username','$lastname','$logid')";  
		$result = $con->query($sql1);
		echo "<script>
                    alert('Account created successfully.Login to continue');
                        window.href=location='login.php';
                    </script>"; 
	} 
  else{
		$message = "error";
}
    }
  }
  
  

  if(isset($_POST['subm']))
{
  $email=$_POST["email"];
  $password=($_POST["password_2"]);
 

  $sqlquery="SELECT email,password,role,status,logid from login where (email='$email' and password='$password')and status!=-1";
  $result = mysqli_query($con, $sqlquery);
  $_SESSION['email']=$email;
  if (mysqli_num_rows($result) >0){
	echo "<script>
		window.href=location='my-cart.php';
	</script>"; 
} 
	  
	  exit(0);
	}



?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">

	    <title>Shopping Portal | Signi-in | Signup</title>

	    <!-- Bootstrap Core CSS -->
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    
	    <!-- Customizable CSS -->
	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/green.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
		<link href="assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

		<!-- Demo Purpose Only. Should be removed in production -->
		<link rel="stylesheet" href="assets/css/config.css">

		<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		<!-- Demo Purpose Only. Should be removed in production : END -->

		
		<!-- Icons/Glyphs -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

        <!-- Fonts --> 
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/favicon.ico">
<script type="text/javascript">
function valid()
{
 if(document.register.password.value!= document.register.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.register.confirmpassword.focus();
return false;
}
return true;
}
</script>
    	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>



	</head>
    <body class="cnt-home">
	
		
	
		<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

	<!-- ============================================== TOP MENU ============================================== -->
<?php include('includes/top-header.php');?>
<!-- ============================================== TOP MENU : END ============================================== -->
<?php include('includes/main-header.php');?>
	<!-- ============================================== NAVBAR ============================================== -->
<?php include('includes/menu-bar.php');?>
<!-- ============================================== NAVBAR : END ============================================== -->

</header>

<!-- ============================================== HEADER : END ============================================== -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Authentication</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-bd">
	<div class="container">
		<div class="sign-in-page inner-bottom-sm">
			<div class="row">
				<!-- Sign-in -->			
<div class="col-md-6 col-sm-6 sign-in">
	<h4 class="">sign in</h4>
	<p class="">Hello, Welcome to your account.</p>
	<form  method="post"action="login.php">

	</span>
		<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
		    <input type="email"class="form-control unicase-form-control text-input"id="email"name="email" >
			<span id="email-error" class="hide required-color error-message">Invalid Email</span>
          <span id="empty-email" class="hide required-color error-message">Email Cannot Be Empty</span>
		</div>
	  	<div class="form-group">
		    <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
		 <input type="password" class="form-control unicase-form-control text-input"id="password"name="password_2" >
		 <span id="password-error" class="hide required-color error-message">Invalid input</span>
          <span id="empty-password" class="hide required-color error-message"> Password Cannot Be Empty</span>
		</div>
		<div class="radio outer-xs">
		  	<a href="forgot-password.php" class="forgot-password pull-right">Forgot your Password?</a>
		</div>
	  	<button type="submit" id="submit-button"name="subm"value="subm"class="btn-upper btn btn-primary checkout-page-button">Login</button>
	</form>					
</div>
<!-- Sign-in -->

<!-- create a new account -->
<div class="col-md-6 col-sm-6 create-new-account">
	<h4 class="checkout-subtitle">create a new account</h4>
	<p class="text title-tag-line">Create your own Shopping account.</p>
	<form class="register-form outer-top-xs" role="form" method="post" name="register" onSubmit="return valid();">
<div class="form-group">
	    	<label class="info-title" for="fullname">Full Name <span>*</span></label>
	    	<input type="text" class="form-control unicase-form-control text-input"id="first-name-input"name="username"required="required">
			<span id="first-name-error" class="hide required-color error-message">Input must be a character of length more than 2</span>
			<span id="empty-first-name" class="hide required-color error-message">First Name Cannot Be Empty</span>
		</div>


		<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
		    <input type="email"class="form-control unicase-form-control text-input"id="email"name="email" >
			<span id="email-error" class="hide required-color error-message">Invalid Email</span>
          <span id="empty-email" class="hide required-color error-message">Email Cannot Be Empty</span>
		</div>
	

<div class="form-group">
	    	<label class="info-title" for="contactno">Contact No. <span>*</span></label>
	    	<input type="text" class="form-control unicase-form-control text-input"id="last-name-input"name="lastname" maxlength="10" required >
			<span id="empty-last-name" class="hide required-color error-message">Contact no cannot be empty</span>
			<span id="last-name-error" class="hide required-color error-message">Contact number must be of 10 digits</span>
		</div>

<div class="form-group">
	    	<label class="info-title" for="password">Password. <span>*</span></label>
	    	<input type="password" class="form-control unicase-form-control text-input"  id="password"name="password_2" required >
			<span id="password-error" class="hide required-color error-message">Must contain at least one number,one uppercase,lowercase letter and aleast 5 characters</span>
			<span id="password-error" class="hide required-color error-message">
            Must contain at least one number,one uppercase,lowercase letter and aleast 5 characters</span>
          <span id="empty-password" class="hide required-color error-message">Password Cannot Be Empty</span>
		</div>

<div class="form-group">
	    	<label class="info-title" for="confirmpassword">Confirm Password. <span>*</span></label>
	    	<input type="password" class="form-control unicase-form-control text-input" id="verify-password"required >
			<span
            id="verify-password-error"
            class="hide required-color error-message" >Should Be Same As Previous Password</span>
          <span
            id="empty-verify-password"
            class="hide required-color error-message">Password Cannot Be Empty</span>
		</div>


	  	<button id="submit-button"name="sub"value="sub" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
	</form>
	<span class="checkout-subtitle outer-top-xs">Sign Up Today And You'll Be Able To :  </span>
	<div class="checkbox">
	  	<label class="checkbox">
		  	Speed your way through the checkout.
		</label>
		<label class="checkbox">
		Track your orders easily.
		</label>
		<label class="checkbox">
 Keep a record of all your purchases.
		</label>
	</div>
</div>	
<!-- create a new account -->			</div><!-- /.row -->
		</div>
<?php include('includes/brands-slider.php');?>
</div>
</div>
<?php include('includes/footer.php');?>
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	
	<script src="assets/js/bootstrap.min.js"></script>
	
	<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>
	
	<script src="assets/js/echo.min.js"></script>
	<script src="assets/js/jquery.easing-1.3.min.js"></script>
	<script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="assets/js/lightbox.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
	<script src="assets/js/scripts.js"></script>

	<script src="script.js"></script>
	<script src="log.js"></script>

	<!-- For demo purposes – can be removed on production -->
	
	<script src="switchstylesheet/switchstylesheet.js"></script>
	
	<script>
		$(document).ready(function(){ 
			$(".changecolor").switchstylesheet( { seperator:"color"} );
			$('.show-theme-options').click(function(){
				$(this).parent().toggleClass('open');
				return false;
			});
		});

		$(window).bind("load", function() {
		   $('.show-theme-options').delay(2000).trigger('click');
		});
	</script>
	<!-- For demo purposes – can be removed on production : End -->

	

</body>
</html>