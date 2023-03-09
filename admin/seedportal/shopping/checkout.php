<?php
	
	include('config.php');
	session_start();

	$email=$_SESSION['email'];
	$sqlq="SELECT logid from login where email='$email'";
$resu = mysqli_query($con, $sqlq);
$row = mysqli_fetch_assoc($resu);
$logid= $row['logid'];

$sql = mysqli_query($con,"SELECT userid from userreg where logid='$logid'");
while($row=mysqli_fetch_array($sql)){
  $userid = $row['userid'];
}
if(isset($_POST['up'])) 
// code for billing address updation
{
  $name=$_POST['name'];
	$baddress=$_POST['shippingaddress'];
	$bcity=$_POST['shippingcity'];
	$bpincode=$_POST['shippingpincode'];
  $phone=$_POST['phone'];
	$query=mysqli_query($con,"update tbl_address set userid='$userid', shipname='$name',shippingAddress='$baddress',shippingCity='$bcity',shippingPincode='$bpincode',shipphone='$phone' where userid='$userid'");
	if($query)
	{
    echo "<script>
    alert('Address updated');
    window.location.href='payment-method.php';
</script>";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">


	<!-- Demo CSS (No need to include it into your project) -->
	<link rel="stylesheet" href="css/demo.css">
  
  
  </head>
  <body>
 
  
 <main>

     <!-- DEMO HTML -->
     <div class="container">
  <div class="py-5 text-center">
    
    <h2>Checkout form</h2>
  </div>

  <?php
	$email=$_SESSION['email'];
	$sqlq="SELECT logid from login where email='$email'";
$resu = mysqli_query($con, $sqlq);
$row = mysqli_fetch_assoc($resu);
$logid= $row['logid'];

$sql = "SELECT pid from tbl_cart where logid='$logid'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$pid= $row['pid'];


$query=mysqli_query($con,"select * from tbl_product where pid='$pid'");
if(mysqli_num_rows($query) > 0) {
  while($row=mysqli_fetch_array($query)) {
?>
  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Your cart</span>
        <span class="badge badge-secondary badge-pill">3</span>
      </h4>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
          <h6 class="my-0"><?php echo htmlentities($row['pname']);?></h6>
            <small class="text-muted">Brief description</small>
          </div>
          <span class="text-muted">$12</span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">Second product</h6>
            <small class="text-muted">Brief description</small>
          </div>
          <span class="text-muted">$8</span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">Third item</h6>
            <small class="text-muted">Brief description</small>
          </div>
          <span class="text-muted">$5</span>
        </li>
        <li class="list-group-item d-flex justify-content-between bg-light">
          <div class="text-success">
            <h6 class="my-0">Promo code</h6>
            <small>EXAMPLECODE</small>
          </div>
          <span class="text-success">-$5</span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (USD)</span>
          <strong>$20</strong>
        </li>
      </ul>

<?php
}}?>
      <form class="card p-2">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Promo code">
          <div class="input-group-append">
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Billing address</h4>
      <?php
$_SESSION['email']=$email;
$sqlq="SELECT logid from login where email='$email'";
$resu = mysqli_query($con, $sqlq);
$row = mysqli_fetch_assoc($resu);
$logid= $row['logid'];

$sql = mysqli_query($con,"SELECT userid from userreg where logid='$logid'");
while($row=mysqli_fetch_array($sql)){
  $userid = $row['userid'];
}

$query=mysqli_query($con,"select * from tbl_address where userid='$userid'");
if(mysqli_num_rows($query) > 0) {
  while($row=mysqli_fetch_array($query)) {
?>
    <form method="POST" action="checkout.php">
      <div class="mb-3">
        <label for="firstName">Enter name</label>
        <input type="text" style="height:50px" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $row['shipname'];?>" >
      </div>

      <div class="mb-3">
        <label for="username">Shipping Address</label>
        <input type="text" style="height:50px" class="form-control" id="username" name="shippingaddress" placeholder="Address" value="<?php echo $row['shippingAddress'];?>" >
      </div>

      <div class="mb-3">
        <label for="email">Shipping City</span></label>
        <input type="text" class="form-control" id="email" name="shippingcity" style="height:50px" placeholder="City" value="<?php echo $row['shippingCity'];?>">
      </div>

      <div class="mb-3">
        <label for="address">Shipping Pincode</label>
        <input type="text" class="form-control" id="address" name="shippingpincode" placeholder="Pincode" value="<?php echo $row['shippingPincode'];?>" >
      </div>

      <div class="mb-3">
        <label for="address2">Contact no</span></label>
        <input type="text" class="form-control" id="address2" style="height:50px" name="phone" placeholder="Contact no" value="<?php echo $row['shipphone'];?>" >
      </div>

      <hr class="mb-4">
      <button class="btn btn-primary"type="submit" name="up">PROCEED TO CHECKOUT</button>
    </form>
  <?php
  }
} else {
?>
  <form method="POST" action="checkout.php">
    <div class="mb-3">
      <label for="firstName">Enter name</label>
      <input type="text" style="height:50px" class="form-control" id="name" name="name" placeholder="Name" value="" >
    </div>

    <div class="mb-3">
      <label for="username">Shipping Address</label>
      <input type="text" style="height:50px" class="form-control" id="username" name="shippingaddress" placeholder="Address" value="" >
    </div>

    <div class="mb-3">
      <label for="email">Shipping City</span></label>
      <input type="text" class="form-control" id="email name="shippingcity" style="height:50px" placeholder="City" value="">
      </div>

      
      <div class="mb-3">
        <label for="address">Shipping Pincode</label>
        <input type="text" class="form-control" id="address" name="shippingpincode" placeholder="Pincode" value="" >
      </div>

      <div class="mb-3">
        <label for="address2">Contact no</span></label>
        <input type="text" class="form-control" id="address2" style="height:50px" name="phone" placeholder="Contact no" value="" >
      </div>

      <hr class="mb-4">
      <button class="btn btn-primary btn-lg btn-block" type="submit" name="up">Continue to checkout</button>
    </form>
  <?php
}?>


    </div>
  </div>

</div>
     <!-- End Demo HTML -->
     
 </main>
 
<!-- Bootstrap 5 JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  </body>
</html>