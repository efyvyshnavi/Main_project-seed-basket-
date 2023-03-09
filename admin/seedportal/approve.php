<?php
session_start();
include ('config.php');
date_default_timezone_set('Asia/Kolkata');// 
$currentTime = date( 'd-m-Y h:i:s A', time () );
?>

<!Doctype HTML>
	<html>
	<head>
		<title></title>
		
		<link rel="stylesheet" href="sty.css" type="text/css"/>
		<link rel="stylesheet" href="category.css" type="text/css"/>
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
	  <a href="manageseller.php"class="icon-a"style="color:black;"><i class="fa fa-list-alt icons"></i>   Manage Sellers</a>
      <a href="approve.php" class="icon-a"style="color:black;"><i class="fa fa-dashboard icons"></i>   Pending Requests</a>
	  
	  
	</div>
	
	<header class="site-header">
            <div  class="site-identity">
             
               
            </div>
        
            <nav class="site-navigation">
                <div class="w3-container">
                    <div class="w3-dropdown-hover">
                      <button class="w3-button w3-black">WELCOME ADMIN</button>
                      <div class="w3-dropdown-content w3-bar-block w3-border">
                        <a href="#" class="w3-bar-item w3-button">Change Password</a>
                        <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
                      </div>
                    </div>
                  </div>
            </nav>
    </header>

</div>

          

<center>
<div class="module-head">
		  <h3 style="font-size:30px;">Pending Requests</h3><br>
	  </div>
		            		  		             		               
<?php $query=mysqli_query($conn,"select sellerreg.sellerid,sellerreg.fname,sellerreg.lname,login.email,sellerreg.phoneno,sellerreg.logid,sellerreg.status,sellerreg.file_name,sellerreg.creationDate,login.status from login join sellerreg on login.logid=sellerreg.logid AND sellerreg.status=1");
$cnt=1;
$num=mysqli_num_rows($query);
if($num>0)
{
while($row=mysqli_fetch_array($query))
{
?>		
      <div class="module-body table">
		  <table style="width:50%"cellpadding="10" cellspacing="3" border="3">						
	   
				  <tr>
					  <th>SI.No</th>
					  <th>First Name</th>
					  <th>Last Name</th>
					  <th>Email</th>
					  <th>Phoneno</th>
                                         
            <th>Request Time</th>
					  <th>Approve</th>
            <th>Reject</th>  
				  </tr>
				
                <tr>
					  <td><?php echo htmlentities($cnt);?></td>
					  <td><?php echo htmlentities($row['fname']);?></td>
					  <td><?php echo htmlentities($row['lname']);?></td>
					  <td> <?php echo htmlentities($row['email']);?></td>
					  <td><?php echo htmlentities($row['phoneno']);?></td>
                                           
                      <td><?php echo htmlentities($row['creationDate']);?></td>
              <td>
              
              <?php
                        if($row['status']==1){
                          echo '<p><b><a href="pending.php?id='.$row['sellerid'].'$status=0"style="color:Green;font-size:17px;">Approve</a></b></p>';
                        }else{
                          echo '<p><b><a href="pending.php?id='.$row['sellerid'].'$status=0"style="color:Green;font-size:17px;">Approve</a></b></p>';
                        }
                        ?>
             </td>

             <td>
              
              <?php
                        if($row['status']==0){
                          echo '<p><b><a href="reject.php?id='.$row['sellerid'].'$status=1"style="color:red;font-size:17px;">Reject</a></b></p>';
                        }else{
                          echo '<p><b><a href="reject.php?id='.$row['sellerid'].'$status=1"style="color:red;font-size:17px;">Reject</a></b></p>';
                        }
                        ?>
             </td>
          
          
          
				
				</tr><br>
				<?php $cnt=$cnt+1; }}
                
                else{?>
          
    <BR><BR><BR><BR><BR><BR><h3 style="font-size:50px;color:blue;">NO NEW REQUESTS</h3>
    <?php } ?>	
                  
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
	