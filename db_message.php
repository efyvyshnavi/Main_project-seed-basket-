
<?php
include("include/config.php");
session_start();
if (isset($_SESSION['message'])) {
    echo "<script>alert('" . $_SESSION['message'] . "')</script>";
    unset($_SESSION['message']);
}
$email=$_SESSION['email'];

							$sqlq="SELECT logid from login where email='$email'";
							$resu = mysqli_query($con, $sqlq);
							$row = mysqli_fetch_assoc($resu);
							$logid= $row['logid'];
						
							
							$sqlq2="SELECT sellerid from sellerreg where logid='$logid'";
							$resu2 = mysqli_query($con, $sqlq2);
							$row = mysqli_fetch_assoc($resu2);
							$seller= $row['sellerid'];
							
							
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
    $sql = "INSERT INTO tbl_requests (sellerid,`type`, details,status) VALUES ('$seller', '$requestType', '$requestDetails','Pending')";
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

<style>
form {
  display: inline-block;
  margin: 10px;
}
button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding:6px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 5px;
}
button:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}
button.accept {
  background-color: #4CAF50;
}
button.reject {
  background-color: #f44336;
}
button.accept:disabled {
  background-color: #7dc97f;
}
button.reject:disabled {
  background-color: #f29191;
}
span.accepted {
  color: green;
  font-weight: bold;
}
span.rejected {
  color: red;
  font-weight: bold;
}
</style>

<?php
// Your existing code here
?>

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
								<h3>Messages from Deliveryboys</h3>
							</div>
							<div class="module-body"style="padding:33px">

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
<?php
$email=$_SESSION['email'];
$sqlq="SELECT logid from login where email='$email'";
$resu = mysqli_query($con, $sqlq);
$roww = mysqli_fetch_assoc($resu);
$logid= $roww['logid'];


$sqlq5="SELECT sellerid from sellerreg where logid='$logid'";
$resu5 = mysqli_query($con, $sqlq5);
$roww = mysqli_fetch_assoc($resu5);
$sellerid= $roww['sellerid'];
                                    // Select all requests from tbl_dbrequest
                                    $query = mysqli_query($con, "SELECT tbl_dbrequest.*, tbl_deliverboyrequest.db_name 
                                    FROM tbl_dbrequest 
                                    LEFT JOIN tbl_deliverboyrequest ON tbl_dbrequest.db_id = tbl_deliverboyrequest.db_id where sellerid='$sellerid'");

                                    // Check if any requests exist
                                    if (mysqli_num_rows($query) > 0) {
                                      // Loop through each request and display it
                                      $count =1;
                                      while ($row = mysqli_fetch_assoc($query)) {
                                        // Get the request details
                                        $options = $row['options'];
                                        $note = $row['note'];
                                        $db_id = $row['db_name'];
                                        $orderid = $row['orderid'];
                                        $sellerid=$row['sellerid'];
                        
                                    
                                        $db_status_query = mysqli_query($con, "SELECT db_status, note FROM tbl_dbrequest WHERE orderid='$orderid' AND note='$note'");
$db_status_row = mysqli_fetch_assoc($db_status_query);
$db_status = $db_status_row['db_status'];
echo "<p><strong style='color: blue;'>Message $count:</strong></p>";
                                       
                                        echo "<p><strong>Options:</strong> $options<br><strong>Note:</strong> $note<br><strong>Deliveryboy Name:</strong> $db_id<br><strong>Order ID:</strong> $orderid</p>";
                                    
                                        

if ($db_status == 0) {
    echo "<form action=\"process_request.php?note=$note\" method=\"post\">";
    echo "<input type=\"hidden\" name=\"orderid\" value=\"$orderid\">";
    echo "<input type=\"hidden\" name=\"note\" value=\"$note\">";
    echo "<button type=\"submit\" name=\"action\" value=\"accept\">Accept</button>";
    echo "<button type=\"submit\" name=\"action\" value=\"reject\">Reject</button>";
    echo "</form>";
} elseif ($db_status == 1) {
    echo "<p><strong>Status:</strong> <span style=\"color:green;font-weight:bold;\">Accepted</span></p>";
} elseif ($db_status == 2) {
    echo "<p><strong>Status:</strong> <span style=\"color:red;font-weight:bold;\">Rejected</span></p>";
}
                                        
                                          $count++; 
                                      }
                                
                                    }
                                    
                                    
else {
  echo "No Messages found.";
}?>

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