
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

						<div class="module"  style="padding:33px;width:1000px">
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

$sql = "SELECT p.pname, p.sellerid, SUM(CASE WHEN c.q_50 > 0 THEN c.q_50 ELSE 0 END) as total_q_50, 
SUM(CASE WHEN c.q_100 > 0 THEN c.q_100 ELSE 0 END) as total_q_100, 
SUM(CASE WHEN c.q_500 > 0 THEN c.q_500 ELSE 0 END) as total_q_500, 
SUM(CASE WHEN c.q_1000 > 0 THEN c.q_1000 ELSE 0 END) as total_q_1000 
FROM tbl_product p 
JOIN tbl_cart c ON p.pid = c.pid 
JOIN orders o ON c.orderid = o.orderid 
WHERE p.sellerid = '$sellerid' AND (c.q_50 > 0 OR c.q_100 > 0 OR c.q_500 > 0 OR c.q_1000 > 0)
GROUP BY p.pname, p.sellerid 
ORDER BY total_q_1000 DESC
";


$result = mysqli_query($con, $sql);

// Process the data and generate the graph
$data_q_50 = array();
$data_q_100 = array();
$data_q_500 = array();
$data_q_1000 = array();

while ($row = mysqli_fetch_assoc($result)) {
    $data_q_50[$row['pname']] = $row['total_q_50'];
    $data_q_100[$row['pname']] = $row['total_q_100'];
    $data_q_500[$row['pname']] = $row['total_q_500'];
    $data_q_1000[$row['pname']] = $row['total_q_1000'];
}

$labels = array_keys($data_q_50);
$values_q_50 = array_values($data_q_50);
$values_q_100 = array_values($data_q_100);
$values_q_500 = array_values($data_q_500);
$values_q_1000 = array_values($data_q_1000);
// Use Chart.js to generate the graph
// Replace 'chart-container' with the ID of the HTML element where you want to display the chart
?>
<div style="position: relative;">
    <canvas id="chart-container"></canvas>
    <div style="position: absolute; top: -50px; left: 81%; transform: translateX(-50%); font-weight: bold;">
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
            datasets: [
                {
                    label: 'Total Quantity Sold (50g)',
                    data: <?php echo json_encode($values_q_50); ?>,
                    backgroundColor: 'rgba(255, 211, 255)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 0.5,
                    barThickness: 40 // adjust the size of the bar
                },
                {
                    label: 'Total Quantity Sold (100g)',
                    data: <?php echo json_encode($values_q_100); ?>,
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 0.5,
                    barThickness: 40 // adjust the size of the bar
                },
                {
                    label: 'Total Quantity Sold (500g)',
                    data: <?php echo json_encode($values_q_500); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 0.5,
                    barThickness: 40 // adjust the size of the bar
                },
                {
                    label: 'Total Quantity Sold (1000g)',
                    data: <?php echo json_encode($values_q_1000); ?>,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 0.5,
                    barThickness: 40 // adjust the size of the bar
                },
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: '#333',
                    fontSize: 14
                }
            }
        }
    });
</script>




                                    
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