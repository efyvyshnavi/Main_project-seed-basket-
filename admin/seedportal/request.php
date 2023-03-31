
<?php
include("include/config.php");
session_start();
$email=$_SESSION['email'];
if(strlen($_SESSION['email'])==0)
	{	
header('location:../../../../../../vs/admin/seedportal/shopping/login.php');
}
else{
if (isset($_POST['submitRequest'])) {
    $requestType = $_POST['requestType'];
    $requestDetails = $_POST['des'];
    // $sellerId = $_SESSION['seller_id'];
    
    // Save the request in the database
    $sql = "INSERT INTO tbl_requests (sellerid,`type`, details,status) VALUES ('1', '$requestType', '$requestDetails','Pending')";
    mysqli_query($con, $sql);
    $_SESSION['success_message'] = "Your request has been submitted successfully";
    header('location: request.php');
    exit();
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
								<h3>Request the admin</h3>
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
<center>
<?php
if (isset($_SESSION['success_message'])) {
    echo '<div style="color: green;font-weight: bold;">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']);
}
?></center>

<center>
<?php
if (isset($_SESSION['success'])) {
    echo '<div style="color: red;font-weight: bold;">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}
?></center>
									<br />

                                    <form action="request.php" method="post" enctype="multipart/form-data">

<div class="control-group">
<label class="control-label" for="basicinput">Request Type</label>
<div class="controls">
<select name="requestType" class="span8 tip" id="requestType" required>
<option value="newCategory">New Category</option>
        <option value="newSubcategory">New Subcategory</option>
        <option value="other">Other</option>
</select>
</div>
</div>


<div class="control-group">
  <label class="control-label" for="basicinput">Details</label>
  <div class="controls">
    <textarea name="des" placeholder="Enter Product Description" rows="6" class="span8 tip" pattern=".*\S+.*" title="Please enter some text in the textarea"></textarea>
  </div>
</div>



	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submitRequest"  class="btn">submit request</button>
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