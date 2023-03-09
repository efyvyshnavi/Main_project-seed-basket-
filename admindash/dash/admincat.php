<?php
session_start();
include ('config.php');
date_default_timezone_set('Asia/Kolkata');// 
$currentTime = date( 'd-m-Y h:i:s A', time () );

   if(isset($_POST['csubmit']))
 {
	$category=$_POST['category'];
	$description=$_POST['description'];
	
	$sql="select * from tbl_category where (categoryName='$category');";

	$res=mysqli_query($conn,$sql);

	if (mysqli_num_rows($res) > 0) {
	  
	  	$row = mysqli_fetch_assoc($res);
	  if($category==isset($row['categoryName']))
	  {
		
			$_SESSION['status'] = "This Category already exist";
	  }
  
	  }
   else{

	
    $sql=mysqli_query($conn,"insert into tbl_category(categoryName,categoryDescription,status) values('$category','$description','1')");
	  $_SESSION['status'] = "Category added successfully";
	   }
 }
?>

<!Doctype HTML>
	<html>
	<head>
		<title></title>
		
		<link rel="stylesheet" href="sty.css" type="text/css"/>
		<link rel="stylesheet" href="category.css" type="text/css"/>
    <link rel="stylesheet" href="head.css" type="text/css"/>
    
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
		<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
		<script src="https://kit.fontawesome.com/2bbac3a66c.js" crossorigin="anonymous" ></script>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="mainheader.css" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 90px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

.close {
  position: absolute;
  right: 510px;
  top: 210px;
  width: 32px;
  height: 32px;
  opacity: 0.6;
  font-size: 33px;
  font-weight: bold;
  color:red;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}


* {
  box-sizing: border-box;
}

form.example input[type=text] {
  padding: 7px;
  font-size: 18px;
  border: 2px solid grey;
  float: left;
  width: 70%;
  background: #f1f1f1;
}

form.example button {
  float: left;
  width: 20%;
  padding: 9px;
  background: #3630a3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
}
form.example button:hover {
  background: #0b7dda;
}

form.example::after {
  content: "";
  clear: both;
  display: table;
}
</style>

	</head>
	 <body>
	
	<div id="mySidenav" class="sidenav">
	<center style="color:black;padding:1px;font-size:20px;"><h2>Online Seed Basket</h2></center>
	<center style="color:black;padding:1px;font-size:20px;"><h3>Admin Panel</h3></center>
	
	<br>
	   
	  <a href="admincat.php"style="color:black;"class="icon-a"><i class="fa fa-shopping-bag icons"></i>Category</a>
	  <a href="adminsubcat.php"style="color:black;"class="icon-a"><i class="fa fa-shopping-bag icons"></i>   Sub Category</a>
	  <a href="manageseller.php"class="icon-a"style="color:black;"><i class="fa fa-list-alt icons"></i>  Sellers Details</a>
    <a href="approve.php" class="icon-a"style="color:black;"><i class="fa fa-dashboard icons"></i>   Pending requests</a>
	  
	  
	</div>
	
	<header class="site-header">
            <div  class="site-identity">
             
               
            </div>
        
            <nav class="site-navigation">
                <div class="w3-container">
                    <div class="w3-dropdown-hover">
                      <button class="w3-button w3-black">WELCOME ADMIN</button>
                      <div class="w3-dropdown-content w3-bar-block w3-border">
                        <a href="page.php" class="w3-bar-item w3-button">Change Password</a>
                        <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
                      </div>
                    </div>
                  </div>
            </nav>
    </header>

  <center><button style = "position:relative; left:310px; top:45px;background:#3630a3;color:white;font-size:16px;"id="myBtn">Add new Category</button>

<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
	<center>
      <div class="cardStyle">
		  <form id="category-form" method="POST" action="admincat.php">
			<h2 class="formTitle">
			 Add Category
			</h2>
			
		  <div class="inputDiv">
			<label style="font-size:17px;" class="inputLabel" for="cat">Enter Category Name</label>
			<input type="text"name="category" id="category" required pattern="[a-zA-Z][a-zA-Z ]+[a-zA-Z]$"oninvalid="this.setCustomValidity('Enter a valid Category Name')"
             oninput="this.setCustomValidity('')"title="Enter a valid name with minimum length of 3 characters" >
		  </div>
		  
		  <div class="inputDiv">
			<label style="font-size:17px;" class="inputLabel" for="text">Descripton</label>
			<textarea class="span8" id="des"name="description"rows="5"required pattern="^(.|\s)*[a-zA-Z]+(.|\s)*$"oninvalid="this.setCustomValidity('Enter a valid description')"
             oninput="this.setCustomValidity('')"title="Enter a valid description"></textarea>
	     </div>
	  
		  <div class="buttonWrapper">
		    <button type="csubmit" id="submit"name="csubmit">
		    <span style="color:black;font-weight:bold">CREATE CATEGORY</span>
		    </button>
		  </div>	
		</form>
      </div>
    </center>
  </div>
</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the span element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on span (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

<div class="module-head">
		  <h3>Manage Categories</h3>
	  </div>
	  <div class="module-body table">
		  <table style="width:50%"cellpadding="10" cellspacing="3" border="3"height="50%">
				  <tr>
					  <th>SI.No</th>
					  <th>Category</th>
					  <th>Description</th>
					  <th>Created On</th>
					  <th>Last Updated On</th>
					  <th>Action</th>
					  <th>Edit</th>
				  </tr>
				  
                
<?php $query=mysqli_query($conn,"select * from tbl_category");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>									
	        								
                <tr>
					  <td><?php echo htmlentities($cnt);?></td>
					  <td><?php echo htmlentities($row['categoryName']);?></td>
					  <td><?php echo htmlentities($row['categoryDescription']);?></td>
					  <td> <?php echo htmlentities($row['creationDate']);?></td>
					  <td><?php echo htmlentities($row['updationDate']);?></td>
				  <td>
					<?php
					if($row['status']==1){
						echo '<p><a href="inactivate.php?id='.$row['catid'].'$status=1"style="color:red;font-size:17px;">Disable</a></p>';
					}else{
						echo '<p><a href="activate.php?id='.$row['catid'].'$status=0"style="color:green;font-size:17px;">Enable</a></p>';
					}
					?>
					</td>
				<td><a href="edit-category.php?catid=<?php echo $row['catid']?>"style="color:blue;font-size:17px;">Edit</a></td>
				
				</tr>
				<?php $cnt=$cnt+1; } ?>
		   </table>
	    </div>
    </div>	
  </div>
</center>

<script>
<?php
  if(isset($_SESSION['status']))
     { 
	?>
	  alertify.set('notifier','position', 'top-center');
      alertify.success('<?= $_SESSION['status'];?>');
   	   <?php
	  unset($_SESSION['status']);
      }
      ?>
</script>
	  
<script>
  <?php
   if(isset($_SESSION['msg']))
     { 
	?>
	  alertify.set('notifier','position', 'top-center');
       alertify.success('<?= $_SESSION['msg'];?>');
   	   <?php
	   unset($_SESSION['msg']);
      }
      ?>
</script>

<script>
  <?php
   if(isset($_SESSION['msg2']))
     { 
	?>
	  alertify.set('notifier','position', 'top-center');
       alertify.success('<?= $_SESSION['msg2'];?>');
   	   <?php
	   unset($_SESSION['msg2']);
      }
      ?>
</script>
	  <script src="app.js"></script>

</body>
</html>
	