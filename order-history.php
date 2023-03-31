<?php
	
	include('config.php');
	session_start();
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

	    <title>My Cart</title>
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

		<!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height, isDelivered) {
  if (popUpWin && !popUpWin.closed) {
    popUpWin.close();
  }
  var options = 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + width + ',height=' + height + ',left=' + left + ',top=' + top + ',screenX=' + left + ',screenY=' + top;
  popUpWin = window.open(URLStr, 'popUpWin', options);
  if (popUpWin) {
    popUpWin.focus();
    popUpWin.document.getElementsByTagName('body')[0].classList.add(isDelivered ? 'delivered' : 'popup');
  }
}
</script>


	</head>
	
		
			<title>cart</title>
			<style>
      .popup {
  font-family: Arial, sans-serif;
  font-size: 14px;
  color: #333;
  background-color: #fff;
  border: 1px solid #ccc;
  box-shadow: 0 2px 4px rgba(0,0,0,0.2);
  padding: 20px;
}
    </style>
			<style>
				#mycart_div{
					display: flex;
				}

				#mycart-table{
					flex: 3;
				}
				
				#mycart-total{
					flex: 1;
					margin-left: 30px;
				}

				#prod_name{
					overflow: hidden;
					width:90%;
					display: -webkit-box;
					-webkit-line-clamp: 1;
					-webkit-box-orient: vertical;
				}
				.form-check-label{
					margin-left: -25px;
					font-family: monospace;
					font-size: 20px;
				}
				#cartupdate{
					margin-top: -4px;
				}
				
				

			</style>
			<style type='text/css'>
table {
  width: 100%;
  background:#FBFBFB;
  border: 2px solid #C5B798;
  margin-top: 15px;
  margin-bottom: 25px;
}
td {
	border-bottom: 1px solid #CDC1A7;
  padding: 50px;
}
th {
  font-family: "Trebuchet MS", Arial, Verdana;
  font-size: 25px;
  padding: 5px;
  border-bottom-width: 1px;
  border-bottom-style: solid;
  border-bottom-color: #CDC1A7;
  background-color: #CDC1A7;
  color: black;
}
tr{
	font-size: 16px;
}
</style>
<style>
.order-date {
    white-space: normal;
    word-wrap: break-word;
}
</style>


		</head>
		<body class="cnt-home">
	
			
	
	<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">
<?php include('includes/top-header.php');?>
<?php include('includes/main-header.php');?>
<?php include('includes/menu-bar.php');?>

</header>
<!-- ============================================== HEADER : END ============================================== -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="index.php">Home</a></li>
				<li class='active'>Shopping Cart</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
	<div class="container">
	<div class="row inner-bottom-sm">
	<div class="shopping-cart">
	<h2 class="center"style="text-align:center;font-weight:bold;color:#84b943;">My Orders</h2>
				<div class="col-md-12 col-sm-12 shopping-cart-table ">
	<div class="table-responsive">
<form name="cart" method="post">	

		<table class="table table-bordered">
			<thead>
				<tr>
											<th style="background-color:#FFFFFF" scope="col">Sr.No.</th>
											<th style="background-color:#FFFFFF" scope="col">Image</th>
											<th style="background-color:#FFFFFF" scope="col">Item Name</th>
											<th style="background-color:#FFFFFF" scope="col">Price Per Unit</th>
											<th style="background-color:#FFFFFF" scope="col">Payment Method</th>
											<th style="background-color:#FFFFFF" scope="col">Quantity</th>
											<th style="background-color:#FFFFFF" scope="col">Total</th>
											<th style="background-color:#FFFFFF" scope="col">Order Date</th>
											<th style="background-color:#FFFFFF" scope="col">Action</th>
											</tr>
									</thead>
									<tfoot>
				<tr>
					<td colspan="7">
						<div class="shopping-cart-btn">
							<span class="">
								<a href="index.php"style = "position:relative; left:250px;background-color:#abd07e" class="btn btn-upper btn-primary pull-right outer-right-xs">Continue Shopping</a>
								
								
							</span>
						</div><!-- /.shopping-cart-btn -->
					</td>
				</tr>
			</tfoot>
									<tbody class="text-center" style="background-color:#FFFFFF">
										<?php
										$email=$_SESSION['email'];

										$sqlq="SELECT logid from login where email='$email'";
										$resu = mysqli_query($con, $sqlq);
										$row = mysqli_fetch_assoc($resu);
										$logid= $row['logid'];
										
											$all_total=0;
											$sr=0;

											$sql1 = "SELECT payid FROM tbl_payment WHERE logid='$logid'";
$res1 = mysqli_query($con, $sql1);


while ($row = mysqli_fetch_assoc($res1)) {
    $payid = $row['payid'];
	
    $sql2 = "SELECT o.orderid, o.orderDate, c.pid, c.quantity FROM orders o JOIN tbl_cart c ON o.orderid=c.orderid WHERE o.payid='$payid'";
    $res2 = mysqli_query($con, $sql2);
    while ($row2 = mysqli_fetch_assoc($res2)) {
        $orderids[] = array(
            'orderid' => $row2['orderid'],
            'orderDate' => $row2['orderDate'],
            'pid' => $row2['pid'],
            'quantity' => $row2['quantity']
        );
    }
}

$sr = 1;
foreach ($orderids as $order) {
    $orderid = $order['orderid'];
    $date = $order['orderDate'];
    $pid_array = array();
    $total_quantity = 0;
    $total_price = 0;

    $cart_sql = mysqli_query($con, "SELECT pid, quantity FROM tbl_cart WHERE orderid = $orderid");

    while ($cart_res = mysqli_fetch_array($cart_sql)) {
        $pid_array[] = array('pid' => $cart_res['pid'], 'quantity' => $cart_res['quantity']);
        $total_quantity += $cart_res['quantity'];
    }

    foreach ($pid_array as $product) {
        $pid = $product['pid'];
        $quantity = $product['quantity'];
        $prod_sql = mysqli_query($con, "SELECT * FROM tbl_product WHERE pid = $pid");

        if (mysqli_num_rows($prod_sql) == 1) {
            $prod_details_res = mysqli_fetch_array($prod_sql);
            $each_total = $quantity * $prod_details_res['price2'];
            $total_price += $each_total;

            echo "
                <tr>
                    <td>$sr</td>
                    <td><img src='../images/".$prod_details_res['image']."' alt='Product Image' width='120' height='142'></td>
                    <td><p id='prod_name' style='font-family:FjallaOneRegular;font-size: 17px;text-transform: uppercase'>".$prod_details_res['pname']."</p></td>
                    <td>".$prod_details_res['price2']."</td>
                    <td><p>Online Banking</p></td>
                    <td><p id='prod_name'>".$quantity."</p></td>
                    <td><p id='prod_name'>".$each_total."</p></td>
					<td class='order-date'>";
					$datetime = explode(' ', $date);
					echo "<p id='date'>" . $datetime[0] . "</p>";
					echo "<p id='time'>" . $datetime[1] . "</p>";
				echo "</td>
                   
				<td>
				<a href='javascript:void(0);' onClick='popUpWindow(\"track-order.php?oid=" . htmlentities($orderid) . "\");' title='Track order'>Track</a>
			</td>
                </tr>
            ";
            ++$sr; 
        }
    }
   
}

										?>
								
									</tbody>

								</table>
								<!-- <form action="deliveryform.php" method="POST"> -->

                                



							<script>
								
								var iquantity=document.getElementsByClassName('quantity');
								function
								</script>


									
	</div>
</div><!-- /.shopping-cart-table -->	
<br>

</form>
<?php include('includes/footer.php');?>

	

								<script>
//   console.log("hello");
// var amt ="100";
    function pay_now(){
		var name = jQuery('#name1').val();
		console.log(name);
		
        var amount=<?php echo $all_total ?>;
        var options =  {
            "key": "rzp_test_EM7mP7PTRdcw92", // Enter the Key ID generated from the Dashboard
            "amount": amount*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
            "currency": "INR",
            "name": "Art Gallery",
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
						</body>
					</html>