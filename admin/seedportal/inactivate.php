<?php
session_start();
include('config.php');
$id=$_REQUEST['id'];

$sql3="UPDATE tbl_category set status='0' where catid='$id'";
if(mysqli_query($conn,$sql3))
{
    $_SESSION['msg3'] = "Category deactivated successfully";
}
header("Location: index.php");
?>