	<?php
	include('header.php');
	if($_SERVER["REQUEST_METHOD"]=="POST"){
	session_start();

	}
	?>

	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>cart</title>
			<style>
				#mycart_div{
					display: flex;
				}

				#mycart-table{
					flex: 3;
				}
				
				#mycart-total{
					flex: 1;
					margin-left: 30px;
				}

				#prod_name{
					overflow: hidden;
					width:90%;
					display: -webkit-box;
					-webkit-line-clamp: 1;
					-webkit-box-orient: vertical;
				}
				.form-check-label{
					margin-left: -25px;
					font-family: monospace;
					font-size: 20px;
				}
				#cartupdate{
					margin-top: -4px;
				}
				
				

			</style>
		</head>

						<body>

							<div class="text-center border rounded bg-light my-5 m-5">
								<h1>MY ORDER</h1>
							</div>

							<div id="mycart_div" class="m-5">
								<table class="table" id="mycart-table">
								<thead class="	text-center">
										<tr>
											<th scope="col">Sr.No.</th>
											<th scope="col">Item Name</th>
											<th scope="col">Price</th>
											<th scope="col">Quantity</th>
											<th scope="col">Total</th>
											<th scope="col">Action</th>
										</tr>
									</thead>

									<tbody class="text-center">
										<?php
											$all_total=0;
											$sr=0;
											$email= $_SESSION['email'];
											$sqlq="SELECT logid from login where email='$email'";
											$resu = mysqli_query($con, $sqlq);
											$row = mysqli_fetch_assoc($resu);
											$logid= $row['logid'];
							
											$mycart_record_res= mysqli_query($con,"SELECT * from tbl_cart WHERE logid=$logid");
											if(mysqli_num_rows($mycart_record_res) > 0)
											{
												foreach($mycart_record_res as $row){
													$sr++;
													$pid= $row['pid'];
													$prod_sql= mysqli_query($con,"SELECT * from tbl_product WHERE pid=$pid");
													if(mysqli_num_rows($prod_sql) == 1){
														$pred_details_res= mysqli_fetch_array($prod_sql);
														$each_total= $row["quantity"]*$pred_details_res["price2"];
														$all_total+=$each_total;
													
														echo"
															<tr>
																<td>$sr</td>
																
																
																<td><p id='prod_name'>".$pred_details_res["pname"]."</p></td>
                

																<td>".$pred_details_res["price2"]."</td>

																
																<td>
																	<form action='manage_cart.php' method = 'POST'>
																		<input class='text-center' type='number'  name='quantity' value='".$row["quantity"]."' min='1' max='10'>
																		<input type='text' name='product_id' value=".$row["pid"]." hidden>
																		<button name='update_Item'  id='cartupdate' class='btn btn-sm btn-outline-success '>UPDATE</button>
																	</form>
																</td>
																<td class='itotal'>".$each_total."</td>
																
																<td>
																	<form action='manage_cart.php' method='POST'>
																		<input type='text' name='product_id' value=".$row["pid"]." hidden>
																		<button name='Remove_Item' class='btn btn-sm btn-outline-danger'>REMOVE</button>
																	</form>
																
																</td>
															
															</tr>
														";
													}
													else{
														
													}
												}
											
											}
											
										?>
										
									</tbody>

								</table>
								<!-- <form action="deliveryform.php" method="POST"> -->

								<div class="col-lg-4" id="mycart-total">
									<div class="border bg-light rounded p-4">
										<h3>Total:</h3>
										<h5 class="text-right"><?php echo $all_total; ?></h5>
										<br>
										<form>
											<div class="form-check">
												<!-- <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"> -->
												<label class="form-check-label" for="flexRadioDefault1">Make Order</label>
												
											</div>
											<br>
											
											<a href="cash.php" button class="btn btn-primary btn-block">Cash On Delivery</button></a>
											<!-- <a href="deliveryform.php" button class="btn btn-primary btn-block">Cash On Delivery</button></a> -->
											<br><br>
											<button class="btn btn-primary btn-block">Online Payment</button>
										</form>
									</div>
								</div>
								<!-- </form> -->
							</div>
							
						</body>
					</html>