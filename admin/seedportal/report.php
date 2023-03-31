<?php
include("include/config.php");
require_once('tcpdf/tcpdf.php');


session_start();
$email=$_SESSION['email'];
ob_start(); // start output buffering
// Set document information
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('PDF');
$pdf->SetTitle('Sales Report');
$pdf->SetSubject('Sales Report');
$pdf->SetKeywords('Sales Report');

// Set default font
$pdf->SetFont('helvetica', '', 12);

// Add a page
$pdf->AddPage();


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
								<h3>Daily Report</h3>
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
	
    $html = '<br><h1 style="font-size:18px;margin: 0 auto; text-align:center;">Sales Report</h1><br>
	          <div style="border: 1px solid black; padding:16px;">
	
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
            
                <th style="border: 1px solid black;margin-right: 50px; ">Date</th>
                <th style="border: 1px solid black; padding: 14px;">Total Revenue</th>
                <th style="border: 1px solid black; padding: 14px;">Number of Orders</th>
                <th style="border: 1px solid black; padding: 14px;">Average Order Value</th>
            </tr>';
    
    // Output report rows
    while($row = $result->fetch_assoc()) {
        $html .= "<tr>
                    <td style='border: 2px solid black; padding: 14px;'>" . $row["order_date"] . "</td>
                    <td style='border: 1px solid black; padding: 14px;'>" . $row["total_revenue"] . "</td>
                    <td style='border: 1px solid black; padding: 14px;'>" . $row["num_orders"] . "</td>
                    <td style='border: 1px solid black; padding: 14px;'>" . $row["avg_order_value"] . "</td>
                  </tr>";
    }

    $html .= '</table>
              </div>';


ob_end_clean();
    // Write sales report table to PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Close database connection
    $con->close();

    // Output PDF to the browser
    $pdf->Output('sales_report.pdf', 'I'); // 'I' opens the PDF in the browser window
}
?>
<!-- Add a link/button to download the PDF file -->
<a href="sales_report.pdf" download>Download Sales Report</a>
?>
<div>

	
						
						
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
