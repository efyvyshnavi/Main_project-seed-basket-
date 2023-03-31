<?php
session_start();
include('config.php');
$id=$_REQUEST['id'];

$sqlq="UPDATE sellerreg,login SET sellerreg.status='-1',login.status='-1' where login.logid=sellerreg.logid AND sellerreg.sellerid='$id'";
if(mysqli_query($conn,$sqlq))
{
    $_SESSION['msg'] = "Seller is Rejected";
}
header("Location: approve.php");
?>