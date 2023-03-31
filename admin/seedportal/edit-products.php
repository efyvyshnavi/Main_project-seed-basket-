
<?php
session_start();
include('include/config.php');
$email=$_SESSION['email'];
if(strlen($_SESSION['email'])==0)
 {	
header('location:../../../../../../vs/admin/seedportal/shopping/login.php');
}
 else{
$pid=intval($_GET['id']);// product id
if(isset($_POST['submit']))
{
	
    $Name=$_POST['name']; 
    $cid=$_POST['cid'];
    $sid=$_POST['sid'];
    $des=$_POST['des'];
    $price1=$_POST['price1'];
	  $discount=$_POST['discount'];
    $avail=$_POST['avail'];
    $price2=$price1-($price1*$discount/100);


$sql=mysqli_query($con,"update  tbl_product set pname='$Name',catid='$cid',subid='$sid',pdescription='$des',price1='$price1',discount='$discount',availability='$avail',price2='$price2' where pid='$pid' ");
$_SESSION['msg']="Product Updated Successfully !!";

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Insert Product</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

   <script>
function getSubcat(val) {
	$.ajax({
	type: "POST",
	url: "get_subcat.php",
	data:'cat_id='+val,
	success: function(data){
		$("#subcategory").html(data);
	}
	});
}
function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>	


</head>
<body>
<?php include('include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
<?php include('include/sidebar.php');?>				
			<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Insert Product</h3>
							</div>
							<div class="module-body">

									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>


									<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

									<br />

			<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">

<?php 

$query=mysqli_query($con,"select tbl_product.*,tbl_category.categoryName,tbl_category.catid,tbl_subcategory.subcategory ,tbl_subcategory.subid  from tbl_product join tbl_category on tbl_category.catid=tbl_product.catid join tbl_subcategory on tbl_subcategory.subid=tbl_product.subid where tbl_product.pid='$pid'");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
  


?>


<div class="control-group">
<label class="control-label" for="basicinput">Category</label>
<div class="controls">
<select name="cid" class="span8 tip" onChange="getSubcat(this.value);"  required>
<option value="<?php echo htmlentities($row['catid']);?>"><?php echo htmlentities($row['categoryName']);?></option> 
<?php $query=mysqli_query($con,"select * from tbl_category");
while($rw=mysqli_fetch_array($query))
{
	if($row['categoryName']==$rw['categoryName'])
	{
		continue;
	}
	else{
	?>

<option value="<?php echo $rw['catid'];?>"><?php echo $rw['categoryName'];?></option>
<?php }} ?>
</select>
</div>
</div>

									
<div class="control-group">
<label class="control-label" for="basicinput">Sub Category</label>
<div class="controls">

<select   name="sid"  id="subcategory" class="span8 tip" required>
<option value="<?php echo htmlentities($row['subid']);?>"><?php echo htmlentities($row['subcategory']);?></option>
</select>
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Product Name</label>
<div class="controls">
<input type="text"    name="name"  placeholder="Enter Product Name" value="<?php echo htmlentities($row['pname']);?>" class="span8 tip" >
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Product Price Before Discount</label>
<div class="controls">
<input type="text"    name="price1"  placeholder="Enter Product Price" value="<?php echo htmlentities($row['price1']);?>"  class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput"> Discount %(Selling Price)</label>
<div class="controls">
<input type="text"    name="discount"  placeholder="Enter Product Price" value="<?php echo htmlentities($row['price2']);?>" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Product Description</label>
<div class="controls">
<textarea  name="des"  placeholder="Enter Product Description" rows="6" class="span8 tip">
<?php echo htmlentities($row['pdescription']);?>
</textarea>  
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Product Availability</label>
<div class="controls">
<select   name="avail"  id="productAvailability" class="span8 tip" required>
<option value="<?php echo htmlentities($row['availability']);?>"><?php echo htmlentities($row['availability']);?></option>
<option value="In Stock">In Stock</option>
<option value="Out of Stock">Out of Stock</option>
</select>
</div>
</div>



<div class="control-group">
<label class="control-label" for="basicinput">Product Image1</label>
<div class="controls">
<img src="images/<?php echo htmlentities($row['image']);?>" width="200" height="100"> <a href="update-image1.php?id=<?php echo $row['pid'];?>">Change Image</a>
</div>
</div>


<?php } ?>
	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Update</button>
											</div>
										</div>
									</form>
							</div>
						</div>


	
						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->
	<script>
  const discountField = document.querySelector('input[name="discount"]');
  const productPriceField = document.querySelector('input[name="price1"]');

  discountField.addEventListener('blur', () => {
    const discount = parseFloat(discountField.value);
    const productPrice = parseFloat(productPriceField.value);

    if (discount > productPrice) {
      alert("Discount cannot be greater than the product price.");
      discountField.value = '';
      discountField.focus();
    }
  });
</script>
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
</body>
<?php } ?>