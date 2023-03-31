<?php
session_start();
include('config.php');
$id=$_REQUEST['id'];

$sql3="UPDATE login set status='2' where logid='$id' and role='seller'";
if(mysqli_query($conn,$sql3))
{
    $_SESSION['msg3'] = "Seller activated successfully";
}
header("Location: manageseller.php");
?>