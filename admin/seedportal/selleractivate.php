<?php
session_start();
include('config.php');
$id=$_REQUEST['id'];

$sql4="UPDATE sellerreg set status='1' where sellerid='$id'";
if(mysqli_query($conn,$sql4))
{
    $_SESSION['msg2'] = "Category activated successfully";
}
header("Location: manageseller.php");
?>