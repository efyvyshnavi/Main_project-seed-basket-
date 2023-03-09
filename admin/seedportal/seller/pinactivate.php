<?php
session_start();
include('config.php');
$id=$_REQUEST['id'];

$sql8="UPDATE tbl_product set status='0' where pid='$id'";
if(mysqli_query($conn,$sql8))
{
    $_SESSION['active'] = "Product deactivated successfully";
}
header("Location: manageproducts.php");
?>