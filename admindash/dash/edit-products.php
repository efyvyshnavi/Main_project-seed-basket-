
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
    $selectedSoilTypes = $_POST['soil'];
	$q_50_price = $_POST['q_50_price1'];
	$q_100_price = $_POST['q_100_price2'];
	$q_500_price = $_POST['q_500_price3'];
	$q_1000_price = $_POST['q_1000_price4'];

	$q_50_num_packets = $_POST['q_50_num_packets1'];
	$q_100_num_packets = $_POST['q_100_num_packets2'];
	$q_500_num_packets = $_POST['q_500_num_packets3'];
	$q_1000_num_packets = $_POST['q_1000_num_packets4'];

	$q_50_discount = $_POST['q_50_discount1'];
	$q_100_discount = $_POST['q_100_discount2'];
	$q_500_discount = $_POST['q_500_discount3'];
	$q_1000_discount = $_POST['q_1000_discount4'];

	$p_50 = (int)$q_50_price - ((int)$q_50_price * ((int)$q_50_discount/100));
	$p_100 = (int)$q_100_price - ((int)$q_100_price * ((int)$q_100_discount/100));
	$p_500 = (int)$q_500_price - ((int)$q_500_price * ((int)$q_500_discount/100));
	$p_1000 = (int)$q_1000_price - ((int)$q_1000_price * ((int)$q_1000_discount/100));

$sql=mysqli_query($con,"update  tbl_product set pname='$Name',catid='$cid',subid='$sid',pdescription='$des',soil_type='" . implode(",", $selectedSoilTypes) . "',q_50='$q_50_price ',q_100='$q_100_price ',q_500='$q_500_price ',q_1000='$q_1000_price ',p_50='$q_50_num_packets',p_100='$q_100_num_packets',p_500='$q_500_num_packets',p_1000='$q_1000_num_packets',d_50='$q_50_discount ',d_100='$q_100_discount ',d_500='$q_500_discount ',d_1000='$q_1000_discount ',p2_50='$p_50',p2_100='$p_100',p2_500='$p_500',p2_1000='$p_1000' where pid='$pid' ");
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
<?php 
$query=mysqli_query($con,"select tbl_product.*,tbl_category.categoryName,tbl_category.catid,tbl_subcategory.subcategory ,tbl_subcategory.subid  from tbl_product join tbl_category on tbl_category.catid=tbl_product.catid join tbl_subcategory on tbl_subcategory.subid=tbl_product.subid where tbl_product.pid='$pid'");
$cnt=1;
if (mysqli_num_rows($query) > 0) {
    // fetch product data as an associative array
    $product = mysqli_fetch_assoc($query);
    
    // display product data
    ?>
<div class="control-group">
  <label class="control-label" for="basicinput">Enter the stock</label>
  <div class="controls">
  <input type="checkbox" value="50" <?php if(isset($product['p_50']) && $product['p_50'] != "") echo 'checked'; ?>> 50 gm &nbsp&nbsp
  <label for="q_50_price1">Enter price:</label>
<input type="number"style="width: 280px;" name="q_50_price1" id="q_50_price1" min="0" max="9999" step="0.02" placeholder="Enter price" value="<?php echo isset($product) ? $product['p_50']  : ''; ?>"><br><br>

<label for="q_50_num_packets1">Enter number of packets:</label>
<input type="number" style="width: 280px;"name="q_50_num_packets1" id="q_50_num_packets1" min="1" max="999" placeholder="Enter number of packets" value="<?php echo isset($product) ? $product['s_50']  : ''; ?>"><br><br>

<label for="q_50_discount1">Enter discount %:</label>
<input type="text" name="q_50_discount1"  min="0" max="9999" step="0.02"style="width: 280px;"id="q_50_discount1" placeholder="Enter discount %" value="<?php echo isset($product) ? $product['d_50'] : ''; ?>"><br><br>



   <input type="checkbox" value="100" <?php if(isset($product['p_100']) && $product['p_100'] != "") echo 'checked'; ?>> 100 gm&nbsp&nbsp
    <label for="q_100_price1">Enter price:</label>
	<input type="number" name="q_100_price2" style="width: 280px;"min="0" max="9999" step="0.01" placeholder="Enter price" value="<?php echo isset($product) ? $product['p_100']: ''; ?>">
    <label for="q_100_num_packets1">Enter number of packets:</label>
	<input type="number" name="q_100_num_packets2"style="width: 280px;" min="1" max="999" placeholder="Enter number of packets" value="<?php echo isset($product) ? $product['s_100'] : ''; ?>"><br><br>
    <label for="q_100_discount1">Enter discount %:</label>
	<input type="text" name="q_100_discount2" style="width: 280px;"placeholder="Enter discount %" value="<?php echo isset($product) ? $product['d_100'] : ''; ?>"><br><br>




	<input type="checkbox" value="500" <?php if(isset($product['p_500']) && $product['p_500'] != "") echo 'checked'; ?>> 500 gm&nbsp&nbsp
	<label for="q_500_price1">Enter price:</label>
	<input type="number" name="q_500_price3"style="width: 280px;" min="0" max="9999" step="0.01" placeholder="Enter price" value="<?php echo isset($product) ? $product['p_500']: ''; ?>">
	<label for="q_500_num_packets1">Enter number of packets:</label>
	<input type="number" name="q_500_num_packets3"style="width: 280px;" min="1" max="999" placeholder="Enter number of packets" value="<?php echo isset($product) ? $product['s_500'] : ''; ?>"><br><br>
	<label for="q_500_discount1">Enter discount %:</label>
	<input type="text" name="q_500_discount3"style="width: 280px;" placeholder="Enter discount %" value="<?php echo isset($product) ? $product['d_500'] : ''; ?>"><br><br>




	<input type="checkbox" value="1000" <?php if(isset($product['p_1000']) && $product['p_1000'] != "") echo 'checked'; ?>> 1000 gm&nbsp&nbsp
    <label for="q_1000_price1">Enter price:</label>
	<input type="number" name="q_1000_price4" style="width: 280px;"min="0" max="9999" step="0.01" placeholder="Enter price" value="<?php echo isset($product) ?$product['p_1000']: ''; ?>">
	<label for="q_1000_num_packets1">Enter number of packets:</label>
	<input type="number" name="q_1000_num_packets4"style="width: 280px;" min="1" max="999" placeholder="Enter number of packets"  value="<?php echo isset($product) ? $product['s_1000'] : ''; ?>"><br><br>
    <label for="q_1000_discount1">Enter discount %:</label>
	<input type="text" name="q_1000_discount4" style="width: 280px;"placeholder="Enter discount %" value="<?php echo isset($product) ? $product['d_1000'] : ''; ?>"><br><br>
  </div>
</div>
<?php }?>


<div class="control-group">
<label class="control-label" for="basicinput">Product Description</label>
<div class="controls">
<textarea  name="des"  placeholder="Enter Product Description" rows="6" class="span8 tip">
<?php echo htmlentities($row['pdescription']);?>
</textarea>  
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Product Image1</label>
<div class="controls">
<img src="images/<?php echo htmlentities($row['image']);?>" width="200" height="100"> <a href="update-image1.php?id=<?php echo $row['pid'];?>">Change Image</a>
</div>
</div>

<div class="control-group">
  <label class="control-label" for="basicinput">Soil Type that suits the seed</label>
  <div class="controls">
    <input type="checkbox" name="soil[]" value="alluvial" <?php if(isset($_POST['soil']) && in_array('alluvial', $_POST['soil'])) echo 'checked'; ?> required> Alluvial Soil<br>
    <input type="checkbox" name="soil[]" value="black" <?php if(isset($_POST['soil']) && in_array('black', $_POST['soil'])) echo 'checked'; ?>> Black Soil<br>
    <input type="checkbox" name="soil[]" value="red" <?php if(isset($_POST['soil']) && in_array('red', $_POST['soil'])) echo 'checked'; ?>> Red Soil<br>
    <input type="checkbox" name="soil[]" value="clay" <?php if(isset($_POST['soil']) && in_array('clay', $_POST['soil'])) echo 'checked'; ?>> Clay Soil<br>
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