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
           <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Revenue Earned by each sellers</h5>
              <?php
//email=$_SESSION['email'];
//$sqlq="SELECT logid from login where email='$email'";
//$resu = mysqli_query($conn, $sqlq);
//$row = mysqli_fetch_assoc($resu);
//$logid= $row['logid'];

// $sqlq4="SELECT sellerid from sellerreg where logid='$logid'";
// $resu4 = mysqli_query($conn, $sqlq4);
// $row = mysqli_fetch_assoc($resu4);
// $sellerid= $row['sellerid'];
// $selected_seller_id = isset($_POST['seller']) ? $_POST['seller'] : '';

$result = mysqli_query($conn, "SELECT sr.fname, SUM(CASE WHEN c.q_50 < 0 THEN 0 ELSE c.q_50 END * p.p2_50 +
    CASE WHEN c.q_100 < 0 THEN 0 ELSE c.q_100 END * p.p2_100 +
    CASE WHEN c.q_500 < 0 THEN 0 ELSE c.q_500 END * p.p2_500 +
    CASE WHEN c.q_1000 < 0 THEN 0 ELSE c.q_1000 END * p.p2_1000) AS total_sales
    FROM tbl_product p
    INNER JOIN tbl_cart c ON p.pid = c.pid
    INNER JOIN tbl_payment py ON c.cart_id = py.cart_id
    INNER JOIN orders o ON py.payid = o.payid
    INNER JOIN sellerreg sr ON o.sellerid = sr.sellerid
    GROUP BY sr.fname");

// Check if the query was successful
if ($result) {
    // Create an empty array to store data for the pie chart
    $data = array();

    // Loop through each row in the result and add data to the array
    while ($row = mysqli_fetch_assoc($result)) {
        // Add seller name and total sales to the array
        $data[] = array($row['fname'], (int)$row['total_sales']);
    }

    // Close the database connection
    

    // Encode the data array as JSON for use in JavaScript
    $json_data = json_encode($data);
?>
              <!-- Pie Chart -->
              <div id="piechart"style="position:relative;left:30px"min-height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); position: relative;" class="echart" _echarts_instance_="ec_1681638710407"><div style="position: relative; width: 423px; height: 400px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;"><canvas data-zr-dom-id="zr_0" width="528" height="500" style="position: absolute; left: 0px; top: 0px; width: 423px; height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas></div><div class="" style="position: absolute; display: block; border-style: solid; white-space: nowrap; z-index: 9999999; box-shadow: rgba(0, 0, 0, 0.2) 1px 2px 10px; transition: opacity 0.2s cubic-bezier(0.23, 1, 0.32, 1) 0s, visibility 0.2s cubic-bezier(0.23, 1, 0.32, 1) 0s; background-color: rgb(255, 255, 255); border-width: 1px; border-radius: 4px; color: rgb(102, 102, 102); font: 14px / 21px &quot;Microsoft YaHei&quot;; padding: 10px; top: 0px; left: 0px; transform: translate3d(158px, 163px, 0px); border-color: rgb(84, 112, 198); pointer-events: none; visibility: hidden; opacity: 0;"><div style="margin: 0px 0 0;line-height:1;"><div style="font-size:14px;color:#666;font-weight:400;line-height:1;">Access From</div><div style="margin: 10px 0 0;line-height:1;"><div style="margin: 0px 0 0;line-height:1;"><span style="display:inline-block;margin-right:4px;border-radius:10px;width:10px;height:10px;background-color:#5470c6;"></span><span style="font-size:14px;color:#666;font-weight:400;margin-left:2px">Search Engine</span><span style="float:right;margin-left:20px;font-size:14px;color:#666;font-weight:900">1,048</span><div style="clear:both"></div></div><div style="clear:both"></div></div><div style="clear:both"></div></div></div></div>
              <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
              <script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  // Create a new DataTable object and add columns for the seller name and total sales
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Seller');
  data.addColumn('number', 'Total Sales');

  // Add the data from the JSON string to the DataTable object
  data.addRows(<?php echo $json_data; ?>);

  // Set options for the pie chart
  var options = {
    'title': 'Revenue-share Earned by sellers',
    'width': 1110,
    'height': 400,
    'is3D': true,
  };

  // Create a new pie chart object and pass in the chart container and options
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
<?php }?>

              <!-- End Pie Chart -->

            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Sale by Product(max)</h5>
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

$sql = "SELECT p.pname, p.sellerid, 
SUM(CASE WHEN c.q_50 > 0 THEN c.q_50 ELSE 0 END) as total_q_50, 
SUM(CASE WHEN c.q_100 > 0 THEN c.q_100 ELSE 0 END) as total_q_100, 
SUM(CASE WHEN c.q_500 > 0 THEN c.q_500 ELSE 0 END) as total_q_500, 
SUM(CASE WHEN c.q_1000 > 0 THEN c.q_1000 ELSE 0 END) as total_q_1000 
FROM tbl_product p 
JOIN tbl_cart c ON p.pid = c.pid 
JOIN orders o ON c.orderid = o.orderid 
WHERE c.q_50 > 0 OR c.q_100 > 0 OR c.q_500 > 0 OR c.q_1000 > 0
GROUP BY p.pname, p.sellerid 
ORDER BY total_q_1000 DESC
";


$result = mysqli_query($conn, $sql);

// Process the data and generate the graph
$data_q_50 = array();
$data_q_100 = array();
$data_q_500 = array();
$data_q_1000 = array();

while ($row = mysqli_fetch_assoc($result)) {
    $data_q_50[$row['pname']] = $row['total_q_50'];
    $data_q_100[$row['pname']] = $row['total_q_100'];
    $data_q_500[$row['pname']] = $row['total_q_500'];
    $data_q_1000[$row['pname']] = $row['total_q_1000'];
}

$labels = array_keys($data_q_50);
$values_q_50 = array_values($data_q_50);
$values_q_100 = array_values($data_q_100);
$values_q_500 = array_values($data_q_500);
$values_q_1000 = array_values($data_q_1000);
// Use Chart.js to generate the graph
// Replace 'chart-container' with the ID of the HTML element where you want to display the chart
?>
<div style="position: relative;">
    <canvas id="chart-container"></canvas>
    
</div>

<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
<script>
    var ctx = document.getElementById('chart-container').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [
                {
                    label: 'Total Quantity Sold (50g)',
                    data: <?php echo json_encode($values_q_50); ?>,
                    backgroundColor: 'rgb(144, 238, 144)',
                    borderColor: 'rgb(144, 238, 144)',
                    borderWidth: 0.5,
                    barThickness: 40 // adjust the size of the bar
                },
                {
                    label: 'Total Quantity Sold (100g)',
                    data: <?php echo json_encode($values_q_100); ?>,
                    backgroundColor: 'rgba(0,0,0)',
                    borderColor: 'rgba(0,0,0)',
                    borderWidth: 0.5,
                    barThickness: 40 // adjust the size of the bar
                },
                {
                    label: 'Total Quantity Sold (500g)',
                    data: <?php echo json_encode($values_q_500); ?>,
                    backgroundColor: '	rgb(0,0,255)',
                    borderColor: '	rgb(0,0,255)',
                    borderWidth: 0.5,
                    barThickness: 40 // adjust the size of the bar
                },
                {
                    label: 'Total Quantity Sold (1000g)',
                    data: <?php echo json_encode($values_q_1000); ?>,
                    backgroundColor:'rgb(255,0,0)',
                    borderColor: 'rgb(255,0,0)',
                    borderWidth: 0.5,
                    barThickness: 40 // adjust the size of the bar
                },
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: '#333',
                    fontSize: 14
                }
            }
        }
    });
</script>
            </div>
          </div>
        </div>

            </div>
          </div>
        </div>


    
         

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