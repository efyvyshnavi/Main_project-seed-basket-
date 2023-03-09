<?php
session_start();
include ('config.php');
?>
<!DOCTYPE html>
<head>
<title>Online Seed Portal</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<link rel="stylesheet" href="product.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="mainheader.css" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="product.css">
		<link rel="stylesheet" href="styl.css" type="text/css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://kit.fontawesome.com/2bbac3a66c.js" crossorigin="anonymous" ></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
		<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
</head>
<body>
</style>

</head>
 <body>

<div id="mySidenav" class="sidenav">
<center style="color:white;padding:1px;font-size:20px;"">Online Seed Basket</center>
<br>
   
  <a href="category.php"class="icon-a"><i class="fa fa-shopping-bag icons"></i>   Category</a>
  <a href="subcategory.php"class="icon-a"><i class="fa fa-shopping-bag icons"></i>   Sub Category</a>
  <a href="product.php"class="icon-a"><i class="fa fa-tasks icons"></i>   Insert Product</a>
  <a href="manageproducts.php"class="icon-a"><i class="fa fa-tasks icons"></i>   Manage Product</a>
  <a href="#"class="icon-a"><i class="fa fa-list-alt icons"></i>   Manage Users</a>
  <a href="#" class="icon-a"><i class="fa fa-shopping-bag icons"></i>   Today's Order</a>
  <a href="#" class="icon-a"><i class="fa fa-dashboard icons"></i>   Pending Orders</a>
  <a href="#" class="icon-a"><i class="fa fa-dashboard icons"></i>   Delivered Orders</a>
  
</div>

<header class="site-header">
        <div  class="site-identity">
         
           
        </div>
    
        <nav class="site-navigation">
            <div class="w3-container">
                <div class="w3-dropdown-hover">
                  <button class="w3-button w3-black">WELCOME SELLER</button>
                  <div class="w3-dropdown-content w3-bar-block w3-border">
                    <a href="page.php" class="w3-bar-item w3-button">Change Password</a>
                    <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
                  </div>
                </div>
              </div>
        </nav>
</header>

    <center>
<div class="cardStyle">
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
	<div class="form-w3layouts">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <h3><header class="panel-heading">
                            Add Product
                        </header></h3><br><br><br>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="actionproduct.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="name">Product Name</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name"required pattern="[a-zA-Z][a-zA-Z ]+[a-zA-Z]$"oninvalid="this.setCustomValidity('Enter a valid Product Name')"
             oninput="this.setCustomValidity('')"title="Enter a valid name with minimum length of 3 characters" >
                                    </div>
                                    <div class="form-group">
                            <?php
$con=mysqli_connect("localhost","root","","project");


$sql=mysqli_query($conn,"select * from tbl_category"); 
?>
<label>Category Name</label><br>

     
<select   name="cid" id="category" onchange="showResult(this.value)" class="form-control m-bot15" required >
<option value="">--select--</option>
<?php
while($row=mysqli_fetch_array($sql))
{

?>
<option value="<?php echo $row[0] ?>" ><?php echo $row[1] ?></option>

<?php
	
}
?>

</select></div>
<div class="form-group">
<?php
$con=mysqli_connect("localhost","root","","project");


$sql=mysqli_query($conn,"SELECT *FROM tbl_subcategory"); 
?>
<label>Subcategory Name</label><br>

     
<select   name="sid" id="sub_category" onchange="showResult(this.value)" class="form-control m-bot15" required >
<option value="">--select--</option>
<?php
while($row=mysqli_fetch_array($sql))
{

?>
<option value="<?php echo $row[0] ?>" ><?php echo $row[2] ?></option>
<?php
	
}
?>

</select></div>                       <div class="form-group">
                                        <label for="des">Product Description</label>
                                        <input type="text" class="form-control" name="des" id="des">
                                    </div>
                                      <div class="form-group">           
                                        <label for="image">Product image</label>
                                        <input type="file" class="form-control" accept="image/gif, image/jpeg, image/png, image/jpg"  name="image" id="image"required>
                                    </div>
                                   
                                    <div class="panel-body">

                                   <div class="row">
                                     
                                    <div class="col-md-4 form-group">
                                    <label for="qua">Product Quantity</label>
                                <input type="number"  class="form-control" name="quantity"required min="1" oninput="validity.valid||(value='');">
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="price1">Product Price Before Discount</label>
                                <input type="number"  class="form-control" name="price1"min="10"required pattern='/^(0|[1-9]\d*)(\.\d{2})?$/'>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="price2">Selling Price</label>
                                <input type="number"  class="form-control" name="price2" required pattern='/^(0|[1-9]\d*)(\.\d{2})?$/'min="10">
                                </div>
                            
                            

                            <div class="col-md-3 form-group">
                            
                                    <label for="avail">Product Availability </label>
                                    <select class="form-control m-bot15" name="avail" required>
                                    <option>---Select---</option>
                                <option>In Stock</option>
                                <option>Out Stock</option>  
                            </select>   
                            </div>

                          
                            
</div>
</div>
                               <br><button type="submit" name="btnsubmit"class="btn btn-info">Submit</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
            <div class="col-lg-12">
               
            </div>
        </div>
        <div class="row">
            
        </div>

        
 <!-- footer -->
		 
  <!-- / footer -->
</section>
</center>
<!--main content end-->
</section>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
<script>
$(document).ready(function() {
 $('#category').on('change', function() {
   var category_id = this.value;
   $.ajax({
    url: "get_subcat.php",
    type: "POST",
    data: {
     category_id: category_id
    },
    cache: false,
    success: function(dataResult){
     $("#sub_category").html(dataResult);
    }
   });
  
  
 });
});
	  
<script>
  <?php
   /**********************index.php**/
   if(isset($_SESSION['insert']))
     { 
	?>
	  alertify.set('notifier','position', 'top-center');
       alertify.success('<?= $_SESSION['insert'];?>');
   	   <?php
	   unset($_SESSION['insert']);
      }
      ?>
</script>
<script>
  <?php
   /**********************index.php**/
   if(isset($_SESSION['fail']))
     { 
	?>
	  alertify.set('notifier','position', 'top-center');
       alertify.success('<?= $_SESSION['fail'];?>');
   	   <?php
	   unset($_SESSION['fail']);
      }
      ?>
</script>
</body>
</html>