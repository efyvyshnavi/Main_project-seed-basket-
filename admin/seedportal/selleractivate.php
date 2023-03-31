<?php
session_start();
include('config.php');
$id=$_REQUEST['id'];

$sql4="UPDATE login set status='-1' where logid='$id' and role='seller'";
if(mysqli_query($conn,$sql4))
{
    $_SESSION['message'] = "Seller deactivated successfully";
}
header("Location: manageseller.php");
?>