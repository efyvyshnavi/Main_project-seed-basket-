<?php
session_start();

include('config.php');

if(isset($_POST['submitted']))
{
	$email= $_POST["email"];
	$newpassword=$_POST["Password"];
	$result = mysqli_query($conn,"SELECT password FROM login WHERE email='$email' AND status='2'");
     
	if(mysqli_num_rows($result)==0)
	  {
		  $_SESSION['wrong'] = " Email does not exists";
	  }
  
	  else{
	  $sql=mysqli_query($conn,"UPDATE login SET login.password='$newpassword'where email='$email'");
	  $_SESSION['change'] = "Password changed successfully";
	  }
	
  }

?>
<!Doctype HTML>
	<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="seller.css" type="text/css"/>
		<link rel="stylesheet" href="pagecss.css" type="text/css"/>
		<link rel="stylesheet" href="header.css" type="text/css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
		<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="mainheader.css" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		
        
	</head>


	<body>
		
		<div id="mySidenav" class="sidenav">
		<center style="color:white;padding:1px;font-size:20px;"><h2>Online Seed Basket</h2></center>
	    <center style="color:white;padding:1px;font-size:20px;"><h3>Seller Panel</h3></center>
		<br>
	      
        
	  <a href="product.php"style="color:white;"class="icon-a"><i class="fa fa-tasks icons"></i>   Insert Product</a>
	  <a href="manageproducts.php"style="color:white;"class="icon-a"><i class="fa fa-list-alt icons"></i>   Manage Products</a>
	  <a href="#"class="icon-a"style="color:white;"><i class="fa fa-list-alt icons"></i>   Manage Users</a>
	  <a href="#" class="icon-a"style="color:white;"><i class="fa fa-shopping-bag icons"></i>   Today's Order</a>
	  <a href="#" class="icon-a"style="color:white;"><i class="fa fa-dashboard icons"></i>   Pending Orders</a>
	  <a href="#" class="icon-a"style="color:white;"><i class="fa fa-dashboard icons"></i>   Delivered Orders</a>
  
	</div>
		
	<header class="site-header">
            <div  class="site-identity">
             
               
            </div>
        
            <nav class="site-navigation">
                <div class="w3-container">
                    <div class="w3-dropdown-hover">
                      <button class="w3-button w3-black">WELCOME SELLER</button>
                      <div class="w3-dropdown-content w3-bar-block w3-border">
                        <a href="page.php" class="w3-bar-item w3-button">Change Password</a>
                        <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
                      </div>
                    </div>
                  </div>
            </nav>
    </header>
<center>

		<div class="cardStyle">
		  <form action="page.php" method="post"onsubmit="return validate();">
			
			<img src="" id="signupLogo"/>
			
			<h2 class="formTitle">
			  Change password
			</h2>

			<div class="inputDiv">
			<label style="font-size:15px;" class="inputLabel" for="password">Enter your Registered email id</label>
			<input type="email" id="email" name="email" required pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$" oninvalid="setCustomValidity('Enter a valid Email !!')" 
                        oninput="setCustomValidity('')">
		  </div>

			
		  <div class="inputDiv">
			<label style="font-size:15px;"class="inputLabel" for="Password">Enter Your New Password</label>
			<input type="password" id="Password" name="Password"required oninvalid="setCustomValidity('Enter a valid password of minimum length 3 !!')" 
                        oninput="setCustomValidity('')" minlength="3">
		  </div>
		  
		  <div class="buttonWrapper">
			<button type="sub" id="sub"name="submitted">
			  <span style="color:black;font-weight:bold">CHANGE</span>
			</button>
		  </div>
			
		</form>
		</div>
	  
</center>
<script>
  <?php
   /**********************index.php**/
   if(isset($_SESSION['change']))
     { 
	?>
	  alertify.set('notifier','position', 'top-center');
     alertify.success('<?= $_SESSION['change'];?>');
   	   <?php
	  unset($_SESSION['change']);
      //if user refresh index.php after 1st time it will not see the message
      }
      ?>
</script>
	
<script>
  <?php
   /**********************index.php**/
   if(isset($_SESSION['wrong']))
     { 
	?>
	  alertify.set('notifier','position', 'top-center');
     alertify.success('<?= $_SESSION['wrong'];?>');
   	   <?php
	  unset($_SESSION['wrong']);
      //if user refresh index.php after 1st time it will not see the message
      }
      ?>
</script>
<script>
	function validate($check) {

    var reg_email = document.getElementById("reg_email");
	var password = document.getElementById("password ");
	var Password  = document.getElementById("Password ");
    
}
</script>
	
	

	</body>


	</html>