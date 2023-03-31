<?php
session_start();
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
include ('config.php');
?>
<!DOCTYPE html>
<head>
<title>Online Seed Portal</title>

<link rel="stylesheet" href="sty.css" type="text/css"/>
		<link rel="stylesheet" href="seller.css" type="text/css"/>
		<link rel="stylesheet" href="page.css" type="text/css"/>
		<link rel="stylesheet" href="head.css" type="text/css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
		<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
		<script src="https://kit.fontawesome.com/2bbac3a66c.js" crossorigin="anonymous" ></script>
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
		<center style="color:white;padding:1px;font-size:20px;"><h2>Online Seed Basket</h2></center>
    <center style="color:white;padding:1px;font-size:20px;"><h3>Seller Panel</h3></center>
	<br>
  
  <a href="product.php"class="icon-a"style="color:white;"><i class="fa fa-tasks icons"></i>   Insert Product</a>
  <a href="manageproducts.php"class="icon-a"style="color:white;"><i class="fa fa-list-alt icons"></i>   Manage Products</a>
  <a href="#"class="icon-a"style="color:white;"><i class="fa fa-list-alt icons"></i>   Manage Users</a>
  <a href="#" class="icon-a"style="color:white;"><i class="fa fa-shopping-bag icons"></i>   Today's Order</a>
  <a href="#" class="icon-a"style="color:white;"><i class="fa fa-dashboard icons"></i>   Pending Orders</a>
  <a href="#" class="icon-a"style="color:white;"><i class="fa fa-dashboard icons"></i>   Delivered Orders</a>
 
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
	  <div class="module-head">
		  <h3>Manage Products</h3>
	  </div>
	  <div class="module-body table">
		  <table style="width:50%"cellpadding="10" cellspacing="3" border="3">
				  <tr>
					  <th>#</th>
					  <th>PName</th>
					  <th>Catid</th>
					  <th>Subid</th>
            <th>Creation date</th>
					  <th>Last Updated</th>
					  <th>Status</th>
					  <th>Edit</th>
				  </tr>
				  
                
<?php 
$query=mysqli_query($conn,"select tbl_product.pname,tbl_product.creationDate,tbl_product.updationDate,tbl_product.pid,tbl_product.availability,tbl_category.categoryName,tbl_subcategory.subcategory,tbl_category.status from tbl_product join tbl_category on tbl_category.catid=tbl_product.catid join tbl_subcategory on tbl_subcategory.subid=tbl_product.subid");

$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>									
	
            								
                <tr>
					  <td><?php echo htmlentities($cnt);?></td>
					  <td><?php echo htmlentities($row['pname']);?></td>
            <td><?php echo htmlentities($row['categoryName']);?></td>
            <td><?php echo htmlentities($row['subcategory']);?></td>
					  <td> <?php echo htmlentities($row['creationDate']);?></td>
					  <td><?php echo htmlentities($row['updationDate']);?></td>
				  
            <td>
												
                        <?php
                        if($row['availability']=='In Stock'){
                          echo '<p><a href="pinactivate.php?id='.$row['pid'].'$status=In Stock"style="color:red;font-size:17px;">Disable</a></p>';
                        }else{
                          echo '<p><a href="pactivate.php?id='.$row['pid'].'$status=Out Stock"style="color:green;font-size:17px;">Enable</a></p>';
                        }
                        ?>
            </td>
				<td><a href="edit-product.php"style="color:blue;font-size:17px;">Edit</a></td>
				
				</tr>
				<?php $cnt=$cnt+1; } ?>
		   </table>
	    </div>
    </div>						
  </div><!--/.content-->
</center>
	  
<script>
  <?php
   /**********************index.php**/
   if(isset($_SESSION['active']))
     { 
	?>
	  alertify.set('notifier','position', 'top-center');
       alertify.success('<?= $_SESSION['active'];?>');
   	   <?php
	   unset($_SESSION['active']);
      }
      ?>
</script>
	  
<script>
  <?php
   /**********************index.php**/
   if(isset($_SESSION['inactive']))
     { 
	?>
	  alertify.set('notifier','position', 'top-center');
       alertify.success('<?= $_SESSION['inactive'];?>');
   	   <?php
	   unset($_SESSION['inactive']);
      }
      ?>
</script>
</body>
</html>
