<?php
session_start();
include('config.php');
$id=$_REQUEST['id'];

$sql3="UPDATE sellerreg set status='0' where sellerid='$id'";
if(mysqli_query($conn,$sql3))
{
    $_SESSION['msg'] = "Category deactivated successfully";
}
header("Location: manageseller.php");
?>