<?php
session_start();
include('config.php');
$id=$_REQUEST['id'];

$sql9="UPDATE sellerreg,login SET sellerreg.status='2',login.status='2' where login.logid=sellerreg.logid AND sellerreg.sellerid='$id'";
if(mysqli_query($conn,$sql9))
{
    $_SESSION['msg'] = "Seller is approved";
}
header("Location: approve.php");
?>