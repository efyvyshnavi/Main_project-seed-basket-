<?php
session_start();
include ('config.php');
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
if (!isset($_SESSION['username'])) {
  header("Location: admin-login.php");
  exit();
}


if(isset($_POST['submit']))
{
    $id=$_POST['cat_id'];
	$category=$_POST['category'];
	$description=$_POST['description'];
	
	
$query="UPDATE tbl_category SET categoryName='$category',categoryDescription='$description',updationDate='$currentTime' where catid='$id'";
$query_run=mysqli_query($conn,$query);
if($query_run)
{
	$_SESSION['status'] = "Category updated successfully";
	header('location:index.php');
}
else
{
	echo "no";
}
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
    .pdf-link {
  color: #0066cc;
  text-decoration: none;
  font-weight: bold;
}

.pdf-link:hover {
  text-decoration: underline;
}
</style>

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
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
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
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
        <a class="nav-link collapsed" data-bs-target="#forms-nav" href="add_video.php">
          <i class="bi bi-journal-text"></i><span>Add Video</span>
        </a>
       
      </li><!-- End Forms Nav -->
      
<li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Add</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="index.php">
              <i class="bi bi-circle"></i><span>Categories</span>
            </a>
          </li>
          <li>
            <a href="subcategory.php">
              <i class="bi bi-circle"></i><span>Subcategories</span>
            </a>
          </li>
         
        </ul>
      </li><!-- End Charts Nav -->

<li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-filter-square"></i><span>Details</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="manageseller.php">
              <i class="bi bi-circle"></i><span>Seller Details</span>
            </a>
          </li>
          <li>
            <a href="manageuser.php">
              <i class="bi bi-circle"></i><span>Users Details</span>
            </a>
          </li>
         
        </ul>
      </li><!-- End Charts Nav -->

<li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav"  data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="rev.php">
              <i class="bi bi-circle"></i><span>Revenue Graph</span>
            </a>
          </li>
          <li>
            <a href="pie.php">
              <i class="bi bi-circle"></i><span>Others</span>
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
          <li class="breadcrumb-item active">Orders Details </li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div >
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Orders <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <?php
                    $result = mysqli_query($conn, "SELECT COUNT(*) AS today_orders_count FROM orders WHERE DATE(orderDate) = CURDATE()");

// Check if the query was successful
if ($result) {
    // Retrieve the result as an associative array
    $row = mysqli_fetch_assoc($result);

    // Get the count of today's orders
    $today_orders_count = $row['today_orders_count'];

}
?>
                    <div class="ps-3">
                      <h6><?php echo $row['today_orders_count']?><h5>Items</h5></h6>
                     
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

              <!-- Sales Card -->
              <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Orders <span>| Pending </span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <?php
                    $result = mysqli_query($conn, "SELECT COUNT(*) AS pending_orders_count 
                    FROM orders 
                    WHERE orderStatus IS NULL OR orderStatus = 'in Process';");

// Check if the query was successful
if ($result) {
    // Retrieve the result as an associative array
    $row = mysqli_fetch_assoc($result);

    // Get the count of today's orders
    $pending_orders_count = $row['pending_orders_count'];

}
?>
                    <div class="ps-3">
                      <h6><?php echo $row['pending_orders_count']?><h5>Items</h5></h6>
                     
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

          
            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Orders <span>| Delivered </span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <?php
                    $result = mysqli_query($conn, "SELECT COUNT(*) AS delivered_orders_count 
                    FROM orders 
                    WHERE orderStatus = 'Delivered' ;");

// Check if the query was successful
if ($result) {
    // Retrieve the result as an associative array
    $row = mysqli_fetch_assoc($result);

    // Get the count of today's orders
    $del_orders_count = $row['delivered_orders_count'];

}
?>
                    <div class="ps-3">
                      <h6><?php echo $row['delivered_orders_count']?><h5>Items</h5></h6>
                     
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

          

         
 <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                <div class="filter">
                
            </div>

                  <h5 class="card-title">Orders details</h5>

                  <table class="table table-borderless datatable">
  <thead>
    <tr>
      <th scope="col">Sl.No</th>
      <th scope="col">User name</th>
      <th scope="col">Product name</th>
      <th scope="col">Ordered Date</th>
      <th scope="col">Order status</th>
      <th scope="col">Payment status</th>
    </tr><br><br>
  </thead>
  <tbody>
    <?php 
    $query=mysqli_query($conn,"SELECT s.fname as seller_name, u.firstname as user_name, 
    CONCAT(p.pname, ' (', 
        CASE 
            WHEN c.q_50 > 0 THEN CONCAT(c.q_50, ' x 50g')
            WHEN c.q_100 > 0 THEN CONCAT(c.q_100, ' x 100g')
            WHEN c.q_500 > 0 THEN CONCAT(c.q_500, ' x 500g')
            WHEN c.q_1000 > 0 THEN CONCAT(c.q_1000, ' x 1000g')
        END, ')') as product_name, o.orderDate, o.orderStatus, py.payment_status
    FROM tbl_cart c
    INNER JOIN tbl_product p ON c.pid = p.pid
    INNER JOIN userreg u ON c.logid = u.logid
    INNER JOIN sellerreg s ON p.sellerid = s.sellerid
    INNER JOIN orders o ON c.orderid = o.orderid
    INNER JOIN tbl_payment py ON o.payid = py.payid
    GROUP BY s.fname
    ORDER BY s.fname;");
    while($row=mysqli_fetch_array($query))
    {
      $seller_name = htmlentities($row['seller_name']);
    ?>
      <tr>
      <td colspan="3"><h2 style="font-size:22px;font-weight:bold; font-family:Georgia">Seller : <?php echo $seller_name;?></h2></td>
      </tr>
      <?php 
      $inner_query=mysqli_query($conn,"SELECT u.firstname as user_name, 
     CONCAT(p.pname, ' (', 
        CASE 
            WHEN c.q_50 > 0 THEN CONCAT(c.q_50, ' x 50g')
            WHEN c.q_100 > 0 THEN CONCAT(c.q_100, ' x 100g')
            WHEN c.q_500 > 0 THEN CONCAT(c.q_500, ' x 500g')
            WHEN c.q_1000 > 0 THEN CONCAT(c.q_1000, ' x 1000g')
        END, ')') as product_name, o.orderDate, o.orderStatus, py.payment_status
      FROM tbl_cart c
      INNER JOIN tbl_product p ON c.pid = p.pid
      INNER JOIN userreg u ON c.logid = u.logid
      INNER JOIN sellerreg s ON p.sellerid = s.sellerid
      INNER JOIN orders o ON c.orderid = o.orderid
      INNER JOIN tbl_payment py ON o.payid = py.payid
      WHERE s.fname = '$seller_name'
      ORDER BY o.orderDate;");
      $cnt = 1;
      while($inner_row=mysqli_fetch_array($inner_query))
      {
        $user_name = htmlentities($inner_row['user_name']);
        $product_name = htmlentities($inner_row['product_name']);
        $order_date = htmlentities($inner_row['orderDate']);
        $order_status = htmlentities($inner_row['orderStatus'] ?? 'Pending');
        $payment_status = htmlentities($inner_row['payment_status']);
      ?>
        <tr>
          <td><?php echo htmlentities($cnt);?></td>
         
          <td><?php echo $user_name;?></td>
          <td><?php echo $product_name;?></td>
          <td><?php echo $order_date;?></td>
          <td><?php echo $order_status;?></td>
          <td><?php echo $payment_status;?></td>
        </tr>
      <?php 
        $cnt++;
      }
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