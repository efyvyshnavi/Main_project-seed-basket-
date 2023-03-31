<?php
session_start();
include ('config.php');
if (!isset($_SESSION['username'])) {
  header("Location: admin-login.php");
  exit();
}

if(isset($_POST['submit1']))
 {
	
	$subcat=$_POST['subcategory'];
    $category=$_POST['category'];
	$sql="select * from tbl_subcategory where (subcategory='$subcat');";

	$res=mysqli_query($conn,$sql);

	if (mysqli_num_rows($res) > 0) {
	  
	  	$row = mysqli_fetch_assoc($res);
	  if($subcat==isset($row['subcategory']))
	  {
		
			$_SESSION['status'] = "This Subcategory already exist";
	  }
  
	  }
   else{

	
    $sql=mysqli_query($conn,"insert into tbl_subcategory(categoryid,subcategory,status) values('$category','$subcat','1')");
    $_SESSION['substatus'] = "Subcategory added successfully";
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
  .edit-button {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 8px 16px;
  border-radius: 4px;
  font-size: 18px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.edit-button:hover {
  background-color: #0062cc;
}
.edit-button {
  font-size: 15px; /* change the font size */
  padding: 8px 12px; /* change the padding */
}
.edit-button {
  height: 31px;
  width: 78px;
  text-align: center;
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
        <a class="nav-link collapsed" data-bs-target="#forms-nav"href="manageseller.php">
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
        <a class="nav-link collapsed" href="admin-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->



    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Subcategory</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Subcategory</li>
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
                 <B><div style = "position:relative; left:-23px; top:2px;"><a href="add-subcategory.php">Click to add new subcategory</a></div></B>
              
            </div>

                  <h5 class="card-title">Subcategory</h5>
                  <table class="table table-borderless datatable">
  <thead>
    <tr>
    <th scope="col">Category</th>
      <th scope="col">Sl.No</th>
      <th scope="col">Subcategory</th>
      <th scope="col">Edit</th>
      <th scope="col">Created on</th>
      <th scope="col">Action</th>
      <th scope="col">Last updated</th>
    </tr>
  </thead>
  <tbody>

    <?php
      $query=mysqli_query($conn,"SELECT tbl_subcategory.subid, tbl_category.categoryName, tbl_subcategory.subcategory, tbl_subcategory.creationDate, tbl_subcategory.updationDate, tbl_subcategory.status FROM tbl_subcategory JOIN tbl_category ON tbl_category.catid=tbl_subcategory.categoryid ORDER BY tbl_category.categoryName");
      $current_category = "";
      $cnt=1;
      while($row=mysqli_fetch_array($query)) {
        $category = $row['categoryName'];
        $subcategory = $row['subcategory'];
    ?>

      <?php if ($category != $current_category) { ?>
        <tr>
          <td colspan="7"><strong><?php echo $category; ?></strong></td>
        </tr>
        <?php $current_category = $category; } ?>

      <tr>
        <td>
        <td><?php echo htmlentities($cnt); ?></td>
        <td><?php echo htmlentities($subcategory); ?></td>
        <td>
          <form action="edit-subcategory.php" method="get">
            <input type="hidden" name="subid" value="<?php echo $row['subid'] ?>">
            <button type="submit" class="edit-button">Edit</button>
          </form>
        </td>

        <td><?php echo htmlentities($row['creationDate']); ?></td>
        <td>
        <?php if($row['status']==1){ ?>
          <form action="subinactivate.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['subid']; ?>">
            <input type="hidden" name="status" value="0">
            <button type="submit" class="btn btn-danger btn-sm">Disable</button>
          </form>
        <?php } else { ?>
          <form action="subactivate.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['subid']; ?>">
            <input type="hidden" name="status" value="1">
            <button type="submit" class="btn btn-success btn-sm">Enable</button>
          </form>
        <?php } ?>
      </td>
      <td><?php echo htmlentities($row['updationDate']); ?></td>

      </tr>
      <?php $cnt=$cnt+1; } ?>

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
   
   if(isset($_SESSION['msg6']))
     { 
	?>
	  alertify.set('notifier','position', 'top-center');
     alertify.success('<?= $_SESSION['msg6'];?>');
   	   <?php
	  unset($_SESSION['msg6']);
    
      }
      ?>
	  </script>

	  <script>
  <?php
   if(isset($_SESSION['substatus']))
     { 
	?>
	  alertify.set('notifier','position', 'top-center');
     alertify.success('<?= $_SESSION['substatus'];?>');
   	   <?php
	  unset($_SESSION['substatus']);
      
      }
      ?>
	  </script>

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
   if(isset($_SESSION['msg5']))
     { 
	?>
	  alertify.set('notifier','position', 'top-center');
     alertify.success('<?= $_SESSION['msg5'];?>');
   	   <?php
	  unset($_SESSION['msg5']);
      }
      ?>
	  </script>
</body>

</html>