<?php
session_start();
include('config.php');
$id=$_REQUEST['id'];

$sql4="UPDATE tbl_category set status='1' where catid='$id'";
if(mysqli_query($conn,$sql4))
{
    $_SESSION['message'] = "Category activated successfully";
}
header("Location: index.php");
?>