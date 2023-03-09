<?php
session_start();
include('config.php');
$id=$_REQUEST['id'];

$sql9="UPDATE tbl_product set status='1' where pid='$id'";
if(mysqli_query($conn,$sql9))
{
    $_SESSION['inactive'] = "Product activated successfully";
}
header("Location: manageproducts.php");
?>