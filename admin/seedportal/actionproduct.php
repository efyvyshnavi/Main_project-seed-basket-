<?php
include("config.php");
session_start();
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
$targetDir = "images/";
if(isset($_POST["btnsubmit"]))
{

    $Name=$_POST['name']; 
    $cid=$_POST['cid'];
    $sid=$_POST['sid'];
    $des=$_POST['des'];
    $price1=$_POST['price1'];
	  $discount=$_POST['discount'];
    $avail=$_POST['avail'];
    $price2=$price1-($price1*$discount/100);
    // $target="imag/".basename($_FILES['images']['name']);
    $image=$_FILES['images']['name'];


    move_uploaded_file($_FILES['images']['tmp_name'],"images/".$image);
    // move_uploaded_file($_FILES['fname']['tmp_name'],"imageupload/".$img);





    $price2=$price1-($price1*$discount/100);
    
	$sql11="select * from tbl_product where (pname='$Name')";

	$res1=mysqli_query($conn,$sql11);

	if (mysqli_num_rows($res1) > 0) {
	  
	  	$row = mysqli_fetch_assoc($res1);
	  if($Name==isset($row['pname']))
	  {
		
			$_SESSION['stat'] = "This product already exist";
      header('location:product.php');
	  }
  
	  }
    else
    {
    $sql=mysqli_query($conn,"INSERT INTO tbl_product(pname,catid,subid,pdescription,`image`,discount,price1,price2,availability) 
    VALUES('$Name','$cid','$sid','$des','$image','$discount','$price1','$price2','$avail')");
    $_SESSION['fail'] = "Product Details Registered Successfully!!";
    header('location:product.php');
      }
    }
  	
    
  	
?>