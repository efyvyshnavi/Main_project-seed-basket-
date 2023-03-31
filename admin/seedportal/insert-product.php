
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


if(isset($_POST["submit"]))
{

    $Name=$_POST['name']; 
    $cid=$_POST['cid'];
    $sid=$_POST['sid'];
    $des=$_POST['des'];
    $price1=$_POST['price1'];
	$discount=$_POST['discount'];
	$stock=$_POST['stock'];

    $price2=$price1-($price1*$discount/100);
    // $target="imag/".basename($_FILES['images']['name']);
    $image=$_FILES['images']['name'];


    move_uploaded_file($_FILES['images']['tmp_name'],"images/".$image);
    // move_uploaded_file($_FILES['fname']['tmp_name'],"imageupload/".$img);



    $price2=$price1-($price1*$discount/100);
	$selectedSoilTypes = $_POST['soil'];
    
	$sql11="select * from tbl_product where (pname='$Name') and sellerid='$sellerid'";

	$res1=mysqli_query($con,$sql11);

	if (mysqli_num_rows($res1) > 0) {
	  
	  	$row = mysqli_fetch_assoc($res1);
	  if($Name==isset($row['pname']))
	  {
		
			$_SESSION['stat'] = "This product already exist";
      header('location:insert-product.php');
	  }
	  }
    else
    {
		$soilTypesString = implode(",", $selectedSoilTypes);	 
    $sql=mysqli_query($con,"INSERT INTO tbl_product(pname,catid,subid,pdescription,`image`,discount,price1,price2,stock,soil_type,sellerid) 
    VALUES('$Name','$cid','$sid','$des','$image','$discount','$price1','$price2','$stock','$soilTypesString','$sellerid')");
    $_SESSION['msg'] = "Product Details Registered Successfully!!";
    header('location:insert-product.php');
      
    }}
  	
    
  	
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

<div class="control-group">
<label class="control-label" for="basicinput">Category</label>
<div class="controls">
<select name="cid" class="span8 tip" onChange="getSubcat(this.value);"  required>
<option value="">Select Category</option> 
<?php $query=mysqli_query($con,"select * from tbl_category where status='1'");
while($row=mysqli_fetch_array($query))
{?>
<option value="<?php echo $row['catid'];?>"><?php echo $row['categoryName'];?></option>
<?php } ?>
</select>
</div>
</div>

									
<div class="control-group">
<label class="control-label" for="basicinput">Sub Category</label>
<div class="controls">
<select   name="sid" id="subcategory" class="span8 tip" required>
</select>
</div>
</div>


<div class="control-group">
  <label class="control-label" for="basicinput">Product Name</label>
  <div class="controls">
    <input type="text" name="name" placeholder="Enter Product Name" class="span8 tip" required pattern="^\s*[A-Za-z]{3,}$" oninvalid="this.setCustomValidity('Product Name must contain at least three letters and no other characters.')" oninput="setCustomValidity('')">
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="basicinput">Product Price Before Discount</label>
  <div class="controls">
    <input type="text" name="price1" placeholder="Enter Product Price" class="span8 tip" required pattern="[0-9]+(\.[0-9]+)?" title="Please enter a valid price (e.g. 10 or 10.99)">
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="basicinput">Enter the stock</label>
  <div class="controls">
    <input type="text" name="stock" placeholder="Enter the Price" class="span8 tip" required pattern="0|[1-9]\d*" title="Please enter a valid price (minimum value: 0)">
  </div>
</div>


<div class="control-group">
  <label class="control-label" for="basicinput">Discount %(Selling Price)</label>
  <div class="controls">
    <input type="text" name="discount" placeholder="Enter Product Price" class="span8 tip" required pattern="[0-9]+">
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="basicinput">Product Description</label>
  <div class="controls">
    <textarea name="des" placeholder="Enter Product Description" rows="6" class="span8 tip" ></textarea>
  </div>
</div>



<div class="control-group">
<label class="control-label" for="basicinput">Product Image1</label>
<div class="controls">
<input type="file" class="form-control" accept="image/gif, image/jpeg, image/png, image/jpg" name="images" id="image"required>
</div>
</div>

<div class="control-group">
  <label class="control-label" for="basicinput">Soil Type that suits the seed</label>
  <div class="controls">
  <input type="checkbox" name="soil[]" value="alluvial"required > Alluvial Soil<br>
<input type="checkbox" name="soil[]" value="black" > Black Soil<br>
<input type="checkbox" name="soil[]" value="red" > Red Soil<br>
<input type="checkbox" name="soil[]" value="clay" > Clay Soil<br>

  </div>
</div>




	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Insert</button>
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