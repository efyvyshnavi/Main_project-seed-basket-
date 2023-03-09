<?php
session_start();
include('config.php');
$wish_id=$_REQUEST['wish_id'];

$sql8="UPDATE tbl_category set status='1' where wish_id='$wish_id'";
if(mysqli_query($conn,$sql8))
{
   
}
header("Location: view_wishlist.php");
?>