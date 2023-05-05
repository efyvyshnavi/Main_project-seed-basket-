<?php
session_start();
include ('config.php');
date_default_timezone_set('Asia/Kolkata');// 
$currentTime = date( 'Y-m-d');
if (isset($_SESSION['db_id'])) {
    $db_id = $_SESSION['db_id'];
    // Do something with $db_id
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin-Online Seed Basket</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
		<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
    
    <style>
  .edit-btn {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 8px 16px;
  border-radius: 4px;
  font-size: 18px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.edit-btn:hover {
  background-color: #0062cc;
}
.edit-btn {
  font-size: 15px; /* change the font size */
  padding: 8px 12px; /* change the padding */
}
.edit-btn {
  height: 31px;
  width: 78px;
  text-align: center;
}

</style>

 
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Online Seed Basket</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

             

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">
            <?php
if(isset($_SESSION['username'])){
    echo $_SESSION['username'];
} 
?>
            </span>
            
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
            <?php $query=mysqli_query($conn,"select full_name,job from admin");

while($row=mysqli_fetch_array($query))
{
?>	
              <h6><?php echo htmlentities($row['full_name']);?></h6>
              <span><?php echo htmlentities($row['job']);?></span>
              <?php  } ?>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="admin-profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

          
            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">


<li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav"  data-bs-toggle="collapse" href="#">
          <i class="bi bi-patch-exclamation-fill"></i><span>Order Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

          <li>
            <a href="pending orders.php">
              <i class="bi bi-circle"></i><span>Pending Orders</span>
            </a>
          </li>
          <li>
            <a href="rev.php">
              <i class="bi bi-circle"></i><span>Delivered Orders</span>
            </a>
          </li>
         
        </ul>
      </li><!-- End Charts Nav -->

      

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" href="product.php">
          <i class="bi bi-journal-text"></i><span>Order Details</span>
        </a>
        
</li>

<li class="nav-item">
        <a class="nav-link nav-icon" data-bs-target="#tables-nav"href="deliverboy.php">
  
          <i class="bi bi-bell"></i><span>Deliveryboy requests</span>&nbsp 
                           
  <span class="badge bg-primary badge-number">
  <?php      

// retrieve the count of pending requests
$sql = "SELECT COUNT(*) AS count FROM sellerreg WHERE status = '1'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$count = $row['count'];

// display the notification badge
if ($count > 0) {
  echo "$count";}
  else{
    echo "no new notification";
  }
  ?>

  </span>

</a><!-- End Notification Icon -->

        
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link nav-icon" data-bs-target="#tables-nav"href="approve.php">
  
          <i class="bi bi-bell"></i><span>Pending requests</span>&nbsp 
                           
  <span class="badge bg-primary badge-number">
  <?php      

// retrieve the count of pending requests
$sql = "SELECT COUNT(*) AS count FROM sellerreg WHERE status = '1'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$count = $row['count'];

// display the notification badge
if ($count > 0) {
  echo "$count";}
  else{
    echo "no new notification";
  }
  ?>

  </span>

</a><!-- End Notification Icon -->

        
      </li><!-- End Tables Nav -->

      
      
      <li class="nav-item">
        <a class="nav-link nav-icon" data-bs-target="#tables-nav"href="message.php">
  
        <i class="bi bi-envelope-fill"></i><span>New Message</span>  &nbsp                         
  <span class="badge bg-primary badge-number">
  <?php      

// retrieve the count of pending requests
$sql = "SELECT COUNT(*) AS count FROM tbl_requests where status='Pending'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$count = $row['count'];

// display the notification badge
if ($count > 0) {
echo "$count";}
else{
  echo "no new notification";
}
?>

  </span>

</a><!-- End Notification Icon -->

        
      </li><!-- End Tables Nav -->

      
      <li class="nav-item">
        <a class="nav-link nav-icon" data-bs-target="#tables-nav"href="payment.php">
  
        <i class="bi bi-currency-dollar"></i><span>Payments</span>  &nbsp                        
  <span class="badge bg-primary badge-number">
  
  <?php
// retrieve the count of pending requests
$sql = "SELECT tbl_pay.timestamp FROM tbl_pay INNER JOIN sellerreg ON tbl_pay.sellerid = sellerreg.sellerid 
WHERE tbl_pay.pay_status = 'completed'";
$result = mysqli_query($conn, $sql);

$new_payments_count = 0; // initialize count variable to 0

while($row = mysqli_fetch_array($result)) {
    $today = date('Y-m-d');
    $payment_date = substr($row['timestamp'], 0, 10); // assuming the timestamp format is "YYYY-MM-DD HH:MM:SS"
    
    if ($today == $payment_date) {
      $new_payments_count++; // increment count variable
    }
}

if ($new_payments_count > 0) {
  echo $new_payments_count;
} else {
  echo "no new notification";
}
?>



  </span>

</a><!-- End Notification Icon -->

        
      </li><!-- End Tables Nav -->

      

      
      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="admin-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="report1.php">
          <i class="bi bi-list-check"></i>
          <span>Report</span>
        </a>
      </li><!-- End Profile Page Nav -->


    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Orders</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Orders</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    


    <section class="section dashboard">
      <div class="row">

                
                </div>

              </div>
            </div><!-- End Reports -->


            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                <div class="filter">
                
            </div>

                  <h5 class="card-title">Orders</h5>

                  <table class="table table-borderless datatable">
                    
                    <thead>
                      

                      <tr>
                      <th scope="col">Sl.No</th>
                      <th scope="col">Name</th>
                      <th scope="col">Contact no</th>
                      <th scope="col">Shipping Address</th>
                      <th scope="col">Product </th>
   <th colspan="4"style="text-align:center">number of packets ordered</th>
   <th colspan="4"style="text-align:center">Amount paid (Rs)</th>
   <th scope="col">Order Date</th>
   <th scope="col">Action</th>
   <th scope="col">Delivered Time</th>
  </tr>
  <tr>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th>50gm</th>
    <th>100gm</th>
    <th>500gm</th>
    <th>1000gm</th>
    <th>50gm</th>
    <th>100gm</th>
    <th>500gm</th>
    <th>1000gm</th>
    <th></th>
    <th></th>
    <th></th>
  </tr>

                    </thead>
                    <tbody>
 
                    <?php 
                    if (isset($_SESSION['db_id'])) {
                        $db_id = $_SESSION['db_id'];
                        // Do something with $db_id
                      }
$username = $_SESSION['username'];
$sqlq = mysqli_query($conn, "SELECT logid from login where db_username='$username'");
$roww = mysqli_fetch_assoc($sqlq);
$logid = $roww['logid'];

$sqlq1 = mysqli_query($conn, "SELECT db_id from tbl_deliverboyrequest where logid='$logid'");
$row1 = mysqli_fetch_assoc($sqlq1);
$db_id = $row1['db_id'];

$sqlq2 = mysqli_query($conn, "SELECT sellerid,orderid from tbl_dbassign where db_id='$db_id'");
$row2 = mysqli_fetch_assoc($sqlq2);
if (mysqli_num_rows($sqlq2) > 0) {
$orderid = $row2['orderid'];
$sellerid = $row2['sellerid'];
								
$cnt = 1;
$sql_query= mysqli_query($conn,"SELECT tbl_payment.payid, tbl_payment.logid, orders.payid, orders.orderid, tbl_payment.cart_id, tbl_payment.amount
FROM tbl_payment
LEFT JOIN orders ON tbl_payment.payid = orders.payid
WHERE (orders.orderStatus = 'in Process' OR orders.orderStatus IS NULL) 
AND tbl_payment.payid=orders.payid 
AND orders.sellerid='$sellerid'
AND orders.orderid IN ($orderid)
AND orders.orderid IN (SELECT orderid FROM tbl_dbassign WHERE (otp IS NOT NULL) AND deliver_status='delivered')");
while ($row = mysqli_fetch_assoc($sql_query))
{
						
	        								
                          $data = array();
	$data['col1'] = $row['payid'];
	$data['col2'] = $row['orderid'];
	$data['col3'] = $row['cart_id'];
	$logid = $row['logid'];
	
	
	$cart_id = mysqli_real_escape_string($conn, $data['col3']);
	$query = "SELECT q_50, q_100, q_500, q_1000, pid FROM tbl_cart WHERE cart_id='$cart_id'";
	$result = mysqli_query($conn, $query);
	
	// check if the query returned any rows
	if (mysqli_num_rows($result) > 0) {
		// iterate over the rows
		while ($row = mysqli_fetch_assoc($result)) {
			// print the values for each row
			$q50=$row['q_50'];
			$q100=$row['q_100'];
			$q500=$row['q_500'];
			$q1000=$row['q_1000'];
			$pid=$row['pid'];
		   
		}
	} 

	$quan=mysqli_query($conn,"select pname,p2_50,p2_100,p2_500,p2_1000 from tbl_product where pid='$pid' ");

// check if the query returned any rows

// check if the query returned any rows
if (mysqli_num_rows($quan) > 0) {
    // iterate over the rows
    while ($row = mysqli_fetch_assoc($quan)) {
        // print the values for each row
        $pname=$row['pname'];
        $p50=$row['p2_50']*$q50;
        $p100=$row['p2_100']*$q100;
        $p500=$row['p2_500']*$q500;
        $p1000=$row['p2_1000']*$q1000;
    }
}


	// Do something with the retrieved data

	$quet=mysqli_query($conn,"select orderid from orders where payid='{$data['col1']}' and orderid='{$data['col2']}' ");

if (mysqli_num_rows($quet) > 0) {
    while ($row = mysqli_fetch_assoc($quet)) {
        $orderid = $row['orderid'];
        // echo or do something with the values
    }
}

$quet2=mysqli_query($conn,"select time,delivered_time from tbl_dbassign where orderid='{$data['col2']}' ");

if (mysqli_num_rows($quet2) > 0) {
    while ($row2 = mysqli_fetch_assoc($quet2)) {
        $orderDate = $row2['time'];
        $delivered=$row2['delivered_time'];
        // echo or do something with the values
    }
}

    $qu=mysqli_query($conn,"select userid from userreg where logid='$logid'");
    $row = mysqli_fetch_assoc($qu);
    $userid= $row['userid'];
	// ...


    $qus=mysqli_query($conn,"select shippingAddress,shippingCity,shippingPincode,shipphone,shipname from tbl_address where userid='$userid'");
    while($row=mysqli_fetch_array($qus))
    {
        $name= $row['shipname'];
        $address=$row['shippingAddress'];
        $city=$row['shippingCity'];
        $code=$row['shippingPincode'];
        $phone=$row['shipphone'];
    
    // ...


?>	

<tr>
        <td><?php echo htmlentities($cnt);?></td>
        <td><?php echo htmlentities($name);?></td>
        <td><?php echo htmlentities($phone);?></td>
        <td><?php echo htmlentities($address);?><br><?php echo htmlentities($city);?><br><?php echo htmlentities($code);?></td>
        <td><?php echo htmlentities($pname);?></td>
        <td><?php if($q50 != -1) echo htmlentities($q50);?></td>
<td><?php if($q100 != -1) echo htmlentities($q100);?></td>
<td><?php if($q500 != -1) echo htmlentities($q500);?></td>
<td><?php if($q1000 != -1) echo htmlentities($q1000);?></td>
<td><?php if($p50 > 0) echo htmlentities($p50);?></td>
<td><?php if($p100 > 0) echo htmlentities($p100);?></td>
<td><?php if($p500 > 0) echo htmlentities($p500);?></td>
<td><?php if($p1000 > 0) echo htmlentities($p1000);?></td>

<td style="min-width: 150px;"><?php echo htmlentities($orderDate);?></td>

        <td>
  <?php
   $query = "SELECT * FROM tbl_dbassign where db_id='$db_id'";
   $result = mysqli_query($conn, $query);
 
   if(mysqli_num_rows($result) > 0){
     while($row = mysqli_fetch_assoc($result)){
      
      if ( $row['otp'] != null && $row['deliver_status']== null) {
        echo '<p style="font-size: 20px;"><b style="color: orange; text-align: center; font-size: 14px;"><div style="text-align: center;">
        <span style="display:inline-block; animation:spin 1s linear infinite;">&#9696;</span>Confirmation Pending
      </div></b></p>';


    } else if ($row['deliver_status'] == 'delivered') {
      echo'<p style="text-align: center;">
  <span style="display: inline-block; width: 24px; height: 24px; border-radius: 50%; border: 2px solid green; text-align: center;">
    <span style="color: green; font-size: 20px; line-height: 1;">&#10004;</span>
  </span>
</p>';
    } else if ($row['otp'] == 0 && $row['otp'] != null) {
      echo '<p>
          <b>
              <a href="otp.php?sellerid=' . $row['sellerid'] . '&orderid=' . $row['orderid'] . '&status=0&db_id=' . $row['db_id'] . '&dbassign_id=' . $row['dbassign_id'] . '" style="color:red; font-size:22px; text-decoration:none;">
                  &nbsp&nbsp&nbsp<span style="display:inline-flex; justify-content:center; align-items:center; margin-right: 5px;" title="Regenerate OTP">&#x21BB;</span>
                  <span style="display:inline-block; text-align: center;"></span>
              </a>(expired)
          </b>
      </p>';
    }
    else {
      echo '<p><b><a href="otp.php?sellerid='.$row['sellerid'].'&orderid='.$row['orderid'].'&status=0&db_id='.$row['db_id'].'&dbassign_id='.$row['dbassign_id'].'" style="color:green; font-size:18px; text-decoration:none;"><span style="display:inline-block; margin-right: 5px;"title="Proceed to shipment">&#x1F6A2;</span> <span style="display:inline-block; text-align: center;"></span></a></b></p>';

    }
      }
    }
  ?>
</td>
<td><?php echo htmlentities($delivered);?></td>
    </tr>

    <?php  $cnt=$cnt+1;} }
}
	
?>

</tbody>









                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->


      
         
         

        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  
<script>
<?php
  if(isset($_SESSION['status']))
     { 
	?>
	  alertify.set('notifier','position', 'top-center');
      alertify.success('<?= $_SESSION['status'];?>');
   	   <?php
	  unset($_SESSION['status']);
      }
      ?>
</script>
	  
<script>
  <?php
   if(isset($_SESSION['msg3']))
     { 
	?>
	  alertify.set('notifier','position', 'top-center');
       alertify.success('<?= $_SESSION['msg3'];?>');
   	   <?php
	   unset($_SESSION['msg3']);
      }
      ?>
</script>

<script>
  <?php
   if(isset($_SESSION['message']))
     { 
	?>
	  alertify.set('notifier','position', 'top-center');
       alertify.success('<?= $_SESSION['message'];?>');
   	   <?php
	   unset($_SESSION['message']);
      }
      ?>
</script>

</body>

</html>