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
      <h1>Sales Graph</h1>
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
                  <div class="module-body">
<?php
$email=$_SESSION['email'];
$sqlq="SELECT logid from login where email='$email'";
$resu = mysqli_query($conn, $sqlq);
$row = mysqli_fetch_assoc($resu);
$logid= $row['logid'];

$sqlq4="SELECT sellerid from sellerreg where logid='$logid'";
$resu4 = mysqli_query($conn, $sqlq4);
$row = mysqli_fetch_assoc($resu4);
$sellerid= $row['sellerid'];

$sql = "SELECT p.pname, p.sellerid, s.fname,
SUM(CASE WHEN c.q_50 > 0 THEN c.q_50 ELSE 0 END) as total_q_50, 
SUM(CASE WHEN c.q_100 > 0 THEN c.q_100 ELSE 0 END) as total_q_100, 
SUM(CASE WHEN c.q_500 > 0 THEN c.q_500 ELSE 0 END) as total_q_500, 
SUM(CASE WHEN c.q_1000 > 0 THEN c.q_1000 ELSE 0 END) as total_q_1000 
FROM tbl_product p 
LEFT JOIN tbl_cart c ON p.pid = c.pid 
LEFT JOIN orders o ON c.orderid = o.orderid 
JOIN sellerreg s ON p.sellerid = s.sellerid
GROUP BY p.sellerid, s.fname, p.pname 
ORDER BY total_q_1000 DESC";

// Execute the query
$result = mysqli_query($conn, $sql);

// Initialize an array to store the data
$data = array();

// Fetch the data and store it in the array
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

$sellers = array();
foreach ($data as $row) {
    if (!isset($sellers[$row['sellerid']])) {
        $sellers[$row['sellerid']] = array(
            'seller' => $row['fname'],
            'products' => array(),
        );
    }
    $sellers[$row['sellerid']]['products'][] = array(
        'name' => $row['pname'],
        'total_q_50' => $row['total_q_50'],
        'total_q_100' => $row['total_q_100'],
        'total_q_500' => $row['total_q_500'],
        'total_q_1000' => $row['total_q_1000'],
    );
}

foreach ($sellers as $seller) {
    $fname = $seller['seller'];
    $labels = array();
    $total_q_50 = array();
    $total_q_100 = array();
    $total_q_500 = array();
    $total_q_1000 = array();

    foreach ($seller['products'] as $product) {
        $labels[] = $product['name'];
        $total_q_50[] = $product['total_q_50'];
        $total_q_100[] = $product['total_q_100'];
        $total_q_500[] = $product['total_q_500'];
        $total_q_1000[] = $product['total_q_1000'];
    }
    

    echo "<h2>" . $fname . "</h2>";
    echo "<div style='position: relative;'>";
    echo "<canvas id='myChart-$fname'></canvas>";
    echo "<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>";
    echo "<div class='container'>";
    echo "<canvas id='myChart'></canvas>";
    echo "</div>";
    echo "<div style='position: absolute; top: -50px; left: 83%; transform: translateX(-50%); font-weight: bold;'>";
    echo "X Axis Label : Products<br>";
    echo "Y Axis Label : Quantity Sold";
    echo "</div>";
    echo "</div>";

echo "<script>";
echo "var ctx = document.getElementById('myChart-$fname').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: " . json_encode($labels) . ",
            datasets: [{
                label: 'Total Quantity 50g',
                data: " . json_encode($total_q_50) . ",
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                barThickness: 30
            },{
                label: 'Total Quantity 100g',
                data: " . json_encode($total_q_100) . ",
                backgroundColor: 'rgba(0,0,0)',
                borderColor: 'rgba(0,0,0)',
                borderWidth: 1,
                barThickness: 30
            },{
                label: 'Total Quantity 500g',
                data: " . json_encode($total_q_500) . ",
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1,
                barThickness: 30
            },{
                label: 'Total Quantity 1000g',
                data: " . json_encode($total_q_1000) . ",
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                barThickness: 30
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });";
echo "</script>"; 

}
?>
  
  <div class="dataTable-bottom"><div class="dataTable-info">Showing 1 to 10 of 24 entries</div><nav class="dataTable-pagination"><ul class="dataTable-pagination-list">
    <li class="active"><a href="?seller=1" data-page="1">1</a></li>
    <li class=""><a href="?seller=2" data-page="2">2</a></li>
    <li class=""><a href="?seller=3" data-page="3">3</a></li>
    <li class="pager"><a href="?seller=2" data-page="2">›</a></li>
</ul></nav></div></div>
                 
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