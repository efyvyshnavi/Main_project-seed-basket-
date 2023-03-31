<?php
session_start();
include('config.php');
$id=$_REQUEST['id'];

$sql6="UPDATE tbl_subcategory set status='0' where subid='$id'";
if(mysqli_query($conn,$sql6))
{
    $_SESSION['msg6'] = "Subcategory deactivated successfully";
}
header("Location: subcategory.php");
?>