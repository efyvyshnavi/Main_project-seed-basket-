<?php 
session_start();
error_reporting(0);
include('includes/config.php');
$tp=$_SESSION['tp'];
$email=$_SESSION['email'];

$sqlq="SELECT logid from login where email='$email'";
$resu = mysqli_query($con, $sqlq);
$row = mysqli_fetch_assoc($resu);
$logid= $row['logid'];


$sql = mysqli_query($con,"SELECT * from tbl_cart where logid='$logid'");
while($row=mysqli_fetch_array($sql)){
  $cartid = $row['cart_id'];
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

	    <title>Shopping Portal | Payment Method</title>
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/green.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
		<link href="assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
		<link rel="stylesheet" href="assets/css/config.css">
		<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="assets/images/favicon.ico">
		<link rel="stylesheet" href="pagecss.css" type="text/css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-WzMlUeJdSkQl+U6C15U6wJhKzR54AaASXV7+ZL1n/pVfo+f83HYKc+V7thuPAwHsV7RLs4hYXgCZuotzb0/7Vw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

		<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

		<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 5px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow-x: hidden; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

.modal-content {
    position: relative;
    background-color: #fff0;
}


.close {
  position: absolute;
  right: 500px;
  top: 100px;
  width: 32px;
  height: 32px;
  opacity: 0.6;
  font-size: 33px;
  font-weight: bold;
  color:red;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}


* {
  box-sizing: border-box;
}

form.example input[type=text] {
  padding: 7px;
  font-size: 18px;
  border: 2px solid grey;
  float: left;
  width: 70%;
  background: #f1f1f1;
}

form.example button {
  float: left;
  width: 20%;
  padding: 9px;
  background: #3630a3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
}
form.example button:hover {
  background: #0b7dda;
}

form.example::after {
  content: "";
  clear: both;
  display: table;
}
</style>

<style>
#myBtn {
  background-color: #000080; /* set background color */
  color: white; /* set text color */
  font-weight:bold;
  font-size: 16px; /* set font size */
  border: none; /* remove border */
  padding: 12px 24px; /* set padding */
 
  position: relative; /* set position */
  left: 420px; /* move button to the right */
  top: -45px; /* move button up */
  cursor: pointer; /* add pointer cursor */
}
#myBtn:hover {
    background-color: #abd07e; /* set the background color to the same color as normal */
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.25); /* add box shadow */
  }

 
</style>
<input type="hidden" id="name1" value="<?php echo $email; ?>">


	</head>
    <body class="cnt-home">
		
<header class="header-style-1">
<?php include('includes/top-header.php');?>
<?php include('includes/main-header.php');?>
<?php include('includes/menu-bar.php');?>
</header>
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="index.php">Home</a></li>
				<li class='active'>Payment Method</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-bd">
	<div class="container">
		<div class="checkout-box faq-page inner-bottom-sm">
			<div class="row">
				<div class="col-md-12">
					<h2>Place Your Order</h2>
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
<div class="panel panel-default checkout-step-01">

	<!-- panel-heading -->
		<div class="panel-heading">
    	<h4 class="unicase-checkout-title">
	        <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
	         cONFIRMATION
	        </a>
	     </h4>
    </div>
    <!-- panel-heading -->
	<div id="collapseOne" class="panel-collapse collapse in">

<!-- panel-heading -->

<div id="collapseOne" class="panel-collapse collapse in">

	<!-- panel-body  -->
	<div class="panel-body">
	
	</div>
		<!-- panel-body  -->
		<button class="btn btn-primary" style="position:relative;left:420px;top:-45px;color:white;font-size:16px;" id="myBtn">
  <span style="margin-right: 5px;"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
  CONFIRM AND PROCEED TO PAYMENT
</button>

<?php
$sqlq="SELECT logid from login where email='$email'";
$resu = mysqli_query($con, $sqlq);
$row = mysqli_fetch_assoc($resu);
$logid= $row['logid'];
?>


<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>

	<center>
	<?php 
	$email=$_SESSION['email'];

	$sqlq="SELECT logid from login where email='$email'";
	$resu = mysqli_query($con, $sqlq);
	$row = mysqli_fetch_assoc($resu);
	$logid= $row['logid'];

	$sql = mysqli_query($con,"SELECT userid from userreg where logid='$logid'");
	while($row=mysqli_fetch_array($sql)){
	  $userid = $row['userid'];
	}
	
	
$sqll=mysqli_query($con,"SELECT * FROM tbl_address where userid='$userid'");
$cnt=1;
while($row=mysqli_fetch_array($sqll))
{
?>
<form action="#" method="post">
      <div class="cardStyle">
			<h2 class="formTitle">
			 Order Details
			</h2>
              <br><br>  
			
		  <div class="inputDiv">
		  <b><td><p style="font-family:Arial;font-size:20px">Name : </b><?php echo htmlentities($row['shipname']);?></p></td>
		  </div><br>
		   
			
		  <div class="inputDiv">
		  <b><td><p style="font-family:Arial;font-size:20px">Address : </b><?php echo htmlentities($row['shippingAddress']);?>,<?php echo htmlentities($row['shippingCity']);?>,<?php echo htmlentities($row['shippingPincode']);?></p></td>
		  </div><br>

		  <div class="inputDiv">
		 <b> <td><p style="font-family:Arial;font-size:20px">Contact No: </b><?php echo htmlentities($row['shipphone']); ?></p></td>
		  </div><br>

		  <div class="inputDiv">
		 <b> <td><p style="font-family:Arial;font-size:20px">Total amount: </b><?php echo htmlentities($tp); ?>&nbspRs</p></td>
		  </div><br>

          
		<!-- panel-body  -->
	  
		<div class="inputDiv">
		 <b> <td><p style="font-family:Arial;font-size:20px"> Payment method</p></td>
	     <p> Internet Banking</p>
	    
		</div>
		<!-- panel-body  -->
	  
		  <div class="buttonWrapper">
		    
<!--<input class="btn btn-primary"style="background-color:#abd07e"type="button" id="rzp-button1"value="PAY NOW"onclick="pay_now()"/>--> 
<input class="btn btn-primary"style="background-color:#abd07e"type="button" id="rzp-button2"value="PAY NOW"onclick="pay_now()"/>
		    
      </div>
	 
	  <?php $cnt=$cnt+1; } ?>	
	  
	  </center>  
  </div>
</div>


<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the span element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on span (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>


	</div><!-- row -->
</div>
<!-- checkout-step-01  -->
					  
					  	
					</div><!-- /.checkout-steps -->
				</div>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->





		
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->

<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div><!-- /.body-content -->
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

	
	<script>
//   console.log("hello");
// var amt ="100";
    function pay_now(){
		var name = jQuery('#name1').val();
		console.log(name);
		
        var amount=<?php echo $tp ?>;
        var options =  {
            "key": "rzp_test_EM7mP7PTRdcw92", // Enter the Key ID generated from the Dashboard
            "amount": amount*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
            "currency": "INR",
            "name": "Online Seed Basket",
            "description": "Test Transaction",
            "image": "https://example.com/your_logo",
            "handler":function(response){
              
               jQuery.ajax({
                   type:"POST",
                   url: "payment_process.php",
                   data:"payment_id="+response.razorpay_payment_id+"&amount="+amount+"&name="+name,
                   success:function(result){
                       window,location.href="thankyou.php";
                   }
               });
              
      }
        
    
};
var rzp1 = new Razorpay(options);

    rzp1.open();
    
    }
</script>


<script>
  const input1 = document.getElementById('input1');
  const input2 = document.getElementById('rzp-button2');
  
  input1.addEventListener('change', function() {
    if (input1.value === 'some value') {
      input2.disabled = false;
    } else {
      input2.disabled = true;
    }
  });
</script>

</body>
</html>

