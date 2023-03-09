<?php
session_start();
include('config.php');
$id=$_REQUEST['id'];
$query = "DELETE FROM category WHERE catid=$id"; 
$_SESSION['msg'] = "Category deleted successfully";
$result = mysqli_query($conn,$query) or die ( mysqli_error());
header("Location: category.php"); 
?>