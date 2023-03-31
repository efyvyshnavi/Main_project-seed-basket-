<?php
session_start();
include('include/config.php');
$id=$_REQUEST['id'];

$sql9="UPDATE tbl_product set availability='In Stock' where pid='$id'";
if(mysqli_query($con,$sql9))
{
    $_SESSION['inactive'] = "Product activated successfully";
}
header("Location: manage-products.php");
?>