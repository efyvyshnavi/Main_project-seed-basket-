<?php 
session_start();
error_reporting(0);
include('config.php');
$email=$_SESSION['email'];
$pid=intval($_GET['pid']);

if(isset($_GET['pid']) && $_GET['action']=="wishlist" ){
	

mysqli_query($con,"insert into wishlist(userId,productId) values('".$_SESSION['id']."','$pid')");
echo "<script>alert('Product aaded in wishlist');</script>";
header('location:my-wishlist.php');

}

if(isset($_POST['submit']))
{
	$qty=$_POST['quality'];
	$price=$_POST['price'];
	$value=$_POST['value'];
	$name=$_POST['name'];
	$summary=$_POST['summary'];
	$review=$_POST['review'];
	mysqli_query($con,"insert into tbl_productreviews(pid,quality,price,value,name,summary,review) values('$pid','$qty','$price','$value','$name','$summary','$review')");
}
if(isset($_GET['pid']) && $_GET['action']=="wishlist" ){
	mysqli_query($con,"insert into tbl_wishlist(pid,logid,status) values('".$_GET['pid']."','$logid','1')");
	echo "<script>alert('Product aaded in wishlist');</script>";
	header('location:wishlist.php');
	
	}


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">
	    <title>Product Details</title>
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/green.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<link href="assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
		<link rel="stylesheet" href="assets/css/config.css">

		<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

        <!-- Fonts --> 
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="assets/images/favicon.ico">
		<style>
		a[data-lightbox="image-1"] img {
  max-width: 100%;
  max-height: 350%;
  transition: transform 0.2s ease-in-out;
}

a[data-lightbox="image-1"]:hover img {
  transform: scale(1.1);
}

</style>
<style>
.cart-quantity {
  position: absolute;
  top: 20px;
  left: -20px;
  transform: translate(-50%, -50%);
}
</style>
<style>
/* Styling for stars */
.rating .star {
  display: inline-block;
  width: 20px;
  height: 20px;
  background-image: url('img/star2.png');
  background-size: cover;
  cursor: pointer;
}

/* Styling for selected stars */
.rating .star.selected {
  background-image: url('img/star.png');
}

/* Styling for average rating */
.average-rating {
  font-size: 16px;
}
</style>
	</head>
    <body class="cnt-home">
	
<header class="header-style-1">

	<!-- ============================================== TOP MENU ============================================== -->
<?php include('includes/top-header.php');?>
<!-- ============================================== TOP MENU : END ============================================== -->
<?php include('includes/main-header.php');?>
	<!-- ============================================== NAVBAR ============================================== -->
<?php include('includes/menu-bar.php');?>
<!-- ============================================== NAVBAR : END ============================================== -->

</header>

<!-- ============================================== HEADER : END ============================================== -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
<?php
$ret=mysqli_query($con,"select tbl_category.categoryName as catname,tbl_subcategory.subcategory as subcatname,tbl_product.pname as pname from tbl_product join tbl_category on tbl_category.catid=tbl_product.catid join tbl_subcategory on tbl_subcategory.subid=tbl_product.subid where tbl_product.pid='$pid'");
while ($rw=mysqli_fetch_array($ret)) {

?>


			<ul class="list-inline list-unstyled">
				<li><a href="index.php">Home</a></li>
				<li><?php echo htmlentities($rw['catname']);?></a></li>
				<li><?php echo htmlentities($rw['subcatname']);?></li>
				<li class='active'><?php echo htmlentities($rw['pname']);?></li>
			</ul>
			<?php }?>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row single-product outer-bottom-sm '>
			<div class='col-md-3 sidebar'>
				<div class="sidebar-module-container">


					<!-- ==============================================CATEGORY============================================== -->
<div class="sidebar-widget outer-bottom-xs wow fadeInUp">
	<h3 class="section-title">Category</h3>
	<div class="sidebar-widget-body m-t-10">
		<div class="accordion">

		            <?php $sql=mysqli_query($con,"select catid,categoryName  from tbl_category");
while($row=mysqli_fetch_array($sql))
{
    ?>
	    	<div class="accordion-group">
	            <div class="accordion-heading">
	                <a href="category.php?cid=<?php echo $row['catid'];?>"  class="accordion-toggle collapsed">
	                   <?php echo $row['categoryName'];?>
	                </a>
	            </div>
	          
	        </div>
	        <?php } ?>
	    </div>
	</div>
</div>
	<!-- ============================================== CATEGORY : END ============================================== -->					<!-- ============================================== HOT DEALS ============================================== -->

<!-- ============================================== COLOR: END ============================================== -->
				</div>
			</div><!-- /.sidebar -->
<?php 
$ret=mysqli_query($con,"select * from tbl_product where pid='$pid'");
while($row=mysqli_fetch_array($ret))
{
?>
<form method="POST"action="manage_cart.php">	
			<div class='col-md-9'>
				<div class="row  wow fadeInUp">
					     <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                        <div class="product-item-holder size-big single-product-gallery small-gallery">

        <div id="owl-single-product">

		<div class="single-product-gallery-item" id="slide1">
 <a data-lightbox="image-1" data-title="<?php echo htmlentities($row['pname']);?>"<img src="../../../../admindash/shopping/admin/images/<?php echo $row['image'];?>">
 <img src="../images/<?php  echo $row['image'];?>" width="334" height="380" />
                </a>
            </div>
			

            
        </div><!-- /.single-product-slider -->
</div>
    </div>
    			




					<div class='col-sm-6 col-md-7 product-info-block'>
						<div class="product-info">
							<h1 class="name"><?php echo htmlentities($row['pname']);?></h1><br>
							
<?php $rt=mysqli_query($con,"select * from tbl_productreviews where pid='$pid'");
$num=mysqli_num_rows($rt);
{
?>		

											<a href="#" class="lnk" style="font-size:16px">(<?php echo htmlentities($num);?> Reviews)</a>
									
<?php } ?>


							<div class="stock-container info-container m-t-10">
								<div class="row">
									
									<div class="col-sm-9">
										<div class="stock-box">
											<span class="value"><?php echo htmlentities($row['availability']);?></span>
										</div>	
									</div>
								</div><!-- /.row -->	
							</div>




<div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-3">
										<div class="stock-box">
											<span class="label">Shipping Charge :</span>
										</div>	
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											<span class="value"><?php if($row['shippingCharge']==0)
											{
												echo "Free";
											}
											else
											{
												echo htmlentities($row['shippingCharge']);
											}

											?></span>
										</div>	
									</div>
								</div><!-- /.row -->	
							</div>

							<div class="price-container info-container m-t-20">
								<div class="row">
									

									<div class="col-sm-6">
										<div class="price-box">
											<span class="price">Rs. <?php echo htmlentities($row['price2']);?></span>
											<span class="price-strike">Rs.<?php echo htmlentities($row['price1']);?></span>
										</div>
									</div>




									<div class="col-sm-6">
										<div class="favorite-button m-t-10">
											<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="product-details.php?pid=<?php echo htmlentities($row['pid'])?>&&action=wishlist">
											    <i class="fa fa-heart"></i>
											</a>
											
											</a>
										</div>
									</div>

								</div><!-- /.row -->
							</div><!-- /.price-container -->

	




							<div class="quantity-container info-container">
								<div class="row">
									
									<div class="col-sm-2">
										<span class="label">Qty :</span>
									</div>
									
									<div class="row">
									<div class="col-sm-2 d-flex align-items-center justify-content-center">
										<div class="cart-quantity position-relative">
										<div class="quant-input">
											<div class="arrows">
											<input class="text-center" type="number" name="quantity" value="1" min="1" max="50">    
											</div>
										</div>
										</div>
									</div>
									</div>
<br>
									<div class="col-sm-7">
									
									<li class="add-cart-button btn-group">
							<input type="text" value="<?php echo $_GET['pid']?>" name="product_id"hidden>
                                                        <input type="text" value="<?php echo $row['sellerid']?>" name="sellerid"hidden>
							<input type="text" value="<?php echo $_GET['cid']?>" name="cid"hidden>
								<?php if($row['availability']=='In Stock'){?>
									<button class="btn btn-primary icon" data-toggle="dropdown" type="button"style="background-color:#686868"><i class="fa fa-shopping-cart"></i></button>
									<input class="btn btn-primary" type="submit" name="add_to_cart" value="Add to cart">
						
									
						
								<?php } else {?>
									<div class="action" style="color:red">Out of Stock</div>
								<?php } ?>	
								</form>
							
						</li>
									</div>

									
								</div><!-- /.row -->
							</div><!-- /.quantity-container -->
						</div><!-- /.product-info -->
					</div><!-- /.col-sm-7 -->
				</div><!-- /.row -->


					
				<div class="product-tabs inner-bottom-xs  wow fadeInUp">
					<div class="row">
						<div class="col-sm-3">
							<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
								<li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
								<li><a data-toggle="tab" href="#review">REVIEW</a></li>
							</ul><!-- /.nav-tabs #product-tabs -->
						</div>
						<div class="col-sm-9">

							<div class="tab-content">
								
								<div id="description" class="tab-pane in active">
									<div class="product-tab">
										<p class="text"><?php echo $row['pdescription'];?></p>
									</div>	
								</div><!-- /.tab-pane -->

								<div id="review" class="tab-pane">
									<div class="product-tab">
																				
										<div class="product-reviews">
											<h4 class="title">Customer Reviews</h4>
<?php $qry=mysqli_query($con,"select * from tbl_productreviews where pid='$pid'");
while($rvw=mysqli_fetch_array($qry))
{
?>

											<div class="reviews" style="border: solid 1px #000; padding-left: 2% ">
												<div class="review">
													<div class="review-title"><span class="summary"><?php echo htmlentities($rvw['summary']);?></span><span class="date"><i class="fa fa-calendar"></i><span><?php echo htmlentities($rvw['reviewDate']);?></span></span></div>

													<div class="text">"<?php echo htmlentities($rvw['review']);?>"</div>
													<div class="text"><b>Quality :</b>  <?php echo htmlentities($rvw['quality']);?> Star</div>
													<div class="text"><b>Price :</b>  <?php echo htmlentities($rvw['price']);?> Star</div>
													<div class="text"><b>value :</b>  <?php echo htmlentities($rvw['value']);?> Star</div>
                                                <div class="author m-t-15"><i class="fa fa-pencil-square-o"></i> <span class="name"><?php echo htmlentities($rvw['name']);?></span></div>													</div>
											
											</div>
											<?php } ?><!-- /.reviews -->
										</div><!-- /.product-reviews -->
										<form role="form" class="cnt-form" name="review" method="post">

										
										<div class="product-add-review">
											<h4 class="title">Write your own review</h4>
											<div class="review-table">
												<div class="table-responsive">
													<table class="table table-bordered">	
														<thead>
															<tr>
																<th class="cell-label">&nbsp;</th>
																<th>1 star</th>
																<th>2 stars</th>
																<th>3 stars</th>
																<th>4 stars</th>
																<th>5 stars</th>
															</tr>
														</thead>	
														<tbody>
															<tr>
																<td class="cell-label">Quality</td>
																<td><input type="radio" name="quality" class="radio" value="1"></td>
																<td><input type="radio" name="quality" class="radio" value="2"></td>
																<td><input type="radio" name="quality" class="radio" value="3"></td>
																<td><input type="radio" name="quality" class="radio" value="4"></td>
																<td><input type="radio" name="quality" class="radio" value="5"></td>
															</tr>
															<tr>
																<td class="cell-label">Price</td>
																<td><input type="radio" name="price" class="radio" value="1"></td>
																<td><input type="radio" name="price" class="radio" value="2"></td>
																<td><input type="radio" name="price" class="radio" value="3"></td>
																<td><input type="radio" name="price" class="radio" value="4"></td>
																<td><input type="radio" name="price" class="radio" value="5"></td>
															</tr>
															<tr>
																<td class="cell-label">Value</td>
																<td><input type="radio" name="value" class="radio" value="1"></td>
																<td><input type="radio" name="value" class="radio" value="2"></td>
																<td><input type="radio" name="value" class="radio" value="3"></td>
																<td><input type="radio" name="value" class="radio" value="4"></td>
																<td><input type="radio" name="value" class="radio" value="5"></td>
															</tr>
														</tbody>
													</table><!-- /.table .table-bordered -->
												</div><!-- /.table-responsive -->
											</div><!-- /.review-table -->
											
											<div class="review-form">
												<div class="form-container">
													
														
														<div class="row">
															<div class="col-sm-6">
																<div class="form-group">
																	<label for="exampleInputName">Your Name <span class="astk">*</span></label>
																<input type="text" class="form-control txt" id="exampleInputName" placeholder="" name="name" required="required">
																</div><!-- /.form-group -->
																<div class="form-group">
																	<label for="exampleInputSummary">Summary <span class="astk">*</span></label>
																	<input type="text" class="form-control txt" id="exampleInputSummary" placeholder="" name="summary" required="required">
																</div><!-- /.form-group -->
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputReview">Review <span class="astk">*</span></label>

<textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder="" name="review" required="required"></textarea>
																</div><!-- /.form-group -->
															</div>
														</div><!-- /.row -->
														
														<div class="action text-right">
															<button name="submit" class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
														</div><!-- /.action -->

													</form><!-- /.cnt-form -->
												</div><!-- /.form-container -->
											</div><!-- /.review-form -->

										</div><!-- /.product-add-review -->										
										
							        </div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->

				

							</div><!-- /.tab-content -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.product-tabs -->



				<?php $cid=$row['catid'];
				$subcid=$row['subid']; } ?>
				<!-- ============================================== UPSELL PRODUCTS ============================================== -->
<section class="section featured-product wow fadeInUp">
	<h3 class="section-title">Realted Products </h3>
	<div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
	   
		<?php 
$qry=mysqli_query($con,"select * from tbl_product where subid='$subcid' and catid='$cid'");
while($rw=mysqli_fetch_array($qry))
{

			?>	


		<div class="item item-carousel">
			<div class="products">
	<div class="product">		
		<div class="product-image">
			<div class="image">
			<a href="product-details.php?pid=<?php echo htmlentities($rw['pid']);?>"><img src="../images/<?php  echo $rw['image'];?>"width='160' height='220'>
			</div><!-- /.image -->			

			                   		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($rw['pid']);?>"><?php echo htmlentities($rw['pname']);?></a></h3>
			
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					Rs.<?php echo htmlentities($rw['price2']);?>			</span>
										     <span class="price-before-discount">Rs.
										     <?php echo htmlentities($rw['price1']);?></span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						<li class="add-cart-button btn-group">
							<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
								<i class="fa fa-shopping-cart"></i>													
							</button>
						<a href="product-details.php?page=product&action=add&id=<?php echo $rw['id']; ?>" class="lnk btn btn-primary">Add to cart</a>
													
						</li>
	                   
		              
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div><!-- /.item -->
		<?php } ?>
	
		
			</div><!-- /.home-owl-carousel -->
</section><!-- /.section -->


<!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
			
			</div><!-- /.col -->
			<div class="clearfix"></div>
		</div>

</div>
</div>
<?php include('includes/footer.php');?>

<script>
var closebtns = document.getElementsByClassName("close");
var i;

for (i = 0; i < closebtns.length; i++) {
  closebtns[i].addEventListener("click", function() {
    this.parentElement.style.display = 'none';
  });
}
</script>
<script>
// Add event listeners to each star element
var stars = document.querySelectorAll(".star");
stars.forEach(function(star) {
  star.addEventListener("click", function() {
    // Send an AJAX request to the server to update the rating
    var rating = star.getAttribute("data-rating");
    var pid = "123"; // Replace with the actual item ID
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Update the displayed average rating
        var averageRating = xhr.responseText;
        document.querySelector("#average-rating").textContent = averageRating;
        // Color the stars up to the clicked one
        stars.forEach(function(s) {
          if (s.getAttribute("data-rating") <= rating) {
            s.classList.add("rated");
          } else {
            s.classList.remove("rated");
          }
        });
      }
    };
    xhr.open("POST", "update_rating.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("item_id=" + pid + "&rating=" + rating);
  });
});
</script>

	<script src="assets/js/jquery-1.11.1.min.js"></script>
	
	<script src="assets/js/bootstrap.min.js"></script>
	
	<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>
	
	<script src="assets/js/echo.min.js"></script>
	<script src="assets/js/jquery.easing-1.3.min.js"></script>
	<script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="assets/js/lightbox.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
	<script src="assets/js/scripts.js"></script>