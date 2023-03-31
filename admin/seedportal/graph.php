
<?php
include("include/config.php");
session_start();
$email=$_SESSION['email'];
if(strlen($_SESSION['email'])==0)
	{	
header('location:../../../../../../vs/admin/seedportal/shopping/login.php');
}
else{

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

	<div class="wrapper text-center">
		<div class="container">
			<div class="row">
<?php include('include/sidebar.php');?>				
			<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
                            <center><h3>Sales by product (Maximum sale)</h3></center>
							</div><br><br>
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

$sql = "SELECT p.pname, p.sellerid, SUM(c.quantity) as total_quantity 
FROM tbl_product p 
JOIN tbl_cart c ON p.pid = c.pid 
JOIN orders o ON c.orderid = o.orderid 
WHERE p.sellerid = '$sellerid' 
GROUP BY p.pname, p.sellerid 
ORDER BY total_quantity DESC
";

$result = mysqli_query($con, $sql);

// Process the data and generate the graph
$data = array();

while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['pname']] = $row['total_quantity'];
}

$labels = array_keys($data);
$values = array_values($data);

// Use Chart.js to generate the graph
// Replace 'chart-container' with the ID of the HTML element where you want to display the chart
?>
<div style="position: relative;">
    <canvas id="chart-container"></canvas>
    <div style="position: absolute; top: -40px; left: 78%; transform: translateX(-50%); font-weight: bold;">
        X Axis Label : Products<br>
		Y Axis Label : Quantity Sold
    </div>
</div>

<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
<script>
    var ctx = document.getElementById('chart-container').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Total Quantity Sold',
                data: <?php echo json_encode($values); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 0.5,
                barThickness: 40 // adjust the size of the bar
            }]
        },
    });
</script>



                                    
						</div>


	
						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->





	<div class="wrapper text-center">
		<div class="container">
			<div class="row">		
			<div class="span9">
					<div class="content"style=" display: block;
    margin: 0 auto;
    text-align:center;margin-left:300px;left:190px;">

						<div class="module"style="width:152.5%;height:102%">
							<div class="module-head">
                            <h3>Revenue graph </h3>
							</div>
							<div class="module-body"><br>
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
// Query to calculate repeat purchase rate and average order value
// Execute SQL query
$sql = "SELECT SUM(amount) AS revenue, DATE_FORMAT(orderDate, '%Y-%m') AS month
        FROM orders o
        JOIN tbl_payment p ON o.payid = p.payid
        WHERE o.sellerid = '$sellerid'
        AND payment_status = 'completed'
        GROUP BY month";

$result = mysqli_query($con, $sql);

// Format the data for the chart
$revenue_data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $revenue_data[$row['month']] = $row['revenue'];
}

echo '<canvas id="revenue-chart"></canvas>';
echo '<script>
var ctx = document.getElementById("revenue-chart").getContext("2d");
var revenueChart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: ' . json_encode(array_keys($revenue_data)) . ',
        datasets: [{
            label: "Revenue",
            barThickness: 100,
            data: ' . json_encode(array_values($revenue_data)) . ',
            backgroundColor: [
                "rgba(255, 99, 132, 0.2)",
                "rgba(54, 162, 235, 0.2)",
                "rgba(255, 206, 86, 0.2)",
                "rgba(75, 192, 192, 0.2)",
                "rgba(153, 102, 255, 0.2)",
                "rgba(255, 159, 64, 0.2)"
            ],
            borderColor: [
                "rgba(255, 99, 132, 1)",
                "rgba(54, 162, 235, 1)",
                "rgba(255, 206, 86, 1)",
                "rgba(75, 192, 192, 1)",
                "rgba(153, 102, 255, 1)",
                "rgba(255, 159, 64, 1)"
            ]
        }]
    },
    options: {}
});
</script>';

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
<?php } ?>