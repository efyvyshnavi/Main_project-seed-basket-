
<?php
include("include/config.php");
session_start();
$email=$_SESSION['email'];

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-RN+/sAymUxN/zUcH/Am0Ypv/26iBpPq3tr+yWZm8LlXa3e3qgeklxOwYwOvN0VRMVj2QJJbIaj0rL8rL+f9Pcw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<style>
    .sales-table {
        border-collapse: collapse;
        width: 100%;
    }
    .sales-table th, .sales-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    .sales-table th {
        background-color: #f2f2f2;
        color: #555;
    }
    .sales-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    .sales-table tr:hover {
        background-color: #ddd;
    }
    .sales-table .download-icon {
        margin-left: 10px;
        vertical-align: middle;
    }
</style>
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
								<h3>Sales Report</h3>
							</div>
							<div class="module-body">
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


// Get total revenue
$sql = "SELECT SUM(c.quantity * p.price1) AS total_revenue 
FROM tbl_cart c
JOIN tbl_product p ON c.pid = p.pid
WHERE c.sellerid = '$sellerid'
AND c.orderid <> 0";
$result = $con->query($sql);
$row = $result->fetch_assoc();
$total_revenue = $row["total_revenue"];


// Get number of orders
$sql = "SELECT COUNT(*) AS num_orders FROM orders WHERE sellerid = '$sellerid'";
$result = $con->query($sql);
$row = $result->fetch_assoc();
$num_orders = $row["num_orders"];

// Get average order value
$sql = "SELECT AVG(amount) AS avg_order_value FROM tbl_payment WHERE sellerid = '$sellerid' AND payment_status = 'completed'";
$result = $con->query($sql);
$row = $result->fetch_assoc();
$avg_order_value = $row["avg_order_value"];


// Get daily sales report
$sql = "SELECT DATE_FORMAT(o.orderDate, '%Y-%m-%d') AS order_date, 
               SUM(c.quantity * p.price1) AS total_revenue,
               COUNT(DISTINCT o.orderid) AS num_orders,
               AVG(p.price1) AS avg_order_value
        FROM orders o
        JOIN tbl_cart c ON c.orderid = o.orderid
        JOIN tbl_product p ON c.pid = p.pid
        WHERE o.sellerid = '$sellerid'
        GROUP BY DATE_FORMAT(o.orderDate, '%Y-%m-%d')";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    // Output report header
    $html = '<table  class="sales-table">
    <tr>
        <th>Date</th>
        <th>Total Revenue</th>
        <th>Number of Orders</th>
        <th>Average Order Value</th>
    </tr>';
    // Output report rows
    
while($row = $result->fetch_assoc()) {
    $html .= "<tr>
                <td>" . $row["order_date"] . "</td>
                <td>" . $row["total_revenue"] . "</td>
                <td>" . $row["num_orders"] . "</td>
                <td>" . $row["avg_order_value"] . "</td>
              </tr>";
}

$html .= '</table><br>';

$download_link = 'download.php'; // Replace with the URL of your download script
    $download_filename = 'sales_report.csv'; // Replace with the desired filename for the download
    $download_button = '<div style="text-align: right;"><a href="report.php" class="btn btn-primary"><i class="fas fa-download"></i> Download Report</a></div>';
    echo $html . $download_button;
}
?>

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
