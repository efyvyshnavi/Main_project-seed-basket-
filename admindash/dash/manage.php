
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
<style>
    form {
  background-color: #f2f2f2;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  width: 400px;
  margin: 0 auto;
  
}

select {
  padding: 5px;
  border-radius: 5px;
  border: 1px solid #ccc;
  width: 26%;
  margin-bottom: 10px;
  position:absolute;
  top:270px;
}

</style>
<style>
    /* Style the select box */
    select {
        padding: 2px;
        font-size: 12px;
        border: none;
        border-radius: 5px;
        background-color: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        cursor: pointer;
        color: #555;
        font-family: 'Segoe UI', sans-serif;
        transition: all 0.3s ease;
    }

    /* Style the select box when it is clicked */
    select:focus {
        outline: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Style the select box arrow */
    select::-ms-expand {
        display: none;
    }

    select::-webkit-select-placeholder {
        color: #888;
    }

    select:-moz-placeholder {
        color: #888;
    }

    select::-moz-placeholder {
        color: #888;
    }

    select:-ms-input-placeholder {
        color: #888;
    }

    /* Style the select box options */
    option {
        padding: 10px;
        font-size: 15px;
        background-color: white;
        color: #555;
        font-family: 'Segoe UI', sans-serif;
        transition: all 0.3s ease;
    }

    /* Style the select box option when it is selected */
    option:checked {
        background-color: #719ECE;
        color: #fff;
    }
</style>
<body>
<?php include('include/header.php');?>
	<div class="wrapper text-center">
		<div class="container">
			<div class="row">
<?php include('include/sidebar.php');?>				
			<div class="span9">
					<div class="content">
						<div class="module">
							<div class="module-head">
                            <center><h3>Add your Products</h3></center>
							</div><br>
							<div class="module-body">
                            <?php                     
$email = $_SESSION['email'];
$sqlq = "SELECT logid FROM login WHERE email='$email'";
$resu = mysqli_query($con, $sqlq);
$row = mysqli_fetch_assoc($resu);
$logid = $row['logid'];

$sqlq4 = "SELECT sellerid FROM sellerreg WHERE logid='$logid'";
$resu4 = mysqli_query($con, $sqlq4);
$row = mysqli_fetch_assoc($resu4);
$sellerid = $row['sellerid'];

?>
<center>
<?php
  // Check if year and month are set
   {
    echo "<h5>Please select the product type you want to insert</h5>";
  }
?>
</center><br>

<!-- Display form input fields here -->
<form method="post">
    <!-- Month select field -->
     <!-- Month select field -->
     <select name="veg" onchange="redirectPage(this.value);">
        <option value="" disabled selected style="text-align:center">Click here to select an option</option>
        <option value="Vegetables">Vegetables</option>
        <option value="Manures">Manures</option>
    </select><br><br>
   
    <br>
    
    <!-- Year select field -->

</form><br><br><br>



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
<script>
    function redirectPage(selectedValue) {
        // Redirect the user to the corresponding page based on the selected value
        switch(selectedValue) {
            case "Vegetables":
                window.location.href = "insert-product.php";
                break;
            case "Manures":
                window.location.href = "manure.php";
                break;
            default:
                // If no option is selected, don't redirect
                return false;
        }
    }
</script>
</body>
<?php } ?>