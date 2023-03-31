
<?php
session_start();
include('include/config.php');
$email=$_SESSION['email'];
if(strlen($_SESSION['email'])==0)
	{	
header('location:../../../../../../vs/admin/seedportal/shopping/login.php');
}
else{
$email=$_SESSION['email'];
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from products where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Product deleted !!";
		  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Manage Products</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
		<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
</head>
<body>
<?php include('include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
<?php include('include/sidebar.php');?>				
			<div class="span9">
					<div class="content">

	<div class="module"style="width: 900px; overflow: auto;">
							<div class="module-head">
								<h3>Manage Products</h3>
							</div>
							<div class="module-body table">
	<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

									<br />

							
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Product Name</th>
											
											<th>Category </th>
											<th>Subcategory</th>
											<th>Product Creation Date</th>
											<th>Customer Review</th>
											<th>Action</th>
											<th>Edit</th>
										</tr>
									</thead>
									<tbody>

<?php 

$email=$_SESSION['email'];
$sqlq="SELECT logid from login where email='$email'";
$resu = mysqli_query($con, $sqlq);
$row = mysqli_fetch_assoc($resu);
$logid= $row['logid'];

$sqlq4="SELECT sellerid from sellerreg where logid='$logid'";
$resu4 = mysqli_query($con, $sqlq4);
$row = mysqli_fetch_assoc($resu4);
$sellerid= $row['sellerid'];

$query=mysqli_query($con,"select tbl_product.pname,tbl_product.image,tbl_product.creationDate,tbl_product.pid,tbl_product.availability,tbl_category.categoryName,tbl_subcategory.subcategory,tbl_category.status from tbl_product join tbl_category on tbl_category.catid=tbl_product.catid join tbl_subcategory on tbl_subcategory.subid=tbl_product.subid and tbl_product.sellerid='$sellerid'");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['pname']);?></td>
											<td><?php echo htmlentities($row['categoryName']);?></td>
											<td> <?php echo htmlentities($row['subcategory']);?></td>
											<td><?php echo htmlentities($row['creationDate']);?></td>
											<td><a style="color:blue;font-size:13px;"href="review.php?id=<?php echo $row['pid']?>">Customer reviews</a></td>
											<td>
																				
											<?php
											if($row['availability']=='In Stock'){
											echo '<p><a href="pinactivate.php?id='.$row['pid'].'$status=In Stock"style="color:red;font-size:13px;">Disable</a></p>';
											}else{
											echo '<p><a href="pactivate.php?id='.$row['pid'].'$status=Out Stock"style="color:green;font-size:13px;">Enable</a></p>';
											}
											?></td>
											<td><a style="color:blue;font-size:13px;"href="edit-products.php?id=<?php echo $row['pid']?>">Edit</a></td>
				
											
										</tr>
										<?php $cnt=$cnt+1; } ?>
										
								</table>
							</div>
						</div>						

						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->



	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
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
<?php } ?>