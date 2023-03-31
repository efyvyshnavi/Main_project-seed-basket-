<?php
session_start();
include('config.php');
$id=$_REQUEST['id'];

$sql5="UPDATE tbl_subcategory set status='1' where subid='$id'";
if(mysqli_query($conn,$sql5))
{
    $_SESSION['msg5'] =  "Subcategory activated successfully";
}
header("Location: subcategory.php");
?>