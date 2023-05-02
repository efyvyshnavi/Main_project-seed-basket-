<?php
include("config.php");
require_once('tcpdf/tcpdf.php');

date_default_timezone_set('Asia/Kolkata');
session_start();

ob_start(); // start output buffering
// Set document information
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('PDF');
$pdf->SetTitle('Sales Report');
$pdf->SetSubject('Sales Report');
$pdf->SetKeywords('Sales Report');

// Set default font
$pdf->SetFont('helvetica', '', 12);

// Add a page
$pdf->AddPage();


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
        <a class="nav-link collapsed" data-bs-target="#components-nav" href="index.php">
          <i class="bi bi-menu-button-wide"></i><span>Category</span>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" href="subcategory.php">
          <i class="bi bi-menu-button-wide"></i><span>Subcategory</span>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" href="manageseller.php">
          <i class="bi bi-journal-text"></i><span>Seller details</span>
        </a>
       
      </li><!-- End Forms Nav -->
      

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" href="add_video.php">
          <i class="bi bi-journal-text"></i><span>Add Video</span>
        </a>
       
      </li><!-- End Forms Nav -->
      

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" href="manageuser.php">
          <i class="bi bi-journal-text"></i><span>User details</span>
        </a>
       
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" href="product.php">
          <i class="bi bi-journal-text"></i><span>Order Details</span>
        </a>

        <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" href="rev.php">
          <i class="bi bi-bar-chart"></i><span>Sellers revenue graph</span>
        </a>
</li>
      <li class="nav-item">
        <a class="nav-link nav-icon" data-bs-target="#tables-nav"href="approve.php">
  
          <i class="bi bi-bell"></i><span>Pending requests</span>
                           
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
  
        <i class="bi bi-envelope-fill"></i><span>New Message</span>                          
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

      
      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="admin-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
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

$sq = "SELECT full_name FROM admin "; // Replace "1" with the actual admin ID
$result = mysqli_query($conn, $sq);
$row = mysqli_fetch_assoc($result);
$adminName = $row['full_name'];;

if ($result->num_rows > 0) {
    // Generate a random string of 6 characters
$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

// Generate a report ID based on the current date/time and the random string
$reportId = date('YmdHis') . $randomString;

// Output report header with the report ID
$pdf->Cell(0, 8, 'Report ID: ' . $reportId, 0, 1);
    $pdf->Cell(0, 10, 'Date: ' . date('Y-m-d H:i:s'), 0, 1);
    $pdf->SetFont('helvetica', '', 11);
    $pdf->Cell(0, 7, 'Admin Name: ' . $adminName, 0, 1);

    // Set the Y position to 30 units
    $pdf->SetY(38);

    // Output report header
    $pdf->SetFont('helvetica', 'B', 18);
$pdf->Cell(0, 14, 'Online Seed Basket', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 15);
$pdf->Cell(0, 11, 'Report', 0, 1, 'C');

	$pdf->Ln(12); // Add space between tables
    // Loop through the results for each month
    $pdf->SetFont('helvetica', '', 14);
$pdf->Cell(0, 10, 'Sellers Details', 0, 1, 'C');
$pdf->Ln(5); // Add space between heading and table
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
	
        $pdf->SetFont('helvetica', '', 10);

        $pdf->CellPadding = 2;
        
        $pdf->Cell(40, 7, 'Seller Name', 1, 0, 'C');
        $pdf->Cell(40, 7, 'Email', 1, 0, 'C');
        $pdf->Cell(40, 7, 'Status', 1, 0, 'C');
        $pdf->Cell(30, 7, 'Month', 1, 0, 'C');
        $pdf->Cell(40, 7, 'Amount (Rs)', 1, 0, 'C');
        $pdf->Ln();
        
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
                $pdf->Cell(40, 10, $seller_name, 1, 0, 'L');
                $pdf->Cell(40, 10, $email, 1, 0, 'L');
                $pdf->Cell(40, 10, $status, 1, 0, 'C');
                $pdf->Cell(30, 10, $row['date'], 1, 0, 'C');
                $pdf->Cell(40, 10, $row['pay_amount'], 1, 0, 'R');
                $pdf->Ln();
                $current_seller = $seller_name;
            } else {
                $pdf->Cell(40, 10, '', 1, 0, 'L');
                $pdf->Cell(40, 10, '', 1, 0, 'L');
                $pdf->Cell(40, 10, '', 1, 0, 'C');
                $pdf->Cell(30, 10, $row['date'], 1, 0, 'C');
                $pdf->Cell(40, 10, $row['pay_amount'], 1, 0, 'R');
                $pdf->Ln();
            }
        
            if ($row['pay_amount'] !== '-') {
                $total_amount += $row['pay_amount'];
            }
        }
        
        $pdf->Cell(130, 7, 'Total amount received till now:', 1, 0, 'R');
        $pdf->Cell(60, 7, $total_amount.'.00 Rs', 1, 0, 'R');
        $pdf->Ln(14);
        $pdf->Cell(10, 7, '', 0, 0, 'C');

        $pdf->SetFont('helvetica','', 14);
        $pdf->Cell(0, 14, 'Users Details', 0, 1, 'C');

// Set font and font size for the table
$pdf->SetFont('helvetica', '', 10);

// Add table header
$pdf->Cell(50, 7, 'Name', 1, 0, 'C');
$pdf->Cell(50, 7, 'Contact No.', 1, 0, 'C');
$pdf->Cell(50, 7, 'Email', 1, 0, 'C');
$pdf->Cell(40, 7, 'Status', 1, 0, 'C');
$pdf->Ln();

// Fetch data from database
$sql = "SELECT u.firstname, u.contactno, l.email AS login_email, u.status FROM userreg u JOIN login l ON u.logid = l.logid WHERE u.status IN (0,1)";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    // Loop through data and add to table
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

        $pdf->Cell(50, 7, $row['firstname'], 1, 0, 'L');
        $pdf->Cell(50, 7, $row['contactno'], 1, 0, 'L');
        $pdf->Cell(50, 7, $row['login_email'], 1, 0, 'L');
        $pdf->Cell(40, 7, $status, 1, 0, 'L');
        $pdf->Ln();
    }

    // Output the PDF
   
} else {
    echo 'No results found.';
}
$pdf->SetY($pdf->GetY() + 30);

 
	$pdf->Cell(0, 7, 'End of Report', 0, 1, 'C'); // Outp

$pdf->writeHTML($html);


ob_end_clean();
    // Write sales report table to PDF
    
    // Close database connection
    $conn->close();

    // Output PDF to the browser
    $pdf->Output('sales_report.pdf', 'I'); // 'I' opens the PDF in the browser window
}
}
?>
<!-- Add a link/button to download the PDF file -->
<a href="sales_report.pdf" download>Download Sales Report</a>
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