<?php 
include('config.php');
session_start();
$email=$_SESSION['email'];

if(isset($_POST['payment_id']) && isset($_POST['amount'])){
    $sqlq="SELECT logid from login where email='$email'";
$resu = mysqli_query($con, $sqlq);
$row = mysqli_fetch_assoc($resu);
$logid= $row['logid'];

$sql = mysqli_query($con, "SELECT * from tbl_cart where logid='$logid' and status!='0'");
while($row = mysqli_fetch_array($sql)){
    $cartid = $row['cart_id'];
    $sellerid = $row['sellerid'];
    
    $amt = $_POST['amount'];
    $payment_status = "completed";
    $sql3 = "INSERT INTO `tbl_payment`(`amount`, `payment_status`, `logid`, `cart_id`,`sellerid`) VALUES ('$amt', '$payment_status', '$logid', '$cartid','$sellerid')";
    $result = $con->query($sql3);
    
    if($result){
        $payid = $con->insert_id;
        $sql4 = "INSERT INTO orders (paymentMethod, status, payid,sellerid) VALUES ('COD', '1', '$payid','$sellerid')";
        $result1 = $con->query($sql4);
        //$sql5="UPDATE tbl_cart SET orderid = @order_id WHERE logid ='$logid' AND orderid IS NULL";
        //$result12=$con->query($sql5);
        
        if($result1){
            // Delete cart items that were added to the order
            $orderid = $con->insert_id;
            $sql5 = "UPDATE tbl_cart SET status='0',orderid='$orderid' WHERE cart_id = '$cartid'";
            $result2 = $con->query($sql5);
        } 
    }
}
}
?>