<?php
include("include/config.php");
session_start();

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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
  width: 100%;
  margin-bottom: 10px;
}

input[type="submit"] {
  background-color: #443e51;
  color: white;
  padding: 6px 30px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #03000c;
}
</style>
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
                            <center><h3>Revenue graph</h3></center>
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

// Initialize variables
$labels = array();
$data = array();

if (isset($_POST['submit'])) {
    // Get selected month and year from form input
    $month = $_POST['month'];
    $year = $_POST['year'];

    // Construct SQL query
    $sql = "SELECT p.pname, DATE_FORMAT(py.paydate, '%Y-%m') AS payment_month, SUM(c.quantity * p.price2) AS total_sales
    FROM tbl_product p
    INNER JOIN tbl_cart c ON p.pid = c.pid
    INNER JOIN tbl_payment py ON c.cart_id = py.cart_id
    INNER JOIN orders o ON py.payid = o.payid
    WHERE o.sellerid = '$sellerid' AND YEAR(py.paydate) = '$year' AND MONTH(py.paydate) = '$month'
    GROUP BY p.pname, payment_month;";

    // Execute query and fetch results
    $result = mysqli_query($con, $sql);
    
    // Loop through the results and add the data to the arrays
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $labels[] = $row['pname'];
            $data[] = $row['total_sales'];
        }
    }
}
?>
<!-- Display form input fields here -->
<form method="post">
    <!-- Month select field -->
    <select name="month">
      <option value="01">January</option>
      <option value="02">February</option>
      <option value="03">March</option>
      <option value="04">April</option>
      <option value="05">May</option>
      <option value="06">June</option>
      <option value="07">July</option>
      <option value="08">August</option>
      <option value="09">September</option>
      <option value="10">October</option>
      <option value="11">November</option>
      <option value="12">December</option>
    </select>
    <br>
    </select>
    <!-- Year select field -->
    <select name="year">
    <?php
        $current_year = date('Y');
        for ($year = $current_year; $year >= $current_year - 5; $year--) {
          echo "<option value='".$year."'>".$year."</option>";
        }
      ?>
    </select><br>
    <input type="submit" name="submit" value="Submit">
</form><br>

<!-- Create a canvas element for the line graph -->
<canvas id="sales-chart"></canvas>

<!-- Include the Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
<?php if (isset($_POST['submit'])): ?>
// Create a new line chart with the sales data
var ctx = document.getElementById("sales-chart").getContext("2d");
var chart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: <?= json_encode($labels) ?>,
        datasets: [{
            label: "Sales Data",
            data: <?= json_encode($data) ?>,
            borderColor: "rgb(75, 192, 192)",
            fill: false
            
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        barThickness: 40 // Adjust the thickness of the bars
    }
});
<?php endif; ?>
</script>

  </div>
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
<?php  ?>
     
