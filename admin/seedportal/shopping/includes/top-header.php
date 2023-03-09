<?php 
//session_start();

?>

<div class="top-bar animate-dropdown">
	<div class="container">
		<div class="header-top-inner">
			<div class="cnt-account">
				<ul class="list-unstyled">



					<li><a href="#"><i class="icon fa fa-user"></i>My Account</a></li>
					<li><a href="wishlist.php"><i class="icon fa fa-heart"></i>Wishlist</a></li>
					<li class="bi bi-bell"><a href="my-cart.php"><i class="icon fa fa-shopping-cart"></i>My Cart
					
					<span class="badge badge-secondary">
						   <?php      
						 $email=$_SESSION['email'];
	$sqlq="SELECT logid from login where email='$email'";
$resu = mysqli_query($con, $sqlq);
$row = mysqli_fetch_assoc($resu);
$logid= $row['logid'];

						 // retrieve the count of pending requests
						 $sql = "SELECT COUNT(*) AS count FROM tbl_cart where logid='$logid'";
						 $result = mysqli_query($con, $sql);
						 $row = mysqli_fetch_assoc($result);
						 $count = $row['count'];
						 
						 // display the notification badge
						 if ($count > 0) {
						   echo "$count";}
						   else{
							 echo "Empty";
						   }
						   ?>
						 
						   </span>
						 
						 </a><!-- End Notification Icon -->
						 
								 
							   </li><!-- End Tables Nav -->
						 
							   
							  
   
<li><a href="order-history.php"><i class="icon fa fa-sign-in"></i>Login</a></li>

	
				<li><a href="../logout.php"><i class="icon fa fa-sign-out"></i>Logout</a></li>
				<?php ?>	
				</ul>
			</div><!-- /.cnt-account -->

<div class="cnt-block">
				<ul class="list-unstyled list-inline">
					<li class="dropdown dropdown-small">
						<a href="#" class="dropdown-toggle" ><span class="key">Track Order</b></a>
						
					</li>

				
				</ul>
			</div>
			
			<div class="clearfix"></div>
		</div><!-- /.header-top-inner -->
	</div><!-- /.container -->
</div><!-- /.header-top -->