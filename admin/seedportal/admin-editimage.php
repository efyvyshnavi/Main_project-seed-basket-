<?php
 
 session_start();
 include ('config.php');
 if (!isset($_SESSION['username'])) {
    header("Location: admin-login.php");
    exit();
}
$targetDir = "admin_image/";

if(isset($_POST['submit2']))
{
	
  $image=$_FILES['images']['name'];
  move_uploaded_file($_FILES['images']['tmp_name'],"admin_image/".$image);
	$sql=mysqli_query($conn,"update admin set fimage='$image'");
    $_SESSION['msg']="Product Image Updated Successfully !!";

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin/ Profile - Online Seed Basket</title>
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

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

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
        <span class="d-none d-lg-block">Online Seed Basket </span>
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
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php
if(isset($_SESSION['username'])){
    echo $_SESSION['username'];
} 
?></span>
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
        <a class="nav-link " href="admin-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.PHP">Home</a></li>
          <li class="breadcrumb-item">Admin</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">
          
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <?php $query=mysqli_query($conn,"select full_name,job,country,address,phone,mail from admin");

while($row=mysqli_fetch_array($query))
{
?>	
              <img src="assets/img/profile-img.png" alt="Profile" class="rounded-circle">
              <h2><?php echo htmlentities($row['full_name']);?></h2>
              <h3><?php echo htmlentities($row['job']);?></h3>
              <?php  } ?>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Image edit</button>
                </li>

               
              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                
                  <h5 class="card-title">Profile Details</h5>
                  <?php $query=mysqli_query($conn,"select fimage from admin");

while($row=mysqli_fetch_array($query))
{
?>	

                 
                  <!-- Profile Edit Form -->
                  <form action="admin-profile.php"method="POST" enctype="multipart/form-data">
                  <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                      <img src='admin_image/<?php echo $row["fimage"]; ?>' width='150' height='200' alt="Profile">
                      </div>
                    </div>
                    <div>
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Update Image</label>
                    <input type="file" name="images" id="productimage1" value="" class="span8 tip" required>
                <!--<a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>-->
                  </div>

											<div >
												<button type="submit" name="submit2" class="btn">Update</button>
											</div>
                      </form>
                  <?php  } ?>
                </div>
               

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
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

</body>

</html>