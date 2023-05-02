<?php
session_start();
include ('config.php');
date_default_timezone_set('Asia/Kolkata');// 
$currentTime = date( 'd-m-Y h:i:s A', time () );

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: admin-login.php");
    exit();
}

if (isset($_POST['csubmit'])) {
  $category = trim($_POST['category']);
  $description = trim($_POST['description']);

  // Validate the category name
  if (empty($category)) {
      // The category name is empty or null
      $_SESSION['status'] = "Please enter a category name";
  } else if (strlen($category) > 50) {
      // The category name is too long
      $_SESSION['status'] = "Category name is too long";
  } else if (preg_match('/[^A-Za-z0-9\s]/', $category)) {
      // The category name contains invalid characters
      $_SESSION['status'] = "Category name contains invalid characters";
  } else if (substr($category, -1) == "s") {
    // Remove the "s" to obtain the singular form of the category name
    $singularCategory = substr($category, 0, -1);
    $sql = "SELECT * FROM tbl_category WHERE categoryName = '$singularCategory'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $_SESSION['status'] = "This category already exists";
    } else {
      // Insert the new category into the database
      $sql = "INSERT INTO tbl_category (categoryName, categoryDescription, status) VALUES ('$category', '$description', '1')";
      mysqli_query($conn, $sql);
      $_SESSION['status'] = "Category added successfully";
    }
  } else if (empty($description)) {
    // The description is empty or null
    $_SESSION['status'] = "Please enter a description";
  } else if (strlen($description) > 255) {
    // The description is too long
    $_SESSION['status'] = "Description is too long";
  } else if (preg_match('/[^A-Za-z0-9\s]/', $description)) {
    // The description contains invalid characters
    $_SESSION['status'] = "Description contains invalid characters";
  } else {
    // Check if the category already exists in the database
    $sql = "SELECT * FROM tbl_category WHERE categoryName = '$category'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $_SESSION['status'] = "This category already exists";
    } else {
      // Insert the new category into the database
      $sql = "INSERT INTO tbl_category (categoryName, categoryDescription, status) VALUES ('$category', '$description', '1')";
      mysqli_query($conn, $sql);
      $_SESSION['status'] = "Category added successfully";
    }
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
<style>
  form {
    background-color: #f7f7f7;
    padding: 20px;
    border: 1px solid #e6e6e6;
    border-radius: 10px;
    width: 500px;
    margin: 0 auto;
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
  }

  select {
    padding: 10px;
    border-radius: 5px;
    border: 2px solid #ccc;
    width: 100%;
    margin-bottom: 20px;
    font-size: 16px;
    font-weight: 500;
    color: #555;
  }

  input[type="submit"] {
    background-color: #1e90ff;
    color: white;
    padding: 13px 34px;
    border: none;
    border-radius: 4px;
    
    cursor: pointer;
    font-size: 18px;
    font-weight: 500;
    transition: all 0.3s ease;
  }

  input[type="submit"]:hover {
    background-color: #0077b6;
  }

  label {
    display: block;
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 10px;
    color: #444;
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
      <h1>Revenue Graph</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active"> Graph</li>
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
                  <h5 class="card-title"></h5>
                 
<?php
// $email=$_SESSION['email'];
// $sqlq="SELECT logid from login where email='$email'";
// $resu = mysqli_query($conn, $sqlq);
// $row = mysqli_fetch_assoc($resu);
// $logid= $row['logid'];

// $sqlq4="SELECT sellerid from sellerreg where logid='$logid'";
// $resu4 = mysqli_query($conn, $sqlq4);
// $row = mysqli_fetch_assoc($resu4);
// $sellerid= $row['sellerid'];
$selected_seller_id = isset($_POST['seller']) ? $_POST['seller'] : '';

// Initialize variables
$labels = array();
$data = array();

if (isset($_POST['submit'])) {
    // Get selected month and year from form input
    $month = $_POST['month'];
    $year = $_POST['year'];
    $selected_seller = $_POST['seller'];
    $month_name = date('F', mktime(0, 0, 0, $month, 1));
    
    
    

$sql = "SELECT sr.fname, p.pname, DATE_FORMAT(py.paydate, '%Y-%m') AS payment_month,
SUM(CASE WHEN c.q_50 < 0 THEN 0 ELSE c.q_50 END * p.p2_50 +
    CASE WHEN c.q_100 < 0 THEN 0 ELSE c.q_100 END * p.p2_100 +
    CASE WHEN c.q_500 < 0 THEN 0 ELSE c.q_500 END * p.p2_500 +
    CASE WHEN c.q_1000 < 0 THEN 0 ELSE c.q_1000 END * p.p2_1000) AS total_sales
FROM tbl_product p
INNER JOIN tbl_cart c ON p.pid = c.pid
INNER JOIN tbl_payment py ON c.cart_id = py.cart_id
INNER JOIN orders o ON py.payid = o.payid
INNER JOIN sellerreg sr ON o.sellerid = sr.sellerid
WHERE o.sellerid = '$selected_seller' AND YEAR(py.paydate) = '$year' AND MONTH(py.paydate) = '$month'
GROUP BY sr.fname, p.pname, payment_month";

 // Execute query and fetch results
 $result = mysqli_query($conn, $sql);
 $total_sales = 0;
 
 // Loop through the results and add the data to the arrays
 if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
         $labels[] = $row['pname'];
         $data[] = $row['total_sales'];
         $product_name = $row['pname'];
         $revenue_earned = $row['total_sales'];
         $seller_name = $row['fname'];
         echo "<p style='position:relative;left: 370px;'>Product: $product_name, Revenue Earned: $revenue_earned</p>";
         $total_sales += $revenue_earned;
     }

 if ($seller_name) {
    echo "<b><p style='position:relative;left: 320px;'>Total Revenue Earned by Seller $seller_name in $month_name, $year: Rs. $total_sales</p><a href='rev.php' style='position:absolute;right:70px;top:30px;font-weight:bold;text-decoration:none;'><span style='font-size: 1.0em;'>&larr; Click to Go Back</span></a>";
  }} else {
    echo "<b><p style='position:relative;left: 390px;'>No data available for the selected details.</p>
    <a href='rev.php' style='position:absolute;right:70px;top:30px;font-weight:bold;text-decoration:none;'><span style='font-size: 1.0em;'>&larr; Click to Go Back</span></a></b>";
  }

 echo '
 <canvas id="myChart"></canvas>
 
 <!-- Include Chart.js library -->
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
 <!-- Create a JavaScript script that creates the chart -->
 <script>
 // Get the PHP data and store it in JavaScript variables
 var labels = ' . json_encode($labels) . ';
 var data = ' . json_encode($data) . ';
 
 // Create a new Chart.js chart using the canvas element
 var ctx = document.getElementById("myChart").getContext("2d");
 var myChart = new Chart(ctx, {
   type: "bar",
   data: {
     labels: labels,
     datasets: [{
       label: "Revenue Earned",
       data: data,
       backgroundColor: "rgba(65,84,241)",
       borderColor: "rgba(54, 162, 235, 1)",
       borderWidth: 1,
       barThickness: 40
     }]
   },
   options: {
     scales: {
       y: {
         beginAtZero: true
       }
     }
   }
 });
 </script>';
 
}
else{
    ?>
   <br><center>
<?php
  // Check if year and month are set
  if (!isset($_POST['year']) || !isset($_POST['month']) || !isset($_POST['seller'])) {
    echo "<h5 style='color:#4154f1;font-weight:bold'>Please select  year,month, and seller name</h5>";
}


  
?>
</center><br>
    <br>
<form method="post"><br>
  <!-- Month select field -->
  <select name="year">
    <?php
    $current_year = date('Y');
    for ($year = $current_year; $year >= $current_year - 5; $year--) {
      echo "<option value='".$year."'>".$year."</option>";
    }
    ?>
  </select><br>
  <select name="month">
    <option value="01" <?php if (isset($_POST['month']) && $_POST['month'] == '01') echo 'selected'; ?>>January</option>
    <option value="02" <?php if (isset($_POST['month']) && $_POST['month'] == '02') echo 'selected'; ?>>February</option>
    <option value="03" <?php if (isset($_POST['month']) && $_POST['month'] == '03') echo 'selected'; ?>>March</option>
    <option value="04" <?php if (isset($_POST['month']) && $_POST['month'] == '04') echo 'selected'; ?>>April</option>
    <option value="05" <?php if (isset($_POST['month']) && $_POST['month'] == '05') echo 'selected'; ?>>May</option>
    <option value="06" <?php if (isset($_POST['month']) && $_POST['month'] == '06') echo 'selected'; ?>>June</option>
    <option value="07" <?php if (isset($_POST['month']) && $_POST['month'] == '07') echo 'selected'; ?>>July</option>
    <option value="08" <?php if (isset($_POST['month']) && $_POST['month'] == '08') echo 'selected'; ?>>August</option>
    <option value="09" <?php if (isset($_POST['month']) && $_POST['month'] == '09') echo 'selected'; ?>>September</option>
    <option value="10" <?php if (isset($_POST['month']) && $_POST['month'] == '10') echo 'selected'; ?>>October</option>
    <option value="11" <?php if (isset($_POST['month']) && $_POST['month'] == '11') echo 'selected'; ?>>November</option>
    <option value="12" <?php if (isset($_POST['month']) && $_POST['month'] == '12') echo 'selected'; ?>>December</option>
  </select>

  <!-- Seller select field -->
  <select name="seller">
    <?php
    
    // Get sellers from sellereg table
    $seller_query = "SELECT * FROM sellerreg";
    $sellers = mysqli_query($conn, $seller_query);

      // loop through sellers and generate options
      foreach ($sellers as $seller) {
        $seller_id = $seller['sellerid'];
        $seller_name = $seller['fname'];
        $selected = (isset($_POST['seller']) && $_POST['seller'] == $seller_id) ? 'selected' : '';
        echo "<option value='$seller_id' $selected>$seller_name</option>";
      }
    ?>
  </select>

  <br>

  <!-- Submit button -->
  <center>
 
    <input type="submit" style='padding:4px;width:150px' name="submit" value="Submit">
  </center>
</form><br><br><br>
    <?php }
    ?>
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