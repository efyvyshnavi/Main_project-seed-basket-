<?php
session_start();
ob_start();
include ('config.php');
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

if(isset($_POST['su']))
{

  $subid=$_POST['sub_id'];
	$subcat=$_POST['subcate'];
  
  
$sql="UPDATE tbl_subcategory set subcategory='$subcat',updationDate='$currentTime' where subid='$subid'";
if($sql)
{
  
  $_SESSION['up'] = "SubCategory updated successfully";
  header('location:adminsubcat.php');
 
//  header('Location: adminsubcat.php');
//  exit();
}

}
?>
<!Doctype HTML>
	<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="sty.css" type="text/css"/>
		<link rel="stylesheet" href="subcategory.css" type="text/css"/>
		<link rel="stylesheet" href="head.css" type="text/css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
		<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="mainheader.css" type="text/css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		


<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 90px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* The Close Button */
.close {
  color: Black;
  float: center;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

* {
  box-sizing: border-box;
}

form.example input[type=text] {
  padding: 7px;
  font-size: 14px;
  border: 1px solid grey;
  float: left;
  width: 70%;
  background: #f1f1f1;
}

form.example button {
  float: left;
  width: 20%;
  padding: 9px;
  background: #3630a3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
}
form.example button:hover {
  background: #0b7dda;
}

form.example::after {
  content: "";
  clear: both;
  display: table;
}
</style>
	</head>


	<body>
	
		<div id="mySidenav" class="sidenav">
    <center style="color:BLACK;padding:1px;font-size:20px;""><h2>Online Seed Basket</h2></center>
      <center style="color:BLACK;padding:1px;font-size:20px;""><h3>Admin Panel</h3></center>
		<br>   
	   
	  <a href="admincat.php"style="color:BLACK;"class="icon-a"><i class="fa fa-shopping-bag icons"></i>Category</a>
	  <a href="adminsubcat.php"style="color:BLACK;"class="icon-a"><i class="fa fa-shopping-bag icons"></i>   Sub Category</a>
	  <a href="#"class="icon-a"style="color:BLACK;"><i class="fa fa-list-alt icons"></i>   Manage Sellers</a>
    <a href="approve.php" class="icon-a"style="color:black;"><i class="fa fa-dashboard icons"></i>   Pending requests</a>
	 
	</div>
		
	<header class="site-header">
            <div  class="site-identity">
             
               
            </div>
        
            <nav class="site-navigation">
                <div class="w3-container">
                    <div class="w3-dropdown-hover">
                      <button class="w3-button w3-black">WELCOME SELLER</button>
                      <div class="w3-dropdown-content w3-bar-block w3-border">
                        <a href="page.php" class="w3-bar-item w3-button">Change Password</a>
                        <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
                      </div>
                    </div>
                  </div>
            </nav>
    </header>
  <center>
  
  <?php
  if(isset($_GET['subid']))
  {
    $subid=$_GET['subid'];
  $query2=mysqli_query($conn,"select *from  tbl_subcategory where subid='$subid' and status=1");
  $num1=mysqli_num_rows($query2);
  if($num1>0)
  {
   while($row=mysqli_fetch_array($query2))
{
?>
      <div class="cardStyle">
		  <form id="subcategory" method="POST" action="edit-subcategory.php"> 
  
			<h2 class="formTitle">
			  Edit Subcategory
			</h2>
      <input type="hidden"name="sub_id"value="<?= $row['subid'] ?>">
      <div class="inputDiv">
			<label class="inputLabel" for="subcate"style="font-size:16px;">Edit SubCategory Name</label>
			<input type="text"name="subcate" id="subcate"value="<?= $row['subcategory'] ?>" required>
		  </div>
      
		  <div class="buttonWrapper">
			<button type="submit" id="su"name="su">
			  <span style="color:black;font-weight:bold;">UPDATE SUBCATEGORY</span>
			</button>
		  </div>
		</form>
</div>

<?php }}
else{?>
<marquee direction="right"behaviour="slide"scrollamount='28'><center><BR><BR><BR><BR><BR><BR><h3 style="font-size:50px;color:blue;">This subcategory is not available for now !!!</h3></center></marquee>
<?php }}?>
</center>
<script>
  <?php
   /**********************index.php**/
   if(isset($_SESSION['up']))
     { 
	?>
	  alertify.set('notifier','position', 'top-center');
     alertify.success('<?= $_SESSION['up'];?>');
   	   <?php
	  unset($_SESSION['up']);
      //if user refresh index.php after 1st time it will not see the message
      }
      ?>
	  </script>
</body>
</html>