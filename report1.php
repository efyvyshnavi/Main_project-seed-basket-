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
<style>
    table {
        font-family: Arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    th {
        background-color: #ddd;
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
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
      <h1>Admin Report</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active"> Report</li>
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
            <h5 class="card-title">Sellers Details</h5>
                 
               <?php
//$email=$_SESSION['email'];

$sql = "SELECT sellerreg.fname, login.email, sellerreg.status, IF(sellerreg.status = 1, '-', tbl_pay.pay_amount) AS pay_amount, IF(sellerreg.status = 1, '-', tbl_pay.date) AS date
        FROM sellerreg
        INNER JOIN login ON sellerreg.logid = login.logid
        LEFT JOIN tbl_pay ON sellerreg.sellerid = tbl_pay.sellerid
        WHERE sellerreg.status IN (1, 2, -1)
        ORDER BY sellerreg.fname";

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    // Output report header
    $html = '<table>
                <tr>
                    <th>Seller Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>For the month</th>
                    <th>Paid Amount (Rs)</th>
                </tr>';

    $current_seller = '';
    $total_amount = 0;
    while ($row = $result->fetch_assoc()) {
        $status = '';
        switch ($row['status']) {
            case 1:
                $status = 'Pending';
                break;
            case 2:
                $status = 'Active';
                break;
            case -1:
                $status = 'Rejected';
                break;
            default:
                $status = '-';
                break;
        }

        $seller_name = $row['fname'];
        $email = $row['email'];

        if ($seller_name !== $current_seller) {
            $html .= "<tr>
                        <td>{$seller_name}</td>
                        <td>{$email}</td>
                        <td>{$status}</td>
                        <td>{$row['date']}</td>
                        <td>{$row['pay_amount']}</td>
                    </tr>";
            $current_seller = $seller_name;
        } else {
            $html .= "<tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{$row['date']}</td>
                        <td>{$row['pay_amount']}</td>
                    </tr>";
        }
        
        if ($row['pay_amount'] !== '-') {
            $total_amount += $row['pay_amount'];
        }
    }
    
    $html .= "<tr>
                <td></td>
                <td></td>
                <td></td>
                <td><strong>Total amount received till now:</strong></td>
                <td  colspan='1'>{$total_amount}.00 Rs</td>
              </tr>";
    
    $html .= '</table>';
    
    echo $html;
}
?>

                 
                 <h5 class="card-title">Users Details</h5>
                 
                     
                 <?php
                 $sql = "SELECT u.firstname, u.contactno, l.email AS login_email, u.status FROM userreg u JOIN login l ON u.logid = l.logid WHERE u.status IN (0,1)";
                 $result = mysqli_query($conn, $sql);
                 
                 if ($result->num_rows > 0) {
                     // Output report header
                     $html = '<table>
                                 <tr>
                                     <th>Name</th>
                                     <th>Contact No.</th>
                                     <th>Email</th>
                                     <th>Status</th>
                                 </tr>';
                     
                     while ($row = $result->fetch_assoc()) {
                         $status = '';
                         switch ($row['status']) {
                             case 0:
                                 $status = 'Rejected';
                                 break;
                             case 1:
                                 $status = 'Active';
                                 break;
                             default:
                                 $status = '-';
                                 break;
                         }
                         
                         $html .= "<tr>
                                     <td>{$row['firstname']}</td>
                                     <td>{$row['contactno']}</td>
                                     <td>{$row['login_email']}</td>
                                     <td>{$status}</td>
                                   </tr>";
                     }
                     
                     $html .= '</table>';
                 
                     // Output the table
                     
                     $html .= '<br><br>';
                     
                 } else {
                     echo 'No results found.';
                 }
                
    // Output download link and button
    $download_link = 'download.php'; 
    $download_filename = 'sales_report.csv'; 
    $download_button = '<div style="text-align: center;"><a href="report.php" class="btn btn-primary"><i class="fas fa-download"></i> Download Report</a></div>';
    echo $html . $download_button;


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