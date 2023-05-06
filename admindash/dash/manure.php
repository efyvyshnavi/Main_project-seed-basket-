
<?php
include("include/config.php");
session_start();
$email=$_SESSION['email'];
if(strlen($_SESSION['email'])==0)
	{	
header('location:../../../../../../vs/admin/seedportal/shopping/login.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
$targetDir = "images/";

$email=$_SESSION['email'];
$sqlq="SELECT logid from login where email='$email'";
$resu = mysqli_query($con, $sqlq);
$row = mysqli_fetch_assoc($resu);
$logid= $row['logid'];

$sqlq2="SELECT sellerid from sellerreg where logid='$logid'";
$resu2 = mysqli_query($con, $sqlq2);
$row = mysqli_fetch_assoc($resu2);
$sellerid= $row['sellerid'];


if(isset($_POST["submit2"]))
{

    $Name=$_POST['mname']; 
    $stock = $_POST['mstock'];
    $des=$_POST['des'];
	// $target="imag/".basename($_FILES['images']['name']);
    $image=$_FILES['m_image']['name'];
    move_uploaded_file($_FILES['m_image']['tmp_name'],"manure/".$image);
    // move_uploaded_file($_FILES['fname']['tmp_name'],"imageupload/".$img);
	
    $price= $_POST['price'];
	$discount = $_POST['dis'];

	$price2 = (int)$price - ((int)$price * ((int)$discount/100));
	$sql11="select * from tbl_manure where (mname='$Name') and sellerid='$sellerid'";

	$res1=mysqli_query($con,$sql11);

	if (mysqli_num_rows($res1) > 0) {
	  
	  	$row = mysqli_fetch_assoc($res1);
	  if($Name==isset($row['pname']))
	  {
		
			$_SESSION['stat'] = "This manure already exist";
      header('location:manure.php');
	  }
	  }
    else
    {
			 
    $sql=mysqli_query($con,"INSERT INTO tbl_manure (mname,mstock,mdes,`m_image`,mprice,dis,mprice2,sellerid) 
	VALUES ('$Name','$stock','$des', '$image', '$price','$discount','$price2','$sellerid')");
    $_SESSION['msg1'] = "Product Details Registered Successfully!!";
    header('location:manure.php');
      
    }}
  	
    
  	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Add Manure</title>
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
								<h3>Add Manure</h3><a href="manage.php"style="position:absolute;right:230px;top:102px;font-weight:bold;text-decoration: none;"><span style="font-size: 1.0em;">&larr; Click to Go Back</a>
							</div>
							<div class="module-body">

									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg1']);?><?php echo htmlentities($_SESSION['msg']="");?>
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



<div class="control-group">
  <label class="control-label" for="basicinput">Product Name (Quantity)</label>
  <div class="controls">
    <input type="text" name="mname" placeholder="Enter Product Name" class="span8 tip" oninvalid="this.setCustomValidity('Product Name must contain at least three letters and no other characters.')" oninput="setCustomValidity('')">
  </div>
</div>

<!--<div class="control-group">
  <label class="control-label" for="basicinput">Enter the stock</label>
  <div class="controls">
    <input type="text" name="stock" placeholder="Enter the Price" class="span8 tip" required pattern="0|[1-9]\d*" title="Please enter a valid price (minimum value: 0)">
  </div>
</div>-->

<div class="control-group">
  <label class="control-label" for="basicinput">Enter the stock</label>
  <div class="controls">
    <input type="number" name="mstock" min="0" max="9999" step="0.01" placeholder="Enter stock">
    <input type="number" name="price" min="0" max="9999" step="0.01" placeholder="Enter price" ><br><br>
    <input type="text" name="dis" placeholder="Enter discount %" ><br>
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="basicinput">Product Description</label>
  <div class="controls">
    <textarea name="mdes" placeholder="Enter Product Description" rows="6" class="span8 tip" ></textarea>
  </div>
</div>



<div class="control-group">
<label class="control-label" for="basicinput">Product Image1</label>
<div class="controls">
<input type="file" class="form-control" accept="image/gif, image/jpeg, image/png, image/jpg" name="m_image" id="image"required>
</div>
</div>


	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit2" class="btn">Insert</button>
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
<?php }?>