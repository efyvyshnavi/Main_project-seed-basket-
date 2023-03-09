<?php
session_start();
include ('config.php');
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

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
	header('location:category.php');
}
else
{
	echo "no";
}
}

?>

<!Doctype HTML>
	<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="styl.css" type="text/css"/>
		<link rel="stylesheet" href="category.css" type="text/css"/>
		<script src="https://kit.fontawesome.com/2bbac3a66c.js" crossorigin="anonymous" ></script>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
		<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="mainheader.css" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
	<body>
		
	<body>
	
	<div id="mySidenav" class="sidenav">
		<center style="color:white;padding:1px;font-size:20px;">Online Seed Basket</center>
	<br>
  
  <a href="category.php"class="icon-a"><i class="fa fa-shopping-bag icons"></i>   Category</a>
  <a href="subcategory.php"class="icon-a"><i class="fa fa-shopping-bag icons"></i>   Sub Category</a>
  <a href="product.php"class="icon-a"><i class="fa fa-tasks icons"></i>   Insert Product</a>
  <a href="manageproducts.php"class="icon-a"><i class="fa fa-list-alt icons"></i>   Manage Products</a>
  <a href="#"class="icon-a"><i class="fa fa-list-alt icons"></i>   Manage Users</a>
  <a href="#" class="icon-a"><i class="fa fa-shopping-bag icons"></i>   Today's Order</a>
  <a href="#" class="icon-a"><i class="fa fa-dashboard icons"></i>   Pending Orders</a>
  <a href="#" class="icon-a"><i class="fa fa-dashboard icons"></i>   Delivered Orders</a>
 
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
$id=$_GET['catid'];
$query=mysqli_query($conn,"select * from tbl_category where catid='$id'");
while($row=mysqli_fetch_array($query))
{
?>
	<div class="cardStyle">
		  <form id="category" method="POST"action="edit-category.php"> 		
<h2 class="formTitle">
			 Edit Category
			</h2>
			<input type="hidden"name="cat_id"value="<?= $row['catid'] ?>">
		  <div class="inputDiv">
			<label class="inputLabel" for="cat">Enter Category Name</label>
			<input type="text"name="category" id="category"value="<?= $row['categoryName'] ?>" required>
		  </div>
		  
		  <div class="inputDiv">
	  <label class="inputLabel" for="text">Descripton</label>
	  <textarea class="span8" id="description"name="description"rows="5"><?= $row['categoryDescription'] ?></textarea>
	  </div>
		  
		  <div class="buttonWrapper">
			<button type="submit" id="submit"name="submit">
			  <span style="color:black;font-weight:bold">Update Category</span>
			</button>
		  </div>	
		</form>
</div>
<?php } ?>	
</center>
<script>
  <?php
   /**********************index.php**/
   if(isset($_SESSION['msg']))
     { 
	?>
	  alertify.set('notifier','position', 'top-center');
     alertify.success('<?= $_SESSION['msg'];?>');
   	   <?php
	  unset($_SESSION['msg']);
      //if user refresh index.php after 1st time it will not see the message
      }
      ?>
	  </script>
</body>
</html>