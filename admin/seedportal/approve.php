<?php
session_start();
include ('config.php');
date_default_timezone_set('Asia/Kolkata');// 
$currentTime = date( 'd-m-Y h:i:s A', time () );
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
        <a class="nav-link collapsed" data-bs-target="#forms-nav" href="manageuser.php">
          <i class="bi bi-journal-text"></i><span>User details</span>
        </a>
       
      </li><!-- End Forms Nav -->
      
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
      <h1>Requests</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Requests</li>
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
                <br>
                <div class="card-body">
                  
                 <center> <h1 class="card-title"style="font-size:24px">Seller Requests</h1></center>
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                      <th>SI.No</th>
					  <th>First Name</th>
					 <th>Proof</th>
					  <th>Email</th>
					  <th>Phoneno</th>
                     <th>Request Time</th>
					  <th>Approve</th>
                      <th>Reject</th>  
                      </tr>
                    </thead>
                    <tbody>                   	  		             		               
<?php $query=mysqli_query($conn,"select sellerreg.sellerid,sellerreg.pdf,sellerreg.fname,login.email,sellerreg.phoneno,sellerreg.logid,sellerreg.status,sellerreg.creationDate,login.status from login join sellerreg on login.logid=sellerreg.logid AND sellerreg.status=1");
$cnt=1;
$num=mysqli_num_rows($query);
if($num>0)
{
while($row=mysqli_fetch_array($query))
{
?>						
	   
                <tr>
					  <td><?php echo htmlentities($cnt);?></td>
					  <td><?php echo htmlentities($row['fname']);?></td>
					  <td> <?php echo htmlentities($row['email']);?></td>
            <td>
  <a href="display_pdf.php?id=<?php echo $row['sellerid']?>" class="pdf-link">
    <?php echo htmlentities($row['pdf']);?>
  </a>
</td>

					  <td><?php echo htmlentities($row['phoneno']);?></td>
                                           
                      <td><?php echo htmlentities($row['creationDate']);?></td>
                      <td>
  <?php
    if($row['status']==1){
      echo '<p><b><a href="pending.php?id='.$row['sellerid'].'&email='.$row['email'].'&status=0" style="color:green; font-size:15px; text-decoration:none;">Approve</a></b></p>';
    }else{
      echo '<p><b><a href="pending.php?id='.$row['sellerid'].'&email='.$row['email'].'&status=0" style="color:green; font-size:15px; text-decoration:none;">Approve</a></b></p>';
    }
  ?>
</td>

<td>
  <?php
    if($row['status']==0){
      echo '<p><b><a href="reject.php?id='.$row['sellerid'].'&email='.$row['email'].'&status=1" style="color:red; font-size:15px; text-decoration:none;">Reject</a></b></p>';
    }else{
      echo '<p><b><a href="reject.php?id='.$row['sellerid'].'&email='.$row['email'].'&status=1" style="color:red; font-size:15px; text-decoration:none;">Reject</a></b></p>';
    }
  ?>
</td>

          
          
          
				
				</tr><br>
				<?php $cnt=$cnt+1; }}
                
                else{?>
          
    <?php } ?>	
                  
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
   if(isset($_SESSION['msg']))
     { 
	?>
	  alertify.set('notifier','position', 'top-center');
       alertify.success('<?= $_SESSION['msg'];?>');
   	   <?php
	   unset($_SESSION['msg']);
      }
      ?>
</script>

<script>
  <?php
   if(isset($_SESSION['msg2']))
     { 
	?>
	  alertify.set('notifier','position', 'top-center');
       alertify.success('<?= $_SESSION['msg2'];?>');
   	   <?php
	   unset($_SESSION['msg2']);
      }
      ?>
</script>
	  <script src="app.js"></script>
</body>

</html>