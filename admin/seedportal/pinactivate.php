<?php
session_start();
include('include/config.php');
$id=$_REQUEST['id'];

$sql8="UPDATE tbl_product set availability='Out Stock' where pid='$id'";
if(mysqli_query($con,$sql8))
{
    $_SESSION['active'] = "Product deactivated successfully";
}
header("Location: manage-products.php");
?>